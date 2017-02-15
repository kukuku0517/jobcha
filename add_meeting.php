<?php

include 'conn.php';

session_start();

if(!isset($_SESSION['is_login'])){
	header('Location: ./login.html');
	exit;

}else if(isset($_GET['project_name'],$_GET['meeting_name'],$_GET['time'],$_GET['introduce'])){

	$p_name =$_GET['project_name'];
	$m_name= $_GET['meeting_name'];
	$time= $_GET['time'];
	$intro = $_GET['introduce'];
	$l_id = $_SESSION['id'];
	$l_name = $_SESSION['name'];
	$important = 0;

	//profile update
	$sql = "INSERT INTO `meeting` (`id`, `meeting_name`, `project_name`, `time`, `leader_id`, `leader_name`, `intro`) VALUES (NULL, '".$m_name."', '".$p_name."', '".$time."', '".$l_id."','".$l_name."', '".$intro."');";
	$result = mysqli_query($conn, $sql);
	$id = mysqli_insert_id($conn);

	//profile_spec update
	$spec_main = array();
	$spec_sub = array();

	for($i=0;$i<4;$i++){
		if(isset($_GET['specialty_main'.$i])){
			array_push($spec_main, $_GET['specialty_main'.$i]);
		}
		if(isset($_GET['specialty_sub'.$i])){
			array_push($spec_sub, $_GET['specialty_sub'.$i]);
		}
	}

	if(isset($_GET['hash'])){


		for($i=0;$i<count($_GET['hash']);$i++){
			$sql = "INSERT INTO `meeting_spec` (`id`, `meeting_id`, `hash`, `main`) VALUES (NULL, '".$id."', '".$_GET['hash'][$i]."', '".$_GET['hash_id'][$i]."')";
			$result = mysqli_query($conn, $sql);
		}


		foreach ($_GET['hash'] as $key => $value) {

			$sql = "SELECT * FROM spec WHERE specialty ='".$value."'";
			
			$result = mysqli_query($conn, $sql);


			if($row=mysqli_fetch_assoc($result)){  

				$sql="UPDATE spec SET nums = nums+1 WHERE specialty ='".$value."'";

				$result = mysqli_query($conn, $sql);
			
			

			}else{

				$sql="INSERT INTO `spec` (`id`, `specialty`, `nums`) VALUES (NULL, '".$value."', 0)";

				$result = mysqli_query($conn, $sql);
				echo $value." is newly updated";

			
			}


		}

	}

	header('Location: ./meeting.html');
	exit;
}else{
	echo "not working....";
}

?>