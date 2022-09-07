<?php
  session_start();

  //모든 세션 변수 리셋
  $result = session_destroy();
  //모든 쿠키 리셋
  unset($_COOKIE["basket"]);
  unset($_COOKIE["basketCount"]);


  //성공 시 메인페이지로 이동
  if($result){
    header('Location: /ellpeProject/main.php');
  }

 ?>
