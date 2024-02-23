<?php
session_start();

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
    <h1>Welcome, <?php echo $_SESSION['first_name']?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
}else {
    header("Location: index.php");
    exit();
}
?>