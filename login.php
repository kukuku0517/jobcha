<?php 
include 'conn.php';

if(isset($_POST['id'],$_POST['pw'])) {

$id=$_POST['id'];
$pw=$_POST['pw'];

$sql = "SELECT * FROM profile WHERE login_id=\"".$id."\"";

$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){     

if($row['login_pw']==$pw){
	session_start();
	$_SESSION['is_login']=true;
	$_SESSION['id']=$row['id'];
	$_SESSION['name']=$row['name'];
	header('Location: ./profile.html');
	exit;
}else{
	echo "login fail";
}

}
}
 ?>