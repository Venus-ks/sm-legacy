<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "b2";
###
$sql	= "select * from ad_config";
$data	= sql_fetch($sql); 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" height="800" valign="top" background="/images/leftbg.png">
	<!-- ### LEFT MENU -->
	<? include_once("./_menu.php"); ?>
	</td>
	<td valign="top">
	<form name="fregisterform" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="d_setting"/>
	<input type="hidden" name="mb_no" value="<?=$member['mb_level'] ?>"/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png" style="padding:10px;font-size:15px;color:#005187;font-weight:bolder;border-bottom:1px solid #000">서비스 세팅</td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Service Setting</td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>
			<table width="100%" class="boardType01_write">
			<tr>
				<th width="200">서비스 명</th>
				<td colspan="3"><?=$info['institute_title']?> 논문투고시스템</td>
			</tr>
			<tr>
				<th>투고 가능 기간</th>
				<td colspan="3">
					<input type="text" name="sdate" id="sdate" style="width:100px;" value="<?=$data['service_fdate']?>"/>
					<a href="javascript:win_calendar('sdate', document.getElementById('sdate').value,'');">
						<img src="../images/icon_cal.png" align="middle" />
					</a>
					&nbsp;
					<input type="text" name="edate" id="edate"  style="width:100px;" value="<?=$data['service_ldate']?>"/>
					<a href="javascript:win_calendar('edate', document.getElementById('edate').value,'');">
						<img src="../images/icon_cal.png" align="middle" />
					</a>
					<br>
					※ 위 기간에 한하여 투고가 가능합니다.
				</td>
			</tr>
			<tr>
				<th>서비스 시작일<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['regdate']?></td>
				<th width="150">가입IP<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['regip']?></td>
			</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="center" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:38px;border:0px;"/>
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
	if(!confirm("수정하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}
</script>