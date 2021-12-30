<? if($data['step']>=99 && $data['reject_comment']):?>
	<table class="boardType01_write" style="margin-top:10px;">
		<tr>
			<th width="200" style="color:red">접수 보류 코멘트<br/>Reject Comments</th>
			<td><?=nl2br($data['reject_comment'])?></td>
		</tr>
	</table>
<?php endif?>
<input type="hidden" name="title" value="<?=$data['title']?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
	<tr>
		<td>
			<table width="100%" class="boardType01_write" style="margin:10px 0">
				<tr>
					<th width="200"><strong>저널명<br/>journal Title</strong></th>
					<td colspan="3"><?=$data['journal']?></td>
				</tr>
				<tr>
					<th>논문번호<br/>Paper Number</th>
					<?php $article_code = $info['abbr']."-".date("y").'-'.($number = str_pad($data['number'],2,'0',STR_PAD_LEFT));?>
					<td colspan="3"><?=$article_code?></td>
				</tr>
				<tr>
					<th>논문명(국문)<br/>Paper Title (Kor)</th>
					<td colspan="3"><?=$data['title']?></td>
					<input type="hidden" name="title" value="<?=$data['title']?>">
				</tr>
				<tr>
					<th>논문명(영문)<br/>Paper Title (Eng)</th>
					<td colspan="3"><?=$data['title_eng']?></td>
				</tr>
				<tr>
					<th>키워드: 국문(영문)<br/>Keywords: KOR (Eng)<br /></th>
					<td colspan="3"><?=$data['keyword']?></td>
					<input type="hidden" name="keyword" value="<?=$data['keyword']?>">
				</tr>
			</table>
			<?php if($hidden_author!=TRUE && $loop):?>
				<?php foreach($loop as $v):?>
					<table width="100%" class="boardType01_write" style="margin:10px 0">
						<tr>
							<th width="150">저자명<br/>Author's Name</th>
							<td><?=$v['auth_name']?></td>
							<th width="150">소속<br/>Organization</th>
							<td><?=$v['organization']?></td>
						</tr>
						<tr>
							<th>저자유형<br/>Author Type</th>
							<td><?=str_ireplace('|',', ',$v['auth_type'])?></td>
							<th>전화<br/>Telephone</th>
							<td><?=$v['auth_tel']?></td>
						</tr>
						<tr>
							<th>이메일<br/>E-mail<br /></th>
							<td><?=$v['auth_email']?></td>
							<th>핸드폰<br/>Cell phone</th>
							<td><?=$v['auth_mobile']?></td>
						</tr>
					</table>
				<?php endforeach?>
			<?php endif?>
			<table class="boardType01_write" style="margin-top:20px;">
				<!-- <tr>
					<th width="200">연구종류<br/>Type of Paper</th>
					<td><? if($data['manuscript']){ ?><?=get_manuscript($data['manuscript'])?><? } ?></td>
				</tr> -->
				<tr>
					<th width="150"><strong>심사요청분야<br/>Review Category</strong></th>
					<td><? if($data['review_category_target']){ ?><?=get_category_target($data['review_category_target'])?><? } ?><? if($data['review_category']){ ?> / <?=get_category($data['review_category'])?><? } ?></td>
				</tr>
				<tr>
					<th width="150"><strong><?=($data['modify_file'])?'수정':''?>논문파일<br/><?=($data['modify_file'])?'Modified ':''?>Paper File</strong></th>
					<td>
						<? if($data['modify_file']){ ?>
						<?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?>
						<a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
						<? } ?>
					</td>
				</tr>
				<?php if($data['step']>10 && $data['response_data']):?>
					<tr>
						<th><?=$info['file']['revision_form']['label']?></th>
						<td>
							<?=end(explode("/",substr(strstr($data['response_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['response_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
						</td>
					</tr>
				<?php endif?>
				<?php if($hidden_author!=TRUE):?>
				<tr>
					<th width="200"><?=$info['file']['info_form']['label']?></th>
					<td>
						<?=end(explode("/",substr(strstr($data['submission_data2'], '^'), 1)))?>
						<a href="/down.php?link=<?=$data['submission_data2']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</td>
				</tr>
				<tr>
					<th width="200"><?=$info['file']['copyright_agreement']['label']?></th>
					<td>
						<?=end(explode("/",substr(strstr($data['submission_data3'], '^'), 1)))?>
						<a href="/down.php?link=<?=$data['submission_data3']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</td>
				</tr>
				<tr>
					<th width="200"><?=$info['file']['ethic_form']['label']?></th>
					<td>
						<?=end(explode("/",substr(strstr($data['submission_data4'], '^'), 1)))?>
						<a href="/down.php?link=<?=$data['submission_data4']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
					</td>
				</tr>
				<tr>
					<th width="200">문헌유사도 검사결과<br/></th>
					<td>
						<?=end(explode("/",substr(strstr($data['submission_data5'], '^'), 1)))?>
						<a href="/down.php?link=<?=$data['submission_data5']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a></div>
					</td>
				</tr>
				<tr>
					<th width="200">투고료 납입 여부</th>
					<td><input type="checkbox" name="fee" value="Y" <?=($data['review_fee']=='Y')?'checked=checked':''?>>예&nbsp;<input type="checkbox" name="fee" value="N" <?=($data['review_fee']=='N')?'checked=checked':''?> />아니오</td>
				</tr>
				<?php endif?>
			</table>
