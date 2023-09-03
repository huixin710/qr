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

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css">

    <link rel="stylesheet" href="owl.carousel.min.css">

    <link rel="stylesheet" href="owl.theme.default.min.css">

    <?php
    include("includes/connection.php");
    session_start();
    # 設定時區
    date_default_timezone_set('Asia/Taipei');
    $today = date('Y-m-d H:i:s'); // 目前的日期
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

<body id="top" onload="sequentialImg();">
    <?php
    require("includes/nav.php");
    ?>
    <main>
        <?php

        $sql = "SELECT * FROM `activites` WHERE `startdatetime` <= '$today' AND `enddatetime` > '$today'";
        $sql2 = "SELECT * FROM `activites_img`";
        $result = mysqli_query($link, $sql);
        $result2 = mysqli_query($link, $sql2);
        $data_nums = mysqli_num_rows($result); //統計總比數
        $data_nums2 = mysqli_num_rows($result2); //統計總比數
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                $row2 = mysqli_fetch_assoc($result2);
                while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) {
                }
            }
        }
        ?>

        <section style="background-color:#FFF3DE;" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide col-lg-12 col-md-12 col-18 text-center" data-bs-ride="carousel">
                            <!-- carousel-indicators 和 carousel-inner 部分 -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <?php
                                    for ($x = 1; $x < $data_nums; $x++) {
                                        $y = 2;
                                        echo "<button type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide-to='" . $x . "' aria-label='Slide" . $y . "'></button>";
                                        $y = $y + 1;
                                    }
                                ?>
                            </div>
                            <div class="carousel-inner">
                            <?php
                            $result = mysqli_query($link, "SELECT * FROM `activites` WHERE `startdatetime`<'$today' AND `enddatetime`>'$today'");
                            $firstSlide = true;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $result2 = mysqli_query($link, "SELECT iname FROM `activites_img`  WHERE `aid` = '" . $row['aid'] . "' LIMIT 1");

                                echo '<div class="carousel-item' . ($firstSlide ? ' active' : '') . '">';
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    echo '<a href=detailed.php?aid=' . $row['aid'] . '>';
                                    echo '<img src="' . $row2['iname'] . '" class="d-block w-100" alt="..."><br>';
                                    echo '</a>';
                                    echo'<div class="carousel-caption d-none d-md-block">
                                        <lable style="background-color:gray; color:white; padding:15px; font-weight:bold;">'.$row['aname'].'</lable>
                                        <br><br>
                                        </div>';    

                                }
                                echo'</div>';


                                $firstSlide = false;
                            }
                            ?>
                            <!-- Controls-->

                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                            <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                            </button>
                            <button class="carousel-control-next " type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--
        <section id="one" class="section-padding pb-0 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <form class="custom-form hero-form" action="#" method="get" role="form">
                            <h3 class="text-white mb-3">活動搜尋</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>
                                        <select class="form-select form-control" name="job-salary" id="job-salary" aria-label="Default select example">
                                            <option selected>活動名稱</option>
                                            <option value="1">1</option>
                                            <option value="2">咖滋卡滋</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-geo-alt custom-icon"></i></span>
                                        <select class="form-select form-control" name="job-salary" id="job-salary" aria-label="Default select example">
                                            <option selected>活動地點</option>
                                            <option value="1">1</option>
                                            <option value="2">CM108</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12">
                                    <button type="submit" class="form-control">
                                        搜尋
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        -->
        <br>
        <?php
        $result = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` WHERE `startdatetime`<'$today' AND `enddatetime`>'$today'");
        $data_nums = mysqli_num_rows($result); //統計總比數
        $per = 3; //限制幾筆                                                                                          
        $pages = ceil($data_nums / $per); //取得不小於值的下一個整數
        if (!isset($_GET["page"])) { //假如 $_GET["page"] 未設置
            $page = 1; //則在此設定起始頁數
        } else {
            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
        }
        $start = ($page - 1) * $per; //計算起始值
        $result1 = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` WHERE `startdatetime`<'$today'  AND `enddatetime`>'$today' ORDER BY `builddatetime`desc LIMIT $start,$per"); //每頁顯示項目數量                                                                                          


        ?>

        <section id="two" class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>最新活動</h2>
                    </div>

                    <div class="clearfix"></div>

                    <?php
                    $result = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM activites WHERE `startdatetime`<'$today' AND `enddatetime`>'$today'");
                    $data_nums = mysqli_num_rows($result); //統計總比數
                    $per = 6; //限制幾筆                                                                                                
                    $pages = ceil($data_nums / $per); //取得不小於值的下一個整數
                    if (!isset($_GET["page"])) { //假如 $_GET["page"] 未設置
                        $page = 1; //則在此設定起始頁數
                    } else {
                        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
                    }
                    $start = ($page - 1) * $per; //計算起始值 

                    echo "<div class=left style='text-align:justify;'>";
                    $result1 = mysqli_query($link, "SELECT `aid`,`aname`,`address`,`startdatetime`,`enddatetime`,`builddatetime` FROM `activites` WHERE `startdatetime`<'$today' AND `enddatetime`>'$today' ORDER BY `builddatetime`desc LIMIT $start,$per"); //每頁顯示項目數量
                    while ($row = mysqli_fetch_array($result1)) {
                        $result2 = mysqli_query($link, "SELECT iname FROM `activites_img`  WHERE `aid` = '" . $row['aid'] . "' LIMIT 1");
                        while ($row2 = mysqli_fetch_array($result2)) {
                            $status = '';
                            echo "</div>";


                            if ($today < $row[3]) {
                                $status = '<div style=color:light gray>尚未開始';
                                $disableModifyButton  = false;
                            } elseif ($today > $row[4]) {
                                $status = '<div style=color:red>已結束';
                                $disableModifyButton  = true;
                            } else {
                                $status = '<div style=color:green>進行中';
                                $disableModifyButton  = false;
                            }
                    ?>
                            <div class='col-lg-4 col-md-6 col-12'>
                                <a href='detailed.php?aid=<?php echo $row[0] ?>'>
                                    <div class='job-thumb job-thumb-box'>
                                        <div class='job-image-box-wrap'>

                                            <img src='<?php echo $row2['iname'] ?>' class='job-image img-fluid' alt=''>

                                        </div>

                                        <div class='job-body'>
                                            <h4 class='job-title'>
                                                <?php echo "$row[1]"; ?>
                                            </h4>

                                            <div class='d-flex align-items-center'>

                                            </div>

                                            <div class='d-flex align-items-center'>
                                                <p class='job-location'>
                                                    <i class='custom-icon bi-geo-alt me-1'></i>
                                                    <?php echo " $row[2]"; ?>
                                                </p>
                                            </div>
                                            <div class='d-flex align-items-center'>
                                                <p class='job-date'>
                                                    <i class='custom-icon bi-clock me-1'></i>
                                                    <?php echo " 結束:$row[4]"; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php
                        }
                    }



                        ?>
                            </div>
                </div>

            </div>
            </div>
            <?php
            //頁碼
            $page1 = $page - 1;
            $page2 = $page + 1;
            //分頁頁碼                   
            ?>
            <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                <?php
                echo '<div class=badge style="text-align:center;" >共 ' . $data_nums . ' 筆-第 ' . $page . ' 頁-共 ' . $pages . ' 頁</div><br>';
                ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-5">
                        <li class="page-item">
                            <a class="page-link" href="index.php?page=1#two" aria-label="Previous">
                                <span aria-hidden="true">首頁</span>
                            </a>
                        </li>
                        <?php if ($page != 1) { ?>
                            <li class="page-item">
                                <?php echo ' <a class="page-link" href="index.php?page=' . $page1 . ' #two">'; ?>
                                <span aria-hidden="true">
                                    <
                                </span>
                                        </a>
                            </li>
                            <?php
                        }
                        for ($i = 1; $i <= $pages; $i++) {
                            if ($page - 3 < $i && $i < $page + 3) {
                                if ($page == $i) {
                            ?>
                                    <li class="page-item active" aria-current="page">
                                    <?php //後面頁碼網址
                                    echo '<a class="page-link" href="index.php?page=' . $i . '#two">' . $i . '</a></li>';
                                }
                                if ($page != $i) { ?>

                                    <li class="page-item " aria-current="page">
                            <?php //後面頁碼網址
                                    echo '<a class="page-link" href="index.php?page=' . $i . '#two">' . $i . '</a></li>';
                                }
                            }
                        } ?>

                            <?php if ($page != $pages) { ?>

                                    <li class="page-item">
                                        <?php echo ' <a class="page-link" href="index.php?page=' . $page2 . '#two">'; ?>
                                        <span aria-hidden="true">></span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="page-item">
                                    <?php echo ' <a class="page-link" href="index.php?page=' . $pages . ' #two">'; ?>
                                    <span aria-hidden="true">末頁</span>
                                    </a>
                                </li>
                    </ul>
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
    <script src="jquery.min.js"></script>
    <script src="owl.carousel.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                autoplay: true
            });
        })
    </script>

</body>

</html>