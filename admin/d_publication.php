<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "c1";

//SELECT * FROM ad_paper a, ad_paper_total b
//where a.seq = b.parent_seq and b.result ='1' and a.step = '51'


###
//$where		= " step = 3 ";
$where		= " a.seq = b.parent_seq and b.result ='1' and a.step = '51' ";



### SEARCH
if($_GET['sdate'] || $_GET['edate']){
	if($_GET['sdate'] && $_GET['edate']){
		$where .= " AND a.regdate >= '{$_GET['sdate']}' AND a.regdate <= '{$_GET['edate']}' ";
	}else if($_GET['sdate'] && !$_GET['edate']){
		$where .= " AND a.regdate >= '{$_GET['sdate']}' ";
	}else if(!$_GET['sdate'] && $_GET['edate']){
		$where .= " AND a.regdate <= '{$_GET['edate']}' ";
	}
}
###
if($_GET['sc_cate']=='category' && $_GET['category']){
	$where .= " AND a.review_category = '{$_GET['category']}' ";
}
if($_GET['sc_cate']=='journal' && $_GET['journal']){
	$where .= " AND a.journal = '{$_GET['journal']}' ";
}
if($_GET['sc_cate']=='title' && $_GET['sc_text']){
	$where .= " AND a.title  like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='name' && $_GET['sc_text']){
	$where .= " AND a.mb_name  like '%{$_GET['sc_text']}%' ";
}


###
$board[bo_page_rows] = 10;
//$tsql = " select distinct seq from ad_paper where {$where}";
$tsql = " SELECT distinct a.seq FROM ad_paper a, ad_paper_total b where {$where}";
$result = sql_query($tsql);
$total_count = mysqlI_num_rows($result);

$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함

### ORDER BY
$sql_order = " order by a.seq desc ";

