<?php

header("Content-Type:application/json");

include 'connect.php';


$mem_id = $_REQUEST['mem_id'];
$mem_pass = $_REQUEST['mem_pass'];
$pw_questions = $_REQUEST['pw_questions'];
$pw_answer = $_REQUEST['pw_answer'];
$mem_name = $_REQUEST['mem_name'];
$mem_adress = $_REQUEST['mem_adress'];
$mem_tel = $_REQUEST['mem_tel'];
$mem_mobile = $_REQUEST['mem_mobile'];
$mem_email = $_REQUEST['mem_email'];
$mem_nickname = $_REQUEST['mem_nickname'];
$mem_birth = $_REQUEST['mem_birth'];
$news_accept = boolval($_REQUEST['news_accept']);


$query = "INSERT INTO MEMBER_INFO (MEM_ID, MEM_PASS, PASS_QUES, PASS_ANSWER, MEM_NAME, MEM_ADRESS, MEM_TEL, MEM_MOBILE, MEM_EMAIL, MEM_NICK, MEM_BIRTH, NEWS_ACCEPT)
              VALUES ( '".$mem_id."', '".$mem_pass."', '".$pw_questions."', '".$pw_answer."', '".$mem_name."'
                      , '".$mem_adress."', '".$mem_tel."', '".$mem_mobile."', '".$mem_email."', '".$mem_nickname."'
                      , '".$mem_birth."', '".$news_accept."');"; //왜 안들어가는지 하나씩 해보자

$result = mysqli_query( $conn, $query );

// 값 확인하는 구문인데 여기서 사용하니까 500에러가 뜬다???
// 이유 : 결과를 받아오는 select가 아니라 insert이기 때문에
//$row = mysqli_fetch_array($result);
// $return_id = $row[0];
// echo $return_id;

echo json_encode($result);
return;


 ?>
