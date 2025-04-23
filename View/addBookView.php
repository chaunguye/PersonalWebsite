<?php
    $categories = $book['category'];
    $authors = $book['author'];
?>
<div class="container">

<form action="../Controller/BookControl.php" method="POST" enctype="multipart/form-data">
  <label>Title:</label>
  <input type="text" name="title" required>

  <label>Description:</label>
  <textarea name="description"></textarea>

  <label>Publish Year:</label>
  <input type="number" name="publish_year" min="1000" max="<?= date('Y') ?>">

  <label>Cover Image:</label>
  <input type="file" name="img">

  <label>Select Authors:</label>
  <select name="authors[]" multiple>
    <?php foreach ($authors as $author): ?>
      <option value="<?= $author['id'] ?>"><?= $author['firstName'] ." " .$author['lastName'] ?></option>
    <?php endforeach; ?>
  </select>

  <label>Select Categories:</label>
  <select name="categories[]" multiple>
    <?php foreach ($categories as $category): ?>
      <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit">Add Book</button>
</form>
</div>
