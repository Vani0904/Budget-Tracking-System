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
    <h1>Department Creation</h1>
</div>

<div class="sign-up-section">
    <form action="signup-check.php" name="login-form" method="post">
    
    <h2 class="title">Create Account</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>
        <label for = "user-id"><strong>Staff ID</strong></label>
        <input type="text" id="user-id" name ="user-id"
        placeholder="Enter Staff ID">

        <label for ="fname"><Strong>First name</strong></label>
        <input type="text" id="fname" name ="fname"
        placeholder="Enter First Name">

        <label for ="lname"><strong>Last name</strong></label>
        <input type="text" id="lname" name ="lname"
        placeholder="Enter Last Name">

        <label for = "pword"><strong>Password</strong></label>
        <input type="password" id="pword" name ="passw"
        placeholder="Enter Password">

        <label for = "department"><strong>Department</strong>(Employee)</label>
        <input type="text" id="department" name ="department"
        placeholder="Enter Department">

        <label for ="role"><strong>Role</strong></label>
        <select id="role" name ="role">
            <option value="1">Employee</option>
            <option value="0">Admin</option>
        </select>

        <label><strong>Is Locked</strong></label>
        <input type="checkbox" name="is_locked" style="width:30px;height:30px"/>

        <input class="signup-button" name="createUser" type="submit" value="Register">
    </form>
    <a href="admin-home.php" class="back-btn">Back</a>
<div>
</body>
</html>