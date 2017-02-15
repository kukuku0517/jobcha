<?php 

include 'conn.php';
session_start();

$sql="";



//searching
if(isset($_GET['key']) && $_GET['key']!="") {
    $key=$_GET['key'];
     
    $parts = explode(" ",trim($key));
    $clauses=array();
    foreach ($parts as $part){
        $clauses[]="S.`hash` LIKE '%" . $conn->real_escape_string($part) . "%'";
    }
    $clause=implode(' OR ' ,$clauses); 

$sql = "SELECT P.`id`, P.`name`, P.`likes`, P.`img`,COUNT(S.`hash`) as `hashCount` FROM `profile` P LEFT JOIN `profile_spec` S ON S.`person_id`=P.`id` WHERE ".$clause." GROUP BY P.`id`, P.`name`, P.`likes`, P.`img` ORDER BY `hashCount` DESC";
echo $sql;
}else{
    $sql = "SELECT * FROM `profile`";
    
}

$result = mysqli_query($conn, $sql);
while($row=mysqli_fetch_assoc($result)){

   

    echo "<div class=\"box_main\">
            <div class=\"profile\"  onclick=\"self.location.href='./detail.html?id=".$row['id']."'\">
            <h2>".$row['name']."</h2>
            <img id=\"profile_img\" src=\"".$row['img']."\" onerror=\"this.src='./image/default.jpg'\"></div><div>
            ";

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

    echo "</div><div> <div id=\"likes".$row['id']."\">".$row['likes']."</div>";

    $liked=array();
    if(isset($_SESSION['is_login'])){
        $sql3="SELECT * FROM profile_like_profile WHERE profile_liker =".$_SESSION['id'];
        $result3=mysqli_query($conn,$sql3);
        while($row3=mysqli_fetch_assoc($result3)){
            array_push($liked,$row3['profile_liked']);
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