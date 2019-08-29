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
	<td><img src="../images/01_leftmenu01.png" width="199" height="70" /></td>
</tr>


<tr>
	<?
	if($member['mb_level'] == '8'){
		### 로그인한 사용자가 대표간사인 경우에는 대표간사 해당 분야의 논문만 보이게 한다.
		$fields .= " AND review_category = '{$member['field']}' ";
		### 로그인한 사용자가 대표간사인 경우에는 대표간사 자신의 논문은 보이지 않는다.
		$fields .= " AND mb_id != '{$member['mb_id']}' ";
	}

	if($member['mb_level'] == '9'){
		### 로그인한 사용자가 임시대표간사인 경우에는 해당분야 대표간사의 논문만 보이게 한다.
		$sql_reviewer = " select * from g4_member where mb_level = 8 and field='{$member['field']}'";
		$manager	= sql_fetch($sql_reviewer);

		$fields .= " AND review_category = '{$member['field']}' ";
		$fields .= " AND mb_id = '{$manager['mb_id']}' ";
	}

	$tsql1 = " select distinct seq from ad_paper where step = 2 {$fields}";
	$result1 = sql_query($tsql1);
	$total_count1 = mysqlI_num_rows($result1);
	?>

	<? if($menu=="a2"){ ?>
	<td class="leftmenuon"><strong>심사위원 추천</strong>&nbsp;<font class="pointoff">(<?=$total_count1?>)</font><br />
	<font class="font11">Reviewer Recommend</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="d_sub02.php" class="leftmenuofflink"><strong>심사위원 추천</strong>&nbsp;<font class="pointon">(<?=$total_count1?>)</font><br />
	<font class="font11">Reviewer Recommend</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>


<tr>
	<?
	if($member['mb_level'] == '8'){
		### 로그인한 사용자가 대표간사인 경우에는 대표간사 해당 분야의 논문만 보이게 한다.
		$fields9 .= " AND review_category = '{$member['field']}' ";
		### 로그인한 사용자가 대표간사인 경우에는 대표간사 자신의 논문은 보이지 않는다.
		$fields9 .= " AND mb_id != '{$member['mb_id']}' ";
	}

	if($member['mb_level'] == '9'){
		### 로그인한 사용자가 임시대표간사인 경우에는 해당분야 대표간사의 논문만 보이게 한다.
		$sql_reviewer = " select * from g4_member where mb_level = 8 and field='{$member['field']}'";
		$manager	= sql_fetch($sql_reviewer);

		$fields9 .= " AND review_category = '{$member['field']}' ";
		$fields9 .= " AND mb_id = '{$manager['mb_id']}' ";
	}

	$tsql9 = " select distinct seq from ad_paper where (step = 31 or step = 34) {$fields9}";
	$result9 = sql_query($tsql9);
	$total_count9 = mysqlI_num_rows($result9);
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


<!--table width="100%" border="0" cellspacing="0" cellpadding="0">
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
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>
</table-->


<!-- ### MENU1 -->
<!--table width="100%" border="0" cellspacing="0" cellpadding="0">
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

<tr>
	<? if($menu=="b2"){ ?>
	<td class="leftmenuon"><strong>결제내역</strong><br />
	<font class="font11">Payment Breakdown</font></td>
	<? }else{ ?> 
	<td class="leftmenuoff"><a href="d_order.php" class="leftmenuofflink"><strong>결제내역</strong><br />
	<font class="font11">Payment Breakdown</font></a></td>
	<? } ?>
</tr>
<tr><td><img src="../images/leftline.png" width="199" height="1" /></td></tr>
</table-->