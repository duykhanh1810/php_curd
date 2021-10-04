<?php
    function connect() {
        $svName = 'localhost';
        $userName = 'root';
        $pass = '';
        $dbName = 'qlsinhvien';
        if ($conn = new mysqli($svName, $userName, $pass, $dbName)) {
            return $conn;
        }else return null;
    }

    function checkPhone($phone){
        $conn = connect();
        if($conn != null){
            $sql = "SELECT phone FROM student WHERE phone = ?";
            $prepStm = $conn->prepare($sql);
            $prepStm->bind_param("s", $phone);
            $prepStm->execute();
            $result = $prepStm->get_result();
            if ($result->num_rows>0) {
                return false;
            }else return true;
        }
        else die ("Connection failed.");
    }

    function checkEmail($email){
        $conn = connect();
        if($conn != null){
            $sql = "SELECT email FROM student WHERE email = ?";
            $prepStm = $conn->prepare($sql);
            $prepStm->bind_param("s", $email);
            $prepStm->execute();
            $result = $prepStm->get_result();
            if ($result->num_rows>0) {
                return false;
            }else return true;
        }
        else die ("Connection failed.");
    }


    function register($name, $email, $phone, $class){
        $conn = connect();
        if($conn === null){
            die("Connection failed.");
        }
        else {
            $chkEmail = checkEmail($email);
            $chkPhone = checkPhone($phone);
            if ($chkEmail === false || $chkPhone === false) {
                die("Email or Phone has already been taken.");
            }
        }
        $sql = "INSERT INTO student (name, email, phone, class) VALUES (?, ?, ?, ?)";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssss", $name, $email, $phone, $class);
        $stm->execute();
        $stm->close();
    }

    function addClass($name){
        $conn = connect();
        if($conn === null){
            die("Connection failed.");
        }
        else{
            $sql = "SELECT className FROM class WHERE className = ?";
            $prepStm = $conn->prepare($sql);
            $prepStm->bind_param("s", $name);
            $prepStm->execute();
            $result = $prepStm->get_result();
            if ($result->num_rows>0) {
                die("The class name you entered has already existed in the database.");
            } else {
                $sql_ins = "INSERT INTO class (className) VALUES (?)";
                $stm = $conn->prepare($sql_ins);
                $stm->bind_param("s", $name);
                $stm->execute();
                $stm->close();
            }
        }
    }
    function Login($name, $pass){
        $conn = connect();
        $sql = "SELECT username, userType, pass FROM users WHERE username = ? and pass = ?";
        $prep = $conn->prepare($sql);
        $prep->bind_param("ss", $name, $pass);
        $prep->execute();
        $result = $prep->get_result();
        $prep->close();
        if ($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $type = $row['userType']; //get the type of the user's account from database
            }
            if($type == "admin"){
                return 1; //if the user's type is 'admin' then return 1 and grand access to the database
            }else if($type == "user"){
                return 0; //if the user's type is 'user' then return 0
            }else return -1; //value -1 mean no username and password match in database
        }else return -1;
    }

    function viewStudent(){
        $conn = connect();
        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            echo "
                <table>
                <tr><th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Class</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td><td>".$row['class']."</td>
                <td><a class=\"update\" href=\"editStudent.php?id=".$row['id']."&studentName=".$row['name']."&email=".$row['email']."&phone=".$row['phone']."&class=".$row['class']."\">Edit</a></td>
                <td><a class=\"del\" href=\"DeleteStudent.php?id=".$row['id']."\" onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a></td>
                </tr>";
            }
            echo "</table>";
        }
    }

    function viewClass(){
        $conn = connect();
        $sql = "SELECT * FROM class";
        $result = $conn->query($sql);
        if ($result->num_rows>0) {
            echo "
                <table>
                <tr><th>Class ID</th>
                <th>Class Name</th>
                </tr>";
            while($row = $result->fetch_assoc()){
                echo "<tr><td>".$row['classID']."</td><td>".$row['className']."</td></tr>";
            }
            echo "</table>";
        }
    }

    function updateStudent($name, $email, $phone, $class, $id) {
        $conn = connect();
        $sql = "UPDATE student
                SET name = ?, email = ?, phone = ?, class = ?
                WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("ssssi",$name, $email, $phone, $class, $id);
        $stm->execute();
        $stm->close();
        $conn->close();
    }

    function deleteStudent($id){
        $conn = connect();
        $sql = "DELETE FROM student WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param("i", $id);
        $stm->execute();
        $stm->close();
        $conn->close();
    }
?>
