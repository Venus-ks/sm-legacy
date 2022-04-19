<?php
foreach($loop as $lo) {
	$authors['authors'][] = 
	[
		'type'				=> explode('|',$lo['auth_type']),
		'name'				=> $lo['auth_name'],
		'name_eng'			=> $lo['auth_name_eng'],
		'tel'				=> $lo['auth_tel'],
		'email'				=> $lo['auth_email'],
		'mobile'			=> $lo['auth_mobile'],
		'organization'		=> $lo['organization'],
		'organization_eng' 	=> $lo['organization_eng']
	];
};
?> 
<script>
	
	json_encode = '<?=json_encode($authors,JSON_UNESCAPED_UNICODE)?>';
	parse_json = JSON.parse(json_encode);
	// if(json_encode)	parse_json = JSON.parse(json_encode);
	// else parse_json['authors'] = [{type:[]}];
	function getAuthors(){
		if(parse_json){
			return parse_json;
		}
		else{
			return {
				authors :[
					{
						type : []
					}
				]
			};
		}
	};
	function onOff(){
		if(parse_json){
			return false;
		}else{
			return true;
		}
	};
	
	
</script>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<div class="row" x-data="getAuthors()">
	<input type="hidden" name="addauth" x-bind:value="JSON.stringify(authors)">
<div class="col">
<template x-for="(auth, index) in authors" :key="index" > 
<table class="boardType01_write mt-3">
	<tr>
	<th width="200"><strong>저자유형<span class="required">*</span><br />Author Type</strong></th>
	<td colspan="3">
		<label><input type="checkbox" x-model="auth.type" value="제1저자">제1저자</label>
		<label><input type="checkbox" x-model="auth.type" value="교신저자">교신저자</label>
		<label><input type="checkbox" x-model="auth.type" value="공저자">공저자</label>
    </td>
    </tr>
	<tr>
		<th width="200">저자명<span class="required">*</span><br />Author Name</th>
		<td>
			한/Kor : <input type="text" x-model="auth.name" style="width:100%;"/><br/><br/>
			영/Eng : <input type="text" x-model="auth.name_eng" style="width:100%;" required/>
			
		</td>
		<th width="200">전화<br />Tel</th>
		<td>
			<input type="text" x-model="auth.tel" -text="auth.tel"  style="width:100%;"/>
		</td>
	</tr>
	<tr>
		<th width="200">이메일<span class="required">*</span><br />E-mail</th>
		<td>
			<input type="text" x-model="auth.email" x-text="auth.email" style="width:100%;" required/>
		</td>
		<th width="200">핸드폰<span class="required">*</span><br />Mobile</th>
		<td>
			<input type="text" x-model="auth.mobile" x-text="auth.mobile" style="width:100%;" required/>
		</td>
	</tr>
	<tr>
		<th width="200">소속<span class="required">*</span><br />Organization</th>
		<td colspan="3">
			한/Kor : <input type="text" x-model="auth.organization" x-text="auth.organization"  style="width:100%;" required/><br/><br/>
			영/Eng : <input type="text" x-model="auth.organization_eng" x-text="auth.organization_eng" style="width:100%;" required/>
		</td>
	</tr>
	

</table>
</template>
<div class="float-right mt-3">
	<button type="button" class="btn btn-info" @click="authors.push({ type : []})" x-show="onOff()">저자추가</button>
	<button type="button" class="btn btn-danger btn-small" @click="authors.splice(-1,1)" x-show="authors.length > 1">삭제</button>
</div>

</div>
</div>






