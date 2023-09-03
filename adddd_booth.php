<?php

if (isset($_POST["bsent"])) {
    session_start();
    $aid = $_GET['aid'];
    $maxpoint = $_GET['maxpoint'];
    include("includes/connection.php");
    mysqli_query($link, "SET NAMES UTF8");
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $id = $_SESSION['id'];
    $bname = $_POST['bname'];
    $head=$_POST['head'];
    $address = $_POST['address'];
    $introduce = $_POST['introduce'];
    $rule = $_POST['rule'];
    $builddatetime = date('Y-m-d H:i:s');

    mysqli_query($link, "INSERT INTO `booth` (`appid`,`aid`,`bname`,`b_head`,`address`,`introduce`,`rule`,`builddatetime`) VALUES ('$id','$aid','$bname','$head','$address','$introduce','$rule','$builddatetime')");

    $result = mysqli_query($link, "SELECT `bid` FROM `booth` WHERE `appid`='$id' AND `bname`='$bname' AND `builddatetime`='$builddatetime'");
    $row = mysqli_fetch_assoc($result);

    #多個檔案
    # 取得上傳檔案數量
    $fileCount = count($_FILES['picture']['name']);

    for ($i = 0; $i < $fileCount; $i++) {
        # 檢查檔案是否上傳成功
        if ($_FILES['picture']['error'][$i] === UPLOAD_ERR_OK) {
            # 檢查檔案是否已經存在
            if (file_exists('upload/' . $_FILES['picture']['name'][$i])) {

                $dest = 'upload/' . $_FILES['picture']['name'][$i];
                mysqli_query($link, "INSERT INTO `booth_img` (`appid`,`aid`,`bid`,`iname`,`builddatetime`) VALUES ('$id','$aid','" . $row['bid'] . "','$dest','$builddatetime')");
            } else {
                $file = $_FILES['picture']['tmp_name'][$i];
                $dest = 'upload/' . $_FILES['picture']['name'][$i];

                mysqli_query($link, "INSERT INTO `booth_img` (`appid`,`aid`,`bid`,`iname`,`builddatetime`) VALUES ('$id','$aid','" . $row['bid'] . "','$dest','$builddatetime')");
                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
            }
        } else {
            echo '錯誤代碼：' . $_FILES['picture']['error'] . '<br/>';
        }
    }
    //echo "<script>alert('新增成功')</script>";

?>
    <script language="JavaScript">
        location.href = 'booth.php?aid=<?php echo $aid ?>&maxpoint=<?php echo $maxpoint ?> ';

        
    </script>
<?php

}

?>