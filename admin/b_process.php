<?
include_once("./_common.php");
### 메일 관련 코드
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
$mail->SetFrom($main_editor,$info['editor_name']);
$mail->Subject    = "안녕하세요. {$info['institute_title']}입니다.";
//Custom sql 생성
require_once('class/class.CustomSql.php');
$customque = new CustomSql($mysql_host, $mysql_user, $mysql_password, $mysql_db);
//Upload 용 class
require_once('class/class.UploadFile.php');
##################
### C :: 학습지 저널등록
$file_sql = "";
$file_sql2 = "";
$file_sql3 = "";
$rstep = 1;
if($_POST['mode']=="c_sub_review"){
	if($_FILES['review_file'][tmp_name]) {
		$sfilename = UploadFile::uploadByType($_FILES['review_file'],'bdata');
		$file_sql = " rfile	= '/data/bdata/{$sfilename}', ";
	}
	if($_FILES['review_table'][tmp_name]) {
		$sfilename = UploadFile::uploadByType($_FILES['review_table'],'bdata');
		$file_sql2 = " mfile	= '/data/bdata/{$sfilename}', ";
	}
	if($_FILES['author_file'][tmp_name]) {
		$sfilename = UploadFile::uploadByType($_FILES['author_file'],'authorinfo');
		$file_sql3 = " authorfile	= '/data/authorinfo/{$sfilename}', ";
	}
	if($_POST['step'] == 14) {
		$rstep = 2;
	}
	if($_POST['step'] == 24) {
		$rstep = 3;
	}
	$score_arr = array();
	for($i=1;$i<11;$i++) array_push($score_arr,$_POST['q'.$i]);
	$score = implode('|',$score_arr);
	$sql = "insert into ad_paper_review set
				parent_seq		= '{$_POST['seq']}',
				type = '{$_POST['type']}',
				score			= '{$score}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				{$file_sql2}
				{$file_sql3}
				mb_id		= '{$_POST['mb_id']}',
				mb_name		= '{$_POST['mb_name']}',
				rstep		= '{$rstep}',
				regdate		= now()";
	/* 리뷰 중복 등록 방지 hjshyo 151030 */
	$que = "SELECT rseq FROM ad_paper_review WHERE parent_seq='{$_POST['seq']}' AND mb_id='{$_POST['mb_id']}' AND rstep='{$rstep}'";
	$re = sql_fetch($que);
	if(empty($re)) sql_query($sql);
	/* 리뷰 중복 등록 방지 hjshyo 151030 끝*/
	###
	$sql = "select * from ad_paper where seq = '{$_POST['seq']}'";
	$data	= sql_fetch($sql);
	if($data['review_a_user']==$_POST['mb_id']){
		$qry = " review_a_step = '{$rstep}', review_a_result = '{$_POST['result']}' ";
	}
	if($data['review_b_user']==$_POST['mb_id']){
		$qry = " review_b_step = '{$rstep}', review_b_result = '{$_POST['result']}' ";
	}
	if($data['review_c_user']==$_POST['mb_id']){
		$qry = " review_c_step = '{$rstep}', review_c_result = '{$_POST['result']}' ";
	}
	$sql = "update ad_paper set {$qry} where seq = '{$_POST['seq']}'";
	//echo $sql."<br>";
	sql_query($sql);
	$sql = "select * from ad_paper where seq = '{$_POST['seq']}'";
	$data	= sql_fetch($sql);
	###
	$step = "";
	if($_POST['step'] == 24){
		$sql = "select count(rseq) as cnt from ad_paper_review where parent_seq = '{$_POST['seq']}' and rstep = 2 and (result = 2 or result = 3)";
		$chk	= sql_fetch($sql);
		$sql = "select count(rseq) as cnt from ad_paper_review where parent_seq = '{$_POST['seq']}' and rstep = 3";
		$chk2	= sql_fetch($sql);
		//if($cnt > 7) $step = " , step = 25 ";
		if($chk['cnt']==$chk2['cnt']) $step = " step = 25 ";
	}else if($_POST['step'] == 14){
		$sql = "select count(rseq) as cnt from ad_paper_review where parent_seq = '{$_POST['seq']}' and rstep = 1 and (result = 2 or result = 3)";
		$chk	= sql_fetch($sql);
		$sql = "select count(rseq) as cnt from ad_paper_review where parent_seq = '{$_POST['seq']}' and rstep = 2";
		$chk2	= sql_fetch($sql);
		if($chk['cnt']==$chk2['cnt']) $step = " step = 15 ";
		else $step = " step = 14 ";
	}else{
		$sql = "SELECT count(rseq) as cnt FROM `ad_paper_review` WHERE `parent_seq` = '{$_POST['seq']}' AND `rstep` = '1'";
		$check_review_fin	= sql_fetch($sql);
		if($check_review_fin['cnt'] == 3) $step = " step = 5 ";
	}
	if($step){
		$sql = "update ad_paper set {$step} where seq = '{$_POST['seq']}'";
		sql_query($sql);
	}
	$result = get_result($_POST['result']);
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
		<p>{$info['institute_title']} {$rstep}차 논문 심사 완료 KJ-14-{$number}</p>
		<p>편집간사님</p>
		<p>심사위원 {$_POST['mb_name']}님이 다음의 논문에 대한 {$rstep}차 심사 결과를 등록하였습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='15'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub04_write.php?seq={$_POST['seq']}' target='_blank'>심사위원 검토 페이지로 이동</a></td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>원고 세부 사항</p>
		<p>제목 : {$_POST['title']}</p>
		<p>키워드 : {$_POST['keyword']}</p>
		<p>심사결과 : {$result}</p>
		<p>코멘트 : {$_POST['comments']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
	$body	 = preg_replace ("[\]",'',$body);
	##############
	$mail->MsgHTML($body);
	//편집간사 이메일
	//$address = $_POST['review_a_user'];
	//$mail->AddAddress($address, $_POST['review_a_name']);
	$address = $main_editor;
	$mail->AddAddress($address, $info['editor_name']);
	if(!$mail->Send()) {
		//echo "Mailer Error: " . $mail->ErrorInfo;
		//디비에 실패 로그 기록
		$mail_sql = "insert into ad_mail_log set
					parent_seq	= '{$_POST['seq']}',
					mail_yn	= 'N',
					error_info	= '{$mail->ErrorInfo}',
					address	= '{$main_editor}',
					regdate		= now()";
		sql_query($mail_sql);
	} else {
		//echo "Message sent!";
		//디비에 성공 로그 기록
		$mail_sql = "insert into ad_mail_log set
					parent_seq	= '{$_POST['seq']}',
					mail_yn	= 'Y',
					address	= '{$main_editor}',
					regdate		= now()";
				sql_query($mail_sql);
	}
	##############
	###
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./b_sub01.php";
} else if($_POST['mode']=="b_review_modify"){
	$score_arr = array();
	for($i=1;$i<7;$i++) array_push($score_arr,$_POST['q'.$i]);
	$score = implode('|',$score_arr);
	$que = "UPDATE ad_paper_review SET
				score			= '{$score}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				regdate		= now()
				WHERE rseq='{$_POST['rseq']}';
	";
	sql_query($que);
	if (mysqli_error()) {
		$msg		= "에러가 발생되었습니다.";
	}else {
		$msg		= "처리 되었습니다.";
	}
	$returnUrl	= "./b_sub02.php";
}
###
alert($msg, $returnUrl);
?>
