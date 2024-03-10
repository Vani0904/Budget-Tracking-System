<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Account Creation</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Alter Account</h1>
</div>

<div class="sign-up-section">
    <form action="signup-check.php" name="login-form" method="post">
    
    <h2 class="title">Edit Account</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>

    <?php
        include("db_conn.php");
        include("function.php");
        
        $user = getById($conn, 'department', verifyID('user-id'));
        $paramResult = verifyID('user-id');
        if(!is_numeric($paramResult)){
            echo '<h5>'. $paramResult.'</h5>';
            return false;
        }
        
        
    ?>
        <label for = "user-id"><strong>Staff ID</strong></label>
        <input type="text" id="user-id" name ="user-id"
        placeholder="Enter Staff ID" value="<?= $user['data']['employee_id'] ; ?>" readonly>

        <label for ="fname"><Strong>First name</strong></label>
        <input type="text" id="fname" name ="fname"
        placeholder="Enter First Name" value="<?= $user['data']['first_name'] ; ?>">

        <label for ="lname"><strong>Last name</strong></label>
        <input type="text" id="lname" name ="lname"
        placeholder="Enter Last Name" value="<?= $user['data']['last_name'] ; ?>">

        <label for = "pword"><strong>Password</strong></label>
        <input type="password" id="pword" name ="passw"
        placeholder="Enter Password">

        <label for = "department"><strong>Department</strong>(Employee)</label>
        <input type="text" id="department" name ="department"
        placeholder="Enter Department" value="<?= $user['data']['department_id'] ; ?>">

        <label for ="role"><strong>Role</strong></label>
        <select id="role" name ="role">
            <option value="1" <?= ($user['data']['isEmployee'] == 1) ? 'selected': ''; ?>>Employee</option>
            <option value="0" <?= ($user['data']['isEmployee'] == 0) ? 'selected': '';  ?>>Admin</option>
        </select>

        <label><strong>Is Locked</strong></label>
        <input type="checkbox" name="is_locked" <?= ($user['data']['isLocked'] == 0) ? '': 'checked'; ?>  style="width:30px;height:30px"/>

        <input class="edit-button" name="updateUser" type="submit" value="Update">
    </form>
    <a href="admin-home.php" class="back-btn">Back</a>
<div>
</body>
</html>