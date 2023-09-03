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
  
        img {
            width: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body id="top">
    <?php
    require("includes/app_nav.php");
    ?>
    <?php
    include("includes/connection.php");
    session_start();
    $id = $_SESSION['id'];
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    if (isset($_GET['aid'])) {
        $activity_id = $_GET['aid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }

    if (isset($_POST['updata'])) {
        // 獲取表單資料
        $aname = $_POST['aname'];
        $head = $_POST['head'];
        $address = $_POST['address'];
        $maxpoint = $_POST['maxpoint'];
        $rule = $_POST['rule'];
        $startdatetime = $_POST['startdatetime'];
        $enddatetime = $_POST['enddatetime'];
        # 取得日期與時間（新時區）
        $builddatetime = date('Y-m-d H:i:s');
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
                    //echo "<img src='$dest'>"; //印出圖片$dest是檔案名稱
                    mysqli_query($link, "INSERT INTO `activites_img` (`appid`,`aid`,`iname`,`builddatetime`) VALUES ('$id','$activity_id','$dest','$builddatetime')");
                } else {
                    $file = $_FILES['picture']['tmp_name'][$i];
                    $dest = 'upload/' . $_FILES['picture']['name'][$i];
                    //echo "<img src='$dest'>"; //印出圖片$dest是檔案名稱
                    mysqli_query($link, "INSERT INTO `activites_img` (`appid`,`aid`,`iname`,`builddatetime`) VALUES ('$id','$activity_id','$dest','$builddatetime')");
                    # 將檔案移至指定位置
                    move_uploaded_file($file, $dest);
                }
            } else {
                echo "<script>alert('錯誤代碼')</script>";
            }
        }

        // 更新活動信息
        $update_query = "UPDATE `activites` SET `aname`='$aname',`head`='$head', `address`='$address', `maxpoint`='$maxpoint', `rule`='$rule', `startdatetime`='$startdatetime', `enddatetime`='$enddatetime' WHERE `aid`='$activity_id'";
        $result = mysqli_query($link, $update_query);

        if ($result) {
            //echo "活動已更新。";
            header("Location: detailed.php?aid=$activity_id");
            exit(); // 確保在重新導向後終止程式執行
        } else {
            echo "<script>alert('錯誤代碼')</script>";
        }
    } elseif (isset($_POST['return'])) {
        header("Location: detailed.php?aid=$activity_id");
    }


    // 查詢活動訊息
    $select_query = "SELECT * FROM `activites` WHERE `aid`='$activity_id'";
    $result = mysqli_query($link, $select_query);
    $row = mysqli_fetch_assoc($result);


    ?>
    <main>
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="container">
                        <div class="col-lg-8 col-12 mx-auto">
                            <form class="custom-form contact-form" enctype="multipart/form-data" action="" method="POST">
                                <h3 style="padding:24px 16px; " class="text-center mb-4">修改活動</h3>
                                <br>
                                <?php
                                $SELECTimg =  mysqli_query($link, "SELECT `iid`,`iname` FROM `activites_img` WHERE `aid`='$activity_id'");
                                while ($rowimg = mysqli_fetch_array($SELECTimg)) {
                                    echo "<img  src='$rowimg[1]'    style='height: 50%; width:50%'>";
                                    echo "<a href='update_Activity_img.php?iid=$rowimg[0]&aid=$activity_id'><input type='button' name='deimg' value='刪除'></a><br>";
                                }
                                ?>


                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">新的活動名稱</label>

                                        <input type="text" name="aname" class="form-control" value="<?php echo $row['aname']; ?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">新的活動地點</label>

                                        <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">活動負責人</label>

                                        <input type="text" name="head" class="form-control" value="<?php echo $row['head']; ?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">點數最大值</label>
                                        <input type="number" name="maxpoint" min="1" class="form-control" value="<?php echo $row['maxpoint']; ?>">
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <label for="message">規則</label>

                                        <textarea rows="6" class="form-control" name="rule"><?php echo $row['rule']; ?></textarea>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">活動開始時間</label>

                                        <input type="datetime-local" name="startdatetime" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['startdatetime'])); ?>" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">活動結束時間</label>

                                        <input type="datetime-local" name="enddatetime" class="form-control" value="<?php echo date('Y-m-d\TH:i', strtotime($row['enddatetime'])); ?>" required>
                                    </div>
                                    <div class="col-lg-12 col-12">
                                        <label for="first-name">活動圖片(ctrl可選擇多個)</label>
                                        <div class="input-group">
                                            <input type="file" name="picture[]" multiple class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                        <button style="background-color:#FFA600; padding:15px;" type="submit" class="form-control" name="updata">更新</button><br>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                        <button style="background-color:#FFA600; padding:15px;" type="submit" name="return" class="form-control">返回</button>
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