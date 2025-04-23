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
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $inter_books = $this->model->getBooks($search, $order, $limit, $offset, $category);
        $books = $inter_books['books'];
        include '../View/RecoView.php'; // Load the view with data
    }

    public function addBookView() {
        $book = $this->model->getInfoAdd();
        include '../View/addBookView.php'; // Load the view with data
    }

    public function modifyBookView($bookid) {
        $cateauthor = $this->model->getInfoAdd();
        $bookfull = $this->model->getBookById($bookid);
        $book = $bookfull['books'];
        $categories = $cateauthor['category'];
        $authors = $cateauthor['author'];
        include '../View/modifyBookView.php'; // Load the view with data
    }

    public function displayBooksAdmin() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $order = isset($_GET['sort']) ? $_GET['sort'] : 'none';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $inter_books = $this->model->getBooks($search, $order, $limit, $offset);
        $books = $inter_books['books'];
        include '../View/AdminBooksView.php'; // Load the view with data
    }
    public function displaySingleBook(){
        $bookid = isset($_GET['bookId']) ? $_GET['bookId'] : 1;
        $books = $this->model->getBookById((int)($bookid));
        include '../View/SingleBookView.php';
    }
    public function insertBook($bookName, $descrip, $pub, $imgPath){
        return $this->model->insertBook($bookName, $descrip, $pub, $imgPath);
    }

    public function modifyBook($bookid, $bookName, $descrip, $imgPath){
        echo "controller";
        return $this->model->modifyBook($bookid, $bookName, $descrip, $imgPath);
    }

    public function removeBook($bookid){
        $this->model->removeBook($bookid);
        // header("Location: '../page/index.php?webpage=adminhomepage'");
    }


    public function insertBookAuthor($bookId, $authorId){
        $this->model->insertBookAuthor($bookId, $authorId);
    }

    public function insertBookCategory($bookId, $catename){
        $this->model->insertBookCategory($bookId, $catename);
    }

    public function removeBookAuthor($bookId){
        $this->model->removeBookAuthor($bookId);
    }

    public function removeBookCategory($bookId){
        $this->model->removeBookCategory($bookId);
    }


}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$bookController = new BookController($db);

if ($_SERVER['REQUEST_METHOD']==="POST"){
    if (isset($_POST['action']) && $_POST['action'] === 'delete'){
        $bookid = $_POST['bookId'];
        $bookController->removeBookCategory($bookid);
        $bookController->removeBookAuthor($bookid);
        $bookController->removeBook($bookid);
        header("Location: ../Page/index.php?webpage=adminhomepage");
        exit();
    }
    if (isset($_POST['action']) && $_POST['action'] === 'modify'){
        // echo "hello modify";
        $bookid = $_POST['bookId'];
        $bookName = $_POST['bookName'];
        $bookController->removeBookCategory($bookid);
        $bookController->removeBookAuthor($bookid);
        foreach ($_POST['authors'] as $authorId) {
            $bookController->insertBookAuthor($bookid, $authorId);
        }
        foreach ($_POST['categories'] as $category) {
            $bookController->insertBookCategory($bookid, $category);
        }
        $descrip = $_POST['bookDescription'];
        $imgPath = 'none';
        if (!empty($_FILES['img']['name'])) {
            $targetDir = "../Assests/image/";
            $fileName = basename($_FILES["img"]["name"]);
            $targetFile = $targetDir . time() . "_" . $fileName;
            move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
            $imgPath = $targetFile;
        }
        $bookController->modifyBook($bookid, $bookName, $descrip, $imgPath);
        header("Location: ../Page/index.php?webpage=adminhomepage");
        exit();
        
    }

    $imgPath = "../Assests/image/11.jpg"; // default image
if (!empty($_FILES['img']['name'])) {
    $targetDir = "../Assests/image/";
    $fileName = basename($_FILES["img"]["name"]);
    $targetFile = $targetDir . time() . "_" . $fileName;
    move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
    $imgPath = $targetFile;
}

$bookName = $_POST['title'];
$descrip = $_POST['description'];
$pub = $_POST['publish_year'];

// Insert the book
$bookId = $bookController->insertBook($bookName, $descrip, $pub, $imgPath);

// Insert authors relation
// $authorId = $_POST['authors'];
// $bookController->insertBookAuthor($bookId, $authorId);
foreach ($_POST['authors'] as $authorId) {
    $bookController->insertBookAuthor($bookId, $authorId);
}


// Insert categories
// $categoryname = $_POST['categories'];
// $bookController->insertBookCategory($bookId, $categoryname);
foreach ($_POST['categories'] as $categoryName) {
    $bookController->insertBookCategory($bookId, $categoryName);
}

header("Location: ../Page/index.php?webpage=adminhomepage");
}

else{
    if (isset($_GET['webpage'])){
    if ($_GET['webpage'] == 'homepage'){
    $bookController->displayBooks();}
    elseif ($_GET['webpage'] == 'adminhomepage'){
        $bookController->displayBooksAdmin();}
    elseif ($_GET['webpage'] == 'addbook'){
        $bookController->addBookView();} 
    elseif ($_GET['webpage'] == 'modifybook'){
        $bookid = isset($_GET['bookId']) ? $_GET['bookId'] : 1;
        $bookController->modifyBookView($bookid);}    
    else {$bookController->displaySingleBook();}
}
else{$bookController->displayBooks();} 
}

?>