
<div class="bookpresent-left">
    <div><img src="<?= $book["img_path"] ?>" class="bigimage"></div>
    <div class="buttonunder">
        <div><button type="button">Want to Read</button></div>
        <div><button type="button">Rate this book</button></div>
    </div>
</div>
<div class="bookpresent-right">
    <div><h1><?=$book["bookName"]?></h1></div>
    <div><p class="author"><?=$book["authorName"] ?></p></div>
    <div><p class="category">Gernes: <?=$book["catename"]?></p></div>
    <div><p class="description"><?=$book["describ"]?></p></div>
    <!-- <div><p class="rate">Rating: <?=$book["rate"]?></p></div> -->
    <div class="rating">
        <?php $rating = $book['rate'];
        $fullStars = floor($rating);            
        $halfStar = ($rating - $fullStars) >= 0.25 && ($rating - $fullStars) < 0.75; 
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0); 
        ?>
        <?php for ($i = 0; $i < $fullStars; $i++): ?>
            <i class="fas fa-star"></i>
        <?php endfor; ?>
        <?php if ($halfStar): ?>
            <i class="fas fa-star-half-alt"></i>
        <?php endif; ?>
        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
            <i class="far fa-star"></i>
        <?php endfor; ?>
        <span class="score"><?= number_format($rating, 2) ?></span>
    </div>
    <div><p class="numofrate">Number of Rating: <?=$book["count"]?></p></div>
    <div><p class="pub">First publish in: <?=$book["pub_year"]?></p></div>
<hr>
    <div><h3>About the Author:</h3></div>
    <div><p class="author"><?=$book["authorName"] ?></p></div>
    <div><p class="bio"><?=$book["bio"] ?></p></div>
    <div><p class="nation">Nation: <?=$book["nation"] ?></p></div>

    <h3>Write a Review</h3>
    <form action="../Controller/ReviewController.php" method="POST" class="review-form">
    <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
    <label for="score">Your Score (0–5):</label>
    <input type="number" name="score" min="0" max="5" step="0.1" required><br>

    <label for="review_text">Your Review:</label><br>
    <textarea name="review_text" rows="5" cols="50" required></textarea><br>

    <input type="hidden" name="user_id" value="<?= $_SESSION['userid'] ?? -1 ?>"> 

    <button type="submit" name="submit_review">Submit Review</button>
</form>
</div>