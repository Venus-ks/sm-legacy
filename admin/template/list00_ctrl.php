<?php
//표시라인수
$page_rows = 10;
//총 레코드수
$tsql = " select distinct seq from ad_paper where {$where} ";
$result = sql_query($tsql);
$total_count = mysql_num_rows($result);
//
$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
if (!$page) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함
### ORDER BY
$sql_order = ($sql_order)?$sql_order:" order by seq desc ";
###
$sql		= " select * from ad_paper where {$where} $sql_order limit $from_record, $page_rows ";
$result		= sql_query($sql);
$list_label = [
	['title'=>'No ','name'=>'num'],
	['title'=>'구분<br/>Status','name'=>'status'],
	['title'=>'논문번호<br/>Manuscript ID','name'=>'code'],
	['title'=>'원고종류<br/>Article type','name'=>'paper_type'],
	['title'=>'논문명<br/>Article Title','name'=>'title'],
	['title'=>'투고일<br/>Submission Date','name'=>'regdate'],
];
for ($k=0; $row=sql_fetch_array($result); $k++){
	//$list[$i]		= get_list($row, $board, $board_skin_path, 50);
	$list[] = [
		'num'=>$total_count - ($page - 1) * $page_rows - $k,
		'status'=>get_status($row['seq']),
		'code'=>$info['abbr'].'-'.date("y").'-'.str_pad($row['number'],3,'0',STR_PAD_LEFT),
		'paper_type'=>($row['manuscript'])?get_manuscript($row['manuscript']):'-',
		'title'=>$row['title_eng'],
		'regdate'=>substr($row['regdate'],0,10),
        'raw'=> $row
	];
}
