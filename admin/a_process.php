<?
include_once("./_common.php");
include_once("./class/class.UploadFile.php");
### 메일 관련 코드
//id 발송시 PECERA 고유번호 발급시 년도 정보 생성
$id_year=date('y');
if(defined('__DEV__')) error_reporting(E_ALL);
// 변수설정
$main_editor = $info['editor_email'];
$mail_header = <<<HTML
<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><title></title></head>
<body>
<table width='750' border='0' cellspacing='0' cellpadding='0'><tr><td height='85' align='center' valign='top'><img src='{$info['logo_url']}'/></td></tr><tr><td height='15'></td></tr>
<tr><td height='50' align='left' valign='top'>
HTML;
$mail_footer = <<<HTML
<table width='750' border='0' cellspacing='0' cellpadding='0' style="background-color: #FFF;">
<tr>
<td width='240' height='80'><img src='{$info['logo_url']}' /></td>
<td width='10'></td><td align='left'>
<p>{$info['institute_title']} 편집위원장 {$info['editor_name']}<br />
{$info['address']}<br />
Tel : {$info['editor_tel']}, E-mail : <a href='mailto:{$info['editor_email']}'>{$info['editor_email']}</a><br />
Home :<a href='{$info['site']}'>{$info['site']}</a></p>
</td></tr>
</table>
</td></tr></table></body></html>
HTML;
// 변수설정 끝
date_default_timezone_set('Asia/Seoul');
require_once('class.phpmailer.php');
$mail             = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "ssl://smtp.gmail.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
if(!defined('__DEV__')) $mail->Username   = $info['smtp_id']; // SMTP account username
if(!defined('__DEV__')) $mail->Password   = $info['smtp_pw']; // SMTP account password
$mail->SetFrom($main_editor,$info['institute_title']);
$mail->Subject    = "안녕하세요. {$info['institute_title']}입니다.";
##################
function passnum($idsu){
	$num = array(A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9,0,a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z);
	 for($i=0;$i<$idsu;$i++){
		$rand = rand(0,71);
	 $pass .= $num[$rand];
	}
	return $pass;
}
### A :: 논문투고 등록
if($_POST['mode']=="a_sub_reg"){
	// 세션체크하여 만료면 로그아웃
	checkSessionLive();
	foreach($info['file_arr'] as $v) {
		if($_FILES[$v['name']][tmp_name]) {
			$file_sql_arr[] = "{$v['name']}='/data/adata/".UploadFile::uploadByType($_FILES[$v['name']],'adata')."'";
		} else if($_POST[$v['name']]) {
			$file_sql_arr[] = "{$v['name']}='".$_POST[$v['name']]."'";
		}
	}
	if($file_sql_arr) $file_sql = implode(',',$file_sql_arr).',';

	//CCL 처리
	if($_POST['ccl_author'] == 'by') {
		if($_POST['ccl_commercial']=='nc') $submission_add_data='BY-NC';
		else $submission_add_data='BY';
		if($_POST['ccl_edit']=='sa') $submission_add_data.='-SA';
		else if($_POST['ccl_edit']=='nd') $submission_add_data.='-ND';
	}else {
		$submission_add_data.='-';
	}

	//================ 신규 추가 ======================
	if(!$_POST['seq']) $step = 1;
	$md_qry = "";
	if($_POST['step'] == 10){
		$step = 11;
		$md_qry = " , modify_date = now() ";
	}
	if($_POST['step'] == 20){
		$step = 21;
		$md_qry = " , modify_date = now() ";
	}
	if($_POST['step'] == 32){
		$step = 33;
		$md_qry = " , modify_date = now() ";
	}
	if($_POST['step'] > 99){
		$step = $_POST['step']-99;
		$md_qry = " , modify_date = now() ";
	}
	$_chklist = implode('|',$_POST['chklist']);
	$field	 = "title				= '{$_POST['title']}',
				title_eng			= '{$_POST['title_eng']}',
				keyword				= '{$_POST['keyword']}',
				keyword_eng			= '{$_POST['keyword_eng']}',
				abstract			= '{$_POST['abstract']}',
				abstract_eng		= '{$_POST['abstract_eng']}',
				chklist = '{$_chklist}',
				express_publication	= '{$_POST['express_publication']}',
				manuscript			= '{$_POST['manuscript']}',
				review_category		= '{$_POST['review_category']}',
				review_category_target	= '{$_POST['review_category_target']}',
				step				= '{$step}',
				review_fee			= '{$_POST['fee']}',
				submission_add_data			= '{$submission_add_data}',
				{$file_sql}
				journal		= '{$_POST['journal']}' ";
	if($_POST['seq']){
		$sql = "UPDATE ad_paper SET {$field} {$md_qry} WHERE seq = '{$_POST['seq']}'";
		sql_query($sql);
		$parent_seq = $_POST['seq'];
		if(strlen($_POST['number']) == 1){
			$number = "00".$_POST['number'];
		}else if(strlen($_POST['number']) == 2){
			$number = "0".$_POST['number'];
		}else{
			$number = $_POST['number'];
		}
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} 투고논문 등록 완료  KA-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>{$member['mb_name']}님이 다음의 논문에 대한 심사결과에 대하여 수정한 원고를 등록하였습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='15'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub01_write.php?seq={$parent_seq}' target='_blank'>논문접수 등록 페이지로 이동</a></td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>원고 세부 사항</p>
		<p>제목 : {$_POST['title']}</p>
		<p>키워드 : {$_POST['keyword']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
		$body	 = eregi_replace("[\]",'',$body);
		##############
		$mail->MsgHTML($body);
		//$address = $member['mb_id'];
		//$mail->AddAddress($address, $member['mb_name']);
		$address = $main_editor;
		$mail->AddAddress($address,$info['editor_name']);
		if(!$mail->Send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;
			//디비에 실패 로그 기록
			$mail_sql = "insert into ad_mail_log set
				parent_seq	= '{$_POST['seq']}',
				mail_yn	= 'N',
				error_info	= '{$mail->ErrorInfo}',
				address	= '{$address}',
				regdate		= now()";
			sql_query($mail_sql);
		} else {
			//echo "Message sent!";
			//디비에 성공 로그 기록
			$mail_sql = "insert into ad_mail_log set
				parent_seq	= '{$_POST['seq']}',
				mail_yn	= 'Y',
				address	= '{$address}',
				regdate		= now()";
			sql_query($mail_sql);
		}
		##############
	}else{
		$sql = "INSERT INTO ad_paper SET
					{$field},
					mb_id		= '{$member['mb_id']}',
					mb_name		= '{$member['mb_name']}',
					regdate		= now()";
		sql_query($sql);
		$parent_seq = mysqlI_insert_id();
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} 투고논문 등록 완료</p>
		<p>편집 위원장님</p>
		<p>{$member['mb_name']}님이 다음의 논문의 원고를 등록하였습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='15'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub01_write.php?seq={$parent_seq}' target='_blank'>논문접수 등록 페이지로 이동</a></td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>원고 세부 사항</p>
		<p>제목 : {$_POST['title']}</p>
		<p>키워드 : {$_POST['keyword']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
		$body	 = eregi_replace("[\]",'',$body);
		##############
		$mail->MsgHTML($body);
		//$address = $member['mb_id'];
		//$mail->AddAddress($address, $member['mb_name']);
		$address = $main_editor;
		$mail->AddAddress($address, $info['editor_name']);
		if(!$mail->Send()) {
			//echo "Mailer Error: " . $mail->ErrorInfo;
			//디비에 실패 로그 기록
			$mail_sql = "insert into ad_mail_log set
				parent_seq	= '{$_POST['seq']}',
				mail_yn	= 'N',
				error_info	= '{$mail->ErrorInfo}',
				address	= '{$member['mb_id']}',
				regdate		= now()";
			sql_query($mail_sql);
		} else {
			//echo "Message sent!";
			//디비에 성공 로그 기록
			$mail_sql = "insert into ad_mail_log set
				parent_seq	= '{$_POST['seq']}',
				mail_yn	= 'Y',
				address	= '{$member['mb_id']}',
				regdate		= now()";
			sql_query($mail_sql);
		}
		##############
	}
	### AUTH
	$sql = "INSERT INTO ad_paper_auth_deleted SELECT * FROM ad_paper_auth WHERE parent_seq = '{$_POST['seq']}'";
	sql_query($sql);
	$sql = "DELETE FROM ad_paper_auth WHERE parent_seq = '{$_POST['seq']}'";
	$sql_result = sql_query($sql);
	if ($step < 2 || $sql_result){
		for($i=0 ; $i<count($_POST['auth_name']) ; $i++){
			if($_POST['auth_name'][$i]){
				$tmp		= "auth_type".$i;
				if($_POST[$tmp]) $auth_type	= implode("|", $_POST[$tmp]);
				$sql = "INSERT INTO ad_paper_auth SET
							parent_seq		= '{$parent_seq}',
							auth_type		= '{$auth_type}',
							auth_name		= '{$_POST['auth_name'][$i]}',
							auth_name_eng		= '{$_POST['auth_name_eng'][$i]}',
							auth_tel		= '{$_POST['auth_tel'][$i]}',
							auth_email		= '{$_POST['auth_email'][$i]}',
							auth_mobile		= '{$_POST['auth_mobile'][$i]}',
							organization	= '{$_POST['organization'][$i]}',
							organization_eng	= '{$_POST['organization_eng'][$i]}',
							address			= '{$_POST['address'][$i]}'
							ON DUPLICATE KEY UPDATE parent_seq		= '{$parent_seq}',
							auth_email		= '{$_POST['auth_email'][$i]}'
							";
				sql_query($sql);
			}
		}
	}
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./a_sub01.php";
}
### 회원관리
else if($_POST['mode']=="a_member"){
	$mb_hp = preg_replace_callback("/[^0-9]*/s", "", $_POST['mb_hp']);
	$chksql = "select * from g4_member where mb_no = '{$_POST['mb_no']}' and mb_password = '".sql_password($_POST['mb_password'])."'";
	$data = sql_query($chksql);
	$total_count0 = mysqlI_num_rows($data);
	if($total_count0 != '0'){
		$pass_sql = "";
		if($_POST['new_mb_password'] != ''){
			$pass_sql = "mb_password		= '".sql_password($_POST['new_mb_password'])."',";
		}
		$sql = "UPDATE g4_member SET
					{$pass_sql}
					mb_zip1			= '{$_POST['mb_zip1']}',
					mb_zip2			= '{$_POST['mb_zip2']}',
					mb_addr1		= '{$_POST['mb_addr1']}',
					mb_addr2		= '{$_POST['mb_addr2']}',
					mb_addr3		= '{$_POST['mb_addr3']}',
					mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
					mb_tel			= '{$_POST['mb_tel']}',
					mb_hp			= '{$mb_hp}',
					mb_1			= '{$_POST['mb_1']}',
					mb_2			= '{$_POST['mb_2']}'
				WHERE
					mb_no = '{$_POST['mb_no']}'";
		sql_query($sql);
		$msg		= "처리 되었습니다.";
		$returnUrl	= "./a_sub01.php";
	}else{
		$msg		= "비밀번호가 다릅니다. 올바른 비밀번호를 다시 입력해주세요.";
		$returnUrl	= "./a_member_write.php?mb_no={$_POST['mb_no']}";
	}
}
else if($_POST['mode']=="find_id"){
	$mb_hp = preg_replace_callback("/[^0-9]*/s", "", $_POST['mb_hp']);
	$fidsql = "select * from g4_member where mb_name = '{$_POST['mb_name']}' and mb_hp = '{$mb_hp}'";
	$data	= sql_fetch($fidsql);
	$result = sql_query($fidsql);
	$total_count = mysqlI_num_rows($result);
	if($total_count == 1){
		$msg = $_POST['mb_name']."님의 아이디는 ".$data['mb_id']." 입니다.";
		$returnUrl	= "./login.php";
	}else{
		$msg =  "입력하신 이름, 핸드폰 번호와 일치하는 아이디가 없습니다. 확인 후 다시 입력 해주세요.";
		$returnUrl	= "./find_info.php";
	}
}
else if($_POST['mode']=="find_pwd"){
	$email = $_POST['mb_id'];
	$fpwdsql = "select * from g4_member where mb_id = '{$email}'";
	$data	= sql_fetch($fpwdsql);
	$result = sql_query($fpwdsql);
	$row = sql_fetch_array($result);
	$total_count = mysqlI_num_rows($result);
	if($total_count == 1){
		$enc_pw=md5($row['mb_password']);
		$content = <<<MAIL
{$mail_header}
<div style="word-wrap: break-word; word-break: break-all;">
<p style="font-size:12pt">
비밀번호를 변경하시려면 아래 링크를 클릭해주시기 바랍니다.<br><br>
<a href="http://{$_SERVER['HTTP_HOST']}/admin/changepw.php?a={$email}&b={$enc_pw}" target='_blank'>Change password</a><br>
<br><br>
감사합니다.<br>
<br>
{$mail_footer}
MAIL;
		$body2	 = preg_replace_callback("[\]",'',$content);
		##############
		$mail->ClearAllRecipients( );
		$mail->MsgHTML($body2);
		//투고자메일주소
		$address = $email;
		$mail->AddAddress($address, $row['mb_name']);
		$mail->Subject    = "{$info['institute_title']} 논문투고시스템 비밀번호 변경 안내입니다.";
		if(!$mail->Send()) {
			$mail_sql = "insert into ad_mail_log set
				mail_yn	= 'N',
				error_info	= '{$mail->ErrorInfo}',
				address	= '{$row['mb_id']}',
				regdate		= now()";
			sql_query($mail_sql);
			$msg = "발송이 취소되었습니다. 관리자 문의바랍니다.";
			$returnUrl	= "./login.php";
		} else {
			$mail_sql = "insert into ad_mail_log set
				mail_yn	= 'Y',
				address	= '{$row['mb_id']}',
				regdate		= now()";
			sql_query($mail_sql);
			$msg = $row['mb_name']." 님. 비밀번호 변경 메일이 발송되었습니다.";
			$returnUrl	= "./login.php";
		}
		##############
	}else{
		$msg =  "입력하신 이름, 이메일과 일치하는 정보가 없습니다. 확인 후 다시 입력 해주세요.";
		$returnUrl	= "./find_info.php";
	}
}
else if($_POST['mode']=="a_member_pwchange"){
	$pass_sql = "";
	if($_POST['new_mb_password']==$_POST['re_mb_password'] && $_POST['mb_no']){
		if($_POST['new_mb_password'] != ''){
			$pass_sql = "mb_password		= '".sql_password($_POST['new_mb_password'])."'";
		}
		$sql = "UPDATE g4_member SET {$pass_sql} WHERE mb_no = '{$_POST['mb_no']}' AND md5(mb_password)='{$_POST['old_password']}'";
		sql_query($sql);
		$msg		= "변경되었습니다.";
		$returnUrl	= "./";
	}else{
		$msg		= "비밀번호가 일치하지 않습니다.";
		$returnUrl	= "./admin/find_info.php";
	}
}
else if($_POST['mode']=="delete_auth"){
	$sql = "INSERT INTO ad_paper_auth_deleted
					SELECT * FROM ad_paper_auth WHERE
					auth_seq			= '{$_POST['auth_seq']}'";
	sql_query($sql);
	$sql = "DELETE FROM ad_paper_auth WHERE
					auth_seq			= '{$_POST['auth_seq']}'";
	sql_query($sql);
	$msg		= "삭제 되었습니다.";
	$returnUrl	= "./a_sub01_write.php?seq={$_POST['seq']}";
}
###
alert($msg, $returnUrl);
?>
