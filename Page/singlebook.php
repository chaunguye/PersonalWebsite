<?php 
    session_start();
    $userid = $_SESSION['userid'] ?? -1;
    // session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LazyReader</title>
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/singlebook.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <?php include '../Controller/BookControl.php'; ?>
        <?php include '../Controller/ReviewController.php'; ?>
    </div>
    
</body>
</html>