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

    <link href="css/nav.css" rel="stylesheet">

    <?php
    include("includes/connection.php");
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        require("includes/app_nav.php");
    } else if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        require("includes/user_nav.php");
    } else {
        require("includes/nav.php");
    }
    if (isset($_GET['aid'])) {
        $activity_id = $_GET['aid'];
    } else {
        echo "未提供活動 ID";
        exit;
    }
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

        .yellow-button {
            background-color: #FF8C00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            border-radius: 155px;
        }

        .navbar-toggler .navbar-toggler-icon {
            background: var(--white-color);
            transition: background 10ms 300ms ease;
            display: block;
            margin: auto;
            width: 25px;
            height: 2px;
            position: relative;
        }
    </style>
</head>

<body id="top">
    <?php
    $result = mysqli_query($link, "SELECT `aid`,`bid`,`bname`,`address`,`introduce`,`rule` FROM `booth` WHERE `aid` ='$activity_id'");
    $result2 = mysqli_query($link, "SELECT maxpoint FROM activites WHERE aid ='$activity_id'");
    $row2 = mysqli_fetch_assoc($result2);

    $data_nums = mysqli_num_rows($result); //統計總比數
    $per = 10; //限制幾筆                                                                                                
    $pages = ceil($data_nums / $per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])) { //假如 $_GET["page"] 未設置
        $page = 1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page - 1) * $per; //計算起始值
    $result_b = mysqli_query($link, "SELECT `aid`,`bid`,`bname`,`address`,`introduce`,`rule` FROM `booth` WHERE `aid` ='$activity_id' LIMIT $start,$per");
    ?>

    <main>
        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <header class="w3-panel w3-center w3-opacity" style="padding:64px 16px text-center">
                        <h1 class='w3-xlarge'>活動攤位
                            <?php
                            if (isset($_SESSION['id'])) {
                                echo " <a href='history_add_booth.php?aid=" . $activity_id . "&maxpoint=" . $row2['maxpoint'] . " aria-label='Previous'><button class='yellow-button'><img src='images/add.svg'style='height:30px; width:25px' alt='新增按鈕'></button></a></h1>";
                            }
                            ?>
                            <br>
                    </header>
                    <div class="col-lg-12 col-12">
                        <?php
                        while ($row = mysqli_fetch_array($result_b, MYSQLI_NUM)) {
                            $disableModifyButton = false;
                        ?>
                            <div onclick="location.href='detail_booth.php?bid=<?php echo $row[1]?>'" class="job-thumb d-flex">
                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="images/site-header/logo2.png" class=" img-fluid" alt="">
                                </div>
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4  ">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0">
                                            <?php
                                            echo "$row[2]";
                                            ?>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center">
                                            <?php
                                            echo "<p class='job-location mb-0'>
                                                <i class='custom-icon bi-geo-alt me-1'></i>
                                                $row[3]
                                            </p>";
                                            ?>
                                        </div>
                                    </div>

                                    <div class="job-section-btn-wrap">
                                        <?php
                                        if (isset($_SESSION['id'])) {
                                            echo "<a href='delete_booth.php?bid=$row[1]&aid=$row[0]' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='刪除' style='background-color: transparent;  border:none; color:white;'></a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php
                        //頁碼
                        $page1 = $page - 1;
                        $page2 = $page + 1;
                        //分頁頁碼                   
                        ?>
                        <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                            <?php
                            echo '<div class=badge style="text-align:center;" >共 ' . $data_nums . ' 筆資料</div><br>';
                            ?>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-5">

                                    <?php

                                    ?>
                                    <li class="page-item">
                                        <?php echo ' <a class="page-link" href="booth.php?page=1&aid=' . $activity_id . '  ">'; ?>
                                        <span aria-hidden="true">首頁</span>
                                        </a>
                                    </li>
                                    <?php
                                    if ($data_nums != 0) {
                                        if ($page != 1) { ?>

                                            <li class="page-item">
                                                <?php echo ' <a class="page-link" href="booth.php?page=' . $page1 . '&aid=' . $activity_id . ' ">'; ?>
                                                <span aria-hidden="true">
                                                    < </span>
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
                                                    echo '<a class="page-link" href="booth.php?page=' . $i . '&aid=' . $activity_id . '">' . $i . '</a></li>';
                                                }
                                                if ($page != $i) { ?>

                                                    <li class="page-item " aria-current="page">
                                            <?php //後面頁碼網址
                                                    echo '<a class="page-link" href="booth.php?page=' . $i . '&aid=' . $activity_id . '">' . $i . '</a></li>';
                                                }
                                            }
                                        } ?>

                                            <?php if ($page != $pages) { ?>

                                                    <li class="page-item">
                                                        <?php echo ' <a class="page-link" href="booth.php?page=' . $page2 . '&aid=' . $activity_id . ' ">'; ?>
                                                        <span aria-hidden="true">></span>
                                                        </a>
                                                    </li>
                                                <?php }
                                        } else {
                                                ?>

                                                <li class="page-item">
                                                    <?php echo ' <a class="page-link" href="booth.php?page=1&aid=' . $activity_id . '">'; ?>
                                                    <span aria-hidden="true">1</span>
                                                    </a>
                                                </li>
                                            <?php
                                        }

                                        if ($data_nums == 0) {
                                            ?>
                                                <li class="page-item">
                                                    <?php echo ' <a class="page-link" href="booth.php?page=1&aid=' . $activity_id . ' ">'; ?>
                                                    <span aria-hidden="true">末頁</span>
                                                    </a>
                                                </li>
                                            <?php
                                        } else {
                                            ?>
                                                <li class="page-item">
                                                    <?php echo ' <a class="page-link" href="booth.php?page=' . $pages . '&aid=' . $activity_id . ' ">'; ?>
                                                    <span aria-hidden="true">末頁</span>
                                                    </a>
                                                </li>
                                            <?php } ?>


                                </ul>
                                <br>
                                
                                <?php
                                    echo "<a href='detailed.php?aid=" . $activity_id . "' aria-label='Previous'><p style='text-align:center'>返回</p></a>";

                               // if (isset($_SESSION['id'])) {

                               //     echo "<a href='detailed.php?aid=" . $activity_id . "' aria-label='Previous'><p style='text-align:center'>返回</p></a>";
                               // } elseif (isset($_SESSION['uid'])) {
                               //     echo "<a href='detailed.php?aid=" . $activity_id . "' aria-label='Previous'><p style='text-align:center'>返回</p></a>";
                               // } ?>
                            </nav>
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