<?php
$mode = $_SESSION['ss_mb_mode'];

if($member['mb_level'] == 10){ 
	### 10 // 편집간사
	if($mode == '1'){
		// 편집간사이면서 투고자 모드로 들어왔을 경우
		include_once("./_menu1.php"); 
	}else if($mode == '2'){
		// 편집간사이면서 심사위원 모드로 들어왔을 경우
		include_once("./_menu2.php"); 
	}else if($mode == '3'){
		// 편집간사이면서 편집간사 모드로 들어왔을 경우
		include_once("./_menu4.php"); 
	}else if($mode == '4'){
		// 편집간사이면서 대표간사 모드로 들어왔을 경우
		include_once("./_menu5.php"); 
	}
	//include_once("./_menu4.php"); 
}else if($member['mb_level'] == 9){ 
	### 8 // 임시대표간사
	if($mode == '1'){
		// 임시대표간사이면서 투고자 모드로 들어왔을 경우
		include_once("./_menu1.php"); 
	}else if($mode == '2'){
		// 임시대표간사이면서 심사위원 모드로 들어왔을 경우
		include_once("./_menu2.php"); 
	}else if($mode == '3'){
		// 임시대표간사이면서 편집간사 모드로 들어왔을 경우
		include_once("./_menu5.php"); 
	}else if($mode == '4'){
		// 임시대표간사이면서 대표간사 모드로 들어왔을 경우
		include_once("./_menu5.php"); 
	}
	//include_once("./_menu5.php"); 
}else if($member['mb_level'] == 8){ 
	### 8 // 대표간사
	if($mode == '1'){
		// 대표간사이면서 투고자 모드로 들어왔을 경우
		include_once("./_menu1.php"); 
	}else if($mode == '2'){
		// 대표간사이면서 심사위원 모드로 들어왔을 경우
		include_once("./_menu2.php"); 
	}else if($mode == '3'){
		// 대표간사이면서 편집간사 모드로 들어왔을 경우
		include_once("./_menu5.php"); 
	}else if($mode == '4'){
		// 대표간사이면서 대표간사 모드로 들어왔을 경우
		include_once("./_menu5.php"); 
	}
	//include_once("./_menu5.php"); 
}else if($member['mb_level'] >= 6){ 
	### 6,7 // 미사용
	include_once("./_menu3.php"); 
}else if($member['mb_level'] >= 4){ 
	### 4,5 // 심사위원용
	if($mode == '1'){
		// 심사위원이면서 투고자 모드로 들어왔을 경우
		include_once("./_menu1.php"); 
	}else if($mode == '2'){
		// 심사위원이면서 심사위원 모드로 들어왔을 경우
		include_once("./_menu2.php"); 
	}else if($mode == '3'){
		// 다른 모두 선택시 무조건 기본 모드로..
		include_once("./_menu2.php");
	}else if($mode == '4'){
		// 다른 모두 선택시 무조건 기본 모드로..
		include_once("./_menu2.php");
	}
	//include_once("./_menu2.php"); 
}else{
	### 투고자용 1,2,3
	include_once("./_menu1.php"); 
}
?>