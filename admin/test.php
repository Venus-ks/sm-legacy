<?php
/*$url = 'http://www.ksce.or.kr/connect/member_chk.asp';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$g = curl_exec($ch);
curl_close($ch);
echo $g;
*/

//$homepage = file_get_contents('http://www.ksce.or.kr/connect/member_chk.asp');
//echo $homepage;

//$content = file_get_contents('http://www.ksce.or.kr/connect/member_chk.asp');
//if ($content !== false) {
//  echo $content;
//} else {
//   echo "error";
//}
?>


<?
//$data = array ('foo' => 'bar', 'bar' => 'baz'); // post 로 받을 데이터들
//$data = http_build_query($data); // url_encode 를 한 후 파라미터 구성을 해준다.

// http 통신 option을 지정한다. https 라고 해서 http 키값을 https 로 변경하지 말것.(주소에 https 라고 쓰기만 하면 된다.)
// http 배열 키 설명
// method 는 get, post 중 하나
// header 은 상황에 맞게 바꿔주면 된다.
// content 는 보낼 파라미터나 데이터를 구성
//$context_options = array (
//        'http' => array (
//            'method' => 'POST',
//            'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
//                . "Content-Length: " . strlen($data) . "\r\n",
//            'content' => $data
//            )
//        );

//$context = context_create_stream($context_options);
//$content = file_get_contents("http://www.ksce.or.kr/connect/member_chk.asp");
//$content = file_get_contents("http://www.google.com");
//echo $content;
?>
<?php
function file_get_contents_utf8() {
     $content = file_get_contents('http://www.ksce.or.kr/connect/member_chk.asp');
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

echo file_get_contents_utf8();
?>