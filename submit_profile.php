<?php

include 'conn.php';
session_start();

if(isset($_SESSION['is_login'],$_GET['name'],$_GET['age'],$_GET['introduce'])){
	$id=$_SESSION['id'];
	$name = $_GET['name'];
	$age = $_GET['age'];
	$introduce = $_GET['introduce'];

	//profile update
	$sql="UPDATE `profile` SET `name`='".$name."', `age` = '".$age."', `introduce` = '".$introduce."' WHERE `id` = '".$id."'";
	$result = mysqli_query($conn, $sql);
	
	//profile_spec update
	$spec = array();
	$spec_num = array();


	if(isset($_GET['hash'])){
		$sql3 = "DELETE FROM `profile_spec` WHERE `person_id`=".$id;
		$result3=mysqli_query($conn, $sql3);


		for($i=0;$i<count($_GET['hash']);$i++){
			$sql = "INSERT INTO `profile_spec` (`id`, `person_id`, `hash`, `main`) VALUES (NULL, '".$id."', '".$_GET['hash'][$i]."', '".$_GET['hash_id'][$i]."')";
			$result = mysqli_query($conn, $sql);
		}


		foreach ($_GET['hash'] as $key => $value) {

			$sql = "SELECT * FROM spec WHERE specialty ='".$value."'";
			
			$result = mysqli_query($conn, $sql);


			if($row=mysqli_fetch_assoc($result)){  

				$sql2="UPDATE `spec` SET nums = nums+1 WHERE `specialty` ='".$value."'";

				$result2 = mysqli_query($conn, $sql2);
				echo $value." is added";

			

			}else{

				$sql2="INSERT INTO `spec` (`id`, `specialty`, `nums`) VALUES (NULL, '".$value."', 1)";

				$result2 = mysqli_query($conn, $sql2);
				echo $value." is newly updated";

			
			}


		}

	}

		
	header('Location: ./my_page.html');
	exit;
}else{
	echo "not working....";
}

?>