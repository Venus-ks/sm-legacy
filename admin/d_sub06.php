<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a6";
$where = " 1 ";
### SEARCH
if($_GET['sc_cate']=='result' && $_GET['result']){
	if($_GET['sdate'] || $_GET['edate']){
		if($_GET['sdate'] && $_GET['edate']){
			$where .= " AND a.regdate >= '{$_GET['sdate']}' AND a.regdate <= '{$_GET['edate']}' ";
		}else if($_GET['sdate'] && !$_GET['edate']){
			$where .= " AND a.regdate >= '{$_GET['sdate']}' ";
		}else if(!$_GET['sdate'] && $_GET['edate']){
			$where .= " AND a.regdate <= '{$_GET['edate']}' ";
		}
	}
	$where .= " AND a.seq = b.parent_seq AND b.result = '{$_GET['result']}' ";
}else{
	if($_GET['sdate'] || $_GET['edate']){
		if($_GET['sdate'] && $_GET['edate']){
			$where .= " AND regdate >= '{$_GET['sdate']}' AND regdate <= '{$_GET['edate']}' ";
		}else if($_GET['sdate'] && !$_GET['edate']){
			$where .= " AND regdate >= '{$_GET['sdate']}' ";
		}else if(!$_GET['sdate'] && $_GET['edate']){
			$where .= " AND regdate <= '{$_GET['edate']}' ";
		}
	}
}
/*if($_GET['sdate'] || $_GET['edate']){
	if($_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' AND regdate <= '{$_GET['edate']}' ";
	}else if($_GET['sdate'] && !$_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' ";
	}else if(!$_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate <= '{$_GET['edate']}' ";
	}
}*/
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
if($_GET['sc_cate']=='step' && $_GET['step']){
	$where .= " AND step = '{$_GET['step']}' ";
}
$nowdate = date('Ymd',strtotime ('+2 week'));
if($_GET['delay']){
$where .= " AND (review_a_conf='Y' and review_a_date < '{$nowdate}' and review_a_result ='0') or
(review_b_conf='Y' and review_b_date < '{$nowdate}' and review_b_result ='0') or
(review_c_conf='Y' and review_c_date < '{$nowdate}' and review_c_result ='0') or
(review_d_conf='Y' and review_d_date < '{$nowdate}' and review_d_result ='0') or
(review_e_conf='Y' and review_e_date < '{$nowdate}' and review_e_result ='0')";
}
###
$board[bo_page_rows] = 10;
if($_GET['sc_cate']=='result' && $_GET['result']){
	$tsql = " select distinct a.seq from ad_paper a, ad_paper_total b where {$where}";
}else{
	$tsql = " select distinct seq from ad_paper where {$where}";
}
//$tsql = " select distinct seq from ad_paper where {$where}";
$result = sql_query($tsql);
$total_count = mysqli_num_rows($result);
$total_page  = ceil($total_count / $board[bo_page_rows]);  // 전체 페이지 계산
if (!$page) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $board[bo_page_rows]; // 시작 열을 구함
### ORDER BY
if($_GET['sc_cate']=='result' && $_GET['result']){
	if($_GET['order']==''){
		$sql_order = " order by a.seq desc ";
	}
	if($_GET['order']=='step' && $_GET['orderColumn1']=='desc'){
		$sql_order = " order by a.step desc";
	}else if($_GET['order']=='step' && $_GET['orderColumn1']=='asc'){
		$sql_order = " order by a.step asc";
	}
	if($_GET['order']=='seq' && $_GET['orderColumn2']=='desc'){
		$sql_order = " order by a.seq desc";
	}else if($_GET['order']=='seq' && $_GET['orderColumn2']=='asc'){
		$sql_order = " order by a.seq asc";
	}
	if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='desc'){
		$sql_order = " order by a.jourmal desc";
	}else if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='asc'){
		$sql_order = " order by a.jourmal asc";
	}
	if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='desc'){
		$sql_order = " order by a.manuscript desc";
	}else if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='asc'){
		$sql_order = " order by a.manuscript asc";
	}
	if($_GET['order']=='review_category' && $_GET['orderColumn5']=='desc'){
		$sql_order = " order by a.review_category desc";
	}else if($_GET['order']=='review_category' && $_GET['orderColumn5']=='asc'){
		$sql_order = " order by a.review_category asc";
	}
	if($_GET['order']=='title' && $_GET['orderColumn6']=='desc'){
		$sql_order = " order by a.title desc";
	}else if($_GET['order']=='title' && $_GET['orderColumn6']=='asc'){
		$sql_order = " order by a.title asc";
	}
	if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='desc'){
		$sql_order = " order by a.mb_name desc";
	}else if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='asc'){
		$sql_order = " order by a.mb_name asc";
	}
}else{
	if($_GET['order']==''){
		$sql_order = " order by seq desc ";
	}
	if($_GET['order']=='step' && $_GET['orderColumn1']=='desc'){
		$sql_order = " order by step desc";
	}else if($_GET['order']=='step' && $_GET['orderColumn1']=='asc'){
		$sql_order = " order by step asc";
	}
	if($_GET['order']=='seq' && $_GET['orderColumn2']=='desc'){
		$sql_order = " order by seq desc";
	}else if($_GET['order']=='seq' && $_GET['orderColumn2']=='asc'){
		$sql_order = " order by seq asc";
	}
	if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='desc'){
		$sql_order = " order by jourmal desc";
	}else if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='asc'){
		$sql_order = " order by jourmal asc";
	}
	if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='desc'){
		$sql_order = " order by manuscript desc";
	}else if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='asc'){
		$sql_order = " order by manuscript asc";
	}
	if($_GET['order']=='review_category' && $_GET['orderColumn5']=='desc'){
		$sql_order = " order by review_category desc";
	}else if($_GET['order']=='review_category' && $_GET['orderColumn5']=='asc'){
		$sql_order = " order by review_category asc";
	}
	if($_GET['order']=='title' && $_GET['orderColumn6']=='desc'){
		$sql_order = " order by title desc";
	}else if($_GET['order']=='title' && $_GET['orderColumn6']=='asc'){
		$sql_order = " order by title asc";
	}
	if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='desc'){
		$sql_order = " order by mb_name desc";
	}else if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='asc'){
		$sql_order = " order by mb_name asc";
	}
}
/*if($_GET['order']==''){
	$sql_order = " order by seq desc ";
}
if($_GET['order']=='step' && $_GET['orderColumn1']=='desc'){
	$sql_order = " order by step desc";
}else if($_GET['order']=='step' && $_GET['orderColumn1']=='asc'){
	$sql_order = " order by step asc";
}
if($_GET['order']=='seq' && $_GET['orderColumn2']=='desc'){
	$sql_order = " order by seq desc";
}else if($_GET['order']=='seq' && $_GET['orderColumn2']=='asc'){
	$sql_order = " order by seq asc";
}
if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='desc'){
	$sql_order = " order by jourmal desc";
}else if($_GET['order']=='jourmal' && $_GET['orderColumn3']=='asc'){
	$sql_order = " order by jourmal asc";
}
if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='desc'){
	$sql_order = " order by manuscript desc";
}else if($_GET['order']=='manuscript' && $_GET['orderColumn4']=='asc'){
	$sql_order = " order by manuscript asc";
}
if($_GET['order']=='review_category' && $_GET['orderColumn5']=='desc'){
	$sql_order = " order by review_category desc";
}else if($_GET['order']=='review_category' && $_GET['orderColumn5']=='asc'){
	$sql_order = " order by review_category asc";
}
if($_GET['order']=='title' && $_GET['orderColumn6']=='desc'){
	$sql_order = " order by title desc";
}else if($_GET['order']=='title' && $_GET['orderColumn6']=='asc'){
	$sql_order = " order by title asc";
}
if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='desc'){
	$sql_order = " order by mb_name desc";
}else if($_GET['order']=='mb_name' && $_GET['orderColumn7']=='asc'){
	$sql_order = " order by mb_name asc";
}
*/
###
//$sql		= " select * from ad_paper where {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
if($_GET['sc_cate']=='result' && $_GET['result']){
	$sql		= " select *, b.tseq as btseq, b.parent_seq as bparent_seq, b.mb_id as bmb_id, b.mb_name as bmb_name, b.result as bresult, b.comments as bcomments, b.rfile as brfile, b.regdate as bregdate from ad_paper a,ad_paper_total b where {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
}else{
	$sql		= " select * from ad_paper where {$where} $sql_order limit $from_record, $board[bo_page_rows] ";
}
//echo $sql;
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
//$write_pages = get_paging(10, $page, $total_page, "./d_sub06.php?sdate={$_GET['sdate']}&edate={$_GET['edate']}&sc_cate={$_GET['sc_cate']}&journal={$_GET['journal']}&category={$_GET['category']}&sc_text={$_GET['sc_text']}&step={$_GET['step']}&order={$_GET['order']}&orderColumn1={$_GET['orderColumn1']}&orderColumn2={$_GET['orderColumn2']}&orderColumn3={$_GET['orderColumn3']}&orderColumn4={$_GET['orderColumn4']}&orderColumn5={$_GET['orderColumn5']}&orderColumn6={$_GET['orderColumn6']}&orderColumn7={$_GET['orderColumn7']}&x={$_GET['x']}&y={$_GET['y']}&order={$_GET['order']}&delay={$_GET['delay']}2014-01-162014-01-16&page=");
$write_pages = get_paging(10, $page, $total_page, "./d_sub06.php?sdate={$_GET['sdate']}&edate={$_GET['edate']}&sc_cate={$_GET['sc_cate']}&journal={$_GET['journal']}&category={$_GET['category']}&sc_text={$_GET['sc_text']}&step={$_GET['step']}&order={$_GET['order']}&orderColumn1={$_GET['orderColumn1']}&orderColumn2={$_GET['orderColumn2']}&orderColumn3={$_GET['orderColumn3']}&orderColumn4={$_GET['orderColumn4']}&orderColumn5={$_GET['orderColumn5']}&orderColumn6={$_GET['orderColumn6']}&orderColumn7={$_GET['orderColumn7']}&x={$_GET['x']}&y={$_GET['y']}&order={$_GET['order']}&delay={$_GET['delay']}&page=");
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
		<td background="../images/titlebg.png"><img src="../images/03_title06.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">
		<!-- ### SEARCH -->
		<form name="form1">
		<table width="800" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="340">
				검색기간 :
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
					<option value="step" <? if($_GET['sc_cate']=='step'){ ?>selected<? } ?>>상태</option>
					<option value="result" <? if($_GET['sc_cate']=='result'){ ?>selected<? } ?>>심사결과</option>
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
				<select name="step" id="step" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<option value="1" <?if($_GET['step']=='1'){?>selected<?}?>>논문접수 대기</option>
					<option value="2" <?if($_GET['step']=='2'){?>selected<?}?>>심사위원 추천대기</option>
					<option value="3" <?if($_GET['step']=='3'){?>selected<?}?>>심사위원 선정대기</option>
					<option value="4" <?if($_GET['step']=='4'){?>selected<?}?>>심사중(1차)</option>
					<option value="5" <?if($_GET['step']=='5'){?>selected<?}?>>검토대기(1차)</option>
					<option value="10" <?if($_GET['step']=='10'){?>selected<?}?>>수정 요청(2차)</option>
					<option value="11" <?if($_GET['step']=='11'){?>selected<?}?>>논문접수 대기(2차)</option>
					<option value="14" <?if($_GET['step']=='14'){?>selected<?}?>>심사중(2차)</option>
					<option value="15" <?if($_GET['step']=='15'){?>selected<?}?>>검토대기(2차)</option>
					<option value="20" <?if($_GET['step']=='20'){?>selected<?}?>>수정 요청(3차)</option>
					<option value="21" <?if($_GET['step']=='21'){?>selected<?}?>>논문접수 대기(3차)</option>
					<option value="24" <?if($_GET['step']=='24'){?>selected<?}?>>심사중(3차)</option>
					<option value="25" <?if($_GET['step']=='25'){?>selected<?}?>>검토대기(3차)</option>
					<option value="50" <?if($_GET['step']=='50'){?>selected<?}?>>최종심사 대기</option>
					<option value="51" <?if($_GET['step']=='51'){?>selected<?}?>>최종완료</option>
				</select>
				<select name="result" id="result" style="width:100px;height:24px;line-height:21px;display:none;">
					<option value="">= 선택 =</option>
					<option value="1" <?if($_GET['result']=='1'){?>selected<?}?>>게재승인</option>
					<option value="4" <?if($_GET['result']=='4'){?>selected<?}?>>게재불가</option>
				</select>
				<input type="checkbox" name="delay" <?if($_GET['delay']){?>checked<?}?>>심사지연논문보기
				<input type="image" src="../images/btn_search.png" align="absmiddle" style="width:60px;height:25px;border:0px;"/></td>
		</tr>
		<tr>
			<td height="32">&nbsp;</td>
		</tr>
		<!--
		<tr>
			<td><a href="#"><img src="../images/btn_review_progress_status.png" /></a></td>
		</tr>
		-->
		</table>
		<input type="hidden" name="order" id="order">
		<input type="hidden" name="orderColumn1" id="orderColumn1" value="<?=$_GET['orderColumn1']?>">
		<input type="hidden" name="orderColumn2" id="orderColumn2" value="<?=$_GET['orderColumn2']?>">
		<input type="hidden" name="orderColumn3" id="orderColumn3" value="<?=$_GET['orderColumn3']?>">
		<input type="hidden" name="orderColumn4" id="orderColumn4" value="<?=$_GET['orderColumn4']?>">
		<input type="hidden" name="orderColumn5" id="orderColumn5" value="<?=$_GET['orderColumn5']?>">
		<input type="hidden" name="orderColumn6" id="orderColumn6" value="<?=$_GET['orderColumn6']?>">
		<input type="hidden" name="orderColumn7" id="orderColumn7" value="<?=$_GET['orderColumn7']?>">
		</form>
		<!-- ### LIST -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td class="borderbox">
				<strong>· Total : <font class="point"><?=number_format($total_count)?></font></strong> Item
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<!--input type="button" value="엑셀다운" style="height:22px;background-color:#000;color:#fff;border:1px solid #000;" onclick="excel_down();"-->
				<img src="../images/excel_download.png" border="0" align="absmiddle" onclick="excel_down();" style="cursor:pointer;">
			</td>
		</tr>
		<tr><td height="6"></td></tr>
		<tr>
			<td>
			<table width="100%" class="boardType01">
			<tr>
				<!--th rowspan="2"><strong>No</strong></th>
				<th rowspan="2"><strong>저널명칭</strong><br />Journal Title<br /></th>
				<th rowspan="2"><strong>긴급여부</strong><br />Urgent Review<br /></th>
				<th rowspan="2"><strong>분야</strong><br />Category<br /></th>
				<th rowspan="2"><strong>논문명칭</strong><br />Paper Title</th>
				<th colspan="4"><strong>논문 접수</strong></th>
				<th colspan="2">심사 의견</th>
				<th rowspan="2"><strong>상태</strong><br />Status</th-->
				<th width="20" rowspan="2"><strong>No</strong></th>
				<th width="70" rowspan="2" style="cursor:pointer;" onClick="javascript:orderview('step');"><strong>상태<br/>Status<br/><div id="column1"><?if ($_GET['orderColumn1']=='asc'){?>▲<?}else if($_GET['orderColumn1']=='desc'){?>▼<?}?></div></strong></th>
				<th width="78" rowspan="2" onClick="javascript:orderview('seq');" style="cursor:pointer;"><strong>논문번호<br/>
				  Paper Number<br/><div id="column2"><?if ($_GET['orderColumn2']=='asc'){?>▲<?}else if($_GET['orderColumn2']=='desc'){?>▼<?}?></div></div></strong></th>
				<!--th width="53" rowspan="2" onClick="javascript:orderview('jourmal');" style="cursor:pointer;"><strong>저널명<br/>Journal Title<br/><div id="column3"><?if ($_GET['orderColumn3']=='asc'){?>▲<?}else if($_GET['orderColumn3']=='desc'){?>▼<?}?></div></div></strong></th-->
				<th width="65" rowspan="2" style="cursor:pointer;" onClick="javascript:orderview('manuscript');"><strong>원고종류<br/>Type of Paper<div id="column4"><?if ($_GET['orderColumn4']=='asc'){?>▲<?}else if($_GET['orderColumn4']=='desc'){?>▼<?}?></div></div></strong></th>
				<!--th rowspan="2"><strong>심사성격<br/>Urgent Review</strong></th-->
				<th width="105" rowspan="2" style="cursor:pointer;" onClick="javascript:orderview('review_category');"><strong>심사요청분야<br/>Review Category<br/><div id="column5"><?if ($_GET['orderColumn5']=='asc'){?>▲<?}else if($_GET['orderColumn5']=='desc'){?>▼<?}?></div></div></strong></th>
				<th rowspan="2" style="cursor:pointer;" onClick="javascript:orderview('title');"><strong>논문명<br/>Title<br/><div id="column6"><?if ($_GET['orderColumn6']=='asc'){?>▲<?}else if($_GET['orderColumn6']=='desc'){?>▼<?}?></div></div></strong></th>
				<th width="50" rowspan="2" style="cursor:pointer;" onClick="javascript:orderview('mb_name');"><strong>투고자<br/>Author<br/><div id="column7"><?if ($_GET['orderColumn7']=='asc'){?>▲<?}else if($_GET['orderColumn7']=='desc'){?>▼<?}?></div></div></strong></th>
				<!--th colspan="4"><strong>일자<br/>Date</strong></th-->
				<th width="100" rowspan="2"><strong>일자<br/>Date</strong></th>
				<th colspan="3"><strong>심사 의견<br/>Review</strong></th>
