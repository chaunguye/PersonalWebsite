    
<?php foreach ($author as $row): ?>
    <div class="author-card">
        <h2><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h2>
        <div class="author-info">
            <p><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
            <p><strong>Nationality:</strong> <?php echo $row['nation']; ?></p>
            <p><strong>Biography:</strong> <?php echo $row['bio']; ?></p>
        </div>
    </div>
    <?php endforeach; ?>



    