<?
// DB정보
$mysql_host = '222.234.3.219';
$mysql_user = 'develop';
$mysql_password = 'develop2020';
$mysql_db = 'sm_develop';
// 개발모드
define('__DEV__',TRUE);
if(defined('__DEV__')) error_reporting(E_ERROR);
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

//파일명구분 down, view 201027 hjshyo
$doc_list = [
    'paper_sample_url' => "",
    'info_form_url' => "",
    'ethic_form_url' => "",
    'revision_form_url' => "",
    'author_checklist_url' => "",
    'copyright_agreement' => "",
    'review_form_url1' => "",
    'review_form_url2' => "",
    'review_form_url3' => "",
];
foreach($doc_list as $k => $v) {
    $filename = urlencode($v);
    $info[$k] = "/down.php?link=/data/file/".$filename;
}
$view_list = [
    'submit_rule_url' => "투고규정및논문작성법.pdf",
    'ethic_rule_url' => "연구윤리규정.pdf",
    'review_rule_url' => "심사규정.pdf",
    'publish_rule_url' => "편집규정.pdf",
    'author_manual_url' => "manual_author.pdf",
    'reviewer_manual_url' => "manual_reviewer.pdf",
    'manual_url' => "manual.pdf",
];
foreach($view_list as $k => $v) {
    $filename = urlencode($v);
    $info[$k] = "/view.php?link=/data/file/".$filename;
}

//상세설정
$GLOBALS['rule']['manuscript_target'] = ['단독연구','공동연구'];
$GLOBALS['rule']['category_target'] = ['분야1','분야2','분야3','분야4','분야5','분야6'];
$GLOBALS['rule']['get_result'] = ['게재가','수정 후 게재가','수정 후 재심사','게재불가'];
$GLOBALS['rule']['get_result_2nd'] = ['게재가','게재불가'];

//file array
$info['file_arr'] = [
    [
        'name'=>'submission_data2',
        'title'=>'제목 및 저자 인적사항 /<br>저자사진',
        'eng_title'=>'Title page /<br> Portrait photography',
        'file_on'=>false,
        'msg'=>'파일을 압축(ZIP)하여 올려주시기 바랍니다./<br>Please zip the file and upload it.',
        'file'=>'info_form_url',
        'required'=>TRUE,
    ],
    [
        'name'=>'submission_data3',
        'title'=>'저작권 이양 동의서 및 이해관계 서약서',
        'eng_title'=>'Copyright Release Form',
        'file_on'=>true,
        'msg'=>'다운로드 받은 양식을 작성하여, 업로드해주시기 바랍니다./<br>Please fill out the downloaded form and upload it.',
        'file'=>'copyright_form_url',
        'file_en'=>'copyright_form_en_url',
        'required'=>TRUE,
    ],
    [
        'name'=>'submission_data',
        'title'=>'논문 본문',
        'eng_title'=>'Manuscript file',
        'file_on'=>false,
        'file'=>'paper_sample_url',
        'required'=>TRUE,
    ],
    [
        'step'=>[10,11,20],
        'name'=>'response_data',
        'title'=>'논문 수정노트',
        'eng_title'=>'Revision note',
        'file_on'=>false,
        'file'=>'response_data',
        'required'=>TRUE,
    ],
    [
        'name'=>'submission_cover_data',
        'title'=>'그림',
        'eng_title'=>'Figures',
        'file_on'=>false,
        'msg'=>'파일을 압축(ZIP)하여 올려주시기 바랍니다./<br>Please zip the file and upload it.',
        // 'required'=>TRUE,
        'review_open'=>TRUE,
    ],
    [
        'name'=>'submission_add_data',
        'title'=>'표',
        'eng_title'=>'Tables',
        'file_on'=>false,
        'msg'=>'필요시 파일을 압축(ZIP)하여 올려주시기 바랍니다./<br>If necessary, Please zip the file and upload it.',
        'review_open'=>TRUE,
    ],
    [
        'name'=>'submission_data4',
        'title'=>'잠재적 이해관계의 공개를 위한 ICMJE 서식',
        'eng_title'=>'Conflict of Interest Form',
        'file_on'=>true,
        'msg'=>'다운로드 받은 양식을 작성하여, 업로드해주시기 바랍니다./<br>Please fill out the downloaded form and upload it.',
        'file'=>'conflict_of_interest_form_url',
        'file_en'=>'conflict_of_interest_form_en_url',
        'required'=>TRUE,
    ],
    [
        'name'=>'submission_data5',
        'title'=>'진료기록 이용동의서',
        'eng_title'=>'Release Form for Patient Record',
        'file_on'=>true,
        'msg'=>'다운로드 받은 양식을 작성하여, 업로드해주시기 바랍니다./<br>Please fill out the downloaded form and upload it.',
        'file'=>'patient_record_form_url',
        'file_en'=>'patient_record_form_en_url',
        'required'=>false,
    ],
];