<!--th rowspan="2"><strong>상태<br/>Status</strong></th-->
			</tr>
			<tr>
				<!--th><strong>투고일</strong><br />Submission Date</th>
				<th><strong>접수일</strong><br />Received Date</th>
				<th><strong>접수번호</strong><br />Manuscript Number</th>
				<th><strong>수정일</strong><br />Revised Date</th>
				<th><strong>의견등록일</strong><br />Review Date</th>
				<th><strong>의견</strong><br />Result</th-->
				<!--th><strong>투고일<br/>Submission Date</strong></th>
				<th><strong>접수일<br/>Received Date</strong></th>
				<th><strong>수정일<br/>Revised Date</strong></th>
				<th><strong>최종심사 완료일<br/>Accepted Date</strong></th-->
				<th width="75"><strong>심사위원<br/>Reviewer</strong></th>
				<th width="85"><strong>의견등록일<br/>
				  Review Date</strong></th>
				<th width="100"><strong>심사결과<br/>Result</strong></th>
			</tr>
			<?php
			if(count($list)){
				for ($i=0; $i<count($list); $i++) {
					$sql = "select * from ad_paper_review where parent_seq = '{$list[$i]['seq']}' order by rstep asc  limit 9";
					$ress = sql_query($sql);
					unset($review);
					while ($row = sql_fetch_array($ress)) $review[] = $row;
					?>
					<tr class="brc">
						<td height="15"><?=$list[$i]['num']?></td>
						<td height="15"><?=get_status($list[$i]['seq'])?></td>
						<?php
						$cyear = date("y");
						if(strlen($list[$i]['number']) == 1) $number = "00".$list[$i]['number'];
						elseif(strlen($list[$i]['number']) == 2) $number = "0".$list[$i]['number'];
						else $number = $list[$i]['number'];
						?>
						<td height="15"><?=$info['abbr']?>-<?=$cyear?>-<?=$number?></td>
						<td height="15"><? if($list[$i]['manuscript']){ ?><?=get_manuscript($list[$i]['manuscript'])?><? } ?></td>
						<?php
						$rv_category = str_replace("(", "<br/>", get_category($list[$i]['review_category']));
						$rv_category = str_replace(")", " ", $rv_category);
						$rv_category_target = str_replace("(", "<br/>", get_category_target($list[$i]['review_category_target']));
						$rv_category_target = str_replace(")", " ", $rv_category_target);
						?>
						<td height="15"><? if($list[$i]['review_category_target']){ ?><?=$rv_category_target?><? } ?><? if($list[$i]['review_category']){ ?><br/>------------<br/><?=$rv_category?><? } ?></td>
						<td height="15"><a href="./d_sub06_write.php?seq=<?=$list[$i]['seq']?>"><font color="#0088de" style="font-weight:bold"><?=$list[$i]['title']?></font></a></td>
						<td height="15"><?=$list[$i]['mb_name']?></td>
						<?php
							$sqlad = "select regdate from ad_paper_total where parent_seq = '{$list[$i]['seq']}'";
							$acptdate = sql_fetch($sqlad);
						?>
						<td height="15" style="width:65px;text-align:left;">
							<?php if($list[$i]['regdate'] && $list[$i]['regdate'] != '0000-00-00'):?>
								투고일(SD)<br/><?=substr($list[$i]['regdate'],0,10)?><br/><br/>
							<?php endif?>
							<!-- <?php if($list[$i]['submit_date'] && $list[$i]['submit_date'] != '0000-00-00'):?>
								접수일(RD)<br/><?=substr($list[$i]['submit_date'],0,10)?><br/><br/>
							<?php endif?> -->
							<?php if($list[$i]['modify_date'] && $list[$i]['modify_date'] != '0000-00-00'):?>
								수정일(RD)<br/><?=substr($list[$i]['modify_date'],0,10)?><br/><br/>
							<?php endif?>
							<?php if($acptdate['regdate'] && $acptdate['regdate'] != '0000-00-00'):?>
								완료일(AD)<br/><?=substr($acptdate['regdate'],0,10)?>
							<?php endif?>
						</td>
						<td height="15">
							<table border="0" cellspacing="0" cellpadding="0">
							<?
							if($review){
								foreach($review as $k){
									if($k['rstep']=='1') $str = "1<sup>ST</sup>";
									if($k['rstep']=='2') $str = "2<sup>ND</sup>";
									if($k['rstep']=='3') $str = "3<sup>RD</sup>";
									echo "<tr><td style='height:110px;border-color:#ffffff;'>".$str." ".$k['mb_name']."</td></tr>";
								}
							}
							?>
							</table>
						</td>
						<td height="15">
							<table border="0" cellspacing="0" cellpadding="0">
							<?
							if($review){
								foreach($review as $k){
									if($k['rstep']=='1') $str = "1<sup>ST</sup>";
									if($k['rstep']=='2') $str = "2<sup>ND</sup>";
									if($k['rstep']=='3') $str = "3<sup>RD</sup>";
									echo "<tr><td style='height:110px;border-color:#ffffff;'>".$str." ".$k['regdate']."</td></tr>";
								}
							}
							?>
							</table>
						</td>
						<td height="15">
							<table border="0" cellspacing="0" cellpadding="0">
							<?
							if($review){
								foreach($review as $k){
									if($k['score']){
										$results = str_replace("(", "<br/>", get_result($k['result']));
										$results = str_replace(")", " ", $results);
									}else{
										$results = str_replace("(", "<br/>", get_result_final($k['result']));
									}
									if($k['rstep']=='1') $str = "1<sup>ST</sup>";
									if($k['rstep']=='2') $str = "2<sup>ND</sup>";
									if($k['rstep']=='3') $str = "3<sup>RD</sup>";
									echo "<tr><td style='height:110px;border-color:#ffffff;'>".$str." ".$results."</td></tr>";
								}
							}
							?>
							</table>
						</td>
					</tr>
				<?php
				}
			}else{
			?>
			<tr>
				<td colspan="15">
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
<iframe id="hddFrame" style="display:none;"></iframe>
<script>
function cateChk(obj){
	if(obj.value == 'journal'){
		$("#journal").show();
		$("#category").hide();
		$("#sc_text").hide();
		$("#step").hide();
		$("#result").hide();
	}else if(obj.value =='category'){
		$("#journal").hide();
		$("#category").show();
		$("#sc_text").hide();
		$("#step").hide();
		$("#result").hide();
	}else if(obj.value =='step'){
		$("#journal").hide();
		$("#category").hide();
		$("#sc_text").hide();
		$("#step").show();
		$("#result").hide();
	}else if(obj.value =='result'){
		$("#journal").hide();
		$("#category").hide();
		$("#sc_text").hide();
		$("#step").hide();
		$("#result").show();
	}else{
		$("#journal").hide();
		$("#category").hide();
		$("#sc_text").show();
		$("#step").hide();
		$("#result").hide();
	}
}
function excel_down(){
	$("#hddFrame").attr("src", "d_sub06_excel.php");
}
function orderview(order){
	document.form1.order.value = order;
	if (order=='step'){
		if (document.form1.orderColumn1.value=='asc'){
			document.form1.orderColumn1.value='desc'
		}else if (document.form1.orderColumn1.value=='desc'){
			document.form1.orderColumn1.value='asc'
		}else{
			document.form1.orderColumn1.value='asc'
		}
	}else if (order=='seq'){
		if (document.form1.orderColumn2.value=='asc'){
			document.form1.orderColumn2.value='desc'
		}else if (document.form1.orderColumn2.value=='desc'){
			document.form1.orderColumn2.value='asc'
		}else{
			document.form1.orderColumn2.value='asc'
		}
	}else if (order=='jourmal'){
		if (document.form1.orderColumn3.value=='asc'){
			document.form1.orderColumn3.value='desc'
		}else if (document.form1.orderColumn3.value=='desc'){
			document.form1.orderColumn3.value='asc'
		}else{
			document.form1.orderColumn3.value='asc'
		}
	}else if (order=='manuscript'){
		if (document.form1.orderColumn4.value=='asc'){
			document.form1.orderColumn4.value='desc'
		}else if (document.form1.orderColumn4.value=='desc'){
			document.form1.orderColumn4.value='asc'
		}else{
			document.form1.orderColumn1.value='asc'
		}
	}else if (order=='review_category'){
		if (document.form1.orderColumn5.value=='asc'){
			document.form1.orderColumn5.value='desc'
		}else if (document.form1.orderColumn5.value=='desc'){
			document.form1.orderColumn5.value='asc'
		}else{
			document.form1.orderColumn5.value='asc'
		}
	}else if (order=='title'){
		if (document.form1.orderColumn6.value=='asc'){
			document.form1.orderColumn6.value='desc'
		}else if (document.form1.orderColumn6.value=='desc'){
			document.form1.orderColumn6.value='asc'
		}else{
			document.form1.orderColumn6.value='asc'
		}
	}else if (order=='mb_name'){
		if (document.form1.orderColumn7.value=='asc'){
			document.form1.orderColumn7.value='desc'
		}else if (document.form1.orderColumn7.value=='desc'){
			document.form1.orderColumn7.value='asc'
		}else{
			document.form1.orderColumn7.value='asc'
		}
	}
	document.form1.submit();
	//alert(document.form1.order.value);
}
<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
<? if($_GET['sc_cate']=='step'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
<? if($_GET['sc_cate']=='result'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>
<script>
$(".inline").colorbox({inline:true, width:"70%"});
</script>
