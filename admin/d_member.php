<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "b1";


###
if($_GET['sc_cate']=='name' && $_GET['sc_text']){
	$where .= " AND mb_name like  '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='grade' && $_GET['grade']){
	$where .= " AND mb_level = '{$_GET['grade']}' ";
}
if($_GET['sc_cate']=='org' && $_GET['sc_text']){
	$where .= " AND mb_1  like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='cat' && $_GET['cat']){
	$where .= " AND field  = '{$_GET['cat']}' ";
}

###
$board[bo_page_rows] = 10;
//$tsql = " select distinct mb_no from g4_member where gb = 'normal' and mb_level < 4";
$tsql = " select distinct mb_no from g4_member where mb_level < 11 {$where}";
$result = sql_query($tsql);
$total_count = mysqlI_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by mb_no desc ";

###
//$sql		= " select * from g4_member where gb = 'normal' and mb_level < 4 $sql_order limit $from_record, $board[bo_page_rows] ";
$sql		= " select * from g4_member where mb_level < 11 {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
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
$write_pages = get_paging(10, $page, $total_page, "./d_member.php?page=");
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
		<td background="../images/titlebg.png"><img src="../images/03_title09.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">


		<!-- ### SEARCH -->
		<form name="form1">
		<table width="590" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<!--td>
				<input type="text" name="sdate" id="sdate" style="width:100px;"/><a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
				&nbsp;
				<input type="text" name="edate" id="edate"  style="width:100px;"/><a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
			</td-->
			<td>
				<select name="sc_cate" id="sc_cate" style="width:100px;height:24px;line-height:21px;" onchange="cateChk(this);">
					<option value="">= 선택 =</option>
					<option value="name" <? if($_GET['sc_cate']=='name'){ ?>selected<? } ?>>이름</option>
					<option value="grade" <? if($_GET['sc_cate']=='grade'){ ?>selected<? } ?>>등급</option>
					<option value="org" <? if($_GET['sc_cate']=='org'){ ?>selected<? } ?>>소속</option>
					<option value="cat" <? if($_GET['sc_cate']=='cat'){ ?>selected<? } ?>>분야</option>
				</select>

				<select name="grade" id="grade" style="width:100px;height:24px;line-height:21px;display:none;">
						<option value="">= 선택 =</option>
						<option value="2" <? if($_GET['grade']=="2"){ ?>selected<? } ?>>정회원</option>
						<option value="4" <? if($_GET['grade']=="4"){ ?>selected<? } ?>>심사위원</option>
						<option value="10" <? if($_GET['grade']=="10"){ ?>selected<? } ?>>편집장</option>
						<!-- <option value="6" <? if($_GET['grade']=="6"){ ?>selected<? } ?>>시스템관리자</option>
						<option value="7" <? if($_GET['grade']=="7"){ ?>selected<? } ?>>학생회원</option>
						<option value="8" <? if($_GET['grade']=="8"){ ?>selected<? } ?>>대표간사</option>
						<option value="9" <? if($_GET['grade']=="9"){ ?>selected<? } ?>>임시대표간사</option>
						<option value="10" <? if($_GET['grade']=="10"){ ?>selected<? } ?>>최고관리자</option> -->
				</select>

				<select name="cat" id="cat" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<? 
						$arr = get_category(); 
						for($i=0;$i<count($arr);$i++){
					?>
						<option value="<?=$arr[$i]['cvalue']?>"  <? if($_GET['cat']==$arr[$i]['cvalue']){ ?>selected<? } ?>><?=$arr[$i]['ctext']?></option>
					<?
						}	
					?>
				</select>

				<input type="text" name="sc_text" id="sc_text" value="<?=$_GET['sc_text']?>"/>

				<input type="image" src="../images/btn_search.png" align="absmiddle" style="width:60px;height:25px;border:0px;"/>
			</td>
		</tr>
		<tr>
			<td height="32">&nbsp;</td>
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
				<th><strong>이름</strong></th>
				<th><strong>아이디</strong></th>
				<th><strong>등급</strong></th>
				<th><strong>소속</strong></th>
				<th><strong>분야</strong></th>
				<th><strong>연락처</strong></th>
				<!--th><strong>이메일</strong></th-->
				<th width="170"><strong>관리</strong></th>
			</tr>
			<?
				if(count($list)){
					for ($i=0; $i<count($list); $i++) {  	
			?>
			<tr>
				<td><?=$list[$i]['num']?></td>
				<td><b><?=$list[$i]['mb_name']?></b></td>
				<td><strong><?=$list[$i]['mb_id']?></strong></td>
				<td><?=get_member_level($list[$i]['mb_level'])?></td>
				<td><?=$list[$i]['mb_1']?></td>
				<td><? if($list[$i]['field']){ ?><?=get_category($list[$i]['field'])?><? } ?></td>
				<td><?=$list[$i]['mb_tel']?></td>
				<!--td><?=$list[$i]['mb_email']?></td-->
				<td>
					<a href="./d_member_write.php?mb_no=<?=$list[$i]['mb_no']?>"><img src="../images/btn_modify.png" class="mr5" /></a><a href="javascript:deleteMember('<?=$list[$i]['mb_no']?>');"><img src="../images/btn_delete1.png"  /></a>
				</td>
			</tr>
			<?
					}
				}else{
			?>
			<tr>
				<td colspan="9" class="text-center">
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
	location.href = "./d_process.php?mode=delete_member&mb_no="+mb_no;
}
</script>
<script> 
function cateChk(obj){
	if(obj.value == 'grade'){
		$("#grade").show();
		$("#cat").hide();
		$("#sc_text").hide();
	}else if(obj.value =='cat'){
		$("#grade").hide();
		$("#cat").show();
		$("#sc_text").hide();
	}else{
		$("#grade").hide();
		$("#cat").hide();
		$("#sc_text").show();
	}
}

<? if($_GET['sc_cate']=='grade'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>

<? if($_GET['sc_cate']=='cat'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>