<?php
session_start();
include "db_conn.php";
    if(isset($_POST['updateUser'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $fname = validate($_POST['fname']);
        $lname = validate($_POST['lname']);
        $pass = validate($_POST['passw']);
        $userid = validate($_POST['user-id']);
        $role = validate($_POST['role']);
        $isLocked = isset($_POST['is_locked']) ? 1 : 0;



        $firstLetterFirstName = strtoupper(substr($fname, 0,1));
        $firstLetterLastName = strtoupper(substr($lname, 0,1));
        $username = ($firstLetterFirstName.$firstLetterLastName.strtolower(substr($lname,1)));

        // check if the user is an employee
        if ($role == 1) {
            if (isset($_POST['department'])) {
                $department = validate($_POST['department']);
            } else if ($role == 0) {
                $department = null;
                exit();
            }else {
                header("Location: account-edit.php?error=department is required for employees");
                exit(); 
            }
        }

        $user_data = 'fname='. $fname. 'lname='. $lname. 'passw='. $pass. 'user-id='. $userid. 
        'username='. $username. 'role='. $role;

        
        
        //Checking the fields were correctly inputted 
        if (empty($fname)) {
            header("Location: account-edit.php?error=first name is required&$user_data");
            exit();
        } else if (empty($lname)){
            header("Location: account-edit.php?error=last name is required&$user_data");
            exit();
        } else if (empty($userid)){
            header("Location: account-edit.php?error=user id is required&$user_data");
            exit();
        } else {

            $sql_update = "UPDATE employee SET 
                user_name='$username',
                first_name='$fname',
                last_name='$lname', 
                department_id=". ($department === null ? "NULL" : "'$department'"). ",
                isEmployee=$role,
                isLocked=$isLocked";

                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $sql_update .=", user_password='$hashed_password'";
                }
                 $sql_update .= " WHERE employee_id=$userid";
                            
                $result_update = mysqli_query($conn, $sql_update);
                if ($result_update) {
                    header("Location: admin-home.php?success=the account has been updated successfully");
                    exit();
                } else {
                    header("Location: account-edit.php?error=unknown error occurred&$user_data");
                    exit();
                }
            }
            else if (isset($_POST['updateDept'])){
                function validate($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                $departmentId = validate($_POST['department-id']);
                $departmentName = validate($_POST['dname']);
                $departmentBudget = validate($_POST['department-budg']);
                $departmentExpenses = validate($_POST['department-exp']);
                $departmentDeadline = validate($_POST['department-deadline']);
        
                $dept_data = 'department-id='. $departmentId. 'dname='. $departmentName. 'department-budg='. $departmentBudget. 'department-exp='. $departmentExpenses. 
                'department-deadline='. $departmentDeadline;
        
                
                
                //Checking the fields were correctly inputted 
                if (empty($departmentName)) {
                    header("Location: account-edit.php?error=Department name is required&$dept_data");
                    exit();
                } else {
                    $sql_update = "UPDATE department SET 
                        department_id='$departmentId',
                        department_name=' $departmentName',
                        department_budget='$departmentBudget', 
                        department_expenses='$departmentExpenses',
                        department_deadline='$departmentDeadline'
                        WHERE department_id='$departmentId'";
                        }
                                    
                        $result_update = mysqli_query($conn, $sql_update);
                        if ($result_update) {
                            header("Location: admin-home.php?success=the department has been updated successfully");
                            exit();
                        } else {
                            header("Location: account-edit.php?error=unknown error occurred&$dept_data");
                            exit();
                        }   

            } else{
        header("Location: account-creation.php");
        exit();
    }
?>