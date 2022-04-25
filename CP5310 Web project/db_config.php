<?php
define('DB_HOST', "ec2-3-209-124-113.compute-1.amazonaws.com");
define('DB_USERNAME', "dgldefnrwibiix");
define('DB_PASSWORD', "9a4acdacad87b40cfcb793f3679f470f9cca806e37fd5be480611bdcefac84f0");
define('DB_NAME', 'dcnfjn1aes1tsi');
define('DB_PORT', '5432');


$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
if (!$con) {
  die("Connection failed: ".mysqli_connect_error());
}
?>
