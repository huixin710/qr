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

    <link href="css/to.css" rel="stylesheet">

    <link href="https://fontawesome.com/icons" rel="stylesheet">




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

        .contact-info-small-title {
            color: #787878;


        }

        .contact-form .form-control:hover {
            background-color: transparent;
            border-color: #c3baa9;
        }

        .contact-form .form-control {
            background-color: transparent;
            margin-bottom: 0px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            background-color: #f0f8ff00;

            border-color: #c4333300;

            border-color: #c3baa9;
        }

        .p {
            margin-left: 10px;
        }

        div {
            text-align: center;
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
            width: 360px;
            height: 100%;
            padding: 20px 20px 0px 0px;
        }
    </style>
    <?php
    include("includes/connection.php");
    session_start();
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    } else {
        $uid = $_GET['uid'];
    }

    $email = $_GET['mail'];
    ?>
</head>


<body id="top">


    <?php
    require("includes/user_nav.php");
    ?>

    <main>

        <section class="contact-section">
            <div class="container">
                <div class="row justify-content-center">
                    <h2 style="color:#787878;" class="text-center">會員資料</h2>
                    <div class="tag_menu_con">
                        <ul>
                            <li><a href="user.php" onclick="toPage_token('dataedit.html')">我的資料</a></li>
                            <li><a href="user_revise.php" onclick="toPage_token('datapw.html')">資料修改</a></li>
                            <li><a href="user_resetmail.php" onclick="toPage_token('datapw.html')">Mail驗證</a></li>
                            <li><a href="user_pw.php" onclick="toPage_token('datamb.html')" class="active">變更密碼</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-8 col-12 mx-auto" style="border:1px #696969 solid;">
                        <form class="custom-form contact-form" action="" method="post" role="form">
                            <br>



                            <?php
                            $sql = "SELECT * FROM `user` WHERE `uid`= '$uid'";

                            $result = mysqli_query($link, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                            ?>
                                <?php
                                //echo "<h4 class='text-white mb-3 text-center'><a href='user_activity.php?uid=" . $row['uid'] . "'>參與過的活動</a></2>"; 
                                ?>

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
                                <div class="tag_menu_con">
                                    <ul>

                                        <!--<li><button type="submit" class="form-control text-black">確認</button></li>-->
                                    </ul>

                                    <br>

                                </div>
                            <?php
                            }

                            ?>
                            <script language="JavaScript">
                                <?php

                                //echo "location.href='user_pw1.php?mail=$email'";
                                ?>
                            </script>

                    </div>
                    </form>



                </div>

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

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>