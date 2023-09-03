<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
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

    $uid = $_SESSION['uid'];
    $aid = $_GET['aid'];


    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $today = date('Y-m-d H:i:s'); // 目前的日期



    $result2 = mysqli_query($link, "SELECT `nowpoint` FROM `user_activites` WHERE `uid` = '$uid' AND `aid`='$aid'"); //判斷user是否集點資料
    $row2 = mysqli_fetch_assoc($result2);
    $data_nums2 = mysqli_num_rows($result2);
    $result5 = mysqli_query($link, "SELECT `aname` FROM `activites` WHERE `aid`='$aid'");
    $row5 = mysqli_fetch_assoc($result5);

    ?>

    </script>
    <style>
        .rr {
            background-color: #f4eac2;
            border-radius: var(--border-radius-large);
            font-size: var(--btn-font-size);
            display: flex;
            /* 水平置中 */
            justify-content: center;
            /* 垂直置中 */
            align-content: center;
            flex-wrap: wrap;
            width: 400px;
            text-align: center;
            padding: 20px;
            position: relative;
            top: 50%;
            content: "";
            display: inline-block;
            height: 100%;
            vertical-align: middle;
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
        
        img {   
            height: auto;   
            max-width: 100%;   
        }  
    </style>
</head>

<body id="top">


    <?php
    require("includes/user_nav.php");
    ?>
    <main>

        <section class="contact-section section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12 mx-auto" style="border:3px #696969 solid;">
                        <form class="custom-form contact-form" action="#" method="post" role="form">
                            <form method="POST" enctype="multipart/form-data" action="" class="custom-form hero-form">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="text-center">
                                        <img src="images/QR fun.png" class="text-center">

                                    </div>

                                    <?php
                                    if ($row2['nowpoint'] == 0) {
                                    ?>

                                        <div class='text-center'>
                                            <h1 style="color:#787878;padding:20px;"><?php echo $row5['aname']  ?></h1>
                                            <!--掃描還未掃描過的攤位時顯示-->
                                            <p style="padding:15px;"></p>
                                            <div class='text-center rr'>
                                                <div>
                                                    <h5 style=" padding:5px;">會員帳號： <?php echo $uid ?></h5>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <h5 style=" padding:5px;">已累積點數： <?php echo  $row2['nowpoint'] ?></h5>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <h5 style=" padding:5px;">趕快去累積點數吧~~</h5>
                                                </div>
                                                <!---->

                                                <!--掃描已掃過的攤位時顯示
                                                <p style="padding:90px;"></p>
                                                <div>
                                                    <h3 style=" padding:25px;">同一攤位無法重複集點！</h3>
                                                </div>
                                                -->
                                            </div>
                                            <br><br>
                                        </div>
                                    <?php

                                    } else {
                                    ?>
                                        <div class='text-center'>
                                            <h1 style="color:#787878;padding:20px;"><?php echo $row5['aname']  ?></h1>
                                            <!--掃描還未掃描過的攤位時顯示-->
                                            <p style="padding:15px;"></p>
                                            <div class='text-center rr '>
                                                <div>
                                                    <h5 style=" padding:5px;">會員帳號： <?php echo $uid  ?></h5>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <h5 style=" padding:5px;">已累積點數： <?php echo  $row2['nowpoint'] ?></h5>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <h5 style=" padding:5px;">可以兌換獎品了 請把握機會</h5>
                                                </div>
                                            </div>
                                            <!---->

                                            <!--掃描已掃過的攤位時顯示
                        <p style="padding:90px;"></p>
                        <div>
                            <h3 style=" padding:25px;">同一攤位無法重複集點！</h3>
                        </div>
                        -->

                                        </div>
                                        <br><br>
                                    <?php

                                    }
                                    ?>

                                </div>
                    </div>
                    </form>
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