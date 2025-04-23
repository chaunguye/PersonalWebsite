<?php
require_once '../config/connection.php';
require_once '../Model/CommunityModel.php';

class CommunityController {
    private $model;

    public function __construct($db) {
        $this->model = new CommunityModel($db);
    }

    public function displayFriend() {
        $userid = $_SESSION['userid'] ?? -1;
        if ($userid == -1){
            return;
        }

        $friend = $this->model->getFriend($userid);
        include '../View/CommunityView.php'; // Load the view with data
    }
    public function searchControl() {
        if(isset($_POST['input'])){
            $input = $_POST['input'];
            $result = $this->model->findUser($input);
            // if($result->num_rows >0){
            //     while ($row = $result->fetch_assoc()) {
            //         echo '<a href="index.php?webpage=user&userId=' . $row['id'] . '">' .$row['userName'] . '</a>';
            //     }
            // }
            // else{
            //     echo "<h4 class='notfound'>No result found</h4>";
            // }
            if (!empty($result)) {
                foreach ($result as $row) {
                    // echo '<a href="index.php?webpage=user&userId=' . $row['id'] . '">' . htmlspecialchars($row['userName']) . '</a>';
                echo"
                <a href='index.php?webpage=user&userId=" .$row['id'] ."' style='text-decoration: none;'>
                <div class='friendcard'>
                <img src=" .$row["img_path"] .">
                <div class='frienddetail'>
                    <p>" .$row["userName"] ."</p>
                    <p class='italic'>" .$row["firstName"] .' ' .$row["lastName"] ."</p>
                </div>
                </div>
                </a>";
                }
            } else {
                echo "<h4 class='notfound'>No result found</h4>";
            }
            
       }
    }
}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$comcon = new CommunityController($db);
$comcon->displayFriend();
$comcon->searchControl();
?>


