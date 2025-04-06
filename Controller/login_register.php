<?php
    session_start();
    require_once '../config/connection.php';
    $database = new Database();
    $db = $database->connect();

    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $dob = $_POST['dob'];
        $sex = $_POST['sex'];
        $bio = $_POST['bio'];

        $checkuser = $db->query("SELECT username FROM user WHERE username = '$username'");
        if ($checkuser->num_rows>0){
            $_SESSION['register_error'] = 'Username is already used!';
        }
        else{
            $db->query("INSERT INTO user (firstName, lastName, dob, userName, password, sex, bio) VALUES('$fname', '$lname' , '$dob', '$username', '$password', '$sex', '$bio')");
            header("Location: ../Page/index.php?webpage=login");
            exit();
        }
        header("Location: ../Page/index.php?webpage=register");
        exit();
    }
    // if(isset($_POST['login'])){
    //     $username = $_POST['username'];
    //     // $password = password_hash($_POST['password'], PASSWORD_DEFAULT) ;
    //     $password = $_POST['password'] ;
    //     // $checkuser = $db->query("SELECT * FROM user WHERE userName = '$username'");
    //     $stmt = $db->prepare("SELECT userName, password FROM user WHERE userName = ?");
    //     $stmt->bind_param("s", $username);
    //     $stmt->execute();
    //     $checkuser = $stmt->get_result();

    //     if ($checkuser->num_rows >0){
    //         $user = $checkuser->fetch_assoc();
    //         if(password_verify($password, $user['password'])){
    //             $_SESSION['status'] = "Login success!";
    //             $_SESSION['name'] = $username;
    //             header("Location: ../Page/homepage.php");
    //             exit();
    //         }
    //     }
    //     $_SESSION['login_error'] = "Incorrect Username or Password!";
    //     header("Location: ../Page/login.php");
    //     exit();
    // }
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        // Secure query using prepared statements
        $stmt = $db->prepare("SELECT * FROM user WHERE userName = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0){
            $user = $result->fetch_assoc();
    
            // Verify the hashed password
            if(password_verify($password, $user['password'])){
                $_SESSION['status'] = "Login success!";
                $_SESSION['name'] = $username;
                $_SESSION['userid'] = $user['id'];
                header("Location: ../Page/index.php?webpage=homepage");
                exit();
            }
            // $_SESSION['username'] = $username;
            // $_SESSION['password'] = $password;
            // $_SESSION['hash'] = $user['password'];
            // $_SESSION['verify'] = password_verify($password, $user['password']) ? "True" : "False";
        }
    
        // If login fails
        $_SESSION['login_error'] = "Incorrect Username or Password!";
        header("Location: ../Page/index.php?webpage=login");
        exit();
    }
    

?>