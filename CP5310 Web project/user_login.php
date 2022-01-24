<?php
session_start();

include 'db_config.php';

if (isset($_SESSION['username'])){
    header("Location: /user_profile.php");
    exit();
}

$loginError = "";
$registerError ="";

if(isset($_POST['login_submit'])){

    $username = mysqli_real_escape_string($con,$_POST['login_username']);
    $password = mysqli_real_escape_string($con,$_POST['login_password']);

    if (!empty($username) && !empty($password)){
        $query = "SELECT count(*) AS user_count FROM USERS WHERE user_name='".$username."' AND user_password='".$password."'";
        $row = mysqli_fetch_array(mysqli_query($con,$query));
        $count = $row['user_count'];

        if($count == 1){
            $_SESSION['username'] = $username;
            header("Location: /user_profile.php");
            exit();
        }else{
            $loginError = "Invalid Login.";
        }
    }
    else{
        $loginError = "Fields are incorrect!";
    }
}

if(isset($_POST['register_submit'])){
    $username = mysqli_real_escape_string($con,$_POST['reg_username']);
    $password = mysqli_real_escape_string($con,$_POST['reg_password']);
    $email = mysqli_real_escape_string($con,$_POST['reg_email']);
    $query = "SELECT * FROM USERS WHERE user_name='$username'";
    if (mysqli_num_rows(mysqli_query($con,$query)) > 0){
        $registerError = "Username already exists";
    }
    else{
        $query = "INSERT INTO USERS(user_name,user_email,user_password) VALUES ('$username','$email','$password')";
        mysqli_query($con,$query) or die (mysqli_error());
        $_SESSION['username'] = $username;
        header("Location: /user_profile.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<title>User Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<link rel="stylesheet" href="styles.css">
    <script type="application/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){

                $("#sign_up_form").submit(function(e) {     
                
                    var check = true; 
                    var name =  $("#reg_username").val();
                    var email = $("#reg_email").val();
                    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                    var password = $("#reg_password").val();
                    var rePassword = $("#reg_rePassword").val();
                    var nameCheck = /^[a-zA-Z0-9]+([_\s\-]?[a-zA-Z0-9])*$/.test(name);

                    //name check
                    if (!nameCheck){
                        $("#name_msg").text("Invalid name");
                        check = false;
                    }
                    else
                        $("#name_msg").text("");
                    
                    //email check
                    if (!regex.test(email)){
                        $("#email_msg").text("Invalid email");
                        check = false; 
                    }
                    else 
                        $("#email_msg").text("");

                    //password confirmation check
                    if (rePassword !== password){
                        $("#password_msg").text("Passwords do not match. Please try again.");
                        check = false; 
                    }
                    else 
                        $("#rePassword_msg").text("");

                    if (!check)
                        e.preventDefault();
                });
            });
            
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
        <a onclick="navbar_close()" class="bar-item buttons" href="about_us.php"><h3>About Us</h3></a>
		</div>
    <!-- Top menu -->
		<div class="topnavbar">
		<div class="buttons padding-16 float-left" onclick="navbar_open()">☰</div>
		<div class="float-center padding-16"><h1 class="title">Wonderwall</h1></div>
		</div>
  	</nav>


    <div class="login-box">

        <form id="sign_up_form" method="post" class="left">
            <h2 class="float-center">Register</h2>
            
            <input type="text" id="reg_username" name="reg_username" placeholder="Username" required/>
            <div class="error" id="name_msg"></div>
            <input type="text" id="reg_email" name="reg_email" placeholder="E-mail" required/>
            <div class="error" id="email_msg"></div>
            <input type="password" id="reg_password" name="reg_password" placeholder="Password" required/>
            <div class="error" id="password_msg"></div>
            <input type="password" id="reg_rePassword" name="reg_rePassword" placeholder="Confirm Password" required/>

            <div class="error"><?php echo $registerError;?></div>
            <input type="submit" name="register_submit" value="Register" />
        </form>
    
        <h3 class="or">OR</h3>
    
        <form method="post" class="right">
            <h2 class="float-center">Log In</h2>
            <input type="text" name="login_username" placeholder="Username" />
            <input type="password" name="login_password" placeholder="Password" />
            <div class="error"><?php echo $loginError;?></div>

            <input type="submit" name="login_submit" value="Log In" />
        </form>
    </div>

</body>
</html>