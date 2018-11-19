<?php
include_once("./_common.php");
$sql	= "select * from g4_member where mb_id = '{$_GET['a']}'";
$row	= sql_fetch($sql);
if(md5($row['mb_password'])!=$_GET['b']){
	$msg		= "Authorization has expired.";
	$returnUrl	= "./";
	alert($msg, $returnUrl);
}
?>
<form name="fregisterform" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data" role="form">
	<input type="hidden" name="mode" value="a_member_pwchange"/>
	<input type="hidden" name="mb_no" value="<?=$row['mb_no']?>"/>
	<input type="hidden" name="old_password" value="<?=$_GET['b']?>"/>
	<div class="form-group"> 
		<label for="exampleInputEmail1"><span class="glyphicon glyphicon-ok-sign submit_color"></span> Password</label>
		<input type="password" class="form-control" id="new_mb_password" name="new_mb_password" placeholder="Enter password" required>
	</div>
	<div class="form-group"> 
		<label for="re_mb_password"><span class="glyphicon glyphicon-ok-sign submit_color"></span> Confirm Password</label>
		<input type="password" class="form-control" id="re_mb_password" name="re_mb_password" placeholder="Enter confirm password" required>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-danger btn-sm">Register</button>
	</div>
</form>
<script type="text/javascript">
function fwrite_submit(f){
	if(f.new_mb_password.value != f.re_mb_password.value){
		alert("비밀번호가 일치하지 않습니다."); 
		f.re_mb_password.focus();
		return false;
	}
	f.action = "./a_process.php"; 
	return true;
}
</script>