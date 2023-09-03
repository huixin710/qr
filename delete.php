<!DOCTYPE html>
<html lang="en">

<head>
    <title>Read Only by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />

    <?php
    include("includes/connection.php");
    session_start();
    $appid = $_SESSION['id'];
	//$aid = $_GET['aid'];
    ?>

</head>
<body>
<?php

    if (isset($_GET['aid'])) {
        $activity_id = $_GET['aid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }
    // 先刪除相關的攤位記錄
   // $delete_booth_query = "DELETE FROM `booth` WHERE `appid` = $activity_id";
    //$booth_result = mysqli_query($link, $delete_booth_query);

    // 刪除活動記錄
    $delete_activity_query = "DELETE FROM `activites` WHERE `aid` = $activity_id";
    $activity_result = mysqli_query($link, $delete_activity_query);

    if ($activity_result) {
        header("Location: history_test.php");
        exit();
        
    } else {
        echo "刪除活動時發生錯誤。";
    }

    
    
?>

	
	

</body>
</html>