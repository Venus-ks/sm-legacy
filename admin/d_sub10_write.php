<style>
input[type="radio"] {cursor:pointer}
</style>
<?
include_once("./admin_head.php");
###
$mlevel		= 4;
$menu		= "a1";
###
if($_GET['rseq']){
	$sql = "select * from ad_paper_review where rseq = '{$_GET['rseq']}' order by regdate desc";
	$ress	= sql_query($sql);
	while ($row = sql_fetch_array($ress)){
		$review = $row;
	}
	$sql	= "select * from ad_paper where seq = '{$review['parent_seq']}'";
	$data	= sql_fetch($sql);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" height="800" valign="top" background="/images/leftbg.png">
		<!-- ### LEFT MENU -->
		<? include_once("./_menu.php"); ?>
		</td>
		<td valign="top">
			<form name="form1" id="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="d_sub10_reg"/>
				<input type="hidden" name="rseq" value="<?=$_GET['rseq']?>"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="reviewer" value="<?=$_GET['reviewer']?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td background="../images/titlebg.png"><img src="../images/02_title01.png" /></td></tr>
					<tr>
						<td valign="top" style="padding:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Score Registration</td>
								</tr>
							</table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
								<tr>
									<td>
										<table class="boardType01_write">
											<tr>
												<th>논문번호<br/>Manuscript Number</th>
												<td><?=get_papernum($list[$i])?></td>
											</tr>
											<tr>
												<th><strong>심사위원명<br/>Reviewer Name</strong></th>
												<td><?=$review['mb_name']?></td>
											</tr>
											<tr>
												<th>논문명(국문)<br/>Manuscript Title (Kor)</th>
												<td><?=$data['title']?></td>
												<input type="hidden" name="title" value="<?=$data['title']?>">
											</tr>
											<tr>
												<th>투고논문파일<br/>Manuscript File</th>
												<td>
												<? if($data['modify_file']){ ?> 
												<div style="padding-top:5px;"><?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?> <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a></div>
												<? } ?>
												</td>
											</tr>
										</table>
										<table class="boardType01_write" style="margin-top:20px;">
											<tr>
												<th width="100"><strong>심사결과<br/>Result</strong></th>
												<td style="border-bottom:1px solid #EEE">
													<?php
													$score_arr = explode('|',$review['score']);
													$j = 0;
													$sql	= "SELECT * FROM `ad_check_review` ORDER BY id ";
													$chklist = sql_query($sql);
													?>
													<ul style="list-style:none;font-size:1em;padding-left:5px">
													<?php while ($row = sql_fetch_array($chklist)):?>
													<?php if($chk_tmp!=$row['title']):?>
													<h3><?=$row['title']?></h3>
													<?php endif?>
													<?php $chk_tmp=$row['title'];?>
													<li>
														<div style="padding:5px;background-color:#EEE"><?=$row['content']?></div>
														<div style="text-align:right;line-height:10px;padding:5px 0">5점<input type="radio" id="q<?=$row['id']?>" name="q<?=$row['id']?>" <?=($score_arr[$j]==5)?'checked':''?> value="5" required>
														&nbsp;&nbsp;&nbsp;&nbsp;4점<input type="radio" name="q<?=$row['id']?>" <?=($score_arr[$j]==4)?'checked':''?> value="4" required>
														&nbsp;&nbsp;&nbsp;&nbsp;3점<input type="radio" name="q<?=$row['id']?>" <?=($score_arr[$j]==3)?'checked':''?> value="3" required>
														&nbsp;&nbsp;&nbsp;&nbsp;2점<input type="radio" name="q<?=$row['id']?>" <?=($score_arr[$j]==2)?'checked':''?> value="2" required>
														&nbsp;&nbsp;&nbsp;&nbsp;1점<input type="radio" name="q<?=$row['id']?>" <?=($score_arr[$j]==1)?'checked':''?> value="1" required>
														</div>
													</li>
													<?php $j++?>
													<?php endwhile?>	
													</ul>
													<div style="text-align:center;margin:20px 0px">
														<a style="color:#FFF;background-color:#666;cursor:pointer;padding:5px 30px;border:solid #aaa 2px;text-align:right;" onclick="cal_score()">계산</a>
													</div>					
													<div style="text-align:left;font-size:1.2em;padding:3px 0;margin:0 20px" id="score_sum">평가합계 : <input id="sum" name="sum" value="<?=$review['score_sum']?>" readonly></div>
													<div style="text-align:left;font-size:1.2em;padding:3px 0;margin:0 20px" id="score_avg">평가평균 : <input id="avg" name="avg" value="<?=round($review['score_sum']/13,2)?>" readonly></div>
													<br>					
													<select name="result" id="result" style="width:100%;" required onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'>
														<option value="">= 선택 =</option>
														<?php
														$arr = get_result();
														foreach($arr as $v):?>
														<option value="<?=$v['cvalue']?>"><?=$v['ctext']?></option>
														<?php endforeach ?>
													</select>
												</td>
											</tr>
											<tr>
												<th>코멘트<br/>Comments</th>
												<td><textarea name="comments" id="comments" style="width:100%;" rows="15" required><?=$review['comments']?></textarea></td>
											</tr>
										</table>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
											<tr>
											<td align="right" width="50%">
											<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:38px;border:0px;"/>
											</td>
											<td width="10px">&nbsp;</td>
											<td align="left" width="50%">
											<a href="d_sub06_write.php?seq=<?=$data['seq']?>#review_result"><img src="../images/btn_list.png" /></a></td>
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
	if(!f.result.value){
		alert("Result는 필수입니다.");
		f.result.focus();
		return false;
	}
	//if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}
function cal_score(){
	var q1 = Number(2 * $(':radio[name="q1"]:checked').val());
	var q2 = Number(2 * $(':radio[name="q2"]:checked').val());
	var q3 = Number($(':radio[name="q3"]:checked').val());
	var q4 = Number($(':radio[name="q4"]:checked').val());
	var q5 = Number($(':radio[name="q5"]:checked').val());
	var q6 = Number($(':radio[name="q6"]:checked').val());
	var q7 = Number($(':radio[name="q7"]:checked').val());
	var q8 = Number($(':radio[name="q8"]:checked').val());
	var q9 = Number($(':radio[name="q9"]:checked').val());
	var q10 = Number($(':radio[name="q10"]:checked').val());
	var q11 = Number($(':radio[name="q11"]:checked').val());
	
	if(!q1 || !q2 || !q3 || !q4 || !q5 || !q6 || !q7 || !q8 || !q9 || !q10 || !q11) {
		alert("점수가 전부 입력되지 않았습니다.");
		return false;
	}
	var sum = q1 + q2 + q3 + q4 + q5 + q6 + q7 + q8 + q9 + q10 + q11; 
	var avg = Math.round(sum/13*100) / 100;
	alert("심사점수 합계는 "+sum+", 평균은 "+avg+" 입니다.");
	$("#sum").val(sum);
	$("#avg").val(avg);
	if(avg>=4 && avg<=5) $("#result").val(1);
	else if(avg>=3 && avg<4) $("#result").val(2);
	else if(avg>=2.7 && avg<3) $("#result").val(3);
	else if(avg<2.7) $("#result").val(4);
	else alert("잘못 입력되었습니다."); 
}
</script>