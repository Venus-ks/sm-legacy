<?
include_once("./admin_head.php");
###
$mlevel		= 4;
$menu		= "a1";
###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql);
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	while ($row = sql_fetch_array($res)) $loop[] = $row;
	//type 결정
	$sql = "select * from ad_paper_review where parent_seq = '{$_GET['seq']}' and mb_id = '{$member['mb_id']}' order by rstep asc,regdate desc";
	$ress	= sql_query($sql);
	while ($_row = sql_fetch_array($ress)) $review[] = $_row;
	if($data['review_a_user']==$member['mb_id']) $auth_type='A';
	elseif($data['review_b_user']==$member['mb_id']) $auth_type='B';
	elseif($data['review_c_user']==$member['mb_id']) $auth_type='C';
	else $auth_type='-';
}
?>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<style>
input[type="radio"] {cursor:pointer}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" height="800" valign="top" background="/images/leftbg.png">
		<!-- ### LEFT MENU -->
		<? include_once("./_menu.php"); ?>
		</td>
		<td valign="top">
			<form name="form1" id="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="c_sub_review"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="type" value="<?=$auth_type?>"/>
				<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>"/>
				<input type="hidden" name="mb_name" value="<?=$member['mb_name']?>"/>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td background="../images/titlebg.png"><img src="../images/02_title01.png" /></td></tr>
					<tr>
						<td valign="top" style="padding:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Registration</td>
								</tr>
							</table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<?/* 논문정보 */?>
										<?php
											$hidden_author = TRUE;
											include_once("./template/article01.php");
										?>
										<? if($review){ ?>
											<? for($i=0;$i<count($review);$i++){ ?>
												<table class="boardType01_write" style="margin-top:20px;">
													<tr>
														<th width="150"><strong><?=$review[$i]['rstep']?>차 심사 등록일</strong></th>
														<td><?=$review[$i]['regdate']?></td>
													</tr>
													<?php
													//계좌정보
													$acc = explode('|',$review[$i]['account']);
													if(!empty($acc[1])) include('./widget/account.php');
													?>
													<?php
													//설문형태 요구시
													//include('./widget/question-list-result.php')
													?>
													<?php
													//코멘트형태 요구시
													//include('./widget/comment-result.php');
													?>
													<?php
													//첨부형태 요구시
													include('./widget/reviewfile-result.php');
													?>
													<tr>
														<th width="100"><strong>심사결과<br/>Result</strong></th>
														<td><?=get_result($review[$i]['result'])?></td>
													</tr>
												</table>
											<? } ?>
										<? } ?>
										<table class="boardType01_write" style="margin-top:20px;">
											<?php
											//설문형태 요구시
											//include('./widget/question-list.php');
											?>
											<?php
											//코멘트형태 요구시
											//include('./widget/comment.php');
											?>
											<?php
											//첨부형태 요구시
											include('./widget/reviewfile.php');
											?>
											<tr>
												<th width="100"><strong>심사결과<br/>Result</strong></th>
												<td>
													<select name="result" style="width:100%;" required>
														<option value="">= 선택 =</option>
														<?
														if($data['step'] >= 20) $arr = get_result_2nd();
														else $arr = get_result();
														for($i=0;$i<count($arr);$i++){
														?>
														<option value="<?=$arr[$i]['cvalue']?>"><?=$arr[$i]['ctext']?></option>
														<? } ?>
													</select>
												</td>
											</tr>
											<?php
											//계좌정보
											if(empty($acc[1])) include('./widget/account.php');
											?>
										</table>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
											<tr>
												<td align="right" width="50%">
													<input type="image" src="../images/btn_summit.png" alt="" style="border:0px;"/>
												</td>
												<td width="10px">&nbsp;</td>
												<td align="left" width="50%">
													<a href="b_sub01.php"><img src="../images/btn_list.png" /></a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<script type="text/javascript">
function fwrite_submit(f){
	if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./b_process.php";
	return true;
}
function cal_score(){
	var q1 = Number($(':radio[name="q1"]:checked').val());
	var q2 = Number($(':radio[name="q2"]:checked').val());
	var q3 = Number($(':radio[name="q3"]:checked').val());
	var q4 = Number($(':radio[name="q4"]:checked').val());
	var q5 = Number($(':radio[name="q5"]:checked').val());
	var q6 = Number($(':radio[name="q6"]:checked').val());

	if(!q1 || !q2 || !q3 || !q4 || !q5 || !q6 ) {
		alert("점수가 전부 입력되지 않았습니다.");
		return false;
	}
}
</script>
