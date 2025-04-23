<h2>Friend List</h2>
<div class="friendlist">
<?php foreach ($friend as $row): ?>
        <a style="text-decoration: none;" href="index.php?webpage=user&userId=<?=$row['id']?>"><div class='friendcard'>
                <img src="<?=$row['img_path']?>">
                <div class="frienddetail">
                    <p><?=$row['userName']?></p>
                    <p class="italic"><?=$row['firstName'] .' ' .$row['lastName']?></p>
                </div>
        </div></a>
    <?php endforeach; ?>
</div>