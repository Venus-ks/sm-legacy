<?php
include_once("./_common.php");
$sql		= "INSERT INTO ad_paper_deleted select * from ad_paper where seq={$_GET['seq']}";
$result		= sql_query($sql);
if($result==TRUE) {
	$sql	= "DELETE FROM ad_paper WHERE seq={$_GET['seq']}";
	$result		= sql_query($sql);
	$msg		= "삭제되었습니다.";
} else {
	$msg		= "실패하였습니다.";
}
$returnUrl	= "./a_sub01.php";
alert($msg,$returnUrl);
?>