<?php
include_once("./_common.php");
error_reporting(E_ALL);
### 메일 관련 코드 
//id 발송시 PECERA 고유번호 발급시 년도 정보 생성
$id_year=date('y');
// 변수설정
$main_editor = $info['editor_email'];
$mail_header = <<<HTML
<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><title></title></head>
<body>
<table width='750' border='0' cellspacing='0' cellpadding='0'><tr><td height='85' align='center' valign='top'><img src='http://{$_SERVER['HTTP_HOST']}/images/mail_title.png' width='750' height='65' /></td></tr><tr><td height='15'></td></tr>
<tr><td height='50' align='left' valign='top'>
HTML;
$mail_footer = <<<HTML
<table width='750' border='0' cellspacing='0' cellpadding='0'>
<tr>
<td width='240' height='80'><img src='http://www.ekera.org/front/images/logo.gif' /></td>
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
require_once('class.phpmailer.php'); // phpmailer ext module class
require_once('class/class.MailSender.php'); // phpmailer override class by hjshyo
$mysqlconn = new Mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_db);
// 메일 클래스 설정
$mail = new GoogleTemplateMailer();
$mail->SMTPDebug  = 1;                    
// enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only    
$mail->Dbconn = $mysqlconn;
$mail->Username = $info['smtp_id']; // SMTP account username
$mail->Password = $info['smtp_pw']; // SMTP account password
$mail->SetFrom($info['editor_email'], $info['institute_title']);

$_POST['review_a_user'] = 'hjshyo@hakjisa.co.kr';
$_POST['review_b_user'] = 'hjshyo@hakjisa.co.kr';
$_POST['review_c_user'] = 'hjshyo@hakjisa.co.kr';
$_POST['review_a_name'] = '홍길동a';
$_POST['review_b_name'] = '홍길동b';
$_POST['review_c_name'] = '홍길동c';

$_POST['mb_name'] = "홍길동";
$_POST['mb_id'] = "hjshyo@hakjisa.co.kr";
$v = 'a';
$_POST['review_a_name'] = 'review_a_name';
$_POST['review_a_date'] = '20160711';
${'review_'.$v.'_date'} = date("Y년 m월 d일", strtotime($_POST['review_'.$v.'_date']));
$_GET['review_user'] = "asgasd@gmail.com";
$_GET['seq'] = 42;
$id_year = 16;
$number = '000';
$seq = 42;
$_POST['vol_42'] = 52;
$_POST['issue_42'] = 2;
$_POST['title_42'] = '테스트제목';
$_POST['writer_id_42'] = 'hjshyo@hakjisa.co.kr';
$_POST['writer_name_42'] = '홍길동';
##############
$body = <<<BODY
		{$mail_header}
		<p>{$info['institute_title']} [{$info['journal_title']}] 논문 게재 출판 확정 KA-{$id_year}-{$number}</p>
		<p>{$_POST['writer_name_'.$seq]} 저자님께</p>
		<p>안녕하세요?</p>
		<p>교육학연구 학회지 편집위원회입니다.</p>
		<p>보내주신 (수정)원고를 바탕으로 <{$info['journal_title']} 제{$_POST['vol_'.$seq]}권 {$_POST['issue_'.$seq]}호>를 제작 진행하겠습니다. 그 동안 수고 많으셨습니다.</p>
		</td></tr>
		<tr><td height='15'></td></tr>
		<tr><td height='51' align='left' valign='top'>
		<p>수정 검토 및 편집된 최종 논문은 ‘교육학연구 온라인투고시스템(<a href="http://{$_SERVER['HTTP_HOST']}">http://{$_SERVER['HTTP_HOST']}</a>)’에서 열람 가능합니다.</p>
		<br/>
		<p>앞으로도 저희 학회지에 지속적인 관심과 참여를 부탁드립니다. 감사합니다.</p>
		</td></tr>
		<tr><td height='80' align='center' valign='top' bgcolor='#FFF'>
		{$mail_footer}
BODY;
$mail->sendInput($_POST['writer_id_'.$seq], $_POST['writer_name_'.$seq], $body, "[교육학연구] 최종원고 PDF 파일 확인 요청({$_POST['writer_name_'.$seq]} 귀하)");