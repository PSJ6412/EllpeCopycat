<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>❤장바구니</title>
    <link rel="stylesheet" type="text/css" href="./basket.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  </head>
  <body>
    <!-- 헤더 영역 -->
    <?php include "../header.php";?>
    <!-- 장바구니 영역 -->
    <div class="basketBody">
      <div class="basketContent">
        <h3 class="basket_title">SHOPPING CART</h3>
        <?php

        // db연결
        include '../dbConnect/connect.php';


        // 세션이 있으면
        if(isset($_SESSION["id"])){

          $sessionId = $_SESSION['id'];
          //회원 정보
          $query_member = "SELECT MEM_LEVEL FROM member_info WHERE mem_id = $sessionId";

          //실행
          $result_member = mysqli_query( $conn, $query_member);

          //결과를 배열로 변환
          $member = mysqli_fetch_array($result_member);
        ?>
          <div class="basket_top">
            <h3>혜택정보</h3>
            <div class="basket_memInfo">
              <div class="info1"><span>박소정</span> 님은, [<?php echo $member['MEM_LEVEL'] ?>]회원이십니다.</div>
              <div class="info2">
                <a href="">가용적립금 : <span>적립금 0원</span></a>
                <a href="">예치금 : <span>0원</span></a>
                <a href="">쿠폰 : <span>5개</span></a>
              </div>
            </div>
          </div>
       <?php } ?>
        <ul class = "tabs">
          <li class="tab_left"><a href="">국내배송상품(1)</a></li>
          <li class="tab_right"><a href="">해외배송상품(0)</a></li>
        </ul>
        <table class="product_tbl">
          <thead>
            <tr>
              <th><input type="checkbox" name="" value=""></th>
              <th style="display:none;">ID</th>
              <th>이미지</th>
              <th>상품정보</th>
              <th>판매가</th>
              <th>수량</th>
              <th>적립금</th>
              <th>배송구분</th>
              <th>배송비</th>
              <th>합계</th>
              <th>선택</th>
            </tr>
          </thead>
          <tbody>

            <?php
            // 세션이 있으면 ,유저가 저장한 cart데이터 로딩
            if(isset($_SESSION["id"])){

              //cart 정보
              $query_cart = "SELECT c.CART_ID,c.PROD_SIZE, c.PROD_COLOR, c.CART_QTY, p.PROD_NAME, p.PROD_PRICE, p.PROD_SALE_PRICE , p.PROD_IMG
                               FROM cart as c left join products as p
                                 ON c.PROD_ID = p.PROD_ID
                              WHERE c.MEM_ID = $sessionId";

              //실행
              $result_cart = mysqli_query( $conn, $query_cart);

              //row결과 만큼 tr 생성
              while ($cart = mysqli_fetch_array($result_cart)) {

                // 사이즈 옵션이 없으면 색상만 표시
                $option = !empty($cart['PROD_SIZE']) ? ($cart['PROD_COLOR'].'/'.$cart['PROD_SIZE']) : $cart['PROD_COLOR'];

                // 세일가격 없으면 원가격 표시
                $price = empty($cart['PROD_SALE_PRICE']) ? $cart['PROD_PRICE'] : $cart['PROD_SALE_PRICE'];

                // 상품 이미
                $prodImg = $cart['PROD_IMG'];

                // 총가격 = 가격 * 수량
                $totalPrice = ($price * $cart['CART_QTY']);
             ?>
             <!-- 반복구간 시작 -->
                <tr>
                  <td class="test"><input type="checkbox" name="" value=""></td>
                  <td id="cartId" style="display:none;"><?=$cart["CART_ID"];?></td>
                  <td><img src="../img/<?=$prodImg;?>" alt="" style=" max-width: 80px;"></td>
                  <td><?php echo $cart['PROD_NAME'];?><p>[옵션:<?php echo $option;?>]</p></td>
                  <td><?php echo $price;?>원</td>
                  <td>
                    <input type="number" name="" value="<?=$cart['CART_QTY'];?>">
                    <a href="#">변경</a>
                  </td>
                  <td>
                    <p><img src="../img/icon_sett01.gif" alt="">적립금 100원</p>
                    <p><img src="../img/icon_sett02.gif" alt="">적립금 100원</p>
                    <p><img src="../img/icon_sett03.gif" alt="">적립금 100원</p>
                    <p>적립금 100원</p>
                    <p><img src="../img/ico_pay_account.gif" alt="">적립금 100원</p>
                  </td>
                  <td>기본배송</td>
                  <td>2,500원<br>조건</td>
                  <td><?= $totalPrice;?>원</td>
                  <td class = "product_edit">
                    <ul>
                      <li><a href="#">주문하기</a></li>
                      <li><a href="#">관심상품등록</a></li>
                      <li><a onclick="deleteCart(<?=$cart["CART_ID"];?>);">✖ 삭제</a></li>
                    </ul>
                  </td>
                </tr>
            <!-- 반복구간 끝 -->
          <?php }
          // 세션이 없으면,
          }else{
            // 쿠키유무 확인하고 데이터 로딩
            if(isset($_COOKIE['basket'])||isset($_COOKIE['basketCount'])){

              // 장바구니에 넣은 상품쿠키  가져오기
              //$basket = stripslashes($_COOKIE['basket']);
              $cArray = json_decode($_COOKIE['basket'], true);

              // 갯수쿠키 가져오기
              $count = $_COOKIE['basketCount'];

              // 갯수만큼 반복
              for ($row=0; $row < $count; $row++) {
              //여기서는 베열로 인식을 못함.. 어떡하지 ? => json_decode로 묶어서 출력하니 해결!!!!(22.1.18)
              //echo print_r($test[$row],true);

              // 상품 정보 가져오기
              $query = "SELECT PROD_NAME, PROD_PRICE, PROD_SALE_PRICE , PROD_IMG
                               FROM products
                              WHERE PROD_ID = ".print_r($cArray[$row][0],true);

              //실행
              $result = mysqli_query( $conn, $query);

              //결과1
              $dbRow = mysqli_fetch_array($result);


              $qty = print_r($cArray[$row][3],true);
              $prodName = $dbRow["PROD_NAME"];
              $prodPrice = empty($dbRow['PROD_SALE_PRICE']) ? $dbRow['PROD_PRICE'] : $dbRow['PROD_SALE_PRICE'];
              $totalPrice = ($prodPrice * $qty);
              $prodImg = $dbRow["PROD_IMG"];
              $prodId = print_r($cArray[$row][0],true);
              $option = !empty(print_r($cArray[$row][2],true)) ? (print_r($cArray[$row][1],true).'/'.print_r($cArray[$row][2],true)) : print_r($cArray[$row][1],true);


            ?>
            <!-- 반복구간 시작 -->
            <tr>
              <td class="test"><input type="checkbox" name="" value=""></td>
              <td><img src="../img/<?=$prodImg;?>" alt="" style=" max-width: 80px;"></td>
              <td><?= $prodName;?><p>[옵션:<?= $option;?>]</p></td>
              <td><?= $prodPrice;?>원</td>
              <td>
                <input type="number" name="" value=<?= $qty;?>>
                <a href="#">변경</a>
              </td>
              <td>
                <p><img src="../img/icon_sett01.gif" alt="">적립금 100원</p>
                <p><img src="../img/icon_sett02.gif" alt="">적립금 100원</p>
                <p><img src="../img/icon_sett03.gif" alt="">적립금 100원</p>
                <p>적립금 100원</p>
                <p><img src="../img/ico_pay_account.gif" alt="">적립금 100원</p>
              </td>
              <td>기본배송</td>
              <td>2,500원<br>조건</td>
              <td><?= $totalPrice;?>원</td>
              <td class = "product_edit">
                <ul>
                  <li><a href="#">주문하기</a></li>
                  <li><a href="#">관심상품등록</a></li>
                  <li><a href="#">✖ 삭제</a></li>
                </ul>
              </td>
            </tr>
            <!-- 반복구간 끝 -->
          <?php } } } ?>

         </tbody>
        </table>

        <div class="total_pirce">
          [기본배송]
          <div>
            <span>상품구매금액0+배송비2,500 = 합계:</span>
            <span>0</span>원
          </div>

        </div>
        <div class="basket_edit">
          선택상품
          <a href="#">✖ 삭제하기</a>
          <a href="#">해외배송상품 장바구니로 이동</a>
          <div>
            <a href="#">장바구니비우기</a>
            <a href="#">견적서출력</a>
          </div>
        </div>
        <table class="price_tbl">
          <tr>
            <th>총 상품금액</th>
            <th>총 배송비</th>
            <th>총 할인금액<a href="">내역보기</a></th>
            <th>결제예정금액</th>
          </tr>
          <tr>
            <td><span>0</span> 원</td>
            <td><span>0</span> 원</td>
            <td><span>-0</span> 원</td>
            <td><span>=0</span> 원</td>
          </tr>
        </table>

        <ul class="basket_btn">
          <li><a href="" style="color: #fff;">전체상품주문</a></li>
          <li><a href="" style="color: #fff;">선택상품주문</a></li>
          <li><a href="" style="color: #353535;">쇼핑계속하기</a></li>
        </ul>
        <div class="guideArea">
          <h1>이용안내</h1>
          <div class="basketGuide">
            <h3>장바구니 이용안내</h3>
            <ol>
              <li>1. 해외배송 상품과 국내배송 상품은 함께 결제하실 수 없으니 장바구니 별로 따로 결제해 주시기 바랍니다.</li>
              <li>2. 해외배송 가능 상품의 경우 국내배송 장바구니에 담았다가 해외배송 장바구니로 이동하여 결제하실 수 있습니다.</li>
              <li>3. 선택하신 상품의 수량을 변경하시려면 수량변경 후 [변경] 버튼을 누르시면 됩니다.</li>
              <li>4. [쇼핑계속하기] 버튼을 누르시면 쇼핑을 계속 하실 수 있습니다.</li>
              <li>5. 장바구니와 관심상품을 이용하여 원하시는 상품만 주문하거나 관심상품으로 등록하실 수 있습니다.</li>
              <li>6. 파일첨부 옵션은 동일상품을 장바구니에 추가할 경우 마지막에 업로드 한 파일로 교체됩니다.</li>
            </ol>
            <h3>무이자할부 이용안내</h3>
            <ol>
              <li>1. 상품별 무이자할부 혜택을 받으시려면 무이자할부 상품만 선택하여 [주문하기] 버튼을 눌러 주문/결제 하시면 됩니다.</li>
              <li>2. [전체 상품 주문] 버튼을 누르시면 장바구니의 구분없이 선택된 모든 상품에 대한 주문/결제가 이루어집니다.</li>
              <li>3. 단, 전체 상품을 주문/결제하실 경우, 상품별 무이자할부 혜택을 받으실 수 없습니다.</li>
              <li>4. 무이자할부 상품은 장바구니에서 별도 무이자할부 상품 영역에 표시되어, 무이자할부 상품 기준으로 배송비가 표시됩니다.</li>
              <li>5. 실제 배송비는 함께 주문하는 상품에 따라 적용되오니 주문서 하단의 배송비 정보를 참고해주시기 바랍니다.</li>
            </ol>
          </div>

        </div>
      </div>
    </div>

  </body>
  <footer>
    <?php include "../footer.html"; ?>
  </footer>
</html>


<script type="text/javascript">

  //cart삭제
  var deleteCart = function(cartId) {

    $.ajax({
    url:'/ellpeProject/dbConnect/basket_Delete.php', //request 보낼 서버의 경로
    type:'post', // 메소드(get, post, put 등)
    dataType: "json",
    data:{ //보낼 데이터
        'cartId' : cartId
    },

    success: function(data) {
      if(data) {
        //새로고침
        location.reload();
     } else {
        alert("오류가 발생하였습니다.");
     }

    },
    error: function(request,status,error) {
        //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
        // alert("회원가입 실패");
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }

    });
  }

  </script>
