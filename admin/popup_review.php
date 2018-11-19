<?
include_once ("./_common.php");

header("Content-Type: text/html; charset=$g4[charset]");
$gmnow = gmdate("D, d M Y H:i:s") . " GMT";
header("Expires: 0"); // rfc2616 - Section 14.21
header("Last-Modified: " . $gmnow);
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: pre-check=0, post-check=0, max-age=0"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0

###
$sql		= " select * from g4_member where gb = 'review' order by mb_no desc";
$result		= sql_query($sql);

$i = 0;
$k = 0;
while ($row = sql_fetch_array($result)){
	$list[$i]		= get_list($row, $board, $board_skin_path, 50);
	$list[$i][num]	= $total_count - ($page - 1) * $board[bo_page_rows] - $k;
	$i++;
	$k++;
}
?>
<script type="text/javascript" src="<?=$g4['path']?>/js/common.js"></script>
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>

<body style="margin:0px;">

<div style="border:5px solid #000;padding:10px;">
<table width="98%" height="375" border="0" cellspacing="0" cellpadding="0">
<tr><td height="30"><b>심사위원 선택</b></td></tr>
<tr><td height="1" bgcolor="aaaaaa"></td></tr>
<tr>
	<td valign="top">
		
	<div style="height:10px;"></div>

	<table class="boardType01">
	<tr>
		<th><strong>No</strong></th>
		<th><strong>심사위원명</strong></th>
		<th><strong>소속</strong></th>
		<th><strong>분야</strong></th>
		<th><strong>전화</strong></th>
		<th><strong>핸드폰</strong></th>
	</tr>
	<?
		if(count($list)){
			for ($i=0; $i<count($list); $i++) {  	
	?>
	<tr>
		<td><?=$i+1?></td>
		<td><a href="javascript:choice_review('<?=$list[$i]['mb_no']?>','<?=$list[$i]['mb_id']?>','<?=$list[$i]['mb_name']?>', '<?=$list[$i]['field']?>');"><b><?=$list[$i]['mb_name']?></b></a></td>
		<td><?=$list[$i]['mb_1']?></td>
		<td><span style="font-size:11px;"><? if($list[$i]['field']){ ?><?=get_category($list[$i]['field'])?><? } ?></span></td>
		<td><?=$list[$i]['mb_tel']?></td>
		<td><?=$list[$i]['mb_hp']?></td>
	</tr>
	<?
			}
		}else{
	?>
	<tr>
		<td colspan="4">
			해당하는 데이터가 없습니다.
		</td>
	</tr>
	<?
		}
	?>
	</table>
	
	
	</td>
</tr>
</table>
</div>

</body>


<script>
function choice_review(no, id, name, field){
	var nm = "<?=$_GET['nm']?>";
	opener.$("#"+nm+"_user").val(id);
	opener.$("#"+nm+"_name").val(name);
	opener.$("#"+nm+"_field").val(field);
	window.close();
}
</script>