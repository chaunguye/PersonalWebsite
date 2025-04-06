<?php
require_once '../config/connection.php';
require_once '../Model/AuthorModel.php';

class AuthorController {
    private $model;

    public function __construct($db) {
        $this->model = new AuthorModel($db);
    }

    public function displayAuthor() {
        $authorid = isset($_GET['authorId']) ? (int)$_GET['authorId'] : 1;

        $authorResult = $this->model->getAuthor($authorid);
        $author = $authorResult['author'];
        include '../View/AuthorView.php'; // Load the view with data
        $book = $authorResult['authorbook'];
        include '../View/AuthorBookView.php';
    }
}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$authorController = new AuthorController($db);
$authorController->displayAuthor();
?>