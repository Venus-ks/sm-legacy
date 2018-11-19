<?
include_once("../_common1.php");

$cont = get_config($_GET['type']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />

<div style="padding:20px;">

<?=$cont?>

</div>