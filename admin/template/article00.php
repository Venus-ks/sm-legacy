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
			<th width="200">논문명(국문)<br/>Paper Title (Kor)</th>
			<td><input type="text" name="title" value="<?=$data['title']?>" itemname="Title" required style="width:100%;" /></td>
		</tr>
		<tr>
			<th width="200">논문명(영문)<br/>Paper Title (Eng)</th>
			<td><input type="text" name="title_eng" value="<?=$data['title_eng']?>" itemname="Title(ENG)" required style="width:100%;" /></td>
		</tr>
		<tr>
			<th width="200">초록(국문)<br/>Abstract(KOR)</th>
			<td><textarea cols="10" name="abstract" itemname="abstract" style="width:100%;height:100px"><?=$data['abstract']?></textarea><BR/></td>
		</tr>
		<tr>
			<th width="200">초록(영문)<br/>Abstract(ENG)</th>
			<td><textarea cols="10" name="abstract_eng" itemname="abstract_eng" style="width:100%;height:100px"><?=$data['abstract_eng']?></textarea><BR/></td>
		</tr>
		<tr>
			<th width="200">키워드(국문)<br/>Keywords(KOR)</th>
			<td><input type="text" name="keyword" value="<?=$data['keyword']?>" itemname="keyword" style="width:100%;" /><BR/>※ 키워드 5개까지 입력가능합니다. 콤마(,)로 구분합니다.</td>
		</tr>
		<tr>
			<th width="200">키워드(영문)<br/>Keywords(ENG)</th>
			<td><input type="text" name="keyword_eng" value="<?=$data['keyword_eng']?>" itemname="keyword_eng" style="width:100%;" /><BR/>※ 키워드 5개까지 입력가능합니다. 콤마(,)로 구분합니다.</td>
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
			<th width="200">투고논문 파일<br/>Paper File</th>
			<td>
				<input type="file" name="submission_data" style="width:100%;" <?=($data['seq'])?'':'required'?>/>
				<? if($data['submission_data']){ ?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data']?>"><?=end(explode("/",substr(strstr($data['submission_data'], '^'), 1)))?></a></div>
				<? } ?>
				<!--a href="<?=$info['paper_sample_url']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				<?php if(!$data['seq']):?>
					<br/>한글프로그램을 이용하여 작성하되, 원고교정이 완료되어 그대로 출판될 수 있는 완전한 상태로 제출바랍니다.
				<? endif?>
			-->
			</td>
		</tr>
		<? if($data['step']>1){ ?>
		<tr>
			<th width="200">논문수정표<br/>Author's Edit Table</th>
			<td>
				<input type="file" name="response_data" style="width:100%;" <?=($data['response_data'])?'':'required'?>/>
				<? if($data['step']>0 && $data['response_data']){ ?>
				<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['response_data']?>"><?=end(explode("/",substr(strstr($data['response_data'], '^'), 1)))?></a></div>
				<? } ?>
				<br/>
				<a href="<?=$info['revision_form_url']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th width="200">투고논문신청서<br/>Submission Information</th>
			<td>
				<input type="file" name="submission_data2" style="width:100%;" <?=($data['submission_data2'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data2']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data2']?>"><?=end(explode("/",substr(strstr($data['submission_data2'], '^'), 1)))?></a></div>
				<? } ?>
				<!--div style="padding-top:5px;"><a href="<?=$info['info_form_url']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식에 날인하여, 업로드(pdf 가능)해주시기 바랍니다.</span-->
			</td>
		</tr>
		<tr>
			<th width="200">자가점검사항표<br/>Checklist</th>
			<td>
				<input type="file" name="submission_data3" style="width:100%;" <?=($data['submission_data3'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data3']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data3']?>"><?=end(explode("/",substr(strstr($data['submission_data3'], '^'), 1)))?></a></div>
				<? } ?>
				<!--div style="padding-top:5px;"><a href="<?=$info['author_checklist_url']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식을 작성하여, 업로드(pdf 가능)해주시기 바랍니다.</span-->
			</td>
		</tr>
		<tr>
			<th width="200">연구윤리동의서<br/>Research Ethics Form</th>
			<td>
				<input type="file" name="submission_data4" style="width:100%;" <?=($data['submission_data4'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data4']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data4']?>"><?=end(explode("/",substr(strstr($data['submission_data4'], '^'), 1)))?></a></div>
				<? } ?>
				<div style="padding-top:5px;"><a href="<?=$info['ethic_form_url']?>"><strong style="color:#B60000">양식 다운로드</strong></a>
				</div>
				<span>다운로드 받은 양식에 날인하여, 업로드(pdf 가능)해주시기 바랍니다.</span>
			</td>
		</tr>
		<tr>
			<th width="200">문헌유사도 검사결과<br/></th>
			<td>
				<input type="file" name="submission_data5" style="width:100%;" <?=($data['submission_data5'])?'':'required'?>/>
				<? if($data['step']>0 && $data['submission_data5']){ ?>
					<div style="padding-top:5px;"><a href="/down.php?link=<?=$data['submission_data5']?>"><?=end(explode("/",substr(strstr($data['submission_data5'], '^'), 1)))?></a></div>
				<? } ?>
				<div style="padding-top:5px;"><a href="https://www.kci.go.kr/kciportal/po/member/loginForm.kci?returnUrl=check/login.jsp" target="_blank"><strong style="color:#B60000">유사도 검사 GO!</strong></a></div>
				<span>투고 논문으로 ‘KCI 문헌유사도 검사’를 시행하신 뒤, 검사 후 산출된 ‘종합결과파일(PDF)’을 업로드해주시기 바랍니다.</span>
			</td>
		</tr>
		</table>
		<table class="boardType01_write">
			<tr>
				<th width="200">심사료 납입 여부<br/>
				<font style="color: #DE790D;">
					<br>
					<?=$info['bank_comment']?>
				</font>
				</th>
				<td><input type="checkbox" name="fee" value="Y" <?=($data['review_fee']=='Y')?'checked=checked':''?>>예&nbsp;<input type="checkbox" name="fee" value="N" <?=($data['review_fee']=='N')?'checked=checked':''?> />아니오</td>
			</tr>
			</table>
		</td>
	</tr>
</table>
