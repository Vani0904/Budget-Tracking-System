<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="style.css"/>
    <title>Budget Tracker System</title>
</head>
<body class="login-background">
    <h1>Budget Tracker</h1>
    <div class="login-section">
        <h2 class="title">Sign in to start your session</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class ="error-field"><?php echo $_GET['error']; ?></p>
        <?php }?>
        <form action="login.php" name="login-form" method="post">
            <label for ="uname">Username</label>
            <input type="text" id="uname" name ="uname"
            placeholder="Enter Username">

            <label for = "pword">Password</label>
            <input type="password" id="pword" name ="pword"
            placeholder="Enter Password">
            <input class="login-button" type="submit" value="Sign in">
        </form>
    </div>
</body>
</html>