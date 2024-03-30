<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Delete Expense</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Expense Deletion</h1>
</div>

<?php
    include("function.php");
    include("db_conn.php");
    
    $paraResult = verifyID('id');
    if(is_numeric($paraResult)){
        $expenseId = validateInput($conn, $paraResult);

        $expense = getByExpId($conn,'expenses', $expenseId);
        if($expense['status'] == 200){
            $expenseDelete = deleteExpQuery('expenses', $expenseId);
            if($expenseDelete){
                $resetQuery = "ALTER TABLE expenses AUTO_INCREMENT = 1";
                mysqli_query($conn, $resetQuery);
                header("location: expenses.php?success=Expense deleted successfully");
            }else {
                header("location: expenses.php?error=Unknown error occurred");
            }
        }  else {
            header("location: expenses.php?$expense[message]");
        }
    } else {
        header("location: expenses.php?message=". urlencode($expense['message']));
    }

?>

<div>
</body>
</html>


