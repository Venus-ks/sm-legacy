<?php if($data['step']==4 || $data['step']==14 || $data['step']==24):?>
	<br>
	<table class="boardType01_write">
		<?php foreach(array('a','b','c') as $v):?>
			<?php
				$sql_memeber = "select mb_name, mb_1 from `g4_member` where mb_id = '{$data['review_'.$v.'_user']}'";
				$res_memeber = sql_query($sql_memeber);
				$row_member = mysqlI_fetch_array($res_memeber);
			?>
			<tr>
				<th width="100">심사위원 <?=strtoupper($v)?></th>
				<td><?=($reviewer_hidden==TRUE)?'미공개':$row_member['mb_1'].' '.$row_member['mb_name'].' ('.$data['review_'.$v.'_user'].')'?></td>
			</tr>
		<?php endforeach ?>
	</table>
<?php endif?>
<?php
	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 1 order by type";
	$res	= sql_query($sql);
?>
<?php if(mysqli_num_rows($res)>0):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info 1</td>
		</tr>
	</table>

	<?php while($row = mysqlI_fetch_array($res)):?>
		<input type="hidden" name="review_file_<?=strtolower($row['type'])?>_seq" value="<?=$row['rseq']?>">
		<table class="boardType01_write" style="margin-top:10px;">
			<tr>
				<th width="100" rowspan="3">심사위원 <?=$row['type']?><br>(<?=($reviewer_hidden==TRUE)?'미공개':$row['mb_name']?>)</th>
				<th width="150">1차 심사결과<br/>Results</th>
				<td>
					<?php if($row['result']&&($data['step']>5 || $reviewer_hidden!=TRUE)):?>
						<select name="result" id="result" style="width:100%;" disabled>
							<?php $arr = get_result();?>
							<?php for($i=0;$i<count($arr);$i++):?>
								<option value="<?=$arr[$i]['cvalue']?>" <?=($row['result']==$arr[$i]['cvalue'])?'selected':''?>><?=$arr[$i]['ctext']?></option>
							<?php endfor?>
						</select>
					<?php else:?>
						미정
					<?php endif?>
				</td>
			</tr>
			<tr>
				<th>논문심사표<br/>Attached Review File</th>
				<td>
				<?php if($row['rfile'] && ($data['step']>5 || $reviewer_hidden!=TRUE)):?>
					<?php if($reviewer_hidden!=TRUE):?>
						<input type="file" name="review_file_<?=strtolower($row['type'])?>" id="review_file" style="width:100%;" <?=($data['step']==4)?'required':''?>/>
					<?php endif?>
					<div style="padding-top:5px;">
					<?=end(explode("/",substr(strstr($row['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=urlencode($row['rfile'])?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</div>
				<?php else:?>
					-
				<?php endif?>
			</tr>
			<!-- <tr>
				<th>심사결과표</th>
				<td>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#review-<?=$row['rseq']?>-Modal" data-whatever="@mdo">
						보기
					</button>
				</td>
			</tr> -->
			<!-- <tr>
				<th width="150"><strong>심사의견<br/>Comments</strong></th>
				<td colspan="2">
				<?php if($row['comments'] && ($data['step']>5 || $reviewer_hidden!=TRUE)):?>
					<textarea name="comments" id="comments" style="width:100%;" rows="5" disabled><?=$row['comments']?></textarea>
				<?php else:?>
					-
				<?php endif?>
			</tr> -->
		</table>

		<div class="modal fade" id="review-<?=$row['rseq']?>-Modal" tabindex="-1" role="dialog" aria-labelledby="review-<?=$row['rseq']?>-ModalLabel" aria-hidden="true">
			
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<?php 
						if($row['score']) {
						$scores = $row['score'];
						$rseq = $row['rseq'];
						include("./widget/question-list-result.php");
						}
					?>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
		</div>
	<?php endwhile?>
<?php endif?>


<?php
	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 2 order by type";
	$res = sql_query($sql);
?>
<?php if($data['step']>14 && mysqli_num_rows($res)):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info 2</td>
		</tr>
	</table>
	<?php while($row = mysqli_fetch_array($res)):?>
		<table class="boardType01_write" style="margin-top:10px;">
		<tr>
				<th width="100" rowspan="3">심사위원 <?=$row['type']?><br>(<?=($reviewer_hidden==TRUE)?'미공개':$row['mb_name']?>)</th>
				<th width="150">2차 심사결과<br/>Results</th>
				<td>
					<?php if($row['result']&&($data['step']>15 || $reviewer_hidden!=TRUE)):?>
						<select name="result" id="result" style="width:100%;" disabled>
							<?php $arr = get_result();?>
							<?php for($i=0;$i<count($arr);$i++):?>
								<option value="<?=$arr[$i]['cvalue']?>" <?=($row['result']==$arr[$i]['cvalue'])?'selected':''?>><?=$arr[$i]['ctext']?></option>
							<?php endfor?>
						</select>
					<?php else:?>
						미정
					<?php endif?>
				</td>
			</tr>
			<tr>
				<th>논문심사표<br/>Attached Review File</th>
				<td>
				<?php if($row['rfile'] && ($data['step']>15 || $reviewer_hidden!=TRUE)):?>
					<?php if($reviewer_hidden!=TRUE):?>
						<input type="file" name="review_file_<?=strtolower($row['type'])?>" id="review_file" style="width:100%;" <?=($data['step']==4)?'required':''?>/>
					<?php endif?>
					<div style="padding-top:5px;">
					<?=end(explode("/",substr(strstr($row['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=urlencode($row['rfile'])?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</div>
				<?php else:?>
					-
				<?php endif?>
			</tr>
			<!-- <tr>
				<th>심사결과표</th>
				<td>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#review-<?=$row['rseq']?>-Modal" data-whatever="@mdo">
						보기
					</button>
				</td>
			</tr> -->
					
			<!-- <tr>
				<th width="150"><strong>심사의견<br/>Comments</strong></th>
				<td>
				<?php if($row['comments'] && ($data['step']>15 || $reviewer_hidden!=TRUE)):?>
					<textarea name="comments" id="comments" style="width:100%;" rows="5"><?=$row['comments']?></textarea>
				<?php else:?>
					-
				<?php endif?>
			</tr> -->
		</table>
		<div class="modal fade" id="review-<?=$row['rseq']?>-Modal" tabindex="-1" role="dialog" aria-labelledby="review-<?=$row['rseq']?>-ModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<?php 
						if($row['score']) {
						$scores = $row['score'];
						$rseq = $row['rseq'];
						include("./widget/question-list-result.php");
						}
					?>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>
			</div>
		</div>		

	<?php endwhile?>
<?php endif?>
<?php
	$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 3 order by type";
	$res = sql_query($sql);
?>
<?php if($data['step']>24 && mysqli_num_rows($res)):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info 3</td>
		</tr>
	</table>
	<?php while($row = mysqli_fetch_array($res)):?>
		<table class="boardType01_write" style="margin-top:10px;">
		<tr>
				<th width="100" rowspan="3">심사위원 <?=$row['type']?><br>(<?=($reviewer_hidden==TRUE)?'미공개':$row['mb_name']?>)</th>
				<th width="150">3차 심사결과<br/>Results</th>
				<td>
					<?php if($row['result']&&($data['step']>25 || $reviewer_hidden!=TRUE)):?>
						<select name="result" id="result" style="width:100%;" disabled>
							<?php $arr = get_result();?>
							<?php for($i=0;$i<count($arr);$i++):?>
								<option value="<?=$arr[$i]['cvalue']?>" <?=($row['result']==$arr[$i]['cvalue'])?'selected':''?>><?=$arr[$i]['ctext']?></option>
							<?php endfor?>
						</select>
					<?php else:?>
						미정
					<?php endif?>
				</td>
			</tr>
			<tr>
				<th>논문심사표<br/>Attached Review File</th>
				<td>
				<?php if($row['rfile'] && ($data['step']>25 || $reviewer_hidden!=TRUE)):?>
					<?php if($reviewer_hidden!=TRUE):?>
						<input type="file" name="review_file_<?=strtolower($row['type'])?>" id="review_file" style="width:100%;" <?=($data['step']==4)?'required':''?>/>
					<?php endif?>
					<div style="padding-top:5px;">
					<?=end(explode("/",substr(strstr($row['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=urlencode($row['rfile'])?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</div>
				<?php else:?>
					-
				<?php endif?>
			</tr>
			<tr>
				<th>심사결과표</th>
				<td>
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#review-<?=$row['rseq']?>-Modal" data-whatever="@mdo">
						보기
					</button>
				</td>
			</tr>
		</table>
		<div class="modal fade" id="review-<?=$row['rseq']?>-Modal" tabindex="-1" role="dialog" aria-labelledby="review-<?=$row['rseq']?>-ModalLabel" aria-hidden="true">
			
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<?php 
						if($row['score']) {
						$scores = $row['score'];
						$rseq = $row['rseq'];
						include("./widget/question-list-result.php");
						}
					?>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
		</div>
	<?php endwhile?>
<?php endif?>
<?php if($data['review_score']):?>
	<table class="boardType01_write" style="margin-top:10px;">
		<tr>
			<th width="150">종합심사결과<br/>Result</th>
			<td>
				<select name="result" id="result" style="width:100%;" disabled>
					<?php $arr = get_result();?>
					<?php for($i=0;$i<count($arr);$i++):?>
						<option value="<?=$arr[$i]['cvalue']?>" <?=($data['review_score']==$arr[$i]['cvalue'])?'selected':''?>><?=$arr[$i]['ctext']?></option>
					<?php endfor?>
				</select>
			</td>
		</tr>
	</table>
<?php endif?>
<?php if($data['step']>30):?>
	<?php
		$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 4 order by regdate asc,rseq asc";
		$freview1 = sql_query($sql);
	?>
	<?php if(mysqli_num_rows($freview1)):?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
			<tr>
				<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Final Review Sanction Info</td>
			</tr>
		</table>
		<?php while ($row = sql_fetch_array($freview1)):?>
			<table class="boardType01_write" style="margin-top:20px;">
				<tr>
					<th width="280"><strong>종합심사결과<br/>Result</strong></th>
					<td><? if($row['result']){ ?><?=get_result($row['result'])?><? } ?></td>
				</tr>
				<tr>
					<th width="150"><strong>코멘트<br/>Comments</strong></th>
					<td><?=$row['comments']?></td>
				</tr>
			</table>
		<?php endwhile?>
	<?php endif?>
<?php endif?>
