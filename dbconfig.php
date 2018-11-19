<?
// DB정보
$mysql_host = 'localhost';
$mysql_user = 'demo';
$mysql_password = 'demo2017';
$mysql_db = 'submit_demo';
// 개발모드
//define('__DEV__',TRUE);
if(defined('__DEV__')) error_reporting(E_WARNING);
else error_reporting(0);

// 학회정보
//// ※실서비스는 직접수정하여야함
$info['abbr'] = 'abbr';
$info['maincolor'] = '#666666';
$info['journal_title'] = '저널명';
$info['institute_title'] = '학회명';
$info['smtp_id'] = 'hjshyo@gmail.com';
$info['smtp_pw'] = 'hakji2004';
$info['editor_email'] ='메인편집자 이메일(1)';
$info['editor_email2'] ='메인편집자 이메일(2)';
$info['editor_name'] = $info['institute_title'].' 편집위원회';
$info['editor_tel'] = '메인연락처';
$info['site'] = '학회웹사이트 URL';
$info['address'] = '학회주소';
$info['logo_url'] = '';
$info['bank_comment'] = "<p>심사료는 ??만원이며, 다음의 계좌로 입금하여 주시기 바랍니다.</p><p>- 계좌번호<br>- 예금주:??? </p>";
$info['paper_sample_url'] = "/down.php?link=/data/file/paper_sample.hwp";
$info['info_form_url'] = "/down.php?link=/data/file/02_Submission_Information.hwp";
$info['ethic_form_url'] = "/down.php?link=/data/file/ethic_form.hwp";
$info['revision_form_url'] = "/down.php?link=/data/file/revision_form.hwp";
$info['publish_rule_url'] = "#";
$info['ethic_rule_url'] = "javascript:ad_popup('content02');";
$info['review_table_url'] = "/down.php?link=/data/file/review_table.hwp";
$info['review_file_url'] = "/down.php?link=/data/file/review_file.hwp";
$info['author_manual_url'] = '/data/file/kata_manual_author.pdf';
$info['reviewer_manual_url'] = '/data/file/kata_manual_reviewer.pdf';
$info['manual_url'] = '#';
$info['review_form_url1'] = "javascript:alert('양식이 없습니다. 개별 요청바랍니다')";
$info['review_form_url2'] = "javascript:alert('양식이 없습니다. 개별 요청바랍니다')";
$info['review_form_url3'] = "javascript:alert('양식이 없습니다. 개별 요청바랍니다')";

//상세설정
$GLOBALS['rule']['category_target'] =
array('분야1','분야2','분야3','분야4','분야5','분야6');
$GLOBALS['rule']['get_result'] =
array('게재가','수정 후 게재가','수정 후 재심사','게재불가');
$GLOBALS['rule']['get_result_2nd'] =
array('게재가','게재불가');
?>
