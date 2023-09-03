<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require("includes/connection.php");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();
    $uid = $_POST['uid'];
    $_SESSION['uid'] = $uid;
    $pw = $_POST['pw'];
    if(isset($_POST['appid']) && isset($_POST['aid']) && isset($_POST['bid'])){
        $appid =$_POST['appid'];
        $aid = $_POST['aid'];
        $bid =$_POST['bid'];
    }
    $select = "SELECT `uid`,`upw` FROM user WHERE `uid`='$uid'";
    $result = mysqli_query($link, $select);
   
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            if ($pw == $row[1]) {

    ?>
                <script>
                    //alert("登入成功");
                    //location.href = "user_home.html";
                </script>
                    <?php
                    if(isset($_POST['appid']) && isset($_POST['aid']) && isset($_POST['bid'])){
                    ?> 
                        <script>      
                            location.href = "qrcode_booth.php?appid=<?php echo $appid?>&aid=<?php echo $aid?>&bid=<?php echo $bid?>";
                        </script>
                    <?php
                    }else{
                    ?>
                        <script>
                            location.href = "user_home.php";
                        </script>
                    <?php
                    }
                    ?>
                    
               
            <?php
            } else {
            ?>
                <script>
                    alert("密碼錯誤");
                    location.href = "login_user.php";
                </script>
            <?php
            }
        }
    } else {
        ?>
        <script language="JavaScript">
            alert("不存在此帳號");
            location.href = "login_user.php";
        </script>
    <?php
    }
    ?>
</body>

</html>