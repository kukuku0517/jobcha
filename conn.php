<?php
$conn = mysqli_connect('sochat2.ckfmvadoyeiu.ap-northeast-1.rds.amazonaws.com:3306','sochat','sochat123');



mysqli_select_db($conn, 'sochat');
mysqli_query($conn,"set session character_set_connection=utf8;");
mysqli_query($conn,"set session character_set_results=utf8;");
mysqli_query($conn,"set session character_set_client=utf8;");
?>