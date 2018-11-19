<?php
include_once("../_common1.php");
$file = $_GET['file'];
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />

<div style="padding:20px;">
<iframe src="<?=$file?>.pdf" frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%">
</div>