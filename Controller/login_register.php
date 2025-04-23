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
            $db->query("INSERT INTO user (firstName, lastName, dob, userName, password, sex, bio, img_path) VALUES('$fname', '$lname' , '$dob', '$username', '$password', '$sex', '$bio', '../Assests/user_img/default.jpg')");
            header("Location: ../Page/index.php?webpage=login");
            exit();
        }
        header("Location: ../Page/index.php?webpage=register");
        exit();
    }
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
                $_SESSION['img_path'] = $user['img_path'];
                if ($user['role'] === 'admin'){
                    $_SESSION['role'] = "admin";
                    header("Location: ../Page/index.php?webpage=adminhomepage");
                    exit();
                }
                else{
                    $_SESSION['role'] = "user";
                    header("Location: ../Page/index.php?webpage=homepage");
                    exit();
                }
                // header("Location: ../Page/index.php?webpage=homepage");
                // exit();
            }
        }
    
        // If login fails
        $_SESSION['login_error'] = "Incorrect Username or Password!";
        header("Location: ../Page/index.php?webpage=login");
        exit();
    }
    

?>