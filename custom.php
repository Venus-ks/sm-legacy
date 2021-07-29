<?php
// 개발모드
define('__DEV__',TRUE);
if(defined('__DEV__')) error_reporting(E_ERROR);
else error_reporting(0);

// 학회정보
//// ※실서비스는 직접수정하여야함

$info['abbr'] = 'develop';
$info['maincolor'] = '#666666';
$info['journal_title'] = 'Develop';
$info['institute_title'] = 'Devel 학회';
$info['smtp_id'] = 'hakjisa.newnonmun@gmail.com';
$info['smtp_pw'] = 'hakji2004';
$info['editor_email'] ='qna@hakjisa.co.kr';
$info['editor_email2'] ='qna@hakjisa.co.kr';
$info['editor_name'] = $info['institute_title'].' 편집위원회';
$info['editor_tel'] = '02-330-5171';
$info['site'] = 'http://newnonmun.com';
$info['address'] = '(04031) 서울특별시 마포구 양화로 15길 20 마인드월드빌딩5층';
$info['logo_url'] = 'http://newnonmun.com/files/image/within_main/logo_nnm_l.png';
$info['bank_comment'] = "<p>심사료는 ??만원이며, 다음의 계좌로 입금하여 주시기 바랍니다.</p><p>- 계좌번호<br>- 예금주:??? </p>";
// down.php?link=/data/file/paper_sample.hwp
// OR
// javascript:ad_popup('content02');
$info['file'] = [
    'paper_sample' => [],
    'info_form' => [],
    'ethic_form' => [],
    'revision_form' => [],
    'author_checklist' => [],
    'copyright_agreement' => [],
    'submit_rule' => [],
    'ethic_rule' => [],
    'review_rule' => [],
    'publish_rule' => [],
    'author_manual' => [],
    'reviewer_manual' => [],
    'manual' => [],
    'review_form1' => [],
    'review_form2' => [],
    'review_form3' => [],
];

$sql	= "select * from ad_config ORDER BY no DESC LIMIT 0,1";
$data	= sql_fetch($sql); 
foreach($info['file'] as $key=>&$value) $value = json_decode($data[$key],true);

// var_dump($info['file']);
// exit;

foreach($doc_list as $k => $v) {
    $filename = urlencode($v);
    $info[$k] = "/down.php?link=".$filename;
}

//상세설정
$GLOBALS['rule']['manuscript_target'] = ['단독연구','공동연구'];
$GLOBALS['rule']['category_target'] = ['분야1','분야2','분야3','분야4','분야5','분야6'];
$GLOBALS['rule']['get_result'] = ['게재가','수정 후 게재가','수정 후 재심사','게재불가'];
$GLOBALS['rule']['get_result_2nd'] = ['게재가','','','게재불가'];