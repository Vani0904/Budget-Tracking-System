<?php
session_start();
include "db_conn.php";
include "function.php";

if (isset($_SESSION['employee_id']) && isset($_SESSION['user_name'])) {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $expense_id = $_GET['id'];
        $action = $_GET['action'];

        if ($action === 'approve') {
            $result = approveExpense($conn, $expense_id);
        } else if ($action === 'reject'){
            $result = rejectExpense($conn, $expense_id);
        } else {
            echo "Invalid Action";
            exit();
        }
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