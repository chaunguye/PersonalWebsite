<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $userid = $_SESSION['userid'] ?? -1;
    // session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/addbook.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
  
</head>
<body>
    <?php include 'navbaradmin.php'; ?>
    <div class="container">
        <?php include '../Controller/BookControl.php'; ?>
    </div>
<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</body>

</html>