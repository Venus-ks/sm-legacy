<?
include_once("./admin_head.php");

###
$mlevel		= 8;
$menu		= "a8";

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

		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>
			
			<table class="boardType01_write">
			<tr>
				<th>Regist Date</th>
				<td><?=$data['regdate']?></td>
			</tr>
			<tr>
				<th width="150"><strong>Jourmal Title</strong></th>
				<td><?=$data['jourmal']?></td>
			</tr>
			<tr>
				<th>Receipt Number</th>
				<td> ?? </td>
			</tr>
			<tr>
				<th>Title</th>
				<td><?=$data['title']?></td>
			</tr>
			<tr>
				<th>Title(ENG)</th>
				<td><?=$data['title_eng']?></td>
			</tr>
			<tr>
				<th>Keyword<br /></th>
				<td><?=$data['keyword']?></td>
			</tr>
			<tr>
				<th>Abstract</th>
				<td><?=$data['abstract']?></td>
			</tr>
			<tr>
				<th>Abstract(ENG)</th>
				<td><?=$data['abstract_eng']?></td>
			</tr>
			</table>


			<table class="boardType01_write" style="margin-top:20px;">
			<tr>
				<th width="150"><strong>Express Publication</strong></th>
				<td>
					<?=$data['express_publication']?>
				</td>
			</tr>
			<tr>
				<th>Review Category<br /></th>
				<td><? if($data['review_category']){ ?><?=get_category($data['review_category'])?><? } ?></td>
			</tr>
			<tr>
				<th width="150"><strong>Submission Data</strong></th>
				<td>
					<? if($data['submission_data']){ ?> 
					<?=end(explode("/",$data['submission_data']))?> <a href="/down.php?link=<?=$data['submission_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<? } ?>
				</td>
			</tr>
			<tr>
				<th>Modified Original File</th>
				<td>
					<? if($data['modify_file']){ ?> 
					<?=end(explode("/",$data['modify_file']))?> <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<? } ?>
				</td>
			</tr>
			</table>


	<?
		for($i=0 ; $i<count($loop) ; $i++){	
			$temp_arr = explode("|", $loop[$i]['auth_type']);
	?>
			<table class="boardType01_write" style="margin-top:20px;">
			<tr>
				<th width="150"><strong>Author Type</strong></th>
				<td colspan="3"><?=$loop[$i]['auth_type']?></td>
			</tr>
			<tr>
				<th width="15%"><strong>Author Name</strong></th>
				<td width="35%"><?=$loop[$i]['auth_name']?></td>
				<th width="15%"><strong>Tel</strong></th>
				<td width="35%"><?=$loop[$i]['auth_tel']?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><?=$loop[$i]['auth_email']?></td>
				<th>Mobile</th>
				<td><?=$loop[$i]['auth_mobile']?></td>
			</tr>
			<tr>
				<th>Organization</th>
				<td><?=$loop[$i]['organization']?></td>
				<th>Address</th>
				<td><?=$loop[$i]['address']?></td>
			</tr>
			</table>
	<?
		}	
	?>



	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
	<tr>
		<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />심사의견서</td>
	</tr>
	</table>
<?
	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_a_user']}' order by regdate desc limit 1";
	$review1 = sql_fetch($sql);

	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_b_user']}' order by regdate desc limit 1";
	$review2 = sql_fetch($sql);

	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_c_user']}' order by regdate desc limit 1";
	$review3 = sql_fetch($sql);

	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_d_user']}' order by regdate desc limit 1";
	$review4 = sql_fetch($sql);

	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_e_user']}' order by regdate desc limit 1";
	$review5 = sql_fetch($sql);
?>
		<table width="100%" class="boardType01_write" style="margin-top:5px;">
		<tr>
			<th width="150" rowspan="4" style="text-align:center;">
				<strong>심사위원 A</strong>
				<div style="padding-top:5px;"><?=get_review_name($data['review_a_user'])?></div>
				<div style="padding-top:5px;"><?=$data['review_a_date']?></div>
			</th>
			<th width="150"><strong>Regist Date</strong></th>
			<td><?=$review1['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>Result</strong></th>
			<td><? if($review1['result']){ ?><?=get_result($review1['result'])?><? } ?></td>
		</tr>
		<tr>
			<th width="150"><strong>Comments</strong></th>
			<td><?=$review1['comments']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사의견서</strong></th>
			<td>
				<? if($review1['rfile']){ ?> 
				<?=end(explode("/",$review1['rfile']))?> <a href="/down.php?link=<?=$review1['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		<tr>
			<th width="150" rowspan="4" style="text-align:center;">
				<strong>심사위원 B</strong>
				<div style="padding-top:5px;"><?=get_review_name($data['review_b_user'])?></div>
				<div style="padding-top:5px;"><?=$data['review_b_date']?></div>
			</th>
			<th width="150"><strong>Regist Date</strong></th>
			<td><?=$review2['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>Result</strong></th>
			<td><? if($review2['result']){ ?><?=get_result($review2['result'])?><? } ?></td>
		</tr>
		<tr>
			<th width="150"><strong>Comments</strong></th>
			<td><?=$review2['comments']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사의견서</strong></th>
			<td>
				<? if($review2['rfile']){ ?> 
				<?=end(explode("/",$review2['rfile']))?> <a href="/down.php?link=<?=$review2['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		<tr>
			<th width="150" rowspan="4" style="text-align:center;">
				<strong>심사위원 C</strong>
				<div style="padding-top:5px;"><?=get_review_name($data['review_c_user'])?></div>
				<div style="padding-top:5px;"><?=$data['review_c_date']?></div>
			</th>
			<th width="150"><strong>Result</strong></th>
			<td><?=$review3['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>Result</strong></th>
			<td><? if($review3['result']){ ?><?=get_result($review3['result'])?><? } ?></td>
		</tr>
		<tr>
			<th width="150"><strong>Comments</strong></th>
			<td><?=$review3['comments']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사의견서</strong></th>
			<td>
				<? if($review3['rfile']){ ?> 
				<?=end(explode("/",$review3['rfile']))?> <a href="/down.php?link=<?=$review3['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		<tr>
			<th width="150" rowspan="4" style="text-align:center;">
				<strong>심사위원 D</strong>
				<div style="padding-top:5px;"><?=get_review_name($data['review_d_user'])?></div>
				<div style="padding-top:5px;"><?=$data['review_d_date']?></div>
			</th>
			<th width="150"><strong>Result</strong></th>
			<td><?=$review4['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>Result</strong></th>
			<td><? if($review4['result']){ ?><?=get_result($review4['result'])?><? } ?></td>
		</tr>
		<tr>
			<th width="150"><strong>Comments</strong></th>
			<td><?=$review4['comments']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사의견서</strong></th>
			<td>
				<? if($review4['rfile']){ ?> 
				<?=end(explode("/",$review4['rfile']))?> <a href="/down.php?link=<?=$review4['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		<tr>
			<th width="150" rowspan="4" style="text-align:center;">
				<strong>심사위원 E</strong>
				<div style="padding-top:5px;"><?=get_review_name($data['review_e_user'])?></div>
				<div style="padding-top:5px;"><?=$data['review_e_date']?></div>
			</th>
			<th width="150"><strong>Result</strong></th>
			<td><?=$review5['regdate']?></td>
		</tr>
		<tr>
			<th width="150"><strong>Result</strong></th>
			<td><? if($review5['result']){ ?><?=get_result($review5['result'])?><? } ?></td>
		</tr>
		<tr>
			<th width="150"><strong>Comments</strong></th>
			<td><?=$review5['comments']?></td>
		</tr>
		<tr>
			<th width="150"><strong>심사의견서</strong></th>
			<td>
				<? if($review5['rfile']){ ?> 
				<?=end(explode("/",$review5['rfile']))?> <a href="/down.php?link=<?=$review5['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
				<? } ?>
			</td>
		</tr>
		</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
	<tr>
		<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />논문 총평</td>
	</tr>
	</table>
	<?
	$sql = "select * from ad_paper_total where parent_seq = '{$_GET['seq']}' order by regdate desc";
	$ress	= sql_query($sql);
	while ($row = sql_fetch_array($ress)){
		$review[] = $row;
	}
	?>
	<? if($review){ ?> 
		<? for($i=0;$i<count($review);$i++){ ?>
			<table width="100%" class="boardType01_write" style="margin-top:5px;">
			<tr>
				<th width="150"><strong>등록일</strong></th>
				<td><?=$review[$i]['regdate']?></td>
			</tr>
			<tr>
				<th width="150"><strong>Result</strong></th>
				<td><?=get_result($review[$i]['result'])?></td>
			</tr>
			<tr>
				<th>Comments</th>
				<td><?=$review[$i]['comments']?></td>
			</tr>
			<tr>
				<th>File of Explanation <br />for review</th>
				<td>
					<? if($review[$i]['rfile']){ ?> 
					<?=end(explode("/",$review[$i]['rfile']))?> <a href="/down.php?link=<?=$review[$i]['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<? } ?>
				</td>
			</tr>
			</table>
		<? } ?>
	<? } ?>


		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
		<tr>
			<td align="center">
				<a href="d_sub08.php"><img src="../images/btn_list.png" /></a></td>
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
	if(!confirm("등록하시겠습니까?")) return false;
	f.action = "./d_process.php"; 
	return true;
}
</script>