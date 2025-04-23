
<?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  $userid = $_SESSION['userid'] ?? -1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="stylesheet" href="../Assests/css/navbarstyle.css">
    <link rel="stylesheet" href="../Assests/css/community.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container montserrat-normal">
        <div class="search-display">
            <h1>Find a User</h1>
            <form action="community.php" METHOD="GET">
                <input class="usersearch-bar" id="usersearch" name ="search" type="text" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </form>
            <div id="usersearchresult"></div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        $(document).ready(function(){
        $("#usersearch").keyup(function(){
            var input = $(this).val();
            console.log("Input: ", input); 
            // alert(input);
            if (input != ""){
                $("#usersearchresult").css("display","inline-block");
                $.ajax({
                    url:"../Controller/CommunityController.php",
                    method: "POST",
                    data: {input:input},

                    success:function(data){
                        $("#usersearchresult").html(data);
                    }
                });
            }else{
                $("#usersearchresult").css("display","none");
            }
        });
        $(document).click(function (event) {
        const target = $(event.target);
        if (
            !target.closest('#usersearchresult').length && 
            !target.closest('#usersearch').length
        ) {
            $("#usersearchresult").hide();
        }
    });
    });


</script>
        <?php include '../Controller/CommunityController.php'; ?>
    </div>
<footer>
    <p>&copy; 2025 My Website. All Rights Reserved.</p>
</footer>
</body>

</html>