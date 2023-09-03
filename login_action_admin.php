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

    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $_SESSION['id'] = $id;

    $select = "SELECT `appid`,`app_pw` FROM applicant WHERE appid='$id'";
   
    $result = mysqli_query($link, $select);
  
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            if ($pw == $row[1]) {

    ?>
                <script>
                    //alert("登入成功");
                    location.href = "history_start.php";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("密碼錯誤");
                    location.href = "login_admin.php";
                </script>
            <?php
            }
        }
    
    } else {
        ?>
        <script language="JavaScript">
            alert("不存在此帳號");
            location.href = "login_admin.php";
        </script>
    <?php
    }
    ?>
</body>

</html>