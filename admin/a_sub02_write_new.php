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
								<th width="230">투고일<br/>Submission Date</th>
								<td><?=$data['regdate']?></td>
							</tr>
							<tr>
								<th><strong>저널명<br/>Journal Title</strong></th>
								<td><?=$data['jourmal']?></td>
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
								<td>KJ-<?=$cyear?>-<?=$number?></td>
							</tr>
							<tr>
								<th>논문명(국문)<br/>Manuscript Title (Kor)</th>
								<td><?=$data['title']?></td>
							</tr>
							<tr>
								<th>논문명(영문)<br/>Manuscript Title (Eng)</th>
								<td><?=$data['title_eng']?></td>
							</tr>
							<tr>
								<th>키워드: 국문(영문)<br/>Keywords: KOR(Eng)</th>
								<td><?=$data['keyword']?></td>
							</tr>
						</table>
						<table class="boardType01_write" style="margin-top:20px;">
						<tr>
							<th>심사요청분야<br/>Review Category<br /></th>
							<td><? if($data['review_category_target']){ ?><?=get_category_target($data['review_category_target'])?><? } ?> / <? if($data['review_category']){ ?><?=get_category($data['review_category'])?><? } ?></td>
						</tr>
						<tr>
							<th><strong>투고논문파일<br/>Manuscript File</strong></th>
							<td>
								<? if($data['submission_data']){ ?> 
								<?=end(explode("/",substr(strstr($data['submission_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['submission_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<tr>
							<th>수정논문파일<br/>Modified Manuscript File</th>
							<td>
								<? if($data['modify_file']){ ?> 
								<?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?> <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<? if($data['response_data']){ ?>
						<tr>
							<th>논문수정표<br/>Author's Edit Table</th>
							<td>
								<? if($data['response_data']){ ?> 
								<?=end(explode("/",substr(strstr($data['response_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['response_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<? } ?>
						<? if($data['response_data_b']){ ?>
						<tr>
							<th>저자답변서(심사위원 B)<br/>Author's Response</th>
							<td>
								<? if($data['response_data_b']){ ?> 
								<?=end(explode("/",substr(strstr($data['response_data_b'], '^'), 1)))?> <a href="/down.php?link=<?=$data['response_data_b']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<? } ?>
						<? if($data['response_data_c']){ ?>
						<tr>
							<th>저자답변서(심사위원 C)<br/>Author's Response</th>
							<td>
								<? if($data['response_data_c']){ ?> 
								<?=end(explode("/",substr(strstr($data['response_data_c'], '^'), 1)))?> <a href="/down.php?link=<?=$data['response_data_c']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<? } ?>
						<!--tr>
							<th>파일추가<br/>Upload Files</th>
							<td>
								<? if($data['submission_add_data']){ ?> 
								<?=end(explode("/",substr(strstr($data['submission_add_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['submission_add_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr-->
						<tr>
							<th>논문게재 신청서, 저작권위임동의서 및 연구윤리준수서약서<br/>Submission Information /<br> Agreement for Copyright & Research Ethics Guidelines</th>
							<td>
								<? if($data['submission_data2']){ ?> 
								<?=end(explode("/",substr(strstr($data['submission_data2'], '^'), 1)))?> <a href="/down.php?link=<?=$data['submission_data2']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
								<? } ?>
							</td>
						</tr>
						<tr>
							<th>문헌유사도 검사결과<br/></th>
							<td>
								<? if($data['step']>0 && $data['submission_data3']){ ?> 
									<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data3']?>"><?=end(explode("/",substr(strstr($data['submission_data3'], '^'), 1)))?></a></div>
								<? } ?>
							</td>
						</tr>
						<!--tr>
							<th>저자체크리스트<br/>Author's Checklist </th>
							<td>
								<?php
								$chklist_arr = explode('|',$data['chklist']);
								$sql	= "SELECT * FROM `ad_check_list`";
								$chklist = sql_query($sql);
								?>
								<ul style="list-style:none;font-size:1em;padding-left:5px">
								<?php while ($row = sql_fetch_array($chklist)):?>
								<?php 
								if($chk_tmp!=$row['title']) echo "<h2>".$row['title']."</h2><hr>";
								$chk_tmp=$row['title'];
								?>
								<li>
								<input type="checkbox" name="chklist[]" disabled value="<?=$row['id']?>" 
								<?php foreach($chklist_arr as $v) if($row['id']==$v) echo "checked=checked";?>
								>
								<?=$row['content']?>
								</li>
								<?php endwhile?>	
								</ul>
							</td>
							</td>
						</tr-->
						</table>
			<?
				for($i=0 ; $i<count($loop) ; $i++){	
					$temp_arr = explode("|", $loop[$i]['auth_type']);
			?>
					<table width="100%" class="boardType01_write" style="margin-top:20px;">
					<?	
						$auth_type = str_replace("|",", ",$loop[$i]['auth_type'])
					?>
					<!--tr>
						<th width="230"><strong>저자유형<br/>Author Type</strong></th>
						<td colspan="3"><?=$auth_type?></td>
					</tr-->
					<tr>
						<th><strong>저자명<br/>Author Name</strong></th>
						<td><?=$loop[$i]['auth_name']?></td>
						<th width="230"><strong>전화<br/>Tel</strong></th>
						<td><?=$loop[$i]['auth_tel']?></td>
					</tr>
					<tr>
						<th>이메일<br/>E-mail</th>
						<td><?=$loop[$i]['auth_email']?></td>
						<th>핸드폰<br/>Mobile</th>
						<td><?=$loop[$i]['auth_mobile']?></td>
					</tr>
					<tr>
						<th>소속<br/>Organization</th>
						<td colspan="3"><?=$loop[$i]['organization']?></td>
						<!--th>주소<br/>Address</th>
						<td><?=$loop[$i]['address']?></td-->
					</tr>
					</table>
			<?
				}	
			?>
			<?
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_a_user']}' and rstep = 1 order by regdate desc limit 1";
				$review1 = sql_fetch($sql);
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_b_user']}' and rstep = 1 order by regdate desc limit 1";
				$review2 = sql_fetch($sql);
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_c_user']}' and rstep = 1 order by regdate desc limit 1";
				$review3 = sql_fetch($sql);
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
			<tr>
				<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" id="review_result"/>Review Info 1</td>
			</tr>
			</table>
			<table width="100%" class="boardType01_write" style="margin-top:10px;">
			<? if($data['review_a_conf']=="Y"){ ?>
			<tr>
				<th width="220" rowspan="2">
					<strong>심사위원 A</strong>
				</th>
				<th width="140"><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review1['rseq']?>' class='inline'>
				<? if($review1['result']){ ?><?=get_result($review1['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><pre><?=$review1['comments']?></pre></td>
			</tr>
			<? } ?> 
			<? if($data['review_b_conf']=="Y"){ ?>
			<tr>
				<th rowspan="2">
					<strong>심사위원 B</strong>
				</th>
				<th><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review2['rseq']?>' class='inline'>
				<? if($review2['result']){ ?><?=get_result($review2['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><?=$review2['comments']?></td>
			</tr>
			<? } ?> 
			<? if($data['review_c_conf']=="Y"){ ?>
			<tr>
				<th rowspan="2">
					<strong>심사위원 C</strong>
				</th>
				<th><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review3['rseq']?>' class='inline'>
				<? if($review3['result']){ ?><?=get_result($review3['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><pre><?=$review3['comments']?></pre></td>
			</tr>
			<? } ?> 
			</table>
			<table width="100%" class="boardType01_write" style="margin-top:10px;">
			<tr>
				<th><strong>합계<br/></strong></th>
				<td><pre><?=$review1['score_sum']+$review2['score_sum']+$review3['score_sum']?></pre></td>
				<th><strong>평균<br/></strong></th>
				<td><pre><?=round(($review1['score_sum']+$review2['score_sum']+$review3['score_sum'])/39,2)?></pre></td>
			</tr>
			</table>
			<?php $review_arr = array($review1,$review2,$review3);?>
			<?php foreach($review_arr as $k):?>
			<div style='display:none'>
				<div id='score_box<?=$k['rseq']?>' style='padding:10px; background:#fff;'>
					<?php
					$sq	= "SELECT * FROM `ad_check_review` ORDER BY id ";
					$chklist = sql_query($sq);
					?>
					<ul style="list-style:none;font-size:1em;padding-left:5px;font-size:12px;line-height:12px">
					<?php 
						$score_arr = explode('|',$k['score']);
						$j=0;
					?>
					<?php while($ro = sql_fetch_array($chklist)):?>
						<?php if($chk_tmp!=$ro['title']):?>
						<h3><?=$ro['title']?></h3>
						<?php endif?>
						<?php $chk_tmp=$ro['title'];?>
						<li>
						<div style="padding:5px;background-color:#EEE"><?=$ro['content']?></div>
						<div style="text-align:right;line-height:10px;padding:5px 0;"> 5점
						<input type="radio" <?=($score_arr[$j]==5)?'checked="checked"':''?> disabled> 4점
						<input type="radio" <?=($score_arr[$j]==4)?'checked="checked"':''?> disabled> 3점
						<input type="radio" <?=($score_arr[$j]==3)?'checked="checked"':''?> disabled> 2점
						<input type="radio" <?=($score_arr[$j]==2)?'checked="checked"':''?> disabled> 1점
						<input type="radio" <?=($score_arr[$j]==1)?'checked="checked"':''?> disabled>
						</div>
						</li>
						<?php $j++?>
					<?php endwhile?>	
					</ul>
					<h3>합계 : <?=$k['score_sum']?><br>평균 : <?=round($k['score_sum']/13,2)?>
					<br><?=get_result($k['result'])?></h3>
					<h3></h3>
				</div>
			</div>
			<?php endforeach?>
			<?
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_a_user']}' and rstep = 2 order by regdate desc limit 1";
				$review1 = sql_fetch($sql);
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_b_user']}' and rstep = 2 order by regdate desc limit 1";
				$review2 = sql_fetch($sql);
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and mb_id = '{$data['review_c_user']}' and rstep = 2 order by regdate desc limit 1";
				$review3 = sql_fetch($sql);
			?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
			<tr>
				<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info 2</td>
			</tr>
			</table>
			<table width="100%" class="boardType01_write" style="margin-top:10px;">
			<? if($data['review_a_conf']=="Y"){ ?>
			<tr>
				<th width="70" rowspan="2">
					<strong>심사위원 A</strong>
				</th>
				<th width="140"><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review3['rseq']?>' class='inline'>
				<? if($review1['result']){ ?><?=get_result($review1['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><pre><?=$review1['comments']?></pre></td>
			</tr>
			<? } ?> 
			<? if($data['review_b_conf']=="Y"){ ?>
			<tr>
				<th rowspan="2">
					<strong>심사위원 B</strong>
				</th>
				<th><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review3['rseq']?>' class='inline'>
				<? if($review2['result']){ ?><?=get_result($review2['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><pre><?=$review2['comments']?></pre></td>
			</tr>
			<? } ?> 
			<? if($data['review_c_conf']=="Y"){ ?>
			<tr>
				<th rowspan="2">
					<strong>심사위원 C</strong>
				</th>
				<th><strong>심사결과<br/>Result</strong></th>
				<td style="font-weight:600;text-decoration:underline">
				<a href='#score_box<?=$review3['rseq']?>' class='inline'>
				<? if($review3['result']){ ?><?=get_result($review3['result'])?><? } ?>
				</a>
				</td>
			</tr>
			<tr>
				<th><strong>코멘트<br/>Comments</strong></th>
				<td><pre><?=$review3['comments']?></pre></td>
			</tr>
			<? } ?> 
			</table>
				<?php $review_arr = array($review1,$review2,$review3);?>
			<?php foreach($review_arr as $k):?>
			<div style='display:none'>
				<div id='score_box<?=$k['rseq']?>' style='padding:10px; background:#fff;'>
					<?php
					$sq	= "SELECT * FROM `ad_check_review` ORDER BY id ";
					$chklist = sql_query($sq);
					?>
					<ul style="list-style:none;font-size:1em;padding-left:5px;font-size:12px;line-height:12px">
					<?php 
						$score_arr = explode('|',$k['score']);
						$j=0;
					?>
					<?php while($ro = sql_fetch_array($chklist)):?>
						<?php if($chk_tmp!=$ro['title']):?>
						<h3><?=$ro['title']?></h3>
						<?php endif?>
						<?php $chk_tmp=$ro['title'];?>
						<li>
						<div style="padding:5px;background-color:#EEE"><?=$ro['content']?></div>
						<div style="text-align:right;line-height:10px;padding:5px 0;"> 5점
						<input type="radio" <?=($score_arr[$j]==5)?'checked="checked"':''?> disabled> 4점
						<input type="radio" <?=($score_arr[$j]==4)?'checked="checked"':''?> disabled> 3점
						<input type="radio" <?=($score_arr[$j]==3)?'checked="checked"':''?> disabled> 2점
						<input type="radio" <?=($score_arr[$j]==2)?'checked="checked"':''?> disabled> 1점
						<input type="radio" <?=($score_arr[$j]==1)?'checked="checked"':''?> disabled>
						</div>
						</li>
						<?php $j++?>
					<?php endwhile?>	
					</ul>
					<h3>합계 : <?=$k['score_sum']?><br>평균 : <?=round($k['score_sum']/13,2)?>
					<br><?=get_result($k['result'])?></h3>
					<h3></h3>
				</div>
			</div>
			<?php endforeach?>
			<?
				$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 4 order by rseq";
				$review1 = sql_query($sql);
				while ($row = sql_fetch_array($review1)){
					$freview[] = $row;
				}
			?>
			<? if($freview){ ?> 
				<? for($i=0;$i<count($freview);$i++){ ?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
						<tr>
							<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Final Review Sanction Info <?=$i+1?></td>
						</tr>
						</table>
						<table width="100%" class="boardType01_write" style="margin-top:10px;">
						<tr>
							<th width="70" rowspan="2">
								<strong>편집위원장</strong>
							</th>
							<th width="140"><strong>심사결과<br/>Result</strong></th>
							<td><? if($freview[$i]['result']){ ?><?=get_result_final($freview[$i]['result'])?><? } ?></td>
						</tr>
						<tr>
							<th><strong>코멘트<br/>Comments</strong></th>
							<td><pre><?=$freview[$i]['comments']?></pre></td>
						</tr>
					</table>
				<? } ?>
			<? } ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
			<tr>
				<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Final Result Registration Info</td>
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
						<th width="230"><strong>최종심사 완료일<br/>Accepted Date</strong></th>
						<td><?=$review[$i]['regdate']?></td>
					</tr>
					<tr>
						<th><strong>심사결과<br/>Result</strong></th>
						<td><?=get_result2($review[$i]['result'])?></td>
					</tr>
					<tr>
						<th>코멘트<br/>Comments</th>
						<td><pre><?=$review[$i]['comments']?></pre></td>
					</tr>
					</table>
				<? } ?>
			<? } ?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
				<tr>
					<td align="center">
						<a href="a_sub02.php"><img src="../images/btn_list.png" /></a></td>
				</tr>
				</table>
					</td>
				</tr>
				</table>
				</td>
			</tr>
		</table>
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
<script>
$(".inline").colorbox({inline:true, width:"70%"});
</script>