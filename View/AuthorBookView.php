
    <div class="book-section">
        <button class="scroll-btn scroll-left" onclick="scrollBooks(-1)">&#8592;</button>
        <div class="book-list" id="bookList">
            <?php foreach ($book as $row): ?>
                <div class="book-card">
                    <img src="<?php echo $row['img_path']; ?>" alt="Book Image">
                    <h4><?php echo $row['bookName']; ?></h4>
                    <p><?php echo $row['catename']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="scroll-btn scroll-right" onclick="scrollBooks(1)">&#8594;</button>
    </div>




    