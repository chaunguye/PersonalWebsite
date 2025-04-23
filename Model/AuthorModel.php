<?php
class AuthorModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAuthor($authorid) {
        $query = "SELECT * FROM author WHERE id = ? LIMIT 5";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $authorid);  
        $stmt->execute();
        $result = $stmt->get_result();
        $author = $result->fetch_all(MYSQLI_ASSOC);

        $sql = "SELECT bookid FROM autho_rela WHERE authorid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $authorid); // Bind the authorid
        $stmt->execute();
        $author_book_result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        $bookids = array_column($author_book_result, 'bookid');
        // if (empty($bookids)) {
        //     return ['author' => $author, 'authorbook' => []];
        // }

        $sql = "SELECT book.*, category_rela.* FROM book
        LEFT JOIN category_rela ON book.id = category_rela.bookid
        WHERE id IN (" . implode(",", $bookids) . ")";
        $total_book = $this->conn->query($sql);
        $total_book_result = $total_book->fetch_all(MYSQLI_ASSOC);

        return ['author' => $author, 'authorbook' => $total_book_result];
    }
}
?>