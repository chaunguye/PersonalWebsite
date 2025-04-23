<?php
$later = $bookshelf['later'];
$current = $bookshelf['current'];
$done = $bookshelf['done'];
?>
<div class="bookbody">


  <div class="shelf-section">
    <div class="shelf-title">📗 Later Reading</div>
    <div class="book-scroll">
      <?php foreach ($later as $book): ?>
        <div class="book-card">
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
        <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
          </a>
          <form action="../Controller/BookShelfController.php" method="POST" class="book-actions">
          <input type="hidden" name="bookId" value="<?=$book['id']?>">
          <input type="hidden" name="newStatus" value="current">
          <button type="submit">Start Reading</button>
        </form>
        <form action="../Controller/BookShelfController.php" method="POST" class="book-actions">
          <input type="hidden" name="bookId" value="<?=$book['id']?>">
          <input type="hidden" name="delete" value="later">
          <button type="submit">Remove</button>
        </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="shelf-section">
    <div class="shelf-title">📘 Currently Reading</div>
    <div class="book-scroll">
      <?php foreach ($current as $book): ?>
        <div class="book-card">
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
          <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
          </a>
          <form action="../Controller/BookShelfController.php" method="POST" class="book-actions">
          <input type="hidden" name="bookId" value="<?=$book['id']?>">
          <input type="hidden" name="newStatus" value="done">
          <button type="submit">Done Reading</button>
        </form>
        <form action="../Controller/BookShelfController.php" method="POST" class="book-actions">
          <input type="hidden" name="bookId" value="<?=$book['id']?>">
          <input type="hidden" name="delete" value="current">
          <button type="submit">Remove</button>
        </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Finished Reading -->
  <div class="shelf-section">
    <div class="shelf-title">📙 Finished Reading</div>
    <div class="book-scroll">
      <?php foreach ($done as $book): ?>
        <div class="book-card">
        <a class="booklink" href="index.php?webpage=singlebook&bookId=<?=$book['bookid']?>">
        <img src="<?= htmlspecialchars($book['img_path'])?>" alt="Book Cover">
          <h4><?= htmlspecialchars($book['bookName']) ?></h4>
          </a>
          <form action="../Controller/BookShelfController.php" method="POST" class="book-actions">
          <input type="hidden" name="bookId" value="<?=$book['id']?>">
          <input type="hidden" name="delete" value="done">
          <button type="submit">Remove</button>
        </form>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  </div>