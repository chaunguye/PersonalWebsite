<!-- <?php
echo"
    <div class=" ."bookpresent-left" .">
        <img src=" .$book["img_path"] ." class" ."bigimage" .">
        <button type=" ."button" .">Want to Read</button>
    </div>
    <div class=" ."bookpresent-right" .">
        <h2>" ." " .$book["bookName"] ."</h2>
                <p class='author'>" .$book["authorName"] ."</p>
                <p class='category'>Category: " .$book["catename"] ."</p>
                <p class='description'>"
                    .$book["describ"]
                ."</p>
    </div>

";
?> -->
<div class="bookpresent-left">
    <div><img src="<?= $book["img_path"] ?>" class="bigimage"></div>
    <div><button type="button">Want to Read</button></div>
    <div><button type="button">Rate this book</button></div>
</div>
<div class="bookpresent-right">
    <div><h1><?=$book["bookName"]?></h1></div>
    <div><p class="author"><?=$book["authorName"] ?></p></div>
    <div><p class="category">Gernes: <?=$book["catename"]?></p></div>
    <div><p class="description"><?=$book["describ"]?></p></div>
    <div><p class="rate">Rating: <?=$book["rate"]?></p></div>
    <div><p class="numofrate">Number of Rating: <?=$book["count"]?></p></div>
    <div><p class="pub">First publish in: <?=$book["pub_year"]?></p></div>
    <div><h2>About the Author:</h2></div>
    <div><p class="author"><?=$book["authorName"] ?></p></div>
    <div><p class="bio"><?=$book["bio"] ?></p></div>
    <div><p class="nation">Nation: <?=$book["nation"] ?></p></div>

    
</div>