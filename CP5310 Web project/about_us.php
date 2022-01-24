<?php
session_start();
include 'db_config.php';
?>


<!DOCTYPE html>
<title>About Wonderwall</title>
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

<body>
    <nav>
        <!-- Sidebar (hidden by default) -->
        <div class="bar-block animate-left" id="mySidebar">
            <a onclick="navbar_close()" class="bar-item buttons">☰</a><br>
            <a onclick="navbar_close()" class="bar-item buttons" href="index.php"><h3>Home</h3></a><br>
            <a onclick="navbar_close()" class="bar-item buttons" href="user_login.php">
                <h3><?php if(isset($_SESSION['username'])) echo "Your Profile"; else echo"Login";?></h3></a><br>
            <a onclick="navbar_close()" class="bar-item buttons" href="view_random_user.php">
                <h3>View Random User</h3>
            </a><br>
        </div>
        <!-- Top menu -->
        <div class="topnavbar">
            <div class="buttons padding-16 float-left" onclick="navbar_open()">☰</div>
            <div class="float-center padding-16">
                <h1 class="title">Wonderwall</h1>
            </div>
        </div>
    </nav>

    <div class="flex-container">
        <div class="top-item">
            <h2 class="float-center">What is Wonderwall</h2>
            <p>Wonderwall is a unique photo sharing service that aims to mix-up the scene by combining social media with stock photo
            sharing websites. All photos and images uploaded on our site are available for personal and commercial uses, without the 
            need for attribution.</p>
            <p>With Wonderwall, we'd like to take the cold, transactional nature of photo sharing websites and shift the fun and 
                focus of photo-taking back onto the artistic process, while allowing users to network with others who share the same mindset.</p>
        </div>        
        <h2 class="float-center">Meet The Team</h2>

        <div class="middle-item profile-image">
            <div style="background:#C1DEE9;">
                <img src="images/siddhanth.jpg"/>
                <h3 style="color:#90728E;">Siddhanth Biswas</h3>
                <p><b>Marketing & Analytics</b></p>
                <p>Siddhanth is well versed in the knowledge of the various artistic genres of photography. 
                His expertise lies within the marketing and analytics sector of the photography used for designing and advertising by top companies.</p>
            </div>
            <div style="background:#A7BBD2;">
                <img src="images/shaheryar.jpg"/>
                <h3 style="color:#82505F;">Shaheryar Mirza</h3>
                <p><b>Designer & Tester</b></p>
                <p>Shaheryar believes that the road to success is not just through hard work, but through patience as well. You will find him either 
                    playing video games or spending time with his family and friends outside work hours.</p>
            </div>
            <div style="background:#9996B5;">
                <img src="images/darrell.jpg"/>
                <h3 style="color: #C1DEE9;">Darrell Ng</h3>
                <p><b>Programmer</b></p>
                <p>Darrell is well-versed in digital photography, having done a gallery exhibition of a photography series titled 'Road to Obscurity' 
                    of the night-time streets of Tokyo, Japan. Nowadays, he spends most of his time playing games and making them, too. 
                </p>
            </div>
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



    </div>

</body>
</html>