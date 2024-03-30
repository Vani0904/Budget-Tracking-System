<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Delete Account</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Account Deletion</h1>
</div>

<?php
    include("function.php");
    include("db_conn.php");
    
    $paraResult = verifyID('user-id');
    if(is_numeric($paraResult)){
        $userId = validateInput($conn, $paraResult);

        $user = getByUsrId($conn,'employee', $userId);
        if($user['status'] == 200){
            $userDelete = deleteUsrQuery('employee', $userId);
            if($userDelete){
                header("location: admin-home.php?success=User deleted successfully");
            }else {
                header("location: admin-home.php?error=Unknown error occurred");
            }
        }  else {
            header("location: admin-home.php?$user[message]");
        }
    } else {
        header("location: admin-home.php?message=". urlencode($user['message']));
    }

?>

<div>
</body>
</html>


