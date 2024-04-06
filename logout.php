<?php 
    session_start();
    include "db_conn.php";

    if (isset($_SESSION['department_id'])) {
        // Get the department ID
        $department_id = $_SESSION['department_id'];

        // Delete recent activities associated with the current session or timestamp
        $delete_query = "DELETE FROM recentactivities WHERE department_id = ?";
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, "i", $department_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    session_unset();
    session_destroy();

    header("Location: index.php");
?>