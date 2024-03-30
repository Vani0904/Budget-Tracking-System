<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['employee_id']) && isset($_SESSION['user_name'])) {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $expense_id = $_GET['id'];
        $action = $_GET['action'];

        if ($action === 'approve') {
        // Update the status of the expense to 1 (approved)
        $query = "UPDATE expenses SET status = 1 WHERE expenses_id = $expense_id";
        $result = mysqli_query($conn, $query);

        if ($result){
            $get_dept_id_query = "SELECT department_id FROM department_expenses WHERE expenses_id = $expense_id";
            $dept_id_result = mysqli_query($conn, $get_dept_id_query);

            if ($dept_id_result && mysqli_num_rows($dept_id_result) > 0) {
                $row = mysqli_fetch_assoc($dept_id_result);
                $department_id = $row['department_id'];


                //Update the department expenses
                $update_expenses_query = "UPDATE department SET department_expenses =
                                                department_expenses + (SELECT amount FROM expenses WHERE expenses_id = $expense_id)
                                                WHERE department_id = $department_id";

                $update_result = mysqli_query($conn, $update_expenses_query);
            if (!$update_result) {
                echo "Error updating department expenses: ". mysqli_error($conn);
            }
            } else {
                echo "Department ID not found for the approved expense";
            }
        } else {
            echo "error approving expense: ".mysqli_error($conn);
        }  
        } else if ($action === 'reject'){
        $query = "UPDATE expenses SET status = 0 WHERE expenses_id = $expense_id";
        } else {
            echo "Invalid Action";
            exit();
        }
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Redirect back to the expenses management page after approval
            header("Location: admin-expenses.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Expense ID not provided";
    }
} else {
    header("Location: admin-expenses.php");
    exit();
}
?>