<?php
if(defined('__DEV__')) error_reporting(E_ALL);
error_reporting(0);
include_once("./_common.php");
include_once("./class/class.UploadFile.php");
### 메일 관련 코드
date_default_timezone_set('Asia/Seoul');
require_once('class.phpmailer.php'); // phpmailer ext module class
require_once('class/class.MailSender.php'); // phpmailer override class by hjshyo
$mysqlconn = new Mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
// 메일 클래스 설정
$mail = new GoogleTemplateMailer();
$mail->SMTPDebug  = NULL;
// enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->Dbconn = $mysqlconn;
if(!defined('__DEV__')) $mail->Username = $info['smtp_id']; // SMTP account username
if(!defined('__DEV__')) $mail->Password = $info['smtp_pw']; // SMTP account password
if(!defined('__DEV__')) $mail->SetFrom($info['editor_email'], $info['institute_title']);
else $mail->SetFrom($info['editor_email'], '테스트서버');
//넘버일련번호 지정
$number = str_pad($_POST['number'],3,'0',STR_PAD_LEFT);
//id 발송시 PECERA 고유번호 발급시 년도 정보 생성
$id_year=date('y');
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

##################
### D :: 논문투고 등록
if($_POST['mode']=="d_sub_reg"){
	$file_sql = "";
	if($_FILES['modify_file'][tmp_name]) {
		$file_sql = " , modify_file	= '/data/ddata/".UploadFile::uploadByType($_FILES['modify_file'],'ddata')."' ";
	} else {
		$file_sql = " , modify_file	= '{$_POST['modify_file_temp']}' ";
	}
	if($_FILES['response_data'][tmp_name]) {
		$file_sql .= " , response_data	= '/data/adata/".UploadFile::uploadByType($_FILES['response_data'],'adata')."' ";
	}
	$step = 3;
	if($_POST['step'] == 11){
		$step = 13;
	}
	if($_POST['step'] == 21){
		$step = 31;
	}
	if($_POST['step'] == 33){
		$step = 34;
	}
	$sql2 = "SELECT MAX(number) AS maxnum FROM ad_paper";
	$datas	= sql_fetch($sql2);
	$seq_number = $datas['maxnum']+1;
	if($_POST['step'] == 1) {
		$num_sql = " , number = '{$seq_number}' ";
	}
	### =================================================================
	$modify_cnt = 0;
	$total_result = 0;
	$i = 0;
	## 편집위원장의 심사결과가 있는지 확인함. 여러번의 심사가 있을 경우 맨 마지막의 심사결과만 가져옴.
	$fr_result	= sql_fetch("select * from ad_paper_review where parent_seq = '{$_POST['seq']}' and rstep = 4 order by rseq desc limit 1");
	## 심사 결과가 있으면...
	// 편집위원장 메일 주소 가지고 오기. 편집위원장의 카테고리 분야에 따라 메일 주소를 가지고 와서 발송 함.
	if($fr_result['result'] == '3') {
		sql_query("UPDATE ad_paper SET settle_date = now(), step = 34 {$file_sql} WHERE seq = '{$_POST['seq']}'");
		## 수정 후 재심사는 편집위원장에게 메일 발송하고 편집위원장 심사 단계 진행. step 34
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 요청 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님께 ($review_category_mailaddress)</p>
		<p>안녕하세요?</p>
		<p>아래의 원고가 완료되었기에 논문 확인요청을 드립니다. 원고를 보시고 심사 의견대로 수정이 잘 이루어졌는지, 혹은 수정이 미흡하여 추가로 수정해야 하는지 확인 부탁드립니다. 논문에 대한 자세한 내용을 확인 하시려면 아래 링크를 클릭하신 후 진행하시거나, 온라인투고시스템에 편집위원장 아이디로 로그인 하신 후 이용하시기 바랍니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr>
		<td height='51' align='center' valign='middle'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub09_write.php?seq={$_POST['seq']}' target='_blank'>투고논문 확인</a></td>
		</tr>
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
		$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 최종논문 검토 요청");
	}else if($fr_result['result'] == '2' || (!$fr_result['result'] && $_POST['review_score'] == '2')) {
		sql_query("UPDATE ad_paper SET settle_date = now(), step = 50 {$file_sql} WHERE seq = '{$_POST['seq']}'");
		## 수정 후 게재가는 메일 발송 없이 최종 결과 등록으로 이동. step 50
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>&nbsp; 편집위원장님에 의해 '수정 후 게재가'로 최종 심사완료 된 논문이 저자에 의해서 최종 수정 완료 되었습니다. </p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='15'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub05_write.php?seq={$_POST['seq']}' target='_blank'>최종결과등록 페이지로 이동</a></td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>제목 : {$_POST['title']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
		$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}");
	} else {
		sql_query("UPDATE ad_paper SET review_category_target = '{$_POST['review_category_target']}', manuscript = '{$_POST['manuscript']}', submit_date = now(), step = {$step} {$num_sql} {$file_sql} WHERE seq = '{$_POST['seq']}'");
		if($_POST['step'] == 1) {
			########
			$body = "
				{$mail_header}
				<p>{$info['institute_title']} [{$info['journal_title']}] 심사위원 추천의뢰 {$info['abbr']}-{$id_year}-{$number}</p>
				<p>편집위원장님께  {$review_category_mailaddress}</p>
				<p>안녕하세요?</p>
				<p>아래와 같이 본 {$info['institute_title']}지에 투고된 `{$_POST['title']}`에 대한 심사위원 3분을 추천해 주시기 바랍니다. 논문에 대한 자세한 내용을 확인 하시려면 아래 링크를 클릭하신 후 진행하시거나, 온라인투고시스템에 편집위원장 아이디로 로그인 하신 후 추천하시기 바랍니다.</p>
				<tr><td height='15'></td></tr>
				<tr>
				<td height='51' align='center' valign='middle'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub02_write.php?seq={$_POST['seq']}' target='_blank'>투고논문 확인</a></td>
				</tr>
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
			$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 심사위원 추천의뢰 {$info['abbr']}-{$id_year}-{$number}");
			##### 접수시에 투고자에게도 메일이 가야 함. =====
			$body2 = "
				{$mail_header}
				안녕하십니까. {$info['institute_title']} [{$info['journal_title']}] 편집위원회입니다.
				<br/>
				<p>
				귀하께서 「{$info['journal_title']}」에 투고해주신 논문은 정상적으로 접수 처리되었으며,
				심사가 완료되는대로 다시 이메일로 공지드리겠습니다.
				(약 4~5주 가량 소요되며, 투고시스템에서 심사현황을 수시로 확인하실 수 있습니다.)
				</p>
				<p>
				논문투고자(공동저자 포함)는 저희 학회규정상 {$info['institute_title']} 회원이어야 하며, 미납회비가 없어야 합니다. 따라서 아직 회원이 아니신 경우 회원가입을 해주시고, 회원이신 경우 미납회비가 없는지 확인하여 주시기 바랍니다.
				</p>
				<p>
				회원가입 및 미납회비와 관련된 사항은 {$info['institute_title']} 사무국에서 확인하실 수 있습니다.
				</p>
				{$info['bank_comment']}
				<br/>
				감사합니다.
							<tr><td height='15'></td></tr>
							<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
				{$mail_footer}
			";
			$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body2, "[{$info['journal_title']}] 논문접수 등록완료({$_POST['mb_name']} 귀하) {$info['abbr']}-{$id_year}-{$number}");
		}
	}
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub01.php";
}
else if($_POST['mode']=="d_sub2_reg"){
	$step = "";
	$cnt = 0;
	$review_category_target = get_category($_POST['review_category_target']);
	// 편집위원장 메일 주소 가지고 오기. 편집위원장의 카테고리 분야에 따라 메일 주소를 가지고 와서 발송 함.
	foreach(array('a','b','c') as $v) {
		if($_POST['review_'.$v.'_user']){
			$cnt++;
			if((strpos($_POST['express_publication'],"General")>0)){
				$range = "14일";
			}else{
				$range = "7일";
			}
			##############
			$body = "
			{$mail_header}
			<p>{$_POST['review_'.$v.'_name']} 심사위원님께</p>
			<p>안녕하세요?</p>
			<p>&nbsp;아래와 같이 본 학회 {$info['institute_title']}지에 투고된 논문에 대해 편집위원장께서 귀하를 추천해 주셨으며, 이에 귀하에게 심사의뢰를 요청 드립니다. 귀하의 수락여부를 가능한 빨리 알려 주시기 바랍니다. 이 작업을 수행하시려면 온라인투고시스템에 등록하신 후 로그인 하거나, 아래 링크를 클릭하신 후 작업을 진행하시기 바랍니다.</p>
			</td></tr>
			<tr><td height='15'></td></tr>
			<tr>
			<td height='51' align='center' valign='middle'><a href='http://{$_SERVER['HTTP_HOST']}/admin/reviewer_check.php?seq={$_POST['seq']}&review_user={$_POST['review_'.$v.'_user']}' target='_blank'>논문심사수락여부확인</a></td>
			</tr>
			<tr><td height='15'></td></tr>
			<tr><td height='20' align='left' valign='top'>
			<p>[{$info['journal_title']}]가 수준 높은 학술지가 될 수 있도록 당신의 현재 및 향후 참여에 대해 감사드립니다.</p>
			</td></tr>
			<tr><td height='51' align='left' valign='top'>
			<p>원고 세부 사항</p>
			<p>제목 : {$_POST['title']}</p>
			<p>키워드 : {$_POST['keyword']}</p>
			</td></tr>
			<tr><td height='15'></td></tr>
			<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
			{$mail_footer}
			";
			$mail->sendInput($_POST['review_'.$v.'_user'], $_POST['review_'.$v.'_name'], $body, "[{$info['journal_title']}] 투고 논문 심사 의뢰({$_POST['review_'.$v.'_name']} 귀하)");
			##############
			$reviewer_sql_{$v} = "insert into ad_reviewer_log set
					parent_seq	= '{$_POST['seq']}',
					review_user	= '{$_POST['review_'.$v.'_user']}',
					review_name	= '{$_POST['review_'.$v.'_name']}',
					regdate		= now()";
			sql_query($reviewer_sql_{$v});
		}
	}
	if($cnt > 2) $step = " step = 3, ";
	$sql = "UPDATE ad_paper SET
				review_a_user		= '{$_POST['review_a_user']}',
				review_b_user		= '{$_POST['review_b_user']}',
				review_c_user		= '{$_POST['review_c_user']}',
				{$step}
				review_a_date		= '{$_POST['review_a_date']}',
				review_b_date		= '{$_POST['review_b_date']}',
				review_c_date		= '{$_POST['review_c_date']}'
			WHERE
				seq = '{$_POST['seq']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub02.php";
}
else if($_POST['mode']=="d_sub3_reg"){
	$sql = "select * from ad_paper where seq = '{$_POST['seq']}'";
	$data	= sql_fetch($sql);
	$step	= "";
	$cnt	= 0;
	if(($data['review_a_conf']!='Y' || $data['review_b_conf']!='Y' || $data['review_c_conf']!='Y') && $data['step']!='13') {
			$msg		= "심사위원을 3명 모두 선택바랍니다.";
			$returnUrl	= "./d_sub03_write.php?seq={$_POST['seq']}";
			alert($msg, $returnUrl);
	}
	$file_sql = array();
	for($ii=1;$ii<7;$ii++) {
		if($_FILES['review_offcial_doc'.$ii][tmp_name]){
			$tmp_file  = $_FILES['review_offcial_doc'.$ii][tmp_name];
			$filesize  = $_FILES['review_offcial_doc'.$ii][size];
			$filename  = $_FILES['review_offcial_doc'.$ii][name];
			$filename  = preg_replace('/(\s|\<|\>|\=|\(|\)|\`|\')/', '_', $filename);
			$rfilename	= iconv("utf-8", "euc-kr", $filename);
			//중복 파일 방지를 위해 타임스탬프를 붙인다.
			$mcrtime = explode(' ',microtime());
			$mcrtime[0] = substr($mcrtime[0],2,6);
			$rfilename = time().$mcrtime[0]."^".$rfilename;
			$dest_file = "$g4[path]/data/ddata/".$rfilename;
			$sfilename = iconv("euc-kr", "utf-8", $rfilename);
			if (is_uploaded_file($tmp_file)){
				$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['review_offcial_doc'.$ii][error]);
			}
			$file_sql[$ii] = "  review_offcial_doc{$ii}	= '/data/ddata/{$sfilename}',";
		}
	}
	if($_POST['step'] == 3) $step = " step = 4, ";
	if($_POST['step'] == 13) $step = " step = 14, ";
	if($_POST['step'] == 23) $step = " step = 24, ";
	//날짜 미지정시
	$review_limit_date = date("Y-m-d",strtotime("+2 week",time()));
	if(!$_POST['review_a_date']) $_POST['review_a_date'] = $review_limit_date;
	if(!$_POST['review_b_date']) $_POST['review_b_date'] = $review_limit_date;
	if(!$_POST['review_c_date']) $_POST['review_c_date'] = $review_limit_date;
	$sql = "UPDATE ad_paper SET
				{$file_sql[1]}
				{$file_sql[2]}
				{$file_sql[3]}
				{$file_sql[4]}
				{$file_sql[5]}
				{$file_sql[6]}
				review_a_user		= '{$_POST['review_a_user']}',
				review_b_user		= '{$_POST['review_b_user']}',
				review_c_user		= '{$_POST['review_c_user']}',
				{$step}
				review_a_date		= '{$_POST['review_a_date']}',
				review_b_date		= '{$_POST['review_b_date']}',
				review_c_date		= '{$_POST['review_c_date']}'
			WHERE
				seq = '{$_POST['seq']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub03.php";
}
else if($_POST['mode']=="d_sub3_reg_email"){
	$doctype = $_POST['doctype'];
	if($_FILES[$doctype][tmp_name]){
		$tmp_file  = $_FILES[$doctype][tmp_name];
		$filesize  = $_FILES[$doctype][size];
		$filename  = $_FILES[$doctype][name];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/bdata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES[$doctype][error]);
		}
		$file_sql = "{$doctype}	= '/data/bdata/{$sfilename}' ";
	}
	$seq = $_POST['seq'];
	$review_user = $_POST['review_user'];
	$review_name = get_review_name($_POST['review_user']);
	$review_category_target = get_category($_POST['review_category_target']);
	##############
	#메일 보내기 선택시 ad_reviewer_log 테이블에 해당 논문의 심사위원이 없을 경우에는 해당 심사위원을 추가함.
	$reviewer_chk_sql = "select count(*) as cnt from ad_reviewer_log where parent_seq = '{$seq}' and review_user = '{$review_user}'";
	$chk_data	= sql_fetch($reviewer_chk_sql);
	if($chk_data['cnt'] == "0"){
		$reviewer_sql_a = "insert into ad_reviewer_log set
				parent_seq	= '{$seq}',
				review_user	= '{$review_user}',
				review_name	= '{$review_name}',
				regdate		= now()";
		sql_query($reviewer_sql_a);
	}
	##############
	$sql = "UPDATE ad_paper SET {$file_sql} WHERE seq = '{$seq}'";
	sql_query($sql);
	##############
	##############
	$sql = "select * from ad_paper where seq = '{$seq}'";
	$data	= sql_fetch($sql);
	if((strpos($data['express_publication'],"General")>0)){
		$range = "14일";
	}else{
		$range = "7일";
	}
	##############
	$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 투고 논문 심사 의뢰 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>심사위원님께</p>
		<p>
		안녕하십니까?
		그 동안 저희 학회지 발전을 위해 많은 관심과 애정을 보내주심에 감사드리며,
		바쁘신 일정이신 줄로 알지만, 이번 호 투고된 논문에 대하여 심사를 부탁드리고자 합니다.
		</p>
		<p>
		아래 링크를 통하여, 심사가능여부에 관한 회신을 먼저 부탁드립니다.
		</p>
		<center>
		<a href='http://{$_SERVER['HTTP_HOST']}/admin/reviewer_check.php?seq={$data['seq']}&review_user={$review_user}&doctype={$doctype}' target='_blank'>논문심사수락여부확인</a>
		</center>
		<p>
		본 심사는 {$info['journal_title']} 온라인투고시스템(<a href='http://{$_SERVER['HTTP_HOST']}'>http://{$_SERVER['HTTP_HOST']}</a>)에서 가능하며,
		저희 「{$info['journal_title']}」가 보다 수준 높은 학술지가 될 수 있도록 관심과 참여를 부탁드립니다. 감사합니다.

		</p>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
	";
	$mail->sendInput($review_user, $review_name, $body, "[{$info['journal_title']}] 투고 논문 심사 의뢰({$review_name} 귀하)");
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub03_write.php?seq={$_POST['seq']}";
}
else if($_POST['mode']=="d_sub4_reg") {
	### REVIEW CHECK
	foreach (array('a','b','c') as $v) {
		$v_up = strtoupper($v);
		if($_FILES['review_file_'.$v][tmp_name]) {
			$sfilename = UploadFile::uploadByType($_FILES['review_file_'.$v],'bdata');
			$file_sql = " rfile	= '/data/bdata/{$sfilename}'";
			sql_query("UPDATE ad_paper_review SET {$file_sql} WHERE parent_seq = '{$_POST['seq']}' AND type='{$v_up}'");
		}
	}
	//종합결과 기록
	sql_query("UPDATE ad_paper SET review_score={$_POST['result']} WHERE seq = '{$_POST['seq']}'");
	if($_POST['step']==15) {
		//2차수정요청은 없음.메일 미발송. 31(최종논문검토)로
		$step = 31;
	} else {
		$step = 10;
		$subject = "[{$info['journal_title']}] 논문 심사결과 안내({$_POST['mb_name']} 귀하)";
		$body_toauth = "{$mail_header}<p>안녕하십니까. {$info['institute_title']} [{$info['journal_title']}] 편집위원회입니다</p><p>먼저 「{$info['journal_title']}」에 논문을 투고해주셔서 진심으로 감사드립니다.</p><p>수합된 심사결과를 투고시스템(<a href='http://{$_SERVER['HTTP_HOST']}'>http://{$_SERVER['HTTP_HOST']}</a>)에서 확인부탁드립니다.</p><p>감사합니다.</p><p>- {$info['institute_title']} 편집위원회 드림 -</p>{$mail_footer}";
	}
	if($_POST['result'] == 4) {
		sql_query("UPDATE ad_paper SET settle_date = now(), step = 50 WHERE seq = '{$_POST['seq']}'");
		$body = "{$mail_header}<p>{$info['institute_title']} [{$info['journal_title']}] 논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}</p><p>편집위원장님</p><p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 '게재불가'로 최종논문 검토 완료되었습니다.</p></td></tr><tr><td height='15'></td></tr><tr><td height='51' align='left' valign='top'><p>원고 세부 사항</p><p>제목 : {$_POST['title']}</p><p>키워드 : {$_POST['keyword']}</p></td></tr><tr><td height='15'></td></tr><tr><td height='80' align='center' valign='top' bgcolor='#FFF'>{$mail_footer}";
		$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body_toauth, $subject);
		$mail->sendInput($main_editor, '편집장', $body);
	} else if($_POST['result'] == 2 || $_POST['result'] == 3){
		// 1차 수정요청 메일 발송. 2차수정요청은 없음
		sql_query("UPDATE ad_paper SET settle_date = now(), step = '{$step}', edit_comment='{$_POST['edit_comment']}' WHERE seq = '{$_POST['seq']}'");
		$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body_toauth, $subject);
	} else {
		sql_query("UPDATE ad_paper SET settle_date = now(), step = 31, edit_comment='{$_POST['edit_comment']}' WHERE seq = '{$_POST['seq']}'");
		$body = "{$mail_header}<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 요청 {$info['abbr']}-{$id_year}-{$number}</p><p>편집위원장님께 {$review_category_mailaddress}</p>
		<p>안녕하세요?</p><p>아래의 원고가 최종 완료되었기에 논문 확인요청을 드립니다. 최종원고를 보시고 심사 의견대로 수정이 잘 이루어졌는지, 혹은 수정이 미흡하여 추가로 수정해야 하는지 확인 부탁드립니다. 논문에 대한 자세한 내용을 확인 하시려면 아래 링크를 클릭하신 후 진행하시거나, 온라인투고시스템에 편집위원장 아이디로 로그인 하신 후 이용하시기 바랍니다.</p></td></tr><tr><td height='15'></td></tr><tr><td>height='51' align='center' valign='middle'><a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub09_write.php?seq={$_POST['seq']}' target='_blank'>투고논문 확인</a></td></tr><tr><td height='15'></td></tr><tr><td height='51' align='left' valign='top'><p>원고 세부 사항</p><p>제목 : {$_POST['title']}</p><p>키워드 : {$_POST['keyword']}</p></td></tr><tr><td height='15'></td></tr><tr><td height='80' align='center' valign='top' bgcolor='#FFF'>{$mail_footer}";
		$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body_toauth, $subject);
		$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 최종논문 검토 요청 {$info['abbr']}-{$id_year}-{$number}");
		##############
	}
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub04.php";
}
### 논문 총평등록
else if($_POST['mode']=="d_sub5_reg"){
	$file_sql = "";
	if($_FILES['review_file'][tmp_name]){
		$tmp_file  = $_FILES['review_file'][tmp_name];
		$filesize  = $_FILES['review_file'][size];
		$filename  = $_FILES['review_file'][name];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/ddata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['review_file'][error]);
		}
		$file_sql = " rfile	= '/data/ddata/{$sfilename}', ";
	}
	$sql = "insert into ad_paper_total set
				parent_seq		= '{$_POST['seq']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				mb_id		= '{$member['mb_id']}',
				mb_name		= '{$member['mb_name']}',
				regdate		= now()";
	sql_query($sql);
	$sql = "UPDATE ad_paper SET step = 51 WHERE seq = '{$_POST['seq']}'";
	sql_query($sql);
	if($_POST['result'] == "1") {
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 논문 최종결과 등록 완료 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>{$_POST['mb_name']} 저자님께</p>
		<p>안녕하세요?</p>
		<p>&nbsp; 안녕하세요?
		본 학회에 투고해 주신 아래 원고의 심사가 완료되어 알려 드립니다. 논문의 최종본은 출판사(문의)에서 편집될 예정이며, 편집된 초교본은 일주일정도 후에 저자에게 검토를 요청드릴 예정입니다. 초교본은 학회지 형식에 맞춰  편집되어 있기에 그림이나 표의 위치가 변경될 수 있으므로 출판사 편집담당자가 보내드리는 파일을 꼭 확인하시고 교정해 주시기 바랍니다. 심사완료 된 논문의 내용수정은 불가하오니 이점 유념하여 주시기 바라며, 학회지 게재여부는 편집회의에서 결정되고, 게재확정 후 연락드리겠습니다.감사합니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>원고 세부 사항</p>
		<p>제목 : {$_POST['title']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
	}
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub05.php";
}
else if($_POST['mode']=="d_sub9_reg"){
	$file_sql = "";
	if($_FILES['review_file'][tmp_name]){
		$tmp_file  = $_FILES['review_file'][tmp_name];
		$filesize  = $_FILES['review_file'][size];
		$filename  = $_FILES['review_file'][name];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/ddata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['review_file'][error]);
		}
		$file_sql = " rfile	= '/data/ddata/{$sfilename}', ";
	}
	if($_POST['result'] == 1){
		$inssql = "insert into ad_paper_review set
				parent_seq		= '{$_POST['seq']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				mb_id		= '{$member['mb_id']}',
				mb_name		= '{$member['mb_name']}',
				rstep		= '4',
				regdate		= now()";
		sql_query($inssql);
		$upsql = "UPDATE ad_paper SET settle_date = now(), step = 50 WHERE seq = '{$_POST['seq']}'";
		sql_query($upsql);
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 편집위원장님에 의해 '게재가'로 최종논문 검토 완료되었습니다. </p>
		</td></tr>
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
		// 학회 요청으로 발송 기능 제거 hjshyo 160617
		//$mail->sendInput($main_editor, '편집장', $body , "[{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}");
		##############
		$msg		= "처리 되었습니다.";
		$returnUrl	= "./d_sub09.php";
	}else if($_POST['result'] == 2){
		$inssql = "insert into ad_paper_review set
				parent_seq		= '{$_POST['seq']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				mb_id		= '{$member['mb_id']}',
				mb_name		= '{$member['mb_name']}',
				rstep		= '4',
				regdate		= now()";
		sql_query($inssql);
		$upsql = "UPDATE ad_paper SET settle_date = now(), step = 32 WHERE seq = '{$_POST['seq']}'";
		sql_query($upsql);
		#### 편집위원장에게도 메일 송부 =====
		##############
		$body2 = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 편집위원장님에 의해 '수정 후 게재가'로 최종 심사완료되었습니다. </p>
		</td></tr>
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
		##############
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>{$_POST['mb_name']} 저자님께</p>
		<p>안녕하세요?</p>
		<p>&nbsp;본 학회 {$info['institute_title']}지에 투고해 주신 원고의 심사결과가 완료되었습니다. 이에 논문 추가 수정을 요청드리오니 심사결과를 온라인투고시스템에서 확인해 주시기 바라며, 논문수정표와 최종논문을 투고시스템에 업로드 해 주시기 바랍니다.</p>
		</td></tr>
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
		$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body, "[{$info['journal_title']}] 최종논문 검토 완료({$_POST['mb_name']} 귀하)");
		$mail->sendInput($main_editor, '편집장', $body2, "[{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}");
		##############
		$msg		= "처리 되었습니다.";
		$returnUrl	= "./d_sub09.php";
	}else if($_POST['result'] == 3){
		$inssql = "insert into ad_paper_review set
				parent_seq		= '{$_POST['seq']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				mb_id		= '{$member['mb_id']}',
				mb_name		= '{$member['mb_name']}',
				rstep		= '4',
				regdate		= now()";
		sql_query($inssql);
		$upsql = "UPDATE ad_paper SET settle_date = now(), step = 32 WHERE seq = '{$_POST['seq']}'";
		sql_query($upsql);
		#### 편집위원장에게도 메일 송부 =====
		##############
		$body2 = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 편집위원장님에 의해 '수정 후 재심사'로 심사되었습니다. </p>
		</td></tr>
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
		##############
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>{$_POST['mb_name']} 저자님께</p>
		<p>안녕하세요?</p>
		<p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 편집위원장님에 의해 ‘수정후 재심사’로 최종논문 검토가 완료되었습니다.</p>
		</td></tr>
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
		$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body, "[{$info['journal_title']}] 최종논문 검토 완료({$_POST['mb_name']} 귀하)");
		$mail->sendInput($main_editor, '편집장', $body2, "[{$info['journal_title']}] 최종논문 검토 {$info['abbr']}-{$id_year}-{$number}");
		##############
		$msg		= "처리 되었습니다.";
		$returnUrl	= "./d_sub09.php";
	}else if($_POST['result'] == 4){
		$inssql = "insert into ad_paper_review set
				parent_seq		= '{$_POST['seq']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}',
				{$file_sql}
				mb_id		= '{$member['mb_id']}',
				mb_name		= '{$member['mb_name']}',
				rstep		= '4',
				regdate		= now()";
		sql_query($inssql);
		$upsql = "UPDATE ad_paper SET settle_date = now(), step = 50 WHERE seq = '{$_POST['seq']}'";
		sql_query($upsql);
		##############
		$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>편집위원장님</p>
		<p>&nbsp; 본 학회 {$info['institute_title']}지에 {$_POST['mb_name']}님이 투고한 원고의 심사결과가 편집위원장님에 의해 '게재불가'로 최종논문 검토 완료되었습니다. </p>
		</td></tr>
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
		$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 최종논문 검토 완료 {$info['abbr']}-{$id_year}-{$number}");
		##############
		##############
		$msg		= "처리 되었습니다.";
		$returnUrl	= "./d_sub09.php";
	}
}
### 심사윈원
else if($_POST['mode']=="d_sub7_reg"){
	$email = $_POST['mb_id'];
	$mb_hp = preg_replace("/[^0-9]*/s", "", $_POST['mb_hp']);
	if($_POST['mb_no']){
		$pass_sql = "";
		if($_POST['mb_password']){
			$pass_sql = "mb_password		= '".sql_password($_POST['mb_password'])."',";
		}
		$category_str = $_POST['field'];
		$sql = "UPDATE g4_member SET
					mb_name			= '{$_POST['mb_name']}',
					{$pass_sql}
					mb_zip1			= '{$_POST['mb_zip1']}',
					mb_zip2			= '{$_POST['mb_zip2']}',
					mb_addr1		= '{$_POST['mb_addr1']}',
					mb_addr2		= '{$_POST['mb_addr2']}',
					mb_addr3		= '{$_POST['mb_addr3']}',
					mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
					mb_tel			= '{$_POST['mb_tel']}',
					mb_hp			= '{$mb_hp}',
					mb_birth		= '{$_POST['mb_birth']}',
					mb_1			= '{$_POST['mb_1']}',
					mb_2			= '{$_POST['mb_2']}',
					field			= '{$_POST['field']}'
				WHERE
					mb_no = '{$_POST['mb_no']}'";
	}else{
		$member_registered = sql_fetch("SELECT * FROM g4_member WHERE mb_id='$email'");
		if($member_registered) alert("이미 가입된 회원입니다. 회원관리에서 확인바랍니다.","./d_sub07.php");
		$category_str = $_POST['field'];
		$sql = "INSERT INTO g4_member SET
					mb_id			= '{$email}',
					mb_password		= '".sql_password($_POST['mb_password'])."',
					mb_name			= '{$_POST['mb_name']}',
					mb_nick 		= '{$_POST['mb_name']}',
					mb_email		= '{$email}',
					mb_zip1			= '{$_POST['mb_zip1']}',
					mb_zip2			= '{$_POST['mb_zip2']}',
					mb_addr1		= '{$_POST['mb_addr1']}',
					mb_addr2		= '{$_POST['mb_addr2']}',
					mb_addr3		= '{$_POST['mb_addr3']}',
					mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
					mb_tel			= '{$_POST['mb_tel']}',
					mb_hp			= '{$mb_hp}',
					mb_birth		= '{$_POST['mb_birth']}',
					mb_1			= '{$_POST['mb_1']}',
					mb_2			= '{$_POST['mb_2']}',
					field			= '{$_POST['field']}',
					gb				= 'review',
					mb_level		= '4',
					mb_ip			= '{$_SERVER['REMOTE_ADDR']}',
					mb_datetime 	= now()";
	}
	sql_query($sql);
	$msg		= "처리 되었습니다";
	$returnUrl	= "./d_sub07.php";
}
### 일반회원
else if($_POST['mode']=="member_write"){
	$email = $_POST['mb_id'];
	$mb_hp = preg_replace("/[^0-9]*/s", "", $_POST['mb_hp']);
	$sql = "SELECT * FROM g4_member WHERE mb_id = '{$email}'";
	$res	= sql_fetch($sql);
	if(!$res) {
		$sql = "INSERT INTO g4_member SET
						mb_id			= '{$email}',
						mb_password		= '".sql_password($_POST['mb_password'])."',
						mb_name			= '{$_POST['mb_name']}',
						mb_nick 		= '{$_POST['mb_name']}',
						mb_email		= '{$email}',
						mb_zip1			= '{$_POST['mb_zip1']}',
						mb_zip2			= '{$_POST['mb_zip2']}',
						mb_addr1		= '{$_POST['mb_addr1']}',
						mb_addr2		= '{$_POST['mb_addr2']}',
						mb_addr3		= '{$_POST['mb_addr3']}',
						mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
						mb_tel			= '{$_POST['mb_tel']}',
						mb_hp			= '{$mb_hp}',
						mb_birth		= '{$_POST['mb_birth']}',
						mb_1			= '{$_POST['mb_1']}',
						mb_2			= '{$_POST['mb_2']}',
						mb_3			= '{$_POST['mb_3']}',
						field			= '{$_POST['field']}',
						gb				= 'normal',
						mb_level		= '{$_POST['mb_level']}',
						mb_ip			= '{$_SERVER['REMOTE_ADDR']}',
						mb_datetime 	= now()";
		sql_query($sql);
		$msg		= "회원 가입 되었습니다. \\n\\n신청한 아이디로 로그인해주세요.";
		$returnUrl	= "./login.php";
	}else{
		$msg		= "이미 가입하셨습니다. \\n\\n아이디/패스워드 찾기를 이용해주시기 바랍니다.";
		$returnUrl	= "./find_info.php";
	}
}
### 회원관리
else if($_POST['mode']=="d_member"){
	$pass_sql = "";
	if($_POST['mb_password'] && $_POST['mb_password'] == $_POST['mb_password_confirm']){
		$pass_sql = "mb_password		= '".sql_password($_POST['mb_password'])."',";
	}else if($_POST['mb_password']) {
		$msg		= "비밀번호가 일치하지 않습니다.";
		$returnUrl	= "./d_member_write.php?mb_no={$_POST['mb_no']}";
		alert($msg, $returnUrl);
	}
	if($_POST['mb_level']==4){
		$sql = "UPDATE g4_member SET
				mb_name			= '{$_POST['mb_name']}',
				{$pass_sql}
				mb_zip1			= '{$_POST['mb_zip1']}',
				mb_zip2			= '{$_POST['mb_zip2']}',
				mb_addr1		= '{$_POST['mb_addr1']}',
				mb_addr2		= '{$_POST['mb_addr2']}',
				mb_addr3		= '{$_POST['mb_addr3']}',
				mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
				mb_tel			= '{$_POST['mb_tel']}',
				mb_hp			= '{$_POST['mb_hp']}',
				mb_birth		= '{$_POST['mb_birth']}',
				mb_1			= '{$_POST['mb_1']}',
				mb_2			= '{$_POST['mb_2']}',
				mb_3			= '{$_POST['mb_3']}',
				field			= '{$_POST['field']}',
				gb				= 'review',
				mb_level		= '{$_POST['mb_level']}'
			WHERE
				mb_no = '{$_POST['mb_no']}'";
	}else{
		$sql = "UPDATE g4_member SET
				mb_name			= '{$_POST['mb_name']}',
				{$pass_sql}
				mb_zip1			= '{$_POST['mb_zip1']}',
				mb_zip2			= '{$_POST['mb_zip2']}',
				mb_addr1		= '{$_POST['mb_addr1']}',
				mb_addr2		= '{$_POST['mb_addr2']}',
				mb_addr3		= '{$_POST['mb_addr3']}',
				mb_addr_jibeon	= '{$_POST['mb_addr_jibeon']}',
				mb_tel			= '{$_POST['mb_tel']}',
				mb_hp			= '{$_POST['mb_hp']}',
				mb_birth		= '{$_POST['mb_birth']}',
				mb_1			= '{$_POST['mb_1']}',
				mb_2			= '{$_POST['mb_2']}',
				mb_3			= '{$_POST['mb_3']}',
				field			= '{$_POST['field']}',
				gb				= 'normal',
				mb_level		= '{$_POST['mb_level']}'
			WHERE
				mb_no = '{$_POST['mb_no']}'";
	}
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_member.php";
}
### 회원삭제
else if($_GET['mode']=="delete_member"){
	$sql = "delete from g4_member where mb_no = '{$_GET['mb_no']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_member.php";
}
### 회원삭제
else if($_GET['mode']=="delete_member2"){
	$sql = "delete from g4_member where mb_no = '{$_GET['mb_no']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub07.php";
}
## 심사위원 대행 로그인
else if($_GET['mode']=="change_to_reviewer"){
	$mb = sql_fetch("select mb_id,mb_datetime from $g4[member_table] where mb_no = TRIM('{$_GET['mb_no']}')");
	if($_SESSION['ss_mb_mode'] != 3) {
		$msg		= "잘못된 접근입니다.";
		$returnUrl	= "./d_member.php";
	}	else {
		set_session('ss_mb_id', $mb[mb_id]);
		set_session('ss_mb_mode', 2);
		// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
		set_session('ss_mb_key', md5($mb[mb_datetime] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
		$msg		= "{$mb[mb_id]} 심사위원으로 로그인합니다.";
		$returnUrl	= "/admin?login_mode=2&mb_id_front={$mb[mb_id]}";
	}
}
### 저자삭제
else if($_GET['mode']=="delete_author"){
	$sql = "delete from `ad_paper_auth` where auth_seq = '{$_GET['authseq']}' AND auth_email = '{$_GET['mail']}' AND parent_seq='{$_GET['seq']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
$returnUrl	= "./a_sub01_write.php?seq={$_GET['seq']}";
}
else if($_GET['mode']=="review_cancel"){
	$nm = $_GET['nm'];
	$sql = "update ad_paper set $nm = '' where seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('처리되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="review_confirm"){
	$nm = $_GET['nm'];
	if($nm=='review_a_conf') $reviewer_type='a';
	elseif($nm=='review_b_conf') $reviewer_type='b';
	elseif($nm=='review_c_conf') $reviewer_type='c';
	else {
		echo "<script>alert('Wrong access(d_process/review_confirm)');parent.location.reload();</script>";
		exit;
	}
	$sql = "select * from ad_paper JOIN g4_member ON review_{$reviewer_type}_user=g4_member.mb_id WHERE seq = '{$_GET['seq']}'";
	sql_query($sql);
	$row	= sql_fetch($sql);
	$r_mail = $row["review_{$reviewer_type}_user"];
	if(empty($r_mail) || empty($row)) {
		echo "<script>alert('Choise reviewer');parent.location.reload();</script>";
		exit;
	}
	// 기본 최종심사날 세팅
	if($row['review_'.$reviewer_type.'_date']) ${'review_'.$reviewer_type.'_date'} = date("Y년 m월 d일", strtotime($row['review_'.$reviewer_type.'_date']));
	else {
		${'review_'.$reviewer_type.'_date'} = date("Y년 m월 d일", strtotime('+2 week'));
		$row['review_'.$reviewer_type.'_date'] = date("Ymd", strtotime('+2 week'));
	}
	//회원정보추출
	$fpwdsql = "select * from g4_member where mb_id = '{$r_mail}'";
	$result = sql_query($fpwdsql);
	$row2 = sql_fetch_array($result);
	$enc_pw=md5($row2['mb_password']);
	//1차 심사 메일 발송
	if($row['step'] == 3){
		##############
		$body = <<<HTML
{$mail_header}
<p>{$info['institute_title']} [{$info['journal_title']}] {$info['abbr']}-{$id_year}-{$number}</p>
<p>심사위원님께</p>
<p>안녕하십니까? 바쁘신 가운데, 심사를 수락해주셔서 진심으로 감사드립니다.</p>
<p>위원님께서 맡아주신 논문의 심사기간은 {${'review_'.$reviewer_type.'_date'}} 이내이며,
아래 링크를 클릭하시거나, 「{$info['journal_title']}」 온라인투고시스템(<a href="http://{$_SERVER['HTTP_HOST']}">http://{$_SERVER['HTTP_HOST']}</a>)에 직접 접속하시어
상기 기한 내 심사의견을 제출해주시기 바랍니다.</p>
<p>문의 또는 요청사항이 생기시면 언제든지 연락주십시오. 감사합니다.</p>
</td></tr>
<tr><td height='15'></td></tr>
<tr>
<td height='51' align='center' valign='middle'><a href='http://{$_SERVER['HTTP_HOST']}/admin/b_sub01_write.php?seq={$row['seq']}' target='_blank'>논문심사</a></td>
</tr>
<tr><td height='15'></td></tr>
<tr><td height='20' align='left' valign='top'>
<p>※ 「{$info['journal_title']}」 온라인투고시스템을 통한 심사의뢰가 처음이신 경우 로그인 초기정보는 다음과 같습니다.<br/>
로그인 ID는 처음 심사의뢰를 수신하였던 선생님의 이메일 계정이며,
‘비밀번호 찾기’ 기능에 로그인 ID(이메일 계정)을 입력하시면 해당 메일로 비밀번호 재설정 기능이 담긴 메일이 발송되오니, 재설정 후 로그인 해주시기를 부탁드립니다.
</p>
</td></tr>
<tr><td height='51' align='left' valign='top'>
<br/>
<h3>원고 세부 사항</h3>
<p>제목 : {$row['title']}</p>
<p>키워드 : {$row['keyword']}</p>
</td></tr>
<tr><td height='15'></td></tr>
<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
{$mail_footer}
HTML;
		$mail->sendInput($row['review_'.$reviewer_type.'_user'], $row['mb_name'], $body, "[{$info['journal_title']}] 심사기한 및 방법 안내({$row['mb_name']} 귀하)");
		##############
	}
	$sql = "update ad_paper set $nm = 'Y' where seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('successfully completed');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewA_changedate"){
	$sql = "UPDATE ad_paper SET
				review_a_date		= '{$_GET['review_a_date']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 A의 심사완료 요청일이 변경되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewB_changedate"){
	$sql = "UPDATE ad_paper SET
				review_b_date		= '{$_GET['review_b_date']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 B의 심사완료 요청일이 변경되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewC_changedate"){
	$sql = "UPDATE ad_paper SET
				review_c_date		= '{$_GET['review_c_date']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 C의 심사완료 요청일이 변경되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewD_changedate"){
	$sql = "UPDATE ad_paper SET
				review_d_date		= '{$_GET['review_d_date']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 D의 심사완료 요청일이 변경되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewE_changedate"){
	$sql = "UPDATE ad_paper SET
				review_e_date		= '{$_GET['review_e_date']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 E의 심사완료 요청일이 변경되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewA_change"){
	$sql = "UPDATE ad_paper SET
				review_a_user		= '{$_GET['review_a_user']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 A가 추천 되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewB_change"){
	$sql = "UPDATE ad_paper SET
				review_b_user		= '{$_GET['review_b_user']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 B가 추천 되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewC_change"){
	$sql = "UPDATE ad_paper SET
				review_c_user		= '{$_GET['review_c_user']}'
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('심사위원 C가 추천 되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_POST['mode']=="publication_ok"){
	$seq = $_POST['seq'];
	if($_FILES['publication_file_'.$seq][tmp_name]){
		$tmp_file  = $_FILES['publication_file_'.$seq][tmp_name];
		$filesize  = $_FILES['publication_file_'.$seq][size];
		$filename  = $_FILES['publication_file_'.$seq][name];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/ddata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['publication_file_'.$seq][error]);
		}
		$file_sql = ", publish_data	= '/data/ddata/{$sfilename}' ";
	}
	$sql = "UPDATE ad_paper SET
				publish_vol		= '{$_POST['vol_'.$seq]}',
				publish_issue	= '{$_POST['issue_'.$seq]}',
				publish_conf	= 'Y'
				{$file_sql}
			WHERE
				seq = '{$seq}'";
	sql_query($sql);
	##############
	$body = "
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 논문 게재 출판 확정 {$info['abbr']}-{$id_year}-{$number}</p>
		<p>{$_POST['writer_name_'.$seq]} 저자님께</p>
		<p>안녕하세요?</p>
		<p>{$info['journal_title']} 학회지 편집위원회입니다.</p>
		<p>보내주신 (수정)원고를 바탕으로 <{$info['journal_title']} 제{$_POST['vol_'.$seq]}권 {$_POST['issue_'.$seq]}호>를 제작 진행하겠습니다. 그 동안 수고 많으셨습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>수정 검토 및 편집된 최종 논문은 ‘{$info['journal_title']} 온라인투고시스템({$_POST['title_'.$seq]})’에서 열람 가능합니다.</p>
		<br/>
		<p>앞으로도 저희 학회지에 지속적인 관심과 참여를 부탁드립니다. 감사합니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
	//학회 요청으로 해제 hjshyo 160630
	$mail->sendInput($_POST['writer_id_'.$seq], $_POST['writer_name_'.$seq], $body, "[{$info['journal_title']}] 최종원고 PDF 파일 확인 요청({$_POST['writer_name_'.$seq]} 귀하)");
	##############
	$msg		= "출판 확정 되었습니다.";
	$returnUrl	= "./d_publication.php";
}
else if($_GET['mode']=="publication_cancel"){
	$sql = "UPDATE ad_paper SET
				publish_vol		= '',
				publish_issue	= '',
				publish_conf	= 'N',
				publish_data	= ''
			WHERE
				seq = '{$_GET['seq']}'";
	sql_query($sql);
	echo "<script>alert('출판 취소 되었습니다.');parent.location.reload();</script>";
	exit;
}
else if($_GET['mode']=="reviewer_confirmY"){
	$sql = "UPDATE ad_reviewer_log SET
				confirm	= 'Y',
				confirmdate = now()
			WHERE
				parent_seq = '{$_GET['seq']}' and review_user = '{$_GET['review_user']}'";
	sql_query($sql);
	$body = "
		{$mail_header}
		<p>편집위원장님께</p>
		<p>아래 논문이 심사승인 되었습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p></p>
		<p>심사자 : {$_GET['review_user']}</p>
		<p>확 인 : <a href='http://{$_SERVER['HTTP_HOST']}/admin/d_sub03_write.php?seq={$_GET['seq']}' target='_blank'>심사위원 선정페이지로</a></p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
	$mail->sendInput($main_editor, '편집장', $body, "[{$info['journal_title']}] 심사승인 알림");
	$msg		= "심사 승인 확정 되었습니다.";
	$returnUrl	= "reviewer_result.php?mode=Y";
}
else if($_GET['mode']=="reviewer_confirmN"){
	$sql = "UPDATE ad_reviewer_log SET
				confirm	= 'N',
				confirmdate = now()
			WHERE
				parent_seq = '{$_GET['seq']}' and review_user = '{$_GET['review_user']}'";
	sql_query($sql);
	$msg		= "심사 거부 확정 되었습니다.";
	$returnUrl	= "reviewer_result.php?mode=N";
}
else if($_GET['mode']=="review_send_mail"){
	$seq = $_GET['seq'];
	$review_user = $_GET['review_user'];
	$review_name = get_review_name($_GET['review_user']);
	$review_category_target = get_category($_GET['review_category_target']);
	##############
	#메일 보내기 선택시 ad_reviewer_log 테이블에 해당 논문의 심사위원이 없을 경우에는 해당 심사위원을 추가함.
	$reviewer_chk_sql = "select count(*) as cnt from ad_reviewer_log where parent_seq = '{$seq}' and review_user = '{$review_user}'";
	$chk_data	= sql_fetch($reviewer_chk_sql);
	if($chk_data['cnt'] == "0"){
		$reviewer_sql_a = "insert into ad_reviewer_log set
				parent_seq	= '{$seq}',
				review_user	= '{$review_user}',
				review_name	= '{$review_name}',
				regdate		= now()";
		sql_query($reviewer_sql_a);
	}
	##############
	$sql = "select * from ad_paper where seq = '{$seq}'";
	$data	= sql_fetch($sql);
	if((strpos($data['express_publication'],"General")>0)){
		$range = "14일";
	}else{
		$range = "7일";
	}
	//$mail->Subject    = "안녕하세요. {$info['institute_title']}입니다.";
	##############
	$body = <<<HTML
{$mail_header}
<p>{$info['institute_title']} [{$info['journal_title']}] 투고 논문 심사 의뢰 {$info['abbr']}-{$id_year}-{$number}</p>
<p>{$review_name} 심사위원님께</p>
<p>
안녕하십니까?
그 동안 저희 학회지 발전을 위해 많은 관심과 애정을 보내주심에 감사드리며,
바쁘신 일정이신 줄로 알지만, 이번 호 투고된 논문에 대하여 심사를 부탁드리고자 합니다.
</p>
<p>
아래 링크를 통하여, 심사가능여부에 관한 회신을 먼저 부탁드립니다.
</p>
<center>
<a href='http://{$_SERVER['HTTP_HOST']}/admin/reviewer_check.php?seq={$data['seq']}&review_user={$review_user}' target='_blank'>논문심사수락여부확인</a>
</center>
<p>
본 심사는 {$info['journal_title']} 온라인투고시스템(<a href="http://{$_SERVER['HTTP_HOST']}">http://{$_SERVER['HTTP_HOST']}</a>)에서 가능하며,
저희 「{$info['journal_title']}」가 보다 수준 높은 학술지가 될 수 있도록 관심과 참여를 부탁드립니다. 감사합니다.

</p>
<tr><td height='15'></td></tr>
<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
{$mail_footer}
HTML;
	$mail->sendInput($review_user, $review_name, $body, "[{$info['journal_title']}] 투고 논문 심사 의뢰({$review_name} 귀하)");
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub03.php";
	####
}
else if($_POST['mode']=="reject_article"){
	$file_sql = "";
	if($_FILES['reject_comment_file'][tmp_name]){
		$tmp_file  = $_FILES['reject_comment_file'][tmp_name];
		$filesize  = $_FILES['reject_comment_file'][size];
		$filename  = $_FILES['reject_comment_file'][name];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "$g4[path]/data/ddata/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['reject_comment_file'][error]);
		}
		$file_sql = " , reject_comment_file	= '/data/ddata/{$sfilename}' ";
	}
	$step = 99 + $_POST['step'];
	$sql = "UPDATE ad_paper SET reject_date = now(), step = {$step}, reject_comment = '{$_POST['reject_comment']}' {$file_sql} WHERE seq = '{$_POST['seq']}'";
	sql_query($sql);
	##############
	$body = "
		{$mail_header}
		<p>안녕하세요?</p>
		<p>&nbsp;귀하가 투고하여주신 논문이 아래의 이유로 인해서 접수가 보류되었습니다. 내용 확인 후 재접수 부탁드립니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>원고 세부 사항</p>
		<p>제목 : {$_POST['title']}</p>
		<p>보류사유 : {$_POST['reject_comment']}</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
		";
	$mail->sendInput($_POST['mb_id'], $_POST['mb_name'], $body);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub01.php";
}else if($_POST['mode']=="withdraw_article") {
	$sql = "UPDATE ad_paper SET reject_date = now(), step = 49 WHERE seq = '{$_POST['seq']}'";
	sql_query($sql);
	##############
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub01.php";
}else if($_POST['mode']=="d_setting"){
	$fdate = date('Y-m-d',strtotime($_POST['sdate']));
	$ldate = date('Y-m-d',strtotime($_POST['edate']));
	$sql = "UPDATE ad_config SET
				service_fdate	= '{$fdate}',
				service_ldate	= '{$ldate}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_setting.php";
}else if($_POST['mode']=="d_sub10_reg"){
	$score_arr = array();
	for($i=1;$i<12;$i++) array_push($score_arr,$_POST['q'.$i]);
	$score = implode('|',$score_arr);
	$sql = "update ad_paper_review set
				score			= '{$score}',
				score_sum			= '{$_POST['sum']}',
				result			= '{$_POST['result']}',
				comments		= '{$_POST['comments']}'
			WHERE rseq='{$_POST['rseq']}'";
	sql_query($sql);

	if($_POST['reviewer']=='a') $qry = " review_a_result = '{$_POST['result']}' ";
	else if($_POST['reviewer']=='b') $qry = " review_b_result = '{$_POST['result']}' ";
	else if($_POST['reviewer']=='c') $qry = " review_c_result = '{$_POST['result']}' ";
	$sql = "update ad_paper set {$qry} where seq = '{$_POST['seq']}'";
	sql_query($sql);
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./d_sub06_write.php?seq={$_POST['seq']}#review_result";
}else if($_GET['mode']=="switch_mode"){
	$mb = sql_fetch("select mb_level,mb_id from $g4[member_table] where mb_id = TRIM('{$_GET['mb_id']}')");
	if($mb[mb_level]<=2) {
		$msg		= "잘못된 접근입니다.";
	}else if($mb[mb_level]>=10) {
		set_session('ss_mb_mode', $_GET['type']);
		$msg		= "모드를 전환합니다.";
	}else if($mb[mb_level]>=4 && $_GET['type']<3) {
		set_session('ss_mb_mode', $_GET['type']);
		$msg		= "모드를 전환합니다.";
	}
	$returnUrl	= "/admin?login_mode={$_GET['type']}&mb_id_front={$mb[mb_id]}";
}
###
alert($msg, $returnUrl);
?>
