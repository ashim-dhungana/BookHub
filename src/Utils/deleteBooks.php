<?php

if (isset($_POST['isbn']) && !empty($_POST['isbn'])) {
  $isbn = $_POST['isbn'];
}

include 'dbconnect.php';

$sql = "DELETE FROM `books` WHERE `isbn`='$isbn'";
mysqli_query($conn, $sql);


?>