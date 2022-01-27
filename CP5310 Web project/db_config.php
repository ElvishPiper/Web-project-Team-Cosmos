<?php
define('DB_HOST', "ec2-54-208-139-247.compute-1.amazonaws.com");
define('DB_USERNAME', "efegskwqhbbixq");
define('DB_PASSWORD', "26b378989f0ca5939d616ea0a57ea3895f2538a16ca3bd12fa7263bab9b5cf1c");
define('DB_NAME', 'dcer3mi5l06jg5');

$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (!$con) {
  die("Connection failed: ".mysqli_connect_error());
}
?>
