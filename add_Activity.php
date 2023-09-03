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
    $id = $_SESSION['id'];
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $today = date('Y-m-d H:i:s');
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
                                <form class="custom-form contact-form" enctype="multipart/form-data" action="adddd_Activity.php" method="POST">
                                    <h4 style="padding:24px 16px; " class="text-center mb-4">新增活動</h4>
                                    <br>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">活動名稱</label>

                                            <input type="text" name="aname" class="form-control" placeholder="請輸入活動名稱" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">活動地點</label>

                                            <input type="text" name="address" class="form-control" placeholder="請輸入活動地點" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">活動負責人</label>

                                            <input type="text" name="head" class="form-control" placeholder="請輸入負責人" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">點數最大值</label>
                                            <input type="number" name="maxpoint" min="1" class="form-control" placeholder="請輸入點數最大值" oninput="value=value.replace(/^(0+)|[^\d]+/g,'')" required>
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <label for="message">規則</label>

                                            <textarea rows="6" class="form-control" name="rule" placeholder="請輸入活動規則"></textarea>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">活動開始時間</label>

                                            <input type="datetime-local" name="startdate" min="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <label for="first-name">活動結束時間</label>

                                            <input type="datetime-local" name="enddate" min="<?php echo date('Y-m-d\TH:i'); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-12 col-12">
                                            <label for="first-name">活動圖片(ctrl可選擇多個)</label>
                                            <div class="input-group">
                                                <input type="file" name="picture[]" multiple class="form-control">
                                            </div>

                                        </div>
                                        <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                            <button type="submit" name="b2" class="form-control">新增</button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                            <button type="submit" onclick="location.href='app_home.php'" class="form-control">返回</button>

                                        </div>
                                    </div>
                                    <br>
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