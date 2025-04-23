<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author</title>
    <link rel="stylesheet" href="../Assests/css/authorstyle.css">
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
</head>
<body>
    <div class="container">
        <?php include 'navbar.php'; ?>
        <?php include '../Controller/AuthorController.php'; ?>
    </div>
    <script>
    function scrollBooks(direction) {
        const container = document.getElementById('bookList');
        const scrollAmount = 220; // adjust to match card width
        container.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</body>
</html>

