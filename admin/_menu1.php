<script>
function manual_popup(cont){
		window.open("../admin/file/"+cont+".pdf",'','width=1180,height=800,scrollbars=yes');
	}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="43" align="center"><?=$member['mb_name']?>님 환영합니다.</td>
</tr>
<tr>
	<td align="center" style="padding-bottom:10px;"><a href="a_member_write.php?mb_no=<?=$member['mb_no']?>"><img src="../images/btn_mypage.png"  /></a><a href='<?=$g4[bbs_path]?>/logouts.php'><img src="../images/btn_logout1.png" /></a></td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu01.png" width="199" height="70" /></td>
</tr>
<tr>
	<? if($menu=="a1"){ ?>
	<td class="leftmenuon"><strong>논문투고 등록</strong><br />
	<font class="font11">Paper Submission</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="a_sub01.php" class="leftmenuofflink"><strong>논문투고 등록</strong><br />
	<font class="font11">Paper Submission</font></a></td>
	<? } ?>
</tr>
<tr>
	<td><img src="../images/leftline.png" width="199" height="1" /></td>
</tr>
<tr>
	<? if($menu=="a2"){ ?>
	<td class="leftmenuon"><strong>투고 심사현황</strong><br />
	<font class="font11">Review Progress Status</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="a_sub02.php" class="leftmenuofflink"><strong>투고 심사현황</strong><br />
	<font class="font11">Review Progress Status</font></a></td>
	<? } ?>
</tr>
</table>

<!--table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="../images/01_leftmenu02.png" width="199" height="70" /></td>
</tr>
<tr>
	<? if($menu=="a3"){ ?>
	<td class="leftmenuon"><strong>출판목록</strong><br />
	<font class="font11">Publication List</font></td>
	<? }else{ ?>
	<td class="leftmenuoff"><a href="a_publication.php" class="leftmenuofflink"><strong>출판목록</strong><br />
	<font class="font11">Publication List</font></a></td>
	<? } ?>
</tr>
</table-->


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
	<td class="leftmenuoff"><a href="https://www.kci.go.kr/kciportal/po/member/loginForm.kci?returnUrl=check/login.jsp" target="_blank" class="leftmenuofflink"><strong>KCI논문유사도검사</strong><br />
	<font class="font11">KCI Document Verification</font></a></td>
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
		  <embed src="<?=$info['author_manual_url']?>" frameborder="0" width="100%" height="790">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
