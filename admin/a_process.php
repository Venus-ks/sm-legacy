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
<table width='750' border='0' cellspacing='0' cellpadding='0'><tr><td height='85' align='center' valign='top'><img src='http://{$_SERVER['HTTP_HOST']}/images/mail_title.png' width='750' height='65' /></td></tr><tr><td height='15'></td></tr>
<tr><td height='50' align='left' valign='top'>
HTML;
$mail_footer = <<<HTML
<table width='750' border='0' cellspacing='0' cellpadding='0' style="background-color: #FFF;">
<tr>
<td width='240' height='80'><img src='http://{$_SERVER['HTTP_HOST']}/images/logo.png' /></td>
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
	$file_sql = "";
	if($_FILES['submission_data'][tmp_name]){
		$tmp_file	= $_FILES['submission_data'][tmp_name];
		$filesize	= $_FILES['submission_data'][size];
		$filename	= $_FILES['submission_data'][name];
		$filename	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/adata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['submission_data'][error]);
		}
		$file_sql = " submission_data	= '/data/adata/{$sfilename}', ";
	}
	$file_sql2 = "";
	if($_FILES['submission_data2'][tmp_name]){
		$tmp_file2	= $_FILES['submission_data2'][tmp_name];
		$filesize2	= $_FILES['submission_data2'][size];
		$filename2	= $_FILES['submission_data2'][name];
		$filename2	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename2);
		$rfilename2	= iconv("utf-8", "euc-kr", $filename2);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename2 = time().$mcrtime[0]."^".$rfilename2;
		$dest_file2 = "$g4[path]/data/adata/".$rfilename2;
		$sfilename2 = iconv("euc-kr", "utf-8", $rfilename2);
		if (is_uploaded_file($tmp_file2)){
			$error_code2 = move_uploaded_file($tmp_file2, $dest_file2) or die($_FILES['submission_data2'][error]);
		}
		$file_sql2 = " submission_data2	= '/data/adata/{$sfilename2}', ";
	}
	//연구윤리서약 동의
	$file_sql3 = "";
	if($_FILES['submission_data3'][tmp_name]) {
		$file_sql3 = " submission_data3	= '/data/adata/".UploadFile::uploadByType($_FILES['submission_data3'],'adata')."', ";
	}

	/* $file_sql4 = "";
	if($_FILES['submission_add_data'][tmp_name]){
		$tmp_file4	= $_FILES['submission_add_data'][tmp_name];
		$filesize4	= $_FILES['submission_add_data'][size];
		$filename4	= $_FILES['submission_add_data'][name];
		$filename4	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename4);
		$rfilename4	= iconv("utf-8", "euc-kr", $filename4);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename4 = time().$mcrtime[0]."^".$rfilename4;
		$dest_file4 = "$g4[path]/data/adata/".$rfilename4;
		$sfilename4 = iconv("euc-kr", "utf-8", $rfilename4);
		if (is_uploaded_file($tmp_file4)){
			$error_code4 = move_uploaded_file($tmp_file4, $dest_file4) or die($_FILES['submission_add_data'][error]);
		}
		$file_sql4 = " submission_add_data	= '/data/adata/{$sfilename4}', ";
	} */
	$file_sql5 = "";
	if($_FILES['response_data'][tmp_name]){
		$tmp_file5	= $_FILES['response_data'][tmp_name];
		$filesize5	= $_FILES['response_data'][size];
		$filename5	= $_FILES['response_data'][name];
		$filename5	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename5);
		$rfilename5	= iconv("utf-8", "euc-kr", $filename5);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename5 = time().$mcrtime[0]."^".$rfilename5;
		$dest_file5 = "$g4[path]/data/adata/".$rfilename5;
		$sfilename5 = iconv("euc-kr", "utf-8", $rfilename5);
		if (is_uploaded_file($tmp_file5)){
			$error_code5 = move_uploaded_file($tmp_file5, $dest_file5) or die($_FILES['response_data'][error]);
		}
		$file_sql5 = " response_data	= '/data/adata/{$sfilename5}', ";
	}
	//================ 신규 추가 ======================
	$file_sql6 = "";
	if($_FILES['response_data_b'][tmp_name]){
		$tmp_file6	= $_FILES['response_data_b'][tmp_name];
		$filesize6	= $_FILES['response_data_b'][size];
		$filename6	= $_FILES['response_data_b'][name];
		$filename6	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename6);
		$rfilename6	= iconv("utf-8", "euc-kr", $filename6);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename6 = time().$mcrtime[0]."^".$rfilename6;
		$dest_file6 = "$g4[path]/data/adata/".$rfilename6;
		$sfilename6 = iconv("euc-kr", "utf-8", $rfilename6);
		if (is_uploaded_file($tmp_file6)){
			$error_code6 = move_uploaded_file($tmp_file6, $dest_file6) or die($_FILES['response_data_b'][error]);
		}
		$file_sql6 = " response_data_b	= '/data/adata/{$sfilename6}', ";
	}
	$file_sql7 = "";
	if($_FILES['response_data_c'][tmp_name]){
		$tmp_file7	= $_FILES['response_data_c'][tmp_name];
		$filesize7	= $_FILES['response_data_c'][size];
		$filename7	= $_FILES['response_data_c'][name];
		$filename7	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename7);
		$rfilename7	= iconv("utf-8", "euc-kr", $filename7);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename7 = time().$mcrtime[0]."^".$rfilename7;
		$dest_file7 = "$g4[path]/data/adata/".$rfilename7;
		$sfilename7 = iconv("euc-kr", "utf-8", $rfilename7);
		if (is_uploaded_file($tmp_file7)){
			$error_code7 = move_uploaded_file($tmp_file7, $dest_file7) or die($_FILES['response_data_c'][error]);
		}
		$file_sql7 = " response_data_c	= '/data/adata/{$sfilename7}', ";
	}
	$file_sql8 = "";
	if($_FILES['response_data_d'][tmp_name]){
		$tmp_file8	= $_FILES['response_data_d'][tmp_name];
		$filesize8	= $_FILES['response_data_d'][size];
		$filename8	= $_FILES['response_data_d'][name];
		$filename8	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename8);
		$rfilename8	= iconv("utf-8", "euc-kr", $filename8);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename8 = time().$mcrtime[0]."^".$rfilename8;
		$dest_file8 = "$g4[path]/data/adata/".$rfilename8;
		$sfilename8 = iconv("euc-kr", "utf-8", $rfilename8);
		if (is_uploaded_file($tmp_file8)){
			$error_code8 = move_uploaded_file($tmp_file8, $dest_file8) or die($_FILES['response_data_d'][error]);
		}
		$file_sql8 = " response_data_d	= '/data/adata/{$sfilename8}', ";
	}
	$file_sql9 = "";
	if($_FILES['response_data_e'][tmp_name]){
		$tmp_file9	= $_FILES['response_data_e'][tmp_name];
		$filesize9	= $_FILES['response_data_e'][size];
		$filename9	= $_FILES['response_data_e'][name];
		$filename9	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename9);
		$rfilename9	= iconv("utf-8", "euc-kr", $filename9);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename9 = time().$mcrtime[0]."^".$rfilename9;
		$dest_file9 = "$g4[path]/data/adata/".$rfilename9;
		$sfilename9 = iconv("euc-kr", "utf-8", $rfilename9);
		if (is_uploaded_file($tmp_file9)){
			$error_code9 = move_uploaded_file($tmp_file9, $dest_file9) or die($_FILES['response_data_e'][error]);
		}
		$file_sql9 = " response_data_e	= '/data/adata/{$sfilename9}', ";
	}
	$file_sql10 = "";
	if($_FILES['submission_cover_data'][tmp_name]){
		$tmp_file10	= $_FILES['submission_cover_data'][tmp_name];
		$filesize10	= $_FILES['submission_cover_data'][size];
		$filename10	= $_FILES['submission_cover_data'][name];
		$filename10	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename10);
		$rfilename10	= iconv("utf-8", "euc-kr", $filename10);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename10 = time().$mcrtime[0]."^".$rfilename10;
		$dest_file10 = "$g4[path]/data/adata/".$rfilename10;
		$sfilename10 = iconv("euc-kr", "utf-8", $rfilename10);
		if (is_uploaded_file($tmp_file10)){
			$error_code10 = move_uploaded_file($tmp_file10, $dest_file10) or die($_FILES['submission_cover_data'][error]);
		}
		$file_sql10 = " submission_cover_data	= '/data/adata/{$sfilename10}', ";
	}
	$file_sql11 = "";
	if($_FILES['submission_data4'][tmp_name]){
		$tmp_file11	= $_FILES['submission_data4'][tmp_name];
		$filesize11	= $_FILES['submission_data4'][size];
		$filename11	= $_FILES['submission_data4'][name];
		$filename11	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename11);
		$rfilename11	= iconv("utf-8", "euc-kr", $filename11);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename11 = time().$mcrtime[0]."^".$rfilename11;
		$dest_file11 = "$g4[path]/data/adata/".$rfilename11;
		$sfilename11 = iconv("euc-kr", "utf-8", $rfilename11);
		if (is_uploaded_file($tmp_file11)){
			$error_code11 = move_uploaded_file($tmp_file11, $dest_file11) or die($_FILES['submission_data4'][error]);
		}
		$file_sql11 = " submission_data4	= '/data/adata/{$sfilename11}', ";
	}
	$file_sql12 = "";
	if($_FILES['submission_data5'][tmp_name]){
		$tmp_file12	= $_FILES['submission_data5'][tmp_name];
		$filesize12	= $_FILES['submission_data5'][size];
		$filename12	= $_FILES['submission_data5'][name];
		$filename12	= preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename12);
		$rfilename12	= iconv("utf-8", "euc-kr", $filename12);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename12 = time().$mcrtime[0]."^".$rfilename12;
		$dest_file12 = "$g4[path]/data/adata/".$rfilename12;
		$sfilename12 = iconv("euc-kr", "utf-8", $rfilename12);
		if (is_uploaded_file($tmp_file12)){
			$error_code12 = move_uploaded_file($tmp_file12, $dest_file12) or die($_FILES['submission_data5'][error]);
		}
		$file_sql12 = " submission_data5	= '/data/adata/{$sfilename12}', ";
	}
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
	if($_POST['step'] == 10 || ($_POST['step'] == 99 && $_POST['number'])){
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
				{$file_sql2}
				{$file_sql3}
				{$file_sql4}
				{$file_sql5}
				{$file_sql6}
				{$file_sql7}
				{$file_sql8}
				{$file_sql9}
				{$file_sql10}
				{$file_sql11}
				{$file_sql12}
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
		$parent_seq = mysql_insert_id();
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
	$mb_hp = preg_replace("/[^0-9]*/s", "", $_POST['mb_hp']);
	$chksql = "select * from g4_member where mb_no = '{$_POST['mb_no']}' and mb_password = '".sql_password($_POST['mb_password'])."'";
	$data = sql_query($chksql);
	$total_count0 = mysql_num_rows($data);
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
	$mb_hp = preg_replace("/[^0-9]*/s", "", $_POST['mb_hp']);
	$fidsql = "select * from g4_member where mb_name = '{$_POST['mb_name']}' and mb_hp = '{$mb_hp}'";
	$data	= sql_fetch($fidsql);
	$result = sql_query($fidsql);
	$total_count = mysql_num_rows($result);
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
	$total_count = mysql_num_rows($result);
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
		$body2	 = eregi_replace("[\]",'',$content);
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
