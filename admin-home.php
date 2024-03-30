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
    <title>Home</title>
</head>
<body class="homepage-background">
    <div class="top-section">
        <h1>Welcome, <?php echo $_SESSION['first_name']?></h1>
        <a href="logout.php">Logout</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="user-lists">
            <?php if (isset($_GET['success'])) { ?>
                <p class ="success-field"><?php echo $_GET['success']; ?></p>
            <?php }?>
                <h4>
                    User List
                    <div class="nav-btns">
                        <a href="account-creation.php" class="create-btn">Create User</a>
                        <a href="admin-expenses.php" class="create-btn">View Expenses</a>
                        <a href="department-creation.php" class="create-btn">Create Department</a>
                    </div>
                </h4>
            </div>
            <div class="section-body">
                <div class="tables">
                    <div class="user-table-section">
                        <table class="user-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT * FROM employee";
                                    $result = mysqli_query($conn, $query);

                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        while($userColumn = mysqli_fetch_assoc($result))
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $userColumn['employee_id']; ?></td>
                                                <td><?= $userColumn['first_name']; ?></td>
                                                <td><?= $userColumn['last_name']; ?></td>
                                                <td>
                                                <?php
                                                echo $userColumn['isEmployee'] == 1 ? 'Employee': 'Admin';
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    echo $userColumn['isLocked'] == 1 ? 'Locked': 'Active';
                                                ?>
                                                </td>
                                                <td>
                                                    <a href="account-edit.php?user-id=<?= $userColumn['employee_id']; ?>" class="btn-edit">Edit</a>
                                                    <a href="account-deletion.php?user-id=<?= $userColumn['employee_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6"> No Record Found</td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                        <div>
                            <table class="department-table">
                                <thead>
                                    <tr>
                                        <th>Department ID</th>
                                        <th>Department Name</th>
                                        <th>Department Budget</th>
                                        <th>Department Expenses</th>
                                        <th>Department Deadline</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM department";
                                        $result = mysqli_query($conn, $query);

                                        if(mysqli_num_rows($result) > 0)
                                        {
                                            while($department = mysqli_fetch_assoc($result))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $department['department_id']; ?></td>
                                                    <td><?= $department['department_name']; ?></td>
                                                    <td><?= $department['department_budget']; ?></td>
                                                    <td><?= $department['department_expenses']; ?></td>
                                                    <td><?= $department['department_deadline']; ?></td>
                                                    <td>
                                                        <a href="department-edit.php?id=<?= $department['department_id']; ?>" class="btn-edit">Edit</a>
                                                        <a href="department-deletion.php?id=<?= $department['department_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this department?')">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6"> No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
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