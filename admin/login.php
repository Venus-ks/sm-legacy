<?
include_once("../_common1.php");
include_once("$g4[path]/lib/latest.lib.php");
include_once("../head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
?>
<script>
function login_check(){
	var fm = document.flogin;
	if(!fm.mb_id_front.value){
		alert("Please Input Email");
		fm.mb_id_front.focus();
		return;
	}
	if(!fm.mb_password.value){
		alert("Please Input Password");
		fm.mb_password.focus();
		return;
	}
	fm.mb_id.value = fm.mb_id_front.value;
	// 로그인 정보 저장 체크 확인하여 진행
/* 	if(fm.saveid.checked){
		// 기존saveLogin(fm.mb_id_front.value,fm.mb_id_end.value);
		saveLogin(fm.mb_id_front.value,'',fm.mb_password.value); */
		/*
		if(fm.mb_id_end.value=="direct"){

			saveLogin(fm.mb_id_front.value,fm.mb_id_text.value,fm.mb_password.value);
		}else{

			saveLogin(fm.mb_id_front.value,fm.mb_id_end.value,fm.mb_password.value);
		}
		*/
/* 	}else{
		saveLogin("","","");
	}	 */

	fm.action = '../bbs/login_check.php';
	fm.submit();
}
function chk_email(obj){
	var mb_id_text = document.getElementById("mb_id_text");
	if(obj.value=="direct"){
		mb_id_text.style.display	= "block";
		mb_id_text.style.float		= "left";
		obj.style.width				= "115px";
	}else{
		mb_id_text.style.display	= "none";
		obj.style.width				= "269px";
	}
}
// 로그인 정보 저장
function confirmSave(checkbox){
	var isRemember;
	// 로그인 정보 저장한다고 선택할 경우
	if(checkbox.checked)  {
		isRemember = confirm("Are you sure?");
		if(!isRemember){
			checkbox.checked = false;
		}
	}

}
// 쿠키값 가져오기
function getCookie(key){
	var cook = document.cookie + ";";
	var idx =  cook.indexOf(key, 0);
	var val = "";

	if(idx != -1)  {
		cook = cook.substring(idx, cook.length);
		begin = cook.indexOf("=", 0) + 1;
		end = cook.indexOf(";", begin);
		val = unescape( cook.substring(begin, end) );
	}

	return val;
}
// 쿠키값 설정
function setCookie(name, value, expiredays){
	var today = new Date();
	today.setDate( today.getDate() + expiredays );
	 document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + today.toGMTString() + ";";
}
// 쿠키에서 로그인 정보 가져오기
function getLogin(){
	var frm = document.flogin;
	// userid 쿠키에서 id 값을 가져온다.
	var id = getCookie("userid");
	var email = getCookie("useremail");
	// 가져온 쿠키값이 있으면
	if(id != "") {
		frm.mb_id_front.value = id;
		if(email == "naver.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "hanmail.net"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "gmail.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "hotmail.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "nate.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "yahoo.co.kr"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "paran.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "empal.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "dreamwiz.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "freechal.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "lycos.co.kr"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "korea.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}else if(email == "hanmir.com"){
			frm.mb_id_end.value = email;
			frm.mb_id_text.style.display = "none";
			frm.mb_id_end.style.width = "269px";
		}
		/*
		else{
			frm.mb_id_text.value = email;
			mb_id_text.style.display	= "block";
			mb_id_text.style.float		= "left";
			obj.style.width				= "115px";
		}
		*/

		frm.saveid.checked = true;
	}
}
// 쿠키에 로그인 정보 저장
function saveLogin(id,email,password){
	if(id != "") {
		// userid 쿠키에 id 값을 7일간 저장
		setCookie("userid", id, 7);
		setCookie("useremail", email, 7);
		setCookie("userpw", password, 7);
	}else{
		// userid 쿠키 삭제
		setCookie("userid", id, -1);
		setCookie("useremail", email, -1);
		setCookie("userpw", password, 7);
	 }
}
function manual_popup(cont){
		window.open("../admin/file/"+cont+".pdf",'','width=1180,height=800,scrollbars=yes');
	}
//========================================
$(document).ready(function() {
	$("input[name='mb_id_front']").focus();
	getLogin();
});
</script>
<h2 class="logo">
	<?php if($info['logo_url']):?>
		<img src="<?=$info['logo_url']?>"></h2>
	<?php else:?>
		<b><?=$info['institute_title']?></b>
	<?php endif?>
</h2>
<hr style="margin:0;height:8px;background-color:<?=$info['maincolor']?>">
<br>
<div class="" style="">
	<div class="" style="margin:0 auto;width:700px;">
		<div class="alert alert-info" role="alert">
		본인에게 해당되는 항목(저자 또는 심사위원) 선택 후, 아래 로그인하시길 바랍니다.
		</div>
	</div>
	<div class="" style="margin:0 auto;width:700px;border:10px #eee solid;">
		<div style="padding:10px">
			<form name="flogin" method="post" autocomplete="off">
			<input type="hidden" name="url" value='/admin'>
			<input type="hidden" name="mb_id" value="">
			<input type="hidden" name="login_mode" value="<?=($mode)?$mode:1?>">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
				<tr>
					<td width="33%" align="center" valign="middle">
						<table border="0" align="center" cellpadding="0" cellspacing="0" style="<?=($mode==1 || !$mode)?'':'opacity:0.3'?>">
							<tr>
							<td align="center"><a href="../admin/login.php?mode=1" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image6','','../images/login_author_s.png',0)"><img src="../images/login_author_n.png" width="102" height="102" id="Image6" /></a></td>
							</tr>
							<tr>
							<td align="center"><h3>저자</h3></td>
							</tr>
						</table>
					</td>
					<td width="33%" align="center" valign="middle">
						<table border="0" align="center" cellpadding="0" cellspacing="0" style="<?=($mode==2)?'':'opacity:0.3'?>">
							<tr>
							<td align="center"><a href="../admin/login.php?mode=2" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image7','','../images/login_reviewer_s.png',0)"><img src="../images/login_reviewer_n.png" width="102" height="102" id="Image7"></a></td>
							</tr>
							<tr>
								<td align="center"><h3>심사위원</h3></td>
							</tr>
						</table>
					</td>
					<td width="33%" align="center" valign="middle">
						<table border="0" align="center" cellpadding="0" cellspacing="0" style="<?=($mode==3)?'':'opacity:0.3'?>">
							<tr>
							<td align="center"><a href="../admin/login.php?mode=3" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','../images/login_editionstaff_s.png',0)"><img src="../images/login_editionstaff_n.png" width="102" height="102" id="Image9" /></a></td>
							</tr>
							<tr>
								<td align="center"><h3>편집자</h3></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<hr style="margin:10px">
			<font color="#333333" size="+1"><b>E-mail ID<b></font>
			<input class="form-control" type="email" class="ed" maxlength="120" id="mb_id_front" name="mb_id_front" itemname="id" required="required" minlength="2" tabindex="1" placeholder="Enter email"/>
			<font color="#333333" size="+1"><b>Password</b></font>
			<input type="password" class="form-control" name="mb_password" id="login_mb_password" itemname="password" required="required" onkeydown="if(event.keyCode=='13'){ login_check(); }" tabindex="4" placeholder="Enter password" <?php if($_COOKIE['userpw']):?>value="<?php echo $_COOKIE['userpw']?>"<?php endif;?>/>
			<!--div class="checkbox">
				<label>
					<input type="checkbox" name="saveid" id="saveid" onClick="confirmSave(this);"> Remember Id/Password
				</label>
			</div-->
			<br>
			<a href="find_info.php"><i style="text-decoration:underline"> 비밀번호를 잊어버리셨나요?</i></a>
			<br><br>
			<button onclick="javascript:login_check();" class="btn btn-lg" style="background-color:<?=$info['maincolor']?>;color:#FFF">로그인</button>
			<a type="button" class="btn btn-secondary" href="./member_write.php" style="padding:6px 60px;float:right;font-size:20px;color:#FFF">회원등록</a>
			</form>
			<br><br>
			투고논문 심사를 처음 의뢰받으신 경우에는 편집위원회(
			<?php if($_GET['mode']==2):?><a href="mailto:<?=$info['editor_email']?>"><?=$info['editor_email']?></a>
			<?php else:?><a href="mailto:<?=$info['editor_email2']?>"><?=$info['editor_email2']?></a><?php endif?>
			)로 ID/PW 문의바랍니다.
			<br><br>
			신규 회원가입자나 본 시스템에 로그인이 되지 않는 사용자의 경우 홈페이지와 별개로 본 시스템에 회원등록을 해주시기 바랍니다.
		</div>
	</div>
</div>
<br>
<div class="row" style="font-family:'Times New Roman'">
	<div class="col-12" style="background-color:#ccc;border:0x #aaa solid;border-radius:20px;">
		<ul class="nav nav-justified">
			<li class="nav-item">
				<a href="<?=$info['site']?>" class="nav-link"><?=$info['institute_title']?> 홈페이지</a>
			</li>
			<li class="nav-item">
				<a href="<?=$info['submit_rule_url']?>" target="_blank" class="nav-link">학회지 투고규정</a>
			</li>
			<li class="nav-item">
				<a href="<?=$info['ethic_rule_url']?>" class="nav-link">연구윤리 규정</a>
			</li>
		</ul>
	</div>
</div>
