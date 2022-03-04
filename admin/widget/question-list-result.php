<ul style="list-style:none;font-size:1em;padding-left:5px">
	<?php
		$sq	= "SELECT * FROM `ad_check_review` ORDER BY id ";
		$chklist = sql_query($sq);
		if($scores == $review[$i]['score']){
			$scores = explode('|',$review[$i]['score']);
		}elseif($scores == $row['score']){
			$scores = explode('|',$row['score']);
		}elseif($scores == $v['score']){
			$scores = explode('|',$v['score']);
		}

		$j=0;
	?>
	<?php while ($rrow = sql_fetch_array($chklist)):?>
								
	<li>
		<div style="text-align:left;padding:5px;background-color:#eee"><?=$rrow['content']?></div>
		<div style="text-align:right;line-height:10px;padding:5px 0">
			<label for="q<?=$rrow['id']?>-<?=$rseq?>-sogood">
				<input type="radio" name="q<?=$rrow['id']?>-<?=$rseq?>" id="q<?=$rrow['id']?>-<?=$rseq?>-good" value="5" <?=($scores[$j]==5)? 'checked=checked':''?> >
				아주적절&nbsp;&nbsp;&nbsp;
			</label>
			<label for="q<?=$rrow['id']?>-<?=$rseq?>-good">
				<input type="radio" name="q<?=$rrow['id']?>-<?=$rseq?>" id="q<?=$rrow['id']?>-<?=$rseq?>-good" value="4" <?=($scores[$j]==4)? 'checked=checked':''?> >
				적절&nbsp;&nbsp;&nbsp;
			</label>
			<label for="q<?=$rrow['id']?>-<?=$rseq?>">
				<input type="radio" name="q<?=$rrow['id']?>-<?=$rseq?>" id="q<?=$rrow['id']?>-<?=$rseq?>" value="3" <?=($scores[$j]==3)? 'checked=checked':''?> >
				보통&nbsp;&nbsp;&nbsp;
			</label>
			<label for="q<?=$rrow['id']?>-<?=$rseq?>-bad">
				<input type="radio" name="q<?=$rrow['id']?>-<?=$rseq?>" id="q<?=$rrow['id']?>-<?=$rseq?>-bad" value="2" <?=($scores[$j]==2)? 'checked=checked':''?> >
				부적절&nbsp;&nbsp;&nbsp;
			</label>
			<label for="q<?=$rrow['id']?>-<?=$rseq?>-sobad">
				<input type="radio" name="q<?=$rrow['id']?>-<?=$rseq?>" id="q<?=$rrow['id']?>-<?=$rseq?>-sobad" value="1" <?=($scores[$j]==1)? 'checked=checked':''?> >
				아주 부적절&nbsp;&nbsp;&nbsp;
			</label>
		</div>
	</li>
	<?php $j++?>
	<?php endwhile?>
</ul>





