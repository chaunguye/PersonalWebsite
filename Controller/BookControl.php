<?php
require_once '../config/connection.php';
require_once '../Model/BookModel.php';

class BookController {
    private $model;

    public function __construct($db) {
        $this->model = new BookModel($db);
    }

    public function displayBooks() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['sort']) ? $_GET['sort'] : 'none';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $inter_books = $this->model->getBooks($search, $order, $limit, $offset);
        $books = $inter_books['books'];
        include '../View/RecoView.php'; // Load the view with data
    }
    public function displaySingleBook(){
        $bookid = isset($_GET['bookId']) ? $_GET['bookId'] : 1;
        $book = $this->model->getBookById((int)($bookid));
        include '../View/SingleBookView.php';
    }
}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$bookController = new BookController($db);
if (isset($_GET['webpage'])){
    if ($_GET['webpage'] == 'homepage'){
    $bookController->displayBooks();}
    else {$bookController->displaySingleBook();}
}
else{$bookController->displayBooks();} 
?>