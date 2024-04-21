<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Alter Account</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Department Deletion</h1>
</div>

<?php
    include("function.php");
    include("db_conn.php");
    
    $paraResult = verifyID('id');
    if(is_numeric($paraResult)){
        $deptId = validateInput($conn, $paraResult);

        $dept = getByDeptId($conn,'department', $deptId);
        if($dept['status'] == 200){
            $deptDelete = deleteDeptQuery('department', $deptId);
            if($deptDelete){
                header("location: admin-home.php?success=Department deleted successfully");
            }else {
                header("location: admin-home.php?error=Unknown error occurred");
            }
        }  else {
            header("location: admin-home.php?$dept[message]");
        }
    } else {
        header("location: admin-home.php?message=". urlencode($dept['message']));
    }

?>

<div>
</body>
</html>


