<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./notice.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  </head>
  <body>
    <!-- 헤더영역-->
    <?php include "../header.php"; ?>

    <div class="noticeBody">
      <div class="noticeContent">
        <div class="noticeTitle">NOTICE</div>
        <table>
          <thead>
            <tr>
              <th width="70px">no</th>
              <th>contents</th>
              <th width="150px">name</th>
              <th width="120px">date</th>
              <th width="55px">hit</th>
            </tr>
          </thead>
          <tbody>

            <?php
              //db연결
              include '../dbConnect/connect.php';

              //페이지 체크
              if(isset($_GET['page'])){
                $page = $_GET['page'];
              }else{
                $page = 1;
              }

              //게시판 총 레코드 수
              $query_count = "SELECT * FROM notice_board";

              //실행
              $result_count = mysqli_query( $conn, $query_count);

              $rowCount = mysqli_num_rows($result_count); //게시판 총 레코드 수
              $pageCount = 10; //한 페이지에 보여줄 개수
              $blockCount = 5; //블록당 보여줄 페이지 개수

              $blockNow = ceil($page/$blockCount); // 현재 페이지 블록 구하기
              $blockStart = (($blockNow - 1) * $blockCount) + 1; // 블록의 시작번호 = (현재페이지-1 이랑 블록갯수)
              $blockEnd = $blockStart + $blockCount - 1; //블록 마지막 번호

              $pageTotal = ceil($rowCount / $pageCount); // 페이징한 페이지 수 구하기
              if($blockEnd > $pageTotal) $blockEnd = $pageTotal; //만약 블록의 끝번호가 페이지수보다 많다면 끝번호는 페이지 수
              $blockTotal = ceil($pageTotal/$blockCount); //블럭 총 개수
              $startNum = ($page-1) * $pageCount; //시작번호 (page-1)에서 $list를 곱한다.

              //한페이지에 표시될 데이터
              $query_page = "SELECT * FROM notice_board order by NBOARD_ID desc limit $startNum, $pageCount";

              //실행
              $result_page = mysqli_query( $conn, $query_page );

              //db에 등록된 row만큼 반복
              while($row = mysqli_fetch_array($result_page)){
            ?>

               <!-- 반복 시작 -->
              <tr>
                <td><?php echo $row["NBOARD_ID"]; ?></td>
                <td class="col_contents" ><a href="#"><?php echo $row["NOT_TITLE"]; ?></a></td>
                <td><?php echo $row["MEM_NAME"]; ?></td>
                <td><?php echo $row["NOT_DATE"]; ?></td>
                <td><?php echo $row["NOT_VIEWS"]; ?></td>
              </tr>
            <?php } ?>
            <!-- 반복 끝 -->
          </tbody>
        </table>
        <div class="noticeSearch">
          <select class="noticeCombo" name="">
            <option value="s1_week">일주일</option>
            <option value="s1_month1">한달</option>
            <option value="s1_month3">세달</option>
            <option value="s1_all">전체</option>
          </select>
          <select class="noticeCombo" name="">
            <option value="s2_title">제목</option>
            <option value="s2_cont">내용</option>
            <option value="s2_name">글쓴이</option>
            <option value="s2_id">아이디</option>
            <option value="s2_nick">별명</option>
          </select>
          <input type="text" name="" value="" class="notice_srch_txt">
          <a href="">찾기</a>
        </div>
        <!-- 페이징 처리 -->
        <?php

         ?>
        <div class="noticePage">
          <ul>
            <?php
            if($page <= 1) { //만약 page가 1보다 작거나 같으면
              echo "<li><<</li>"; //링크를 제거한다 !
            } else{
              echo "<li><a href='/ellpeProject/subMenu/notice.php?page=1'><<</a></li>"; //1page로 가는 링크 삽입 !
            }

            if($blockNow <= 1)
            { //만약 page가 1보다 크거나 같다면 빈값

            }else{
            $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
              echo "<li><a href='?page=$pre'><</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
            }

            for($i=$blockStart; $i<=$blockEnd; $i++){
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면
              echo "<li style='background-color: #efefef; font-weight:bold;'>$i</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
            }else{
              echo "<li><a href='?page=$i'>$i</a></li>"; //아니라면 $i
            }
          }

          if($blockNow >= $blockTotal){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li><a href='?page=$next'>></a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page > $pageTotal){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li>>></li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li><a href='?page=$pageTotal'>>></a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
            ?>

          </ul>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <!-- 푸터영역 (상대경로)-->
    <?php include "../footer.html"; ?>
  </footer>
</html>
