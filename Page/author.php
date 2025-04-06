<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author</title>
    <link rel="stylesheet" href="../Assests/css/style.css">
</head>
<body>
    <!-- <?php include 'navbar.php'; ?> -->
    <div class="container">
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
</body>
</html>

