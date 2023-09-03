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
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        $bid = $_GET['bid'];
    } else {
        $bid = $_GET['bid'];
        $result = mysqli_query($link, "SELECT `appid`,`aid` FROM `booth` WHERE `bid` = '$bid'"); //查出appid,aid
        $row = mysqli_fetch_assoc($result);
    ?>
        <script>
            alert("請先登入");
            location.href = "login_user.php?appid=<?php echo $row['appid'] ?>&aid=<?php echo $row['aid'] ?>&bid=<?php echo $bid ?>";
        </script>
    <?php
    }
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $today = date('Y-m-d H:i:s'); // 目前的日期

    $result = mysqli_query($link, "SELECT `appid`,`aid`,`bname` FROM `booth` WHERE `bid` = '$bid'"); //查出appid,aid
    $row = mysqli_fetch_assoc($result);

    $result2 = mysqli_query($link, "SELECT `point` FROM `user_booth` WHERE `uid` = '$uid' AND `bid`='$bid'"); //判斷攤位qrcode是否被掃過
    $row2 = mysqli_fetch_assoc($result2);
    $data_nums2 = mysqli_num_rows($result2); //統計總比數

    $result3 = mysqli_query($link, "SELECT `nowpoint` FROM `user_activites` WHERE `uid` = '$uid' AND `aid`='" . $row['aid'] . "'"); //判斷user是否有第一筆集點資料
    //$row3 = mysqli_fetch_assoc($result3);
    $data_nums3 = mysqli_num_rows($result3);
    //echo"".$row3['nowpoint']."";
    //echo"$data_nums3";  
    $result5 = mysqli_query($link, "SELECT aname FROM `activites` WHERE `appid`='" . $row['appid'] . "' AND `aid`='" . $row['aid'] . "'");
    $row5 = mysqli_fetch_assoc($result5);

    ?>

    </script>
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
                    <div class="col-lg-8 col-12 " style="border:3px #696969 solid;">
                        <form class="custom-form contact-form" action="#" method="post" role="form">

                            <form method="POST" enctype="multipart/form-data" action="" class="custom-form hero-form">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="text-center">
                                        <img src="images/QR fun.png" class="text-center">

                                    </div>

                                    <?php
                                    if ($data_nums2 == 0) { //判斷攤位qrcode是否被掃過
                                        mysqli_query($link, "INSERT INTO `user_booth` (`uid`,`appid`,`aid`,`bid`,`point`,`builddatetime`) VALUES ('$uid','" . $row['appid'] . "','" . $row['aid'] . "','$bid','1','$today')");

                                        $result4 = mysqli_query($link, "SELECT `point` FROM `user_booth` WHERE `uid` = '$uid' AND `aid`='" . $row['aid'] . "'"); //新增後的攤位集點筆數
                                        $row4 = mysqli_fetch_assoc($result4);
                                        $data_nums4 = mysqli_num_rows($result4); //統計總比數


                                        if ($data_nums3 == 0) { //判斷活動是否有第一筆集點資料

                                    ?>



                                            <div class='text-center'>
                                                <h1 style="color:#787878;"><?php echo $row5['aname']  ?></h1>
                                                <!--掃描還未掃描過的攤位時顯示-->
                                                <p style="padding:50px;">目前累積的點數</p>
                                                <div class='text-center rr '>
                                                    <div>
                                                        <h3 style="padding:25px;">會員帳號： <?php echo $uid  ?></h3>
                                                    </div>
                                                    <div>
                                                        <h3 style="padding:25px;">攤位名稱： <?php echo $row['bname']  ?></h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <h3 style="padding:20px;">累積點數： <?php echo $data_nums4  ?></h3>
                                                    </div>
                                                    <!---->

                                                    <!--掃描已掃過的攤位時顯示
                                        <p style="padding:90px;"></p>
                                        <div>
                                            <h3 style="padding:25px;">同一攤位無法重複集點！</h3>
                                        </div>
                                        -->
                                                </div>
                                                <br><br>
                                            </div>


                                        <?php

                                            mysqli_query($link, "INSERT INTO `user_activites` (`uid`,`appid`,`aid`,`nowpoint`) VALUES ('$uid','" . $row['appid'] . "','" . $row['aid'] . "','$data_nums4')");
                                        } else {
                                            $ucnowpoint = mysqli_query($link, "SELECT `nowpoint` FROM `user_activites` WHERE `uid` = '$uid' AND `aid`='" . $row['aid'] . "'"); //現在點數
                                            $ucnp = mysqli_fetch_assoc($ucnowpoint);
                                            $nowpoint = $ucnp['nowpoint'] + 1;
                                            //echo"$nowpoint";
                                        ?>


                                            <div class='text-center'>
                                                <br>
                                                <h1 style="color:#787878; margin-inline-start: 10px;"><?php echo $row5['aname']   ?></h1>
                                                <!--掃描還未掃描過的攤位時顯示-->
                                                <p style="padding:30px;">目前累積的點數</p>
                                                <div class='text-center rr '>
                                                    <div>
                                                        <h3 style="padding:10px;">會員帳號： <?php echo $uid  ?></h3>
                                                    </div>
                                                    <div>
                                                        <h3 style="padding:10px;">攤位名稱： <?php echo $row['bname']  ?></h3>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <h3 style="padding:10px;">累積點數： <?php echo $data_nums4  ?></h3>
                                                    </div>
                                                    <!---->

                                                    <!--掃描已掃過的攤位時顯示
                                        <p style="padding:90px;"></p>
                                        <div>
                                            <h3 style="padding:25px;">同一攤位無法重複集點！</h3>
                                        </div>
                                        -->

                                                </div>
                                                <br><br>


                                            <?php

                                            $UPDATE = mysqli_query($link, "UPDATE `user_activites` SET `nowpoint` = '$nowpoint' WHERE `uid` = '$uid' AND `aid`= '" . $row['aid'] . "'");
                                        }
                                    } else {
                                            ?>
                                            <div class='text-center '>
                                                <br>
                                                <h1 style="color:#787878; margin-inline-start: 10px;"><?php echo $row5['aname']   ?></h1>
                                                <div class='text-center rr'>
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <h4 style="padding:10px;"> <br>
                                                            <br>同一個攤位不能重複集點
                                                        </h4>
                                                    </div>


                                                    <br><br>
                                                </div>
                                            <?php

                                        }
                                            ?>
                                            </div>
                                    </div>
                                    <br>
                                    </div>
                                    </section>