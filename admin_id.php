<?php 

include 'conn.php';

$id = $_GET['id'];

$sql = "SELECT * FROM `profile` WHERE `login_id` = \"".$id."\"";
$result = mysqli_query($conn,$sql);

if($row=mysqli_fetch_assoc($result)){
	echo false;
}else{
	echo true;
}
 ?>
