<?php
class BookModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBooks($search = '', $order = 'none', $limit = 5, $offset = 0, $category = '') {
        $query = "SELECT Book.*, category_rela.catename, author.id as authorid, CONCAT(author.firstName,' ', author.lastName) as authorName
                  FROM Book
                  LEFT JOIN category_rela ON Book.id = category_rela.bookid
                  LEFT JOIN autho_rela on Book.id = autho_rela.bookid
                  LEFT JOIN author on autho_rela.authorid = author.id";

        // if ($search != '') {
        //     $query .= " WHERE bookName LIKE ?";
        // }

        // if ($order == 'asc') {
        //     $query .= " ORDER BY bookName ASC";
        // } elseif ($order == 'desc') {
        //     $query .= " ORDER BY bookName DESC";
        // }

        // $query .= " LIMIT ? OFFSET ?";
        // // $query .= " LIMIT $page_limit OFFSET $offset";
        // $stmt = $this->conn->prepare($query);
        
        // if ($search != '') {
        //     $search = "%$search%";
        //     $stmt->bind_param("sii", $search, $limit, $offset);
        // } else {
        //     $stmt->bind_param("ii", $limit, $offset);
        // }

        $where = [];
        $params = [];
        $types = "";

        // Handle search filter
        if ($search !== '') {
            $where[] = "bookName LIKE ?";
            $params[] = "%$search%";
            $types .= "s";
        }

        // Handle category filter
        if ($category !== '') {
            $where[] = "category_rela.catename = ?";
            $params[] = $category;
            $types .= "s";
        }

        // Append WHERE clause if any filters are set
        if (!empty($where)) {
            $query .= " WHERE " . implode(" AND ", $where);
        }

        // Handle sorting
        if ($order == 'asc') {
            $query .= " ORDER BY bookName ASC";
        } elseif ($order == 'desc') {
            $query .= " ORDER BY bookName DESC";
        }
        $countParams = $params;
        $countTypes = $types;

        $query .= " LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";

        // Prepare and bind
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $books = $result->fetch_all(MYSQLI_ASSOC);
        
        // $stmt->execute();
        // $result = $stmt->get_result();
        // $books = $result->fetch_all(MYSQLI_ASSOC);
        // $sql = "SELECT COUNT(*) AS total FROM Book";
        // $total_book = $this->conn->query($sql);
        // $total_book_count = $total_book->fetch_assoc()['total'];

        $countQuery = "SELECT COUNT(*) as total FROM Book
        LEFT JOIN category_rela ON Book.id = category_rela.bookid
        LEFT JOIN autho_rela ON Book.id = autho_rela.bookid
        LEFT JOIN author ON autho_rela.authorid = author.id";

        if (!empty($where)) {
        $countQuery .= " WHERE " . implode(" AND ", $where);
        }

        $countStmt = $this->conn->prepare($countQuery);
        // $countStmt->bind_param($countTypes, ...$countParams);
        if (!empty($countTypes)) {
            $countStmt->bind_param($countTypes, ...$countParams);
        }
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $total_book_count = $countResult->fetch_assoc()['total'];

        $total_page = ceil($total_book_count/$limit);
        return ['books' => $books, 'totalbook' => $total_page];
    }
    public function getBookById($id){
        $query = "SELECT Book.*, category_rela.catename, author.id as authorid, CONCAT(author.firstName,' ', author.lastName) as authorName, author.bio, author.nation
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

    $query = "SELECT AVG(score) as avgsco FROM review WHERE bookid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $avescore = $result->fetch_assoc();

    $query = "SELECT COUNT(*) as numreview FROM review WHERE bookid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $numreview = $result->fetch_assoc();

    $query = "SELECT review.*, user.*
    FROM review LEFT JOIN user ON review.userid = user.id
    WHERE bookid = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $review = $result->fetch_all(MYSQLI_ASSOC);

    

    return ['books' => $books, 'avescore' => $avescore, 'review' => $review, 'numreview' => $numreview];
    }

    public function getInfoAdd(){
        $query = "SELECT *
        FROM category";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_all(MYSQLI_ASSOC);

    $query = "SELECT *
        FROM author";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $author = $result->fetch_all(MYSQLI_ASSOC);

    return ['category' => $category, 'author' => $author];
    }

    public function insertBook($bookName, $descrip, $pub, $imgPath){
        $query = "INSERT INTO book(bookName, describ, pub_year, img_path) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $bookName, $descrip, $pub, $imgPath);
        // $stmt->execute();
        if ($stmt->execute()) {
            return $stmt->insert_id; 
        } else {
            return -1; 
        }
    }

    public function modifyBook($bookid, $bookName, $descrip, $imgPath){
        if ($imgPath === 'none'){
            $query = "UPDATE book SET bookName = ?, describ = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $bookName, $descrip, $bookid);
            $stmt->execute();
        }
        else{
            $query = "UPDATE book SET bookName = ?, describ = ?, img_path = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sssi", $bookName, $descrip, $imgPath, $bookid);
            $stmt->execute();
        }
    }

    public function removeBook($bookid){
        $query = "DELETE FROM book WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $bookid);
        $stmt->execute();
    }

    public function removeBookAuthor($bookid){
        $query = "DELETE FROM autho_rela WHERE bookid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $bookid);
        $stmt->execute();
    }

    public function removeBookCategory($bookid){
        $query = "DELETE FROM category_rela WHERE bookid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $bookid);
        $stmt->execute();
    }

    public function insertBookAuthor($bookid, $authorid){
        $query = "INSERT INTO autho_rela(bookid, authorid) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $bookid, $authorid);
        $stmt->execute();
    }

    public function insertBookCategory($bookid, $categoryname){
        $query = "INSERT INTO category_rela(bookid, catename) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("is", $bookid, $categoryname);
        $stmt->execute();
    }

}
?>