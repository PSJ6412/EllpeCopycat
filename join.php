<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./join.css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  </head>
  <body>
    <!-- 헤더 영역 -->
    <?php include "./header.php"; ?>
    <!-- 회원가입 영역 -->
    <div id="joinBody">
      <div id="joinContent">
        <div id="register">REGISTER</div>
        <table>
          <tr>
            <th>회원구분<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="radio" name="" value="" checked> 개인회원</td>
          </tr>
          <tr>
            <th>회원인증<img src="img/ico_required_blue.gif" alt=""></th>
            <td><div><input type="radio" name="" value="" checked> 휴대폰인증</div>
                <div id="certified_Btn"><img src="img/btn_icon_mobile.gif" alt="">휴대폰인증</div>
                <div>본인 명의의 휴대폰으로 본인인증을 진행합니다.</div>
            </td>
          </tr>
        </table>

        <div class="infoTitle">기본정보</div>
        <div id="requiredGuide"><img src="img/ico_required_blue.gif" alt="">필수입력사항</div>
        <table>
          <tr>
            <th>아이디<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="text" class="memberInfo1" id="mem_id" value="" onblur="idCheck();" ></td>
          </tr>
          <tr>
            <th>비밀번호<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="password" class="memberInfo1" id="mem_pass1"</td>
          </tr>
          <tr>
            <th>비밀번호 확인<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="password" class="memberInfo1" id="mem_pass2" value="" onkeypress="passCheck();"></td>
          </tr>
          <tr>
            <th>비밀번호 확인 질문<img src="img/ico_required_blue.gif" alt=""></th>
            <td>
              <select id="pw_questions" >
                <option value="ques0" selected>기억에 남는 추억의 장소는?</option>
                <option value="ques1">자신의 인생 좌우명은?</option>
                <option value="ques2">자신의 보물 제1호는?</option>
                <option value="ques3">가장 기억에 남는 선생님 성함은?</option>
                <option value="ques4">타인이 모르는 자신만의 신체비밀이 있다면?</option>
                <option value="ques5">추억하고 싶은 날짜가 있다면?</option>
                <option value="ques6">받았던 선물 중 기억에 남는 독특한 선물은?</option>
                <option value="ques8">유년시절 가장 생각나는 친구 이름은?</option>
                <option value="ques9">인상 깊게 읽은 책 이름은?</option>
                <option value="ques10">읽은 책 중에서 좋아하는 구절이 있다면?</option>
                <option value="ques11">자신이 두번째로 존경하는 인물은?</option>
                <option value="ques12">친구들에게 공개하지 않은 어릴 적 별명이 있다면?</option>
                <option value="ques13">초등학교 때 기억에 남는 짝꿍 이름은?</option>
                <option value="ques14">다시 태어나면 되고 싶은 것은?</option>
                <option value="ques15">내가 좋아하는 캐릭터는?</option>
                </select>
              </td>
          </tr>
          <tr>
            <th>비밀번호 확인 답변<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input class="answer_Text" type="text" id="pw_answer" value=""></td>
          </tr>
          <tr>
            <th>이름<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="text" id="mem_name" value=""></td>
          </tr>
          <tr>
            <th>주소<img src="img/ico_required_blue.gif" alt=""></th>
            <td>
              <div>
                <input type="text" class="zipCode_Text" id="mem_postcode"><span class="zipCode_Search" onclick="PostcodeSearch();">우편번호</span>
              </div>
              <div>
                <input type="text" class="adress_defualt" id="mem_adress1" value="">기본주소
              </div>
              <div>
                <input type="text" class="adress_detail" id="mem_adress2" value="">상세주소
              </div>

            </td>

          </tr>
          <tr>
            <th>일반전화</th>
            <td>
              <select class="member_tel" id="mem_tel1">
                <option value="02">02</option>
                <option value="031">031</option>
                <option value="041">041</option>
                <option value="051">051</option>
                <option value="053">053</option>
                <option value="055">055</option>
              </select>
              - <input type="text" class="member_tel" id="mem_tel2" value="">
              - <input type="text" class="member_tel" id="mem_tel3" value="">
            </td>
          </tr>
          <tr>
            <th>휴대전화<img src="img/ico_required_blue.gif" alt=""></th>
            <td>
              <select class="mem_mobile1" id="mem_mobile1">
                <option value="010">010</option>
                <option value="011">011</option>
                <option value="016">016</option>
                <option value="017">017</option>
                <option value="018">018</option>
                <option value="019">019</option>
              </select>
              - <input type="text" class="member_mobile" id="mem_mobile2">
              - <input type="text" class="member_mobile" id="mem_mobile3">
            </td>
          </tr>
          <tr>
            <th>이메일<img src="img/ico_required_blue.gif" alt=""></th>
            <td><input type="text" id="member_email" name="mem_email" value=""></td>
          </tr>
        </table>

        <div class="infoTitle">추가정보</div>
        <table>
          <tr>
            <th>별명</th>
            <td><input type="text" id="mem_nickname" value=""></td>
          </tr>
          <tr>
            <th>생년월일</th>
            <td>
              <input type="text" class="member_birth" id="mem_birth1">년
              <input type="text" class="member_birth" id="mem_birth2">월
              <input type="text" class="member_birth" id="mem_birth3">일
              <input type="radio" id="Solar" name="birth" value="" checked> 양력
              <input type="radio" name="mem_birth" value=""> 음력
            </td>
          </tr>
          <tr>
            <th>추천인 아이디</th>
            <td><input type="text"></td>
          </tr>
        </table>
        <div class="termsArea">
          <div id="allCheckArea">전체동의
              <div>
                <input type="checkbox" name="accept_all"> 이용약관 및 개인정보수집 및 이용, 쇼핑정보 수신(선택)에 모두 동의합니다.
              </div>
          </div>
            <div class="TermsGfUse">
              <div class="requiredTerms">[필수] 이용약관 동의</div>
              <!-- <textarea readonly="readonly" rows="6"> -->
              <div class="accept_content">
                <p>■ 제1조(목적)</p>
                <p>이 약관은 또롱엘프 회사(전자상거래 사업자)가 운영하는 또롱엘프 사이버 몰(이하 “몰”이라 한다)에서 제공하는 인터넷 관련 서비스(이하 “서비스”라 한다)를 이용함에 있어 사이버 몰과 이용자의 권리?의무 및 책임사항을 규정함을 목적으로 합니다.</p>
                <p>※「PC통신, 무선 등을 이용하는 전자상거래에 대해서도 그 성질에 반하지 않는 한 이 약관을 준용합니다」</p>
                <p>■ 제2조(정의)</p>
                <p>①“몰” 이란 또롱엘프 회사가 재화 또는 용역(이하 “재화등”이라 함)을 이용자에게 제공하기 위하여 컴퓨터등 정보통신설비를 이용하여 재화등을 거래할 수 있도록 설정한 가상의 영업장을 말하며, 아울러 사이버몰을 운영하는 사업자의 의미로도 사용합니다.</p>
                <p>②“이용자”란 “몰”에 접속하여 이 약관에 따라 “몰”이 제공하는 서비스를 받는 회원 및 비회원을 말합니다.</p>
                <p>③ ‘회원’이라 함은 “몰”에 개인정보를 제공하여 회원등록을 한 자로서, “몰”의 정보를 지속적으로 제공받으며, “몰”이 제공하는 서비스를 계속적으로 이용할 수 있는 자를 말합니다.</p>
                <p>④ ‘비회원’이라 함은 회원에 가입하지 않고 “몰”이 제공하는 서비스를 이용하는 자를 말합니다.</p>
                <p>■ 제3조 (약관등의 명시와 설명 및 개정)</p>
                <p>① “몰”은 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를 포함), 전화번호?모사전송번호?전자우편주소, 사업자등록번호, 통신판매업신고번호, 개인정보관리책임자등을 이용자가 쉽게 알 수 있도록 00 사이버몰의 초기 서비스화면(전면)에 게시합니다. 다만, 약관의 내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.</p>
                <p>② “몰은 이용자가 약관에 동의하기에 앞서 약관에 정하여져 있는 내용 중 청약철회?배송책임?환불조건 등과 같은 중요한 내용을 이용자가 이해할 수 있도록 별도의 연결화면 또는 팝업화면 등을 제공하여 이용자의 확인을 구하여야 합니다.</p>
                <p>③ “몰”은 전자상거래등에서의소비자보호에관한법률, 약관의규제에관한법률, 전자거래기본법, 전자서명법, 정보통신망이용촉진등에관한법률, 방문판매등에관한법률, 소비자보호법 등 관련법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.</p>
                <p>④ “몰”이 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 몰의 초기화면에 그 적용일자 7일이전부터 적용일자 전일까지 공지합니다.</p>
                다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 "몰“은 개정전 내용과 개정후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.</p>
                <p>⑤ “몰”이 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간내에 ‘몰“에 송신하여 ”몰“의 동의를 받은 경우에는 개정약관 조항이 적용됩니다.</p>
                <p>⑥ 이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래등에서의소비자보호에관한법률, 약관의규제등에관한법률, 공정거래위원회가 정하는 전자상거래등에서의소비자보호지침 및 관계법령 또는 상관례에 따릅니다.</p>
              </div>
              <div>이용약관에 동의하십니까? <input type="checkbox" name="accept">동의함</div>
            </div>

            <div class="TermsGfUse">
              <div class="requiredTerms">[필수] 개인정보 수집 및 이용 동의</div>
              <!-- <textarea readonly="readonly" rows="6"> -->
              <div class="accept_content">
                <p>■ 수집하는 개인정보 항목</p>
                <p>회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다.</p>
                <p>ο 수집항목 : 이름 , 생년월일 , 성별 , 로그인ID , 비밀번호 , 비밀번호 질문과 답변 , 자택 전화번호 , 자택 주소 , 휴대전화번호 ,
                  이메일 , 직업 , 회사명 , 부서 , 직책 , 회사전화번호 , 취미 , 결혼여부 , 기념일 , 법정대리인정보 , 주민등록번호 ,
                  서비스 이용기록 , 접속 로그 , 접속 IP 정보 , 결제기록</p>
                <p>ο 개인정보 수집방법 : 홈페이지(회원가입) , 서면양식</p>
                <p>■ 개인정보의 수집 및 이용목적</p>
                <p>회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.</p>
                <p>ο 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산 콘텐츠 제공 , 구매 및 요금 결제 , 물품배송 또는 청구지 등 발송</p>
                <p>ο 회원 관리</p>
                <p>회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 연령확인 , 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인 , 고지사항 전달 ο 마케팅 및 광고에 활용
                접속 빈도 파악 또는 회원의 서비스 이용에 대한 통계</p>
              </div>
              <div>개인정보 수집 및 이용에 동의하십니까? <input type="checkbox" name="accept">동의함</div>
            </div>


            <div class="TermsGfUse">
              <div class="requiredTerms">[선택] 쇼핑정보 수신 동의</div>
              <!-- <div readonly="readonly" rows="6"> -->
              <div class="accept_content">
                <p>할인쿠폰 및 혜택, 이벤트, 신상품 소식 등 쇼핑몰에서 제공하는 유익한 쇼핑정보를 SMS나 이메일로 받아보실 수 있습니다.</p>
                <p>단, 주문/거래 정보 및 주요 정책과 관련된 내용은 수신동의 여부와 관계없이 발송됩니다.</p>
                <p>선택 약관에 동의하지 않으셔도 회원가입은 가능하며, 회원가입 후 회원정보수정 페이지에서 언제든지 수신여부를 변경하실 수 있습니다.</p>
              </div>
              <div>이메일 수신을 동의하십니까? <input type="checkbox" id="news_accept" name="accept">동의함</div>
            </div>

        </div>

        <div id="join_btn"><input type="button" onclick="member_join();" value="회원가입"></div>
    </div>
  </div>
  </body>
  <footer>
    <?php include "footer.html"; ?>
  </footer>
