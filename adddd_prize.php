<?php

include("includes/connection.php");
session_start();
$appid = $_SESSION['id'];
if (isset($_GET['aid'])) {
    $aid = $_GET['aid'];
} else {
    echo "未提供活動 ID";
    exit;
}
$maxpoint = $_GET['maxpoint'];
if(isset($_POST["psent"])){
    $pname=$_POST['pname'];
    $point=$_POST['point'];

    date_default_timezone_set('Asia/Taipei');
    $builddatetime=date('Y-m-d H:i:s');
    $redeemcount=$_POST['redeemcount'];
    mysqli_query($link,"INSERT INTO `prize` (`appid`,`aid`,`pname`,`point`,`redeemcount`,`builddatetime`) VALUES ('$appid','$aid','$pname','$point','$redeemcount','$builddatetime')");

    $result=mysqli_query($link,"SELECT `pid` FROM `prize` WHERE `appid`='$appid' AND `pname`='$pname' AND `builddatetime`='$builddatetime'");
    $row = mysqli_fetch_assoc($result);

    #多個檔案
    # 取得上傳檔案數量
    $fileCount = count($_FILES['picture']['name']);

    for ($i = 0; $i < $fileCount; $i++) {
    # 檢查檔案是否上傳成功
    if ($_FILES['picture']['error'][$i] === UPLOAD_ERR_OK){
      
        # 檢查檔案是否已經存在
        if (file_exists('upload/' . $_FILES['picture']['name'][$i])){
        $dest = 'upload/' . $_FILES['picture']['name'][$i];
        mysqli_query($link,"INSERT INTO `prize_img` (`appid`,`aid`,`pid`,`iname`,`builddatetime`) VALUES ('$appid','$aid','" .$row['pid']. "','$dest','$builddatetime')");
        } else {
        $file = $_FILES['picture']['tmp_name'][$i];
        $dest = 'upload/' . $_FILES['picture']['name'][$i];
        mysqli_query($link,"INSERT INTO `prize_img` (`appid`,`aid`,`pid`,`iname`,`builddatetime`) VALUES ('$appid','$aid','" .$row['pid']. "','$dest','$builddatetime')");
        # 將檔案移至指定位置
        move_uploaded_file($file, $dest);
        }
    }else {
        echo '錯誤代碼：' . $_FILES['picture']['error'] . '<br/>';
    }
    }


?>
    <script language="JavaScript">
         location.href = 'detail_prize.php?aid=<?php echo $aid ?>?aid=<?php echo $aid ?>&pid=<?php echo $row['pid'] ?>&maxpoint=<?php echo $maxpoint ?>';
    </script>

<?php

}

?>