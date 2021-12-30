<? if($data['step']>=99 && $data['reject_comment']):?>
	<table class="boardType01_write" style="margin-top:10px;">
		<tr>
			<th width="200" style="color:red">접수 보류 코멘트<br/>Reject Comments</th>
			<td><?=nl2br($data['reject_comment'])?></td>
		</tr>
	</table>
<?php endif?>
<input type="hidden" name="title" value="<?=$data['title']?>">
<input type="hidden" name="mb_id" value="<?=$data['mb_id']?>">
<input type="hidden" name="mb_name" value="<?=$data['mb_name']?>">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
	<tr>
	<td>
		<table class="boardType01_write">
		<tr>
			<th width="200"><strong>저널명<br/>journal Title</strong></th>
			<td>
				<input type="text" name="journal" value="<?=$info['journal_title']?>"  style="width:100%;"  readonly>
			</td>
		</tr>
		<tr>
			<th width="200">논문명(국문)<span class="required">*</span><br/>Paper Title (Kor)</th>
			<td>
				<input type="text" name="title" value="<?=$data['title']?>" itemname="Title" required style="width:100%;" />
			</td>
		</tr>
		<tr>
			<th width="200">논문명(영문)<span class="required">*</span><br/>Paper Title (Eng)</th>
			<td><input type="text" name="title_eng" value="<?=$data['title_eng']?>" itemname="Title(ENG)" required style="width:100%;" /></td>
		</tr>
		<tr>
			<th width="200">초록(국문)<span class="required">*</span><br/>Abstract(KOR)</th>
			<td><textarea cols="10" name="abstract" itemname="abstract" style="width:100%;height:100px" required><?=$data['abstract']?></textarea><BR/></td>
		</tr>
		<tr>
			<th width="200">초록(영문)<span class="required">*</span><br/>Abstract(ENG)</th>
			<td><textarea cols="10" name="abstract_eng" itemname="abstract_eng" style="width:100%;height:100px" required><?=$data['abstract_eng']?></textarea><BR/></td>
		</tr>
		<tr>
			<th width="200">키워드(국문)<span class="required">*</span><br/>Keywords(KOR)</th>
			<td><input type="text" name="keyword" value="<?=$data['keyword']?>" itemname="keyword" style="width:100%;" required/><BR/>※ 키워드 5개까지 입력가능합니다. 콤마(,)로 구분합니다.</td>
		</tr>
		<tr>
			<th width="200">키워드(영문)<span class="required">*</span><br/>Keywords(ENG)</th>
			<td><input type="text" name="keyword_eng" value="<?=$data['keyword_eng']?>" itemname="keyword_eng" style="width:100%;" required/><BR/>※ 키워드 5개까지 입력가능합니다. 콤마(,)로 구분합니다.</td>
		</tr>
		</table>
		<table class="boardType01_write" style="margin-top:20px;">
		<tr>
			<th width="200"><strong>연구종류<br/>Type of Paper</strong></th>
			<td>
				<select name="manuscript" style="width:100%;">
					<option value="">= 선택해주세요 =</option>
					<?php $arr = get_manuscript()?>
					<?php foreach($arr as $v):?>
						<option value="<?=$v['cvalue']?>" <?=($data['manuscript']==$v['cvalue'])?'selected':''?>><?=$v['ctext']?></option>
					<?php endforeach?>
				</select>
			</td>
		</tr>
		<tr>
			<th width="200"><strong>심사요청분야<br/>Review Category</strong></th>
			<td>
				<select name="review_category_target" style="width:100%;">
					<option value="">= 선택해주세요 =</option>
						<?php $arr = get_category_target()?>
						<?php foreach($arr as $v):?>
							<option value="<?=$v['cvalue']?>" <?=($data['review_category_target']==$v['cvalue'])?'selected':''?>><?=$v['ctext']?></option>
						<?php endforeach?>
				</select>
			</td>
		</tr>
		<tr>
			<th width="200">투고논문 파일<span class="required"><?=($data['step']==1 || $data['step']==11 || $data['step']==21)?'':'*'?></span><br/>Paper File</th>
			<td>
				<input type="file" name="submission_data" style="width:100%;" <?=($data['step']==1 || $data['step']==11 || $data['step']==21)?'':'required'?>/>
				<? if($data['submission_data']){ ?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data']?>"><?=end(explode("/",substr(strstr($data['submission_data'], '^'), 1)))?></a></div>
				<? } ?>
				<?php if($info['file']['info_form']['link']):?>
				<a href="<?=$info['file']['paper_sample']['link']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				<?php if(!$data['seq']):?>
					<br/>프로그램을 이용하여 작성하되, 원고교정이 완료되어 그대로 출판될 수 있는 완전한 상태로 제출바랍니다.
				<? endif?>
				<?php endif?>
			</td>
		</tr>
		<?php if($data['step']>1 && $data['step']<100):?>
		<tr>
			<th width="200"><?=$info['file']['revision_form']['label']?></th>
			<td>
				<input type="file" name="response_data" style="width:100%;" <?=($data['response_data'])?'':'required'?>/>
				<? if($data['step']>0 && $data['response_data']){ ?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['response_data']?>"><?=end(explode("/",substr(strstr($data['response_data'], '^'), 1)))?></a></div>
				<? } ?>
				<br/>
				<a href="/down.php?link=<?=$info['file']['revision_form']['link']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
			</td>
		</tr>
		<?php endif ?>
		<tr>
			<th width="200"><?=$info['file']['info_form']['label']?><span class="required">*</span></th>
			<td>
				<input type="file" name="submission_data2" style="width:100%;" <?=($data['submission_data2'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data2']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data2']?>"><?=end(explode("/",substr(strstr($data['submission_data2'], '^'), 1)))?></a></div>
				<? } ?>
				<?php if($info['file']['info_form']['link']):?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$info['file']['info_form']['link']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식에 날인하여, 업로드(pdf 가능)해주시기 바랍니다.</span>
				<?php endif?>
			</td>
		</tr>
		<tr>
			<th width="200"><?=$info['file']['copyright_agreement']['label']?><span class="required">*</span></th>
			<td>
				<input type="file" name="submission_data3" style="width:100%;" <?=($data['submission_data3'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data3']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data3']?>"><?=end(explode("/",substr(strstr($data['submission_data3'], '^'), 1)))?></a></div>
				<? } ?>
				<?php if($info['file']['copyright_agreement']['link']):?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$info['file']['copyright_agreement']['link']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식을 작성하여, 업로드(pdf 가능)해주시기 바랍니다.</span>
				<?php endif?>
			</td>
		</tr>
		<tr>
			<th width="200"><?=$info['file']['ethic_form']['label']?><span class="required">*</span></th>
			<td>
				<input type="file" name="submission_data4" style="width:100%;" <?=($data['submission_data4'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data4']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data4']?>"><?=end(explode("/",substr(strstr($data['submission_data4'], '^'), 1)))?></a></div>
				<? } ?>
				<?php if($info['file']['ethic_form']['link']):?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$info['file']['ethic_form']['link']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식에 날인하여, 업로드(pdf 가능)해주시기 바랍니다.</span>
				<?php endif?>
			</td>
		</tr>
		<tr>
			<th width="200">문헌유사도 검사결과<br/></th>
			<td>
				<input type="file" name="submission_data5" style="width:100%;" <?=($data['submission_data5'])?'':''?>/>
				<? if($data['step']>0 && $data['submission_data5']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data5']?>"><?=end(explode("/",substr(strstr($data['submission_data5'], '^'), 1)))?></a></div>
				<? } ?>
				<div style="padding-top:5px;"><a href="https://www.kci.go.kr/kciportal/po/member/loginForm.kci?returnUrl=check/login.jsp" target="_blank"><strong style="color:#B60000">논문유사도검사 바로가기</strong></a></div>
				<span>투고 논문으로 ‘KCI 문헌유사도 검사’를 시행하신 뒤, 검사 후 산출된 ‘종합결과파일(PDF)’을 업로드해주시기 바랍니다.</span>
			</td>
		</tr>
		<!-- <tr>
			<th width="200">CCL (Creative Commons License) 사용<br/><br/><span><a href="http://ccl.cckorea.org/about/" target="_blank"><strong style="color:#B60000">▶ CCL 라이선스에 대하여</strong></a></span></th>

			<td>
				<table class="boardType01_write" style="margin:5px 0">
					<tr>
						<td>
						<h5>CCL 저작자 표시</h5>
						<label><input type="radio" name="ccl_author" value="by"/> 사용</label>&nbsp;&nbsp;
						<label><input type="radio" name="ccl_author" value="" checked="checked" /> 사용안함</label>
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" name="ccl_commercial" value="nc" class="ccl_add" disabled/> 비영리 (NC)<br></label>
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="radio" name="ccl_edit" value="sa" class="ccl_add" disabled/> 동일조건변경허락 (SA)<br></label>&nbsp;&nbsp;
							<label><input type="radio" name="ccl_edit" value="nd" class="ccl_add" disabled/> 변경금지 (ND)</label>
						</td>
					</tr>
				</table>
			</td>
			<script>
			$("input[name=ccl_author]").change(function(){
				var radioValue = $(this).val();
				if (radioValue == "by") {
					$(".ccl_add").attr("disabled",false);
				} else {
					$(".ccl_add").attr("disabled",true);
				}
			});
			</script>
		</tr> -->
		</table>
		<table class="boardType01_write">
			<tr>
				<th width="200">심사료 납입 여부<br/>
				
				</th>
				<td>
				<br>
				<input type="checkbox" name="fee" value="Y" <?=($data['review_fee']=='Y')?'checked=checked':''?>>예&nbsp;<input type="checkbox" name="fee" value="N" <?=($data['review_fee']=='N')?'checked=checked':''?> />아니오
				<br>
				<font style="color: #DE790D;">
					<br>
					<?=$info['bank_comment']?>
				</font>
				</td>
				
			</tr>
			</table>
		</td>
	</tr>
</table>
