<?php 

include 'conn.php';
session_start();
$sql='';
if(isset($_GET['key']) && $_GET['key']!="") {
    $key=$_GET['key'];
    $sql = "SELECT * FROM meeeting WHERE specialty LIKE '%".$key."%'";
    echo $sql;
}else{
    $sql = "SELECT * FROM meeting";
    echo $sql;
}

$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){



echo "<div class=\"box_main\" >
        <div class=\"profile\" onclick=\"self.location.href='./meeting_detail.html?id=".$row['id']."'\">
        <h2>".$row['meeting_name']."</h2>
        <h2>".$row['project_name']."</h2>
         <img id=\"profile_img\" src=\"".$row['img']."\" onerror=\"this.src='./image/default.jpg'\"></div><div>
        ";

         
$sql2= "SELECT * FROM `meeting_spec` WHERE meeting_id='".$row['id']."'";
$result2 = mysqli_query($conn, $sql2);

    $check=true;
    while($row2=mysqli_fetch_assoc($result2)){
        if($row2['main']==1){
            echo "<span id='hash_main'>#".$row2['hash']." </span>";
        }else{
            echo "<span id='hash_sub'>#".$row2['hash']." </span>";
        }
    }

echo "</div><div><div id=\"likes".$row['id']."\">".$row['likes']."</div>
      
        ";

   $liked=array();
    if(isset($_SESSION['is_login'])){
        $sql3="SELECT * FROM profile_like_meeting WHERE person_id =".$_SESSION['id'];
        $result3=mysqli_query($conn,$sql3);
        while($row3=mysqli_fetch_assoc($result3)){
            array_push($liked,$row3['meeting_id']);
        }
    }

    if (in_array($row['id'], $liked)) {
        echo "<input style='background:red' id =\"like_btn_id".$row['id']."\" type=\"button\" value=\"좋아요 취소\" onclick=\"like_btn(".$row['id'].")\">
            </div>
        </div>";
    }else{
        echo "<input style='background:gray' id =\"like_btn_id".$row['id']."\" type=\"button\" value=\"좋아요\" onclick=\"like_btn(".$row['id'].")\">
        </div>
    </div>";

    }
    }
 ?>