<?php
        function validateInput($conn, $inputData){
            return mysqli_real_escape_string($conn,$inputData);
        }

        function verifyID($paramType) {
            if (isset($_GET[$paramType])) {
                if($_GET[$paramType] != null){
                    return $_GET[$paramType];
                } else{
                    return 'No valid ID found';
                }
            } else {
                return "No valid ID given";
            }
        }
        function getByUsrId($conn, $tableName, $userId) {
            $table = validateInput($conn, $tableName);
            $userId = validateInput($conn, $userId);
        
            $query = "SELECT * FROM $table WHERE employee_id='$userId' LIMIT 1";
            $result = mysqli_query($conn, $query);
        
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $response = [
                        'status' => 200,
                        'message' => 'Fetched data',
                        'data' => $row
                    ];
                    return $response;
                } else {
                    $response = [
                        'status' => 404,
                        'message' => 'No Data Record'
                    ];
                    return $response;
                }
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Something Went Wrong'
                ];
                return $response;
            }
        }
        function getByDeptId($conn, $tableName, $deptId) {
            $table = validateInput($conn, $tableName);
            $deptId = validateInput($conn, $deptId);
        
            $query = "SELECT * FROM $table WHERE department_id='$deptId' LIMIT 1";
            $result = mysqli_query($conn, $query);
        
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $response = [
                        'status' => 200,
                        'message' => 'Fetched data',
                        'data' => $row
                    ];
                    return $response;
                } else {
                    $response = [
                        'status' => 404,
                        'message' => 'No Data Record'
                    ];
                    return $response;
                }
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Something Went Wrong'
                ];
                return $response;
            }
        }
        function getByExpId($conn, $tableName, $expId) {
            $table = validateInput($conn, $tableName);
            $expId = validateInput($conn, $expId);
        
            $query = "SELECT * FROM $table WHERE expenses_id='$expId' LIMIT 1";
            $result = mysqli_query($conn, $query);
        
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $response = [
                        'status' => 200,
                        'message' => 'Fetched data',
                        'data' => $row
                    ];
                    return $response;
                } else {
                    $response = [
                        'status' => 404,
                        'message' => 'No Data Record'
                    ];
                    return $response;
                }
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Something Went Wrong'
                ];
                return $response;
            }
        }
        function deleteUsrQuery($tableName, $userId){
            global $conn;

            $table = validateInput($conn,$tableName);
            $userId = validateInput($conn,$userId);

            $query = "DELETE FROM $table WHERE employee_id='$userId' LIMIT 1";
            $result = mysqli_query($conn, $query);
            return $result;
        }
        function deleteDeptQuery($tableName, $deptId){
            global $conn;

            $table = validateInput($conn,$tableName);
            $deptId = validateInput($conn,$deptId);

            $query = "DELETE FROM $table WHERE department_id='$deptId' LIMIT 1";
            $result = mysqli_query($conn, $query);
            return $result;
        }
        function deleteExpQuery($tableName, $expId){
            global $conn;

            $table = validateInput($conn,$tableName);
            $expId = validateInput($conn,$expId);

            $query = "DELETE FROM $table WHERE expenses_id='$expId' LIMIT 1";
            $result = mysqli_query($conn, $query);
            return $result;
        }
        function addActivity ($conn, $employee_id, $activity_type, $activity_description){
            $employee_id = mysqli_real_escape_string($conn, $employee_id);
            $activity_type = mysqli_real_escape_string($conn, $activity_type);
            $activity_description = mysqli_real_escape_string($conn, $activity_description);

            $query = "INSERT INTO recentActivities (employee_id, activity_type, activity_description) 
            VALUES ('$employee_id', '$activity_type', '$activity_description')";
            $result = mysqli_query($conn, $query);

            if ($result){
                return true;
            } else {
                return false;
            }
        }
        function getActivities($conn) {
            $query = "SELECT * FROM recentActivites ORDER BY timestamp DESC";
            $result = mysqli_query($conn, $query);

            $activities = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $activities[] = $row;
            }

            return $activities;
        }
        function approveExpense($conn, $expense_id) {
            $query = "UPDATE expenses SET status = 1 WHERE expenses_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $expense_id);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        
            if ($result) {
                $department_id = getDepartmentId($conn, $expense_id);
                if ($department_id !== null) {
                    $update_query = "UPDATE department SET department_expenses = department_expenses + (SELECT amount FROM expenses WHERE expenses_id = ?) WHERE department_id = ?";
                    $stmt = mysqli_prepare($conn, $update_query);
                    mysqli_stmt_bind_param($stmt, "ii", $expense_id, $department_id);
                    $update_result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    if ($update_result){
                        $insert_query = "INSERT INTO recentactivities (department_id, activity_type, activity_description) VALUES (?,?,?)";
                        $stmt = mysqli_prepare($conn, $insert_query);
                        $type = "Expense Approved";
                        $description = "Expense ID $expense_id was approved";
                        mysqli_stmt_bind_param($stmt, "iss", $department_id, $type, $description);
                        $insert_result = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        if ($insert_result){
                            return true;
                        } else {
                            echo "Error inserting recent activity: ". mysqli_error($conn);
                            return false;
                        }
                    } else {
                       echo "Error updating department expenses: ". mysqli_error($conn);
                       return false;
                    }
                } else {
                    echo "Department ID not found for the approved expense";
                    return false;
                }
            } else {
                echo "Error approving expense: " . mysqli_error($conn);
                return false;
            }
        }
        
        function rejectExpense($conn, $expense_id) {
            $query = "UPDATE expenses SET status = 0 WHERE expenses_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $expense_id);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        
            if ($result) {
                $department_id = getDepartmentId($conn, $expense_id);
                if ($department_id !== null) {
                    $update_query = "UPDATE department SET department_expenses = department_expenses - (SELECT amount FROM expenses WHERE expenses_id = ?) WHERE department_id = ?";
                    $stmt = mysqli_prepare($conn, $update_query);
                    mysqli_stmt_bind_param($stmt, "ii", $expense_id, $department_id);
                    $update_result = mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    if ($update_result){
                        $insert_query = "INSERT INTO recentactivities (department_id, activity_type, activity_description) VALUES (?,?,?)";
                        $stmt = mysqli_prepare($conn, $insert_query);
                        $type = "Expense Rejected";
                        $description = "Expense ID $expense_id was rejected";
                        mysqli_stmt_bind_param($stmt, "iss", $department_id, $type, $description);
                        $insert_result = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        if ($insert_result){
                            return true;
                        } else {
                            echo "Error inserting recent activity: ". mysqli_error($conn);
                            return false;
                        }
                    } else {
                       echo "Error updating department expenses: ". mysqli_error($conn);
                       return false;
                    }
                } else {
                    echo "Department ID not found for the rejected expense";
                    return false;
                }
            } else {
                echo "Error rejecting expense: " . mysqli_error($conn);
                return false;
            }
        }
        
        function getDepartmentId($conn, $expense_id) {
            $query = "SELECT department_id FROM department_expenses WHERE expenses_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $expense_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $department_id);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            return $department_id;
        }
?>