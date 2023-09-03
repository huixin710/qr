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
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        if (isset($_GET['activity_id'])) {
            $activity_id = $_GET['activity_id'];

            // 檢查使用者是否已參加過該活動，如果尚未參加，則將活動ID寫入資料表 `user_activities`
            $check_query = mysqli_query($link, "SELECT * FROM `user_activites` WHERE `uid` = '$uid' AND `aid` = '$activity_id'");
            if (mysqli_num_rows($check_query) == 0) {
                mysqli_query($link, "INSERT INTO `user_activites` (`uid`, `aid`) VALUES ('$uid', '$activity_id')");
            }
        }
        $user_points_result = mysqli_query($link, "SELECT `nowpoint` FROM `user_activites` WHERE `uid` = '$uid'");
        if (mysqli_num_rows($user_points_result) > 0) {
            $user_points_data = mysqli_fetch_assoc($user_points_result);
            $points = $user_points_data['nowpoint'];
        } else {
            $points = 0;
        }
    } else {
    ?>
        <script>
            alert("請先登入");
            location.href = "login_user.php";
        </script>
    <?php
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
    </style>
</head>


<body id="top">

    <?php
    require("includes/user_nav.php");
    ?>
    <main>

        <section class="job-section job-featured-section section-padding" id="job-section">
            <div class="container">
                <div class="row">
                    <div class="title-group mb-3 text-center">
                        <h1 style="color:#787878; font-weight:bold; font-size:50px;" class="mb-0">兌換過的獎品</h1>
                        <br>
                        <br<br>
                    </div>
                    <?php
                    $redeemed_prizes_result = mysqli_query($link, "SELECT `pid`, `datetime` FROM `user_prize` WHERE `uid` = '$uid' AND`aid` = '$activity_id'");
                    $data_nums = mysqli_num_rows($redeemed_prizes_result);

                    if ($data_nums > 0) {

                        while ($row = mysqli_fetch_assoc($redeemed_prizes_result)) {
                            $prize_id = $row['pid'];
                            $date_redeemed = $row['datetime'];
                            $prize_result = mysqli_query($link, "SELECT `pid`,`pname` FROM `prize` WHERE `aid` = '$activity_id' AND `pid`='$prize_id'");
                            $prize_info = mysqli_fetch_assoc($prize_result);
                            // 輸出兌換過的獎品資訊
                    ?>
                            <div onclick="location.href='detail_prize.php?pid=<?php echo $prize_info['pid']; ?>'" class="job-thumb d-flex">

                                <div class="job-image-wrap bg-white shadow-lg">
                                    <img src="images/site-header/logo2.png" class=" img-fluid" alt="">
                                </div>
                                <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                    <div class="mb-3">
                                        <h4 class="job-title mb-lg-0">
                                            <a href="" class="job-title-link "><?php echo $prize_info['pname']; ?></a>
                                        </h4>

                                        <div class="d-flex flex-wrap align-items-center">
                                            <p class="job-location mb-0">
                                                <i class="custom-icon bi-clock me-1"></i> 兌換日期：
                                                <?php echo " $date_redeemed "; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <?php
                        }

                        ?>
                        <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                            <a href="user_activity.php" aria-label="Previous">
                                <p style="text-align:center">返回</p>
                            </a>
                        </div>


                </div>
                <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                    <?php
                        $data_nums = mysqli_num_rows($prize_result); //統計總比數
                        $per = 10; //限制幾筆                                                                                                
                        $pages = ceil($data_nums  / $per); //取得不小於值的下一個整數
                        if (!isset($_GET["page"])) { //假如 $_GET["page"] 未設置
                            $page = 1; //則在此設定起始頁數
                        } else {
                            $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
                        }
                        $start = ($page - 1) * $per; //計算起始值


                        //頁碼
                        $page1 = $page - 1;
                        $page2 = $page + 1;
                        //分頁頁碼                   
                    ?><div class="col-lg-12 col-12 text-center mx-auto mb-4">
                        <?php
                        echo '<div class=badge style="text-align:center;background: transparent; color:#f1c16d" >共 ' . $data_nums . ' 筆活動</div><br>';                                ?>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mt-5">
                                <li class="page-item">
                                    <?php echo ' <a class="page-link" href="user_prize.php?page=1&uid=' . $uid . '&activity_id=' . $activity_id . '">'; ?>
                                    <span aria-hidden="true">首頁</span>
                                    </a>
                                </li>

                                <?php

                                if ($page != 1) {
                                ?>

                                    <li class="page-item">
                                        <?php echo ' <a class="page-link" href="user_prize.php?page=' . $page1 . ' &uid=' . $uid . '&activity_id=' . $activity_id . '">'; ?>
                                        <span aria-hidden="true">上一頁</span>

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

                                            echo '<a class="page-link" href="user_prize.php?page=' . $i . '&uid=' . $uid . '&activity_id=' . $activity_id . '">' . $i . '</a></li>';
                                        }


                                        if ($page != $i) {
                                            ?>

                                            <li class="page-item " aria-current="page">
                                    <?php //後面頁碼網址

                                            echo '<a class="page-link" href="user_prize.php?page=' . $i . '&uid=' . $uid . '&activity_id=' . $activity_id . '">' . $i . '</a></li>';
                                        }
                                    }
                                }



                                    ?>

                                    <?php
                                    if ($page != $pages) {
                                    ?>

                                            <li class="page-item">
                                                <?php echo ' <a class="page-link" href="user_prize.php?page=' . $page2 . '&uid=' . $uid . '&activity_id=' . $activity_id . ' ">'; ?>
                                                <span aria-hidden="true">下一頁</span>

                                                </a>
                                            </li>

                                        <?php
                                    } ?>
                                        <li class="page-item">
                                            <?php echo ' <a class="page-link" href="user_prize.php?page=' . $pages . '&uid=' . $uid . '&activity_id=' . $activity_id . ' ">'; ?>
                                            <span aria-hidden="true">末頁</span>

                                            </a>
                                        </li>

                            </ul>
                        </nav>
                        <!-- 頁碼尾 -->
                    </div>
                </div>
            <?php

                    } else { ?>
                <div class="mb-3">
                    <h4 class=" text-center job-title mb-lg-0">
                        您尚未兌換任何獎品。
                    </h4>
                </div>
            <?php
                    }
            ?>
        </section>

        </div>



        <footer class="site-footer  primary-color:#FFA600;">
            <div class="site-footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-12 mt-2 mt-lg-0">
                        </div>
                        <div class="col-lg-4 col-12 d-flex align-items-center ">
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
        <script src="js/apexcharts.min.js"></script>
        <script type="text/javascript">
            var options = {
                series: [13, 43, 22],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: ['Balance', 'Expense', 'Credit Loan', ],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
            chart.render();
        </script>

        <script type="text/javascript">
            var options = {
                series: [{
                    name: 'Income',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Expense',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }, {
                    name: 'Transfer',
                    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>



</body>

</html>