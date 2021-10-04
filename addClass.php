<?php
    session_start();
    include 'connect.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Add Class</title>
        <style media="screen">
            .container{
                margin: 0 auto;
                width: 40%;
                text-align: center;
                background-color: #cccccc;
                font-family: tahoma;
                padding-bottom: 20px;
                border-radius: 13px;
            }
            h2{
                padding: 10px;
                background-color: #4486db;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            table{
                border-collapse: collapse;
                margin: 0 auto;
                width: 65%;
                text-align: center;
            }
            tr{
                text-align: center;
            }

            a{
                /* border: 1px solid; */
                background-color: #4486db;
                color: white;
                padding: 5px;
                text-decoration: none;
                border-radius: 6px;
                width: 120px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Add new Class</h2>
            <?php
            if (!isset($_SESSION['userType']) || $_SESSION['userType'] != 'admin') {
                echo "You don't have permission to perform this function.<br><hr>";
                echo "<a href=\"welcome.php\">Go back</a> or <a href=\"login.php\">login</a>";
                exit();
            }
            ?>
            <form class="" action="" method="post">
                <table>
                    <tr>
                        <td>Class name:</td>
                        <td>
                            <input style="height: 20px;" type="text" name="className" value="">
                        </td>
                        <td>
                            <input style="width: 110px;height: 25px;" type="submit" name="addClass" value="Add Class">
                        </td>
                    </tr>
                </table>
            </form>
            <br><hr>
            <a href="Welcome.php">Back</a><br>
            <?php
                if (isset($_POST['addClass'])) {
                    if (empty($_POST['className'])) {
                        die ("You must enter class name.");
                    } else {
                        $name = $_POST['className'];
                        addClass($name);
                        echo "New class added successfully.";
                    }
                }
            ?>
        </div>
    </body>
    <script type="text/javascript">
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</html>
