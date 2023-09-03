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
	if (isset($_GET['bid'])) {
        $booth_id = $_GET['bid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }

    ?>

</head>
<body>
<?php
$select_query = "SELECT * FROM `booth` WHERE `bid`='$booth_id'";
$result = mysqli_query($link, $select_query);
$row = mysqli_fetch_assoc($result);

mysqli_query($link,"DELETE FROM `booth` WHERE `bid` = '$booth_id' ");
header("Location: booth.php?aid=$activity_id");
exit();

?>


</body>
</html>