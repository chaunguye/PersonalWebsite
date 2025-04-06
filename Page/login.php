<?php
    session_start();
    $error = $_SESSION['login_error'] ?? '';
    $status = $_SESSION['status'] ?? 'Login failed';
    // session_unset();
    function showError($error){
        return !empty($error) ? "<p class='error_message'>$error</p>" : '';
    }
    function showStatus($status){
        return !empty($status) ? "<p class='error_message'>$status</p>" : '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../Assests/css/loginstyle.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container">
            <div><h1>Sign in</h1><div>
            <?= showError($error);   ?>
            <div>
                <form action="../Controller/login_register.php" method="POST" class="signinform">
                    <div><input type="text" name="username" placeholder="Please enter your username"> </div>
                    <div><input type="password" name="password" placeholder="Please enter your password"> </div>
                    <div><input class="signbut" type="submit" value="login" name="login"></div>
                </form>
                <p> Don't have an account? <a href="index.php?webpage=register">Register</a></p>
            </div>
    </div>
</body>
</html>