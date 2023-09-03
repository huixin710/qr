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



        //$new_points = $points - $qr_code_points;
        //mysqli_query($link, "UPDATE `user_activites` SET `nowpoint` = '$new_points' WHERE `uid` = '$id'");
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

        .yellow-button {
            background-color: #FF8C00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            border-radius: 155px;
        }


        .contact-form .badge:hover {
            background-color: transparent;
            border-color: #c3baa9;
        }

        .custom-block-icon:hover {
            /*background: transparent;*/
            color: var(--white-color);
        }
    </style>
</head>



<body id="top">

    <?php
    require("includes/user_nav.php");
    ?>
    <main>

        <main>
            <section class="job-section job-featured-section section-padding login" id="job-section">
                <div class="container">
                    <div class="row">
                        <div class="title-group mb-3 text-center">
                            <h1 style="color:#787878; font-weight:bold; font-size:50px;" class="mb-0">我的攤位 <?php echo "<a href='user_prize.php?uid=" . $uid . "&activity_id=" . $activity_id . "' aria-label='Previous'><button class='yellow-button'><img src='images/gift.svg'style='height:40px; width:35px' alt='兌換過的獎品'></button></a>"; ?></h1>
                            <br>
                            <p>灰色為尚未集點過的攤位</p>
                            <br<br>
                        </div>
                        <!--
                                <div class="w3-padding-32   text-center">
                                <div class="tag_menu_con">
                                    <ul>
                                        <li><a href="" onclick="toPage_token('')" class="active">已集點</a></li>
                                        <li><a href="" onclick="toPage_token('')">未集點</a></li>
                                    </ul>
                                </div>
                            </div>
                            -->
                        <!--會員還尚未集點時顯示
                    <h5 class="w3-xlarge w3-center">目前尚未開始集點</h5>
                    -->


                        <?php
                        // 從資料表 `user_activities` 中取得使用者參加過的活動ID及累積點數
                       
                           

                                $booth_result = mysqli_query($link, "SELECT `bid`,`bname`,`address` FROM `booth` WHERE `aid` = '$activity_id'");
                               
                                while ($row_b = mysqli_fetch_array($booth_result, MYSQLI_NUM)) {
                                    $user_booth = mysqli_query($link, "SELECT * FROM `user_booth` WHERE `uid` = '$uid' AND `aid`='$activity_id'");
                                    //echo"booth$row_b[0] ";
                                
                                    
                                    
                                        //echo"<h1>".$row_ub['bid']."</h1>";
                                        while ($row_ub2 = mysqli_fetch_array($user_booth, MYSQLI_NUM)) {
                                            //echo"user$row_ub2[3] ";
                                            if($row_b[0]==$row_ub2[3]){
                                                //echo"已集點$row_ub2[3] ";
                                                
                                        
                                           
                                    /*while ($row_ub = mysqli_fetch_array($user_booth, MYSQLI_NUM)) {
                                        if($row_b[0]==$row_ub[3]){

                                        
                                // 輸出活動資訊
                                if (isset($booth_info['bname']) && !empty($booth_info['bname'])) {
                                    
                                    $data_nums1 = mysqli_num_rows($user_booth);

                                    //列出所有攤位資訊
                                    $result = mysqli_query($link, "SELECT `aid`,`bid`,`bname`,`address`,`introduce`,`rule` FROM `booth` WHERE `aid` ='$activity_id'");
                                    while ($row2 = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                        for($x=$data_nums1; $x>0; $x--){
                                            if ($booth_info['bid']==$row2[1]){
                                */                                   
                                ?>
                                        <!--已經集點過的攤位顯示(正常)-->
                                        <div onclick="location.href='detail_booth.php?bid=<?php echo $row_b[0]; ?>'" class="job-thumb d-flex">
                                            <div class="job-image-wrap bg-white shadow-lg">
                                                <img src="images/site-header/logo2.png" class=" img-fluid" alt="">
                                            </div>
                                            <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                                <div class="mb-3">
                                                    <h4 class="job-title mb-lg-0">
                                                        <?php echo  $row_b[1] ?>
                                                    </h4>

                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <p class="job-location mb-0">
                                                            <i class="custom-icon bi-geo-alt me-1"></i>
                                                            <?php echo $row_b[2] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        break;}}}

                                        $booth_result = mysqli_query($link, "SELECT `bid`,`bname`,`address` FROM `booth` WHERE `aid` = '$activity_id'");
                               
                                        while ($row_b = mysqli_fetch_array($booth_result, MYSQLI_NUM)) {
                                            $user_booth = mysqli_query($link, "SELECT * FROM `user_booth` WHERE `uid` = '$uid' AND `aid`='$activity_id'");
                                            //echo"<br>booth$row_b[0] ";

                                                //echo"<h1>".$row_ub['bid']."</h1>";
                                                while ($row_ub = mysqli_fetch_array($user_booth, MYSQLI_NUM)) {
                                                    //echo"user$row_ub[3] ";
                                                    if($row_b[0]==$row_ub[3]){
                                                        
                                                        //echo"已集點$row_ub[3] ";
                                                        $i=1;
                                                        //echo"$i ";
                                                        break;
                                                        
                                                    }else{
                                                        $i=0;
                                                    }
                                                }
                                                //echo"q$i ";
                                                if($i==0){                        
                                    ?>
                                        <!--尚未集點過的攤位顯示(灰色)-->
                                        <div onclick="location.href='detail_booth.php?bid=<?php echo $row_b[0]; ?>'" class="job-thumb d-flex">
                                            <div class="job-image-wrap bg-white shadow-lg">
                                                <img src="images/site-header/logo2.png" class=" img-fluid" alt="">
                                            </div>
                                            <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                                <div class="mb-3">
                                                    <h4 style="color:#D3D3D3;" class="job-title mb-lg-0">
                                                        <?php echo  $row_b[1] ?>
                                                    </h4>

                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <p style="color:#D3D3D3;" class="job-location mb-0">
                                                            <i style="color:#D3D3D3;" class="custom-icon bi-geo-alt me-1"></i>
                                                            <?php echo $row_b[2] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }}
                                    ?>
            </section>

            <div class="col-lg-12 col-12 text-center mx-auto mb-4">

            <a href="user_activity.php" aria-label="Previous">
                <p style="text-align:center">返回</p>
            </a>
            </div>

            </div>
            </div>
            <?php
            $data_nums = mysqli_num_rows($booth_result); //統計總比數
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
                                  <?php echo ' <a class="page-link" href="user_booth.php?page=1&uid=' . $uid . '&activity_id=' . $activity_id . '">'; ?>
                                  <span aria-hidden="true">首頁</span>
                                  </a>
                              </li>

                              <?php

                              if ($page != 1) {
                              ?>

                                  <li class="page-item">
                                      <?php echo ' <a class="page-link" href="user_booth.php?page=' . $page1 . ' &uid=' . $uid . '&activity_id=' . $activity_id . '">'; ?>
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

                                          echo '<a class="page-link" href="user_booth.php?page=' . $i . '&uid=' . $uid . '&activity_id=' . $activity_id . '">' . $i . '</a></li>';
                                      }


                                      if ($page != $i) {
                                          ?>

                                          <li class="page-item " aria-current="page">
                                  <?php //後面頁碼網址

                                          echo '<a class="page-link" href="user_booth.php?page=' . $i . '&uid=' . $uid . '&activity_id=' . $activity_id . '">' . $i . '</a></li>';
                                      }
                                  }
                              }



                                  ?>

                                  <?php
                                  if ($page != $pages) {
                                  ?>

                                          <li class="page-item">
                                              <?php echo ' <a class="page-link" href="user_booth.php?page=' . $page2 . '&uid=' . $uid . '&activity_id=' . $activity_id . ' ">'; ?>
                                              <span aria-hidden="true">下一頁</span>

                                              </a>
                                          </li>

                                      <?php
                                  } ?>
                                      <li class="page-item">
                                          <?php echo ' <a class="page-link" href="user_booth.php?page=' . $pages . '&uid=' . $uid . '&activity_id=' . $activity_id . ' ">'; ?>
                                          <span aria-hidden="true">末頁</span>

                                          </a>
                                      </li>

                          </ul>
                      </nav>
                      <!-- 頁碼尾 -->
                </section>
        </main>


        <div class="col-lg-50 col-50">
            <div class="w3-container" id="where" style="padding-bottom:64px;">
                <div class="w3-content" style="max-width:700px">
                    </dvi>
                </div>
            </div>
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