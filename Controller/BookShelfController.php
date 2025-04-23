<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
?>
<?php
require_once '../config/connection.php';
require_once '../Model/BookShelfModel.php';

class BookShelfController {
    private $model;

    public function __construct($db) {
        $this->model = new BookShelfModel($db);
    }

    public function displayBookShelf() {
        $userid = $_SESSION['userid'] ?? -1;
        if ($userid == -1){
            return;
        }

        $bookshelf = $this->model->getShelf($userid);
        include '../View/BookShelfView.php'; // Load the view with data
    }
    public function displayMyBook() {
        $userid = $_SESSION['userid'] ?? -1;
        if ($userid == -1){
            echo "<h1 class='unlog-mybook''>Please <a href='../Page/login.php'>log in</a> to have your BookShelf!</h1?";
            // return;
        }

        $bookshelf = $this->model->getShelf($userid);
        include '../View/MyBookView.php'; // Load the view with data
    }
    public function addLaterReading($userid, $bookid) {
        $this->model->addLaterReading($userid, $bookid);
    }
    public function removeLaterReading($userid, $bookid) {
        $this->model->removeLaterReading($userid, $bookid);
    }
    public function addCurrentReading($userid, $bookid) {
        $this->model->addCurrentReading($userid, $bookid);
    }
    public function removeCurrentReading($userid, $bookid) {
        $this->model->removeCurrentReading($userid, $bookid);
    }
    public function addDoneReading($userid, $bookid) {
        $this->model->addDoneReading($userid, $bookid);
    }
    public function removeDoneReading($userid, $bookid) {
        $this->model->removeDoneReading($userid, $bookid);
    }
}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$shelfCon = new BookShelfController($db);
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // if (isset($_SESSION['userid']))
    // {
    //     // echo"hello";
    //     $userid = $_SESSION['userid'];
    //     $bookid = $_POST['wanttoread'];
    //     // echo $userid;
    //     // echo $bookid;
    //     $shelfCon->addLaterReading($userid, $bookid);
    // }
    if (isset($_POST['inshelf']) && isset($_POST['book_id'])){
        if (isset($_SESSION['userid']))
        {
            $userid = $_SESSION['userid'];
            $bookid = $_POST['book_id'];
            if ($_POST['inshelf'] === "true"){
                $shelfCon->addLaterReading($userid, $bookid);
            }
            else{
                $shelfCon->removeLaterReading($userid, $bookid);
            }
        }
    }
    elseif (isset($_POST['delete'])){
        $bookid = $_POST['bookId'];
        $userid = $_SESSION['userid'];
        $status = $_POST['delete'];
        if ($status === "later"){
            $shelfCon->removeLaterReading($userid, $bookid);
        }
        elseif ($status === "current"){
            $shelfCon->removeCurrentReading($userid, $bookid);
        }
        else{
            $shelfCon->removeDoneReading($userid, $bookid);
        }
        header("Location: ../Page/index.php?webpage=mybook");

    }
    elseif (isset($_POST['newStatus'])){
        $bookid = $_POST['bookId'];
        $userid = $_SESSION['userid'];
        $status = $_POST['newStatus'];
        if ($status === "current"){
            $shelfCon->removeLaterReading($userid, $bookid);
            $shelfCon->addCurrentReading($userid, $bookid);
        }
        else{
            $shelfCon->removeCurrentReading($userid, $bookid);
            $shelfCon->addDoneReading($userid, $bookid);
        }
        header("Location: ../Page/index.php?webpage=mybook");
    }

}
else{
    if (isset($_GET['webpage'])){
    if ($_GET['webpage'] == 'homepage'){
        $shelfCon->displayBookShelf();
    }
    else{
        $shelfCon->displayMyBook();
    }
}
else{
$shelfCon->displayBookShelf();
}
}

?>