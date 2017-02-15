<?php

include 'conn.php';

if(empty($_GET['key']) === false ) {
$sql = "SELECT * FROM sochat_profile WHERE (tag1 LIKE \"%".$_GET['key']."%\") OR (tag2 LIKE \"%".$_GET['key']."%\") OR (tag3 LIKE \"%".$_GET['key']."%\")" ;
}else{
	
$sql = "SELECT * FROM sochat_profile";

}
$result = mysqli_query($conn, $sql);

while($row=mysqli_fetch_assoc($result)){
     

echo "<div class=\"container\">
		<a href=\"http://13.112.122.174/detail.html?id=".$row['id']."\">
			<div class=\"profile\">
				<h2>".$row['name']."</h2>
				<div>".$row['age'].$row['sex'].$row['schl'].$row['maj'].$row['loc']."</div>
				<div>#".$row['tag1']."</div>
				<div>#".$row['tag2']."</div>
				<div>#".$row['tag3']."</div>
				
			</div></a>
</div>";
}
?>