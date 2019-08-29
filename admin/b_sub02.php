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
	<th width="70" rowspan="2"><strong>원고종류<br />Type of Paper</strong></th>
	<th width="80" rowspan="2"><strong>심사요청분야<br />Review Category</strong></th>
	<th rowspan="2"><strong>논문명<br />Title</strong></th>
	<th width="60" rowspan="2"><strong>접수일<br />Received Date</strong></th>
	<th colspan="3"><strong>심사의견<br />Review</strong></th>
</tr>
<tr>
	<th width="100"><strong>심사완료 요청일<br />Expiration Date</th>
	<th width="75"><strong>의견등록일<br />Review Date</th>
	<th width="55"><strong>심사결과<br />Result</th>
</tr>
			<?php if(count($list)):?>
				<?php for ($i=0; $i<count($list); $i++):?>
					<?php
					echo count($list);
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
						<td>KJ-<?=$cyear?>-<?=$number?></td>
						<td><?=$list[$i]['journal']?></td>
						<td><? if($list[$i]['manuscript']){ ?><?=get_manuscript($list[$i]['manuscript'])?><? } ?></td>
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
							<?
							for ($q=0; $q<$p; $q++){
							?>
								<a href='#score_box<?=$review[$q]['rseq']?>' class='inline'>
								<? if($review[$q]['regdate']){?>
									<? if ($q == 0){?>
									1<sup>ST</sup>
									<? }else if ($q == 1){?>
									2<sup>ND</sup>
									<? }else if ($q == 2){?>
									3<sup>RD</sup>
									<? }?>
								<?=get_result($review[$q]['result'])?><br /><? } ?>
								</a>
							<?
							}
							?>
						<?php foreach($review as $k):?>
							<div style='display:none'>
								<div id='score_box<?=$k['rseq']?>' style='padding:10px; background:#fff;font-size: 12px;'>
									<form name="review_form<?=$k['rseq']?>" id="review_form<?=$k['rseq']?>" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
										<input type="hidden" name="mode" value="b_review_modify"/>
										<input type="hidden" name="rseq" value="<?=$k['rseq']?>"/>
										<ul style="list-style:none;font-size:1em;padding-left:5px">
											<?php
												$sq	= "SELECT * FROM `ad_check_review` ORDER BY id ";
												$chklist = sql_query($sq);
												$score_arr = explode('|',$k['score']);
												$j=0;
											?>
											<?php while ($row = sql_fetch_array($chklist)):?>
												<?php if($chk_tmp!=$row['title']):?>
												<h3><?=$row['title']?></h3>
												<?php endif?>
												<?php $chk_tmp=$row['title'];?>
												<li>
													<div style="padding:5px;background-color:#EEE"><?=$row['content']?></div>
													<div style="text-align:right;line-height:10px;padding:5px 0">
														<label for="q<?=$row['id']?>-good">
															<input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-good" value="5" <?=($score_arr[$j]==5)?'checked="checked"':''?>>
															우수&nbsp;&nbsp;&nbsp;
														</label>
														<label for="q<?=$row['id']?>">
															<input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>" value="3" <?=($score_arr[$j]==3)?'checked="checked"':''?>>
															양호&nbsp;&nbsp;&nbsp;
														</label>
														<label for="q<?=$row['id']?>-bad">
															<input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-bad" value="2" <?=($score_arr[$j]==2)?'checked="checked"':''?>>
															미흡&nbsp;&nbsp;&nbsp;
														</label>
													</div>
												</li>
												<?php $j++?>
											<?php endwhile?>
										</ul>
										<hr>
										<select name="result" id="result" style="width:100%;" required>
											<option value="">= 선택 =</option>
											<?
											if($data['step'] > 15) $arr = get_result_temp();
											else $arr = get_result();
											foreach($arr as $v){
											?>
											<option value="<?=$v['cvalue']?>" <?=($k['result']==$v['cvalue'])?'selected':''?>><?=$v['ctext']?></option>
											<? } ?>
										</select>
										<hr>
										<textarea name="comments" id="comments" style="width:100%;" rows="5" required><?=$k['comments']?></textarea>
										<?php if($list[$i]['step'] == 4 || $list[$i]['step'] == 14 || $list[$i]['step'] == 3 || $list[$i]['step'] == 13):?>
											<div style="padding-top:20px">
												<center><button type="submit" class="btn btn-danger">수정하기</button></center>
											</div>
										<?php else:?>
											<div style="padding-top:20px">
												<center><button type="submit" class="btn btn-danger" disabled>수정불가</button></center>
											</div>
										<?php endif?>
									</form>
								</div>
							</div>
						<?php endforeach?>
						</td>
					</tr>
				<?php endfor?>
			<?php else:?>
				<tr>
					<td colspan="14">
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
