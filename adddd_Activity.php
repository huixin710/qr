<?php
if (isset($_POST["b2"])) {
    session_start();
    include("includes/connection.php");
    mysqli_query($link, "SET NAMES UTF8");
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    # 取得日期與時間（新時區）
    $id = $_SESSION['id'];
    $aname = $_POST['aname'];
    $address = $_POST['address'];
    $head = $_POST['head'];
    $rule = $_POST['rule'];
    $maxpoint = $_POST['maxpoint'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $builddatetime = date('Y-m-d H:i:s');

    mysqli_query($link, "INSERT INTO `activites` (`appid`,`aname`,`address`,`head`,`rule`,`maxpoint`,`startdatetime`,`enddatetime`,`builddatetime`) VALUES ('$id','$aname','$address','$head','$rule','$maxpoint','$startdate','$enddate','$builddatetime')");

    $result = mysqli_query($link, "SELECT `aid`,`maxpoint` FROM `activites` WHERE appid='$id' AND aname='$aname' AND builddatetime='$builddatetime'");
    $row = mysqli_fetch_assoc($result);
    #多個檔案
    # 取得上傳檔案數量
    $fileCount = count($_FILES['picture']['name']);
    for ($i = 0; $i < $fileCount; $i++) {
        # 檢查檔案是否上傳成功
        if ($_FILES['picture']['error'][$i] === UPLOAD_ERR_OK) {


            # 檢查檔案是否已經存在
            if (file_exists('upload/' . $_FILES['picture']['name'][$i])) {
                //echo "<script>alert('檔案已存在')</script>";

                $dest = 'upload/' . $_FILES['picture']['name'][$i];
                //echo"<img src='$dest'>";//印出圖片$dest是檔案名稱
                mysqli_query($link, "INSERT INTO `activites_img` (`appid`,`aid`,`iname`,`builddatetime`) VALUES ('$id','" . $row['aid'] . "','$dest','$builddatetime')");
            } else {
                $file = $_FILES['picture']['tmp_name'][$i];
                $dest = 'upload/' . $_FILES['picture']['name'][$i];
                //echo"<img src='$dest'>";//印出圖片$dest是檔案名稱
                mysqli_query($link, "INSERT INTO `activites_img` (`appid`,`aid`,`iname`,`builddatetime`) VALUES ('$id','" . $row['aid'] . "','$dest','$builddatetime')");
                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
            }
        } else {
            echo "<script>alert('錯誤代碼')</script>";
        }
    }

    //echo "<script>alert('新增成功')</script>";
    $result = mysqli_query($link, "SELECT `aid`,`maxpoint` FROM `activites` WHERE appid='$id' AND aname='$aname' AND builddatetime='$builddatetime'");
    $row = mysqli_fetch_assoc($result);
?>
    <script language="JavaScript">
        location.href = "detailed.php?aid=<?php echo $row['aid'] ?> ";
    </script>
<?php

}

?>