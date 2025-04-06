    
<?php foreach ($author as $row): ?>
    <?php
    echo"
    <h1>" .$row['firstName'] ."</h1>
    ";
    ?>
    <div class="author-card">
        <h2><?php echo $row['firstName'] . ' ' . $row['lastName']; ?></h2>
        <div class="author-info">
            <p><strong>Sex:</strong> <?php echo $row['sex']; ?></p>
            <p><strong>Nationality:</strong> <?php echo $row['nation']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['describ']; ?></p>
            <p><strong>Biography:</strong></p>
            <p><?php echo nl2br($row['bio']); ?></p>
        </div>
    </div>
    <?php endforeach; ?>



    