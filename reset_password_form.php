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
    $stmail = $_GET['mail'];
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
    </style>
</head>

<body id="top">
    <main>
        <?php
        include("includes/nav.php")
        ?>
        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-8 col-12 mx-auto" style="border:3px #696969 solid;">
                        <form class="custom-form contact-form" action="" method="post" role="form">
                            <h4 class="text-center mb-4" style="border-bottom-style: 2px  #696969 solid;">設定新密碼</h4>

                            <div class="row" style="border-top-style:2px #696969 solid; ">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <label for="first-name">電子郵件</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="請輸入您的新密碼" required>

                                </div>
                                <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">

                                    <button type="submit" name="submit" class="form-control text-black">確認重置</button>
                                    <br>
                                </div>





                        </form>
                    </div>
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

</body>

</html>

<?php

if (isset($_POST['submit'])) {
    $new_password = $_POST['new_password'];

    // 更新使用者的密碼
    $sql = "UPDATE user SET upw = '$new_password' WHERE mail = '$stmail'";
    $result = mysqli_query($link, $sql);

    if ($result) {

        echo "密碼修改成功！";
?>
        <script language="JavaScript">
            alert("密碼修改成功！");
            <?php
            echo "location.href='login_user.php?stmail=$stmail'";
            ?>
        </script>

    <?php
    } else {

    ?>
        <script language="JavaScript">
            alert("密碼修改失敗，請稍後再試。")
            location.href = 'reset_password_user.php';
        </script>

<?php

    }
}
?>