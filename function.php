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
            $userId = validateInput($conn,$deptId);

            $query = "DELETE FROM $table WHERE department_id='$deptId' LIMIT 1";
            $result = mysqli_query($conn, $query);
            return $result;
        }
        function deleteExpQuery($tableName, $expId){
            global $conn;

            $table = validateInput($conn,$tableName);
            $userId = validateInput($conn,$expId);

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
?>