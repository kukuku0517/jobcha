<?php

include 'conn.php';
session_start();

$sql_delete ="DELETE FROM `profile` WHERE `id`=".$_SESSION['id'];
$result = mysqli_query($conn, $sql_delete);

echo "한번의 잘못된 클릭은 니 아이디를 없애버리곤 하지";
session_destroy();
 ?>
