<?php
include("includes/connection.php");
session_start();
$id = $_SESSION['id'];

if (isset($_GET['pid'])) {
    $aid = $_GET['aid'];
    $pid = $_GET['pid'];
    
} else {
    echo "未提供活動 ID";
    exit;
}
$maxpoint = $_GET['maxpoint'];
$iid = $_GET['iid'];
$SELECTimg =  mysqli_query($link, "SELECT `iname` FROM `prize_img` WHERE `iid`='$iid'");
$rowimg = mysqli_fetch_array($SELECTimg);
//echo"".$rowimg['iname']."";
unlink($rowimg['iname']); //將檔案刪除
$de_actimg = mysqli_query($link, "DELETE FROM `prize_img` WHERE `aid`='$aid' AND `pid`='$pid' AND `iid` = '$iid'");
?>
<script>
    location.href = "update_prize.php?aid=<?php echo $aid ?>&pid=<?php echo $pid ?>&maxpoint=<?php echo $maxpoint ?>";
</script>