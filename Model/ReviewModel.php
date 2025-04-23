
<?php
class ReviewModel{
    private $db;

    public function __construct($model) {
        $this->db = $model;
    }

    public function insertReview($bookId, $userId, $score, $text) {
        $query = "INSERT INTO review (bookid, userid, score, review) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("iids", $bookId, $userId, $score, $text);

    if ($stmt->execute()) {
        header("Location: ../Page/index.php?webpage=singlebook&bookId=$bookId");
        exit();
    } else {
        echo "Failed to submit review.";
    }
    }

    public function updateReview($bookId, $userId, $score, $text) {
        echo $bookId;
        echo $userId;
        echo $score;
        echo $text;
        $query = "UPDATE review 
        SET score = ?, review =?
        WHERE bookid = ? AND userid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("dsii", $score, $text, $bookId, $userId);

    if ($stmt->execute()) {
        header("Location: ../Page/index.php?webpage=singlebook&bookId=$bookId");
        exit();
    } else {
        echo "Failed to modify review.";
    }
    }
}


?>


