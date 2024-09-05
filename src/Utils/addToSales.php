<?php

session_start();
$id = $_SESSION['id'];
$isbn = $_POST['isbn'];
$totalPrice = (int) $_POST['price'];
$title = $_POST['title'];


include './dbconnect.php';

$exists = false;

$checksql = "SELECT * FROM `sales` WHERE `userId`='$id' AND `isbn`='$isbn'";

$result = mysqli_query($conn, $checksql);
$numExistRows = mysqli_num_rows($result);
if ($numExistRows > 0) {
    $exists = true;
}

if ($exists == false) {
    $sql = "INSERT INTO `sales` (`userId`,`isbn`,`title`,`price`) VALUES ('$id', '$isbn', '$title', '$totalPrice')";
    mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        $removeSql = "Delete FROM `cart` WHERE `ISBN`='$isbn' AND `userId`='$id'";
        mysqli_query($conn, $removeSql);
    }
    header("Location: ../Pages/userProfile.php", true);

}
?>

