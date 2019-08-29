<table class="boardType01_write" style="margin-top:20px;">
	<tbody>
	<tr>
		<th width="200"><strong>저자유형<br />Author Type</strong></th>
		<td colspan="3">
			<label><input type="checkbox" name="auth_type<?=$k?>[]" value="제1저자" <?=(strpos($v['auth_type'],'제1저자')!==false)?'checked=checked':''?>/> 제1저자</label>
			&nbsp;&nbsp;
			<label><input type="checkbox" name="auth_type<?=$k?>[]" value="교신저자" <?=(strpos($v['auth_type'],'교신저자')!==false)?'checked=checked':''?>/> 교신저자</label>
			&nbsp;&nbsp;
			<label><input type="checkbox" name="auth_type<?=$k?>[]" value="공저자" <?=(strpos($v['auth_type'],'공저자')!==false)?'checked=checked':''?>/> 공저자</label>
		</td>
	</tr>
	<tr>
		<th width="200">저자명*<br />Author Name*</th>
		<td>한/Kor : <input type="text" name="auth_name[]" id="auth_name" style="width:100%;" value="<?=$v['auth_name']?>" required/><br/><br/>영/Eng : <input type="text" name="auth_name_eng[]" id="auth_name_eng" style="width:100%;" value="<?=$v['auth_name_eng']?>" required/></td>
		<th width="200">전화*<br />Tel</th>
		<td><input type="text" name="auth_tel[]"  id="auth_tel" style="width:100%;" value="<?=$v['auth_tel']?>" required/></td>
	</tr>
	<tr>
		<th width="200">이메일*<br />E-mail*</th>
		<td><input type="text" name="auth_email[]" id="auth_email" style="width:100%;" value="<?=$v['auth_email']?>" required/></td>
		<th width="200">핸드폰*<br />Mobile*</th>
		<td><input type="text" name="auth_mobile[]" id="auth_mobile" style="width:100%;" value="<?=$v['auth_mobile']?>" required/></td>
	</tr>
	<tr>
		<th width="200">소속*<br />Organization*</th>
		<td colspan="3">한/Kor : <input type="text" name="organization[]" id="organization" style="width:100%;" value="<?=$v['organization']?>" required/><br/><br/>영/Eng : <input type="text" name="organization_eng[]" id="organization_eng" style="width:100%;" value="<?=$v['organization_eng']?>" required/></td>
	</tr>
	<tr>
		<td colspan="4" style="text-align:right;">
		<a href="d_process.php?mode=delete_author&seq=<?=$v['parent_seq']?>&authseq=<?=$v['auth_seq']?>&mail=<?=$v['auth_email']?>" style="color:#EA0E0E">삭제</a>
		</td>
	</tr>
	<!--tr>
		<th width="200">주소<br />Address</th>
		<td colspan="3"><input type="text" name="address[]" style="width:100%;" value="<?=$v['address']?>"/>
		<input type="hidden" name="mb_zip1" id="mb_zip1"/><input type="hidden" name="mb_zip2" id="mb_zip2"/><input type="hidden" name="mb_addr1" id="mb_addr1"/><input type="hidden" name="mb_addr2" id="mb_addr2"/><input type="hidden"  name="adr" id="address" />
		</td>
	</tr-->
	</tbody>
</table>	