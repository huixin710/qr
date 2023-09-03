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
    include("includes/connection.php");
    session_start();
    $appid = $_SESSION['id'];
    $aid = $_GET['aid'];
    $maxpoint = $_GET['maxpoint'];
    ?>


    <style>
        :root {
            --white-color: #ffffff;
            --primary-color: #FFA600;
            --secondary-color: #0dcaf0;
            --section-bg-color: #f0f8ff;
            --custom-btn-bg-color: #FFA600;
            --social-icon-link-bg-color: #e7994f;
            --search-activity-bg-color: #FFF3DE;
        }
    </style>

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
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-12 mx-auto" style="border:3px #696969 solid;"> 
                            <?php
                                echo "<form class='custom-form contact-form' method='POST' enctype='multipart/form-data' action='adddd_prize.php?aid=$aid&maxpoint=$maxpoint'>";
                            ?> 
                            <h4 style="padding:24px 16px; " class="text-center mb-4">新增獎品</h4>
                                <br>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">獎品名稱</label>

                                        <input type="text" name="pname" class="form-control" placeholder="請輸入攤位名稱" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <label for="first-name">每人兌換次數</label>
                                        <input type="number" name="redeemcount" min="1" class="form-control" placeholder="請輸入每人兌換次數上限" oninput="value=value.replace(/^(0+)|[^\d]+/g,'')" required>


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
                                        <button style="background-color:#FFA600; padding:10px;" type="submit" name="psent" class="form-control">新增</button>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                        <?php echo "<a href='prize.php?aid=$aid&maxpoint=$maxpoint' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='　　　　返回　　　　' style='background-color:transparent;  border:none; color:white;' ></a>"; ?>
                                    </div>
                                </div>
                                <br>
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