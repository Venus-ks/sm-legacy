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
// if ($ie) {
//     // UTF-8에서 EUC-KR로 캐릭터셋 변경
//     $filepath = iconv('utf-8', 'euc-kr', $filepath);
// } else {

//     $filepath = iconv("UTF-8","cp949//IGNORE", $filepath);
// }


//  DB에 있는 파일 경로를 가져와서 서버에 있는 파일이랑 대조후 다운로드시켜줌 
try {
    if(!$filepath){
        // utf8 - euc-kr 로 변환해주는 거
        $filepath = iconv("UTF-8","cp949//IGNORE", $filepath);
    }else{
        $filepath;
    }
    $temp_arr		= explode("/", $filepath);
    $filename		= trim($temp_arr[count($temp_arr)-1]); // 다운로드 받을 파일이름
    $fileDownload = FileDownload::createFromFilePath($filepath);
    $fileDownload->sendDownload($filename);
}
catch(Exception $e){
    echo "<script>alert('ㅋㅋㄹㅃㅃ 관리자에게 문의 주세용 ㅋㅋㄹㅃㅃ');</script> ({$e->getMessage('')})";
    echo "관리자에게 문의 주시기 바랍니당";
}
?>
