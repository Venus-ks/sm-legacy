<?php
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a3";
###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql); 
}
if($_GET['type']=='a'){
	$doctype1 = 'review_offcial_doc1';
	$doctype2 = 'review_offcial_doc2';
}elseif($_GET['type']=='b'){
	$doctype1 = 'review_offcial_doc3';
	$doctype2 = 'review_offcial_doc4';
}elseif($_GET['type']=='c'){
	$doctype1 = 'review_offcial_doc5';
	$doctype2 = 'review_offcial_doc6';
}else {
	alert('정보가 옳바르지 않습니다.', "./d_sub03_write.php?seq=".$_GET['seq']);
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
				<input type="hidden" name="mode" value="d_sub3_reg_email"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="express_publication" value="<?=$data['express_publication']?>">
				<input type="hidden" name="review_category_target" value="<?=$data['review_category_target']?>">
				<input type="hidden" name="review_user" value="<?=$data['review_'.$_GET['type'].'_user']?>">
				<input type="hidden" name="doctype" value="<?=($data['step']<11)?$doctype1:$doctype2?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="../images/titlebg.png"><img src="../images/03_title03.png" /></td>
					</tr>
					<tr>
						<td valign="top" style="padding:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:15px">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />심사요청공문 발송</td>
								</tr>
							</table>
							<table class="boardType01_write" border="0" cellspacing="0" cellpadding="0">
								<?php if($data['step']<11):?>
								<tr>
									<th>1차 심사공문</th>
									<td>
										<input type="file" style="display:inline" name="<?=$doctype1?>" <?=($data[$doctype1])?'':'required'?>/>
										<a href="/down.php?link=<?=$data[$doctype1]?>" style="margin-left:10px"><?=end(explode("/",substr(strstr($data[$doctype1], '^'), 1)))?></a>													
									</td>
								</tr>
								<?php else:?>
								<tr>
									<th>2차 심사공문</th>
									<td>
										<input type="file" style="display:inline" name="<?=$doctype2?>" <?=($data[$doctype2])?'':'required'?>/>
										<a href="/down.php?link=<?=$data[$doctype2]?>" style="margin-left:10px"><?=end(explode("/",substr(strstr($data[$doctype2], '^'), 1)))?></a>
									</td>
								</tr>
								<?php endif?>
							</table>
						</td>
					</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
					<tr>
						<td align="right" width="50%">
							<button type="submit" class="btn btn-primary">메일 발송</button>
						</td>
						<td width="10px">&nbsp;</td>
						<td align="left" width="50%">
							<button class="btn btn-cancel" onclick="history.go(-1)">취소</button>
						</td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<script type="text/javascript">
function fwrite_submit(f){
	if(!confirm("발송하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}
</script>