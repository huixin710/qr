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
            background-color:transparent;
            margin-bottom: 0px;
            padding-top: 5px;
            padding-bottom: 5px;
            padding-left: 10px;
            background-color: #f0f8ff00;

            border-color: #c4333300;

            border-color: #c3baa9;
        }

     
    </style>
    <?php
    include("includes/connection.php");
    session_start();
    if (isset($_SESSION['uid'])) {
        $uid = $_SESSION['uid'];
        
    } else {
        $uid=$_GET['uid'];
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
                            <li><a href="user_resetmail.php" onclick="toPage_token('datapw.html')" >Mail驗證</a></li>
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

                                <div class='text-center'>


                                <div class="contact-info d-flex align-items-center mb-3 text-center">
                                    <img src="images/key.png" style="height:40px; width:40px;">

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">&nbsp;&nbsp;&nbsp;&nbsp;舊密碼：
                                            
                                            <p class="mb-0 text-center">
                                            <span style="color:#787878; font-size:20px;">
                                                <input type="text" name="oldpw" class="form-control" style="color:#787878; font-weight:bold; border-radius:35px; padding:15px;" placeholder="">

                                        </span>
                                    </P>
                                    </p>
                                </div>

                                <div class="contact-info d-flex align-items-center mb-3">
                                    <img src="images/key-2.png" style="height:40px; width:40px;">
                                    <p class="mb-0">
                                        <span class="contact-info-small-title">&nbsp;&nbsp;&nbsp;&nbsp;新密碼：

                                            <p class="mb-0 text-center">
                                            <span style="color:#787878; font-size:20px;">
                                                <input type="text" name="newpw" class="form-control" style="color:#787878; font-weight:bold; border-radius:35px; padding:15px;" placeholder="">

                                        </span>
                                        </span>
                                    </p>

                                </div>


                                <div class="contact-info d-flex align-items-center mb-3">
                                    <img src="images/key-3.png" style="height:40px; width:40px;">

                                    <p class="mb-0">
                                        <span class="contact-info-small-title">&nbsp;&nbsp;&nbsp;&nbsp;確認密碼：

                                            <p class="mb-0 text-center">
                                            <span style="color:#787878; font-size:20px;">
                                                <input type="text" name="repw" class="form-control" style="color:#787878; font-weight:bold; border-radius:35px; padding:15px;" placeholder="">

                                        </span>
                                        </span>
                                    </p>
                                </div>
                                <br>
                                <div class="tag_menu_con">
                                    <ul>

                                        <li><button type="submit" name="submit" class="form-control">送出</button></li>
                                    </ul>
                                <?php
                            }

                                ?>
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
<?php
if (isset($_POST['submit'])) {
    $old_password = $_POST['oldpw'];
    $new_password = $_POST['newpw'];
    $confirm_password = $_POST['repw'];
    

    // 確認輸入的舊密碼是否正確
    $check_oldpw = mysqli_query($link, "SELECT * FROM `user` WHERE `mail`= '$email' AND `upw` = '$old_password'AND `uid` = '$uid'");

   
    $data_nums = mysqli_num_rows($check_oldpw);

    if ($data_nums > 0) {
   // if (mysqli_num_rows($result_check_oldpw) > 0) {
        if ($new_password === $confirm_password) {
            // 更新使用者的新密碼
            $sql_update_password = "UPDATE user SET upw = '$new_password' WHERE mail = '$email'AND `uid` = '$uid'";
            $result_update_password = mysqli_query($link, $sql_update_password);

            if ($result_update_password) {
                ?>
                <script language="JavaScript">
                    alert("密碼更新成功。");
                   
                   <?php echo "location.href='user.php?mail=$email';";?>
                </script>
        
            <?php
          
            
            } else {
                ?>
                <script language="JavaScript">
                    alert("密碼錯誤。"); 
                </script>
            <?php
            }
        } else {
            ?>
                <script language="JavaScript">
                    alert("新密碼與確認密碼不一致。");

                </script>
            <?php
        }
    } else {
        ?>
                <script language="JavaScript">
                    alert("舊密碼輸入錯誤。"); 
                </script>
            <?php
    }
}
?>