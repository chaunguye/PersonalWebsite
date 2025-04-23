<?php
require_once '../config/connection.php';
require_once '../Model/CategoryModel.php';

class CategoryController {
    private $model;

    public function __construct($db) {
        $this->model = new CategoryModel($db);
    }

    public function displayCategory() {

        $category = $this->model->getCategory();
        include '../View/CategoryView.php'; // Load the view with data
    }

    

}

// Instantiate the controller and run the method
$database = new Database();
$db = $database->connect();
$cateController = new CategoryController($db);


$cateController->displayCategory();


?>