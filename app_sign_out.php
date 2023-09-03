<?php
session_start();
session_destroy();

//清除cookie，將過期時間定為之前的時間即可清除
setcookie ( "name", "", time () - 100 ); //將時間設定成過去的時間

echo'<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

echo"<script language='JavaScript'>";


echo"location.href='index.php';";
echo"</script>";
?>
 