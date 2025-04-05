<?php
   require_once '../config/connection.php';
   $database = new Database();
    $db = $database->connect();
   if(isset($_POST['input'])){
        $input = $_POST['input'];
        $query = "SELECT Book.*, category_rela.catename, CONCAT(author.firstName,' ', author.lastName) as authorName
                  FROM Book
                  LEFT JOIN category_rela ON Book.id = category_rela.bookid
                  LEFT JOIN autho_rela on Book.id = autho_rela.bookid
                  LEFT JOIN author on autho_rela.authorid = author.id
                  WHERE bookName LIKE '{$input}%'
                  LIMIT 5";
        $result = $db->query($query);
        if($result->num_rows >0){
            while ($row = $result->fetch_assoc()) {
                echo '<a href="singlebook.php?bookId=' . $row['id'] . '">' .$row['bookName'] . '</a>';
            }
        }
        else{
            echo "<h4 class='notfound'>No result found</h4>";
        }
   }

?>