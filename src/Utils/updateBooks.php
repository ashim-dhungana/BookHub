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

if ($numExistRows > 0) {

    $sql = "UPDATE `books` SET 
            `title` = '$title', 
            `author` = '$author',
            `publisher` = '$publisher',
            `publishdate` = '$published_date',
            `price` = '$price',
            `category` = '$category',
            `path` = '$book_path',
            `image` = '$image_path',
            `summary` = '$summary'
            WHERE `isbn`='$isbn'";

    mysqli_query($conn, $sql);

    echo "Book Successfully Updated";
} else {
    echo "Book doesn't exists";
}



// header("Location: ../Pages/upload.php");
