<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../Pages/admin.php");
    exit;
}

include 'sidebar.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/upload.css">
    <title>Upload Books</title>
</head>

<body>
    <main id="main" class="main">
        <div class="formContainer">

            <form class="forms" action="../Utils/insertBooks.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="isbn">ISBN:</label><input type="text" name="isbn" id="isbn" required>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label><input type="text" name="title" id="title" required>

                </div>

                <div class="form-group">
                    <label for="author">Author:</label> <input type="text" name="author" id="author" required>

                </div>

                <div class="form-group">
                    <label for="publisher">Publisher:</label><input type="text" name="publisher" id="publisher"
                        required>

                </div>

                <div class="form-group">
                    <label for="date">Published Date:</label><input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label><input type="number" name="price" id="price" required>

                </div>

                <div class="form-group">
                    <label for="category">Category: </label> <input type="text" name="category" id="category" required>

                </div>
                <div class="form-group">
                    <label for="path">Book Path:</label>
                    <input type="text" name="path" id="path" required>
                </div>
                <div class="form-group">
                    <label for="image">Image Path: </label>
                    <input type="text" name="image" id="image" required>

                </div>
                <div class="form-group">
                    <label for="summary">Summary: </label><textarea name="summary" id="summary" required></textarea>

                </div>

                <div class="form-group">
                    <input type="submit" value="Upload Book">
                </div>
            </form>
        </div>
    </main>

    <script src="../../js/toast.js"></script>

</body>

</html>
