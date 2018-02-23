<?php

include 'dbconn.php';
global $conn;
$id=$_POST['vl'];
$sql = "UPDATE `Orders` SET status='accepted' WHERE orderID='$id'";
$conn->query($sql);
