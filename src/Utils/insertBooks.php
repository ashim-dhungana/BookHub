<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../Pages/admin.php");
    exit;
}

$isbn = $_POST['isbn'];
$title = $_POST['title'];
$author = $_POST['author'];
$publisher = $_POST['publisher'];
$published_date = $_POST['date'];
$price = $_POST['price'];
$category = $_POST['category'];
$book_path = $_POST['path'];
$image_path = $_POST['image'];
$summary = $_POST['summary'];


include 'dbconnect.php';

$checksql = "SELECT * FROM books WHERE isbn='$isbn'";
$checkResult = mysqli_query($conn, $checksql);

$numExistRows = mysqli_num_rows($checkResult);

if ($numExistRows == 0) {

    $sql = "INSERT INTO `books` (isbn, title, author, publisher, publishdate,      price, category, path, image, summary)
    VALUES ('$isbn', '$title', '$author', '$publisher', '$published_date', '$price', '$category', '$book_path', '$image_path', '$summary')";

    mysqli_query($conn,$sql);

    echo "Book Successfully Inserted";
}
else{
    echo "ISBN already exists";
}



// header("Location: ../Pages/upload.php");
