<?php
    include("includes/connection.php");
    session_start();
    $id = $_SESSION['id'];
    if (isset($_GET['aid'])) {
        $aid = $_GET['aid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }
        $iid = $_GET['iid'];
        $SELECTimg =  mysqli_query($link,"SELECT `iname` FROM `activites_img` WHERE `iid`='$iid'");
        $rowimg = mysqli_fetch_array($SELECTimg);
        //echo"".$rowimg['iname']."";
        unlink($rowimg['iname']);//將檔案刪除
        $de_actimg = mysqli_query($link,"DELETE FROM `activites_img` WHERE `aid`='$aid' AND `iid` = '$iid'");
    ?>
    <script> location.href = "update.php?aid=<?php echo $aid?>"; </script>

