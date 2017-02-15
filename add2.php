<?php

include 'conn.php';

if(isset($_GET['login_id'],$_GET['login_pw'],$_GET['name'],$_GET['age'],$_GET['sex'],$_GET['introduce'])){

	$id=$_GET['login_id'];
	$pw=$_GET['login_pw'];
	$name = $_GET['name'];
	$age = $_GET['age'];
	$sex = $_GET['sex'];
	$introduce = $_GET['introduce'];

	$important = 0;

	//profile update
	$sql = "INSERT INTO `profile` (`id`, `name`, `age`, `sex`, `introduce`, `login_id`, `login_pw`) VALUES (NULL, '".$name."', '".$age."', '".$sex."',  '".$introduce."', '".$id."', '".$pw."')";
	$result = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);
	echo $name." is inserted";


	//profile_spec update
	$spec = array();
	$spec_num = array();


	if(isset($_GET['hash'])){


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

				$sql2="INSERT INTO `spec` (`id`, `specialty`, `nums`) VALUES (NULL, '".$value."', 0)";

				$result2 = mysqli_query($conn, $sql2);
				echo $value." is newly updated";


			}


		}

	}


	header('Location: ./profile.html');
	exit;
}else{
	echo "not working....";
}

?>
