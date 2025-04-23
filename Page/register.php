<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
    $error = $_SESSION['register_error'] ?? '';
    unset($_SESSION['register_error']);
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
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/loginstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
    
</head>
<body>
    <?php include 'navbar.php';?>
    <div class="container zen-kaku">
        <p id="lets" class="zen-kaku">LET'S GET STARTED</p>
        <h1 class="zen-kaku">Register for your account</h1>
        <?= showError($error);   ?>
            <form action="../Controller/login_register.php" method="POST" class="signinform zen-kaku">

                <label for="FirstName" class="required">First name</label>
                <input type="text" name="firstname" placeholder="Please enter your first name" id="FirstName"> 

                <label for="LastName" class="required">Last Name</label>
                <input type="text" name="lastname" placeholder="Please enter your last name" id="LastName">

                <label for="dob" class="required">Date of Birth</label>
                <input type="date" name="dob" id="dob">

                <label for="email" class="required">Email</label>
                <input type="text" name="email" id="email" placeholder="Please enter your email">
                <ul id="emailRules">
                    <li id="emailrule" class="invalid">Email is not valid</li>
                </ul>

                <label for="Gender" class="required zen-kaku">Gender</label>
                <!-- <input type="text" name="sex" placeholder="Please enter your gender" id="Gender"> -->
                <select name="sex" id="Gender" required>
                  <option value="" disabled selected>Select your gender</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>

                <label for="Bio">Bio</label>
                <!-- <input type="text" name="bio" placeholder="Please enter your biography" id="Bio"> -->
                <textarea name="bio" rows="4" placeholder="Write your biography..." class="zen-kaku"></textarea>

                <label for="Username" class="required">Username</label>
                <input type="text" name="username" placeholder="Please enter your username" id="Username"> 

                <label for="Password" class="required">Password</label>
                <input type="password" name="password" placeholder="Please enter your password" id="Password">
                <ul id="passwordRules">
                    <li id="ruleLength" class="invalid">At least 8 characters</li>
                    <li id="ruleNumber" class="invalid">At least one number</li>
                    <li id="ruleSpecial" class="invalid">At least one special character</li>
                </ul>

                <label for="ConPassword" class="required">Confirm Password</label>
                <input type="password" name="conpassword" placeholder="Please confirm your password" id="ConPassword">

                <button type="submit" class="submit loginbut" name="register">CONTINUE</button>
            </form>
            <hr>
            <p class="register-direct "> Already have an account? <a href="index.php?webpage=login">Log In</a></p>
    </div>
</body>
<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $(document).ready(function () {
      $("#Password").on("keyup", function () {
        let password = $(this).val();
        if (password === ""){
            $("#passwordRules").hide()
        }
        else{
            $("#passwordRules").show()
        }

        // Length check
        if (password.length >= 8) {
          $("#ruleLength").removeClass("invalid").addClass("valid");
        } else {
          $("#ruleLength").removeClass("valid").addClass("invalid");
        }

        // Number check
        if (/\d/.test(password)) {
          $("#ruleNumber").removeClass("invalid").addClass("valid");
        } else {
          $("#ruleNumber").removeClass("valid").addClass("invalid");
        }

        // Special character check
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
          $("#ruleSpecial").removeClass("invalid").addClass("valid");
        } else {
          $("#ruleSpecial").removeClass("valid").addClass("invalid");
        }
      });

      $("#email").on("keyup", function () {
        let email = $(this).val();
        if (email === ""){
            $("#emailRules").hide()
        }
        else{
            $("#emailRules").show()
        }
        //@check
        if (/[@]/.test(email)) {
          $("#emailrule").removeClass("invalid").addClass("valid");
        } else {
          $("#emailrule").removeClass("valid").addClass("invalid");
        }

        if (/[.]/.test(email)) {
          $("#emailrule").removeClass("invalid").addClass("valid");
        } else {
          $("#emailrule").removeClass("valid").addClass("invalid");
        }
      });

      

      $("form").on("submit", function (e) {
        let password = $("#Password").val();
        let confirm = $("#ConPassword").val();
        let email = $("#email").val();
        let user = $("#username").val();

        if (password === "" || confirm === "" || email === "" || user === ""){
            alert("Please fill in all the blanks.");
            e.preventDefault();
            return;
        }

        // Password rules check
        let isValidPassword =
        password.length >= 8 &&
    /\d/.test(password) &&
    /[!@#$%^&*(),.?":{}|<>]/.test(password);

  if (!isValidPassword) {
    alert("Password does not meet all requirements.");
    e.preventDefault();
    return;
  }

  let isValidEmail =
    /[@]/.test(email) &&
   /[.]/.test(email);

  if (!isValidEmail) {
    alert("Email is not valid.");
    e.preventDefault();
    return;
  }


  // Confirm password check
  if (password !== confirm) {
    // $("#confirmMsg").show().text("Passwords do not match.");
    alert("Passwords do not match.");
    e.preventDefault();
    return;
  }

});


    });
  </script>