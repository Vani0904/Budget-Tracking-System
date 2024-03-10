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
                return 'No valid ID given';
            }
        }
        function getById($conn, $tableName, $userId) {
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
        function deleteQuery($tableName, $userId){
            global $conn;

            $table = validateInput($conn,$tableName);
            $userId = validateInput($conn,$userId);

            $query = "DELETE FROM $table WHERE employee_id='$userId' LIMIT 1";
            $result = mysqli_query($conn, $query);
            return $result;
        }
?>