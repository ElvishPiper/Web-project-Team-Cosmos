<?php
session_start();
include 'db_config.php';

define('MB', 1048576);

if (!isset($_SESSION['username'])){		// if user accesses this page without logging in, direct to login page
    header("Location: /user_login.php");
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT user_bio, user_pic FROM users where user_name ='$username'";		//db query for stored user bio and pfp name
$row = mysqli_fetch_array(mysqli_query($con,$query));
$user_bio = $row['user_bio'];
if (empty($user_bio))
	$user_bio = "Your bio is currently empty! Tell people something about yourself!";

$pfp_name = "user_profile_pic/" . $username . "_" .$row['user_pic'];	// if no pfp set yet, use default
if (empty($row['user_pic']))
	$pfp_name = "user_profile_pic/default.jpg";

if(isset($_FILES['pfp'])){	//db query for updating profile pic
	$errors= array();
	$file_name = $_FILES['pfp']['name'];
	$file_size =$_FILES['pfp']['size'];
	$file_tmp =$_FILES['pfp']['tmp_name'];
	$file_type=$_FILES['pfp']['type'];
	$file_ext = explode('.',$_FILES['pfp']['name']);
	$file_ext=strtolower(end($file_ext));
	
	$extensions= array("jpeg","jpg","png");

	if(!in_array($file_ext,$extensions))
		$errors[]="Please upload only JPG or PNG files.";
	
	if($file_size > 1*MB)
		$errors[]='File size cannot exceed 1MB';

	$file_name_appended = "user_profile_pic/" . $username . "_" . $file_name;
	
	if(empty($errors)){		// no errors, query for previous profile pic name, delete, then upload new one 
		$result = mysqli_query($con, "SELECT user_pic FROM users WHERE user_name ='$username'");
		$row = mysqli_fetch_assoc($result);
		if (!empty($row["user_pic"])){ // if not using default pfp, delete current pfp from folder
			$old_pfp_name =  "user_profile_pic/" . $username . "_" . $row["user_pic"];
			@unlink($old_pfp_name);
		}
		mysqli_query($con, "UPDATE users SET user_pic ='$file_name' WHERE user_name ='$username'");
		move_uploaded_file($file_tmp, $file_name_appended);
		echo "<meta http-equiv='refresh' content='0'>"; //refresh page
	}
}	
if(isset($_FILES['image'])){	//db query for image uploading
	$errors= array();
	$file_name = $_FILES['image']['name'];
	$file_size =$_FILES['image']['size'];
	$file_tmp =$_FILES['image']['tmp_name'];
	$file_type=$_FILES['image']['type'];
	$file_ext = explode('.',$_FILES['image']['name']);
	$file_ext=strtolower(end($file_ext));
	
	$extensions= array("jpeg","jpg");

	if(!in_array($file_ext,$extensions))
		$errors[]="Please upload only JPG files.";
	
	if($file_size > 10*MB)
		$errors[]='File size cannot exceed 10MB';

	$file_name_appended = "user_images/" . $username . "_" . $file_name;
	if (@getimagesize($file_name_appended)) //check if image already exists
		$errors[]='Image already exists with that name.';	
	
	if(empty($errors)){		// no errors, store image data in db and upload image to image folder
		$query = "INSERT INTO images(user_name,uploaded,file_name) VALUES ('$username',now(),'$file_name')";
		if (mysqli_query($con, $query)) {
		move_uploaded_file($file_tmp, $file_name_appended);
		} 
		else {
		echo "Error uploading: " . mysqli_error($con);
		}
	}
}
if(isset($_GET['del']) && $_GET['del']){		//db query for deleting images
	$file_to_delete = $_GET['del'];
	$file_name_appended = "user_images/" . $username . "_" . $file_to_delete;
	$query = "DELETE FROM images WHERE user_name = '$username' AND file_name = '$file_to_delete'";
	if (mysqli_query($con, $query)) {
		unlink($file_name_appended);
		header("Location: /user_profile.php");; //refresh page
	} 
	else {
		echo "Error deleting record: " . mysqli_error($con);
	}
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_submit'])){ 		//db query to update profile bio
	$profile_text = mysqli_real_escape_string($con,$_POST['profile']);
	$query = "UPDATE users SET user_bio = '$profile_text' WHERE user_name = '$username'";
	mysqli_query($con,$query) or die (mysqli_error());
	echo "<meta http-equiv='refresh' content='0'>"; //refresh page
}
?>

<!DOCTYPE html>
<title>Your Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<link rel="stylesheet" href="styles.css">
	<script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#img-upload').change(function(e){ //displays uploaded file names before submission
				var files = e.target.files;
				var msg = "";
				for(var i=0; i<files.length; i++){
					msg += files[i].name+'<br>';
				}
				$('#upload_msg').html(msg);
			});

			$(".gallery-item").on("click",".btn", function(){
				if(confirm("Are you sure you want to delete "+$(this).attr("value")+"?")){
        			window.location = "user_profile.php?del="+$(this).attr("value");
    			}
    			else{
        			return false;
    			}
			});
		});
		 // Script to open and close sidebar
			function navbar_open() {
				$("#mySidebar").css("display","block");
			}
			function navbar_close() {
				$("#mySidebar").css("display","none");
			}
		// Script to open and close profile bio edit
			function openForm() {
			document.getElementById("profileForm").style.display = "block";
			}
			function closeForm() {
			document.getElementById("profileForm").style.display = "none";
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
		<a onclick="navbar_close()" class="bar-item buttons" href="photo_competition.php"><h3>Photo Competition</h3></a><br>
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
			<!-- Profile image -->
			<div class="profile-image">
				<img src=<?php echo $pfp_name;?>>
				<form id ="pfp-upload" method="POST" enctype="multipart/form-data">
         			<input type="file" name="pfp"/>
      			</form>
				<button class="profile-btn" type="submit" form="pfp-upload">Update!</button>
			</div>

			<!-- Profile buttons -->
			<div class="profile-user-settings">
				<h2 class="profile-user-name"><?php echo $username; ?></h2>
				<button class="profile-btn"  onclick="openForm()">Edit Bio</button>
				<a href="user_logout.php"><button class="profile-btn">Log Out</button></a>

				<!-- Invisible profile bio edit textbox -->
				<div class="profile-form" id="profileForm">
					<form class="padding-16" method="post">
						<textarea name="profile" rows="4" cols="40"required><?php echo $user_bio; ?></textarea><br>
						<button type="submit" name="profile_submit" class="btn">Submit</button>
						<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
					</form>
				</div>
			</div>
			
			<!-- Profile bio -->
			<div class="profile-bio">
				<p><?php echo $user_bio; ?></p>
			</div>

		</div>
		<!-- Image upload area -->
		<div>
			<form id="img-upload" class="img-upload" method="POST" enctype="multipart/form-data">
         		<input type="file" name="image" multiple/>
         		<p id="upload_msg">Drag images or click here to start uploading!</p>
      		</form>
      		<button class="img-upload" type="submit" form="img-upload">Submit</button>
			<div class="error float-center"><?php if(!empty($errors)){foreach($errors as $errormsg){echo "<br>". $errormsg . "<br>";}}?></div>
		</div>

		<div>
			<br>
			<h3 class="float-center">Your Uploaded Images</h3>
			<br>
		</div>
		<!-- Image gallery -->
		<div class="gallery">
			<?php
				$query = "SELECT * FROM images WHERE user_name='".$username."' ORDER BY uploaded DESC";
				$results = mysqli_query($con,$query);

				if ($results->num_rows >0){
					while($row = $results->fetch_assoc()){
						$image = 'user_images/'.$username.'_'.$row["file_name"];
						echo "<div class='gallery-item'>
								<img class='gallery-image' src='$image' loading='lazy'>
								<div class='overlay'><button class='btn' value=".$row['file_name']."> Delete? </button></div>
							 </div>";
					}
				}
				else{
					echo "<p>No images uploaded yet!</p>";
				}
      		?>
		</div>

	</div>

</body>
</html>