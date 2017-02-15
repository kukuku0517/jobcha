<?php

include 'header.php';

?>

<script>
  $(document).ready(function(){
 
 	//id,pw requirements
	var reg_id = /^[a-z0-9_-]{4,12}$/; 
	var reg_pw = /^.*(?=.{6,20})(?=.*[0-9])(?=.*[a-zA-Z]).*$/; 
	/*var reg_email = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;*/

	//whether id,pw,pw_confirm satisfied the requirements
	var id_ok=0;
	var pw_ok=0;
	var pw2_ok=0;
	
	$('input[name=login_id]').keyup(function(){
		$t=$(this);
	//check if id is in right format
	  if(!reg_id.test($t.val())){
	    $t.parent().children('#id_log').text('invalid id');
	    id_ok=0;
	  }else{   
	  	//check if id already exists
	     var id_text = $t.val();
	      $.ajax({
	        type:'GET',
	        data:{'id':id_text},
	        url:'admin_id.php',
	        success:function(res){
	          if(res){     
	            $t.parent().children('#id_log').text('OK');
	            $t.parent().children('input[name=id]').val(id_text);
	             id_ok=1;
	          }else{
	            $t.parent().children('#id_log').text('already exist');
	             id_ok=0;
	          }

	        }
	   });
	  }
	});

//confirming password. separated to use this in first pw as well.
var check_pw2 = function(ths){

if(ths.val() != $('input[name=login_pw]').val()){
    ths.parent().children('#pw2_log').text('password not the same');
    pw2_ok=0;
  }else{   
    ths.parent().children('#pw2_log').text('OK');
    pw2_ok=1;
  }
};


$('input[name=login_pw]').keyup(function(){
  if(!reg_pw.test($(this).val())){
    $(this).parent().children('#pw_log').text('invalid pw');
    pw_ok=0;
  }else{
    check_pw2($('input[name=login_pw2]'));
    var pw_text = $(this).val();
    $(this).parent().children('#pw_log').text('OK');
    $(this).parent().children('input[name=pw]').val(pw_text);       
    pw_ok=1;
  }
});


$('input[name=login_pw2]').keyup(function(){
  check_pw2($(this)); 
});

//onsubmit, whether all input is right in format
var valid_form = function(){
  if(id_ok+pw_ok+pw2_ok!=3){
    alert("양식에 맞게 작성해주세요!");
    return false;
  }else{
    return true;
  }
};

$('#adds').on('submit',function(){
  return valid_form();
});


  });

</script>



  <body>


    <div class="container">
    <div id="main">

   <?php

   switch ($_GET['sub']) {

    //identifying 
   	case 0:
     	echo '<form action="./admin.php" method="GET">
              <input type="hidden" name="sub" value="1">
     	        <input type="submit" value="본인확인완료">
            </form>';
   		break;

    //id & pw
   	case 1:
   	 echo '<form id ="adds" action="./admin.php" method="GET" >
            <input type="hidden" name="sub" value="2">
            <div>아이디<input type="hidden" name="id" ><input name="login_id" type="text" placeholder="4~12자 " required><div id="id_log"></div></div>
            <div>비밀번호<input type="hidden" name="pw" ><input name="login_pw" type="password" placeholder="6자 이상, 숫자와 영문 조합 " required><div id="pw_log"></div></div>
            <div>비밀번호<input name="login_pw2" type="password" placeholder="비밀번호 확인 " required><div id="pw2_log"></div></div>
            <input id="submit1" type="submit" value="완료">
          </form>';
   	break;

    //auditory datas (name etc)
   	case 2:
   	  $login_id = $_GET['id'];
      $login_pw = $_GET['pw'];


    	echo '<form action="./admin.php" method="GET">

            <input type="hidden" name="sub" value="3">
            <input type="hidden" name="login_id" value="'.$login_id.'">
            <input type="hidden" name="login_pw" value="'.$login_pw.'">

              <div>이름 : <input type="text" name="name"></div>
              <div>나이 :<input type="text" name="age"></div>
              <div>성별 :<input type="text" name="sex"></div>
              <input type="submit" value="완료">
            </form>';
   		break;

    case 3:
      include 'conn.php';
         
      if(isset($_GET['login_id'],$_GET['login_pw'],$_GET['name'],$_GET['age'],$_GET['sex'])){

        $id=$_GET['login_id'];
        $pw=$_GET['login_pw'];
        $name = $_GET['name'];
        $age = $_GET['age'];
        $sex = $_GET['sex'];

        //profile update
        $sql = "INSERT INTO `profile` (`id`, `name`, `age`, `sex`, `login_id`, `login_pw`) VALUES (NULL, '".$name."', '".$age."', '".$sex."', '".$id."', '".$pw."')";
        $result = mysqli_query($conn, $sql);
        $id = mysqli_insert_id($conn);

        echo "success ";
        echo "<div><a href='./login.html'>로그인 하시겠습니까?</a></div>";
          
        //header('Location: ./profile.html');
        //exit;
      }else{
        echo "not working....";
      }

      break;
   	
   	default:
   		echo "something is not right";
   		break;
   }


   ?>
    </div>
      

    </div>
<?php
include 'footer.php';
?>
  </body>
</html>


