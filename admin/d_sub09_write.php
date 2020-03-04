<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a9";
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
	<input type="hidden" name="mode" value="d_sub9_reg"/>
	<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
	<input type="hidden" name="number" value="<?=$data['number']?>"/>
	<input type="hidden" name="mb_name" value="<?=$data['mb_name']?>">
	<input type="hidden" name="mb_id" value="<?=$data['mb_id']?>">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/03_title11.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Paper Info</td>
		</tr>
		</table>
		<?php include_once("./template/article01.php");?>
		<?php include_once("./template/review01.php");?>

<?
$sql = "select * from ad_paper_total where parent_seq = '{$_GET['seq']}' order by regdate desc";
$ress	= sql_query($sql);
while ($row = sql_fetch_array($ress)){
	$review[] = $row;
}
?>
<? if($review){ ?>
	<? for($i=0;$i<count($review);$i++){ ?>
		<table class="boardType01_write" style="margin-top:20px;">
		<tr>
			<th width="280"><strong>등록일</strong></th>
			<td><?=$review[$i]['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사결과<br/>Result</strong></th>
			<td><?=get_result($review[$i]['result'])?></td>
		</tr>
		<tr>
			<th>Comments</th>
			<td><?=$review[$i]['comments']?></td>
		</tr>
		<tr>
			<th>File of Explanation <br />for review</th>
			<td>
				<? if($review[$i]['rfile']){ ?>
				<?=end(explode("/",substr(strstr($review[$i]['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=$review[$i]['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		</table>
	<? } ?>
<? } ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Final Review Sanction</td>
		</tr>
		</table>
		<table class="boardType01_write" style="margin-top:20px;">
		<tr>
			<th width="280"><strong>종합심사결과<br/>Result</strong></th>
			<td>
				<select name="result" id="result" style="width:40%;" required>
				<option value="">= 선택 =</option>
				<?
				$arr = get_result_final();
				for($i=0;$i<count($arr);$i++){
				?>
				<option value="<?=$arr[$i]['cvalue']?>"><?=$arr[$i]['ctext']?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th>코멘트<br/>Comments</th>
			<td><textarea name="comments" id="comments" style="width:100%;" rows="5" required></textarea></td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
		<tr>
			<td align="right" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;border:0px;"/>
				</td>
                <td width="10px">&nbsp;</td>
				<td align="left" width="50%">
					<a href="d_sub09.php"><img src="../images/btn_list.png" /></a></td>
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
	f.action = "./d_process.php";
	return true;
}
</script>
