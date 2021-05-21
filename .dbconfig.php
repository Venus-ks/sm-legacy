<?
// DB정보
$mysql_host = 'localhost';
$mysql_user = '{{ abbr }}';
$mysql_password = '{{ abbr }}{{ thisyear }}';
$mysql_db = 'sm_{{ abbr }}';
// 개발모드
define('__DEV__',TRUE);
if(defined('__DEV__')) error_reporting(E_WARNING);
else error_reporting(0);
// 학회정보
//// ※실서비스는 직접수정하여야함
$info['abbr'] = '{{ abbr }}';
$info['maincolor'] = '#666666';
$info['journal_title'] = '저널명';
$info['institute_title'] = '학회명';
$info['smtp_id'] = 'hakjisa.newnonmun@gmail.com';
$info['smtp_pw'] = 'hakji2004';
$info['editor_email'] ='qna@hakjisa.co.kr';
$info['editor_email2'] ='qna@hakjisa.co.kr';
$info['editor_name'] = $info['institute_title'].' 편집위원회';
$info['editor_tel'] = '메인연락처';
$info['site'] = '학회웹사이트 URL';
$info['address'] = '학회주소';
$info['logo_url'] = '';
$info['bank_comment'] = "<p>심사료는 ??만원이며, 다음의 계좌로 입금하여 주시기 바랍니다.</p><p>- 계좌번호<br>- 예금주:??? </p>";
// down.php?link=/data/file/paper_sample.hwp
// OR
// javascript:ad_popup('content02');
$doc_list = [
    'paper_sample_url' => "투고논문본문format샘플.hwp",
    'info_form_url' => "투고신청서.hwp",
    'ethic_form_url' => "연구윤리준수_확인서_자가점검표.hwp",
    'revision_form_url' => "수정요지서(저자답변서).hwp",
    // 'author_checklist_url' => ".hwp",
    'submit_rule_url' => "투고규정.pdf",
    'ethic_rule_url' => "윤리규정.pdf",
    'review_rule_url' => "심사규정.pdf",
    'author_manual_url' => "manual_author.pdf",
    'reviewer_manual_url' => "manual_reviewer.pdf",
    'manual_url' => "manual.pdf",
    'review_form_url1' => "논문심사서.hwp",
    'review_form_url2' => "논문심사서.hwp",
    'review_form_url3' => "논문심사서.hwp",
];

foreach($doc_list as $k => $v) {
    $filename = urlencode($v);
    $info[$k] = "/down.php?link=/data/file/".$filename;
}

//상세설정
$GLOBALS['rule']['manuscript_target'] = ['단독연구','공동연구'];
$GLOBALS['rule']['category_target'] = ['분야1','분야2','분야3','분야4','분야5','분야6'];
$GLOBALS['rule']['get_result'] = ['게재가','수정 후 게재가','수정 후 재심사','게재불가'];
$GLOBALS['rule']['get_result_2nd'] = ['게재가','게재불가'];
