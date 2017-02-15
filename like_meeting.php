<?php 	

include 'conn.php';

session_start();
//if logged in
if(isset($_SESSION['id'])){

	$p_id=$_SESSION['id'];
	$m_id=$_POST['m_id'];

	//check if person already liked
	$sql ="SELECT * FROM profile_like_meeting WHERE person_id =".$p_id." AND meeting_id =".$m_id;
	$result=mysqli_query($conn, $sql);
	if($row=mysqli_fetch_assoc($result)){

		//minus profile_like_meeting
		$sql = "DELETE FROM `profile_like_meeting` WHERE  person_id =".$p_id." AND meeting_id =".$m_id;
		$result = mysqli_query($conn, $sql);

		//update number of likes
		$sql=" UPDATE meeting SET likes = likes - 1 WHERE id = ".$m_id;
		$result = mysqli_query($conn, $sql);

		//get the number of likes
		$sql ="SELECT likes FROM meeting WHERE id =".$m_id;
		$result = mysqli_query($conn, $sql);

		while($row=mysqli_fetch_assoc($result)){
			echo '{"cancel":true, "suc":true,"like":"'.$row['likes'].'"}';
		}

	}else{

		//plus profile_like_meeting
		$sql ="INSERT INTO `profile_like_meeting` (`id`, `person_id`, `meeting_id`) VALUES (NULL, '".$p_id."', '".$m_id."')";
		$result = mysqli_query($conn, $sql);

		//update number of likes
		$sql=" UPDATE meeting SET likes = likes + 1 WHERE id = ".$m_id;
		$result = mysqli_query($conn, $sql);

		//get the number of likes
		$sql ="SELECT likes FROM meeting WHERE id =".$m_id;
		$result = mysqli_query($conn, $sql);

		while($row=mysqli_fetch_assoc($result)){
			echo '{"cancel":false,"suc":true,"like":"'.$row['likes'].'"}';
		}
	}
	



}else{
	header('Location','.profile.html');
	exit;
}


 ?>