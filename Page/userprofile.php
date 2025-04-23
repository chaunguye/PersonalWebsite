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
    <title>User</title>
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/userprofilestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
  
</head>
<body>
<?php if (isset($_SESSION['role']) && $_SESSION['role']==="admin"):?>
    <?php include 'navbaradmin.php';?>
<?php else:?>
    <?php include 'navbar.php';?>
<?php endif;?>

    <div class="container">
        <?php include '../Controller/ProfileController.php'; ?>
    </div>
<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</body>

</html>