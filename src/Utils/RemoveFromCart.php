<?php
session_start();

$isbn = $_POST['isbn'];
$id = $_SESSION['id'];


include 'dbconnect.php';

$exists = false;


$checksql = "Delete FROM `cart` WHERE `ISBN`='$isbn' AND `userId`='$id'";

$result = mysqli_query($conn, $checksql);
$numExistRows = mysqli_num_rows($result);
if ($numExistRows > 0) {
    $exists = true;
}
