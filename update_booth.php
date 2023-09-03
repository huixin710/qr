<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>QR Fun!好集好禮好有趣!</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/tooplate-gotto-job.css" rel="stylesheet">


    <?php
    require("includes/app_nav.php");
    ?>
    
    <style>
        :root {
            --white-color: #ffffff;
            --primary-color: #f1c16d;
            --secondary-color: #f0670d;
            --section-bg-color: #f0f8ff;
            --custom-btn-bg-color: #FFA600;
            --social-icon-link-bg-color: #e7994f;
            --search-activity-bg-color: #FFF3DE;
        }
    </style>
    <?php


    session_start();
    $id = $_SESSION['id'];
    //$activity_id = $_GET['aid'];
    if (isset($_GET['bid'])) {
        $aid = $_GET['aid'];
        $bid = $_GET['bid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }


    include("includes/connection.php");
    if (isset($_POST['bupdata'])) {
        // 獲取表單資料
        date_default_timezone_set('Asia/Taipei');
        $builddatetime = date('Y-m-d H:i:s');
        $bname = $_POST['bname'];
        $address = $_POST['address'];
        $b_head = $_POST['b_head'];
        $introduce = $_POST['introduce'];
        $rule = $_POST['rule'];
        $select_query = "SELECT * FROM `booth` WHERE `bid`='$bid'";
        $result = mysqli_query($link, $select_query);
        $row = mysqli_fetch_assoc($result);
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

        // 更新攤位信息
        $update_query = "UPDATE `booth` SET `bname`='$bname', `address`='$address', `b_head`='$b_head', `introduce`='$introduce', `rule`='$rule',`builddatetime`='$builddatetime'  WHERE `bid`='$bid'";
        $result = mysqli_query($link, $update_query);

        if ($result) {
            echo "攤位已更新。";
            header("Location: detail_booth.php?bid=" . $bid . "");
            exit(); // 確保在重新導向後終止程式執行
        } else {
            echo "更新时發生錯誤。";
        }
    } elseif (isset($_POST['return'])) {
        header("Location: detail_booth.php?aid=$aid&bid=$bid");
    }

    $select_query = "SELECT * FROM `booth` WHERE `bid`='$bid'";
    $result = mysqli_query($link, $select_query);
    $row = mysqli_fetch_assoc($result);
    ?>
</head>

<section class="contact-section section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="col-lg-8 col-12 mx-auto" >
                    <form class="custom-form contact-form" enctype="multipart/form-data" action="" method="POST">
                        <h3 style="padding:24px 16px; " class="text-center mb-4">修改攤位</h3>
                        <br>
                        <?php
                        $SELECTimg =  mysqli_query($link, "SELECT iid,iname FROM `booth_img` WHERE `bid`='$bid'");
                        while ($rowimg = mysqli_fetch_array($SELECTimg, MYSQLI_NUM)) {
                            echo "<img  src='$rowimg[1]'    style='height: 50%; width:50%'>";

                            echo "<a href='update_booth_img.php?iid=$rowimg[0]&bid=$bid&aid=$aid'><input type='button' name='deimg' value='刪除'></a><br><br>";
                        }
                        ?>
                
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="first-name">新的攤位名稱</label>

                                <input type="text" name="bname" class="form-control" value="<?php echo $row['bname']; ?>" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="first-name">新的攤位地點</label>

                                <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="first-name">攤位負責人</label>

                                <input type="text" name="b_head" class="form-control" value="<?php echo $row['b_head']; ?>" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="message">介紹</label>

                                <textarea rows="3" class="form-control" name="introduce"><?php echo $row['introduce']; ?></textarea>
                            </div>
                            <div class="col-lg-12 col-12">
                                <label for="message">規則</label>

                                <textarea rows="6" class="form-control" name="rule"><?php echo $row['rule']; ?></textarea>
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="first-name">活動圖片(ctrl可選擇多個)</label>
                                <div class="input-group">
                                    <input type="file" name="picture[]" multiple class="form-control">
                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                <button type="submit" class="form-control" name="bupdata">更新</button><br>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                <button type="submit" name="return" class="form-control">返回</button>
                            </div>
                        </div>

                </div>
            </div>



            </form>
        </div>

    </div>

    </div>
    </div>
</section>
<br>
</main>
<footer class="site-footer ">
        <div class="site-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                    </div>
                    <div class="col-lg-4 col-12 d-flex align-items-center">
                        <p class="copyright-text">QR Fun!好集好禮好有趣!</p>
                    </div>
                    <a class="back-top-icon bi-arrow-up smoothscroll d-flex justify-content-center align-items-center" href="#top"></a>

                </div>
            </div>
        </div>
    </footer>
<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/counter.js"></script>
<script src="js/custom.js"></script>

</body>

</html>