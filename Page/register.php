<?php
    session_start();
    $error = $_SESSION['register_error'] ?? '';
    // session_unset();
    function showError($error){
        return !empty($error) ? "<p class='error_message'>$error</p>" : '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../Assests/css/loginstyle.css">
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container">
            <div><h1>Register</h1><div>
            <?= showError($error);   ?>
            <div>
                <form action="../Controller/login_register.php" method="POST" class="signinform">
                    <!-- <div><input type="text" name="username" placeholder="Please enter your username" id="Username"> 
                    <label for="Username">Username</label></div>
        
                    <div><input type="password" name="password" placeholder="Please enter your password" id="Password"> <label for="Password">Password</label><br></div>
                    <div><input type="text" name="firstname" placeholder="Please enter your first name" id="First name"> <label for="First name">First name</label><br></div>
                    <div><input type="text" name="lastname" placeholder="Please enter your last name" id="Last Name"> <label for="Last Name">Last Name</label><br></div>
                    <div><input type="date" name="dob" placeholder="Please enter your date of birth" id="Date of Birth"> <label for="Date of Birth">Date of Birth</label><br></div>
                    <div><input type="text" name="sex" placeholder="Please enter your gender" id="Gender"> <label for="Gender">Gender</label><br></div>
                    <div><input type="text" name="bio" placeholder="Please enter your biology" id="Bio"><label for="Bio">Bio</label><br> </div>
                    <div><input type="submit" value="Sign up"></div> -->
                    <div>
    <label for="Username">Username</label>
    <input type="text" name="username" placeholder="Please enter your username" id="Username"> 
</div>

<div>
    <label for="Password">Password</label>
    <input type="password" name="password" placeholder="Please enter your password" id="Password">
</div>

<div>
    <label for="FirstName">First name</label>
    <input type="text" name="firstname" placeholder="Please enter your first name" id="FirstName"> 
</div>

<div>
    <label for="LastName">Last Name</label>
    <input type="text" name="lastname" placeholder="Please enter your last name" id="LastName">
</div>

<div>
    <label for="dob">Date of Birth</label>
    <input type="date" name="dob" id="dob">
</div>

<div>
    <label for="Gender">Gender</label>
    <input type="text" name="sex" placeholder="Please enter your gender" id="Gender">
</div>

<div>
    <label for="Bio">Bio</label>
    <input type="text" name="bio" placeholder="Please enter your bio" id="Bio">
</div>

<div >
    <input type="submit" name="register" value="Sign up" class="signbut">
</div>

                </form>
                <p> Already have an account? <a href="index.php?webpage=login">Log In</a></p>
            </div>
    </div>
</body>
</html>