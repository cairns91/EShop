<?php
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}

if ($uploadOk !== 0) {

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}

include 'dbconn.php';
global $conn;


$title=isset($_POST["title"])? $conn-> real_escape_string($_POST["title"]) : "" ;
$description=isset($_POST["description"])? $conn-> real_escape_string($_POST["description"]) : "" ;
$price=isset($_POST["price"])? $conn-> real_escape_string($_POST["price"]) : "" ;
$type=$_POST['type'];
$sql = "INSERT INTO `Products` (`Title`, `Image`, `Description`, `Price`, `type`) "
        . "VALUES ('$price', '$target_file', '$title', '$price', '$type')";
$conn->query($sql);
header("location:index.php");
