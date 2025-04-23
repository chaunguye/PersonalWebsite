<?php
$later = array_slice($bookshelf['later'], 0, 3);
$current = array_slice($bookshelf['current'], 0, 3);
$done = array_slice($bookshelf['done'], 0, 3);
?>

<div class="Bookshelf">
        <h2>Bookshelf</h2>
        <ul>
            <li>
                <a class="booklink" href="index.php?webpage=mybook">Currently Reading</a>
                <ul> 
                    <?php foreach ($current as $row): ?>
                        <a class="shelflink" href="index.php?webpage=singlebook&bookId=<?=$row['bookid']?>"><li><?=$row['bookName']?></li></a>
                    <?php endforeach; ?>
                    <li><a class="booklink" href="index.php?webpage=mybook">More</a></li>
                </ul>
            </li>
            <li>
                <a class="booklink" href="index.php?webpage=mybook">Later Reading</a>
                <ul> 
                <?php foreach ($later as $row): ?>
                    <a class="shelflink" href="index.php?webpage=singlebook&bookId=<?=$row['bookid']?>"><li><?=$row['bookName']?></li></a>
                    <?php endforeach; ?>
                    <li><a class="booklink" href="index.php?webpage=mybook">More</a></li>
                </ul>
            </li>
            <li>
                <a class="booklink" href="index.php?webpage=mybook">Done Reading</a>
                <ul> 
                <?php foreach ($done as $row): ?>
                    <a class="shelflink" href="index.php?webpage=singlebook&bookId=<?=$row['bookid']?>"><li><?=$row['bookName']?></li></a>
                    <?php endforeach; ?>
                    <li><a class="booklink" href="index.php?webpage=mybook">More</a></li>
                </ul>
            </li>
        </ul>
    </div>