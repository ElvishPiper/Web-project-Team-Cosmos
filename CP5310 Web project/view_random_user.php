<?php
session_start();
include 'db_config.php';

$query = "SELECT user_name FROM users ORDER BY RAND() LIMIT 1";
$result = mysqli_query($con,$query);

if ($result->num_rows == 1){
    $row = $result -> fetch_assoc();
    header("Location: /view_user_profile.php?user=".$row["user_name"]);
}
else{
    header("Location: /index.php");   
}
?>