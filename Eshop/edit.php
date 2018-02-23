<?php

    include 'dbconn.php';
    global $conn;
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    if(isset($_POST['image'])){
        $image=$_POST['image'];
        $sql="UPDATE `Products` SET Title='$title', Description='$description', Price='$price', Image='$image' "
            . "WHERE id='$id'";
    } else {
        $sql="UPDATE `Products` SET Title='$title', Description='$description', Price='$price' "
            . "WHERE id='$id'";
    }
    
    $conn->query($sql);
    header("location:product.php?id=".$id);
?>