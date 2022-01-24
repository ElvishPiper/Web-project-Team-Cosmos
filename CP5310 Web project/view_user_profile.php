<?php
session_start();
include 'db_config.php';

if(isset($_GET['user']) && $_GET['user']){ //check if viewing user is correctly set
    if(isset($_SESSION['username']) && $_GET['user']==$_SESSION['username']) //if viewing own profile, just redirect to user profile page
        header("Location: /user_profile.php");
    
    $viewing_user = $_GET['user'];
    $query = "SELECT * FROM users WHERE user_name='$viewing_user'"; //check if user exists in db
    $user_result = mysqli_query($con,$query);

    if($user_result->num_rows != 1)	//user does not exist, direct to home page
        header("Location: /index.php");   

	$user_row = mysqli_fetch_array($user_result,MYSQLI_ASSOC);		//retrieve user bio
	$user_bio = $user_row["user_bio"];
	if (empty($user_bio))
		$user_bio = "This user has not added a profile bio yet!";

	$pfp_name = "user_profile_pic/" . $viewing_user . "_" .$user_row['user_pic'];	// if no pfp set yet, use default
	if (empty($user_row['user_pic']))
		$pfp_name = "user_profile_pic/default.jpg";
}
else{
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<title>View User Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<link rel="stylesheet" href="styles.css">
	<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		 // Script to open and close sidebar
			function navbar_open() {
				$("#mySidebar").css("display","block");
			}
			function navbar_close() {
				$("#mySidebar").css("display","none");
			}
	</script>
</head>

<body>
	<nav>
    <!-- Sidebar (hidden by default) -->
		<div class="bar-block animate-left" id="mySidebar">
		<a onclick="navbar_close()" class="bar-item buttons">☰</a><br>
		<a onclick="navbar_close()" class="bar-item buttons" href="index.php"><h3>Home</h3></a><br>
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

	<div class="user-profile-container">

		<div class="profile">

			<div class="profile-image">
				<img src=<?php echo $pfp_name;?>>
			</div>

			<div class="profile-user-settings">
				<h2 class="profile-user-name"><?php echo $viewing_user; ?></h2>
			</div>

			<div class="profile-bio">
				<p><?php echo $user_bio; ?></p>
			</div>
		</div>

		<div>
			<br>
			<h3 class="float-center"><?php echo $viewing_user;?>'s Images</h3>
			<br>
		</div>
		
		<div class="gallery">
			<?php
				$query = "SELECT * FROM images WHERE user_name='".$viewing_user."' ORDER BY uploaded DESC";
				$results = mysqli_query($con,$query);

				if ($results->num_rows >0){
					while($row = $results->fetch_assoc()){
						$image = 'user_images/'.$viewing_user.'_'.$row["file_name"];
						echo "<div class='gallery-item'>
								<img class='gallery-image' src='$image' loading='lazy'>
								<div class='overlay'><a  href='$image' download><button class='btn'> Download </button></a></div>
							 </div>";
					}
				}
				else{
					echo "<p>This user has not uploaded any images yet.</p>";
				}
      		?>
		</div>

	</div>

</body>
</html>