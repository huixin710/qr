<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
    session_start();
    $code = $_GET['code'];
    $appmail = $_GET['appmail'];
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
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

        .happy {
            width: 400px;
            margin: 50px auto;
            /*border: solid 1px gray;*/
            overflow: hidden;
            /* 避免長方框下面顯示不正常 */
        }

        .bdcard {
            width: 40px;
            float: left;
            /* 圖片在左邊 */
            padding: 20px;
        }

        .bdcard img {
            display: block;
            width: 100%;
        }

        .bdtext {
            float: right;
            /* 文字在右邊 */
            width: 300px;
            height: 100%;
            padding: 20px 20px 0px 0px;
        }
    </style>

</head>

<?php
require("includes/nav.php");
?>
<main>

    <section class="contact-section section-padding">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-8 col-12 mx-auto" style="border:3px #696969 solid;">
                    <form class="custom-form contact-form" action="" method="post" role="form">
                        <h4 class="text-center mb-4" style="border-bottom-style: 2px  #696969 solid;">會員註冊</h4>

                        <div class="row" style="border-top-style:2px #696969 solid; ">
                            <div class="col-lg-12 col-md-12 col-12">

                                <div class="happy">
                                    <div class="bdcard">
                                        <img src="images/important-svgrepo-com.svg" style="height:40px; width:40px;">
                                    </div>
                                    <div class="bdtext">
                                        <p>請到信箱查看驗證信......</p>

                                    </div>
                                </div>


                            </div>


                        </div>


                        <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">

                            <!--<button type="submit" class="form-control text-black" name="subcode">確認</button>-->
                            <br>
                        </div>
                </div>
            </div>
            </form>



        </div>

    </section>
    <?php

    if (isset($_POST["subcode"])) {
        $code = $_GET['code'];
        if ($_POST['code'] == $code) {
    ?>
            <script language="JavaScript">
                alert("驗證碼正確");
                <?php
                echo "location.href='register_admin.php?appmail=$appmail'";
                ?>
                //location.href="register_user.php";
            </script>

    <?php
        }
    }
    ?>

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