</html>







<script type="text/javascript">

function member_join(){

  var mem_id = $('#mem_id').val();
  var mem_pass = $('#mem_pass1').val();
  var pw_questions = $("#pw_questions option:selected").text();
  var pw_answer = $('#pw_answer').val();
  var mem_name = $('#mem_name').val();
  var mem_adress = $('#mem_adress1').val()+' '+$('#mem_adress2').val();
  var mem_tel = $('#mem_tel1').val()+'-'+$('#mem_tel2').val()+'-'+$('#mem_tel3').val();
  var mem_mobile = $('#mem_mobile1').val()+'-'+$('#mem_mobile2').val()+'-'+$('#mem_mobile3').val();
  var mem_email = $('#member_email').val();
  var mem_nickname = $('#mem_nickname').val();
  var mem_birth = $('#mem_birth1').val()+ '-' +$('#mem_birth2').val()+ '-' +$('#mem_birth3').val();
  var news_accept = $('#news_accept').is(':checked'); // name 으로 확인하기

  $.ajax({
  url:'/ellpeProject/dbConnect/joinDB.php', //request 보낼 서버의 경로
  type:'post', // 메소드(get, post, put 등)
  data:{
      'mem_id' : mem_id
    , 'mem_pass' : mem_pass
    , 'pw_questions' : pw_questions
    , 'pw_answer' : pw_answer
    , 'mem_name' : mem_name
    , 'mem_adress' : mem_adress
    , 'mem_tel' : mem_tel
    , 'mem_mobile' : mem_mobile
    , 'mem_email' : mem_email
    , 'mem_nickname' : mem_nickname
    , 'mem_birth' : mem_birth
    , 'news_accept' : news_accept

  }, //보낼 데이터

  success: function(data) {
    if(data) {
      alert("또롱엘프 회원가입 완료");
      location.href = "/ellpeProject/main.php";
   } else {
      alert("회원가입 실패");
   }

  },
  error: function(request,status,error) {
      //서버로부터 응답이 정상적으로 처리되지 못햇을 때 실행
      // alert("회원가입 실패");
      alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }

  });

}
//
// function idCheck(){}
//
// function passCheck(){}

