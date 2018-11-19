<?
include_once("../_common1.php");
include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");

//print_r(get_defined_constants());
// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.
$table_width = 1004;
$mb_login_mode = $_GET['login_mode'];
### LOGIN CHECK
if(!$member['mb_id']) goto_url("./login.php");
$mode = $_SESSION['ss_mb_mode'];
if($_SERVER['PHP_SELF']=="/admin/index.php"){
	if($member['mb_level'] == 10){		// ### 10 // 편집간사
		if($mode == '1'){
		// 편집간사이면서 투고자 모드로 들어왔을 경우
			goto_url("./a_sub02.php");
		}else if($mode == '2'){
			// 편집간사이면서 심사위원 모드로 들어왔을 경우
			goto_url("./b_sub01.php");
		}else if($mode == '3'){
			// 편집간사이면서 편집간사 모드로 들어왔을 경우
			goto_url("./d_sub06.php");
		}else if($mode == '4'){
			// 편집간사이면서 대표간사 모드로 들어왔을 경우
			goto_url("./d_sub06.php");
		}
		//goto_url("./d_sub01.php");
	}else if($member['mb_level'] == 9){	// ### 9 // 임시대표간사
		if($mode == '1'){
			// 임시대표간사이면서 투고자 모드로 들어왔을 경우
			goto_url("./a_sub02.php");
		}else if($mode == '2'){
			// 임시대표간사이면서 심사위원 모드로 들어왔을 경우
			 goto_url("./b_sub01.php");
		}else if($mode == '3'){
			// 임시대표간사이면서 대표간사 모드로 들어왔을 경우
			 goto_url("./d_sub06.php");
		}else if($mode == '4'){
			// 임시	대표간사이면서 편집간사 모드로 들어왔을 경우
			 goto_url("./d_sub06.php");
		}
		//goto_url("./d_sub06.php");
	}else if($member['mb_level'] == 8){	// ### 8 // 대표간사
		if($mode == '1'){
		// 대표간사이면서 투고자 모드로 들어왔을 경우
			goto_url("./a_sub02.php");
		}else if($mode == '2'){
			// 대표간사이면서 심사위원 모드로 들어왔을 경우
			 goto_url("./b_sub01.php");
		}else if($mode == '3'){
			// 대표간사이면서 대표간사 모드로 들어왔을 경우
			 goto_url("./d_sub06.php");
		}else if($mode == '4'){
			// 대표간사이면서 편집간사 모드로 들어왔을 경우
			 goto_url("./d_sub06.php");
		}
		//goto_url("./d_sub06.php");
	}else if($member['mb_level'] >= 6){	// ### 6,7 // 미사용
		goto_url("./c_sub01.php");
	}else if($member['mb_level'] >= 4){	// ### 4,5 // 심사위원용
		if($mode == '1'){
		// 심사위원이면서 투고자 모드로 들어왔을 경우
			goto_url("./a_sub02.php");
		}else if($mode == '2'){
			// 심사위원이면서 심사위원 모드로 들어왔을 경우
			goto_url("./b_sub01.php");
		}else if($mode == '3'){
			// 다른 모두 선택시 무조건 기본 모드로..
			goto_url("./b_sub01.php");
		}else if($mode == '4'){
			// 다른 모두 선택시 무조건 기본 모드로..
			goto_url("./b_sub01.php");
		}
		//goto_url("./b_sub01.php");
	}else{								// ### 투고자용 1,2,3
		goto_url("./a_sub02.php");
	}
}
?>
<h2 style="font-family:'Malgun gothic,맑은고딕';margin:0.5rem 1.5rem">
	<?php if($info['logo_url']):?>
		<img src="<?=$info['logo_url']?>">
	<?php else:?>
		<b><?=$info['institute_title']?></b>
	<?php endif?>
</h2>
<style>
.nav-tabs>li.active>a {background-color: #2977C9;color:#fff}
</style>
<ul class="nav nav-tabs">
	<?php if($member['mb_level']>=2):?>
		<li role="presentation" class="<?=($mode==1)?'active':''?>"><a href="./d_process.php?mode=switch_mode&mb_id=<?=$member['mb_id']?>&type=1">저자 모드</a></li>
	<?php endif?>
	<?php if($member['mb_level']>=4):?>
		<li role="presentation" class="<?=($mode==2)?'active':''?>"><a href="./d_process.php?mode=switch_mode&mb_id=<?=$member['mb_id']?>&type=2">심사자 모드</a></li>
	<?php endif?>
	<?php if($member['mb_level']>=10):?>
		<li role="presentation" class="<?=($mode==3)?'active':''?>"><a href="./d_process.php?mode=switch_mode&mb_id=<?=$member['mb_id']?>&type=3">편집자 모드</a></li>
	<?php endif?>
</ul>
<div style="margin:0;line-height:20px;height:20px;background-color:#2977C9;color:#FFF;padding-left:5px;font-weight:600"></div>
