<?php

$isbn = $_GET['isbn'];

include 'dbconnect.php';
include '../Pages/sidebar.php';

$sql = "SELECT * FROM `books` WHERE `isbn`='$isbn'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $author = $row['author'];
        $price = $row['price'];
        $publisher = $row['publisher'];
        $publishdate = $row['publishdate'];
        $category = $row['category'];
        $image = $row['image'];
        $summary = $row['summary'];
        $path = $row['path'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/upload.css">
</head>

<body>
    <main id="main" class="main">
        <div class="formContainer">


            <form class="forms" action="updateBooks.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" name="isbn" id="isbn" value="<?php echo $isbn ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" value="<?php echo $title ?>" required>

                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" value="<?php echo $author ?>" required>

                </div>

                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" name="publisher" id="publisher" value="<?php echo $publisher ?>" required>

                </div>

                <div class="form-group">
                    <label for="date">Published Date:</label>
                    <input type="date" name="date" id="date" value="<?php echo $publishdate ?>" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" id="price" value="<?php echo $price ?>" required>

                </div>

                <div class="form-group">
                    <label for="category">Category: </label>
                    <input type="text" name="category" id="category" value="<?php echo $category ?>" required>

                </div>
                <div class="form-group">
                    <label for="path">Book Path:</label>
                    <input type="text" name="path" id="path" value="<?php echo $path ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Image Path: </label>
                    <input type="text" name="image" id="image" value="<?php echo $image ?>" required>

                </div>
                <div class="form-group">
                    <label for="summary">Summary: </label>
                    <textarea name="summary" id="summary" required>
                        <?php echo $summary ?>
                    </textarea>

                </div>

                <div class="form-group">
                    <input type="submit" value="Update Book">
                </div>
            </form>
        </div>
    </main>
</body>

</html>