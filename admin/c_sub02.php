<?
include_once("./admin_head.php");

###
$mlevel		= 6;
$menu		= "a2";

$sql = "select * from ad_config order by regdate desc limit 1";
$data = sql_fetch($sql);

include_once("$g4[path]/lib/cheditor4.lib.php");
echo "<script src='$g4[cheditor4_path]/cheditor.js'></script>";
echo cheditor1('content01', '100%', '250');
echo cheditor1('content02', '100%', '250');
echo cheditor1('content03', '100%', '250');
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" height="800" valign="top" background="/images/leftbg.png">
	
	<!-- ### LEFT MENU -->
	<? include_once("./_menu.php"); ?>
	
	</td>
    <td valign="top">
	
	<!-- ### CONTENTS -->
	<form name="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="c_contents"/>
	<input type="hidden" name="seq" value="<?=$data['seq']?>"/>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/04_title01.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />논문투고규정</td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
		<td>
 
			<table class="boardType01_write">
			<tr>
				<td>
				<?=cheditor2('content01', $data['content01']);?>
				</td>
			</tr>
			</table>

			</td>
		</tr>
		</table>

		<div style="height:30px;"></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />저작권정보</td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
		<td>
 
			<table class="boardType01_write">
			<tr>
				<td>
				<?=cheditor2('content02', $data['content02']);?>
				</td>
			</tr>
			</table>

			</td>
		</tr>
		</table>	



		<div style="height:30px;"></div>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />윤리규정</td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
		<td>
 
			<table class="boardType01_write">
			<tr>
				<td>
				<?=cheditor2('content03', $data['content03']);?>
				</td>
			</tr>
			</table>

			</td>
		</tr>
		</table>






		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
		<tr>
			<td align="right" width="50%">
				<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:38px;border:0px;"/>
			</td>
			<td align="left" width="50%">
				<a href="c_sub01.php"><img src="../images/btn_list.png" /></a></td>
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
	
	<?
	echo cheditor3('content01');	
	?>

	<?
	echo cheditor3('content02');	
	?>

	<?
	echo cheditor3('content03');	
	?>

	f.action = "./c_process.php"; 
	return true;
}
</script>