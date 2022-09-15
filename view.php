<?php
error_reporting(0);

$filepath = $_GET['link'];
$_tmp = explode('/',$filepath);
//data 폴더외 파일은 다운로드 금지
if($_tmp[0]!="" || $_tmp[1]!="data") exit('Wrong access');
//미인증자 다운로드 금지
//if (!$_SESSION['ss_mb_id']) exit('Login, first');

$filepath = __DIR__.$filepath;
// $filepath = iconv("UTF-8","cp949//IGNORE", $filepath);
$temp_arr		= explode("/", $filepath);
$filename		= trim($temp_arr[count($temp_arr)-1]); // 다운로드 받을 파일이름
$filename = urldecode($filename);

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
@readfile($filepath);

