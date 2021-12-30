<?
include_once("../_common1.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once("../head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");

//echo $g4[path];
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td valign="top">
		<form name="fregisterform" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
			<input type="hidden" name="mode" value="member_write"/>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
								<!-------
								1 -
								2 - 기존 : 정회원
								3 -
								4 - 기존 : 심사위원
								5-
								6 - 기존 : 시스템관리자
								7-  신규 : 학생회원
								8-  기존 : 대표간사
								9 -
								10 - 기존 : 최고관리자
								-------->
								<th width="150"><strong><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;회원구분</strong><span class="required">*</span></th>
								<td  colspan="3" width="350">
									<select name="mb_level" id="mb_level" itemname="회원구분" style="width: 170px;" required>
										<option value="">====== 선택 ======</option>
										<option value="2">정회원</option>
										<!-- <option value="0">미가입 또는 연회비 미납</option> -->
									</select>
								</td>
							</tr>
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;아이디(이메일)<span class="required">*</span></th>
								<td colspan="3">
									<input type="email" name="mb_id" style="width:250px;" itemname="아이디(이메일)" required/>
								</td>
							</tr>
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;비밀번호<span class="required">*</span></th>
								<td colspan="3"><input type="password" name="mb_password" id="mb_password" style="width:200px;" itemname="비밀번호" required/></td>
							</tr>
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;비밀번호 확인<span class="required">*</span></th>
								<td colspan="3"><input type="password" name="re_mb_password" id="re_mb_password" style="width:200px;" itemname="비밀번호 확인" required/></td>
							</tr>
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;이름<span class="required">*</span></th>
								<td colspan="3"><input type="text" name="mb_name" id="mb_name" style="width:100%;" itemname="회원명" required value=""/></td>
							</tr>
							<tr>
								<th>주소<span class="required">*</span></th>
								<td colspan="3">
									<input type="text" id="post1" name="mb_zip1" style="width:150px;"><!-- - <input type="text" id="post2" name="mb_zip2" style="width:50px;"-->
									<img src="../images/btn_address.png" onclick="openDaumPostcode()" style="vertical-align: top;height: 26px;cursor:pointer"><br>
									<input type="text" name="mb_addr1" style="width:100%;margin-top:3px;" id="addr"><br>
									<input type="text" name="mb_addr2" style="width:100%;margin-top:3px;" id="addr2">
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
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;전화<font style="font-weight:normal !important;" required></font></th>
								<td><input type="text" name="mb_tel" id="mb_tel" style="width:100%;" itemname="전화" value=""/></td>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;핸드폰<span class="required">*</span><font style="font-weight:normal !important;"></font></th>
								<td><input type="text" name="mb_hp" id="mb_hp" style="width:100%;" itemname="핸드폰" required value=""/></td>
							</tr>
							<!-- <tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;생년월일<font style="font-weight:normal !important;"></font></th>
								<td colspan="3">
									<input type="text" name="mb_birth" id="mb_birth" style="width:100px;" value="" required/>
									<a href="javascript:win_calendar('mb_birth', document.getElementById('mb_birth').value, '');"><img src="../images/icon_cal.png" align="middle" style="height:26px;vertical-align: top;"/></a>
								</td>
							</tr> -->
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;학교/소속<span class="required">*</span><font style="font-weight:normal !important;"></font></th>
								<td><input type="text" name="mb_1" id="mb_1" style="width:100%;" value="" required/></td>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;학과/부서<span class="required">*</span><font style="font-weight:normal !important;"></font></th>
								<td><input type="text" name="mb_2" id="mb_2" style="width:100%;" value="" required/></td>
							</tr>
							<tr>
								<th><span class="glyphicon glyphicon-ok-sign submit_color"></span>&nbsp;전공분야<font style="font-weight:normal !important;"></font></th>
								<td colspan="3">
									<input type="text" name="mb_3" id="mb_3" style="width:250px;" value=""/>
								</td>
							</tr>
							</table>
							<p style="text-align:right"><span class="required">*</span> 는 필수입력입니다</p>

							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="right" width="50%">
									<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:45px;border:0px;"/>
								</td>
								<td width="10px">&nbsp;</td>
								<td align="left" width="50%">
									<a href="login.php"><img src="../images/btn_cancel.png" /></a>
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

	<? if(!$_GET['mb_no']){ ?>
	if(f.mb_password.value != f.re_mb_password.value){
		alert("비밀번호와 비밀번호 확인이 맞지 않습니다.");
		f.mb_password.focus();
		return false;
	}
	<? } ?>

	if(!confirm("가입하시겠습니까?")) return false;
	f.action = "./d_process.php";
	return true;
}

function chk_email(obj){
	var mb_id_text = document.getElementById("mb_id_text");
	if(obj.value=="direct"){
		mb_id_text.style.display	= "inline";
		//mb_id_text.style.float		= "left";
		obj.style.width				= "135px";
	}else{
		mb_id_text.style.display	= "none";
		obj.style.width				= "269px";
	}
}
</script>
