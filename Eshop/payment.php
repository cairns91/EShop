<?php
    session_start();
    include 'dbconn.php';
    global $conn;
    $id=$_SESSION['basketID'];
    $sql = "UPDATE `Orders` SET status='paid' WHERE orderID='$id'";
    $conn->query($sql);
    
    unset($_SESSION['basketID']);
    
    header("location:index.php");
?>


