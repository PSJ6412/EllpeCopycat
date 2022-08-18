<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="http://localhost/ellpeProject/product/productDetail.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <title></title>
  </head>
  <body>
    <!-- 헤더영역 (상대경로)-->
    <?php include "../header.php"; ?>

    <!-- 상품 바디영역-->
    <div class="productBody">
      <div class="productContent">
        <div class="prodRoute">
          <span><a href="#">home</a> > <a href="#">early fall</a> > <a href="#">knit/cardigan</a></span>
        </div>
        <div class="prodTop">

          <?php

            //db연결
            include '../dbConnect/connect.php';

            //상품정보 로딩
            $query = "SELECT * FROM PRODUCTS WHERE PROD_ID =".$_GET['prodId'];

            $result = mysqli_query( $conn, $query);

            $row = mysqli_fetch_array($result);

           ?>
         <div class="prodTopLeft">
           <img src="../img/<?=$row['PROD_IMG']; ?>">
         </div>
          <div class="prodTopRight">
            <div class="prodTitle">
              <?php if(isset($row["PROD_SUB_NAME"])) {?>
                <h2><?= $row["PROD_SUB_NAME"];?></h2>
              <?php } ?>
              <h1 id="ProductName"><?= $row["PROD_NAME"]; ?></h1>
            </div>
            <div class="prodDesc">
              <p><?= $row["PROD_DISCRIPTION"]; ?></p>
            </div>
            <div class="priceInfo">
              <table>
                <tr>
                  <th style="color:#000;font-weight:bold;">PRICE</th>
                  <?php
                    $stock = $row["PROD_STOCK"];
                    if($stock > 0){ ?>
                    <td id="ProdPrice" style="color:#000;"><?= $row["PROD_PRICE"]; ?>원</td>
                  <?php }else{?>
                    <td style="color:#000;">품절</td>
                  <?php } ?>
                </tr>
                <?php
                  if(isset($row["PROD_SALE_PRICE"])){
                  $priceGap = $row['PROD_PRICE'] - $row['PROD_SALE_PRICE'];
                  ?>
                <tr>
                  <th style="color:#ed8299;font-weight:bold;">할인판매가</th>
                  <td ><span id="ProdPrice" style="color:#ed8299;font-weight:bold"><?= $row["PROD_SALE_PRICE"]; ?>원</span>
                    <span style="font-weight:bold">(최대 <?= $priceGap; ?>원 할인)</span>
                  </td>
                </tr>
              <?php }
                if(isset($row["PROD_SALE_FNDT"])){
              ?>
                <tr>
                  <th>할인 기간</th>
                  <td>
                    <p style="margin-bottom:7px;color:#4d75da;">남은시간 -일 (<?= $priceGap; ?>원 할인)</p>
                    <p><?= $row["PROD_SALE_STDT"]; ?>~<?= $row["PROD_SALE_FNDT"]; ?></p>
                  </td>
                </tr>
              <?php } ?>
                <tr>
                  <th>SAVE</th>
                  <td>
                    <p><img src="../img/icon_sett01.gif" alt="">적립금 100원</p>
                    <p><img src="../img/icon_sett02.gif" alt="">적립금 100원</p>
                    <p><img src="../img/icon_sett03.gif" alt="">적립금 100원</p>
                    <p>적립금 100원</p>
                    <p><img src="../img/ico_pay_account.gif" alt="">적립금 100원</p>
                  </td>
                </tr>
                <tr>
                  <th>컬러</th>
                  <td>
                    <?php if($stock > 0){ ?> <!--품절일때 옵션 비활성화-->
                      <select class="colorBox" onchange="add_List(this.options[this.selectedIndex].text);">
                    <?php }else{?>
                      <select class="colorBox" disabled>
                    <?php } ?>
                      <option value="">- [필수] 컬러 선택 -</option>
                      <option value="" disabled>------------------</option>
                      <?php
                      //상품색상옵션 로딩
                        $query2 = "SELECT PROD_COLOR FROM PROD_COLOR WHERE PROD_ID =".$_GET['prodId'];

                        $result2 = mysqli_query( $conn, $query2);

                        while ($color = mysqli_fetch_array($result2)) { ?>
                      <option value=""><?= $color["PROD_COLOR"];  ?></option>
                    <?php } ?>
                    </select>
                  </td>
                </tr>
              </table>
            </div>
            <div class="couponImg">
              <img src="../img/coupon_Img1.gif" alt="">
              <img src="../img/coupon_Img2.gif" alt="">
            </div>
            <div class="selectProd">
              <table>
                <!-- 반복구간 시작 -->
                <tbody id="prodList">
                </tbody>
                <!-- 반복구간 끝 -->
              </table>
            </div>
            <div class="totalPrice">
              총 상품금액:
              <span class="tQty" id="totalQty" style="padding-top:5px;">(0개)</span>
              <span class="tPrice" id="totalPrice">0원</span>
            </div>

            <div class="prod_btn">
              <a href="#"><div class="buy_btn">BUY IT NOW</div></a>
              <a onclick="add_basket();"><div class="cart_btn">ADD TO CART</div></a>
              <a href="#"><div class="wish_btn">WISH LIST</div></a>
            </div>

          </div>
        </div>
        <div class="prodDetailArea">

        </div>
      </div>
    </div>

  </body>
  <footer>
    <!-- 푸터영역 (상대경로)-->
    <?php include "../footer.html"; ?>
  </footer>
