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
   
    <!--

Tooplate 2134 Gotto Job

https://www.tooplate.com/view/2134-gotto-job

Bootstrap 5 HTML CSS Template

-->


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
    if(isset($_GET['appid']) && isset($_GET['aid']) && isset($_GET['bid'])){
        $appid = $_GET['appid'];
        $aid = $_GET['aid'];
        $bid = $_GET['bid'];
    }
    ?>
    <main>

        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-8 col-12 mx-auto" style="border:3px #696969 solid;">
                        <form class="custom-form contact-form" action="login_action_user.php" method="post" role="form">
                            <h4 class="text-center mb-4" style="border-bottom-style: 2px  #696969 solid;">會員登入</h4>
                            <?php
                                    if(isset($_GET['appid']) && isset($_GET['aid']) && isset($_GET['bid'])){
                                        echo"<input type='hidden' name='appid' value=$appid>";
                                        echo"<input type='hidden' name='aid' value=$aid>";
                                        echo"<input type='hidden' name='bid' value=$bid>";
                                    }
                                ?>
                            <div class="row" style="border-top-style:2px #696969 solid; ">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <label for="first-name">帳號</label>

                                    <input type="text" name="uid" class="form-control" placeholder="請輸入您的帳號" required>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <label> 密碼</label>

                                    <input type="password" id="pw" name="pw" class="form-control" autocomplete="off" maxlength="20" placeholder="8-20碼英文數字（英文區分大小寫）" />
                                    <input type="hidden" id="pwdHidden" name="pwdHidden" />

                                    </input>

                                </div>

                            </div>
                            <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">
                                <label class="msg_box2">
                                    <input type="checkbox" onclick="showPW('#pw')" />
                                    <span class="checkmark"></span>
                                    <span style="vertical-align: top; color: #666 !important">顯示密碼 |<a href="reset_password_user.php" style="color: #666 !important"> 忘記密碼</a>|<a href="reset_account_user.php" style="color: #666 !important"> 忘記帳號</a></span>
                                </label>
                            </div>

                            <div class="col-lg-4 col-md-4 col-6 mx-auto text-center">

                                <button type="submit" class="form-control text-black">登入</button>
                                <br>
                            </div>
                    </div>
                </div>
                </form>
                <script>
                    function showPW(pwSelector) {
                        var pwInput = document.querySelector(pwSelector);
                        if (pwInput) {
                            pwInput.type = pwInput.type === "password" ? "text" : "password";
                        }
                    }
                </script>


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