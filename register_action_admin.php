<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require("includes/connection.php");
    $appmail=$_GET['appmail'];
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
</head>

<body>
    <?php
    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $name = $_POST['name'];
    $department = $_POST['department'];

    $select = "SELECT `appid`,`app_pw` FROM applicant WHERE `appid`='$id'";
    $result = mysqli_query($link, $select);
    if ($_POST['b1']) {
        if ($result->num_rows > 0) {
        ?>
            <script language="JavaScript">
                alert("此用戶名已有人註冊");
                <?php
                    echo"location.href='register_admin.php?appmail=$appmail'";
                ?>
            </script>
        <?php
        } elseif ($id == "") {
        ?>
            <script language="JavaScript">
                alert("帳號不能為空");
                <?php
                    echo"location.href='register_admin.php?appmail=$appmail'";
                ?>
            </script>

        <?php
        } elseif ($pw == "") {
        ?>
            <script language="JavaScript">
                alert("密碼不能為空");
                window.history.back(-1)
            </script>
        <?php
        } elseif ($name == "") {
        ?>
            <script language="JavaScript">
                alert("姓名不能為空");
                window.history.back(-1)
            </script>
        <?php
        /*} elseif ($mail == "") {
        ?>
            <script language="JavaScript">
                alert("電子郵件不能為空");
                window.history.back(-1)
            </script>
        <?php*/
        } elseif ($department == "") {
        ?>
            <script language="JavaScript">
                alert("單位不能為空");
                window.history.back(-1)
            </script>
        <?php
        } else {
            mysqli_query($link, "INSERT INTO applicant(`appid`,`app_pw`,`appname`,`department`,`mail`) VALUES ('$id','$pw','$name','$department','$appmail')");
        ?>
            <script language="JavaScript">
                //alert("註冊成功");
                location.href = "login_admin.php";
            </script>
    <?php
        }
    }
    ?>

</body>

</html>