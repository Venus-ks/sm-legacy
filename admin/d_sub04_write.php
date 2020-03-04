<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a4";
###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql);
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	while ($row = sql_fetch_array($res)){
		$loop[] = $row;
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" height="800" valign="top" background="/images/leftbg.png">
		<!-- ### LEFT MENU -->
		<? include_once("./_menu.php"); ?>
		</td>
		<td valign="top">
			<form name="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="d_sub4_reg"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="review_category" value="<?=$data['review_category']?>"/>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="../images/titlebg.png"><img src="../images/03_title04.png" /></td>
					</tr>
					<tr>
						<td valign="top" style="padding:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Paper Info</td>
								</tr>
							</table>
							<?/* 논문정보 */?>
							<?php include_once("./template/article01.php");?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
								<tr>
									<td>
										<?php include_once("./template/review01.php");?>
											<table class="boardType01_write" style="margin-top:20px;">
												<tr>
													<th width="280"><strong>심사결과<br/>Result</strong></th>
													<td>
														<select name="result" id="result" style="width:40%;" required>
														<option value="">= 선택 =</option>
														<?php
														if($data['step']<25) {
															$arr = get_result();
														} else {
															$arr = get_result_final();
														}
														?>
														<?php for($i=0;$i<count($arr);$i++):?>
															<option value="<?=$arr[$i]['cvalue']?>"><?=$arr[$i]['ctext']?></option>
														<?php endfor?>
														</select>
													</td>
												</tr>
												<!--tr>
													<th>종합심사결과<br/>Comments</th>
													<td><textarea name="edit_comment" id="comments" style="width:100%;" rows="5"><?=$data['edit_comment']?></textarea></td>
												</tr>
												<!--tr>
													<th>결과 파일<br/>Attached Editor File</th>
													<td>
														<input type="file" name="modify_rfile" id="modify_rfile" style="width:100%;">
													</td>
												</tr-->
											</table>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
											<tr>
												<td align="right" width="50%">
													<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:44px;border:0px;"/>
												</td>
												<td width="10px">&nbsp;</td>
												<td align="left" width="50%">
													<a href="d_sub04.php"><img src="../images/btn_list.png" /></a>
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
	if(!confirm("확인처리하시겠습니까?")) return false;
	f.action = "./d_process.php";
	return true;
}
</script>
