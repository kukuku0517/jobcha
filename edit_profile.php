<?php 


include 'conn.php';
session_start();

$id=$_SESSION['id'];
$sql = "SELECT * FROM profile WHERE id=\"".$id."\"";


$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){     


$sql2= "SELECT * FROM `profile_spec` WHERE person_id='".$id."' ORDER BY `main` DESC";
$result2 = mysqli_query($conn, $sql2);

$hash_main=array();
$hash_sub=array();

while($row2=mysqli_fetch_assoc($result2)){
	if($row2['main']==1){
		array_push($hash_main,$row2['hash']);
	}else{
		array_push($hash_sub,$row2['hash']);}
}
$mainJSON=json_encode($hash_main);
$subJSON=json_encode($hash_sub);


$return = array(
	'name'=>$row['name'],
	'img'=>$row['img'],
	'age'=>$row['age'],
	"sex"=>$row['sex'],
	"hash_main"=>$hash_main,
	"hash_sub"=>$hash_sub,
	"intro"=>$row['introduce']
	);

echo json_encode($return);

}

 ?>