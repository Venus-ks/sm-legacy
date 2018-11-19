<?
include_once("./_common.php");

### C :: 학습지 저널등록
if($_POST['mode']=="c_sub_reg"){

	$field_str	= implode("|", $_POST['field']);
	$field	 = "title				= '{$_POST['title']}',
				title_eng			= '{$_POST['title_eng']}',
				issn				= '{$_POST['issn']}',
				issn_ec				= '{$_POST['issn_ec']}',
				issn_cd				= '{$_POST['issn_cd']}',
				sdate				= '{$_POST['sdate']}', 
				edate				= '{$_POST['edate']}',
				category			= '{$_POST['category']}',
				field				= '{$field_str}',
				cont				= '{$_POST['cont']}',
				cont_eng			= '{$_POST['cont_eng']}'
				";


	if($_POST['seq']){
		$sql = "UPDATE ad_journal SET {$field} WHERE seq = '{$_POST['seq']}'";
		sql_query($sql);
		$parent_seq = $_POST['seq'];
	}else{
		$sql = "INSERT INTO ad_journal SET 
					{$field},
					mb_id		= '{$member['mb_id']}',
					mb_name		= '{$member['mb_name']}',
					regdate		= now()";
		sql_query($sql);
		$parent_seq = mysql_insert_id();
	}
	

	$msg		= "처리 되었습니다.";
	$returnUrl	= "./c_sub01.php";
}


else if($_POST['mode']=="c_contents"){
	$sql = "update ad_config set
		  content01	= '{$_POST['content01']}',
		  content02	= '{$_POST['content02']}',
		  content03	= '{$_POST['content03']}',
		  regip		= '{$_SERVER['REMOTE_ADDR']}',
		  regdate		= now()";

	sql_query($sql);

	$msg		= "처리 되었습니다.";
	$returnUrl	= "./c_sub02.php";

}

###
alert($msg, $returnUrl);
?>