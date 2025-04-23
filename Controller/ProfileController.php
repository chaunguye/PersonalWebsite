<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php
require_once '../config/connection.php';
require_once '../Model/UserModel.php';

class ProfileController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }


    public function displayUserProfile() {
        $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;
        $userResult = $this->model->getUser($userid);
        $user = $userResult['user'];
        include '../View/ProfileView.php'; // Load the view with data
    }
    public function updateUserProfile($userid, $firstName, $lastName, $dob, $sex, $bio, $img_path) {
        $this->model->updateUserProfile($userid, $firstName, $lastName, $dob, $sex, $bio, $img_path);
        header("Location: ../Page/index.php?webpage=userprofile");
    }

    

}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$proController = new ProfileController($db);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userid = $_SESSION['userid'];
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $sex = $_POST['sex'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $img_path = null;

    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        $targetDir = "../Assests/user_img/";
        // if (!file_exists($targetDir)) {
        //     mkdir($targetDir, 0777, true); 
        // }
    
        $fileName = basename($_FILES["img"]["name"]);
        $targetFile = $targetDir . time() . "_" . $fileName;
    
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            $img_path = $targetFile;
        }
    }
    $proController->updateUserProfile($userid, $firstName, $lastName, $dob, $sex, $bio, $img_path);
}
else{
   $proController->displayUserProfile(); 
}


?>