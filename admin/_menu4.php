<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="43" align="center" style="font-size: 11px;"><?=$member['mb_name']?>님 환영합니다.</td>
</tr>
<tr>
	<td align="center" style="padding-bottom:10px;"><img src="../images/btn_mypage.png"  /><a href='<?=$g4[bbs_path]?>/logouts.php'><img src="../images/btn_logout1.png" /></a></td>
</tr>
</table>
<!-- ### MENU1 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu01.png" width="199" height="70" /></td>
</tr>

<tr>
	<?
	$tsql = " select distinct seq from ad_paper where (step = 1 or step = 11 or step = 21 or step = 33)";
	$result = sql_query($tsql);
	$total_count0 = mysqli_num_rows($result);
	?>

	<? if($menu=="a1"){ ?>
	<td class="leftmenuon"><strong>논문접수 등록</strong>&nbsp;<font class="pointoff">(<?=$total_count0?>)</font><br />
	<font class="font11">Paper Submission</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub01.php" class="leftmenuofflink"><strong>논문접수 등록</strong>&nbsp;<font class="pointon">(<?=$total_count0?>)</font><br />
	<font class="font11">Paper Submission</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<?
	$tsql2 = " select distinct seq from ad_paper where  ( step = 3 or step = 13 or step = 23 ) ";
	$result2 = sql_query($tsql2);
	$total_count2 = mysqli_num_rows($result2);
	?>

	<? if($menu=="a3"){ ?>
	<td class="leftmenuon"><strong>심사위원 선정</strong>&nbsp;<font class="pointoff">(<?=$total_count2?>)</font><br />
	<font class="font11">Reviewer Assignment</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub03.php" class="leftmenuofflink"><strong>심사위원 선정</strong>&nbsp;<font class="pointon">(<?=$total_count2?>)</font><br />
	<font class="font11">Reviewer Assignment</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<?
	$tsql3 = " select distinct seq from ad_paper where ( step = 5 or step = 15 or step = 25 ) ";
	$result3 = sql_query($tsql3);
	$total_count3 = mysqli_num_rows($result3);
	?>

	<? if($menu=="a4"){ ?>
	<td class="leftmenuon"><strong>심사의견 검토</strong>&nbsp;<font class="pointoff">(<?=$total_count3?>)</font><br />
	<font class="font11">Review Sanction</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub04.php" class="leftmenuofflink"><strong>심사의견 검토</strong>&nbsp;<font class="pointon">(<?=$total_count3?>)</font><br />
	<font class="font11">Review Sanction</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<?
	$tsql9 = " select distinct seq from ad_paper where (step = 31 or step = 34)";
	$result9 = sql_query($tsql9);
	$total_count9 = mysqli_num_rows($result9);
	?>

	<? if($menu=="a9"){ ?>
	<td class="leftmenuon"><strong>최종논문 검토</strong>&nbsp;<font class="pointoff">(<?=$total_count9?>)</font><br />
	<font class="font11">Final Review Sanction</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub09.php" class="leftmenuofflink"><strong>최종논문 검토</strong>&nbsp;<font class="pointon">(<?=$total_count9?>)</font><br />
	<font class="font11">Final Review Sanction</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<?
	$tsql4 = " select distinct seq from ad_paper where step = 50";
	$result4 = sql_query($tsql4);
	$total_count4 = mysqli_num_rows($result4);
	?>

	<? if($menu=="a5"){ ?>
	<td class="leftmenuon"><strong>최종결과 등록</strong>&nbsp;<font class="pointoff">(<?=$total_count4?>)</font><br />
	<font class="font11">Final Result Registration</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub05.php" class="leftmenuofflink"><strong>최종결과 등록</strong>&nbsp;<font class="pointon">(<?=$total_count4?>)</font><br />
	<font class="font11">Final Result Registration</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<? if($menu=="a6"){ ?>
	<td class="leftmenuon"><strong>논문심사 현황</strong><br />
	<font class="font11">Review Progress Status</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub06.php" class="leftmenuofflink"><strong>논문심사 현황</strong><br />
	<font class="font11">Review Progress Status</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>

<tr>
	<? if($menu=="a7"){ ?>
	<td class="leftmenuon"><strong>심사위원 관리</strong><br />
	<font class="font11">Reviewer Registration</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub07.php" class="leftmenuofflink"><strong>심사위원 관리</strong><br />
	<font class="font11">Reviewer Registration</font></a></td>
	<? } ?>
</tr>
<!--<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>-->


<!--tr>
	<? if($menu=="a8"){ ?>
	<td class="leftmenuon"><strong>전체이력 관리</strong><br />
	<font class="font11">Data Administration</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_sub08.php" class="leftmenuofflink"><strong>전체이력 관리</strong><br />
	<font class="font11">Data Administration</font></a></td>
	<? } ?>
</tr-->
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu02.png" width="199" height="70" /></td>
</tr>
<tr>
	<? if($menu=="c1"){ ?>
	<td class="leftmenuon"><strong>출판목록</strong><br />
	<font class="font11">Publication List</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_publication.php" class="leftmenuofflink"><strong>출판목록</strong><br />
	<font class="font11">Publication List</font></a></td>
	<? } ?>
</tr>
<!--<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>-->
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
<tr>
	<? if($menu=="b2"){ ?>
	<td class="leftmenuon"><strong>설정</strong><br />
	<font class="font11">Setting</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="d_setting.php" class="leftmenuofflink"><strong>설정</strong><br />
	<font class="font11">Setting</font></a></td>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu01_instruction_list.png" width="199" height="70" /></td>
</tr>
<tr>
	<td class="leftmenuoff"><a href="<?=$info['submit_rule_url']?>" class="leftmenuofflink"><strong>학회지 투고규정</strong><br /><font class="font11">Instruction for Manuscript</font></a></td>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<td class="leftmenuoff"><a href="<?=$info['ethic_rule_url']?>" class="leftmenuofflink"><strong>연구윤리 규정</strong><br />
	<font class="font11">Publication ethics</font></a></td>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<td class="leftmenuoff"><a href="#" class="leftmenuofflink" data-toggle="modal" data-target="#manualModal"><strong>시스템이용방법</strong><br /><font class="font11">How to Use Online Paper Submission</font></a></td>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
</table>
<div class="modal fade" id="manualModal" tabindex="-1" role="dialog" aria-labelledby="투고시스템 매뉴얼">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">투고시스템 메뉴얼</h4>
      </div>
      <div class="modal-body">
		  <embed src="<?=$info['manual_url']?>" frameborder="0" width="100%" height="790">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
