<?
include_once("../_common1.php");


$where = "1";

### SEARCH
if($_GET['sdate'] || $_GET['edate']){
	if($_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' AND regdate <= '{$_GET['edate']}' ";
	}else if($_GET['sdate'] && !$_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' ";
	}else if(!$_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate <= '{$_GET['edate']}' ";
	}
}
###
if($_GET['sc_cate']=='category' && $_GET['category']){
	$where .= " AND review_category = '{$_GET['category']}' ";
}
if($_GET['sc_cate']=='journal' && $_GET['journal']){
	$where .= " AND jourmal = '{$_GET['journal']}' ";
}
if($_GET['sc_cate']=='title' && $_GET['sc_text']){
	$where .= " AND title  like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='name' && $_GET['sc_text']){
	$where .= " AND mb_name  like '%{$_GET['sc_text']}%' ";
}


###
$board[bo_page_rows] = 10;
$tsql = " select distinct seq from ad_paper where {$where}";
$result = sql_query($tsql);
$total_count = mysql_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by seq desc ";

###
$sql		= " select * from ad_paper where {$where} $sql_order ";
$result		= sql_query($sql);

$i = 0;
$k = 0;
while ($row = sql_fetch_array($result)){
	$list[$i]		= get_list($row, $board, $board_skin_path, 50);
	$list[$i][num]	= $total_count - ($page - 1) * $board[bo_page_rows] - $k;
	$i++;
	$k++;
}

$today = date("YmdHis");

Header("Content-type: application/vnd.ms-excel");
Header("Content-type: charset=utf-8");
header("Content-Disposition: attachment; filename=data_{$today}.xls");
Header("Content-Description: PHP3 Generated Data");
Header("Pragma: no-cache");
Header("Expires: 0");

echo "<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel;charset=utf-8\">";
?>
<table class="boardType01" border="1">
<tr bgcolor="eeeeee">
	<th><strong>No</strong></th>
	<th><strong>저널명칭</strong><br />Journal Title<br /></th>
	<th><strong>분야</strong><br />Category<br /></th>
	<th><strong>논문명칭</strong><br />Paper Title</th>
	<th><strong>투고자</strong><br />Author</th>
	<th><strong>투고일</strong><br />Submission Date</th>
	<th><strong>상태</strong><br />Status</th>
</tr>
<?
	if(count($list)){
		for ($i=0; $i<count($list); $i++) {  	
?>
<tr>
	<td><?=$list[$i]['num']?></td>
	<td class="textalingL"><?=$list[$i]['jourmal']?></td>
	<td class="textalingL"><? if($list[$i]['review_category']){ ?><?=get_category($list[$i]['review_category'])?><? } ?></td>
	<td><strong><?=$list[$i]['title']?></strong></td>
	<td><?=$list[$i]['mb_name']?></td>
	<td><?=substr($list[$i]['regdate'],0,10)?></td>
	<td><?=get_status($list[$i]['seq'])?></td>
</tr>
<?
		}
	}else{
?>
<tr>
	<td colspan="7">
		해당하는 데이터가 없습니다.
	</td>
</tr>
<?
	}
?>
</table>