<?php
session_start(); require 'connect.php';
(INT)$id = $_GET['id'];
$name = $_GET['studentName'];
$email = $_GET['email'];
$phone = $_GET['phone'];
$class = $_GET['class'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student info</title>
    <head>
        <meta charset="utf-8">
        <title>Add Class</title>
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
                background-color: #4486db;
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
        <h2>Edit Student Info</h2>
        <?php
        if(!isset($_SESSION['userType']) || $_SESSION['userType'] != 'admin'){
            echo "You must be an administrator to perform this action. Please <a class=\"login\" href=\"login.php\">log in</a> if you have an admin account.<hr>";
            echo "<a href=\"displayUser.php\">Back</a><br>";
            exit();
        }
        ?>
        <form class="" action="" method="post">
            <table>
                <tr>
                    <td class="form">Student name:</td>
                    <td class="form">
                        <input style="height: 20px;" type="text" name="studentName" value="<?php echo $name; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="form">Email:</td>
                    <td class="form">
                        <input style="height: 20px;" type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="form">Phone:</td>
                    <td class="form">
                        <input style="height: 20px;" type="text" name="phone" value="<?php echo $phone; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="form">Class: </td>
                    <td class="form">
                        <select style="height: 24px;" class="className" name="class" value="">
                            <option value="Select:">Select:</option>
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
                        <input style="height: 18px; width: 84px;" type="text" name="currentClass" value="<?php echo $class ?>" disabled>
                    </td>
                </td>
                </tr>
                <tr style="text-align: center;">
                    <td colspan="2" style="text-align: center;">
                        <input style="width: 120px;height: 30px;" type="submit" name="save" value="Save">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if (isset($_POST['save'])) {
                if (empty($_POST['studentName']) || empty($_POST['email']) || empty($_POST['phone'])) {
                    die ("You must enter all required fields.");
                } else {
                    $newName = filter_var($_POST['studentName'], FILTER_SANITIZE_STRING);
                    $newEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                    $newPhone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
                    if ($_POST['class'] === 'Select:') {
                        $newClass = $class;
                    }else $newClass = $_POST['class'];
                    updateStudent($newName, $newEmail, $newPhone, $newClass, $id);
                    $name = '';
                    $email = '';
                    $phone = '';
                    $class = '';
                    header("location: displayUser.php");
                }
            }
        ?>
        <hr>
        <a href="displayUser.php">Back</a><br>
    </div>
</body>
</html>
