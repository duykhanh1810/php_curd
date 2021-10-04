<?php
    session_start();
    unset($_SESSION['userType'],$_SESSION['userName']);
    include "connect.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
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
                background-color: #81a614;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            table{
                margin: 0 auto;
                width: 60%;
            }
            td{
                padding: 5px;
                text-align: left;
            }
            a{
                padding: 5px;
                text-decoration: none;
                border-radius: 6px;
                width: 120px;
                display: inline-block;
                color: white;
                background-color: #81a614;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <h2>Login</h2>

            <form class="" action="" method="post">
                <table>
                    <tr>
                        <td>User name:</td>
                        <td>
                            <input type="text" name="username" value="">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>
                            <input type="text" name="pass" value="">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="2">
                            <input style="width: 120px; height: 30px;" type="submit" name="login" value="Login">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if (isset($_POST['login'])) {
                    if (empty($_POST['username']) || empty($_POST['pass'])) {
                        echo "You must enter username and password.";
                    } else {
                        $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                        $pass = $_POST['pass'];
                        $pass = sha1($pass);
                        $login = logIn($name, $pass);
                        if($login == 1) {
                            echo ("Welcome admin");
                            $_SESSION['userType'] = 'admin';
                            $_SESSION['userName'] = $name;
                            $_SESSION['time'] = time();
                            header ("location: welcome.php");
                        } else if($login == 0) {
                            echo ("Welcome user");
                            $_SESSION['userType'] = 'user';
                            $_SESSION['userName'] = $name;
                            $_SESSION['time'] = time();
                            header ("location: welcome.php");
                        } else echo "Invalid username or password";
                    }
                }
            ?>
            <hr>
            <a href="Welcome.php">Back</a><br>
        </div>
    </body>
    <script type="text/javascript">
        if (window.history.replaceState){
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</html>
