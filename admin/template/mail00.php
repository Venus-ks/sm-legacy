<?php
$mail_header = <<<HTML
<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/><title></title></head>
<body>
<table width='750' border='0' cellspacing='0' cellpadding='0'><tr><td align='center'>
    <h3 style="margin:1rem">대한치과교정학회 임상저널(Clinical Journal of KAO)</h3>
</td></tr>
<tr><td height='50' align='left' valign='top'>
<hr/>
HTML;
$mail_footer = <<<HTML
<hr/>
<table width='750' border='0' cellspacing='0' cellpadding='0' style="background-color: #FFF;font-size:0.8rem">
<tr>
<td align='left'>
<p>{$info['journal_title']} 편집위원회<br />
{$info['address']}<br />
E-mail : <a href='mailto:{$info['editor_email']}'>{$info['editor_email']}</a><br />
Home :<a href='http://cjkao.org'>http://cjkao.org</a></p>
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
if(!defined('__DEV__')) $mail->Username = $info['smtp_id']; // SMTP account username
if(!defined('__DEV__')) $mail->Password = $info['smtp_pw']; // SMTP account password
if(!defined('__DEV__')) $mail->SetFrom($info['editor_email'], $info['institute_title']);
else $mail->SetFrom($info['editor_email'], '테스트서버');
