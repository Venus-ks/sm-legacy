<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "a1";
###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql);
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	while ($row = sql_fetch_array($res)){
		$tmp_arr = explode("|",$row['auth_type']);
		for($i=0;$i<count($tmp_arr);$i++){
			if($tmp_arr[$i]=="교신저자"){
				$author[]= $row['auth_name'];
			}
		}
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
				<input type="hidden" name="mode" value="d_sub_reg"/>
				<input type="hidden" name="seq" value="<?=$data['seq']?>"/>
				<input type="hidden" name="step" value="<?=$data['step']?>"/>
				<input type="hidden" name="express_publication" value="<?=$data['express_publication']?>">
				<input type="hidden" name="review_category" value="<?=$data['review_category']?>">
				<input type="hidden" name="number" value="<?=$data['number']?>"/>
				<input type="hidden" name="review_score" value="<?=$data['review_score']?>"/>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td background="../images/titlebg.png">
						<img src="../images/03_title01.png" />
					</td>
				</tr>
				<tr>
					<td valign="top" style="padding:20px;">
						<?php include_once("./template/review01.php");?>
						<div style="height:20px;"></div>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Paper Info</td>
							</tr>
						</table>
						<?/*논문 내용*/?>
						<?php include_once("./template/article00.php");?>
						<table class="boardType01_write" style="margin-top:10px;">
							<tr>
								<th>수정논문파일<br/>Modified Manuscript File</th>
								<td>
									<input type="file" name="modify_file" style="width:100%;"/>
									<input type="hidden" name="modify_file_temp" value="<?=$data['submission_data']?>"/>
									<? if($data['modify_file']){ ?>
									<div style="padding-top:5px;"><?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?> <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a></div>
									<? } ?>
								</td>
							</tr>
						</table>
						<?/*저자 리스트*/?>
						<?php foreach($loop as $k=>$v) include("./template/author00.php");	?>
						<div id="auth_table"></div>
						<table class="boardType01_write" style="margin-top:20px;">
							<tr>
								<th width="200">접수 보류 코멘트<br/>Rejact Comments</th>
								<td><textarea name="reject_comment" id="reject_comment" style="width:100%;" rows="5"></textarea></td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td align="right"><a href="javascript:add_author();"><img src="../images/btn_writer_add.png" alt="" width="73" height="29" /></a></td>
							</tr>
						</table>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
							<tr>
								<td  width="200" align="center">
									<table width="" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="92">
												<input type="image" src="../images/btn_summit.png" alt="" style="border:0"/>
											</td>
											 <td width="92">
												<a href="javascript:reject_article();"><img src="../images/btn_reject.png" width="89" height="38" /></a>
											</td>
											<td width="62">
												<a href="d_sub01.php"><img src="../images/btn_list.png" /></a>
											</td>
											<td width="100">
												<a href="javascript:withdraw_article();" class="btn btn-danger" style="line-height:23px;color:#FFF;margin-left:50px">부적합 판정</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</form>
		</td>
	</tr>
</table>
<script type="text/javascript">
function fwrite_submit(f){
	/* if(!f.modify_file.value){
		alert("Modified Original File 는 필수 입력사항입니다.");
		return false;
	} */
	if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./d_process.php";
	return true;
}
function reject_article(){
	if(!document.form1.reject_comment.value){
		alert("접수보류코멘트의 내용을 입력해주세요.");
		return false;
	}else{
		document.form1.mode.value = "reject_article";
		document.form1.action = "./d_process.php";
		document.form1.submit();
	}
}
function withdraw_article(){
	if(!confirm("부적합으로 판정하시겠습니까?\n판정 이후는 복원이 되지 않습니다.")){
		return false;
	}else{
		document.form1.mode.value = "withdraw_article";
		document.form1.action = "./d_process.php";
		document.form1.submit();
	}
}
var tmp_cnt = <?=count($loop)?>;
function add_author(){
	var optionLoop = document.createElement("div");
	optionLoop.className = "";
	optionLoop.name = "multy_"+tmp_cnt;
	optionLoop.id = "multy_"+tmp_cnt;
	var table = "";
	table += "<table class=\"boardType01_write\" style=\"margin-top:20px;\">";
	table += "<tr>";
	table += "<th width=\"200\"><strong>저자유형<br />Author Type</strong></th>";
	table += "<td colspan=\"3\">";
	table += "<label><input type=\"checkbox\" name=\"auth_type"+tmp_cnt+"[]\" value=\"제1저자\"/> 제1저자</label> &nbsp;&nbsp; <label><input type=\"checkbox\" name=\"auth_type"+tmp_cnt+"[]\" value=\"교신저자\"/> 교신저자</label> &nbsp;&nbsp; <label><input type=\"checkbox\" name=\"auth_type"+tmp_cnt+"[]\" value=\"공저자\"/> 공저자</label> &nbsp;&nbsp; ";
	table += "</td>";
	table += "</tr>";
	table += "<tr>";
	table += "<th width=\"200\">저자명*<br />Author Name*</th>";
	table += "<td>한/Kor : <input type=\"text\" name=\"auth_name[]\" id=\"auth_name\" style=\"width:80%;\" /><br/><br/>영/Eng : <input type=\"text\" name=\"auth_name_eng[]\" id=\"auth_name_eng\" style=\"width:80%;\"/></td>";
	table += "<th width=\"200\">전화<br />Tel</th>";
	table += "<td><input type=\"text\" name=\"auth_tel[]\" id=\"auth_tel\" style=\"width:100%;\" /></td>";
	table += "</tr>";
	table += "<tr>";
	table += "<th>이메일*<br />E-mail*</th>";
	table += "<td><input type=\"text\" name=\"auth_email[]\" id=\"auth_email\" style=\"width:100%;\" /></td>";
	table += "<th>핸드폰*<br />Mobile*</th>";
	table += "<td><input type=\"text\" name=\"auth_mobile[]\" id=\"auth_mobile\" style=\"width:100%;\" /></td>";
	table += "</tr>";
	table += "<tr>";
	table += "<th>소속*<br />Organization*</th>";
	table += "<td colspan=\"3\">한/Kor : <input type=\"text\" name=\"organization[]\" id=\"organization\" style=\"width:80%;\" /><br/><br/>영/Eng : <input type=\"text\" name=\"organization_eng[]\" id=\"organization_eng\" style=\"width:80%;\" /></td>";
	table += "</tr>";
	table += "<tr>";
	table += "<th>주소<br />Address</th>";
	table += "<td colspan=\"3\"><input type=\"text\" name=\"address[]\" style=\"width:100%;\" /></td>";
	table += "</tr>";
	table += "</table>";
	optionLoop.innerHTML = table;
	document.getElementById('auth_table').appendChild(optionLoop);
	tmp_cnt++;
}
</script>
