<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mainPgStyle.css">
    <title>&#128149;또롱엘프</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  </head>
  <body>
    <?php include "./header.php"; ?>
      <div class="summaryView">
        <div class="sum-top">
          <div class="sumView1">
            <div class="imgspace"><img src="img/sumView1.jpg"></div>
          </div>
          <div class="sumView2">
            <div class="imgspace"><img src="img/sumView2.jpg"></div>
          </div>
        </div>
        <div class="sum-bot">
          <div class="sumView3">
            <div class="imgspace"><img src="img/sumView3.jpg"></div>
          </div>
          <div class="sumView4">
            <div class="imgspace"><img src="img/sumView4.jpg"></div>
          </div>
          <div class="sumView5" style="">
            <div class="imgspace"><img src="img/sumView5.jpg"></div>
          </div>
          <div class="sumView6">
            <div class="imgspace"><img src="img/sumView6.jpg"></div>
          </div>
        </div>
      </div>
      <div class="newGoods">
        <div class="newGoodsTitle">
          <h1>NEW 5%</h1>
          <span>❄ 매일 오후 12시 겨울 신상 업데이트 ⛄</span>
        </div>
        <div class="goodsArea">
          <?php

            include 'dbConnect/connect.php';

            //상품 전체 로딩
            $query = "SELECT * FROM products";

            $result = mysqli_query( $conn, $query);

            //결과를 배열로 변환
            //$row = mysqli_fetch_array($result);

            while ($product = mysqli_fetch_array($result)) {
           ?>
          <!-- 반복구간 시작 -->
          <?php  ?>
          <div class="goodsPos">
            <div class="goodsImg">
              <a href="/ellpeProject/product/productDetail.php?prodId=<?= $product['PROD_ID']; ?>"><img src="img/<?=$product['PROD_IMG']; ?>"></a>
            </div>
            <div class="goodsText">
              <div class="goodsColor">
                <div class="color1"></div><div class="color2"></div>
              </div>
              <div class="goodsName">
                <?php if(isset($product['PROD_SALE_PRICE'])){ ?>
                <a href="/ellpeProject/product/productDetail.php?prodId=1" >
                  <div class="nameTop"><?= $product['PROD_SUB_NAME']; ?></div>
                </a>
                <?php } ?>
                <a href="/ellpeProject/product/productDetail.php?prodId=1">
                  <div class="nameBot"><?= $product['PROD_NAME']; ?></div>
                </a>
              </div>
              <div class="goodsPrice">

                <?php
                // 재고가 없거나 || 세일가격이 있으면 원가격에 취소선 표시
                if($product['PROD_STOCK'] < 1 || isset($product['PROD_SALE_PRICE'])){ ?>
                  <div class="origPirce" style="text-decoration: line-through;"><?= $product['PROD_PRICE']; ?>원</div>
                <?php }else{ ?>
                  <div class="origPirce"><?= $product['PROD_PRICE']; ?>원</div>
                <?php }

                  //재고가 있고
                  if($product['PROD_STOCK'] > 0){
                    // 세일가격이 있으면 표시
                    if(isset($product['PROD_SALE_PRICE'])){
                      $priceGap = $product['PROD_PRICE'] - $product['PROD_SALE_PRICE'];
                    ?>
                      <div>
                        <span class="salePirce1">할인판매가:<?= $product['PROD_SALE_PRICE']; ?>원</span><span class="salePirce2">(최대 <?= $priceGap; ?>원 할인)</span>
                      </div>
                      <?php } ?>

                      <?php
                      //할인기간이 있으면 표시
                      if(isset($product['PROD_SALE_FNDT'])){ ?>
                      <div>
                        <span>할인기간:<?= $product['PROD_SALE_FNDT']; ?></span>
                      </div>
                      <?php } ?>

                <?php
                  //재고가 없으면 품절로 표시
                  }else{  ?>
                    <div>
                      <span class="salePirce1">품절</span>
                    </div>
                <?php } ?>

              </div>
              <div class="goodsContents">
                <span><?= $product['PROD_DISCRIPTION']; ?></span>
              </div>
            </div>
          </div>
        <?php } ?>
          <!-- 반복구간 끝 -->

        </div>
      </div>
    </div>
  </body>
  <footer>
    <?php include "./footer.html"; ?>
  </footer>
</html>
