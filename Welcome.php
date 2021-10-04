<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <style media="screen">
            .container{
                margin: 0 auto;
                width: 50%;
                text-align: center;
                background-color: #cccccc;
                font-family: tahoma;
                padding-bottom: 20px;
                border-radius: 13px;
            }
            h2{
                padding: 10px;
                background-color: cadetblue;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            .link a{
                border: 1px solid;
                padding: 5px;
                text-decoration: none;
                border-radius: 6px;
                width: 120px;
                display: inline-block;
            }
            .vs:hover{
                color: white;
                background-color: #003d87;
                border: 1px solid #003d87;
                transition: 0.1s;
            }
            .vc:hover{
                color: white;
                background-color: #008c25;
                border: 1px solid #008c25;
                transition: 0.1s;
            }
            .as:hover{
                color: white;
                background-color: #6645ba;
                border: 1px solid #6645ba;
                transition: 0.1s;
            }
            .ac:hover{
                color: white;
                background-color: #4486db;
                border: 1px solid #4486db;
                transition: 0.1s;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>Student Management System</h2>
            <?php
            if(isset($_SESSION['userName'])){
                echo "Welcome: ".$_SESSION['userName']."<br>";
                $duration = time() - $_SESSION['time'];
                echo "time left: ".(1000-$duration)." s<br>";
                if ($duration > 1000) {
                    unset($_POST['userType'], $_SESSION['userName']);
                    header("location: logout.php");
                }
                echo "<a href=\"logout.php\">logout</a><br><br>";
            }else echo "<p>Please <a href=\"login.php\">login</a> to use administrative functions.</p>";
            ?>
            <div class="link">
                <a class="vs" href="displayUser.php">View Students</a>&nbsp;&nbsp;
                <a class="vc" href="displayClass.php">View Classes</a>&nbsp;&nbsp;
                <a class="as" href="addStudent.php">Register Student</a>&nbsp;&nbsp;  
                <a class="ac" href="addClass.php">Add Class</a>
            </div>
        </div>
    </body>
</html>
