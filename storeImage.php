<?php
    include("./includes/connect.inc.php");

    $img = $_POST['image'];
    $folderPath = "uploads/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
    
    // header("location:http://localhost:3000")  
    
    $user_id=$_GET['profile_id'];

    mysql_query("UPDATE users SET ver_pic='$fileName',ver_status='waiting' WHERE id='$user_id'");
    header("location:waiting.php");


?>