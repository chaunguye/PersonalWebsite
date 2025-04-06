<!-- <?php
session_start();
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>My New Website</title>
 <link rel="stylesheet" href="../Assests/css/style.css">
 <link rel="databaseconnect" href="../config/connection.php">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
</head>
<body>

<?php include 'navbar.php'; ?>

<img src="../Assests/image/theme2.jpg" id="themeimg">
<div class="container">
    <div class="Bookshelf">
        <h2>Bookshelf</h2>
        <ul>
            <li>
                <a class="booklink" href="#">Currently Reading Books</a>
                <ul> 
                    <li>Book 1</li>
                    <li>Book 2</li>
                    <li>Book 3</li>
                    <li>More</li>
                </ul>
            </li>
            <li>
                <a class="booklink" href="#">Later Reading</a>
                <ul> 
                    <li>Book 1</li>
                    <li>Book 2</li>
                    <li>Book 3</li>
                    <li>More</li>
                </ul>
            </li>
            <li>
                <a class="booklink" href="#">Liked Books</a>
                <ul> 
                    <li>Book 1</li>
                    <li>Book 2</li>
                    <li>Book 3</li>
                    <li>More</li>
                </ul>
            </li>
            <li>
                <a class="booklink" href="#">Your Friends Also Like</a>
                <ul> 
                    <li>Book 1</li>
                    <li>Book 2</li>
                    <li>Book 3</li>
                    <li>More</li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="Recommendation">
        <h2>Recommendation</h2>
        <button class="sorbut" onclick="sortBy('asc')">Sort A-Z</button>
        <button class="sorbut" onclick="sortBy('desc')">Sort Z-A</button>
        <script>
            function sortBy(order){
                let url = new URL(window.location.href);
                url.searchParams.set('sort', order); // Replaces 'sort' if it exists, otherwise adds it
                window.location.href = url.toString();
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
</footer>
</body>
</html>