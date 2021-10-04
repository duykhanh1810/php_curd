<?php
    session_start();
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Add Student</title>
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
                background-color: #6645ba;
                color: white;
                border-top-left-radius: 13px;
                border-top-right-radius: 13px;
            }
            table{
                border-collapse: collapse;
                margin: 0 auto;
                width: 53%;
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
            a{
                background-color: #6645ba;
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
            <h2>Register new student</h2>
            <?php
                if(!isset($_SESSION['userType']) || $_SESSION['userType'] != 'admin'){
                echo "You don't have permission to perform this function.<br><hr>";
                echo "<a href=\"welcome.php\">Go back</a> or <a href=\"login.php\">login</a>";
                exit();
                }
            ?>
            <form class="" action="" method="post">
                <table>
                    <tr>
                        <td class="form">Student name:</td>
                        <td class="form">
                            <input style="height: 20px;" type="text" name="studentName" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="form">Email:</td>
                        <td class="form">
                            <input style="height: 20px;" type="text" name="email" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="form">Phone:</td>
                        <td class="form">
                            <input style="height: 20px;" type="text" name="phone" value="">
                        </td>
                    </tr>
                    <tr>
                        <td class="form">Class: </td>
                        <td class="form">
                            <select style="height: 24px;" class="className" name="class">
                                <?php
                                    $conn = connect();
                                    $sql = "SELECT className from class";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows>0) {
                                        while($row = $result->fetch_assoc()){
                                            echo "<option>".$row['className']."</option>";
                                        }
                                    }
                                ?>
                            </select>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <input style="width: 120px;height: 30px;" type="submit" name="register" value="Register">
                        </td>
                    </tr>
                </table>
            </form>
            <hr>
            <a href="Welcome.php">Back</a> <a href="displayUser.php">Student List</a><br>
            <?php
                if (isset($_POST['register'])) {
                    if (empty($_POST['studentName']) || empty($_POST['email']) || empty($_POST['phone'])) {
                        die ("All fields are required.");
                    }
                    $name = filter_var($_POST['studentName'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                    $phone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
                    $class = filter_var($_POST['class'], FILTER_SANITIZE_STRING);
                    register($name, $email, $phone, $class);
                    echo "New student registered successfully.";
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
