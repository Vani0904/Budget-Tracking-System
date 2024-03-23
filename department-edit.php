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
    <h1>Alter Department</h1>
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
        
        $dept = getByDeptId($conn, 'department', verifyID('department-id'));
        $paramResult = verifyID('department-id');
        if(!is_numeric($paramResult)){
            echo '<h5>'. $paramResult.'</h5>';
            return false;
        }
        
        
    ?>
        <label for = "department-id"><strong>Department ID</strong></label>
        <input type="text" id="department-id" name ="department-id"
        placeholder="Enter Department ID" value="<?= $dept['data']['department_id'] ; ?>" readonly>

        <label for ="dname"><Strong>Department name</strong></label>
        <input type="text" id="dname" name ="dname"
        placeholder="Enter Department Name" value="<?= $dept['data']['department_name'] ; ?>">

        <label for ="address-one"><strong>Address 1</strong></label>
        <input type="text" id="address-one" name ="address-one"
        placeholder="Enter Address">

        <label for = "address-two"><strong>Address 2</strong></label>
        <input type="password" id="address-two" name ="address-two"
        placeholder="Enter Address">

        <label for = "post-code"><strong>Post Code</strong></label>
        <input type="text" id="post-code" name ="post-code"
        placeholder="Enter post code">

        <label for = "department-budg"><strong>Department Budget</strong></label>
        <input type="text" id="department-budg" name ="department-budg"
        placeholder="Enter department budget" value="<?= $dept['data']['department_budget'] ; ?>">

        <label for = "department-exp"><strong>Department Expenses</strong></label>
        <input type="text" id="department-exp" name ="department-exp"
        placeholder="Enter department expenses" value="<?= $dept['data']['department_expenses'] ; ?>">

        <label for ="department-deadline"><strong>Department Deadline</strong></label>
        <input type="date" id="department-deadline" name ="department-deadline" value="<?= $dept['data']['department_deadline'] ; ?>">

        <input class="edit-button" name="updateDepartment" type="submit" value="Update">
    </form>
    <a href="admin-home.php" class="back-btn">Back</a>
<div>
</body>
</html>