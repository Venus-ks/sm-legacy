<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="43" align="center"><?=$member['mb_name']?>님 환영합니다.</td>
</tr>
<tr>
	<td align="center" style="padding-bottom:10px;"><img src="../images/btn_mypage.png"  /><a href='<?=$g4[bbs_path]?>/logouts.php'><img src="../images/btn_logout1.png" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu01.png" width="199" height="70" /></td>
</tr>
<tr>
	<?
	$where = "
	(((review_a_user = '{$member['mb_id']}' and review_a_step = '0' and review_a_conf = 'Y') or (review_b_user = '{$member['mb_id']}' and review_b_step = '0' and review_b_conf = 'Y') or (review_c_user = '{$member['mb_id']}' and review_c_step = '0' and review_c_conf = 'Y')) and step = 3)
	or
	(((review_a_user = '{$member['mb_id']}' and review_a_step = '0') or (review_b_user = '{$member['mb_id']}' and review_b_step = '0') or (review_c_user = '{$member['mb_id']}' and review_c_step = '0')) and step = 4)
	or
	(((review_a_user = '{$member['mb_id']}' and review_a_step = '1' and review_a_conf = 'Y' and (review_a_result = '2' OR review_a_result = '3')) or (review_b_user = '{$member['mb_id']}' and review_b_step = '1' and review_b_conf = 'Y' and (review_b_result = '2' OR review_b_result = '3')) or (review_c_user = '{$member['mb_id']}' and review_c_step = '1' and review_c_conf = 'Y' and (review_c_result = '2' OR review_c_result = '3'))) and step = 14)
	or
	(((review_a_user = '{$member['mb_id']}' and review_a_step = '2' and review_a_conf = 'Y' and (review_a_result = '2' OR review_a_result = '3')) or (review_b_user = '{$member['mb_id']}' and review_b_step = '2' and review_b_conf = 'Y' and (review_b_result = '2' OR review_b_result = '3')) or (review_c_user = '{$member['mb_id']}' and review_c_step = '2' and review_c_conf = 'Y' and (review_c_result = '2' OR review_c_result = '3'))) and step = 24)
";
	$tsql1 = " select distinct seq from ad_paper where {$where}";
	$result1 = sql_query($tsql1);
	$total_count0 = mysqlI_num_rows($result1);
	?>

	<? if($menu=="a1"){ ?>
	<td class="leftmenuon"><strong>심사의견 등록</strong>&nbsp;<font class="pointoff">(<?=$total_count0?>)</font><br />
	<font class="font11">Review</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="b_sub01.php" class="leftmenuofflink"><strong>심사의견 등록</strong>&nbsp;<font class="pointon">(<?=$total_count0?>)</font><br />
	<font class="font11">Review</font></a></td>
	<? } ?>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<? if($menu=="a2"){ ?>
	<td class="leftmenuon"><strong>심사위원 심사현황</strong><br />
	<font class="font11">Review Progress Status</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="b_sub02.php" class="leftmenuofflink"><strong>심사위원 심사현황</strong><br />
	<font class="font11">Review Progress Status</font></a></td>
	<? } ?>
</tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu01_instruction_list.png" width="199" height="70" /></td>
</tr>
<!--tr>
	<td class="leftmenuoff"><a href="<?=$info['review_rule_url']?>" class="leftmenuofflink"><strong>논문심사규정</strong><br /><font class="font11">Instruction for Manuscript</font></a></td>
</tr-->
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<td class="leftmenuoff"><a href="<?=$info['review_rule_url']?>" class="leftmenuofflink"><strong>심사규정</strong><br />
	<font class="font11">Reviewer Rules</font></a></td>
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
        <h4 class="modal-title" id="myModalLabel">투고시스템 매뉴얼</h4>
      </div>
      <div class="modal-body">
		  <embed src="<?=$info['reviewer_manual_url']?>" frameborder="0" width="100%" height="790>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
