<?
include_once("./admin_head.php");

###
$mlevel		= 6;
$menu		= "a1";

$tmp_cnt = 1;
if($_GET['seq']){
	$sql	= "select * from ad_journal where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql); 

	$temp_arr = explode("|", $data['field']);
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
	<input type="hidden" name="mode" value="c_sub_reg"/>
	<input type="hidden" name="seq" value="<?=$data['seq']?>"/>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png"><img src="../images/04_title01.png" /></td>
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
		
 
			<table class="boardType01_write">
			<tr>
				<th width="150">한글학술지명 <font class="point">*</font><br /><font style="font-weight:normal !important;">Journal Title(KOR)</font></th>
				<td><input type="text" name="title" value="<?=$data['title']?>" itemname="한글학술지명" required style="width:100%;" /></td>
			</tr>
			<tr>
				<th width="150">영문학술지명<br /><font style="font-weight:normal !important;">Journal Title(ENG)</font></th>
				<td><input type="text" name="title_eng" value="<?=$data['title_eng']?>" style="width:100%;" /></td>
			</tr>
			<tr>
				<th>ISSN <font class="point">*</font></th>
				<td><input type="text" name="issn" value="<?=$data['issn']?>" itemname="ISSN" required style="width:50%;" /> ex)1930532X</td>
			</tr>
			<tr>
				<th>ISSN<br /><font style="font-weight:normal !important;">(전자저널)</font></th>
				<td><input type="text" name="issn_ec" value="<?=$data['issn_ec']?>" style="width:50%;" /> ex)1930532X</td>
			</tr>
			<tr>
				<th>ISSN<br /><font style="font-weight:normal !important;">(CD배포본)</font></th>
				<td><input type="text" name="issn_cd" value="<?=$data['issn_cd']?>" style="width:50%;" /> ex)1930532X</td>
			</tr>
			<tr>
				<th>창간일 <font class="point">*</font></th>
				<td><input type="text" name="sdate" id="sdate" value="<?=$data['sdate']?>" itemname="창간일" required style="width:50%;" /> <a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png"  align="absmiddle" /></a></td>
			</tr>
			<tr>
				<th>폐간일</th>
				<td><input type="text" name="edate" id="edate" value="<?=$data['edate']?>" itemname="창간일" required style="width:50%;" /> <a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png"  align="absmiddle" /></a></td>
			</tr>
			<tr>
				<th>학술지유형 <font class="point">*</font></th>
				<td>
					<select name="category" id="category" style="width:100%;">
						<option value="">= 선택해주세요 =</option>
						<? 
							$arr = get_category(); 
							for($i=0;$i<count($arr);$i++){
						?>
							<option value="<?=$arr[$i]['cvalue']?>"  <? if($data['category']==$arr[$i]['cvalue']){ ?>selected<? } ?>><?=$arr[$i]['ctext']?></option>
						<?
							}	
						?>
					</select>
				</td>
			</tr>
			<tr>
				<th>분야 <font class="point">*</font></th>
				<td>
					<label><input type="checkbox" name="field[]" value="Chemistry" <?if(isset($temp_arr) && in_array('Chemistry',$temp_arr)){?>checked<?}?>/> Chemistry</label>
					<label><input type="checkbox" name="field[]" value="Physics, Genesis and Survey" <?if(isset($temp_arr) && in_array('Physics, Genesis and Survey',$temp_arr)){?>checked<?}?>/> Physics, Genesis and Survey</label>
					<label><input type="checkbox" name="field[]" value="Biology" <?if(isset($temp_arr) && in_array('Biology',$temp_arr)){?>checked<?}?>/> Biology</label>
					<label><input type="checkbox" name="field[]" value="Fertility and Plantnutrition" <?if(isset($temp_arr) && in_array('Fertility and Plantnutrition',$temp_arr)){?>checked<?}?>/> Fertility and Plantnutrition</label>
					<label><input type="checkbox" name="field[]" value="Environments" <?if(isset($temp_arr) && in_array('Environments',$temp_arr)){?>checked<?}?>/> Environments</label>
				</td>
			</tr>
			<tr>
				<th>설명<br /><font style="font-weight:normal !important;">(한글)</font></th>
				<td><textarea name="cont" style="width:100%;" rows="5"><?=$data['cont']?></textarea></td>
			</tr>
			<tr>
				<th>설명<br /><font style="font-weight:normal !important;">(영어)</font></th>
				<td><textarea name="cont_eng" style="width:100%;" rows="5"><?=$data['cont_eng']?></textarea></td>
			</tr>
			</table>


			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="right" width="50%">
					<input type="image" src="../images/btn_summit.png" alt="" style="width:89px;height:38px;border:0px;"/>
				</td>
				<td align="left" width="50%">
					<a href="c_sub01.php"><img src="../images/btn_list.png" /></a></td>
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
	f.action = "./c_process.php"; 
	return true;
}
</script>