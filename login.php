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
            
            $sql = "SELECT * FROM employee WHERE user_name ='$uname' LIMIT 1";

            $hashedPassword = $row['user_password'];

            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);

                $hashedPassword = $row['user_password'];
                if (password_verify($pass,$hashedPassword)){
    
                    if($row['isLocked'] == 1) {
                        header("Location: index.php?error=This account is locked. Please contact the admin");
                        exit();
                    }
                    if($row['isEmployee'] == 1) {
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['first_name'] = $row['first_name'];
                        $_SESSION['employee_id'] = $row['employee_id'];
                        $_SESSION['department_id'] = $row['department_id'];
                        header("Location:home.php?success=Logged in Successfully");
                        exit();
                    } else {
                        $_SESSION['user_name'] = $row['user_name'];
                        $_SESSION['first_name'] = $row['first_name'];
                        $_SESSION['employee_id'] = $row['employee_id'];
                        $_SESSION['department_id'] = $row['department_id'];
                        header('Location: admin-home.php?success=Logged in Successfully');
                        exit();
                    }
                } else { 
                    header("Location: index.php?error=Incorrect Password");
                    exit();
                }
            } else {
                header("Location: index.php?error=Incorrect Username");
                exit();
            }
        }
    }else{
        header("Location: index.php");
        exit();
    } 
?>