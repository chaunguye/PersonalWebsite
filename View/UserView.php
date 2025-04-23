<?php
$user = $userResult['user'];
$friend = $userResult['friend'];
$current = $userResult['current'];
$later = $userResult['later'];
$done = $userResult['done'];
$useridFollow = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;

require_once "../Model/UserModel.php";
require_once '../config/connection.php';
$conn = new Database();
$db = $conn->connect();
$userModel = new UserModel($db);

$useridFollow = isset($_SESSION['userid']) ? $_SESSION['userid'] : -1;
$isFollowing = FALSE;

if ($useridFollow !== -1 && $user['id'] != $useridFollow) {
    $followingList = $userModel->getFriend($useridFollow);
    foreach ($followingList as $row) {
        if ($row['friendid'] == $user['id']) {
            $isFollowing = TRUE;
            break;
        }
    }
}

$buttonText = $isFollowing ? "Following" : "Follow";
$buttonClass = $isFollowing ? "follow-btn followed" : "follow-btn";

?>
<div class="userinfo">
    <div class="user-card">
        <img src="<?=$user['img_path']?>">
        <div class="user-info">
            <div class="user-follow">
              <h2><?php echo $user['firstName'] . ' ' . $user['lastName']; ?></h2>
              <?php if ($user['id'] !== $useridFollow && $useridFollow!==-1):?>
                <button class="<?=$buttonClass?>" name="follow" data-user-id="<?=$user['id']?>"><?=$buttonText?></button>
              <?php endif;?>
            </div>
            <p><strong>Sex:</strong> <?php echo $user['sex']; ?></p>
            <p><strong>Date of Birth:</strong> <?php echo $user['dob']; ?></p>
            <p><strong>Biography:</strong> <?php echo $user['bio']; ?></p>
        </div>
    </div>
</div>
<div class="bookbody">
<div class="shelf-section">
    <div class="shelf-title">📘 Currently Reading</div>
    <div class="book-scroll">
      <?php foreach ($current as $book): ?>
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
        <div class="book-card">
          <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
        </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="shelf-section">
    <div class="shelf-title">📗 Read Later</div>
    <div class="book-scroll">
      <?php foreach ($later as $book): ?>
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
        <div class="book-card">
        <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
        </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Finished Reading -->
  <div class="shelf-section">
    <div class="shelf-title">📙 Finished Reading</div>
    <div class="book-scroll">
      <?php foreach ($done as $book): ?>
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
        <div class="book-card">
        <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
        </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  </div>

  <script>
  $(".follow-btn").click(function () {
    let followedId = $(this).data("user-id");
    const button = $(".follow-btn[data-user-id='" + followedId + "']");
    const isFollowing = button.text().trim() === "Follow" ? "true" : "false";

    $.ajax({
      url: "../Controller/UserController.php",
      method: "POST",
      data: {
        follow: isFollowing,
        followed_user_id: followedId
      },
      success: function (response) {
        if(isFollowing === "true"){
          button.addClass("followed");
          button.text("Following");
        } else {
          button.removeClass("followed");
          button.text("Follow");
        }
      },
      error: function () {
        alert("Error following user.");
      }
    });
  });
</script>
