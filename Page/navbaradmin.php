<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"> -->
<div class="header">
    <h1><a href="index.php?webpage=adminhomepage">Lazy Reader</a></h1>
    <nav>
        <ul>
            <li>
                <?php if (isset($_SESSION['role'])): ?>
                    <div class="dropdown-profile">
                        <button onclick="toggleDropdown()" class="dropdown-toggle-profile" type="button">
                            <img src="<?=$_SESSION['img_path']?>" alt="User Avatar" id="user_img">
                        </button>
                        <div id="dropdown-menu-profile" class="dropdown-menu-profile">
                            <a href="index.php?webpage=userprofile">Profile</a>
                            <!-- <a href="#">Settings</a> -->
                            <a href="./logout.php">Logout</a>
                        </div>
                    </div>

                <?php else: ?>
                    <button type="button" class="signbutton" onclick="window.location.href='../Page/index.php?webpage=register';">Sign Up</button>
                    <button type="button" class="signbutton" onclick="window.location.href='../Page/index.php?webpage=login';">Sign In</button>
                <?php endif; ?>
            <!-- </form> -->
            </li>
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
        $(document).click(function (event) {
        const target = $(event.target);
        if (
            !target.closest('#searchresult').length && 
            !target.closest('#search').length
        ) {
            $("#searchresult").hide();
        }
    });
    });



</script>


<script>
function toggleDropdown() {
  document.getElementById("dropdown-menu-profile").classList.toggle("show");
}

// window.onclick = function(event) {
//   if (!event.target.matches('.dropdown-toggle-profile')) {
//     const dropdowns = document.getElementsByClassName("dropdown-menu-profile");
//     for (let i = 0; i < dropdowns.length; i++) {
//       dropdowns[i].style.display = "none";
//     }
//   }
// };
window.onclick = function(event) {
  if (!event.target.closet('.dropdown-toggle-profile')) {
    var dropdowns = document.getElementsByClassName("dropdown-menu-profile");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
