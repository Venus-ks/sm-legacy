<?
include_once("./admin_head.php");

###
$mlevel		= 6;
$menu		= "a1";

###
$board[bo_page_rows] = 10;
$tsql = " select distinct seq from ad_journal";
$result = sql_query($tsql);
$total_count = mysqlI_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by seq desc ";

###
$sql		= " select * from ad_journal where 1 $sql_order limit $from_record, $board[bo_page_rows] ";
$result		= sql_query($sql);

$i = 0;
$k = 0;
while ($row = sql_fetch_array($result)){
	$list[$i]		= get_list($row, $board, $board_skin_path, 50);
	$list[$i][num]	= $total_count - ($page - 1) * $board[bo_page_rows] - $k;
	$i++;
	$k++;
}

###
$write_pages = get_paging(10, $page, $total_page, "./d_sub01.php?page=");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" height="800" valign="top" background="/images/leftbg.png">
	
	<!-- ### LEFT MENU -->
	<? include_once("./_menu.php"); ?>
	
	</td>
    <td valign="top">
	
	<!-- ### CONTENTS -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/04_title01.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">


		<!-- ### SEARCH -->
		<form name="form1">
		<table width="590" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<input type="text" name="sdate" id="sdate" style="width:100px;"/><a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
				&nbsp;
				<input type="text" name="edate" id="edate"  style="width:100px;"/><a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
			</td>
			<td>
				<select name="select" id="select" style="width:100px;height:24px;line-height:21px;" >
					<option value="">선택</option>
				</select>
			</td>
			<td>
				<input type="text" name="textfield" id="textfield" />
			</td>
			<td>
				<img src="../images/btn_search.png" align="absmiddle" /></td>
		</tr>
		<tr>
			<td height="32">&nbsp;</td>
		</tr>
		<tr>
			<td><a href="c_sub01_write.php"><img src="../images/btn_registration_journal.png" /></a></td>
		</tr>
		</table>
		</form>


		<!-- ### LIST -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td class="borderbox"><strong>· Total : <font class="point"><?=number_format($total_count)?></font></strong> Item</td>
		</tr>
		<tr><td height="6"></td></tr>
		<tr>
			<td>
			
			<table class="boardType01">
			<tr>
				<th><strong>No</strong></th>
				<th><strong>Journal Title</strong><br />(KOR)<br /></th>
				<th><strong>Journal Title</strong><br />(ENG)<br /></th>
				<th><strong>ISSN</strong></th>
				<th><strong>TYPE</strong></th>
			</tr>
			<?
				if(count($list)){
					for ($i=0; $i<count($list); $i++) {  	
			?>
			<tr>
				<td><?=$list[$i]['num']?></td>
				<td class="textalingL"><a href="./c_sub01_write.php?seq=<?=$list[$i]['seq']?>"><b><?=$list[$i]['title']?></b></a></td>
				<td class="textalingL"><?=$list[$i]['title_eng']?></td>
				<td><strong><?=$list[$i]['issn']?></strong></td>
				<td>??</td>
			</tr>
			<?
					}
				}else{
			?>
			<tr>
				<td colspan="7" class="text-center">
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



		</td>
	</tr>
	<tr>
		<td align="center" class="paging"> 
		
		<!-- ### PAGING -->
		<?
		$page_table		= $write_pages;
		$page_table		= str_replace("처음", "<span class=\"next\"><img src=\"/images/list_prev.png\" /></span>", $page_table);
		$page_table		= str_replace("맨끝", "<span class=\"next\"><img src=\"/images/list_next.png\" /></span>", $page_table);
		$page_table		= str_replace("&nbsp;", "", $page_table);
		$page_table		= preg_replace("/<b>([0-9]*)<\/b>/", "<span class=\"on\">$1</span>", $page_table);
		echo $page_table;
		?>

		</td>
	</tr>
	</table>




	
	</td>
</tr>
</table>