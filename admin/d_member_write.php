<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "b1";

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
	<input type="hidden" name="mode" value="d_member"/>
	<input type="hidden" name="mb_no" value="<?=$data['mb_no']?>"/>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/03_title07.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Member Registration</td>
		</tr>
		</table>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>


			<table width="100%" class="boardType01_write">
			<tr>
				<th width="200">아이디(이메일)</th>
				<td colspan="3"><?=$data['mb_id']?></td>
			</tr>
			<tr>
				<th>비밀번호(변경)</th>
				<td colspan="3">
					<input type="password" name="mb_password" id="mb_password" style="width:50%;" itemname="비밀번호"/>
					<input type="password" name="mb_password_confirm" id="mb_password_confirm" style="width:50%;margin-top:3px;" itemname="비밀번호 확인"/>
				</td>
			</tr>
			<tr>
				<th>회원명</th>
				<td colspan="3"><input type="text" name="mb_name" id="mb_name" style="width:100%;" itemname="회원명" required value="<?=$data['mb_name']?>"/></td>
			</tr>
			<tr>
				<th>회원등급</th>
				<td colspan="3">
					<select name="mb_level" id="mb_level">
						<option value="2" <?if ($data['mb_level'] == '2'){?>selected<?}?>>정회원</option>
						<option value="4" <?if ($data['mb_level'] == '4'){?>selected<?}?>>심사위원</option>
						<option value="10" <?if ($data['mb_level'] == '10'){?>selected<?}?>>편집장</option>
						<!-- <option value="6" <?if ($data['mb_level'] == '6'){?>selected<?}?>>시스템관리자</option>
						<option value="7" <?if ($data['mb_level'] == '7'){?>selected<?}?>>학생회원</option>
						<option value="8" <?if ($data['mb_level'] == '8'){?>selected<?}?>>대표간사</option>
						<option value="9" <?if ($data['mb_level'] == '9'){?>selected<?}?>>임시대표간사</option>
						<option value="10" <?if ($data['mb_level'] == '10'){?>selected<?}?>>최고관리자</option> -->
					</select>
				</td>
			</tr>
			<tr>
				<th>분야</th>
				<td colspan="3"><select name="field" id="field">
						<option value="">= 선택해주세요 =</option>
						<?
							$arr = get_category();
							for($i=0;$i<count($arr);$i++){
						?>
							<option value="<?=$arr[$i]['cvalue']?>"  <? if($data['field']==$arr[$i]['cvalue']){ ?>selected<? } ?>><?=$arr[$i]['ctext']?></option>
						<?
							}
						?>
					</select></td>
			</tr>
			<tr>
				<th>우편물 수령주소</th>
				<td colspan="3">
					<input type="text" id="post1" name="mb_zip1" style="width:150px;" value="<?=$data['mb_zip1']?>"><!-- - <input type="text" id="post2" name="mb_zip2" style="width:50px;"-->
					<img src="../images/btn_address.png" onclick="openDaumPostcode()" style="vertical-align: top;height: 26px;cursor:pointer"><br>
					<input type="text" name="mb_addr1" style="width:100%;margin-top:3px;" id="addr" value="<?=$data['mb_addr1']?>"><br>
					<input type="text" name="mb_addr2" style="width:100%;margin-top:3px;" id="addr2" value="<?=$data['mb_addr2']?>">
					<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
					<script>
						function openDaumPostcode() {
							new daum.Postcode({
								oncomplete: function(data) {
									// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
									// 우편번호와 주소 정보를 해당 필드에 넣고, 커서를 상세주소 필드로 이동한다.
									document.getElementById('post1').value = data.zonecode;
									//document.getElementById('post2').value = data.postcode2;
									document.getElementById('addr').value = data.roadAddress;

									//전체 주소에서 연결 번지 및 ()로 묶여 있는 부가정보를 제거하고자 할 경우,
									//아래와 같은 정규식을 사용해도 된다. 정규식은 개발자의 목적에 맞게 수정해서 사용 가능하다.
									//var addr = data.address.replace(/(\s|^)\(.+\)$|\S+~\S+/g, '');
									//document.getElementById('addr').value = addr;

									document.getElementById('addr2').focus();
								}
							}).open();
						}
					</script>
				</td>
			</tr>
			<tr>
				<th>일반전화<font style="font-weight:normal !important;"></font></th>
				<td colspan="3"><input type="text" name="mb_tel" id="mb_tel" style="width:100%;" itemname="일반전화" required value="<?=$data['mb_tel']?>"/></td>
			</tr>
			<tr>
				<th>핸드폰<font style="font-weight:normal !important;"></font></th>
				<td colspan="3"><input type="text" name="mb_hp" id="mb_hp" style="width:100%;" itemname="핸드폰" required value="<?=$data['mb_hp']?>"/></td>
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
				<td colspan="3"><input type="text" name="mb_1" id="mb_1" style="width:100%;" value="<?=$data['mb_1']?>"/></td>
			</tr>
			<tr>
				<th>부서<font style="font-weight:normal !important;"></font></th>
				<td colspan="3"><input type="text" name="mb_2" id="mb_2" style="width:100%;" value="<?=$data['mb_2']?>"/></td>
			</tr>
			<tr>
				<th>전공분야<font style="font-weight:normal !important;"></font></th>
				<td colspan="3"><input type="text" name="mb_3" id="mb_3" style="width:100%;" value="<?=$data['mb_3']?>"/></td>
			</tr>
			<tr>
				<th>가입일<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['mb_datetime']?></td>
				<th width="150">가입IP<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['mb_ip']?></td>
			</tr>
			</table>


			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="right" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="border:0px;"/>
				</td>
                <td width="10px">&nbsp;</td>
				<td align="left" width="50%">
					<a href="d_member.php"><img src="../images/btn_list.png" /></a></td>
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
