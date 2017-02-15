<?php 

session_start();

//if session exists
if(isset($_SESSION['is_login'])){
	
	//if req is logout
	if(isset($_POST['logout'])){
		echo 'aaaa';
		session_destroy();
		exit;
	}
echo '{"id":"'.$_SESSION['id'].'", "name":"'.$_SESSION["name"].'"}';
}

?>