</html>

<script type="text/javascript">
  // 리스트 추가
  function add_List(color){

    //상품명 변수
    var prodName = document.getElementById("ProductName").innerText;

    //상품 가격
    var prodPrice = document.getElementById("ProdPrice").innerText;

    //ROW 총갯수
    var rowCount = document.getElementById("prodList").rows.length;

    // 각 id값의 뒤에는 row전체갯수를 넣어서 row마다 다른 id값을 가지도록 함.
    // ex) 첫번째 id = cart_color0
    //     두번째 id = cart_color1
    var html = $('#prodList').html();
        html += '<tr id="tr"+'+rowCount+'>';
        html += '<td><p style="font-size:11px;">'+prodName+'</p>';
        html += '-<span style="font-weight:bold;" id="cart_color'+rowCount+'">'+color+'</span><span id="cart_size'+rowCount+'"></span></td>';
        html += '<td><input type="number" min="0" max="100" class="selPord_Count" id="cart_qty'+rowCount+'" value="1" onchange="changeQty('+rowCount+');">';
        html += '<a class="selPord_del"'+rowCount+' onclick="delete_List(this)">x</a></td>';
        html += '<td style="text-align:right;" class="cart_price" id="cart_price'+rowCount+'">'+prodPrice+'</td>';
        html += '</tr>';
    // table row 추가
    $('#prodList').html(html);

    setTotalPrice();


  }

  // 리스트 제거
  function delete_List(obj){

   //라인 삭제
   $(obj).parent().parent().remove();

   //총액 수정
   setTotalPrice();

  }

  //업데이트
  var setTotalPrice = function() {

    // table 찾기
    var table = document.getElementById('prodList');

    // 합계 계산
    var sumPrice = 0;
    var sumQty = 0;

    for(let i = 0; i < table.rows.length; i++)  {
      // 가격 합계
      var regex = /[^0-9]/g;				                // 숫자가 아닌 문자열을 선택하는 정규식
      var price = table.rows[i].cells[2].innerText; // 대상 문자열
      var priceResult = price.replace(regex, "");	      // 문자열에서 숫자가 아닌 모든 문자열을 빈 문자로 변경
      sumPrice += parseInt(priceResult);
      // 수량 합계
      sumQty += parseInt($('#cart_qty'+i).val());
    }

    // 합계 출력
    document.getElementById('totalPrice').innerText = sumPrice+"원";
    document.getElementById('totalQty').innerText = "("+sumQty+"개)";

  }

  // 수량 변경
  function changeQty(rowNum){
    //row Index구하기
    var qty = document.getElementById('cart_qty'+rowNum).value;
    //상품 가격
    var prodPrice = document.getElementById("ProdPrice").innerText;
    var regex = /[^0-9]/g;
    var priceResult = prodPrice.replace(regex, "");

    document.getElementById('cart_price'+rowNum).innerText = (priceResult*qty)+"원";

    setTotalPrice();
  }

  //장바구니 데이터 저장
  function add_basket(){
    // table row갯수
    var rowCount = document.getElementById("prodList").rows.length;
    // 선택된 상품이 없으면
    if(rowCount < 1){
      alert("상품을 선택해주세요 !");
      return;
    }

    // table 데이터 2차원 배열에 담아서 파라미터 셋팅
    var cartList = new Array();

    for (var i = 0; i < rowCount; i++) {
        // 1차원 배열
        var cartItem = new Array();
        // 상품id
        cartItem[0] = <?php echo $_GET['prodId']; ?>;
        // 색상옵션
        cartItem[1] = $("#cart_color"+i).text();
        // ,사이즈옵션
        cartItem[2] = $("#cart_size"+i).text();
        // 수량
        cartItem[3] = $("#cart_qty"+i).val();
        //2차원 배열에 담기
        cartList.push(cartItem);
    }

    //세션 id
    var session_id = "<?= isset($_session['id']) ? $_session['id'] : ''; ?>";

    // 세션이 있으면
    if(session_id != ""){
      setSessionBasket(cartList); //DB저장
    }else{
       setCookieBasket(cartList); //쿠키생성
       location.reload();
    }
  }

  //db저장
  var setSessionBasket = function(cartList) {

    $.ajax({
    url:'http://localhost/ellpeProject/dbConnect/basket_Insert.php', //request 보낼 서버의 경로
    type:'post', // 메소드(get, post, put 등)
    dataType: "json",
    data:{ //보낼 데이터
        'cartList' : cartList
    },
    success: function(response) {
      //메세지 출력
      alert(response.message);

      if(response.result == 1) {
        //성공이면 장바구니 페이지로 이동
        location.href = "http://localhost/ellpeProject/subMenu/basket.php";
      }
    },
    error: function(request,status,error) {
        //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
         alert("전송실패");
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }

    });
  }

  //쿠키저장
  var setCookieBasket = function(cartList) {

    var cookieName1 = "basket";
    var cookieName2 = "basketCount";

    //쿠키 찾기
    var issetCookie = document.cookie.match('(^|;) ?' + cookieName1 + '=([^;]*)(;|$)');

    // 상품쿠키가 존재하지 않으면
    if( document.cookie.length < 1 || issetCookie == undefined|| issetCookie == '[null]'){

      // 최초생성
      setCookie(cookieName1,JSON.stringify(cartList),1);

    }else{

      //기존 값 가져오기
      var newList = JSON.parse(getCookie(cookieName1));

      //2차원 배열에 껍데기는 없애고 내용물인 1차배열만 저장하기 위해 for문 사용
      for(var item in cartList){
        //기존 값에 cartList 내용 추가
        newList.push(cartList[item]);
      }

      // 새로운List로 다시 생성
      setCookie(cookieName1,JSON.stringify(newList),1);

    }

    // 상품 값 가져와서
    var basket = JSON.parse(getCookie(cookieName1));
    // 갯수쿠키 업데이트
    setCookie(cookieName2,basket.length);

  }

  //SET쿠키
  var setCookie = function(name, value, exp) {
  var date = new Date();
  date.setTime(date.getTime() + exp*24*60*60*1000);
  document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
  };

  //GET쿠키
  var getCookie = function(name) {
  var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
  return value? value[2] : null;
  };


</script>
