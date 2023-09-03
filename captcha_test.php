<!DOCTYPE html>
<html lang="en">
<head>

    <div style="border-width:3px;border-style:solid;margin-top:60px;height:400px;text-align:center;background-color:#add8e6">
        <div style="font-size:36px;padding-top:50px;">
            帳號<input type="text" name="f1" >
        </div>
        <div style="font-size:36px;padding-top:50px;">
            郵件<input type="text" name="f2">
        </div>

        <?php
        /*if(@$_GET['empty']==true)
            {
        ?>
        <div style="font-size:24px;padding-top:10px;">
            <?php echo $_GET['empty']?>
        </div>
        <?php      
            }
        ?> 

        <?php
        if(@$_GET['invalid']==true)
            {
        ?>
        <div style="font-size:24px;padding-top:10px;">
            <?php echo $_GET['invalid']?>
        </div>
        <?php      
            }*/
        ?>    


        <div>
            <a href="home.html">
                <input type="button" value="返回" style="font-size: 24px;">
            </a>

    
            <input type="submit" value="確定" name="find" style="font-size: 24px;">

        </div>


    </div>
</form>
</div>
</body>
</html>