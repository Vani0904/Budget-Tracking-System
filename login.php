<?php
session_start();
include "db_conn.php";
    if (isset($_POST['uname']) && isset($_POST['pword'])) {

        //Creating function to validate data
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $uname = validate($_POST['uname']);
        $pass = validate($_POST['pword']);

        //Checking the fields were correctly inputted 
        if (empty($uname)) {
            header("Location: index.php?error=Username is required");
            exit();
        } else if (empty($pass)){
            header("Location: index.php?error=Password is required");
            exit();
        }else {
            $sql = "SELECT * FROM employee WHERE user_name ='$uname' AND user_password ='$pass'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                if ($row['user_name'] === $uname && $row['user_password'] === $pass){
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['employee_id'] = $row['employee_id'];
                    $_SESSION['department_id'] = $row['department_id'];
                    header("Location: home.php");
                    exit();
                }

                print_r($row);
            } else {
                header("Location: index.php?error=Incorrect username or password");
                exit();
            }
        }
    }else{
        header("Location: index.php");
        exit();
    }
?>