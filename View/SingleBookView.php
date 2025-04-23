
<?php
    $book = $books['books'];
    $avescore = $books['avescore'];
    $review = $books['review'];
    $numreview = $books['numreview'];
    $book_id = isset($_GET['bookId']) ? $_GET['bookId'] : 1;
    $useridFollow = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;
    require_once "../Model/UserModel.php";
    require_once "../Model/BookShelfModel.php";
    require_once '../config/connection.php';
    $conn = new Database();
    $db = $conn->connect();
    $userModel = new UserModel($db);
    $shelfModel = new BookShelfModel($db);
    function checkIfFollowing($friendid, $userModel) {
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            // echo $userid;
            $userFollowing = $userModel->getFriend($userid);
            foreach ($userFollowing as $row){
                // echo $row['friendid'];
                if ($row['friendid'] == $friendid){
                    return TRUE;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

    function checkIfWantToRead($bookid, $shelfModel) {
        if(isset($_SESSION['userid'])){
            $userid = $_SESSION['userid'];
            $allbook = $shelfModel->getShelf($userid);
            $laterread = $allbook['later'];

            foreach ($laterread as $row){
                // echo $row['friendid'];
                if ($row['bookid'] == $bookid){
                    return TRUE;
                }
            }
            return FALSE;
        }
        return FALSE;
    }

    $reviewgiven = 0;
    $review_content = "none";
    $review_score = -1;
    if (isset($_SESSION['userid'])){
        $reviewgiven = 1;
        foreach($review as $row){
            if ($row['userid'] === $_SESSION['userid']){
                $reviewgiven = 2;
                $review_content = $row['review'];
                $review_score = $row['score'];
                break;
            }
        }
    }
    
    
?>

<div class="bookpresent-left">
    <div><img src="<?= $book["img_path"] ?>" class="bigimage"></div>
    <div class="buttonunder">
        <!-- <form method="POST" action="../Controller/BookShelfController.php"> -->
            <?php 
            $iswant = checkIfWantToRead($book["id"], $shelfModel);

            $wantText = $iswant ? "Added to BookShelf" : "Want to Read";
            $wantClass = $iswant ? "want-to-read-btn followed" : "want-to-read-btn";
            ?>
            <div><button type="button" name="wanttoread" value="<?=$book["id"]?>" class="<?=$wantClass?>" data-bookid="<?= $book["id"] ?>"><?=$wantText?></button></div>
        <!-- </form> -->
        <div><a href="#reviewsection"><button type="button">Rate this book</button></a></div>
    </div>
</div>
<div class="bookpresent-right">
    <div><h1><?=$book["bookName"]?></h1></div>
    <div><a class="author-link" href="../Page/index.php?webpage=author&authorId=<?=$book['authorid']?>"><p class="author"><?=$book["authorName"] ?></p></a></div>
    <div><p class="category">Gernes: <?=$book["catename"]?></p></div>
    <div><p class="description"><?=$book["describ"]?></p></div>
    <div class="rating">
        <?php $rating = (float)($avescore['avgsco'] ?? 0.0);
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
    <div><p class="numofrate">Number of Rating: <?=$numreview["numreview"]?></p></div>
    <div><p class="pub">First publish in: <?=$book["pub_year"]?></p></div>
<hr>
    <div><h3>About the Author:</h3></div>
    <div><a class="author-link" href="../Page/index.php?webpage=author&authorId=<?=$book['authorid']?>"><p class="author2"><?=$book["authorName"] ?></p></a></div>
    <div><p class="bio"><?=$book["bio"] ?></p></div>
    <div><p class="nation">Nation: <?=$book["nation"] ?></p></div>
    <hr>
    <?php if ($reviewgiven === 0):?>
        <p>Please <a href="../Page/login.php">log in</a> to leave a review.</p>
    <?php elseif ($reviewgiven === 1):?>
    <h3 id="reviewsection">Write a Review</h3>
    <div class="reviewsection">
    <form action="../Controller/ReviewController.php" method="POST" class="review-form">
        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">

        <label for="score">Your Score (0–5):</label>
        <input type="number" name="score" min="0" max="5" step="0.1" required>

        <label for="review">Your Review:</label>
        <textarea name="review_text" rows="4" placeholder="Write your thoughts..." required></textarea>

        <button type="submit" name="insertReview">Submit</button>
    </form>
    </div>
    <?php else:?>
        <h3>Modify Your Review</h3>
        <div class="reviewsection">
        <form action="../Controller/ReviewController.php" method="post" class="review-form">
            <input type="hidden" name="book_id" value="<?= htmlspecialchars($book_id) ?>">
            <input type="number" name="score" min="0" max="5" step="0.1" placeholder="<?=$review_score?>" required>
            <textarea name="review_text" required><?= htmlspecialchars($review_content) ?></textarea><br>
            <button type="submit" name="updateReview">Update Review</button>
        </form>
        </div>
    <?php endif; ?>
<hr>
<h2 id="reviewsection">Community Review</h2>
<div class="rating">
        <?php $rating = (float)($avescore['avgsco'] ?? 0.0);
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
    <div><p class="numofrate">Number of Rating: <?=$numreview["numreview"]?></p></div>
    <?php foreach ($review as $row):
        $isFollowing = checkIfFollowing($row['userid'], $userModel);
        // echo $row['userid'];

        $buttonText = $isFollowing ? "Following" : "Follow";
        $buttonClass = $isFollowing ? "follow-btn followed" : "follow-btn";
        $followerCount = $userModel->getFollowerCount($row['userid']);
         ?>
        <div class='reviewuser'>
            <div class='review_userinfo'>
                <div><a class='bold'><?=$row["firstName"]?> <?= $row["lastName"]?></a></div>
                <div><p class="follower_count" data-user-id="<?=$row['userid']?>">Follower: <?=$followerCount?></p></div>
                <?php if ($row['userid'] !== $useridFollow && $useridFollow!==-1):?>
                <button class="<?=$buttonClass?>" name="follow" data-user-id="<?=$row['userid']?>"><?=$buttonText?></button>
                <?php endif;?>
            </div>
            <div class='vline'></div>
            <div class='review_userreview'>
                <div><p class='italic'>Score: <?=$row["score"]?> </p></div>
                <div><p><?=$row["review"]?></p></div>
                <div class='hline'></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
  $(".follow-btn").click(function () {
    
    let followedId = $(this).data("user-id");
    const button = $(".follow-btn[data-user-id='" + followedId + "']");
    const isFollowing = button.text().trim() === "Follow" ? "true" : "false";
    const followerCount = $(".follower_count[data-user-id='" + followedId + "']");
    let numCount = parseInt(followerCount.text().replace(/\D/g, ''));

    $.ajax({
      url: "../Controller/UserController.php",
      method: "POST",
      data: {
        follow: isFollowing,
        followed_user_id: followedId
      },
      success: function (response) {
        if(isFollowing==="true"){
            button.addClass("followed");
            button.text("Following");
            numCount = numCount + 1;
        }
        else{
            button.removeClass("followed");
            button.text("Follow");
            numCount = numCount - 1;
        }
        followerCount.text(`Following: ${numCount}`);
        
      },
      error: function () {
        alert("Error following user.");
      }
    });
  });


  $(".want-to-read-btn").click(function () {
    
    let bookid = $(this).data("bookid");
    const button = $(".want-to-read-btn[data-bookid='" + bookid + "']");
    const isFollowing = button.text().trim() === "Want to Read" ? "true" : "false";

    $.ajax({
      url: "../Controller/BookShelfController.php",
      method: "POST",
      data: {
        inshelf: isFollowing,
        book_id: bookid
      },
      success: function (response) {
        if(isFollowing==="true"){
            button.addClass("followed");
            button.text("Added to BookShelf");
        }
        else{
            button.removeClass("followed");
            button.text("Want to Read");
        }
        
      },
      error: function () {
        alert("Error following user.");
      }
    });
  });
</script>
