<?php foreach ($category as $cate):?>
    <a href="../Page/index.php?webpage=homepage&category=<?=$cate['name']?>"><?=$cate['name']?></a>
<?php endforeach;?>