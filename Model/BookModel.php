<?php
class BookModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBooks($search = '', $order = 'none', $limit = 5, $offset = 0) {
        $query = "SELECT Book.*, category_rela.catename, CONCAT(author.firstName,' ', author.lastName) as authorName
                  FROM Book
                  LEFT JOIN category_rela ON Book.id = category_rela.bookid
                  LEFT JOIN autho_rela on Book.id = autho_rela.bookid
                  LEFT JOIN author on autho_rela.authorid = author.id";

        if ($search != '') {
            $query .= " WHERE bookName LIKE ?";
        }

        if ($order == 'asc') {
            $query .= " ORDER BY bookName ASC";
        } elseif ($order == 'desc') {
            $query .= " ORDER BY bookName DESC";
        }

        $query .= " LIMIT ? OFFSET ?";
        // $query .= " LIMIT $page_limit OFFSET $offset";
        $stmt = $this->conn->prepare($query);
        
        if ($search != '') {
            $search = "%$search%";
            $stmt->bind_param("sii", $search, $limit, $offset);
        } else {
            $stmt->bind_param("ii", $limit, $offset);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $books = $result->fetch_all(MYSQLI_ASSOC);
        $sql = "SELECT COUNT(*) AS total FROM Book";
        $total_book = $this->conn->query($sql);
        $total_book_count = $total_book->fetch_assoc()['total'];
        $total_page = ceil($total_book_count/$limit);
        return ['books' => $books, 'totalbook' => $total_page];
    }
    public function getBookById($id){
        $query = "SELECT Book.*, category_rela.catename, CONCAT(author.firstName,' ', author.lastName) as authorName, author.bio, author.nation
        FROM Book
        LEFT JOIN category_rela ON Book.id = category_rela.bookid
        LEFT JOIN autho_rela on Book.id = autho_rela.bookid
        LEFT JOIN author on autho_rela.authorid = author.id 
        WHERE Book.id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_assoc();
    return $books;
    }
}
?>