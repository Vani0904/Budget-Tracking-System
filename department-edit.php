<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Department Update</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Alter Department</h1>
</div>
<div class="sign-up-section">
    <form action="dept-check.php" name="department-form" method="post">
    
    <h2 class="title">Edit Department</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>

    <?php
        include("db_conn.php");
        include("function.php");
        
        $dept = getByDeptId($conn, 'department', verifyID('id'));
        $paramResult = verifyID('id');
        if(!is_numeric($paramResult)){
            echo '<h5>'. $paramResult.'</h5>';
            return false;
        }
    ?>
    <form action="dept-check.php" name="department-form" method="post">
        <label for = "department-id"><strong>Department ID</strong></label>
        <input type="text" id="department-id" name ="department-id"
        placeholder="Enter Department ID" value="<?= $dept['data']['department_id'] ; ?>" readonly>

        <label for ="dname"><Strong>Department name</strong></label>
        <input type="text" id="dname" name ="dname"
        placeholder="Enter Department Name" value="<?= $dept['data']['department_name'] ; ?>">

        <label for ="address-one"><strong>Address 1</strong></label>
        <input type="text" id="address-one" name ="address-one"
        placeholder="Enter Address"  value="<?= $dept['data']['address_1'] ; ?>">

        <label for = "address-two"><strong>Address 2</strong></label>
        <input type="text" id="address-two" name ="address-two"
        placeholder="Enter Address"  value="<?= $dept['data']['address_2'] ; ?>">

        <label for = "post-code"><strong>Post Code</strong></label>
        <input type="text" id="post-code" name ="post-code"
        placeholder="Enter post code"  value="<?= $dept['data']['post_code'] ; ?>">

        <label for = "department-budg"><strong>Department Budget</strong></label>
        <input type="text" id="department-budg" name ="department-budg"
        placeholder="Enter department budget" value="<?= $dept['data']['department_budget'] ; ?>">

        <label for ="department-deadline"><strong>Department Deadline</strong></label>
        <input type="date" id="department-deadline" name ="department-deadline" value="<?= $dept['data']['department_deadline'] ; ?>">

        <input class="edit-button" name="updateDept" type="submit" value="Update">
    </form>
    <a href="admin-home.php" class="back-btn">Back</a>
<div>
</body>
</html>