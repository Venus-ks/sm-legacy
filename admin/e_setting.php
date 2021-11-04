<?
include_once("./admin_head.php");
###
$mlevel		= 8;
$menu		= "b2";
###
$sql	= "select * from ad_config ORDER BY no DESC LIMIT 0,1";
$data	= sql_fetch($sql); 
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" height="800" valign="top" background="/images/leftbg.png">
	<!-- ### LEFT MENU -->
	<? include_once("./_menu.php"); ?>
	</td>
	<td valign="top">
	<form name="fregisterform" method="post" onsubmit="return fwrite_submit(this);" enctype="multipart/form-data">
	<input type="hidden" name="mode" value="d_setting"/>
	<input type="hidden" name="mb_no" value="<?=$member['mb_level'] ?>"/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td background="../images/titlebg.png" style="padding:10px;font-size:15px;color:#005187;font-weight:bolder;border-bottom:1px solid #000">서비스 세팅</td>
	</tr>
	<tr>
		<td valign="top" style="padding:20px;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="font_16"><img src="../images/icon.png"  align="absmiddle" class="mr5" />Service Setting</td>
		</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:12px;">
		<tr>
			<td>
			<table class="table table-striped">
			<tr>
				<th width="200">서비스 명</th>
				<td colspan="3"><?=$info['institute_title']?> 논문투고시스템(Ver 1.0.<?=$data['no']?>)</td>
			</tr>
			<tr>
				<th>투고 가능 기간</th>
				<td colspan="3">
					<input type="date" name="sdate" id="sdate" style="width:15rem" value="<?=$data['service_fdate']?>"/>
					부터
					<input type="date" name="edate" id="edate"  style="width:15rem"" value="<?=$data['service_ldate']?>"/>
					<br>
					<div class="form-check py-1">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input " name="everyday" id="" value="open" <?=($data['service_fdate'] == '0000-00-00'&&$data['service_ldate'] == '0000-00-00')?'checked':''?>>
						상시 오픈
						</label>
					</div>
					※ 위 기간에 한하여 투고가 가능합니다.
				</td>
			</tr>
			<tr>
				<th>서비스 설정일<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['regdate'] ?: '미지정'?></td>
				<th width="150">등록IP<font style="font-weight:normal !important;"></font></th>
				<td><?=$data['regip'] ?: '정보없음'?></td>
			</tr>
			<tr>
				<th>양식관리</th>
				<td colspan="3">
					<table class="table">
						<thead>
							<th>문서기준</th>
							<th>문서이름</th>
							<th>현재문서</th>
							<th>교체하기</th>
						</thead>
						<tbody>
							<?php foreach($info['file'] as $key=>$doc):?>
								<tr>
									<td>
										<strong>
										<?=$key?>
										</strong>
									</td>
									<td>
										<div class="form-group input-group-sm">
											<input type="text" class="form-control" name="<?=$key?>-label" id="" aria-describedby="helpId" placeholder="" value="<?=$doc['label']?>">
										</div>
									</td>
									<td>
										<?php if($doc['link']):?>
											<a href="/down.php?link=<?=$doc['link']?>" class="btn btn-sm btn-primary text-white">다운로드</a>
										<?php else:?>
											<button type="button" class="btn btn-sm btn-danger" disabled>미등록</button>
										<?php endif?>
									</td>
									<td>
										<input type="file" name="<?=$key?>-link">
									</td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</td>
			</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
				<td align="center" width="50%">
					<!-- <input type="image" src="../images/btn_summit.png" alt="" style="border:0px;"/> -->
					<button type="submit" name="" id="" class="btn btn-danger" btn-lg btn-block">Submit</button>
				</td>
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
	if(!confirm("수정하시겠습니까?")) return false;
	f.action = "./e_process.php"; 
	return true;
}
</script>