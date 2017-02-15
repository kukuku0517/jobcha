<?php

include 'conn.php';


$sql_delete ="DELETE FROM `profile` WHERE `id`=".$_SESSION['id'];
$result_delete = mysqli_query($conn, $sql4);


 ?>
