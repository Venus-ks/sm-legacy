<?
include_once("../_common1.php");

###
$mlevel		= 8;
$menu		= "a6";

$where = " 1 ";

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
	$where .= " AND review_category_target = '{$_GET['category']}' ";
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
$total_count = mysqlI_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by seq desc ";

###
$sql		= " select * from ad_paper where {$where} $sql_order";
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
	<!--th rowspan="2"><strong>No</strong></th>
	<th rowspan="2"><strong>저널명칭</strong><br />Journal Title<br /></th>
	<th rowspan="2"><strong>분야</strong><br />Category<br /></th>
	<th rowspan="2"><strong>논문명칭</strong><br />Paper Title</th>
	<th colspan="4"><strong>논문 접수</strong></th>
	<th colspan="2">심사 의견</th>
	<th rowspan="2"><strong>상태</strong><br />Status</th-->
	<th rowspan="2"><strong>No</strong></th>
	<th rowspan="2"><strong>논문번호<br/>Manuscript Number</strong></th>
	<th rowspan="2"><strong>저널명<br/>Journal Title</strong></th>
	<th rowspan="2"><strong>원고종류<br/>Type of Manuscript</strong></th>
	<th rowspan="2"><strong>심사요청분야<br/>Review Category</strong></th>
	<th rowspan="2"><strong>논문명<br/>Title</strong></th>
	<th rowspan="2"><strong>투고자<br/>Author</strong></th>
	<th colspan="4"><strong>일자<br/>Date</strong></th>
	<th colspan="3"><strong>심사 의견<br/>Review</strong></th>
	<th rowspan="2"><strong>상태<br/>Status</strong></th>
</tr>
<tr bgcolor="eeeeee">
	<th><strong>투고일<br/>Submission Date</strong></th>
	<th><strong>접수일<br/>Received Date</strong></th>
	<th><strong>수정일<br/>Revised Date</strong></th>
	<th><strong>최종심사 완료일<br/>Accepted Date</strong></th>
	<th><strong>심사위원<br/>Reviewer</strong></th>
	<th><strong>의견등록일<br/>Review Date</strong></th>
	<th><strong>심사결과<br/>Result</strong></th>
</tr>
<?
	if(count($list)){
		for ($i=0; $i<count($list); $i++) {  
			
			$sql = "select * from ad_paper_review where parent_seq = '{$list[$i]['seq']}' order by mb_id asc, rstep asc  limit 9";
			$ress	= sql_query($sql);
			unset($review);
			while ($row = sql_fetch_array($ress)){
				$review[] = $row;
			}
?>
<tr>
	<td><?=$list[$i]['num']?></td>
    <?php $cyear = date("y");?>
	<td>KJ-<?=$cyear?>-<?=$list[$i]['seq']?></td>
	<td class="textalingL"><?=$list[$i]['jourmal']?></td>
	<td><? if($list[$i]['manuscript']){ ?><?=get_manuscript($list[$i]['manuscript'])?><? } ?></td>
	<td class="textalingL"><? if($list[$i]['review_category_target']){ ?><?=get_category($list[$i]['review_category_target'])?><? } ?></td>
	<td><a href="./d_sub06_write.php?seq=<?=$list[$i]['seq']?>"><strong><?=$list[$i]['title']?></strong></a></td>
	<td><?=$list[$i]['mb_name']?></td>
	<td class="brc"><?=substr($list[$i]['regdate'],0,10)?></td>
	<td><?=substr($list[$i]['submit_date'],0,10)?></td>
	<td><?=substr($list[$i]['modify_date'],0,10)?></td>
	<?
	$sqlad = "select regdate from ad_paper_total where parent_seq = '{$list[$i]['seq']}'";
	$acptdate = sql_fetch($sqlad);
	?>
	<td><?=substr($acptdate['regdate'],0,10)?></td>
	<td class="brc">
					<table border="0" cellspacing="0" cellpadding="0">
					<? 
					if($review){
						foreach($review as $k){ 
							if($k['rstep']=='1') $str = "1<sup>ST</sup>";
							if($k['rstep']=='2') $str = "2<sup>ND</sup>";
							if($k['rstep']=='3') $str = "3<sup>RD</sup>";
							echo "<tr><td style='height:110px;'>".$str." ".$k['mb_name']."</td></tr>";
						}
					}
					?>
					</table>
	</td>
	<td class="brc">
					<table border="0" cellspacing="0" cellpadding="0">
					<? 
					if($review){
						foreach($review as $k){ 
							if($k['rstep']=='1') $str = "1<sup>ST</sup>";
							if($k['rstep']=='2') $str = "2<sup>ND</sup>";
							if($k['rstep']=='3') $str = "3<sup>RD</sup>";
							echo "<tr><td style='height:110px;'>".$str." ".$k['regdate']."</td></tr>";
						}
					}
					?>
					</table>
	</td>
	<td>
					<table border="0" cellspacing="0" cellpadding="0">
					<? 
					if($review){
						foreach($review as $k){ 
							if($k['rstep']=='1') $str = "1<sup>ST</sup>";
							if($k['rstep']=='2') $str = "2<sup>ND</sup>";
							if($k['rstep']=='3') $str = "3<sup>RD</sup>";
							echo "<tr><td style='height:110px;'>".$str." ".get_result($k['result'])."</td></tr>";
						}
					}
					?>
					</table>
	</td>
	<td><?=get_status_excel($list[$i]['seq'])?></td>
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