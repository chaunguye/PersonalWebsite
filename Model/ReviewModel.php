
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
}


?>


