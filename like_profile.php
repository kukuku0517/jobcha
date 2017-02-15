<?php 	

include 'conn.php';

session_start();
//if logged in
if(isset($_SESSION['id'])){

	$p_id=$_SESSION['id'];
	$t_id=$_POST['t_id'];

	//check if person already liked
	$sql ="SELECT * FROM profile_like_profile WHERE profile_liker =".$p_id." AND profile_liked =".$t_id;
	$result=mysqli_query($conn, $sql);
	if($row=mysqli_fetch_assoc($result)){

		//minus profile_like_meeting
		$sql = "DELETE FROM `profile_like_profile` WHERE  profile_liker =".$p_id." AND profile_liked=".$t_id;
		$result = mysqli_query($conn, $sql);

		//update number of likes
		$sql=" UPDATE profile SET likes = likes - 1 WHERE id = ".$t_id;
		$result = mysqli_query($conn, $sql);

		//get the number of likes
		$sql ="SELECT likes FROM profile WHERE id =".$t_id;
		$result = mysqli_query($conn, $sql);

		while($row=mysqli_fetch_assoc($result)){
			echo '{"cancel":true,"suc":true,"like":"'.$row['likes'].'"}';
		}

	}else{

		//plus profile_like_meeting
		$sql ="INSERT INTO `profile_like_profile` (`id`, `profile_liker`, `profile_liked`) VALUES (NULL, '".$p_id."', '".$t_id."')";
		$result = mysqli_query($conn, $sql);

		//update number of likes
		$sql=" UPDATE profile SET likes = likes + 1 WHERE id = ".$t_id;
		$result = mysqli_query($conn, $sql);

		//get the number of likes
		$sql ="SELECT likes FROM profile WHERE id =".$t_id;
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