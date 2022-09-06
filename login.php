<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>❤로그인</title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
  </head>
  <body>
    <!-- 헤더 영역 -->
    <?php include "header.php"; ?>
    <!-- 로그인 영역 -->
    <div class="loginArea">
      <div class="loginPos">
        <div class="login-Top">
          <p id="top1">Registered Customers</p>
          <p id="top2">가입하신 아이디와 패스워드를 입력해주세요.</p>
        </div>
        <div class="login-Mid">
          <input type="text" id="login_id"><!--로그인-->
          <input type="text" id="login_pw"><!--비밀번호-->
          <div id= "check"><input type="checkbox" name="" value="">아이디 저장</div>
          <div id= "access"><img src="img/ico_access.gif" alt="">보안접속</div>
          <div class="loginBtn">
            <button type="button" name="button" onclick="login();">로그인</button>
          </div>
          <div id="loginSrch">
            <a href="">아이디찾기</a>|<a href="">비밀번호찾기</a>
          </div>
        </div>
        <div class="login-Bot">
          <div id="bot1">
            <p>회원가입을 하시면</p>
            <p>다양하고 특별한 혜택을 이용할수 있습니다.</p>
          </div>
          <div id="bot2">
            <button type="button" name="button">회원가입</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  <footer>
    <?php include "footer.html"; ?>
  </footer>
</html>
<script type="text/javascript">

  function login(){
      var login_id = $('#login_id').val();
      var login_pass = $('#login_pw').val();

      $.ajax({
      url:'/ellpeProject/dbConnect/loginDB.php', //request 보낼 서버의 경로
      type:'post', // 메소드(get, post, put 등)
      data:{
        'id' : login_id ,
        'pass' : login_pass
      }, //보낼 데이터
      dataType:"json",
      success: function(response) {
        //메세지 출력
        //성공이면 메인페이지로 이동
        alert(response.message);

        if(response.result == 1) {
          window.location.href = "/ellpeProject/main.php";
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
