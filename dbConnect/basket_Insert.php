<?php

if(!isset($_SESSION["id"])){
  exit();
}

header("Content-Type:application/json");

include 'connect.php';



// array 변수
$cartList = $_REQUEST['cartList'];
// array row갯수
$rowCount = count($cartList);

// 일괄 insert를 위해 sql구문을 추가한다.
$sql_Text = '';

//row갯수만큼
for ($row=0; $row < $rowCount; $row++) {

  //첫번째 이후는 앞에 ,를 붙인다.
  if($row!=0){
    $sql_Text .= ',';
  }

  //sql구문 추가
  $sql_Text .= "('".$_SESSION["id"]."','".$cartList[$row][0]."','".$cartList[$row][1]."','".$cartList[$row][2]."','".$cartList[$row][3]."')";

}

// query 실행
$query = "INSERT INTO cart (MEM_ID, PROD_ID, PROD_COLOR, PROD_SIZE, CART_QTY)
                VALUES".$sql_Text;

//결과
$result = mysqli_query( $conn, $query );

if($result){
  echo json_encode(array("result" => 1, "message" => "장바구니에 상품을 담았어요 !"));
}else{
  echo json_encode(array("result" => 0, "message" => "장바구니 담기에 실패했어요 !"));
}

return;


 ?>
