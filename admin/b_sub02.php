<?
include_once("./admin_head.php");
###
$mlevel		= 4;
$menu		= "a2";
$where = "( (review_a_user = '{$member['mb_id']}' and review_a_conf = 'Y') or (review_b_user = '{$member['mb_id']}' and review_b_conf = 'Y') or (review_c_user = '{$member['mb_id']}' and review_c_conf = 'Y'))";
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
$write_pages = get_paging(10, $page, $total_page, "./b_sub02.php?page=");
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
		<td background="../images/titlebg.png"><img src="../images/02_title02.png" /></td>
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
		<tr>
			<td><a href="#"><img src="../images/btn_review_progress_status.png" /></a></td>
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
			<!--tr>
				<th rowspan="2"><strong>No</strong></th>
				<th rowspan="2"><strong>저널명칭</strong><br />Journal Title<br /></th>
				<th rowspan="2"><strong>분야</strong><br />Category<br /></th>
				<th rowspan="2"><strong>논문명칭</strong><br />Paper Title</th>
				<th colspan="4"><strong>논문 접수</strong></th>
				<th colspan="2">심사 의견</th>
				<th rowspan="2"><strong>상태</strong><br />Status</th>
			</tr>
			<tr>
				<th><strong>투고일</strong><br />Submission Date</th>
				<th><strong>접수일</strong><br />Received Date</th>
				<th><strong>접수번호</strong><br />Manuscript Number</th>
				<th><strong>수정일</strong><br />Revised Date</th>
				<th><strong>의견등록일</strong><br />Review Date</th>
				<th><strong>의견</strong><br />Result</th>
			</tr-->
<tr>
	<th width="30" rowspan="2"><strong>No</strong></th>
	<th width="50" rowspan="2"><strong>상태<br />Status</strong></th>
	<th width="80" rowspan="2"><strong>논문번호<br />Paper Number</strong></th>
	<th width="60" rowspan="2"><strong>저널명<br />Journal Title</strong></th>
	<th width="80" rowspan="2"><strong>심사요청분야<br />Review Category</strong></th>
	<th rowspan="2"><strong>논문명<br />Title</strong></th>
	<th width="60" rowspan="2"><strong>접수일<br />Received Date</strong></th>
	<th colspan="3"><strong>심사의견<br />Review</strong></th>
</tr>
<tr>
	<th width="100"><strong>심사완료 요청일<br />Expiration Date</th>
	<th width="75"><strong>의견등록일<br />Review Date</th>
	<th width="110"><strong>심사결과<br />Result</th>
</tr>
			<?php if(count($list)):?>
				<?php for ($i=0; $i<count($list); $i++):?>
					<?php
					$review = array();
					$sql = "select * from ad_paper_review where parent_seq = '{$list[$i]['seq']}' and mb_id = '{$member['mb_id']}' order by rstep asc limit 3";
					$ress	= sql_query($sql);
					$p = 0;
					while ($row = sql_fetch_array($ress)){
						$review[] = $row;
						$p++;
					}
					?>
					<tr>
						<td><?=$list[$i]['num']?></td>
						<td><?=get_status($list[$i]['seq'], 'review')?></td>
						<td><?=get_papernum($list[$i])?></td>
						<td><?=$list[$i]['journal']?></td>
						<td><? if($list[$i]['review_category_target']){ ?><?=get_category($list[$i]['review_category_target'])?><? } ?></td>
						<td><strong><?=$list[$i]['title']?></strong></td>
						<td><?=substr($list[$i]['regdate'],0,10)?></td>
						<?
						if ($member['mb_id'] == $list[$i]['review_a_user']){
							$e_date = substr($list[$i]['review_a_date'],0,10);
						}else if ($member['mb_id'] == $list[$i]['review_b_user']){
							$e_date = substr($list[$i]['review_b_date'],0,10);
						}else if ($member['mb_id'] == $list[$i]['review_c_user']){
							$e_date = substr($list[$i]['review_c_date'],0,10);
						}else if ($member['mb_id'] == $list[$i]['review_d_user']){
							$e_date = substr($list[$i]['review_d_date'],0,10);
						}else if ($member['mb_id'] == $list[$i]['review_e_user']){
							$e_date = substr($list[$i]['review_e_date'],0,10);
						}
						?>
						<td><?=$e_date?></td>
						<td>
							<?
							for ($q=0; $q<$p; $q++){
							?>
								<? if($review[$q]['regdate']){?>
									<? if ($q == 0){?>
									1<sup>ST</sup>
									<? }else if ($q == 1){?>
									2<sup>ND</sup>
									<? }else if ($q == 2){?>
									3<sup>RD</sup>
									<? }?>
								<?=$review[$q]['regdate']?><br /><? } ?>
							<?
							}
							?>
						</td>
						<td>
							<?php for ($q=0; $q<$p; $q++):?>
								<button type="button" class="btn btn-<?=($review[$q]['result']==4)?'danger':'info'?> btn-sm" data-toggle="modal" data-target="#review-<?=$review[$q]['rseq']?>-Modal" data-whatever="@mdo">
								<? if($review[$q]['regdate']){?>
									<? if ($q == 0){?>
									1<sup>ST</sup>
									<? }else if ($q == 1){?>
									2<sup>ND</sup>
									<? }else if ($q == 2){?>
									3<sup>RD</sup>
									<? }?>
								<?=get_result($review[$q]['result'])?><br /><? } ?>
								</button>
							<?php endfor ?>
						
							<?php foreach($review as $v):?>
								<div class="modal fade" id="review-<?=$v['rseq']?>-Modal" tabindex="-1" role="dialog" aria-labelledby="review-<?=$v['rseq']?>-ModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="review-<?=$v['rseq']?>-ModalLabel">
												<?=$v['rstep'] == 4 ? '편집자' : $v['rstep'].'차'?> 심사결과
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form>
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">심사결과</label>
												<input type="text" class="form-control" id="recipient-name" disabled value="<?=get_result($v['result'])?>">
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">심사의견서</label>
												<p class="h6">
												<?=end(explode("/",substr(strstr($v['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=urlencode($v['rfile'])?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
												</p>
											</div>
											<!-- <div class="form-group">
												<label for="result">심사결과표</label>
												<div>
												<?php 
													if($v['score']) {
														$scores = $v['score'];
														$rseq = $v['rseq'];
														include("./widget/question-list-result.php");
													}
												?>
												</div>		
											</div> -->
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
										</div>
									</div>
									</div>
							<?php endforeach ?>
						</td>
					</tr>
				<?php endfor?>
			<?php else:?>
				<tr>
					<td colspan="14" class="text-center">
						해당하는 데이터가 없습니다.
					</td>
				</tr>
			<?php endif?>
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
<script>
function fwrite_submit(f){
	if(!confirm("수정사항 재확인바랍니다. 확실합니까?")) return false;
	f.action = "./b_process.php";
	return true;
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
<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>
<script>
$(".inline").colorbox({inline:true, width:"70%"});
</script>
