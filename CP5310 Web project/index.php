<?php
session_start();
include 'db_config.php';
?>

<!DOCTYPE html>
<title>Welcome to Wonderwall</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="styles.css">
<head>
  <script>
    // Script to open and close sidebar
    function navbar_open() {
      document.getElementById("mySidebar").style.display = "block";
    }
    function navbar_close() {
      document.getElementById("mySidebar").style.display = "none";
    }
  </script>
</head>

<body class="homepage">
    <nav>
    <!-- Sidebar (hidden by default) -->
      <div class="bar-block animate-left" id="mySidebar">
        <a onclick="navbar_close()" class="bar-item buttons">☰</a><br>
        <a onclick="navbar_close()" class="bar-item buttons" href="about_us.php"><h3>About Us</h3></a><br>
        <a onclick="navbar_close()" class="bar-item buttons" href="user_login.php">
        <h3><?php if(isset($_SESSION['username'])) echo "Your Profile"; else echo"Login";?></h3></a><br>
        <a onclick="navbar_close()" class="bar-item buttons" href="view_random_user.php"><h3>View Random User</h3></a><br>
      </div>
    <!-- Top menu -->
      <div class="topnavbar">
        <div class="buttons padding-16 float-left" onclick="navbar_open()">☰</div>
        <div class="float-center padding-16"><h1 class="title">Wonderwall</h1></div>
      </div>
  </nav>

  <!-- !CTA image! -->
  <div class="banner">
    <div class="banner-item-small">
         <a href="http://www.nikon.com./" target="_blank"><img src="images/gear.jpg"></a>
        <div class="hovertext float-center"><b>Check out our sponsors for photography gear!</b></div>
    </div>

    <div class="banner-item">
        <a href="photo_competition.php"><img src="images/competition.jpg"></a>
        <div class="hovertext float-center"><b>Create an account and submit!</b></div>
    </div>

     <div class="banner-item-small">
        <a href="view_user_profile.php?user=howard"><img src="images/howard_forest.jpg"></a>
        <div class="hovertext float-center"><b>Check out last year's winner!</b></div>
    </div>
  </div>

  <!-- Main image display -->
  <div class=img-container>
      <?php
          $query = "SELECT * FROM images ORDER BY uploaded DESC";
          $results = mysqli_query($con,$query);

          if ($results->num_rows >0){
            while($row = $results->fetch_assoc()){
                $image = 'user_images/'.$row["user_name"].'_'.$row["file_name"];
                echo "<div class='container-items'>
                        <img class='container-items'src='$image' loading='lazy'/>
                        <div class='overlay'>","Submitted by <a href='/view_user_profile.php?user=".$row["user_name"]."'>".$row["user_name"]."</a>
                        <br><a href='$image' download><button class='btn'>Download?</button></a>
                        </div>
                      </div>";
              }
          }
          else{
            echo "<p>No images found!</p>";
          }
      ?>
    <div class="footer-space"></div>
  </div>
  
  <!-- Footer -->
  <footer>
    <div>
      <h1>Wonderwall</h1>
    </div>
    <div>
      <h3>Contact Us</h3>
      <p>Questions? Concerns? Feedback? Do email us at contact@wonderwall.com</p>
    </div>
    <div>
      <h3>About</h3>
      <p>Wonderwall is a unique and attribution-free photo sharing service for professional developers and amateur hobbyists alike. </p>
    </div>
    <div>
      <p>By submitting to this website, you are agreeing that your work will be licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US">Creative Commons Attribution 3.0 Unported License.</a></p>
    </div>
  </footer>

</body>
</html>

