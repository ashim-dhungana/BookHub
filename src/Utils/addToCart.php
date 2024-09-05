<?php
session_start();
$id = $_SESSION['id'];

$isbn = $_POST['isbn'];

include 'dbconnect.php';

$exists = false;


$checksql = "SELECT * FROM `cart` WHERE `userId`='$id' AND `ISBN`='$isbn'";

$checkresult = mysqli_query($conn, $checksql);
$numExistRows = mysqli_num_rows($checkresult);

if ($numExistRows>0) {
    $exists=true;
}

if ($exists==false){
    $sql = "INSERT INTO `cart` (`userId`,`ISBN`) VALUES ('$id','$isbn')";
    mysqli_query($conn, $sql);
}
