<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Fun!好集好禮好有趣!</title>
    <!-- 引入 Google Charts 库 -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">

    <link href="css/apexcharts.css" rel="stylesheet">

    <link href="css/owl.carousel.min.css" rel="stylesheet">

    <link href="css/owl.theme.default.min.css" rel="stylesheet">

    <link href="css/tooplate-gotto-job.css" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
    $activity_id = $_GET['aid'];
    //$booth_id = $_GET['bid'];
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

            text-align: center;
            padding: 20px;
            position: relative;
            top: 50%;
            content: "";
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }

        .custom-block {
            background: var(--primary-color);
            border-top: 20px solid var(--secondary-color);
            border-radius: var(--border-radius-medium);
            position: relative;
            overflow: hidden;
            padding: 20px 50px;

        }

        .carousel-control-next,
        .carousel-control-prev {
            position: absolute;
            top: 0;
            bottom: 0;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 0;
            color: #fff;
            text-align: center;
            background: 0 0;
            border: 0;
            opacity: .5;
            transition: opacity .15s ease;
        }
    </style>


</head>


<?php ?>

<body>




    <main>
        <section class="job-section job-featured-section " id="job-section">
            <div class="container">
                <div class="row my-4">
                    <?php
                    $activites = mysqli_query($link, "SELECT * FROM `activites` WHERE `aid` = $activity_id");
                    $row_a = mysqli_fetch_assoc($activites);
                    ?>
                    <?php
                    $user_a = mysqli_query($link, "SELECT * FROM `user_activites` WHERE `aid` = $activity_id");
                    $nums_a = mysqli_num_rows($user_a);
                    ?>
                    <div class="title-group mb-3">
                        <h1 class="w3-panel w3-opacity"><?php echo $row_a['aname'] ?></h1>
                        <div class="justify-content: center; col-12">

                            <div style="background-color:#f6efcb;" class="container custom-block custom-block-balance">
                                <div class="row">
                                    <table>
                                        <tr>
                                            <td>
                                                <p>活動參與人數：</p>
                                            </td>
                                            <td>
                                                <P data-from="1" data-to="<?php echo $nums_a ?>" data-speed="1000"><?php echo $nums_a ?>人</P>

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="row my-4">

                        <div class="justify-content: center; col-lg-6 col-12">
                            <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div style="background-color:#f6efcb;" class="custom-block">
                                    <div class="carousel-inner">
                                        <?php
                                        $dat_b = array();
                                        $data_b[] = ['label_b', 'value_b'];
                                        $booth = mysqli_query($link, "SELECT * FROM `booth` WHERE `aid` = $activity_id");
                                        ?><h5 class="mb-4">攤位</h5>
                                        <div class="carousel-item active">


                                            <?php
                                            while ($row_b = mysqli_fetch_array($booth)) {
                                            ?>
                                                <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p><?php echo $row_b[3] ?></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $user_b = mysqli_query($link, "SELECT * FROM `user_booth` WHERE `bid` = $row_b[2]");
                                                    $nums_b = mysqli_num_rows($user_b);
                                                    ?>

                                                    <div class="ms-auto me-4">
                                                        <small>參與人數</small>
                                                        <h6><?php echo $nums_b ?></h6>
                                                    </div>
                                                </div>
                                            <?php
                                                $data_b[] = [$row_b[3], $nums_b];
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $data_json = json_encode($data_b);
                                        ?>
                                        <div class="carousel-item">
                                            <div id="piechart_b" style="width: 600%; height: 500%;"></div>
                                            <?php
                                            $dat_p = array();
                                            $data_p[] = ['label_p', 'value_p'];
                                            $num_p = 0;

                                            ?>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="justify-content: center; col-lg-6 col-12">
                            <div id="carouselExampleControls2" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                <div style="background-color:#f6efcb;" class="custom-block">
                                    <div class="carousel-inner">
                                        <h5 class="mb-4">獎品</h5>
                                        <?php
                                        $prize = mysqli_query($link, "SELECT * FROM `prize` WHERE `aid` = $activity_id");
                                        ?>
                                        <div class="carousel-item active">
                                            <?php
                                            while ($row_p = mysqli_fetch_array($prize)) {
                                            ?>
                                                <div class="d-flex align-items-center border-bottom pb-3 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p><?php echo $row_p[3] ?></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $user_p = mysqli_query($link, "SELECT * FROM `user_prize` WHERE `pid` = $row_p[2]");
                                                    while ($row_userp = mysqli_fetch_array($user_p)) {
                                                        $num_p += $row_userp[4];
                                                    }
                                                    ?>

                                                    <div class="ms-auto me-4">
                                                        <small>被兌換次數</small>
                                                        <h6><?php echo $num_p ?></h6>
                                                    </div>
                                                </div>
                                            <?php
                                                $data_p[] = [$row_p[3], $num_p];
                                                $num_p = 0;
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $data_json2 = json_encode($data_p);
                                        ?>
                                        <div class="carousel-item">
                                            <div id="piechart_p" style="width:300%; height: 200%;"></div>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <br>
    </main>
    </div>
    </div>
    </div>
    </section>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $data_json; ?>);

            var options = {
                backgroundColor: '#f6efcb',
                title: '攤位參與人數',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_b'));
            chart.alignment = 'center';
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $data_json2; ?>);

            var options = {
                backgroundColor: '#f6efcb',

                title: '獎品被兌換次數',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_p'));

            chart.draw(data, options);
            chart.alignment = 'center';
        }
    </script>



</body>
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

</html>