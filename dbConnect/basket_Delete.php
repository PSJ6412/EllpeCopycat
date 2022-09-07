<?php

header("Content-Type:application/json");

include './connect.php';


// cart_id
$cartId = $_REQUEST['cartId'];


// query 실행
$query = "DELETE FROM cart WHERE CART_ID='$cartId'";

//결과
$result = mysqli_query( $conn, $query );

echo json_encode($result);

return;


 ?>
