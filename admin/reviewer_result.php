<?
include_once("../_common1.php");
$mode = $_GET['mode'];

if($mode == 'Y'){
	$review_mode = '확정';
}else if($mode == 'N'){
	$review_mode = '거부';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="margin:0px;">
<table width="100%" height="100" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="#2970A0">
    <td align="center"><img src="../images/login_logo.png" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="750" height="375" border="0" cellspacing="0" cellpadding="0">
      <tr>
		<?php if($review_mode=='확정'):?>
			<td align="center"> 바쁘신 가운데, 심사를 수락해주셔서 진심으로 감사드립니다.<br/><br/>
			아래 사이트에 접속하시어 해당 논문에 대한 심사의견을 제출해주시기 바랍니다.
			<br/><br/><br/><br/>
			<center>심사의견 제출 바로가기</center>
			<br/>
			<a href="http://<?=$_SERVER['HTTP_HOST']?>">(<?=$_SERVER['HTTP_HOST']?>)</a>
			</td>
		<?php else:?>
			<td align="center">
			<strong>논문심사 거부 의사가 처리되었습니다.</strong>
<br><br>
			
<p>			
추후 기회가 닿을 경우, 다시 의뢰드리겠습니다.
<br><br>
앞으로도 학회에 지속적인 관심과 격려부탁드립니다. 감사합니다.
</p>
			</td>
		<?php endif?>
      </tr>
      <!--tr>
        <td align="center"><a href="http://circom.zipot.com:8080" target="_blank">논문투고/심사 사이트로 이동</a></td>
      </tr-->
      <!--tr>
        <td align="center"><a href="javascript:window.open('','_self').close();">닫기</a></td>
      </tr-->
    </table></td>
  </tr>
</table>
<script>
</script>
</body>
</html>