function PostcodeSearch(){
      new daum.Postcode({
          oncomplete: function(data) {
              // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

              // 각 주소의 노출 규칙에 따라 주소를 조합한다.
              // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
              var addr = ''; // 주소 변수
              var extraAddr = ''; // 참고항목 변수

              //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
              if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                  addr = data.roadAddress;
              } else { // 사용자가 지번 주소를 선택했을 경우(J)
                  addr = data.jibunAddress;
              }

              // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
              if(data.userSelectedType === 'R'){
                  // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                  // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                  if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                      extraAddr += data.bname;
                  }
                  // 건물명이 있고, 공동주택일 경우 추가한다.
                  if(data.buildingName !== '' && data.apartment === 'Y'){
                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                  }
                  // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                 if(extraAddr !== ''){
                     extraAddr = ' (' + extraAddr + ')';
                 }
                 // 조합된 참고항목을 기본주소 뒤에 추가한다.
                  addr += extraAddr;
             }

              // 우편번호와 주소 정보를 해당 필드에 넣는다.
              document.getElementById('mem_postcode').value = data.zonecode;
              document.getElementById("mem_adress1").value = addr;
              // 커서를 상세주소 필드로 이동한다.
              document.getElementById("mem_adress2").focus();
          }
      }).open();
  }


</script>
