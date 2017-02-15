<?php

include 'conn.php';
session_start();

$sql_delete ="DELETE FROM `profile` WHERE `id`=".$_SESSION['id'];
$result = mysqli_query($conn, $sql_delete);

echo " deleted";
session_destroy();
 ?>
