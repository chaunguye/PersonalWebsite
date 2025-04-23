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
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

<style>
    .news{
    width: 40%;
}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<img src="../Assests/image/theme2.jpg" id="themeimg">
<div class="container">
    <div class="web_descrip">
        <h1>WELCOME TO THE LAZY READER</h1>
        <p>This is the website for you to choose a good book to read without wasting time on valueless books.
            You can do that base on the scores and frankly reviews from the community to decide whether to read that book.
        </p>
        <h3>Now, let's the journey begin</h3>
        <?php if (isset($_SESSION['userid'])):?>
            <a href="index.php?webpage=homepage"><button type="button" >Get Started</button></a>
        <?php else:?>
            <a href="index.php?webpage=register"><button type="button" >Get Started</button></a>
        <?php endif;?>
        
        <!-- <form action="index.php" >
            <button type="submit">Get Started</button>
        </form> -->
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