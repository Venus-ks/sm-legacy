<!-- 미사용 -->
<?php if($data['step']>9):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16">
				<img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info1
			</td>
		</tr>
	</table>
	<table class="boardType01_write"  style="margin-top:10px;">
		<?php
			$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 1 order by regdate desc";
			$ress	= sql_query($sql);
			$cnt = 1;
		?>
		<?php while($row = sql_fetch_array($ress)):?>
			<?php
				if ($cnt == 1) $cntabt = "A";
				else if ($cnt == 2) $cntabt = "B";
				else if ($cnt == 3) $cntabt = "C";
				else if ($cnt == 4) $cntabt = "D";
				else if ($cnt == 5) $cntabt = "E";
			?>
			<tr>
				<th width="100" rowspan="2">심사위원 <?=$cntabt?><br/>Reviewer <?=$cntabt?></th>
				<th width="150">심사결과<br/>Result</th>
				<td><?php if($row['result']) echo get_result($row['result'])?></td>
			</tr>
			<tr>
				<th width="150">코멘트<br/>Comments</th>
				<td><?=$row['comments']?></td>
			</tr>
			<?php $cnt++?>
		<?php endwhile?>
	</table>
	<div style="height:20px;"></div>
<?php endif?>
<?php if($data['step']>19):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16">
				<img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info2
			</td>
		</tr>
	</table>
	<table class="boardType01_write" style="margin-top:10px;">
		<?php
			$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 2 order by regdate desc";
			$ress	= sql_query($sql);
			$cnt = 1;
		?>
		<?php while($row = sql_fetch_array($ress)):?>
			<?php
				if($cnt == 1){$cntstr='A';}
				else if($cnt == 2){$cntstr='B';}
				else if($cnt == 3){$cntstr='C';}
				else if($cnt == 4){$cntstr='D';}
				else if($cnt == 5){$cntstr='E';}
			?>
			<tr>
				<th width="100" rowspan="2">심사위원 <?=$cntstr?></th>
				<th width="150">심사결과<br/>Result</th>
				<td><?php if($row['result']) echo get_result($row['result'])?></td>
			</tr>
			<tr>
				<th width="150">코멘트<br/>Comments</th>
				<td><?=$row['comments']?></td>
			</tr>
			<tr>
				<th width="150">심사의견서 파일<br/>Attached Review File</th>
				<td>
					<?php if($row['mfile']):?> 
						<?=end(explode("/",substr(strstr($row['mfile'], '^'), 1)))?> <a href="/down.php?link=<?=$row['mfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<?php endif?>
				</td>
			</tr>
			<?php $cnt++?>
		<?php endwhile?>
	</table>
	<div style="height:20px;"></div>
<?php endif?>
<?php if($data['step']>29):?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16">
				<img src="../images/icon.png"  align="absmiddle" class="mr5" />Review Info3
			</td>
		</tr>
	</table>
	<table class="boardType01_write"  style="margin-top:10px;">
		<?php
			$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 3 order by regdate desc";
			$ress	= sql_query($sql);
			$cnt = 1;
		?>
		<?php while($row = sql_fetch_array($ress)):?>
			<?php
				if($cnt == 1) $cntstr='A';
				else if($cnt == 2) $cntstr='B';
				else if($cnt == 3) $cntstr='C';
				else if($cnt == 4) $cntstr='D';
				else if($cnt == 5) $cntstr='E';
			?>
			<tr>
				<th width="100" rowspan="3">심사위원 <?=$cntstr?></th>
				<th width="150">심사결과<br/>Result</th>
				<td><?php if($row['result']) echo get_result($row['result'])?></td>
			</tr>
			<tr>
				<th width="150">코멘트<br/>Comments</th>
				<td><?=$row['comments']?></td>
			</tr>
			<tr>
				<th width="150">심사의견서 파일<br/>Attached Review File</th>
				<td>
					<?php if($row['mfile']):?> 
						<?=end(explode("/",substr(strstr($row['mfile'], '^'), 1)))?> <a href="/down.php?link=<?=$row['mfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					<?php endif?>
				</td>
			</tr>
			<?php $cnt++?>
		<?php endwhile?>
	</table>
	<div style="height:20px;"></div>
<?php endif?>
<?php if($data['step']>30):?>
	<?php
		$sql = "select * from ad_paper_review where parent_seq = '{$data['seq']}' and rstep = 4 order by regdate desc";
		$freview1 = sql_query($sql);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">
		<tr>
			<td class="font_16">
				<img src="../images/icon.png"  align="absmiddle" class="mr5"/>Final Review Sanction
			</td>
		</tr>
	</table>
	<?php
		$q = 0;
		$r = 0;
		while ($row = sql_fetch_array($freview1)){
			$list[$q]		= get_list($row, $board, $board_skin_path, 50);
			$list[$q][num]= $total_count - ($page - 1) * $board[bo_page_rows] - $r;
			$q++;
			$r++;
		}
	?>
	<?php if(count($list)):?>
		<?php for($i=0;$i<count($list);$i++):?>
			<table class="boardType01_write" style="margin-top:20px;">
				<tr>
					<th width="280"><strong>심사결과<br/>Result</strong></th>
					<td><? if($list[$i]['result']){ ?><?=get_result_final($list[$i]['result'])?><? } ?></td>
				</tr>
				<tr>
					<th width="150"><strong>코멘트<br/>Comments</strong></th>
					<td><?=$list[$i]['comments']?></td>
				</tr>
				<tr>
					<th><strong>심사의견서 파일<br />Attached Review File</strong></th>
					<td>
						<?php if($list[$i]['rfile']):?> 
							<?=end(explode("/",substr(strstr($list[$i]['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=$list[$i]['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
						<?php endif?>
					</td>
				</tr>
			</table>
		<?php endfor?>
	<?php endif?>
	<table class="boardType01_write" style="margin-top:20px;">
		<tr>
			<th width="280"><strong>편집 코멘트<br/>Comments</strong></th>
			<td><?=$data['edit_comment']?></td>
		</tr>
	</table>
<?php endif?>