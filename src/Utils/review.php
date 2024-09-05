<?php

session_start();

$id = $_SESSION['id'];
$isbn = $_POST['isbn'];
$review = $_POST['review'];

include './dbconnect.php';

$exists = false;

$checksql = "SELECT * FROM `review` WHERE `id`='$id' AND `isbn`='$isbn'";

$checkResult = mysqli_query($conn, $checksql);
$numExistRows = mysqli_num_rows($checkResult);
if ($numExistRows > 0) {
    $exists = true;
}

if ($exists == false) {
    $sql = "INSERT INTO `review` (`review`,`id`,`isbn`) 
    VALUES ('$review','$id','$isbn')";
} 
else {
    $sql = "UPDATE `review` 
        SET `review` = '$review' 
        WHERE `id` = '$id' AND `isbn` = '$isbn'";
}

mysqli_query($conn, $sql);
