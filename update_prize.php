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
        img {
            width: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
    
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
    include("includes/connection.php");
    session_start();
    $id = $_SESSION['id'];
    //$activity_id = $_GET['aid'];

    if (isset($_GET['pid'])) {
        $aid = $_GET['aid'];
        $pid = $_GET['pid'];
        $maxpoint = $_GET['maxpoint'];
    } else {
        echo "未提供活動 ID";
        exit;
    }

    if (isset($_POST['pupdata'])) {
        // 獲取表單資料
        $pname = $_POST['pname'];
        $point = $_POST['point'];
        $redeemcount = $_POST['redeemcount'];
        $select_query = "SELECT * FROM `prize` WHERE `pid`='$pid'";
        $result = mysqli_query($link, $select_query);
        $row = mysqli_fetch_assoc($result);
        date_default_timezone_set('Asia/Taipei');
        $builddatetime = date('Y-m-d H:i:s');

        $fileCount = count($_FILES['picture']['name']);
        if (!empty($_FILES['picture']['name'][0])) {
            $fileCount = count($_FILES['picture']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['picture']['error'][$i] === UPLOAD_ERR_OK) {
                    $file = $_FILES['picture']['tmp_name'][$i];
                    $dest = 'upload/' . $_FILES['picture']['name'][$i];
                    mysqli_query($link, "INSERT INTO `prize_img` (`appid`,`aid`,`pid`,`iname`,`builddatetime`) VALUES ('$id','$aid','" . $row['pid'] . "','$dest','$builddatetime')");
                    move_uploaded_file($file, $dest);
                } else {
                    echo '錯誤代碼: ' . $_FILES['picture']['error'][$i] . '<br>';
                }
            }
        }

        // 更新攤位信息
        $update_query = "UPDATE `prize` SET `pname`='$pname', `point`='$point' ,`builddatetime`='$builddatetime' WHERE `pid`='$pid'";
        $result = mysqli_query($link, $update_query);

        if ($result) {
            header("Location: update_prize.php?aid=$aid&maxpoint=$maxpoint&pid=$pid");
            exit(); // 確保在重新導向後終止程式執行
        } else {
            echo "更新时發生錯誤。";
        }
    } elseif (isset($_POST['return'])) {
        header("Location: prize.php?aid=$aid&maxpoint=$maxpoint");
    }


    $select_query = "SELECT * FROM `prize` WHERE `pid`='$pid'";
    $result = mysqli_query($link, $select_query);
    $row = mysqli_fetch_assoc($result);
    ?>

</head>

<body id="top">


    <?php
    require("includes/app_nav.php");
    ?>
    <main>
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="container">
                        <div class="col-lg-8 col-12 mx-auto" >
                            <?php
                            echo "<form class='custom-form contact-form' method='POST' enctype='multipart/form-data' action=''>";
                            ?>
                            <h4 style="padding:24px 16px; " class="text-center mb-4">修改獎品</h4>
                            <br>
                            <?php
                            $SELECTimg =  mysqli_query($link, "SELECT iid,iname FROM `prize_img` WHERE `pid`='$pid'");
                            while ($rowimg = mysqli_fetch_array($SELECTimg, MYSQLI_NUM)) {
                                echo "<img  src='$rowimg[1]'    style='height: 50%; width:50%'>";
                                echo "<a href='update_prize_img.php?iid=$rowimg[0]&aid=$aid&pid=$pid&maxpoint=$maxpoint'><input type='button' name='deimg' value='刪除'></a><br><br>";
                            }
                            ?>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label for="first-name">新的獎品名稱</label>

                                    <input type="text" name="pname" class="form-control" value="<?php echo $row['pname']; ?>" required>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label for="first-name">每人兌換次數</label>
                                    <input type="text" name="redeemcount" class="form-control" value="<?php echo $row['redeemcount']; ?>" required>


                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <label for="first-name">需要幾點</label>
                                    <select class="form-control" size="1" name="point">
                                        <?php
                                        $i = 1;
                                        while ($i <= $maxpoint) {
                                            echo "<option>$i</option>";
                                            $i++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <h5 class="text-white mb-3">活動圖片(ctrl可選擇多個)：</h5>
                                    <div class="input-group">
                                        <input type="file" name="picture[]" multiple class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button style="background-color:#FFA600; padding:15px;" type="submit" name="pupdata" class="form-control">更新</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                    <button style="background-color:#FFA600; padding:15px;" type="submit" name="return" class="form-control" >返回</button>
                                </div>
                            </div>

                        </div>
                    </div>



                    </form>

                </div>

            </div>
        </section>
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