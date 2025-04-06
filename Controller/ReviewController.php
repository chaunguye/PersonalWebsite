<!-- <?php
    session_start();
    // session_unset();
?> -->

<?php require_once '../config/connection.php';
require_once '../Model/ReviewModel.php'; ?>
<?php
class ReviewControl{
    private $model;

    public function __construct($model) {
        $this->model = new ReviewModel($model);
    }

    public function insertReview() {
        if($_SERVER['REQUEST_METHOD']==='POST'){
        $bookId = $_POST['book_id'];
        $userId = $_SESSION['userid'];
        $score = $_POST['score'];
        $text = $_POST['review_text'] ?? ''; 

        if ($score === '' || !is_numeric($score)) {
            echo "Score is required and must be a number!";
            exit();
        }
        $this->model->insertReview($bookId, $userId, $score, $text);
    }
    }
}

$database = new Database();
$db = $database->connect();
$reviewCon = new ReviewControl($db);
$reviewCon->insertReview();
?>


