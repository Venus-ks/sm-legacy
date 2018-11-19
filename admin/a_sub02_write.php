<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a6";
###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql); 
	//echo $sql;
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	//echo $sql;
	while ($row = sql_fetch_array($res)){
		$tmp_arr = explode("|",$row['auth_type']);
		for($i=0;$i<count($tmp_arr);$i++){
			if($tmp_arr[$i]=="교신저자"){
				$author[]= $row['auth_name'];
			}
		}
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
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td background="../images/titlebg.png"><img src="../images/03_title01.png" /></td>
				</tr>
				<tr>
					<td valign="top" style="padding:20px;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />논문 내용</td>
							</tr>
						</table>	
						<?php include_once("./template/article01.php");?>
						<?php 
						$reviewer_hidden = TRUE;
						include_once("./template/review01.php");
						?>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="center"><a href="a_sub02.php"><img src="../images/btn_list.png" /></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script type="text/javascript">
function fwrite_submit(f){
	if(!confirm("수정하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}
</script>
<script>
$(".inline").colorbox({inline:true, width:"70%"});
</script>