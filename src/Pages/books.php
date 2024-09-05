<?php

session_start();

if ($_SESSION['loggedin'] !== true) {
    header("Location: welcome.php?loggedin=false");
    exit;
}

$userId = $_SESSION['id'];

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
} else {
    echo "ISBN not provided";
}

include '../Utils/dbconnect.php';
// print_r($isbn);

$sql = "SELECT * FROM `books` WHERE `isbn` = '$isbn'";
$result = mysqli_query($conn, $sql);
// print_r($result);

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome -
        <?php echo $_SESSION['fullName'] ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../../web-fonts-with-css/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="./swiper-bundle.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" href="../../css/cart.css">
    <link rel="stylesheet" href="../../css/books.css">
    <link rel="stylesheet" href="../../css/toast.css">
    <link rel="stylesheet" href="../../css/review.css">
</head>


<body>
    <div id="toast-container"></div>


    <?php
    include('header.php');
    ?>

    <header class="header">
        <div class="header-2">
            <nav class="navbar1">
                <span>Book Details</span>
            </nav>
        </div>
    </header>



    <div class="bookcontainer">

        <?php
        session_start();

        if ($result) {
            $book = mysqli_fetch_assoc($result);
            $book_isbn = $book['isbn'];
            $book_title = $book['title'];
            $book_author = $book['author'];
            $book_price = $book['price'];
            $book_date = $book['publishdate'];
            $book_publisher = $book['publisher'];
            $book_image = $book['image'];
            // print_r($book);

            $book_details = array(
                'isbn' => $book_isbn,
                'title' => $book_title,
                'author' => $book_author,
                'publisher' => $book_publisher,
                'date' => $book_date,
                'price' => $book_price,
                'image' => $book_image,
            );

        ?>


            <div class="displaycontainer">
                <div class="book-container">
                    <div class="book-image-container">
                        <div class="ImageBackground"></div>
                        <img class="card-img-top" src="<?php echo $book_image ?>" alt="...">
                    </div>
                    <div class="bookline"></div>

                    <div class="summary-container">

                        <div class="book-details">
                            <p class="heading1">
                                <?php echo $book_title ?>
                            </p>
                            <p class="summary-text" id="summary-text">
                                <?php echo $book['summary'] ?>
                            </p>

                        </div>
                    </div>


                    <div class="bookline"></div>
                    <div class="bookinformation">
                    <img height="200px" width="200px" src="https://robohash.org/<?php echo $book_publisher; ?>.png?size=500x500" alt="Avatar">
                        <p>
                            <strong>Author:</strong>
                            <?php echo $book_author ?>
                        </p>
                        <p>
                            <strong>Publisher:</strong>
                            <?php echo $book_publisher ?>
                        </p>
                        <p>
                            <strong>Price:</strong> Rs.
                            <?php echo $book_price ?>
                        </p>

                        <?php
                        $checksql = "SELECT * FROM `sales` WHERE `userId`='$userId' AND `isbn`='$book_isbn'";
                        $checkresult = mysqli_query($conn, $checksql);
                        $numExistRows = mysqli_num_rows($checkresult);
                        if ($numExistRows > 0) {
                        ?>
                            <a href="userprofile.php">
                                <button type="button" class="add-to-cart">
                                    Already Bought
                                </button>
                            </a>
                        <?php
                        } else {
                        ?>
                            <button type="button" class="add-to-cart" onclick="addToCart(<?php echo $book_isbn; ?>)">
                            <div id="cart-btn" class="fa fa-shopping-cart" style="color:white; font-size:15px"></div> Add to Cart
                            </button>
                        <?php
                        }
                        ?>

                        <a href="welcome.php">
                            <button class="continueshopping" style="background-color:green" type="button">
                                Continue Shopping
                            </button>
                        </a>
                    </div>
                </div>
            </div>


        <?php
        } else {
            echo "Error retrieving book information.";
        }

        ?>


    </div>
    <div aria-live="polite" aria-atomic="true" style="position: relative;">
        <!-- Position it -->
        <div style="position: absolute; top: 0; right: 0;">

            <!-- Then put toasts within -->
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    See? Just like this.
                </div>
            </div>

            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">2 seconds ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Heads up, toasts will stack automatically
                </div>
            </div>
        </div>
    </div>



    <!-- REVIEW STARTS -->

    <h1 class="heading"><span>Client's reviews</span></h1>
    <div class="review">
        <ul>
            <?php

            include '../Utils/dbconnect.php';

            $reviewsql = "SELECT review.*, user.fullName FROM review 
                INNER JOIN user ON review.id = user.id WHERE review.isbn='$book_isbn'";

            $reviewResult = mysqli_query($conn, $reviewsql);


            if (mysqli_num_rows($reviewResult) > 0) {
                while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
                    $user = $reviewRow['fullName'];
                    $review = $reviewRow['review'];
            ?>
            <div>
            <img src="https://robohash.org/<?php echo $user; ?>.png?size=50x50" alt="Avatar">

<div class="review-item" style="list-style-type: none;">
    <span class="username">
  
        <!-- Example usage of Robohash with specified size -->



        <?php
        echo "" . $user;         ?> :
    </span>
    <span class="review-content">
        <?php
        echo $review;
        ?>
    </span>
</div>

            </div>
           

            <?php
                }
            }
            ?>
        </ul>

        <div class="writeReview">

            <label for="userInput">
                Write review
            </label>
            <br>
            <div class="submit">
            <textarea id="userInput" name="userInput" rows="1" cols="50" maxlength="1000" style="flex:90%;">
            </textarea>
            <button onclick="addReview(<?php echo $book_isbn; ?>)" style="flex:10%;">
                Review
            </button>
            </div>

            

        </div>


    </div>


    <!-- REVIEW ENDS -->


    <!-- CART STARTS -->

    <div class="cart-container form-container">
        <div id="close-cart-btn">&#10060;</div>

        <div class="cartData">
            <div class="cart-containers">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>

                            <th>ISBN</th>
                            <th class="titles">Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th class="actions">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        include '../Utils/dbconnect.php';

                        $fetchcart = "SELECT * FROM `cart` WHERE `userId`='$userId'";

                        $fetchcart = "SELECT cart.*, books.* FROM cart INNER JOIN books ON cart.ISBN = books.isbn WHERE cart.userId = '$userId'";


                        $cartResult = mysqli_query($conn, $fetchcart);

                        while ($row = mysqli_fetch_assoc($cartResult)) {
                            $cartISBN = $row['ISBN'];
                            $cartTitle = $row['title'];
                            $cartAuthor = $row['author'];
                            $cartPrice = $row['price'];
                            $cartImage = $row['image'];

                        ?>
                            <tr>
                                <td><img class="imageImage" src="<?php echo $cartImage; ?>" alt="Book Image"></td>
                                <td>
                                    <?php echo $cartISBN; ?>
                                </td>
                                <td>
                                    <?php echo $cartTitle; ?>
                                </td>
                                <td>1</td>
                                <td>NRPs.
                                    <?php echo $cartPrice; ?>
                                </td>
                                <td>
                                    <button class="actionbar" style="background-color:green" type="button" class="add-to-sales" onclick="addToSales(<?php echo $cartISBN; ?>,<?php echo $cartPrice; ?>, '<?php echo $cartTitle; ?>')">
                                        Checkout </button>

                                    <button class="actionbar" style="background-color:red" onclick="removeFromCart(<?php echo $cartISBN; ?>)">
                                        Remove
                                    </button>
                                </td>
                            </tr>

                        <?php
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CART ENDS -->




    <script>
        var bookDetails = <?php echo json_encode($book_details); ?>;
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>




    <script src="../../js/script.js"></script>
    <script src="../../js/cart.js"></script>
    <script src="../../js/books.js"></script>
    <script src="../../js/toast.js"></script>

</body>

</html>