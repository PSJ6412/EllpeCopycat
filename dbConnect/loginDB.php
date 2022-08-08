<?php

header("Content-Type:application/json");

//db연결
include 'connect.php';

//변수
$id = $_REQUEST['id'];
$pass = $_REQUEST['pass'];

//쿼리
$query = "SELECT MEM_ID, MEM_NAME FROM member_info WHERE MEM_ID = '$id' AND MEM_PASS = '$pass'";

//실행
$result = mysqli_query( $conn, $query );

//결과1
$row = mysqli_fetch_array($result);

// echo $row['NAME'];
//print_r($row);

 if($row){
   // 세션 추가
   $_SESSION["id"] = $row["MEM_ID"];
   $_SESSION["name"] = $row["MEM_NAME"];
   // 메세지 출력
    echo json_encode(array("result" => 1, "message" => $row["MEM_NAME"]."님 환영합니다 !"));
    return;
 }else{
    echo json_encode(array("result" => 0, "message" => "아이디 또는 비밀번호가 일치하지 않습니다 !"));
    return;
 }


 ?>
