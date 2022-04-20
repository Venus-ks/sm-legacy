<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a6";

###
if($_GET['seq']){
	$sql	= "select * from ad_paper where seq = '{$_GET['seq']}'";
	$data	= sql_fetch($sql);
	//echo $sql;
	$sql	= "select * from ad_paper_auth where parent_seq = '{$_GET['seq']}' order by auth_seq asc";
	$res	= sql_query($sql);
	//echo $sql;
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
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="../images/titlebg.png"><img src="../images/03_title01.png" /></td>
					</tr>
					<tr>
						<td valign="top" style="padding:20px;">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />논문 내용</td>
								</tr>
							</table>
							<?php include_once("./template/article01.php");?>
							<table class="boardType01_write" style="margin-top:20px;">
								<tr>
									<th width="150"><strong>제출논문파일<br/>Original Paper File</strong></th>
									<td>
										<? if($data['submission_data']){ ?>
										<?=end(explode("/",substr(strstr($data['submission_data'], '^'), 1)))?>
										<a href="/down.php?link=<?=$data['submission_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
										<? } ?>
									</td>
								</tr>
							</table>
							<!--table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />의뢰 공문</td>
								</tr>
							</table>
							<table width="100%" class="boardType01_write" style="margin-top:5px;">
							<?php for($i=1;$i<7;$i++):?>
								<tr>
									<?php if($i%2>0):?><th rowspan="2">심사위원 <?=chr(65+($i/2-0.5))?></th><?php endif?>
									<th width="230"><strong><?=($i%2==1)?'1':'2'?>차 심사의뢰공문</strong></th>
									<td>
										<?php if($data['review_offcial_doc'.$i]):?>
											<a href="/down.php?link=<?=$data['review_offcial_doc'.$i]?>">
												<img src="../images/btn_download.png" align="absmiddle">
											</a>
										<?php endif?>
									</td>
								</tr>
							<?php endfor?>
						</table-->

							<?php include_once("./template/review01.php");?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
								<tr>
									<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Final Result Registration Info</td>
								</tr>
							</table>
							<?php
							$sql = "select * from ad_paper_total where parent_seq = '{$_GET['seq']}' order by regdate desc";
							$ress	= sql_query($sql);
							while ($row = sql_fetch_array($ress)) $review[] = $row;
							?>
							<?php if($review):?>
								<?php for($i=0;$i<count($review);$i++):?>
									<table width="100%" class="boardType01_write" style="margin-top:5px;">
										<tr>
											<th width="230"><strong>최종결과</th>
											<td><?=get_result_temp($review[$i]['result'])?></td>
										</tr>
										<tr>
											<th width="230"><strong>최종심사 완료일<br/>Accepted Date</strong></th>
											<td><?=$review[$i]['regdate']?></td>
										</tr>
										<!--tr>
											<th><strong>심사결과<br/>Result</strong></th>
											<td><?=get_result2($review[$i]['result'])?></td>
										</tr-->
										<tr>
											<th>코멘트<br/>Comments</th>
											<td><?=$review[$i]['comments']?></td>
										</tr>
									</table>
								<?php endfor?>
							<?php endif?>
							<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
								<tr>
									<td align="center">
										<a href="d_sub06.php"><img src="../images/btn_list.png" /></a>
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
	if(!confirm("수정하시겠습니까?")) return false;
	f.action = "./d_process.php";
	return true;
}
</script>
