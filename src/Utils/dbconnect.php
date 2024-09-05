<?php

$servername = "localhost";
$username = "root";
$password = "database123";
$database = "bookhub";
$conn;

try {
    $conn = mysqli_connect($servername, $username, $password, $database);
} catch (Exception  $e) {
    echo "Error: " . $e->getMessage();
}

?>
