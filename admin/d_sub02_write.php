<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a2";

###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql); 

	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	while ($row = sql_fetch_array($res)){
		$loop[] = $row;
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" height="800" valign="top" background="/images/leftbg.png">

	<!-- ### LEFT MENU -->
	<? include_once("./_menu.php"); ?>

	</td>
	<td valign="top">


	<form name="form1" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="d_sub2_reg"/>
	<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
	<input type="hidden" name="number" value="<?=$data['number']?>"/>
	<input type="hidden" name="express_publication" value="<?=$data['express_publication']?>">
	<input type="hidden" name="review_category" value="<?=$data['review_category']?>">
	

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/03_title02.png" /></td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Paper Info</td>
		</tr>
		</table>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>
			
			<table width="100%" class="boardType01_write">
			<tr>
				<th width="200"><strong>저널명<br/>Journal Title</strong></th>
				<td colspan="3"><?=$data['jourmal']?></td>
			</tr>
			<tr>
				<th>논문번호<br/>Manuscript Number</th>
				<?
				$cyear = date("y");
				?>
				<?
				if(strlen($data['number']) == 1){
					$number = "00".$data['number'];
				}else if(strlen($data['number']) == 2){
					$number = "0".$data['number'];
				}else{
					$number = $data['number'];
				}
				?>
				<td colspan="3">KJ-<?=$cyear?>-<?=$number?></td>
			</tr>
			<tr>
				<th>논문명(국문)<br/>Title(KOR)</th>
				<td colspan="3"><?=$data['title']?></td>
				<input type="hidden" name="title" value="<?=$data['title']?>">
			</tr>
			<tr>
				<th>논문명(영문)<br/>Title(ENG)</th>
				<td colspan="3"><?=$data['title_eng']?></td>
			</tr>
			<tr>
				<th>키워드(국문)<br/>Keyword(KOR)<br /></th>
				<td colspan="3"><?=$data['keyword']?></td>
			</tr>
			<tr>
				<th>키워드(영문)<br/>Keyword(ENG)<br /></th>
				<td colspan="3"><?=$data['keyword_eng']?></td>
			</tr>

			<!-- ### -->
			<tr>
				<th width="150">저자명<br/>Author Name</th>
				<td><?=$loop[0]['auth_name']?></td>
				<th width="150">소속<br/>Organization</th>
				<td><?=$loop[0]['organization']?></td>
			</tr>
			<?	
				$auth_type = str_replace("|",", ",$loop[0]['auth_type'])
			?>
			<tr>
				<th>저자유형<br/>Author Type<br /></th>
				<td><?=$auth_type?></td>
				<th>전화<br/>Tel</th>
				<td><?=$loop[0]['auth_tel']?></td>
			</tr>
			<tr>
				<th>이메일<br/>E-mail<br /></th>
				<td><?=$loop[0]['auth_email']?></td>
				<th>핸드폰<br/>Mobile</th>
				<td><?=$loop[0]['auth_mobile']?></td>
			</tr>
			</table>

			<table class="boardType01_write" style="margin-top:20px;">
			<tr>
				<th width="200">원고종류<br/>Type of Manuscript</th>
				<td><? if($data['manuscript']){ ?><?=get_manuscript($data['manuscript'])?><? } ?></td>
			</tr>
			<tr>
				<th width="150"><strong>심사요청분야<br/>Review Category</strong></th>
				<td><? if($data['review_category_target']){ ?><?=get_category_target($data['review_category_target'])?><? } ?> / <? if($data['review_category']){ ?><?=get_category($data['review_category'])?><? } ?></td>
			</tr>
			<tr>
				<th width="150"><strong>수정논문파일<br/>Modified Menuscript File</strong></th>
				<td>
					<? if($data['modify_file']){ ?> 
					<?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?> <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<? } ?>
				</td>
			</tr>
			<!--tr>
				<th width="150"><strong>이미지 파일 추가<br/>Upload Image Files</strong></th>
				<td>
					<? if($data['submission_add_data']){ ?> 
					<?=end(explode("/",substr(strstr($data['submission_add_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['submission_add_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<? } ?>
				</td>
			</tr-->
			</table>



			<table width="100%" class="boardType01_write" style="margin-top:20px;">
			<tr>
				<th width="200" rowspan="2"><strong>심사위원 A<br/>Reviewer A</strong></th>
				<td>
					<input type="text" name="review_a_name" id="review_a_name" style="width:100px;" value="<?=get_review_name($data['review_a_user'])?>" readonly/>
					<input type="hidden" name="review_a_user" id="review_a_user" style="width:100px;" value="<?=$data['review_a_user']?>"/>
					<input type="hidden" name="review_a_field" id="review_a_field" style="width:100px;"/>
					<a href="javascript:delete_choice('review_a');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" /></a>
				</td>
				<!--
				<td width="130" rowspan="2" align="center">
					<input type="text" name="review_a_date" id="review_a_date" style="width:109px;" value="<?=$data['review_a_date']?>"/>                      
					<a href="javascript:win_calendar('review_a_date', document.getElementById('review_a_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" /></a>
				</td>
				-->
			</tr>
			<tr><td><a href="javascript:pop_choice('review_a');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" /></a></td></tr>

			<tr>
				<th width="150" rowspan="2"><strong>심사위원 B<br/>Reviewer B</strong></th>
				<td>
					<input type="text" name="review_b_name" id="review_b_name" style="width:100px;" value="<?=get_review_name($data['review_b_user'])?>" readonly/>
					<input type="hidden" name="review_b_user" id="review_b_user" style="width:100px;" value="<?=$data['review_b_user']?>"/>
					<input type="hidden" name="review_b_field" id="review_b_field" style="width:100px;"/>
					<a href="javascript:delete_choice('review_b');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" /></a>
				</td>
				<!--
				<td width="130" rowspan="2" align="center">
					<input type="text" name="review_b_date" id="review_b_date" style="width:109px;" value="<?=$data['review_b_date']?>"/>                      
					<a href="javascript:win_calendar('review_b_date', document.getElementById('review_b_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" /></a>
				</td>
				-->
			</tr>
			<tr><td><a href="javascript:pop_choice('review_b');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" /></a></td></tr>

			<tr>
				<th width="150" rowspan="2"><strong>심사위원 C<br/>Reviewer C</strong></th>
				<td>
					<input type="text" name="review_c_name" id="review_c_name" style="width:100px;" value="<?=get_review_name($data['review_c_user'])?>" readonly/>
					<input type="hidden" name="review_c_user" id="review_c_user" style="width:100px;" value="<?=$data['review_c_user']?>"/>
					<input type="hidden" name="review_c_field" id="review_c_field" style="width:100px;"/>
					<a href="javascript:delete_choice('review_c');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" /></a>
				</td>
				<!--
				<td width="130" rowspan="2" align="center">
					<input type="text" name="review_c_date" id="review_c_date" style="width:109px;" value="<?=$data['review_c_date']?>"/>                    
					<a href="javascript:win_calendar('review_c_date', document.getElementById('review_c_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" /></a>
				</td>
				-->
			</tr>
			<tr><td><a href="javascript:pop_choice('review_c');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" /></a></td></tr>

			<tr>
				<th width="150" rowspan="2"><strong>심사위원 D<br/>Reviewer D</strong></th>
				<td>
					<input type="text" name="review_d_name" id="review_d_name" style="width:100px;" value="<?=get_review_name($data['review_d_user'])?>" readonly/>
					<input type="hidden" name="review_d_user" id="review_d_user" style="width:100px;" value="<?=$data['review_d_user']?>"/>
					<input type="hidden" name="review_d_field" id="review_d_field" style="width:100px;"/>
					<a href="javascript:delete_choice('review_d');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" /></a>
				</td>
				<!--
				<td width="130" rowspan="2" align="center">
					<input type="text" name="review_d_date" id="review_d_date" style="width:109px;" value="<?=$data['review_d_date']?>"/>                      
					<a href="javascript:win_calendar('review_d_date', document.getElementById('review_d_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" /></a>
				</td>
				-->
			</tr>
			<tr><td><a href="javascript:pop_choice('review_d');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" /></a></td></tr>

			<tr>
				<th width="150" rowspan="2"><strong>심사위원 E<br/>Reviewer E</strong></th>
				<td>
					<input type="text" name="review_e_name" id="review_e_name" style="width:100px;" value="<?=get_review_name($data['review_e_user'])?>" readonly/>
					<input type="hidden" name="review_e_user" id="review_e_user" style="width:100px;" value="<?=$data['review_e_user']?>"/>
					<input type="hidden" name="review_e_field" id="review_e_field" style="width:100px;"/>
					<a href="javascript:delete_choice('review_e');"><img src="../images/btn_delete.png" width="63" height="21" align="absmiddle" /></a>
				</td>
				<!--
				<td width="130" rowspan="2" align="center">
					<input type="text" name="review_e_date" id="review_e_date" style="width:109px;" value="<?=$data['review_e_date']?>"/>                      
					<a href="javascript:win_calendar('review_e_date', document.getElementById('review_e_date').value, '');"><img src="../images/btn_paper_date.png" style="margin-top:5px;" /></a>
				</td>
				-->
			</tr>
			<tr><td><a href="javascript:pop_choice('review_e');"><img src="../images/btn_paper_reviewer1.png" width="91" height="21" /></a></td></tr>
			</table>


			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="right" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:38px;border:0px;"/>
				</td>
                <td width="10px">&nbsp;</td>
				<td align="left" width="50%">
					<a href="d_sub02.php"><img src="../images/btn_list.png" /></a></td>
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
	
	if (document.getElementById("review_a_name").value == "") { 
		alert("최소 한명은 심사위원을 선택하셔야 합니다.."); 
		return false; 
	}
	
	if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}

function pop_choice(nm){
	window.open("./popup_review.php?nm="+nm,"","width=640,height=455,scrollbars=yes");
}

function delete_choice(nm){
	$("#"+nm+"_user").val('');
	$("#"+nm+"_name").val('');
	$("#"+nm+"_field").val('');
}
</script>