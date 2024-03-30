
<?php
session_start();
include "db_conn.php";
     if (isset($_POST['updateExpense'])){
                    function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $expenseId = validate($_POST['expense-id']);
                    $date = date('Y-m-d');
                    $amount = validate($_POST['amount']);
                    $comment = isset($_POST['comment']) ? validate($_POST['comment']) : null;
                    $status = 0;

                    $departmentId = $_POST['department-id'];
            
                    $exp_data = 'expenses_id='. $expenseId. 'date_created='. $date. 'amount='. $amount. 'status='. $status;
            
                    //Checking the fields were correctly inputted 
                    if (empty($amount)) {
                        header("Location: expense-edit.php?error=Expense amount is required&$exp_data");
                        exit();
                    } else {
                        $sql_update = "UPDATE expenses SET 
                            date_created= '$date',
                            amount=$amount, 
                            `status`='$status',
                            department_id = '$departmentId'
                            WHERE expenses_id='$expenseId'";
                            }
                                        
                            $result_update = mysqli_query($conn, $sql_update);
                            if ($result_update) {
                                header("Location: expenses.php?success=the expense has been updated successfully");
                                exit();
                            } else {
                                header("Location: expense-edit.php?error=unknown error occurred&$exp_data");
                                exit();
                            }   
                } else if (isset($_POST['createExpense'])){
                    function validate($data){
                        $data = trim($data);
                        $data = stripslashes($data);
                        $data = htmlspecialchars($data);
                        return $data;
                    }
                    $date = date('Y-m-d');
                    $amount = validate($_POST['amount']);
                    $comment = isset($_POST['comment']) ? validate($_POST['comment']) : null;
                    $status = 0;
                    
                    $departmentId = $_POST['department-id'];
                    $exp_data = 'date_created='. $date. 'amount='. $amount. 'status='. $status;
            
                    //Checking the fields were correctly inputted 
                    if (empty($amount) || empty($departmentId)) {
                        header("Location: expense-edit.php?error=Expense amount is required&$exp_data");
                        exit();
                    } else {
                            $sql_insert = "INSERT INTO expenses(date_created, amount,`comments`,`status`, department_id) 
                            VALUES ('$date','$amount','$comment','$status', '$departmentId')";
                            
                                        
                            $result_insert = mysqli_query($conn, $sql_insert);
                            if ($result_insert) {
                                header("Location: expenses.php?success=the expense has been created successfully");
                                exit();
                            } else {
                                header("Location: expense-edit.php?error=unknown error occurred&$exp_data");
                                exit();
                            }   
                }
            }
                else{
            header("Location: expenses.php");
            exit();
        }
?>