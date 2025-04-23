<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<?php
require_once '../config/connection.php';
require_once '../Model/UserModel.php';

class UserController {
    private $model;

    public function __construct($db) {
        $this->model = new UserModel($db);
    }

    public function displayUser() {
        $userid = isset($_GET['userId']) ? (int)$_GET['userId'] : -1;

        $userResult = $this->model->getUser($userid);
        include '../View/UserView.php'; // Load the view with data
    }

    // public function displayUserProfile() {
    //     $userid = isset($_GET['userId']) ? (int)$_GET['userId'] : -1;
    //     $userResult = $this->model->getUser($userid);
    //     include '../View/ProfileView.php'; // Load the view with data
    // }

    public function followUser($friendid) {
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            $userResult = $this->model->followUser($userid, $friendid);
        }
    }

    public function unfollowUser($friendid) {
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            $userResult = $this->model->unfollowUser($userid, $friendid);
        }
    }

    public function getFriend($userid) {
        return $this->model->getFriend($userid);
    }

}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$userController = new UserController($db);
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['follow']) && isset($_POST['followed_user_id'])) {
        $currentUserId = $_SESSION['userid'] ?? null;
        if (!$currentUserId) {
            http_response_code(401);
            echo "User not logged in.";
            exit;
        }
        $friendid = $_POST['followed_user_id'];
        if ($_POST['follow'] === "true"){
            $userController->followUser($friendid);
        }
        else {
            $userController->unfollowUser($friendid);
        }
        
}
}

else{
    $userController->displayUser();
}

?>