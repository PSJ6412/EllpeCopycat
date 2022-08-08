<?session_start();

?>

<link rel="stylesheet" type="text/css" href="http://localhost/ellpeProject/header.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="header">
  <div class="header-top">

      <div class="logo">
        <a href="http://localhost/ellpeProject/Main.php"><img src="http://localhost/ellpeProject/img/logo.png" alt=""></a>
      </div>
      <div class="sns">
        <img src="http://localhost/ellpeProject/img/icon_facebook.png" alt="">
        <img src="http://localhost/ellpeProject/img/icon_instagram.png" alt="">
      </div>
      <div class="search">
        <input type="text" name="" value="" placeholder="이쁜 블라우스 확인!">
        <button type="button" name="button"><i class="fa fa-search"></i></button>
      </div>

  </div>
  <div class="header-bot">
    <div class="leftBtn">
      <ul>
         <?php if(!isset($_SESSION['id']) || !isset($_SESSION['name'])) { ?>
          <li><a href="http://localhost/ellpeProject/login.php">LOGIN</a></li>
          <li><a href="http://localhost/ellpeProject/join.php">JOIN US</a></li>
        <?php }else{?>
            <!-- echo $_SESSION['name']; -->
          <li><a href="http://localhost/ellpeProject/dbConnect/logout.php">LOGOUT</a></li>
          <li><a href="">MODIFY</a></li>
        <?php }?>
        <li><a href="">ORDER</a></li>
        <li><a href="http://localhost/ellpeProject/subMenu/basket.php">CART</a>
          <span class="cart-Count">
          <?php
            if(isset($_COOKIE['basketCount'])){
              echo $_COOKIE['basketCount'];
            }else{
              echo '0';
            }
          ?>
          </span>
        </li>
        <li><a href="">MYPAGE</a></li>
      </ul>
    </div>
    <div class="rightBtn">
        <ul>
          <li><a href="http://localhost/ellpeProject/subMenu/notice.php">NOTICE</a></li>
          <li><a href="">ENENT</a></li>
          <li><a href="">Q&A</a></li>
          <li><a href="">REVIEW</a></li>
          <li><a href="">DELAY</a></li>
          <li><a href="">DELIVERY</a></li>
          <li><a href="">BOOKMARK</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="MenuArea">
    <div class="top-menu">
      <ul>
        <li><a href="">BEST 50</a></li>
        <li><a href="">another ledds</a></li>
        <li><a href="">NEW 5%</a></li>
        <li><a href="">OUTER</a></li>
        <li><a href="">KNIT/CARDIGAN</a></li>
        <li><a href="">TOP</a></li>
        <li><a href="">BLOUSE/SHIRTS</a></li>
        <li><a href="">DRESS</a></li>
        <li><a href="">SKIRT</a></li>
        <li><a href="">PANTS</a></li>
        <li><a href="">EASY LOOK</a></li>
        <li><a href="">EARLY FALL</a></li>
        <li><a href="">SHOES/BAG</a></li>
        <li><a href="">ACC</a></li>
        <li><a href="">당일발송</a></li>
      </ul>
    </div>

  </div>
