<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){//Q.이거 뭔지 잘 모르겠다...이 위에줄도

  var _login = function(){
      window.location.href='./login.html';
  };

  var _logout = function(){
       $.ajax({
            type:"POST",
            url:"session.php",
            data:{logout:true},
            success:function(response){
             // alert(response);
              $('#login').off('click',_logout);
              $('#login').val('로그인').on('click', _login);
              $('#user_data').text('');
            }
          });
  };

  $.ajax({
    type: "POST",
    url: "session.php",
    success: function(response){
      if(response){
        var datas = jQuery.parseJSON(response);
   //     alert(datas);
        $('#login').val('로그아웃').on('click', _logout);
       $('#user_data').text(datas.name+"님 환영합니다~");
      }else{
        $('#login').val('로그인').on('click',_login);

      }
    }

  });

    $('#add_profile2').on('click',function(){
      window.location.href='./add2.html';
    });

    $('#add_meeting').on('click',function(){
      window.location.href='./add_meeting.html';
    });

    $('#profile').on('click',function(){
      window.location.href='./profile.html';
    });


    $('#meeting').on('click',function(){
      window.location.href='./meeting.html';
    });

    $('#my_page2').on('click',function(){
      window.location.href='./my_page2.html';
    });




});

</script>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/style.css?ver=5353">
    <title>무스비...이것은 무스비...</title>
  </head>

  <header>
    <h1><a href="http://13.112.122.174/profile2.html">Job'cha!</a></h1>
    <input id="add_profile2" type="button" value="회원가입" >
    <input id="my_page2" type="button" value="내페이지" >
    <div id="user_data"></div>
    <div id="menu">
      <form action="./profile.html" method="GET">
       <input type="text" placeholder="이름검색" name="key">
       <input type="submit" value="검색">
      </form>

      <div id="temp"></div>
      <div>

        <input id="add_meeting" type="button" value="모임 추가" >
        <input id="profile" type="button" value="프로필" >
        <input id="meeting" type="button" value="모집공고">
        <input id="bulletin" type="button" value="게시판" >
        <input id="login" type="button" value="로그인" >
      </div>
    </div>
</header>
<!--  -->
