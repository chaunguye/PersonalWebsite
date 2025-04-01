<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>My New Website</title>
 <link rel="stylesheet" href="./css/style.css">
 <link rel="databaseconnect" href="./connection.php">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>

<div class="header">
    <h1>Lazy Reader</h1>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">My Book</a></li>
            <li><a href="#">Category</a></li>
            <li><a href="#">Community</a></li>
            <li>
                <form action="index.php" METHOD="GET">
                    <input class="search-bar" name ="search" type="text" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </form>
            </li>
            <li><button class="bi bi-bell" id="ring"></button></li>
            <li><button type="button" class="signbutton">Sign Up</button><button type="button" class="signbutton">Sign In</button></li>
            <!-- <li><button type="button" class="signbutton">Sign In</button></li> -->
        </ul>
    </nav>
</div>
<!-- <div class="theme">
        <img src="./image/theme2.jpg" id="themeimg">
</div>  -->
<img src="./image/theme2.jpg" id="themeimg">
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
        <!-- <div class = "topRecom">
            <div><h2>Recommendation</h2> </div>
            <div><button onclick="sortNames('asc')">Sort A-Z</button></div>
            <div><button onclick="sortNames('desc')">Sort Z-A</button></div>
        <div> -->
        <h2>Recommendation</h2>
        <!-- <button class="sorbut" href="?sort=acs"; ?>>Sort A-Z</button>
        <button class="sorbut" href="?sort=dcs"; ?>>Sort Z-A</button> -->
        <button class="sorbut" onclick="sortBy('asc')">Sort A-Z</button>
        <button class="sorbut" onclick="sortBy('desc')">Sort Z-A</button>
        <script>
            function sortBy(order){
                let url = new URL(window.location.href);
                url.searchParams.set('sort', order); // Replaces 'sort' if it exists, otherwise adds it
                window.location.href = url.toString();
            }
        </script> 
       <ul style="list-style-type: none;">
        <?php
        include 'RecoDisplay.php';
        ?>
            
       </ul>
    <div class="pagination">
        <ul class="pagelist">
        <?php
        include 'pagination.php';
        ?>
        </ul>
    </div>
      
    </div>
    <div class="news">
        <h2>News and Interviews</h2>
        <ul style="list-style-type: none;" class="news-list">
            <li>
                <div class="news-card">
                    <h4>New literal nobel</h4>
                    <p>The Norwish Writer Alex...</p>
                    <img src="./image/invisibleman.jpg" class="newimg">
                </div>
            </li>
            <li>
                <div class="news-card">
                <h4>Hot Book in the week</h4>
                <p>The book 1Q84 by Haruki Murakami...</p>
                <img src="./image/pretend_dead.jpg" class="newimg">
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