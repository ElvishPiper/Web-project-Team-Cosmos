<?php
   define('MB', 1048576);

   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext = explode('.',$_FILES['image']['name']);
      $file_ext=strtolower(end($file_ext));
      
      $extensions= array("jpeg","jpg");
      
      if(!in_array($file_ext,$extensions)){
         $errors[]="Please upload only JPG files.";
      }
      
      if($file_size > 20*MB){
         $errors[]='File size cannot exceed 20MB';
      }
      
      if(empty($errors)){
         move_uploaded_file($file_tmp,"images/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <head>
    <link rel="stylesheet" href="styles.css">
   </head>

   <body>
      <form id="img-upload" class="img-upload" action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" multiple/>
         <p>Drag images or click here </p>
      </form>
      <button class="img-upload" type="submit" form="img-upload"/>Submit</button>
   </body>
</html>