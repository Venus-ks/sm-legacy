<?
// 다운로드 
$filename = date('md').$_REQUEST[fileName]; 
$filename = explode("/", $filename); 
$filename = $filename[sizeof($filename)-1]; 

//이미지도 다른파일과 같이 다운로드로 하게끔 하기 

//------------------다운로드----------------------------// 
Header("Content-type:application/octet-stream"); 
//Header("Content-Length:".$file_size); 
Header("Content-Disposition:attachment; filename=".$filename); 
//Header("Content-Transfer-Encoding:binary"); // 이거 주석풀면 pdf 파일 깨져서 다운됨.. 이유는 바이너리로 생성하는 헤더이기 때문. (텍스트파일 등을 다운받으면서 pdf로 생성해줄 때 씀)
Header("Pragma:no-cache"); 
Header("Expires:0"); 


// 다운받을 파일의 경로와 이름 
// 절대경로로 사용하기 위해서는 php.ini 파일 allow_url_fopen()을 사용으로!
// $Down_Folder = "http://주소/file/".$DownFile; 

$Down_Folder = $DownFile;
$fh = fopen($Down_Folder, "rb"); 

if(!fpassthru($fh)) { 
	fclose($fh); 
}

?>