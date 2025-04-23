<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $error = $_SESSION['login_error'] ?? '';
    $status = $_SESSION['status'] ?? 'Login failed';
    unset($_SESSION['login_error']);
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
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/loginstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container zen-kaku">
        <p id="lets" class="zen-kaku">LET'S SIGN IN</p>
        <h1 class="zen-kaku">Login to your account</h1>

        <form action="../Controller/login_register.php" method="POST" class="signinform zen-kaku">
            <?= showError($error);  ?>

            <label for="username" class="required"><b>Username</b></label>
            <input name ="username" type="text" placeholder="Enter Username" required>

            <label for="password" class="required"><b>Password</b></label>
                <input name ="password" type="password" placeholder="Enter Password" required>

            <button type="submit" class="submit loginbut" name="login">CONTINUE</button>
        </form>
        <hr>
        <p class="register-direct zen-kaku"> Don't have an account? <a href="index.php?webpage=register">Register</a></p>
    </div>
</body>
    <footer>
        <p>&copy; 2025 My Website. All Rights Reserved.</p>
    </footer>
</html>