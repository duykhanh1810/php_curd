<?php session_start();
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <style media="screen">
            .container{
                margin: 0 auto;
                width: 40%;
                text-align: center;
                background-color: #cccccc;
                font-family: calibri;
                padding-bottom: 20px;
                border-radius: 13px;
            }
            h2{
                padding: 10px;
                background-color: #008c25;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            table{
                border-collapse: collapse;
                margin: 0 auto;
                width: 60%;
                text-align: center;
            }
            th{
                background-color: #4d718c;
                color: white;
            }
            tr:nth-child(odd){
                background-color: white;
            }
            .btn{
                /* border: 1px solid; */
                background-color: #008c25;
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
            <h2>Class list</h2>
            <?php
                viewClass(); 
            ?>
            <br>
            <hr>
            <a class="btn" href="Welcome.php">Back</a><br>
        </div>
    </body>
</html>
