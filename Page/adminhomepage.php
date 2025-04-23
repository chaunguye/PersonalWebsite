<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>Admin Panel</title>
 <link rel="stylesheet" href="../Assests/css/adminstyle.css">
 <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
 <link rel="databaseconnect" href="../config/connection.php">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'navbaradmin.php'; ?>
<div class="container">
    <div class="Recommendation">
        <h2>All Books</h2>
        <div class="sort-buttons">
        <button class="sorbut" onclick="sortBy('asc')">Sort A-Z</button>
        <button class="sorbut" onclick="sortBy('desc')">Sort Z-A</button>
        </div>
        <button onclick="window.location.href='./index.php?webpage=addbook'">Add a book</button>
        <script>
            function sortBy(order){
                let currentSort = new URL(window.location.href).searchParams.get('sort') || '';
                if (currentSort == order){
                    let url = new URL(window.location.href);
                    url.searchParams.delete('sort'); 
                    window.location.href = url.toString();
                }
                else{
                let url = new URL(window.location.href);
                url.searchParams.set('sort', order); 
                window.location.href = url.toString();
                }
            }
        </script> 
        <?php
        include '../Controller/BookControl.php';
        ?>
    </div>
    
</div>

<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</body>
</html>