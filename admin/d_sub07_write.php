<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a7";

###
if($_GET['mb_no']){
	$sql	= "select * from g4_member where mb_no = '{$_GET['mb_no']}'";
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


	<form name="fregisterform" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="d_sub7_reg"/>
	<input type="hidden" name="mb_no" value="<?=$data['mb_no']?>"/>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/03_title07.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Reviewer Registration</td>
		</tr>
		</table>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>
			
			
			<table width="100%" class="boardType01_write">
			<tr>
				<th width="100"><strong>회원구분</strong></th>
				<td width="150">심사위원</td>
				<th width="150"><strong>분야(Field)</strong></th>
				<td>
					<select name="field" id="field" style="width:100%;">
						<option value="">= 선택해주세요 =</option>
						<? 
							$arr = get_category(); 
							for($i=0;$i<count($arr);$i++){
						?>
							<option value="<?=$arr[$i]['cvalue']?>"  <? if($data['field']==$arr[$i]['cvalue']){ ?>selected<? } ?>><?=$arr[$i]['ctext']?></option>
						<?
							}	
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>아이디(이메일)</th>
				<td colspan="3">

				<? if($_GET['mb_no']){ ?>
					<?=$data['mb_id']?>
				<? }else{ ?>
					<input type="email" name="mb_id" style="width:200px;" itemname="아이디(이메일)" required/>
				<? } ?>
				</td>
			</tr>
			<? if($_GET['mb_no']){ ?>
			<? }else{ ?>
			<tr>
				<th>비밀번호</th>
				<td colspan="3"><input type="password" name="mb_password" id="mb_password" style="width:200px;" itemname="비밀번호" required/></td>
			</tr>
			<tr>
				<th>비밀번호 확인</th>
				<td colspan="3"><input type="password" name="re_mb_password" id="re_mb_password" style="width:200px;" itemname="비밀번호 확인" required/></td>
			</tr>
			<? } ?>
			<tr>
				<th>회원명</th>
				<td colspan="3"><input type="text" name="mb_name" id="mb_name" style="width:100%;" itemname="회원명" required value="<?=$data['mb_name']?>"/></td>
			</tr>
			<tr>
				<th>우편물 수령주소</th>
				<td colspan="3">
					<input type="text" name="mb_zip1" id="mb_zip1" style="width:50px;" value="<?=$data['mb_zip1']?>"/>
					-
					<input type="text" name="mb_zip2" id="mb_zip2" style="width:50px;" value="<?=$data['mb_zip2']?>"/>
					<a href="javascript:;" onclick="win_zip('fregisterform', 'mb_zip1', 'mb_zip2', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');"><img src="../images/btn_address.png"  align="top" /></a>
					<br>
					<input type="text" name="mb_addr1" id="mb_addr1" style="width:45%;" itemname="우편물 수령주소" required value="<?=$data['mb_addr1']?>"/>기본주소<br/>
					<input type="text" name="mb_addr2" id="mb_addr2" style="width:45%;" value="<?=$data['mb_addr2']?>"/>상세주소<br/>
					<input type="text" name="mb_addr3" id="mb_addr3" style="width:45%;" value="<?=$data['mb_addr3']?>"/>참고항목<br/>
					<input type="hidden" name="mb_addr_jibeon"  id="mb_addr_jibeon" value="<?=$data['mb_addr_jibeon']?>">
					<span id="mb_addr_jibeon">지번주소 : <?=$data['mb_addr_jibeon']?></span>
				</td>
			</tr>
			<tr>
				<th>전화<font style="font-weight:normal !important;"></font></th>
				<td><input type="text" name="mb_tel" id="mb_tel" style="width:100%;" itemname="전화" required value="<?=$data['mb_tel']?>"/></td>
				<th>핸드폰<font style="font-weight:normal !important;"></font></th>
				<td><input type="text" name="mb_hp" id="mb_hp" style="width:100%;" itemname="핸드폰" required value="<?=$data['mb_hp']?>"/></td>
			</tr>
			<tr>
				<th>생년월일<font style="font-weight:normal !important;"></font></th>
				<td colspan="3">
					<input type="text" name="mb_birth" id="mb_birth" style="width:100px;" value="<?=$data['mb_birth']?>"/>
					<a href="javascript:win_calendar('mb_birth', document.getElementById('mb_birth').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
				</td>
			</tr>
			<tr>
				<th>소속<font style="font-weight:normal !important;"></font></th>
				<td><input type="text" name="mb_1" id="mb_1" style="width:100%;" value="<?=$data['mb_1']?>"/></td>
				<th>부서<font style="font-weight:normal !important;"></font></th>
				<td><input type="text" name="mb_2" id="mb_2" style="width:100%;" value="<?=$data['mb_2']?>"/></td>
			</tr>
			</table>


			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="right" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:44px;border:0px;"/>
				</td>
                <td width="10px">&nbsp;</td>
				<td align="left" width="50%">
					<a href="d_sub07.php"><img src="../images/btn_list.png" /></a></td>
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
	
	<? if(!$_GET['mb_no']){ ?>
	if(f.mb_password.value != f.re_mb_password.value){
		alert("비밀번호와 비밀번호 확인이 맞지 않습니다."); 
		f.mb_password.focus();
		return false;
	}
	<? } ?>

	if(!confirm("처리하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}

function chk_email(obj){
	var mb_id_text = document.getElementById("mb_id_text");
	if(obj.value=="direct"){
		mb_id_text.style.display	= "block";
		//mb_id_text.style.float		= "left";
		obj.style.width				= "135px";
	}else{
		mb_id_text.style.display	= "none";
		obj.style.width				= "269px";
	}
}
</script>