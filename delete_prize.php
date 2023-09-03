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
    $activity_id = $_GET['aid'];
    $maxpoint = $_GET['maxpoint'];
    if (isset($_GET['pid'])) {
        $prize_id = $_GET['pid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }

    ?>

</head>

<body>
    <?php

    $select_query = "SELECT * FROM `prize` WHERE `pid`='$prize_id'";
    $result = mysqli_query($link, $select_query);
    $row = mysqli_fetch_assoc($result);


    // 刪除獎品
    $delete_query = "DELETE FROM `prize` WHERE `pid`='$prize_id'";
    $result = mysqli_query($link, $delete_query);

    if ($result) {

        header("Location: prize.php?aid=" . $row['aid'] . "&maxpoint=" . $_GET['maxpoint'] . "");
        exit();
    } else {
    ?>
        <script language="JavaScript">
            alert("刪除獎品時發生錯誤。");
        </script>
    <?php

    }
    ?>




</body>

</html>