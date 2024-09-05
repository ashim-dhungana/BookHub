<?php
session_start();
include 'dbconnect.php';

if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    
    $sql = "DELETE FROM `sales` WHERE isbn = '$isbn' AND userId = " . $_SESSION['id'];
    if (mysqli_query($conn, $sql)) {
        echo "Book deleted successfully";
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
} else {
    echo "ISBN parameter is missing";
}
?>
