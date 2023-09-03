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
    //$id=$_SESSION['id'];

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
                            <h4 class="text-center mb-4" style="border-bottom-style: 2px  #696969 solid;">忘記密碼</h4>

                            <div class="row" style="border-top-style:2px #696969 solid; ">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <label for="first-name">電子郵件</label>
                                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="請輸入您的電子郵件找回密碼" required>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">

                                    <button type="submit" name="submail" class="form-control text-black">發送驗證信</button>
                                    <br>
                                </div>


                                <br>


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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// 假設你的資料庫連接程式碼放在這裡

if (isset($_POST["submail"])) {
    $email = $_POST['email'];

    // 執行查詢，檢查此電子郵件是否已註冊


    $mail1 = stripslashes(trim($_POST['email']));
    $sql = "SELECT `uid`,`uname`,`upw`,`mail` FROM user WHERE mail = '$email'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        // 電子郵件已註冊，發送驗證碼
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'menmenwan46@gmail.com';                     //SMTP username
            $mail->Password   = 'ahyryxxybrrqpxxw';                               //SMTP password
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('roadreport01@gmail.com', 'roadreport');
            $mail->addAddress($email);     //Add a recipient
            $mail->addReplyTo('no-reply@gmail.com', 'No reply');

            //生成驗證碼
            $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $len = strlen($str) - 1;
            $code = '';
            for ($i = 0; $i < 5; $i++) {
                $num = mt_rand(0, $len);
                $code .= $str[$num];
            }

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Reset your password";
            $mail->Body    = "請點擊以下網址進行郵件驗證：<a href='125.229.13.233/reset_password_form.php?mail=$email'>125.229.13.233/reset_password_form.php</a>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

            // 將驗證碼儲存到 session 中，以便在後續驗證中使用
            $_SESSION['reset_verification_code'] = $code;
            $_SESSION['user_mail'] = $email;
?>
            <script language="JavaScript">
                alert("寄送至電子郵件了(如未看到請翻閱垃圾郵件)");
                //window.history.back(-1)
                window.location.href = 'reset_mailcode.php?mail=<?php echo $email; ?>';
            </script>
        <?php
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        // 電子郵件未註冊
        ?>
        <script language="JavaScript">
            alert("此電子郵件尚未註冊帳號");
        </script>
<?php

    }
}

?>