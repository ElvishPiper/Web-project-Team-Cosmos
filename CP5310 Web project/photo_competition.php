<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['username'])){		// if user accesses this page without logging in, direct to login page
    header("Location: /user_login.php");
    exit();
}

?>

<!DOCTYPE html>
<title>Photography Competition</title>    
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
      // input validation
      function checkName(document){
          const name = document.getElementById("name")
          let name_msg = document.getElementById('name_msg')
          const isText = /^[a-zA-Z0-9]+([_\s\-]?[a-zA-Z0-9])*$/.test(name.value)
          if (name.value === "") {
              name_msg.innerHTML = "Please enter your name.";
              return false
          }
          if (!isText){
              name_msg.innerHTML = "Enter a valid name."
              name.focus();
              return false;
          }
          else
              name_msg.innerHTML = ""
          return true;
      }

      function checkEmail(document) {
          const email = document.getElementById("email")
          let email_msg = document.getElementById('email_msg')
          const isEmail = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(email.value)
          if (email.value === "") {
              email_msg.innerHTML = "Please enter your email.";
              return false
          }
          if (!isEmail){
              email_msg.innerHTML = "Enter a valid email."
              email.focus();
              return false;
          }
          else
            email_msg.innerHTML = ""
          return true;
      }

      function checkTick(document) {
          const tick = document.getElementById("tick")
          let tick_msg = document.getElementById('tick_msg')
          if (tick.checked) {
                tick_msg.innerHTML = ""
                return true;
              }
          else {
                tick_msg.innerHTML = "Please agree to the checkbox."
                tick.focus();
                return false;
              }
      }

      function checkUpload(document) {
          const upload = document.getElementById('upload')
          const upload_msg = document.getElementById('upload_msg')
          if (upload.value !== ""){
              upload_msg.innerHTML = ""
              upload.focus();
              return true
          }
          else {
              upload_msg.innerHTML = "Please upload an image."
              upload.focus();
              return false;
          }
      }

      function validateInfo(document) {
          if ( checkName(document) && checkEmail(document) && checkUpload(document) && checkTick(document) )
          {
            var div = document.getElementById('signup');
            var signup_msg = document.getElementById('signup_msg');
            while(div.firstChild) {
                div.removeChild(div.firstChild);
            }
            signup_msg.innerHTML = "Thank you for your submission! All winners will be informed via email.";
            return true;
          }
            return false;
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

    <div class="flex-container">
        <div>
            <img src="images/competition.jpg">
        </div>

        <div>
          <h2 class="float-center">Competition Details:</h2>
          <ul>
              <li>Free to enter and open to registered users.</li>
              <li>Only one entry per person. In case of multiple submissions, only the latest will be considered.</li>
              <li>Five diverse categories to enter:
                  <ol>
                      <li>Nature</li>
                      <li>Food</li>
                      <li>Travel</li>
                      <li>Fashion</li>
                      <li>Contemporary</li>
                  </ol>
              </li>
              <li>Cash prizes for three winners in each category.</li>
              <li>One overall winner receives the Wonderwall Photographer of the Year title, and will be featured on the website.</li>
              <li>Terms and conditions apply.</li>
              <li>Deadline: June 7, 2022 at 2200 GMT+8</li>
          </ul>
        </div>

        <h2 class = "pink" id="signup_msg"></h2>

        <div id="signup">
          <h2 class="float-center">Competition Signup:</h2>
          <p><i>Fields marked with an asterisk (*) must be entered.</i></p>

          <table>
            <tr>
                <td>Username:</td>
                <td><?php echo $_SESSION['username']?></td>
            </tr>
            <tr>
                <td>* Name:</td>
                <td><label for="name">
                      <input type="text" id="name" name="name" placeholder="Full name" onChange="checkName(document)">
                    </label></td>
                <td id="name_msg" class="error"></td>
            </tr>
            <tr>
                <td>* Email:</td>
                <td><label for="email">
                      <input type="text" id="email" name="email" placeholder="Email" onChange="checkEmail(document)">
                    </label></td>
                <td id="email_msg" class="error"></td>
            </tr>
            <tr>
                <td><label for="cat">* Category:&nbsp;</label></td>
                <td>
                  <select name="cat" id="cat">
                    <option value="nature">Nature</option>
                    <option value="food">Food</option>
                    <option value="travel">Travel</option>
                    <option value="fashion">Fashion</option>
                    <option value="contemporary">Contemporary</option>
                  </select>
                </td>
                <td id="cat_msg" class="error"></td>
            </tr>
          </table> 
          <table>
            <tr>
                <td> * Upload image: <i style="font-size: 10px">(jpg, png, jpeg)</i></td>
                <td><input type="file" id="upload" name="upload" accept="image/png, image/jpeg, image/jpg"></td>
            </tr>
            <tr>
                <td id="upload_msg" class="error"></td>
            </tr>
          </table>

          <p><input type="checkbox" id="tick" name="tick" value="yes" onChange="checkTick(document)">
          * I agree to follow ethics of the competition and terms and conditions.</p><br>
          <p id="tick_msg" class="error"></p>
                
          <input type="submit" name="submit" value="Submit" onClick="return validateInfo(document)">

        </div>
    </div>


  <!-- Footer -->
  <footer style="position: static; margin-top: 9em">
        <div>
            <h1>Wonderwall</h1>
        </div>
        <div>
            <h3>Contact Us</h3>
            <p>Questions? Concerns? Feedback? Do email us at contact@wonderwall.com</p>
        </div>
        <div>
            <h3>About</h3>
            <p>Wonderwall is a unique and attribution-free photo sharing service for professional developers and
            amateur hobbyists alike. </p>
        </div>
        <div>
            <p>By submitting to this website, you are agreeing that your work will be licensed under a 
            <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US">Creative Commons Attribution 3.0 Unported License.</a></p>
        </div>
  </footer>

</body>
</html>