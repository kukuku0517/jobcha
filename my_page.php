<?php

include 'conn.php';
session_start();

//only login can access my_page
if(isset($_SESSION['is_login'])){
	$sql ="SELECT * FROM `profile` WHERE `id`=".$_SESSION['id'];
	$result = mysqli_query($conn, $sql);

	while($row=mysqli_fetch_assoc($result)){
		echo "<div class=\"box\" >
		        <div class=\"profile\" >
		        <h3>내 페이지</h3>
		        <h2>".$row['name']."</h2>
		          <img id=\"profile_img\" src=\"".$row['img']."\" onerror=\"this.src='./image/default.jpg'\"></div><div>
		        <div>나이 :".$row['age']."</div>
		        <div>성별 :".$row['sex']."</div>
		        <div>";

		//about hash tags
		$sql2= "SELECT * FROM `profile_spec` WHERE person_id='".$row['id']."' ORDER BY `main` DESC";
		$result2 = mysqli_query($conn, $sql2);

		$check=true;
		while($row2=mysqli_fetch_assoc($result2)){
			if($row2['main']==1){
				echo "<span id='hash_main'>#".$row2['hash']." </span>";
			}else{
				if(check){
				echo"</div><div>";
				$check=false;
				}
				echo "<span id='hash_sub'>#".$row2['hash']." </span>";
			}
		}


		echo "</div><div>좋아하는미팅 :";
		$sql2= "SELECT * FROM `profile_like_meeting` WHERE person_id='".$row['id']."'";
		$result2 = mysqli_query($conn, $sql2);

		while($row2=mysqli_fetch_assoc($result2)){
			$sql = "SELECT id,project_name,meeting_name FROM meeting WHERE id='".$row2['meeting_id']."'";
			$result3 = mysqli_query($conn, $sql);

			while($row3=mysqli_fetch_assoc($result3)){
				echo "<div id=\"datas_liked\" onclick=\"self.location.href='./meeting_detail.html?id=".$row3['id']."'\">".$row3['project_name']." - ".$row3['meeting_name']."</div>";
			}
		}

		//people liked(3)
		$sql3="SELECT * FROM `profile_like_profile` WHERE `profile_liker` = ".$row['id'];
		$result3 = mysqli_query($conn, $sql3);

		echo "</div><div>내가 좋아요 누른사람 :";

		while($row3=mysqli_fetch_assoc($result3)){
			//profile of people liked(4)
			$sql4="SELECT * FROM `profile` WHERE `id` =".$row3['profile_liked'];
			$result4 = mysqli_query($conn, $sql4);

			while($row5=mysqli_fetch_assoc($result4)){
				echo "<div id=\"datas_liked\" onclick=\"self.location.href='./detail.html?id=".$row5['id']."'\">".$row5['name']."</div>";
			}
		}

		//people liked(3)
$sql4="SELECT * FROM `profile_pf` WHERE `person_id` = '".$row['id']."'";
$result4 = mysqli_query($conn, $sql4);

echo "</div><div>내포폴 :";

while($row4=mysqli_fetch_assoc($result4)){

		echo "<div id=\"datas_liked\" >".$row4['pf_name'].$row4['pf_desc']."</div>";

		$sql5= "SELECT * FROM `profile_pf_image` WHERE `pf_id` = '".$row4['id']."'";
		$result5=mysqli_query($conn,$sql5);

		while($row5=mysqli_fetch_assoc($result5)){
			echo $row['image'];
			echo "<img src=\"".$row5['image']." \" >";

		}
}


//people liked(3)
$sql4="SELECT * FROM `profile_career` WHERE `person_id` = '".$row['id']."'";
$result4 = mysqli_query($conn, $sql4);

echo "</div><div>내경력 :";

while($row4=mysqli_fetch_assoc($result4)){

		echo "<div id=\"datas_liked\" >".$row4['comp_name'].$row4['comp_desc']."</div>";

}


		echo "</div>
		        <div>자기소개 : ".$row['introduce']."</div>
		     </div>
		     <input type=\"button\" id=\"edit_profile\" value=\"수정 \">
				 <input type=\"button\" id=\"delete_my_page\" value=\"회원탈퇴 \">
		</div>";

	}

}else{
header('Location: ./login.html');
exit;

}

 ?>