###
$sql		= " SELECT *, a.mb_id as writer_id, a.mb_name as writer_name, b.regdate as complete_date FROM ad_paper a, ad_paper_total b where {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
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
$write_pages = get_paging(10, $page, $total_page, "./d_publication.php?page=");
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
		<td background="../images/titlebg.png"><img src="../images/01_title03.png" /></td>
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
			<td height="32">&nbsp;</td>
		</tr>
		</table>
		</form>


		<!-- ### LIST -->
		<form name="form2" method="post" onsubmit="return publication_submit(this);" enctype="multipart/form-data">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td class="borderbox"><strong>· Total : <font class="point"><?=number_format($total_count)?></font></strong> Item<!--a href="../data/file/13_author_information.hwp" style="float:right" class="btn btn-default"><span class="glyphicon glyphicon-paperclip"></span> 심사 확인증명서</a--></td>
		</tr>
		<tr><td height="6"></td></tr>
		<tr>
			<td>

			<table class="boardType01">
			<tr>
				<!--th><strong>No</strong></th>
				<th><strong>저널명칭</strong><br />Journal Title<br /></th>
				<th><strong>긴급여부</strong><br />Urgent Review<br /></th>
				<th><strong>분야</strong><br />Category<br /></th>
				<th><strong>논문명칭</strong><br />Paper Title</th>
				<th><strong>투고자</strong><br />Author</th>
				<th><strong>투고일</strong><br />Submission Date</th>
				<th><strong>TO DO</strong></th-->
				<th><strong>No</strong></th>
				<th><strong>논문번호<br/>Manuscript Number</strong></th>
				<th><strong>저널명<br/>Journal Title</strong></th>
				<th><strong>심사요청분야<br/>Review Category</strong></th>
				<th><strong>논문명<br/>Title</strong></th>
				<th><strong>투고자<br/>Author</strong></th>
				<th><strong>최종심사 완료일<br/>Accepted Date</strong></th>
				<th width="80"><strong>출판 권/호<br/>Publication Vol/Issue</strong></th>
				<th><strong>논문최종본<br/>Publication</strong></th>
				<th><strong>TO DO</strong></th>
			</tr>
			<?
				if(count($list)){
					for ($i=0; $i<count($list); $i++) {
			?>
			<tr>
				<!--td><?=$list[$i]['num']?></td>
				<td class="textalingL"><?=$list[$i]['journal']?></td>
				<td class="textalingL"><?=$list[$i]['express_publication']?></td>
				<td class="textalingL"><? if($list[$i]['review_category_target']){ ?><?=get_category($list[$i]['review_category_target'])?><? } ?></td>
				<td><strong><?=$list[$i]['title']?></strong></td>
				<td><?=$list[$i]['mb_name']?></td>
				<td><?=substr($list[$i]['regdate'],0,10)?></td>
				<td><a href="./d_sub03_write.php?seq=<?=$list[$i]['seq']?>"><img src="../images/btn_paper_reviewer2.png"  /></a></td-->
				<td><?=$list[$i]['num']?></td>
				<?
				$cyear = date("y");
				?>
				<?
				if(strlen($list[$i]['number']) == 1){
					$number = "00".$list[$i]['number'];
				}else if(strlen($list[$i]['number']) == 2){
					$number = "0".$list[$i]['number'];
				}else{
					$number = $list[$i]['number'];
				}
				?>
				<td>KJ-<?=$cyear?>-<?=$number?><input type="hidden" name="number_<?=$list[$i]['seq']?>" value="<?=$list[$i]['number']?>"/></td>
				<td><?=$list[$i]['journal']?></td>
				<td><? if($list[$i]['review_category_target']){ ?><?=get_category($list[$i]['review_category_target'])?><? } ?></td>
				<td><strong><?=$list[$i]['title']?></strong><input type="hidden" name="title_<?=$list[$i]['seq']?>" value="<?=$list[$i]['title']?>"/></td>
				<td><?=$list[$i]['writer_name']?><input type="hidden" name="writer_name_<?=$list[$i]['seq']?>" value="<?=$list[$i]['writer_name']?>"/><input type="hidden" name="writer_id_<?=$list[$i]['seq']?>" value="<?=$list[$i]['writer_id']?>"/></td>
				<td><?=substr($list[$i]['complete_date'],0,10)?></td>
				<td>
					<? if($list[$i]['publish_conf'] == 'Y'){ ?>
					<?=$list[$i]['publish_vol']?>권&nbsp;<?=$list[$i]['publish_issue']?>호
					<? } else {?>
					<input type="text" name="vol_<?=$list[$i]['seq']?>" id="vol_<?=$list[$i]['seq']?>" style="width:25px;">권&nbsp;<input type="text" name="issue_<?=$list[$i]['seq']?>" id="issue_<?=$list[$i]['seq']?>" style="width:25px;">호
					<? } ?>
				</td>
				<td>
					<? if($list[$i]['publish_conf'] == 'Y'){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$list[$i]['publish_data']?>"><?=end(explode("/",substr(strstr($list[$i]['publish_data'], '^'), 1)))?></a></div>
					<? } else {?>
					<input type="file" name="publication_file_<?=$list[$i]['seq']?>" id="publication_file_<?=$list[$i]['seq']?>" style="width:70px;" required/>
					<? } ?>
				</td>
				<td>
					<? if($list[$i]['publish_conf'] == 'Y'){ ?>
					<img src="../images/btn_publication_m.png" width="91" height="21" style="cursor:pointer;" onclick="javascript:publication_cancel('<?=$list[$i]['seq']?>');"/>
					<? } else {?>
					<img src="../images/btn_publication_a.png" width="91" height="21" style="cursor:pointer;" onclick="javascript:publication_submit('<?=$list[$i]['seq']?>');"/>
					<? } ?>
				</td>
			</tr>
			<?
					}
				}else{
			?>
			<tr>
				<td colspan="10">
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
		<input type="hidden" id="seq" name="seq">
		<input type="hidden" id="mode" name="mode" value="publication_ok">
		</form>


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
<iframe id="hddFrame" name="hddFrame" style="display:none;"></iframe>

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

function publication_submit(seq,num){

	var seq = seq;
	var num = num;

	document.getElementById('seq').value = seq;

	if (document.getElementById('vol_'+seq).value == ""){
		alert("해당 논문이 실릴 논문집의 권을 입력해주세요.");
		return false;
	}

	if (document.getElementById('issue_'+seq).value == ""){
		alert("해당 논문이 실릴 논문집의 호를 입력해주세요.");
		return false;
	}

	/* if (document.getElementById('publication_file_'+seq).value == ""){
		alert("게재예정 증명서를 업로드해주세요.");
		return false;
	} */

	//hddFrame.location.href = "../admin/d_process.php?mode=publication_ok&seq="+seq;
	document.form2.action = "../admin/d_process.php";
	document.form2.submit();
	return true;
}


function publication_cancel(seq){

	var seq = seq;

	hddFrame.location.href = "../admin/d_process.php?mode=publication_cancel&seq="+seq;
}

<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>

<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>
