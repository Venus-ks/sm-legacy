<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a3";
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
				<input type="hidden" name="mode" value="d_sub3_reg"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="express_publication" value="<?=$data['express_publication']?>">
				<input type="hidden" name="review_category" value="<?=$data['review_category']?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="../images/titlebg.png"><img src="../images/03_title03.png" /></td>
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
							<br>
							<?/* 심사정보 */?>
							<?php if($data['step']>10) include_once("./template/review01.php");?>
							<table width="100%" class="boardType01_write" style="margin-top:20px;">
								<tr>
									<th width="200" rowspan="2"><strong>심사위원 A<br/>Reviewer A</strong></th>
									<td class="tabA">
										<input type="text" name="review_a_name" id="review_a_name" style="width:100px;" value="<?=get_review_name($data['review_a_user'])?>" readonly/>
										<input type="hidden" name="review_a_user" id="review_a_user" style="width:100px;" value="<?=$data['review_a_user']?>"/>
										<input type="hidden" name="review_a_result" id="review_a_result" style="width:100px;" value="<?=$data['review_a_result']?>"/>
										<input type="hidden" name="review_a_field" id="review_a_field" style="width:100px;"/>
										<a href="javascript:delete_choice('review_a');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle"  class="btnA"/></a>&nbsp;<?=get_review_confirm($data['review_a_user'],$data['seq'])?><?=get_review_status($data['review_a_user'],$data['seq'],$data['step'])?>
									</td>
									<td width="130" rowspan="2" align="center" class="tabA">
										<input type="text" name="review_a_date" id="review_a_date" style="width:109px;" value="<?=$data['review_a_date']?>"/>
										<a href="javascript:win_calendar_review('review_a_date', document.getElementById('review_a_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" class="btnA"/></a>
									</td>
									<td width="130" rowspan="2" align="center" class="tabA"><a href="javascript:review_conf('review_a_conf','<?=$data['review_a_conf']?>');"><?if($data['review_a_conf']=="Y"){?><img src="../images/btn_paper_cancel.png" width="109" height="44" /><?}else{?><img src="../images/btn_paper_ok.png" width="109" height="44" /><?}?></a></td>
								</tr>
								<tr>
									<td class="tabA"><a href="javascript:pop_choice('review_a');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" class="btnA"/></a>&nbsp;<a href="javascript:sendMail('<?=$data['review_a_user']?>','<?=$data['review_category']?>');"><img src="../images/btn_email.png"/></a></td>
								</tr>
								<!-- <tr>
									<td>
										 <table class="boardType01_write" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th width="25%">1차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc1']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc1'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php if($data['step']>11):?>
											<tr>
												<th width="25%">2차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc2']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc2'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php endif?>
										</table>
									</td>
								</tr> -->
								<tr>
									<th width="150" rowspan="2"><strong>심사위원 B<br/>Reviewer B</strong></th>
									<td class="tabB">
										<input type="text" name="review_b_name" id="review_b_name" style="width:100px;" value="<?=get_review_name($data['review_b_user'])?>" readonly/>
										<input type="hidden" name="review_b_user" id="review_b_user" style="width:100px;" value="<?=$data['review_b_user']?>"/>
										<input type="hidden" name="review_b_result" id="review_b_result" style="width:100px;" value="<?=$data['review_b_result']?>"/>
										<input type="hidden" name="review_b_field" id="review_b_field" style="width:100px;"/>
										<a href="javascript:delete_choice('review_b');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" class="btnB"/></a>&nbsp;<?=get_review_confirm($data['review_b_user'],$data['seq'])?><?=get_review_status($data['review_b_user'],$data['seq'],$data['step'])?>
									</td>
									<td class="tabB" width="130" rowspan="2" align="center">
										<input type="text" name="review_b_date" id="review_b_date" style="width:109px;" value="<?=$data['review_b_date']?>"/>
										<a href="javascript:win_calendar_review('review_b_date', document.getElementById('review_b_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" class="btnB"/></a>
									</td>
									<td class="tabB" width="130" rowspan="2" align="center"><a href="javascript:review_conf('review_b_conf','<?=$data['review_b_conf']?>');"><?if($data['review_b_conf']=="Y"){?><img src="../images/btn_paper_cancel.png" width="109" height="44" /><?}else{?><img src="../images/btn_paper_ok.png" width="109" height="44" /><?}?></a></td>
								</tr>
								<tr>
									<td class="tabB"><a href="javascript:pop_choice('review_b');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" class="btnB"/></a>&nbsp;<a href="javascript:sendMail('<?=$data['review_a_user']?>','<?=$data['review_category']?>');"><img src="../images/btn_email.png"/></a></td>
								</tr>
								<!-- <tr>
									<td>
										 <table class="boardType01_write" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th width="25%">1차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc3']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc3'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php if($data['step']>11):?>
											<tr>
												<th width="25%">2차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc4']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc4'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php endif?>
										</table>
									</td>
								</tr> -->
								<tr>
									<th width="150" rowspan="2"><strong>심사위원 C<br/>Reviewer C</strong></th>
									<td class="tabC">
										<input type="text" name="review_c_name" id="review_c_name" style="width:100px;" value="<?=get_review_name($data['review_c_user'])?>" readonly/>
										<input type="hidden" name="review_c_user" id="review_c_user" style="width:100px;" value="<?=$data['review_c_user']?>"/>
										<input type="hidden" name="review_c_result" id="review_c_result" style="width:100px;" value="<?=$data['review_c_result']?>"/>
										<input type="hidden" name="review_c_field" id="review_c_field" style="width:100px;"/>
										<a href="javascript:delete_choice('review_c');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" class="btnC"/></a>&nbsp;<?=get_review_confirm($data['review_c_user'],$data['seq'])?><?=get_review_status($data['review_c_user'],$data['seq'],$data['step'])?>
									</td>
									<td class="tabC" width="130" rowspan="2" align="center">
										<input type="text" name="review_c_date" id="review_c_date" style="width:109px;" value="<?=$data['review_c_date']?>"/>
										<a href="javascript:win_calendar_review('review_c_date', document.getElementById('review_c_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" class="btnC"/></a>
									</td>
									<td class="tabC" width="130" rowspan="2" align="center"><a href="javascript:review_conf('review_c_conf','<?=$data['review_c_conf']?>');"><?if($data['review_c_conf']=="Y"){?><img src="../images/btn_paper_cancel.png" width="109" height="44" /><?}else{?><img src="../images/btn_paper_ok.png" width="109" height="44" /><?}?></a></td>
								</tr>
								<tr>
									<td class="tabC"><a href="javascript:pop_choice('review_c');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" class="btnC"/></a>&nbsp;<a href="javascript:sendMail('<?=$data['review_a_user']?>','<?=$data['review_category']?>');"><img src="../images/btn_email.png"/></a></td>
								</tr>
								<!-- <tr>
									<td>
										 <table class="boardType01_write" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<th width="25%">1차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc5']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc5'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php if($data['step']>11):?>
											<tr>
												<th width="25%">2차 심사공문</th>
												<td>
													<a href="/down.php?link=<?=$data['review_offcial_doc6']?>"><?=end(explode("/",substr(strstr($data['review_offcial_doc6'], '^'), 1)))?></a>
												</td>
											</tr>
											<?php endif?>
										</table>
									</td>
								</tr> -->
							</table>
							<?php if($data['step']>10):?>
								<br>
								<h4>※ 2차 심사부터는 최종 Submit을 눌러야 심사진행이 가능합니다.</h4>
							<?php endif?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
								<tr>
									<td align="right" width="50%">
										<input type="image" src="../images/btn_summit.png" alt="" style="border:0px;"/>
									</td>
									<td width="10px">&nbsp;</td>
									<td align="left" width="50%">
										<a href="d_sub03.php"><img src="../images/btn_list.png" /></a>
										<a href="javascript:withdraw_article();" class="btn btn-danger" style="line-height:23px;color:#FFF;margin-left:50px">부적합 판정</a>
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
<iframe id="hddFrame" name="hddFrame" style="display:none;"></iframe>
<script type="text/javascript">
function fwrite_submit(f){
	if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./d_process.php";
	return true;
}
function pop_choice(nm){
	window.open("./popup_review_03.php?nm="+nm,"","width=640,height=400,scrollbars=yes");
}
function delete_choice(nm){
	$("#"+nm+"_user").val('');
	$("#"+nm+"_name").val('');
}
function review_conf(nm, value){
	var seq = '<?=$data['seq']?>';
	if(value=="Y"){
		if(!confirm("확정을 취소하시겠습니다.")) return;
		hddFrame.location.href = "./d_process.php?mode=review_cancel&seq="+seq+"&nm="+nm;
	}else{
		if(!confirm("확정하시겠습니다.")) return;
		hddFrame.location.href = "./d_process.php?mode=review_confirm&seq="+seq+"&nm="+nm;
	}
}
function change_review_dateA(date){
	var seq = '<?=$data['seq']?>';
	var reviewDateA = date;
	///alert(seq);
	//alert(reviewDateA);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewA_changedate&seq="+seq+"&review_a_date="+reviewDateA;
}
function change_review_dateB(date){
	var seq = '<?=$data['seq']?>';
	var reviewDateB = date;
	//alert(seq);
	//alert(reviewDateB);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewB_changedate&seq="+seq+"&review_b_date="+reviewDateB;
}
function change_review_dateC(date){
	var seq = '<?=$data['seq']?>';
	var reviewDateC = date;
	//alert(seq);
	//alert(reviewDateC);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewC_changedate&seq="+seq+"&review_c_date="+reviewDateC;
}
function change_reviewA(id){
	var seq = '<?=$data['seq']?>';
	var reviewA = id;
	//alert(seq);
	//alert(reviewA);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewA_change&seq="+seq+"&review_a_user="+reviewA;
}
function change_reviewB(id){
	var seq = '<?=$data['seq']?>';
	var reviewB = id;
	//alert(seq);
	//alert(reviewB);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewB_change&seq="+seq+"&review_b_user="+reviewB;
}
function change_reviewC(id){
	var seq = '<?=$data['seq']?>';
	var reviewC = id;
	//alert(seq);
	//alert(reviewC);
	hddFrame.location.href = "../admin/d_process.php?mode=reviewC_change&seq="+seq+"&review_c_user="+reviewC;
}
function sendMail(id,cat){
	var seq = '<?=$data['seq']?>';
	var review_user = id;
	var review_category = cat;
	hddFrame.location.href = "../admin/d_process.php?mode=review_send_mail&seq="+seq+"&review_user="+review_user+"&review_category="+review_category;
}
$(document).ready(function() {
	<? if($data['review_a_conf']=="Y"){ ?>
		$(".tabA").css("background","#ffffdd");
		//$(".btnA").hide();
	<? } ?>
	<? if($data['review_b_conf']=="Y"){ ?>
		$(".tabB").css("background","#ffffdd");
		//$(".btnB").hide();
	<? } ?>
	<? if($data['review_c_conf']=="Y"){ ?>
		$(".tabC").css("background","#ffffdd");
		//$(".btnC").hide();
	<? } ?>
});
function withdraw_article(){
	if(!confirm("부적합으로 판정하시겠습니까?\n판정 이후는 복원이 되지 않습니다.")){
		return false;
	}else{
		document.form1.mode.value = "withdraw_article";
		document.form1.action = "./d_process.php";
		document.form1.submit();
	}
}
</script>
