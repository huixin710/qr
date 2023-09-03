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

        <section class="contact-section section-padding">
            <div class="container">

                <div class="row ">
                    <form method="POST" enctype="multipart/form-data" action="" class="custom-form hero-form">
                        <h3 class="text-white mb-3 text-center">選擇活動</h3>
                        <hr style="color:white;">
                        <div class="row">

                            <div class="col-lg-6 col-lg-12">


                                <?php
                                $result = mysqli_query($link, "SELECT * FROM `user_activites`");
                                $data_nums = mysqli_num_rows($result);

                                if ($data_nums > 0) {

                                    echo "<table>";
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $aid = $row['aid'];
                                        // 根據活動ID從其他資料表中取得活動相關資訊，例如活動名稱、日期等，假設您有另一個名為 `activities` 的資料表，存放活動相關資料
                                        $activity_info_result = mysqli_query($link, "SELECT * FROM `activites` WHERE `aid` = '$aid'");
                                        $activity_info = mysqli_fetch_assoc($activity_info_result);
                                        // 輸出活動資訊
                                        echo "<td><a href='user_point.php?uid=" . $uid . "&aid=" . $aid . "'>" . $activity_info['aname'] . " - " . $activity_info['startdatetime'] . "</td>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "您尚未參加任何活動。";
                                }


                                ?>



                            </div>
                    </form>

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