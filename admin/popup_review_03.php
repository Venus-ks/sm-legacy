<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
### ORDER BY
switch($sort) {
	case 'name':
		$db_sort = 'mb_name';
		break;
	case 'email':
		$db_sort = 'mb_id';
		break;
	case 'sosok':
		$db_sort = 'mb_1';
		break;
	default:
		$db_sort = 'mb_name';
}
$by = mysql_real_escape_string($by);
$sql_order = " order by {$db_sort} {$by} ";

$sql		= " select * from g4_member where gb = 'review' {$sql_order}";
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
		<th width="130"><strong>심사위원명</strong>
			&nbsp;
			<a href="?page=<?=$page?>&sort=name&by=<?=($by=='asc')?'desc':'asc'?>">
				<span class="glyphicon glyphicon-sort" aria-hidden="true" style="color:#FFF"></span>					
			</a>
		</th>
		<th><strong>소속</strong>
			&nbsp;
			<a href="?page=<?=$page?>&sort=sosok&by=<?=($by=='asc')?'desc':'asc'?>">
				<span class="glyphicon glyphicon-sort" aria-hidden="true" style="color:#FFF"></span>					
			</a>
		</th>
		<th><strong>분야</strong></th>
		<th><strong>이메일</strong>
		&nbsp;
			<a href="?page=<?=$page?>&sort=email&by=<?=($by=='asc')?'desc':'asc'?>">
				<span class="glyphicon glyphicon-sort" aria-hidden="true" style="color:#FFF"></span>					
			</a>				
		</th>
		<th><strong>핸드폰</strong></th>
	</tr>
	<?
		if(count($list)){
			for ($i=0; $i<count($list); $i++) {  	
	?>
	<tr>
		<td><?=$i+1?></td>
		<td><a href="javascript:choice_review('<?=$list[$i]['mb_no']?>','<?=$list[$i]['mb_id']?>','<?=$list[$i]['mb_name']?>');"><b><?=$list[$i]['mb_name']?></b></a></td>
		<td><?=$list[$i]['mb_1']?></td>
		<td><span style="font-size:11px;"><? if($list[$i]['field']){ ?><?=get_category($list[$i]['field'])?><? } ?></span></td>
		<td><?=$list[$i]['mb_id']?></td>
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
function choice_review(no, id, name){
	var nm = "<?=$_GET['nm']?>";
	opener.$("#"+nm+"_user").val(id);
	opener.$("#"+nm+"_name").val(name);

	//alert("#"+nm+"_user");

	if ("#"+nm+"_user"=='#review_a_user'){
		opener.change_reviewA(opener.document.getElementById('review_a_user').value);
	}else if ("#"+nm+"_user"=='#review_b_user'){
		//alert("ReviewerB");
		opener.change_reviewB(opener.document.getElementById('review_b_user').value);
	}else if ("#"+nm+"_user"=='#review_c_user'){
		//alert("ReviewerC");
		opener.change_reviewC(opener.document.getElementById('review_c_user').value);
	}else if ("#"+nm+"_user"=='#review_d_user'){
		//alert("ReviewerD");
		opener.change_reviewD(opener.document.getElementById('review_d_user').value);
	}else if ("#"+nm+"_user"=='#review_e_user'){
		//alert("ReviewerE");
		opener.change_reviewE(opener.document.getElementById('review_e_user').value);
	}

	window.close();
}
</script>