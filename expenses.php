<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['employee_id']) && isset($_SESSION['user_name'])) {
    $departmentId = isset($_SESSION['department_id']) ? $_SESSION['department_id'] : 0;

    $sql = "SELECT department_expenses, department_budget FROM department WHERE department_id = $departmentId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $departmentExpenses = $row['department_expenses'];
        $budget = $row['department_budget'];
    } else {
        $departmentExpenses = 0;
        $budget = 0;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Expenses Management</title>
</head>
<body class="subpage-background">
<div class="top-section">
    <h1>Expenses Management</h1>
    
</div>
<div>
    <a href="expense-creation.php" class="create-btn">Create Expense</a> 
</div>
<?php if (isset($_GET['success'])) { ?>
    <p class ="success-field"><?php echo $_GET['success']; ?></p>
<?php }?>
<table class="expenses-table">
                    <thead>
                        <tr>
                            <th>Expenses ID</th>
                            <th>Date Created</th>
                            <th>Amount</th>
                            <th>Comments</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT expenses.* FROM expenses INNER JOIN department_expenses
                            department_expenses ON expenses.expenses_id = department_expenses.expenses_id WHERE department_expenses.department_id = $departmentId";
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0)
                            {
                                while($userColumn = mysqli_fetch_assoc($result))
                                {
                                    ?>
                                    <tr>
                                        <td><?= $userColumn['expenses_id']; ?></td>
                                        <td><?= $userColumn['date_created']; ?></td>
                                        <td><?= $userColumn['amount']; ?></td>
                                        <td><?= $userColumn['comments']; ?></td>
                                        <td>
                                            <a href="expense-edit.php?id=<?= $userColumn['expenses_id']; ?>" class="btn-edit">Edit</a>
                                            <a href="expense-deletion.php?id=<?= $userColumn['expenses_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this Expense?')">Delete</a>
                                        </td>
                                        <td>
                                        <?php
                                           echo $userColumn['status'] == 1 ? 'Approved': '-';
                                        ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5"> No Record Found</td>
                                </tr>
                                <?php
                            }
                        ?>
                        
                    </tbody>
                </table>
                <a href="home.php" class="back-btn">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
}else {
    header("Location: index.php");
    exit();
}
?>