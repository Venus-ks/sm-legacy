<?php
error_reporting(0);
require 'vendor/autoload.php';
###
use Apfelbox\FileDownload\FileDownload;

$filepath		= $_GET['link'];
$_tmp = explode('/',$filepath);
//data 폴더외 파일은 다운로드 금지
if($_tmp[0]!="" || $_tmp[1]!="data") exit('Wrong access');
//미인증자 다운로드 금지
//if (!$_SESSION['ss_mb_id']) exit('Login, first');

$filepath = __DIR__.$filepath;
// IE인지 HTTP_USER_AGENT로 확인
$ie = isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== false); 
if ($ie) {
    // UTF-8에서 EUC-KR로 캐릭터셋 변경
    $filepath = iconv('utf-8', 'euc-kr', $filepath);
} else {

    $filepath = iconv("UTF-8","cp949//IGNORE", $filepath);
}
$temp_arr		= explode("/", $filepath);
$filename		= trim($temp_arr[count($temp_arr)-1]); // 다운로드 받을 파일이름

try {
    $fileDownload = FileDownload::createFromFilePath($filepath);
    $fileDownload->sendDownload($filename);
}
catch(Exception $e){
    echo "File not exist ({$e->getMessage()})";
}
?>
