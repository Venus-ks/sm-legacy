<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="43" align="center"><?=$member['mb_name']?>님 환영합니다.</td>
</tr>
<tr>
	<td align="center" style="padding-bottom:10px;"><img src="../images/btn_mypage.png"  /><a href='<?=$g4[bbs_path]?>/logouts.php'><img src="../images/btn_logout1.png" /></a></td>
</tr>
</table>
<!-- ### MENU1 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/03_leftmenu01.png" width="199" height="70" /></td>
</tr>

<tr>
	<? if($menu=="a1"){ ?>
	<td class="leftmenuon"><strong>학습지 저널등록</strong><br />
	<font class="font11">Registration of Journal</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="c_sub01.php" class="leftmenuofflink"><strong>학습지 저널등록</strong><br />
	<font class="font11">Registration of Journal</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<? if($menu=="a2"){ ?>
	<td class="leftmenuon"><strong>논문규정 관리</strong><br />
	<font class="font11">Paper rule management</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="c_sub02.php" class="leftmenuofflink"><strong>논문규정 관리</strong><br />
	<font class="font11">Paper rule management</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>
<tr>
	<? if($menu=="a3"){ ?>
	<td class="leftmenuon"><strong>심사현황 관리</strong><br />
	<font class="font11">Review Progress Status</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="c_sub03.php" class="leftmenuofflink"><strong>심사현황 관리</strong><br />
	<font class="font11">Review Progress Status</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>
</table>



<!-- ### MENU1 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/03_leftmenu02.png" width="199" height="70" /></td>
</tr>
<tr>
	<? if($menu=="b1"){ ?>
	<td class="leftmenuon"><strong>회원관리</strong><br />
	<font class="font11">Membership</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="d_member.php" class="leftmenuofflink"><strong>회원관리</strong><br />
	<font class="font11">Membership</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<!--tr>
	<? if($menu=="b2"){ ?>
	<td class="leftmenuon"><strong>결제내역</strong><br />
	<font class="font11">Payment Breakdown</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="d_order.php" class="leftmenuofflink"><strong>결제내역</strong><br />
	<font class="font11">Payment Breakdown</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr-->
</table>