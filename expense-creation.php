<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Expense Creation</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Expense Creation</h1>
</div>

<div class="sign-up-section">
    <form action="expense-check.php" name="expense-form" method="post">
    
    <h2 class="title">Create Expense</h2>   

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>
        <label for ="amount"><Strong>Amount</strong></label>
        <input type="text" id="amount" name ="amount"
        placeholder="Enter Amount">

        <label for ="comment"><strong>Comments (Optional)</strong></label>
        <input type="text" id="comment" name ="comment"
        placeholder="Enter Comment">

        <input type="hidden" name="department-id" value="<?php echo $departmentId; ?>">

        <input class="signup-button" name="createExpense" type="submit" value="Create">
    </form>
    <a href="expenses.php" class="back-btn">Back</a>
<div>
</body>
</html>