<?
include_once("../_common1.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once("../head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");

//echo $g4[path];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" style="padding:20px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />아이디 찾기</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<form name="findpwdform" method="post" onsubmit="return findid_submit(this);" enctype="multipart/form-data">
						<input type="hidden" name="mode" value="find_id"/>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="left" width="50%">
									아이디를 찾으려면 이름과 핸드폰 번호를 입력해주세요.
								</td>
							</tr>
						</table>
						<table width="100%" class="boardType01_write">
							<tr>
								<th style="width: 20%;">이름</th>
								<td><input type="text" name="mb_name" id="mb_name" style="width:100%;" itemname="회원명" value=""/></td>
							</tr>
							<tr>
								<th>핸드폰<font style="font-weight:normal !important;"></font></th>
								<td><input type="text" name="mb_hp" id="mb_hp" style="width:100%;" itemname="핸드폰"  value=""/></td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="right" width="50%">
									<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:44px;border:0px;"/>
								</td>
								<td width="10px">&nbsp;</td>
								<td align="left" width="50%">
									<a href="login.php"><img src="../images/btn_cancel.png" /></a>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />비밀번호 찾기</td>
				</tr>
			</table>						
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<form name="findidform" method="post" onsubmit="return findpwd_submit(this);" enctype="multipart/form-data">
						<input type="hidden" name="mode" value="find_pwd"/>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="left" width="50%">
									등록된 아이디(이메일)를 입력 해주세요.
								</td>
							</tr>
						</table>
						<table width="100%" class="boardType01_write">
							<tr>
								<th style="width: 20%;">아이디(이메일)</th>
								<td>
									<input type="email" name="mb_id" id="mb_id" style="width:100%;" itemname="아이디(이메일)" required/>
								</td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="right" width="50%">
									<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:44px;border:0px;"/>
								</td>
								<td width="10px">&nbsp;</td>
								<td align="left" width="50%">
									<a href="login.php"><img src="../images/btn_cancel.png" /></a>
								</td>
							</tr>
						</table>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<script type="text/javascript">
function findid_submit(f){
	f.action = "./a_process.php"; 
	return true;
}

function findpwd_submit(f){
	f.action = "./a_process.php"; 
	return true;
}
</script>