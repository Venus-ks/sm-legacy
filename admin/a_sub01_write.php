<?php
include_once("./admin_head.php");
#####################################################################
$mlevel		= 2;
$menu		= "a1";
$tmp_cnt 	= 1;

$loop = array();
if($_GET['seq']){
	$sql	= "select * from ad_paper where mb_id = '{$member['mb_id']}' and seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql);
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	while ($row = sql_fetch_array($res)) $loop[] = $row;
}
/* 투고가능 기간 체크 */
$permit_sql	= "select * from ad_config ORDER BY no DESC LIMIT 0,1";
$permit_data	= sql_fetch($permit_sql);
$sdate = $permit_data['service_fdate'];
$ldate = $permit_data['service_ldate'];
if($ldate!='0000-00-00' && (date('Y-m-d') < $sdate || date('Y-m-d') > $ldate) && !$data['number']) alert('투고기간이 아닙니다.','./a_sub01.php');
/* //투고가능 기간 체크 */
$tmp_cnt = count($loop);

?>
<script>
submit_ok = '';
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="199" height="800" valign="top" background="/images/leftbg.png">
			<!-- ### LEFT MENU -->
			<? include_once("./_menu.php"); ?>
		</td>
		<td valign="top">
			<form name="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="a_sub_reg"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="mb_id" value="<?=$data['mb_id']?>"/>
				<input type="hidden" name="mb_name" value="<?=$data['mb_name']?>"/>
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="auth_seq" value="">

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="../images/titlebg.png"><img src="../images/01_title01.png" /></td>
					</tr>
					<tr>
						<td valign="top" style="padding:0 20px;">
							<?php $reviewer_hidden = TRUE?>
							<?php include_once("./template/review01.php");?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0">
								<tr>
									<td class="font_16">
										<img src="../images/icon.png"  align="absmiddle" class="mr5" />Paper Info
									</td>
								</tr>
							</table>
							
							<?php include_once("./template/article00.php");?>
							<?php include("./template/author00.php")?>
							
							
							
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
								<tr>
									<td align="right" width="50%">
										<input type="image" src="../images/btn_summit.png" alt="" style="border:0px;"/>
									</td>
									<td width="10px">&nbsp;</td>
									<td align="left" width="50%">
										<a href="a_sub01.php"><img src="../images/btn_list.png" /></a></td>
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
	<?php if($data['step']>9):?>
		if(!confirm("등록하시겠습니까?")) return false;
	<?php endif?>
	
	// addauth

/* 	if (f.title.value == "") {
		alert("Title(KOR)을 입력해 주십시오.");
		f.title.focus();
		return false;
	}
	if (f.title_eng.value == "") {
		alert("Title(Eng)을 입력해 주십시오.");
		f.title_eng.focus();
		return false;
	}
	if (document.getElementById("auth_name").value == "") {
		alert("저자명을 입력해 주십시오.");
		document.getElementById("auth_name").focus();
		return false;
	}
	if (document.getElementById("auth_email").value == "") {
		alert("이메일을 입력해 주십시오.");
		document.getElementById("auth_email").focus();
		return false;
	}
	if (document.getElementById("auth_mobile").value == "") {
		alert("핸드폰을 입력해 주십시오.");
		document.getElementById("auth_mobile").focus();
		return false;
	}
	if (document.getElementById("organization").value == "") {
		alert("소속을 입력해 주십시오.");
		document.getElementById("organization").focus();
		return false;
	} */
	f.action = "./a_process.php";
	if(confirm('정말 제출하시겠습니까?')) return true;
	else return false;
}

</script>
