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
                                    <label for="first-name">電子郵件</label>

                                    <input type="text" name="stmail" class="form-control" placeholder="請輸入您的電子郵件" required>
                                </div>


                            </div>


                            <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">

                                <button type="submit" class="form-control text-black" name="substmail">發送驗證信</button>
                                <br>
                            </div>
                    </div>
                </div>
                </form>



            </div>

        </section>


        <?php
        if (isset($_POST["substmail"])) {
            //Create an instance; passing `true` enables exceptions
            $stmail = new PHPMailer(true);
            try {
                //Server settings

                $stmail->isSMTP();                                            //Send using SMTP
                $stmail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $stmail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $stmail->Username   = 'a0982556324@gmail.com';                     //SMTP username
                $stmail->Password   = 'ceqtrjcvmvcgouvs';                               //SMTP password
                $stmail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $stmail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $stmail->setFrom('roadreport01@gmail.com', 'roadreport');
                $stmail->addAddress("" . $_POST['stmail'] . "");     //Add a recipient
                $stmail->addReplyTo('no-reply@gmail.com', 'No reply');

                //字符组合
                $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                $len = strlen($str) - 1;
                $code = '';
                for ($i = 0; $i < 5; $i++) {
                    $num = mt_rand(0, $len);
                    $code .= $str[$num];
                }
                //echo $randstr;
                //Content
                $stmail->isHTML(true);                                  //Set email format to HTML
                $stmail->Subject = "Member Registration";
                $stmail->Body    = "請點擊以下網址進行郵件驗證：<a href='125.229.13.233/register_user.php?stmail=" . $_POST['stmail'] . "'>125.229.13.233/register_user.php</a>";
                $stmail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $stmail->send();
        ?>
                <script language="JavaScript">
                    alert("寄送至電子郵件了(如未看到請翻閱垃圾郵件)");
                    //window.history.back(-1)
                    <?php
                    echo "location.href='register_usercode.php?stmail=" . $_POST['stmail'] . "'";
                    //echo "<a href='add_booth.php?aid=" . $row['aid'] ."&maxpoint=". $row['maxpoint'] ."'>新增攤位</a><br>";
                    //echo"<a href='register_usercode.php?code=$code'></a>";
                    ?>
                    //location.href="register_user.php";
                </script>
        <?php
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$stmail->ErrorInfo}";
            }
        }

        /*if(isset($_POST["subcode"])) {
                $code=$_GET['code'];
                if($_POST['code']==$code){
                ?>
                <script language="JavaScript">
                    alert("驗證碼正確");
                    location.href="register_user.php";
                </script>
                
    <?php
                }
            }*/
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