<?php
include ("db_conn.php");
session_start();
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
    <title>Home</title>
</head>
<body class="homepage-background">
<div class="top-section">
    <h1>Welcome, <?php echo $_SESSION['first_name']?></h1>
    <a href="logout.php">Logout</a>
</div>
<?php if (isset($_GET['success'])) { ?>
        <p class ="success-field"><?php echo $_GET['success']; ?></p>
    <?php }?>
<div class="pages-overview">
    <div class="wrapper">
        <div class ="circular-progress">
            <span class="progress-value">0%</span>
        </div>

    </div>
    <div class="expenses-button">
        <a href="expenses.php">
            <h4>Expenses Management</h4>    
        </a>
    </div>
    <div class="budget-display">
        <h4>Current Overrall Budget:</h4>
        <?= $departmentExpenses;   ?>/<?= $budget; ?>
    </div>
</div>
<div class="summary-row">
    <div class="expense-ovw-header">
        <h3>Expenses Overview<h3>
    </div>
<table class="expenses-table-sum">
        <thead>
            <tr>
                <th>Expenses ID</th>
                <th>Amount</th>
                <th>Comments</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM expenses";
                $result = mysqli_query($conn, $query);

                if(mysqli_num_rows($result) > 0)
                {
                    while($userColumn = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tr>
                            <td><?= $userColumn['expenses_id']; ?></td>
                            <td><?= $userColumn['amount']; ?></td>
                            <td><?= $userColumn['comments']; ?></td>
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
                        <td colspan="4"> No Record Found</td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
   <!-- <h3>Recent Activites<h3> -->
</div>
<script>
    let circularProgress = document.querySelector(".circular-progress"),
        progressValue = document.querySelector(".progress-value");

    let departmentId = <?php echo $departmentId; ?>,
    progressStartValue = 0,
        progressEndValue = 100,
        speed = 1000;

    function fetchDepartmentBudget() {
        fetch(`get-department-budget.php?department_id=${departmentId}`)
            .then(response => response.text())
            .then(data => {
                let budget = parseFloat(data);
                updateProgress(budget);
            })
            .catch(error => console.error('Error fetching department budget:', error));
    }
    function updateProgress(budget){
        fetch(`get-department-expenses.php?department_id=${departmentId}`)
            .then(response => response.text())
            .then(data => {
                let departmentExpenses = parseFloat(data);
                let progressPercentage = (departmentExpenses / budget) * 100;
                progressValue.textContent = `${Math.floor(progressPercentage)}%`;
                circularProgress.style.background = `conic-gradient(#114ccc ${progressPercentage}deg, #ededed 0deg)`
            })
            .catch(error => console.error('Error fetching department budget:', error));
        
    }
    let progress = setInterval(() => {
        fetchDepartmentBudget();
        if(progressStartValue == progressEndValue){
            clearInterval(progress);
        }
    }, speed);
</script>
</body>
</html>

<?php
}else {
    header("Location: index.php");
    exit();
}
?>