<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Expense Update</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Alter Expense</h1>
</div>

<div class="sign-up-section">
    <form action="expense-check.php" name="expense-form" method="post">
    
    <h2 class="title">Edit Expense</h2>

    <?php if (isset($_GET['error'])) { ?>
        <p class ="error-field"><?php echo $_GET['error']; ?></p>
    <?php }?>

    <?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>

    <?php
        include("db_conn.php");
        include("function.php");
        
        $expense = getByExpId($conn, 'expenses', verifyID('id'));
        $paramResult = verifyID('id');
        if(!is_numeric($paramResult)){
            echo '<h5>'. $paramResult.'</h5>';
            return false;
        }
        
        
    ?>
          <label for = "expense-id"><strong>Expense ID</strong></label>
        <input type="text" id="expense-id" name ="expense-id"
        placeholder="Enter Expense ID" value="<?= $expense['data']['expenses_id'] ; ?>" readonly>

        <label for ="amount"><Strong>Amount</strong></label>
        <input type="text" id="amount" name ="amount"
        placeholder="Enter Amount" value="<?= $expense['data']['amount'] ; ?>">

        <label for ="comment"><strong>Comments (Optional)</strong></label>
        <input type="text" id="comment" name ="comment"
        placeholder="Enter Comment" value="<?= $expense['data']['comments'] ; ?>">

        <input type="hidden" name="department-id" value="<?php echo $departmentId; ?>">

        <input class="edit-button" name="updateExpense" type="submit" value="Update">
    </form>
    <a href="expenses.php" class="back-btn">Back</a>
<div>
</body>
</html>