<?php
include_once("./_common.php");
include_once("./class/class.UploadFile.php");
// 변수설정 끝

##################
### D :: 논문투고 등록
if($_POST['mode']=="d_setting") {
    $fdate = trim($_POST['sdate']);
	$ldate = trim($_POST['edate']);

	if($_POST['everyday']=='open') {
		$fdate = NULL;
		$ldate = NULL;
	}

	$column_arr = ['service_fdate','service_ldate','regip','regdate'];
	$input_arr = ["'".$fdate."'","'".$ldate."'","'".$_SERVER['REMOTE_ADDR']."'",'now()'];
	foreach($info['file'] as $key=>$value) {
		$doc = [];
        $doc['label'] = $_POST[$key.'-label'];
        $doc['link'] = (is_uploaded_file($_FILES[$key.'-link']['tmp_name'])) ? "/data/file/".UploadFile::uploadByTypeWithFilename($_FILES[$key.'-link'],'file') : $info['file'][$key]['link'];
        
		$column_arr[] = $key;
		$input_arr[] = "'".json_encode($doc,JSON_UNESCAPED_UNICODE)."'";
	}
	$columns = implode(',',$column_arr);
	$inputs = implode(',',$input_arr);
	sql_query("insert into ad_config ({$columns}) VALUES ({$inputs})");
	$msg		= "처리 되었습니다.";
	$returnUrl	= "./e_setting.php";
}
###
alert($msg, $returnUrl);