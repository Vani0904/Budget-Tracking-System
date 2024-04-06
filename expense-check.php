
<?php
session_start();
include "db_conn.php";
if(isset($_SESSION['department_id'])) {
        $departmentId = $_SESSION['department_id'];
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

                        $exp_data = 'expenses_id='. $expenseId. 'date_created='. $date. 'amount='. $amount. 'status='. $status;
                
                        //Checking the fields were correctly inputted 
                        if (empty($amount)) {
                            header("Location: expense-edit.php?error=Expense amount is required&$exp_data");
                            exit();
                        } else {
                            $sql_update = "UPDATE expenses SET 
                                date_created= '$date',
                                amount=$amount, 
                                `status`='$status'
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
                        
                        $exp_data = 'date_created='. $date. 'amount='. $amount. 'status='. $status;
                
                        //Checking the fields were correctly inputted 
                        if (empty($amount) || empty($departmentId)) {
                            header("Location: expense-edit.php?error=Expense amount is required&$exp_data");
                            exit();
                        } else {
                                $sql_insert_expenses = "INSERT INTO expenses(date_created, amount,`comments`,`status`) 
                                VALUES ('$date','$amount','$comment','$status')";
                                
                                $result_insert_expenses = mysqli_query($conn, $sql_insert_expenses);
                            if ($result_insert_expenses) {

                                $expenseId = mysqli_insert_id($conn);

                                $sql_insert_link = "INSERT INTO department_expenses(expenses_id, department_id) 
                                VALUES ('$expenseId', '$departmentId')";
                                
                                            
                                $result_insert_link = mysqli_query($conn, $sql_insert_link);
                                if ($result_insert_link) {
                                    header("Location: expenses.php?success=the expense has been created successfully");
                                    exit();
                                } else {
                                    header("Location: expense-edit.php?error=unknown error occurred linking expense to department&$exp_data");
                                    exit();
                                }
                            } else {
                                header("Location: expense-edit.php?error=unknown error occurred while creating expense&$exp_data");
                                exit();
                            } 
                        }
                    }
                        else{
                    header("Location: expenses.php");
                    exit();
            }
        }
?>