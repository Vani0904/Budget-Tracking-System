<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['employee_id']) && isset($_SESSION['user_name'])) {
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
<table class="expenses-table">
                    <thead>
                        <tr>
                            <th>Expenses ID</th>
                            <th>Date Created</th>
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
                                        <td><?= $userColumn['date_created']; ?></td>
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