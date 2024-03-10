<?php  
    include "db_conn.php";


    $departmentId = mysqli_escape_string($conn, $_GET['department_id']);

    $sql = "SELECT department_budget FROM department WHERE department_id = $departmentId";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        echo $row['department_budget'];
    } else {
        echo "0";
    }

mysqli_close($conn);
?>