<form action="../Controller/BookControl.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="modify">
    <input type="hidden" name="bookId" value="<?php echo $book['id']; ?>" />
    
    <label for="bookName">Book Name:</label>
    <input type="text" name="bookName" value="<?php echo $book['bookName']; ?>" required />
    
    <!-- <label for="author">Author:</label>
    <input type="text" name="author" value="<?php echo $book['authorName']; ?>" required /> -->
    <label>Authors:</label>
    <select name="authors[]" multiple>
        <?php foreach ($authors as $author): ?>
            <?php if($book['authorid']===$author['id']):?>
                <option value="<?= $author['id'] ?>" selected><?= $author['firstName'] ." " .$author['lastName'] ?></option>
            <?php else: ?>
                <option value="<?= $author['id'] ?>"><?= $author['firstName'] ." " .$author['lastName'] ?></option>
            <?php endif;?>
        <?php endforeach; ?>
    </select>

    <label>Category:</label>
    <select name="categories[]" multiple>
        <?php foreach ($categories as $category): ?>
            <?php if($book['catename']===$category['name']):?>
                <option value="<?= $category['name'] ?>" selected><?= $category['name'] ?></option>
            <?php else: ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
            <?php endif;?>
        <?php endforeach; ?>
    </select>
    
    
    <label for="bookDescription">Description:</label>
    <textarea name="bookDescription" required><?php echo $book['describ']; ?></textarea>
    
    <label>Cover Image:</label>
    <input type="file" name="img">

    <button type="submit">Update Book</button>
</form>