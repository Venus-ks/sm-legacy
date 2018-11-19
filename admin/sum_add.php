<?php
include_once("./admin_head.php");
$sql = "SELECT * FROM `ad_paper_review`";
$result = sql_query($sql);
while ($row = sql_fetch_array($result)){
	$sum = 0;
	$sum_arr = explode('|',$row['score']); 
	foreach($sum_arr as $k=>$v){
		if($k==0 || $k==1) $sum = $sum + $v*2;
		else $sum = $sum + $v;
	}
	echo $sql = "UPDATE `ad_paper_review` SET score_sum={$sum} WHERE rseq='{$row['rseq']}';";
}
?>