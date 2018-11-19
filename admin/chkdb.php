<?php
// 1. 연결 : mysql_connect(호스트명, 아이디, 비밀번호)
$conn=mysql_connect('210.118.171.42', 'ideun_renew_user', 'idreDB)*!)'); //db 연결부분
 
if($conn) 
	echo "db connection success!!";
else
	echo "db connection fail!!"; 
 

// DB 선택 : mysql_select_db(해당 db명, $conn)
//$db=mysql_select_db("php_exam", $conn);
//if($db)
// echo "db 연결성공";/
//else
// echo "db 연결 실패";


// DB에 table 쿼리(query 질의).
//$sql="create table php_tbl(num int, name varchar(10))";
//mysql_query($sql, $conn)  db에 질의 수행.
//mysql_query($sql, $conn);
?>
<script>
//alert("테이블 생성");
</script>