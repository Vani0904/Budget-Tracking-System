<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Targets</title>
</head>
<body class="homepage-background">
<div class="top-section">
    <h1>Targets</h1>
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
                            echo $userColumn['status'] == 1 ? '1': '0';
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
</body>
</html>
