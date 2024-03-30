<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Department Creation</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Department Creation</h1>
</div>

<div class="sign-up-section">
    <form action="dept-check.php" name="department-form" method="post">
    
    <h2 class="title">Create Department</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>
    <label for = "department-id"><strong>Department ID</strong></label>
        <input type="text" id="department-id" name ="department-id"
        placeholder="Enter Department ID">

        <label for ="dname"><Strong>Department name</strong></label>
        <input type="text" id="dname" name ="dname"
        placeholder="Enter Department Name">

        <label for ="address-one"><strong>Address 1</strong></label>
        <input type="text" id="address-one" name ="address-one"
        placeholder="Enter Address">

        <label for = "address-two"><strong>Address 2</strong></label>
        <input type="text" id="address-two" name ="address-two"
        placeholder="Enter Address">

        <label for = "post-code"><strong>Post Code</strong></label>
        <input type="text" id="post-code" name ="post-code"
        placeholder="Enter post code">

        <label for = "department-budg"><strong>Department Budget</strong></label>
        <input type="text" id="department-budg" name ="department-budg"
        placeholder="Enter department budget">

        <label for ="department-deadline"><strong>Department Deadline</strong></label>
        <input type="date" id="department-deadline" name ="department-deadline">

        <input class="signup-button" name="createDept" type="submit" value="Create">
    </form>
    <a href="admin-home.php" class="back-btn">Back</a>
<div>
</body>
</html>