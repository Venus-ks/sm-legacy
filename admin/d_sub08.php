<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a8";

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
	$where .= " AND journal = '{$_GET['journal']}' ";
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
$sql		= " select * from ad_paper where {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
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
$write_pages = get_paging(10, $page, $total_page, "./d_sub08.php?page=");
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
		<td background="../images/titlebg.png"><div style="height:51px;">&nbsp;</div></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">


		<!-- ### SEARCH -->
		<form name="form1">
		<table width="700" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="280">
				<input type="text" name="sdate" id="sdate" style="width:100px;" value="<?=$_GET['sdate']?>"/><a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
				&nbsp;
				<input type="text" name="edate" id="edate"  style="width:100px;" value="<?=$_GET['edate']?>"/><a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
			</td>
			<td align="left">
				<select name="sc_cate" id="sc_cate" style="width:100px;height:24px;line-height:21px;" onchange="cateChk(this);">
					<option value="">= 선택 =</option>
					<option value="journal" <? if($_GET['sc_cate']=='journal'){ ?>selected<? } ?>>저널명칭</option>
					<option value="category" <? if($_GET['sc_cate']=='category'){ ?>selected<? } ?>>카테고리</option>
					<option value="title" <? if($_GET['sc_cate']=='title'){ ?>selected<? } ?>>논문명칭</option>
					<option value="name" <? if($_GET['sc_cate']=='name'){ ?>selected<? } ?>>투고자</option>
				</select>

				<select name="journal" id="journal" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<?
					$jloop = get_journal_list();
					for($i=0;$i<count($jloop);$i++){
					?>
						<option value="<?=$jloop[$i]['title']?>" <?if($_GET['journal']==$jloop[$i]['title']){?>selected<?}?>><?=$jloop[$i]['title']?></option>
					<?
					}
					?>
				</select>

				<select name="category" id="category" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<? 
						$arr = get_category(); 
						for($i=0;$i<count($arr);$i++){
					?>
						<option value="<?=$arr[$i]['cvalue']?>"  <? if($_GET['category']==$arr[$i]['cvalue']){ ?>selected<? } ?>><?=$arr[$i]['ctext']?></option>
					<?
						}	
					?>
				</select>

				<input type="text" name="sc_text" id="sc_text" value="<?=$_GET['sc_text']?>"/>

				<input type="image" src="../images/btn_search.png" align="absmiddle" style="width:60px;height:25px;border:0px;"/></td>
		</tr>
		<tr>
			<td height="10">&nbsp;</td>
		</tr>
		</table>
		</form>


		<!-- ### LIST -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td class="borderbox">
				<strong>· Total : <font class="point"><?=number_format($total_count)?></font></strong> Item
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button" value="엑셀다운" style="height:22px;background-color:#000;color:#fff;border:1px solid #000;" onclick="excel_down();">
			</td>
		</tr>
		<tr><td height="6"></td></tr>
		<tr>
			<td>
			
			<table class="boardType01">
			<tr>
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
				<td class="textalingL"><?=$list[$i]['journal']?></td>
				<td class="textalingL"><? if($list[$i]['review_category']){ ?><?=get_category($list[$i]['review_category'])?><? } ?></td>
				<td><a href="./d_sub08_write.php?seq=<?=$list[$i]['seq']?>"><strong><?=$list[$i]['title']?></strong></a></td>
				<td><?=$list[$i]['mb_name']?></td>
				<td><?=substr($list[$i]['regdate'],0,10)?></td>
				<td><?=get_status($list[$i]['seq'])?></td>
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
		// $page_table		= str_replace("처음", "<span class=\"next\"><img src=\"/images/list_prev.png\" /></span>", $page_table);
		// $page_table		= str_replace("맨끝", "<span class=\"next\"><img src=\"/images/list_next.png\" /></span>", $page_table);
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

<iframe id="hddFrame" style="display:none;"></iframe>

<script> 
function cateChk(obj){
	if(obj.value == 'journal'){
		$("#journal").show();
		$("#category").hide();
		$("#sc_text").hide();
	}else if(obj.value =='category'){
		$("#journal").hide();
		$("#category").show();
		$("#sc_text").hide();
	}else{
		$("#journal").hide();
		$("#category").hide();
		$("#sc_text").show();
	}
}

function excel_down(){
	$("#hddFrame").attr("src", "d_sub08_excel.php");
}

<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>

<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>