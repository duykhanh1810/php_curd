<?php
session_start(); include 'connect.php';
(INT)$id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Delete Student</title>
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
                background-color: red;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            table{
                border-collapse: collapse;
                margin: 0 auto;
                width: 60%;
                text-align: center;
                table-layout: fixed;
            }
            tr{
                text-align: center;
            }
            td{
                padding-bottom: 3px;
                padding-left: 10px;
                padding-right: 10px;
            }
            td:nth-child(odd){
                text-align: right;
            }
            td:nth-child(even){
                text-align: left;
            }
            a:not(.login){
                /* border: 1px solid; */
                background-color: red;
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
            <h2>Delete Student</h2>
            <?php
            if(!isset($_SESSION['userType']) || $_SESSION['userType'] != 'admin'){
                echo "You must be an administrator to perform this action. Please <a class=\"login\" href=\"login.php\">log in</a> if you have an admin account.<hr>";
                echo "<a href=\"displayUser.php\">Back</a><br>";
                exit();
            }else
            deleteStudent($id);
            header("location: displayUser.php");
            ?>
        </div>
    </body>
</html>
