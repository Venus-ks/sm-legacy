<?
include_once("../_common1.php");

$seq = $_GET['seq'];
$review_user = $_GET['review_user'];

$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
$data	= sql_fetch($sql);

$sql2	= "select * from g4_member where mb_email = '{$_GET['review_user']}'";
$data2	= sql_fetch($sql2);

$sql3	= "select confirm from ad_reviewer_log where parent_seq = '{$_GET['seq']}' and review_user = '{$_GET['review_user']}' ";
$data3	= sql_fetch($sql3);

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
    <td align="center"><table width="700" height="375" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"> 논문 '
          <?=$data['title']?>
          ' <?=($data['step']>10)?'2차심사':''?> 에 대해서
          <?=$data2['mb_name']?>
          심사위원의 논문 심사 승인 여부 </td>
      </tr>
	  <tr>
		<td><center><a href="/down.php?link=<?=$data[$_GET['doctype']]?>">[공문 확인]</a></center></td>
	  </tr>	
	  <tr>
		<td><center><a href="/down.php?link=<?=$data['modify_file']?>">[논문 열람]</a></center></td>
	  </tr>	
      <?if($data3['confirm']==''){?>
      <tr>
        <td height="50"></td>
      </tr>
      <tr>
        <td>
          <table width="700" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="300" align="right"><a href="javascript:confirmY('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_approve.png" /></a></td>
              <td width="100">&nbsp;</td>
              <td width="300" align="left"><a href="javascript:confirmN('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_reject.png" /></a></td>
            </tr>
          </table></td>
      </tr>
      <?}else if($data3['confirm']=='Y'){?>
      <!--tr>
        <td align="center"> 이미 심사 허가를 선택 한 논문입니다. </td>
      </tr-->
	  <tr>
        <td height="50"></td>
      </tr>
      <tr>
        <td>
          <table width="700" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="300" align="right"><a href="javascript:confirmY('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_approve.png" /></a></td>
              <td width="100">&nbsp;</td>
              <td width="300" align="left"><a href="javascript:confirmN('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_reject.png" /></a></td>
            </tr>
          </table></td>
      </tr>
      <?}else if($data3['confirm']=='N'){?>
      <!--tr>
        <td align="center"> 이미 심사 거부를 선택 한 논문입니다. </td>
      </tr-->
	  <tr>
        <td height="50"></td>
      </tr>
      <tr>
        <td>
          <table width="700" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="300" align="right"><a href="javascript:confirmY('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_approve.png" /></a></td>
              <td width="100">&nbsp;</td>
              <td width="300" align="left"><a href="javascript:confirmN('<?=$seq?>','<?=$review_user?>');"><img src="../images/reviewer_check_reject.png" /></a></td>
            </tr>
          </table></td>
      </tr>
      <?}?>
    </table>
	</td>
  </tr>
</table>
<script>
function confirmY(seq, user){
	location.href = "d_process.php?mode=reviewer_confirmY&seq="+seq+"&review_user="+user;
}

function confirmN(seq, user){
	location.href = "d_process.php?mode=reviewer_confirmN&seq="+seq+"&review_user="+user;
}
</script>
</body>
</html>