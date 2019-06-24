<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a7";


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
	$where .= " AND field = '{$_GET['category']}' ";
}
if($_GET['sc_cate']=='email' && $_GET['sc_text']){
	$where .= " AND mb_id like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='title' && $_GET['sc_text']){
	$where .= " AND title  like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='name' && $_GET['sc_text']){
	$where .= " AND mb_name  like '%{$_GET['sc_text']}%' ";
}

###
$board[bo_page_rows] = 10;
$tsql = " select distinct mb_no from g4_member where gb = 'review' {$where}";
$result = sql_query($tsql);
$total_count = mysql_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by mb_no desc ";

###
$sql		= " select * from g4_member where gb = 'review' {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
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
$write_pages = get_paging(10, $page, $total_page, "./d_sub07.php?page=");
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
		<td background="../images/titlebg.png"><img src="../images/03_title07.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">


		<!-- ### SEARCH -->
		<form name="form1">
		<table width="700" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<!--td>
				<input type="text" name="sdate" id="sdate" style="width:100px;"/><a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
				&nbsp;
				<input type="text" name="edate" id="edate"  style="width:100px;"/><a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
			</td-->
			<td>
				<!--select name="select" id="select" style="width:100px;height:26px;line-height:21px;" >
					<option>저널명칭</option>
					<option>논문명칭</option>
					<option>투고자</option>
				</select>
				<select name="select2" id="select2" style="width:100px;height:26px;line-height:21px;" >
					<option>전체</option>
					<option>Geochemistry</option>
					<option>Environmental Geology</option>
				</select>
			</td>
			<td>
				<input type="text" name="textfield" id="textfield" />
			</td>
			<td>
				<img src="../images/btn_search.png" align="absmiddle" /></td-->
				<select name="sc_cate" id="sc_cate" style="width:100px;height:24px;line-height:21px;" onchange="cateChk(this);">
					<option value="email" <? if($_GET['sc_cate']=='email'){ ?>selected<? } ?>>이메일</option>
					<option value="name" <? if($_GET['sc_cate']=='name' || $_GET['sc_cate']==''){ ?>selected<? } ?>>심사위원명</option>
					<option value="category" <? if($_GET['sc_cate']=='category'){ ?>selected<? } ?>>분야</option>
				</select>

				<!-- <select name="journal" id="journal" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<?
					$jloop = get_journal_list();
					for($i=0;$i<count($jloop);$i++){
					?>
						<option value="<?=$jloop[$i]['title']?>" <?if($_GET['journal']==$jloop[$i]['title']){?>selected<?}?>><?=$jloop[$i]['title']?></option>
					<?
					}
					?>
				</select> -->

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
			<td height="32">&nbsp;</td>
		</tr>
		<tr>
			<td><a href="d_sub07_write.php"><img src="../images/btn_revierer_registration.png" /></a></td>
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
				<th><strong>심사위원명</strong><br /></th>
				<th><strong>소속</strong><br /></th>
				<th><strong>분야</strong></th>
				<th><strong>전화</strong></th>
				<th><strong>핸드폰</strong></th>
				<th><strong>이메일</strong></th>
				<th><strong>심사중/심사완료</strong></th>
				<th><strong>심사승인/심사거부</strong></th>
				<th width="85"><strong>관리</strong></th>
			</tr>
			<?
				if(count($list)){
					for ($i=0; $i<count($list); $i++) {
			?>
			<tr>
				<td><?=$list[$i]['num']?></td>
				<td><a href="./d_sub07_write.php?mb_no=<?=$list[$i]['mb_no']?>"><b><font color="#0088de"><?=$list[$i]['mb_name']?></font></b></a></td>
				<td><?=$list[$i]['mb_1']?></td>
				<td><strong><? if($list[$i]['field']){ ?><?=get_category($list[$i]['field'])?><? } ?></strong></td>
				<td><?=$list[$i]['mb_tel']?></td>
				<td><?=$list[$i]['mb_hp']?></td>
				<td><?=$list[$i]['mb_email']?></td>
				<td><?=get_review_type($list[$i]['mb_id'],"")?> / <?=get_review_type2($list[$i]['mb_id'],"")?></td>
				<td><?=get_confirm_Y($list[$i]['mb_id'])?> / <?=get_confirm_N($list[$i]['mb_id'])?></td>
				<td>
					<a href="javascript:deleteMember('<?=$list[$i]['mb_no']?>');" class="btn btn-sm  btn-danger" style="color:#FFF;margin:2px">삭제</a>
					<a href="javascript:changeToReviewer('<?=$list[$i]['mb_no']?>');" class="btn btn-sm btn-info" style="color:#FFF;margin:2px">심사대행</a>
				</td>
			</tr>
			<?
					}
				}else{
			?>
			<tr>
				<td colspan="9">
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



<script type="text/javascript">
function deleteMember(mb_no){
	if(!confirm("정말 삭제하시겠습니까?\n삭제 된 데이터는 복구되지 않습니다.")) return;
	location.href = "./d_process.php?mode=delete_member2&mb_no="+mb_no;
}
function changeToReviewer(mb_no){
	if(!confirm("헤당 심사위원으로 대행 하시겠습니까?\n심사위원 당사자의 확인 작업 이후 진행합니다.")) return;
	location.href = "./d_process.php?mode=change_to_reviewer&mb_no="+mb_no;
}
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
	$("#hddFrame").attr("src", "d_sub06_excel.php");
}

<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>

<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>
