<?php
session_start();
include "db_conn.php";
    if (isset($_POST['createDept'])) {

        //Creating function to validate data
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $departmentId = validate($_POST['department-id']);
        $departmentName = validate($_POST['dname']);
        $departmentBudget = validate($_POST['department-budg']);
        $departmentAddressOne = validate($_POST['address-one']);
        $departmentAddressTwo = validate($_POST['address-two']);
        $departmentPostcode = validate($_POST['post-code']);
        $departmentDeadline = validate($_POST['department-deadline']);

        $dept_data = 'department-id=' . $departmentId . 
        ', dname=' . $departmentName . 
        ', department-budg=' . $departmentBudget . 
        ', address-one=' . $departmentAddressOne . 
        ', address-two=' . $departmentAddressTwo . 
        ', post-code=' . $departmentPostcode . 
        ', department-deadline=' . $departmentDeadline;
        
        //Checking the fields were correctly inputted 
        if (empty($departmentId)) {
            header("Location: department-creation.php?error=Department ID is required&$dept_data");
            exit();
        } else if (empty($departmentName)){
            header("Location: department-creation.php?error=Department name is required&$dept_data");
            exit();
        } else if (empty($departmentBudget)){
            header("Location: department-creation.php?error=Department Budget is required&$dept_data");
            exit();
        } else if (empty($departmentAddressOne)){
            header("Location: department-creation.php?error=Department Address is required&$dept_data");
            exit();
        } else if (empty($departmentAddressTwo)){
            header("Location: department-creation.php?error=Department Address is required&$dept_data");
            exit();
        } else if (empty($departmentPostcode)){
            header("Location: department-creation.php?error=Postcode is required&$dept_data");
            exit();
        } else if (empty($departmentDeadline)){
            header("Location: department-creation.php?error=Deadline is required&$dept_data");
            exit();
        } else {
            $sql_check_dept = "SELECT * FROM department WHERE department_id='$departmentId'";
            $result_check_dept = mysqli_query($conn, $sql_check_dept);

            if (mysqli_num_rows($result_check_dept) > 0) {
                header("Location: department-creation.php?error=Department  already exists&$dept_data");
                exit();
            } else {
                

                $sql_insert_dept = "INSERT INTO department (department_id, department_name, department_budget, address_1, address_2, post_code, department_deadline) 
                VALUES ('$departmentId', '$departmentName', '$departmentBudget', '$departmentAddressOne', '$departmentAddressTwo', '$departmentPostcode', '$departmentDeadline')";

                $result_insert_dept = mysqli_query($conn, $sql_insert_dept);
                if ($result_insert_dept) {
                    header("Location: admin-home.php?success=the department has been created successfully");
                    exit();
                } else {
                    header("Location: department-creation.php?error=unknown error occurred&$dept_data");
                    exit();
                }
            }
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
                    $departmentAddressOne = validate($_POST['address-one']);
                    $departmentAddressTwo = validate($_POST['address-two']);
                    $departmentPostcode = validate($_POST['post-code']);
                    $departmentDeadline = validate($_POST['department-deadline']);
                    
                    $dept_data = 'department-id=' . $departmentId . 
                    ', dname=' . $departmentName . 
                    ', department-budg=' . $departmentBudget . 
                    ', address-one=' . $departmentAddressOne . 
                    ', address-two=' . $departmentAddressTwo . 
                    ', post-code=' . $departmentPostcode . 
                    ', department-deadline=' . $departmentDeadline;
                    
                    
                    //Checking the fields were correctly inputted 
                    if (empty($departmentId)) {
                        header("Location: department-edit.php?error=Department ID is required&$dept_data");
                        exit();
                    } else if (empty($departmentName)){
                        header("Location: department-edit.php?error=Department name is required&$dept_data");
                        exit();
                    } else if (empty($departmentBudget)){
                        header("Location: department-edit.php?error=Department Budget is required&$dept_data");
                        exit();
                    } else if (empty($departmentAddressOne)){
                        header("Location: department-edit.php?error=Department Address is required&$dept_data");
                        exit();
                    } else if (empty($departmentAddressTwo)){
                        header("Location: department-edit.php?error=Department Address is required&$dept_data");
                        exit();
                    } else if (empty($departmentPostcode)){
                        header("Location: department-edit.php?error=Postcode is required&$dept_data");
                        exit();
                    } else if (empty($departmentDeadline)){
                        header("Location: department-edit.php?error=Deadline is required&$dept_data");
                        exit();
                    } else {
                        $sql_update = "UPDATE department SET 
                        department_name=' $departmentName',
                        department_budget='$departmentBudget', 
                        department_deadline='$departmentDeadline',
                        address_1='$departmentAddressOne',
                        address_2='$departmentAddressTwo',
                        post_code='$departmentPostcode'
                        WHERE department_id='$departmentId'";
                        }
                            
                                        
                            $result_update = mysqli_query($conn, $sql_update);
                            if ($result_update) {
                                header("Location: admin-home.php?success=the department has been updated successfully");
                                exit();
                            } else {
                                header("Location: department-edit.php?error=unknown error occurred&$dept_data");
                                exit();
                            }   

                }else{
            header("Location: admin-home.php");
            exit();
        }
?>