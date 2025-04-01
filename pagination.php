        <?php
			unset($_GET['page']);
			$query_link = http_build_query($_GET);
			$query_link = $query_link ? '&' .$query_link : ';';
		?>
		
		<?php if ($page > 1): ?>
            <li><a class="pagebutton" href="?page=<?php echo $page - 1 .$query_link; ?>">Prev</a></li>
        <?php endif; ?>

        <?php if ($page == 1): ?>
            <li><a class="pagebutton" href="?page=<?php echo $page .$query_link; ?>">Prev</a></li>
        <?php endif; ?>

        <?php if ($page > 4): ?>
	        <li><a href="?page=1<?php echo $query_link;?>">1</a></li>
	        <li class="dots">...</li>
	    <?php endif; ?>

        <?php if ($page - 2 > 0): ?>
	        <li><a href="?page=1<?php echo $query_link;?>">1</a></li>
	        <li class="dots">...</li>
	    <?php endif; ?>
        
        <?php if ($page - 2 > 0): ?>
	        <li><a href="?page=<?php echo $page-2 .$query_link; ?>"><?php echo $page-2; ?></a></li>
	    <?php endif; ?>
        <?php if ($page - 1 > 0): ?>
	        <li><a href="?page=<?php echo $page-1 .$query_link; ?>"><?php echo $page-1; ?></a></li>
	    <?php endif; ?>

        <li><a class="current_page" href="?page=<?php echo $page .$query_link; ?>"><?php echo $page ?></a></li>

        <?php if ($page < $total_page -1): ?>
	        <li><a href="?page=<?php echo $page+2 .$query_link; ?>"><?php echo $page+1; ?></a></li>
	    <?php endif; ?>
        <?php if ($page < $total_page): ?>
	        <li><a href="?page=<?php echo $page+1 .$query_link; ?>"><?php echo $page+1; ?></a></li>
	    <?php endif; ?>

        <?php if ($page < $total_page-2): ?>
	        <li class="dots">...</li>
            <li><a href="?page=<?php echo $total_page .$query_link; ?>"><?php echo $total_page; ?></a></li>
	    <?php endif; ?>

        <?php if ($page < $total_page): ?>
	        <li><a class="pagebutton" href="?page=<?php echo $page+1 .$query_link; ?>">Next</a></li>
	    <?php endif; ?>
        <?php if ($page == $total_page): ?>
	        <li><a class="pagebutton" href="?page=<?php echo $page .$query_link; ?>">Next</a></li>
	    <?php endif; ?>