<?php
include 'conn.php';

if(isset($_GET['id'])) {
	//get all the meetings(1)
	$sql = "SELECT * FROM meeting WHERE id=\"".$_GET['id']."\"";
	$result = mysqli_query($conn, $sql);

	//for every meetings(1)
	while($row=mysqli_fetch_assoc($result)){     

		$spec_main=array();
		$spec_sub=array();
		
		echo "<div class=\"box\" >
		        <div class=\"profile\" >
		        <h2>".$row['project_name']."</h2>
		        <div>팀명 :".$row['meeting_name']."</div>
		        <img id=\"profile_img\" src=\"".$row['img']."\" onerror=\"this.src='./image/default.jpg'\"></div><div>
        
		        <div>프로젝트시간 :".$row['time']."</div>
		        <div>프로젝트설명 :".$row['intro']."</div>
		        <div>프로젝트모집자 : </div>
		        <div id=\"datas_liked\" onclick=\"self.location.href='./detail.html?id=".$row['leader_id']."'\">".$row['leader_name']."</div>
		        <div>해시태그 :";
	
		$sql2= "SELECT * FROM `meeting_spec` WHERE meeting_id='".$row['id']."' ORDER BY `main` DESC";
		$result2 = mysqli_query($conn, $sql2);
		$check=true;
		while($row2=mysqli_fetch_assoc($result2)){
		if($row2['main']==1){
			echo "<span id='hash_main'>#".$row2['hash']." </span>";
		}else{
			
			echo "<span id='hash_sub'>#".$row2['hash']." </span>";
		}
	}


		//people liked(3)
		$sql3="SELECT * FROM `profile_like_meeting` WHERE `meeting_id` = ".$row['id'];	
		$result3 = mysqli_query($conn, $sql3);

		echo "</div><div>좋아요 누른사람 :";

		while($row3=mysqli_fetch_assoc($result3)){

			//profile of people liked(4)
			$sql4="SELECT * FROM `profile` WHERE `id` =".$row3['person_id'];
			$result4 = mysqli_query($conn, $sql4);

			while($row5=mysqli_fetch_assoc($result4)){
				echo "<div id=\"datas_liked\" onclick=\"self.location.href='./detail.html?id=".$row5['id']."'\">".$row5['name']."</div>";
			}
		}


		echo "</div>
		        <input type=\"button\" value=\"좋아요\" >
		    </div>
		</div>";

	}
}


?>