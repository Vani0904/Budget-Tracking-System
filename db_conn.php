<?php
    /*
    $adminUserName = $_POST['admin_username'];
    $adminPassword = $_POST['admin_password'];
    

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bt_schema";

    */

    $userName = $_POST['user_username'];
    $userPassword = $_POST['user_password'];
    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //Check the connection
    if ($conn->connect_error){
        die("Connection failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from employee where user_username = ?");
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['user_password'] === $userPassword) {
                echo "<h2>Login Successful</h2>";
            } else {
                echo "<h2>Invalid username or password</h2>";
            }
            
        } else {
            echo "<h2>Invalid username or password</h2>";
        }
    }
    

?>