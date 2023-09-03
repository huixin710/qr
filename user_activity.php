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
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
    } else {
    ?>
        <script>
            alert("請先登入");
            location.href = "login_user.php";
        </script>
    <?php
    }
    //echo"$id";        
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
        <section class="job-section job-featured-section">
                    <header class="w3-panel w3-center w3-opacity" style="padding:64px text-center">
                        <h1 class="w3-xlarge">我的活動</h1>
                        <br>
                    </header>
                    <!--會員還沒參加活動時顯示
                    <h5 class="w3-xlarge w3-center">尚未參加任何活動</h5>
                    -->
                        <?php
                        $result = mysqli_query($link, "SELECT * FROM `user_activites`WHERE `uid`='$uid'");
                        $data_nums = mysqli_num_rows($result);
                        if ($data_nums > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $activity_id = $row['aid'];
                                // 根據活動ID從其他資料表中取得活動相關資訊，例如活動名稱、日期等，假設您有另一個名為 activities 的資料表，存放活動相關資料
                                $activity_info_result = mysqli_query($link, "SELECT * FROM activites WHERE aid = '$activity_id'");
                                $activity_info = mysqli_fetch_assoc($activity_info_result);

                        ?>

                                <div onclick="location.href='detailed.php?aid=<?php echo $activity_id; ?>'" class="job-thumb d-flex">
                                    <div class="job-image-wrap bg-white shadow-lg">
                                        <img src="images/site-header/logo2.png" class=" img-fluid" alt="">
                                    </div>
                                    <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                        <div class="mb-3">
                                            <h4 class="job-title mb-lg-0">
                                                <?php echo $activity_info['aname']  ?>
                                            </h4>

                                            <div class="d-flex flex-wrap align-items-center">
                                                <p class="job-location mb-0">
                                                    <i class="custom-icon bi-clock me-1"></i>
                                                    <?php echo $activity_info['startdatetime'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="job-section-btn-wrap">
                                            <?php echo "<a href='user_booth.php?uid=" . $uid . "&activity_id=" . $activity_id . "' class='custom-btn btn'>"; ?> <input type="button" name="bupdata" value="攤位" style="background-color: transparent;  border:none; color:white; padding: 1px 1px; font-size:13px;"></a>&nbsp;&nbsp;&nbsp;
                                            <?php echo "<a href='user_prize.php?uid=" . $uid . "&activity_id=" . $activity_id . "' class='custom-btn btn'>"; ?><input type="button" name="bupdata" value="獎品" style="background-color: transparent;  border:none; color:white; padding: 1px 1px; font-size:13px;"></a>&nbsp;&nbsp;&nbsp;
                                            <?php echo "<a href='user_point.php?uid=" . $uid . "&aid=" . $activity_id . "' class='custom-btn btn'>"; ?><input type="button" name="bupdata" value="集點卡" style="background-color: transparent;  border:none; color:white; padding: 1px 1px; font-size:13px;"></a>&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div></a>
                            <?php } ?>

                    <?php

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

                    ?>
                    <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                        <section id=one class="job-section job-featured-section  login" id="job-section">
                                    <div class="col-lg-12 col-12 text-center mx-auto mb-4">
                                        <?php
                                        echo '<div class=badge style="text-align:center;" >共 ' . $data_nums . ' 筆-第 ' . $page . ' 頁-共 ' . $pages . ' 頁</div><br>';
                                        ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center mt-5">
                                                <li class="page-item">
                                                    <a class="page-link" href="user_activity.php?page=#one" aria-label="Previous">
                                                        <span aria-hidden="true">首頁</span>
                                                    </a>
                                                </li>

                                                <?php

                                                if ($page != 1) {
                                                ?>

                                                    <li class="page-item">
                                                        <?php echo ' <a class="page-link" href="user_activity.php?page=' . $page1 . ' #one">'; ?>
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

                                                            echo '<a class="page-link" href="user_activity.php?page=' . $i . '">' . $i . '</a></li>';
                                                        }


                                                        if ($page != $i) {
                                                            ?>

                                                            <li class="page-item " aria-current="page">
                                                    <?php //後面頁碼網址

                                                            echo '<a class="page-link" href="user_activity.php?page=' . $i . '">' . $i . '</a></li>';
                                                        }
                                                    }
                                                }



                                                    ?>

                                                    <?php
                                                    if ($page != $pages) {
                                                    ?>

                                                            <li class="page-item">
                                                                <?php echo ' <a class="page-link" href="user_activity.php?page=' . $page2 . ' ">'; ?>
                                                                <span aria-hidden="true">下一頁</span>

                                                                </a>
                                                            </li>

                                                        <?php
                                                    } ?>
                                                        <li class="page-item">
                                                            <?php echo ' <a class="page-link" href="user_activity.php?page=' . $pages . ' ">'; ?>
                                                            <span aria-hidden="true">末頁</span>

                                                            </a>
                                                        </li>

                                            </ul>
                                        </nav>
                                        <!-- 頁碼尾 -->
                                    </div>
                                                </section>

                                <?php
                                $data_nums = mysqli_num_rows($activity_info_result); //統計總比數

                            } else {
                                echo "<div class='w3-padding-32 text-center'>
                            <p>您尚未參加任何活動，快去參加吧~</p>
                        </div>";
                            }
                                ?>
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