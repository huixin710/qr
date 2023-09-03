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

  <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;700&display=swap" rel="stylesheet">

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/bootstrap-icons.css" rel="stylesheet">

  <link href="css/apexcharts.css" rel="stylesheet">

  <link href="css/owl.carousel.min.css" rel="stylesheet">

  <link href="css/owl.theme.default.min.css" rel="stylesheet">

  <link href="css/tooplate-gotto-job.css" rel="stylesheet">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

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

  # 設定時區
  date_default_timezone_set('Asia/Taipei');
  $today = date('Y-m-d H:i:s'); // 目前的日期
  ?>
</head>
<style>
  img {
    width: 50%;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  .new_tit {
    font-size: 30px;
    padding: 10px 0 10px 0;
    border-bottom: 3px solid #E8E8E8;
    position: relative;
    color: #333;
    font-weight: 400;
  }

  .new_tit::before {
    content: "";
    position: absolute;
    height: 3px;
    width: 80px;
    left: 0;
    bottom: -3px;
    background-color: #FFA600;
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

  .custom-btn {
    background: var(--custom-btn-bg-color);
    border: 2px solid transparent;
    border-radius: var(--border-radius-large);
    color: var(--white-color);
    font-size: var(--btn-font-size);
    font-weight: var(--font-weight-normal);
    line-height: normal;
    padding: 10px 5px;
  }
</style>


<body id="top">
  <?php
  if (isset($_GET['aid'])) {
    $activity_id = $_GET['aid'];
  } else {
    echo "未提供活動 ID";
    exit;
  }

  $sql = "SELECT * FROM `activites`WHERE `aid` = '$activity_id'";
  $result = mysqli_query($link, $sql);
  $result2 = mysqli_query($link, "SELECT `iname` FROM `activites_img` WHERE `aid` = $activity_id");
  $data_nums = mysqli_num_rows($result2); //統計總比數
  ?>
  <main>
    <section class="section-padding pb-0 d-flex justify-content-center align-items-center">
      <div class="container">
        <div class="row">
          <form class="custom-form" action="" method="POST" role="form" enctype="multipart/form-data">
            <div class="title-group mb-3 text-center">
              <h1 style="color:#787878; font-weight:bold; font-size:50px;" class="mb-0">活動資料</h1>
              <br>
              <hr><br>
            </div>
            <div id="carouselExampleDark" class="carousel carousel-dark slide col-lg-12 col-md-12 col-18 text-center" data-bs-ride="carousel">
              <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <?php
                if (isset($_SESSION['id'])) {
                  for ($x = 1; $x <= $data_nums; $x++) {
                    $y = 2;
                    echo "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='" . $x . "' aria-label='Slide" . $y . "'></button>";
                    $y = $y + 1;
                  }
                } else {
                  for ($x = 1; $x < $data_nums; $x++) {
                    $y = 2;
                    echo "<button type='button' data-bs-target='#carouselExampleDark' data-bs-slide-to='" . $x . "' aria-label='Slide" . $y . "'></button>";
                    $y = $y + 1;
                  }
                }
                ?>
              </div>
              <div class="carousel-inner">
                <?php
                if (isset($_SESSION['id'])) {
                  if (mysqli_num_rows($result) > 0) {
                ?>
                    <div class="carousel-item active">
                      <div class="text-center">
                        <div id="qrcode"></div><!--qrcode-->
                      </div>
                    </div>
                <?php
                    $row = mysqli_fetch_assoc($result);
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) {
                      echo "<div class='carousel-item'>";
                      echo "<img src='$row2[0]' class='d-block w-100' alt='...'>";
                      echo "</div>";
                    }
                  }
                } else {
                  if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $firstSlide = true; // 设置初始激活状态
                    while ($row2 = mysqli_fetch_array($result2, MYSQLI_NUM)) {
                      echo '<div class="carousel-item' . ($firstSlide ? ' active' : '') . '">';
                      echo "<img src='$row2[0]' class='d-block w-100' alt='...'>";
                      echo "</div>";
                      $firstSlide = false; // 关闭初始激活状态，后续都是非激活状态
                    }
                  }
                }
                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>

            </div>
            <br>

            <div class="container">
              <div class="row">
                <?php
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>活動名稱</h2>";
                echo "<h3>" . $row['aname'] . "</h3><br><br>";
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>活動地點</h2>";
                echo "<h3>" . $row['address'] . "</h3><br><br>";
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>活動負責人</h2>";
                echo "<h3>" . $row['head'] . "</h3><br><br>";
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>點數最大值</h2>";
                echo "<h3>" . $row['maxpoint'] . "點</h3><br><br>";
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>規則</h2>";
                echo "<h3>" . nl2br($row['rule']) . "</h3><br><br>";
                echo "<h2 style='font-weight:bold; color:#787878;' class='new_tit'>活動期間</h2>";
                echo "<h3>" . $row['startdatetime'] . "～" . $row['enddatetime'] . "</h3><br><br>";
                echo "<br>";
                echo "<table>";
                echo "<tr>
                                                <div class='col-lg-6 col-6'>
                                                    <a href='booth.php?aid=$activity_id' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='　　活動攤位　　' style='background-color:transparent;  border:none; color:white;' ></a>
                                                </div>
                                            </tr>";
                echo "<tr>
                                                <div class='col-lg-6 col-6'>
                                                    <a href='prize.php?aid=$activity_id&maxpoint=" . $row['maxpoint'] . "' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='　　活動獎品　　' style='background-color:transparent;  border:none; color:white;' ></a>
                                                </div>
                                            </tr>";
                echo "</table>";
                if (isset($_SESSION['id'])) {


                ?>
                  <br>
                  <table>

                    <div class="col-lg-6 col-6">
                      <?php echo "<a href='update.php?aid=$_GET[aid]' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='　　　修改　　　' style='background-color:transparent;  border:none; color:white;' ></a>"; ?>
                    </div>
                    </tr>
                    <tr>
                      <div class="col-lg-6 col-6">
                        <?php echo "<a href='history_start.php' style='background-color:#FFA600' class='custom-btn btn'><input type='button' value='　　　返回　　　' style='background-color:transparent;  border:none; color:white;' ></a>"; ?>
                      </div>
                    </tr>
                  </table>
                <?php  } ?>
              </div>
            </div>
          </form>
          <div class="col-lg-50 col-50">
            <div class="w3-container" id="where" style="padding-bottom:64px;">
              <div class="w3-content" style="max-width:700px">
                </dvi>
              </div>
            </div>
            </dvi>
            </dvi>
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
  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script src="js/qrcode.js"></script>
  <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
  <script>
    $(function() {

      createqrcode();

      function createqrcode() {
        var input_text = "http://127.0.0.1/qrfun1/detailed.php?aid=<?php echo $activity_id ?>"; //qrcode網址
        var width = 170; //qrcode大小
        rectangle = width + "x" + width;
        var url = "https://chart.googleapis.com/chart?chs=" + rectangle + "&cht=qr&chl=" + input_text + "&choe=UTF-8&chld=M|2";
        var qr_code = "<img alt='Your QRcode' src='" + url + "' />";
        $('#qrcode').html(qr_code);
        $('#range_value').html(width);
      }

      $("#down_img_btn").click(function() {
        var input_text = $("#input_text").val();
        var range = $("#range").val();
        $.ajax({
          url: "qrcode_action.php",
          data: "&input_text=" + input_text + "&range=" + range,
          type: "POST",
          dataType: 'text',

          success: function(message) {
            document.getElementById("message").innerHTML = message;
          },

          error: function(jqXHR, textStatus, errorThrown) {
            document.getElementById("message").innerHTML = errorThrown;
          }
        });
      });
    });
  </script>


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