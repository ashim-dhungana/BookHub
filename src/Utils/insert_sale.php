<?php

include 'dbconnect.php';

$isbn = $_POST['isbn'];

$sql = "INSERT INTO Sales (ISBN) VALUES ('$isbn')";
if ($conn->query($sql) === TRUE) {
    echo "ISBN inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
