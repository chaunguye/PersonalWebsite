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
 <title>My New Website</title>
 <link rel="stylesheet" href="../Assests/css/style.css">
 <link rel="stylesheet" href="../Assests/css/navbarstyle2.css">
 <link rel="databaseconnect" href="../config/connection.php">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<?php include 'navbar.php'; ?>

<!-- <img src="../Assests/image/theme2.jpg" id="themeimg"> -->
<div class="container">
    <?php
        include '../Controller/BookShelfController.php';
    ?>
    <div class="Recommendation">
        <h2>Recommendation</h2>
        <div class="sort-buttons">
        <button class="sorbut" onclick="sortBy('asc')">Sort A-Z</button>
        <button class="sorbut" onclick="sortBy('desc')">Sort Z-A</button>
        </div>
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
    <div class="news">
        <h2>News and Interviews</h2>
        <ul style="list-style-type: none;" class="news-list">
            <li>
                <div class="news-card">
                    <h4>New literal nobel</h4>
                    <p>The Norwish Writer Alex...</p>
                    <img src="../Assests/image/invisibleman.jpg" class="newimg">
                </div>
            </li>
            <li>
                <div class="news-card">
                <h4>Hot Book in the week</h4>
                <p>The book 1Q84 by Haruki Murakami...</p>
                <img src="../Assests/image/pretend_dead.jpg" class="newimg">
                </div>
            </li>
        </ul> 
    </div>
</div>

<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15678.045248799588!2d106.6394476714288!3d10.772095534491177!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec3c161a3fb%3A0xef77cd47a1cc691e!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJDhuqFpIGjhu41jIFF14buRYyBnaWEgVFAuSENN!5e0!3m2!1svi!2s!4v1745390971992!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</footer>
</body>
</html>