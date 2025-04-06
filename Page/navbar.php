<div class="header">
    <h1>Lazy Reader</h1>
    <nav>
        <ul>
            <li><a href="index.php?webpage=homepage">Home</a></li>
            <li><a href="#">My Book</a></li>
            <!-- <li><div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       Category
                    </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="index.php?webpage=category">Romance</a>
                    <a class="dropdown-item" href="#">Adventure</a>
                    <a class="dropdown-item" href="#">Thriller</a>
                </div>
                </div> 
</li> -->
            <!-- <li><a href="#">Category</a></li> -->
            <div class="dropdown">
                <button style="cursor:pointer" class="dropbtn">Category</button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <li><a href="#">Community</a></li>
            <li>
                <div class="search-drop">
                    <form action="homepage.php" METHOD="GET">
                        <input class="search-bar" id="search" name ="search" type="text" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    </form>
                    <div id="searchresult"></div>
                </div>
            </li>
            <!-- <li><button class="bi bi-bell" id="ring" onclick></button></li> -->
            <li><button type="button" class="signbutton" onclick="window.location.href='../Page/index.php?webpage=register';">Sign Up</button><button type="button" class="signbutton" onclick="window.location.href='../Page/index.php?webpage=login';">Sign In</button></li>
            <!-- <li><button type="button" class="signbutton">Sign In</button></li> -->
        </ul>
    </nav>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            var input = $(this).val();
            // alert(input);
            if (input != ""){
                $("#searchresult").css("display","inline-block");
                $.ajax({
                    url:"../Controller/livesearch.php",
                    method: "POST",
                    data: {input:input},

                    success:function(data){
                        $("#searchresult").html(data);
                        // $("#searchresult").css("display","block");
                    }
                });
            }else{
                $("#searchresult").css("display","none");
            }
        });
    });

</script>