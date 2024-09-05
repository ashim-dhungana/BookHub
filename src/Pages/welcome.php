<?php

session_start();
if ($_SESSION['loggedin'] == true) {
  $userId = $_SESSION['id'];
}

$status = $_GET['loggedin'] ?? true;

?>

<button id="modalTriggerButton" style="display: none;" data-bs-toggle="modal" data-bs-target="#exampleModal"></button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>
          Don't judge a book by its cover... sign in and explore its pages!
          <!-- Ready to dive into a world of literary wonders? Sign in! -->
        </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="login-btn2" data-bs-dismiss="modal">Sign In</button>
      </div>
    </div>
  </div>
</div>

<script>
  if (!<?php echo $status ?>) {
    document.addEventListener('DOMContentLoaded', function() {
      var modalTriggerButton = document.getElementById('modalTriggerButton');
      modalTriggerButton.click();
    });
  }
</script>

<?php

$option = false;
$category = $_SESSION['category'] ?? '';


if (isset($_GET['category'])) {
  $category = $_GET['category'];
  $_SESSION['category'] = $category;
}

if (!empty($category)) {
  $option = true;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['title'])) {
    $book_title = $_POST['title'];
    $book_author = $_POST['author'];
    $book_publisher = $_POST['publisher'];
    $book_date = $_POST['date'];

    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $book_title;
    $_SESSION['cart'][] = $book_author;
    $_SESSION['cart'][] = $book_publisher;
    $_SESSION['cart'][] = $book_date;
  }
}

include('../Utils/dbconnect.php');
$sql = "select `category` from `books`";
$result = mysqli_query($conn, $sql);
$allCategories = mysqli_fetch_all($result);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome <?php echo $_SESSION['fullName'] ?>
  </title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../../web-fonts-with-css/css/fontawesome-all.min.css">
  <link rel="stylesheet" href="../../css/swiper-bundle.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.angularjswiki.com/fontawesome/fa-blog/">


  <link rel="stylesheet" href="../../css/cart.css">
  <link rel="stylesheet" href="../../css/utility.css">
  <link rel="stylesheet" href="../../css/style.css">


</head>

<body>

  <header class="header">
    <?php
    include('header.php')
    ?>
  </header>


  <!-- Login form starts -->
  <div class="form-container login-form-container">
    <div id="close-login-btn">&#10060;</div>
    <form action="/src/Utils/Login.php" method="post">
      <h3>Sign In</h3>
      <span>username</span>
      <input type="email" name="email" class="box" placeholder="enter your email" id="email">
      <span>password</span>
      <input type="password" name="password" class="box" placeholder="enter your password" id="loginpassword">
      <div class="checkbox">
        <input type="checkbox" name="" id="remember-me">
        <label for="remember-me">remember-me</label>
      </div>
      <input type="submit" value="sign in" class="btn">
      <p>don't have an account ?
        <a href="#signin-btn">create one</a>
      </p>
    </form>
  </div>
  <!-- Login form ends -->


  <!-- Sign-up form starts -->
  <div class="form-container signin-form-container">
    <div id="close-login-btn">&#10060;</div>
    <form action="/src/Utils/signup.php" method="post">
      <h3>Sign Up</h3>
      <span>Username</span>
      <input type="email" name="email" class="box" placeholder="Enter your email" id="email">
      <input type="text" name="fullName" class="box" placeholder="Enter your Full name" id="fullName">
      <span>Password</span>
      <input type="password" required name="password" class="box" placeholder="Enter your password" id="password">
      <input type="password" required name="cpassword" class="box" placeholder="Confirm your password" id="cpassword">
      <input type="submit" value="sign Up" class="btn">
      <p>
        <a href="#admin-signin-btn">Sign Up as Admin</a>
      </p>
    </form>
  </div>
  <!-- Sign-up form ends -->

  <!-- Sign-up form for admin starts -->
  <div class="form-container admin-signin-form-container">
    <div id="close-login-btn">&#10060;</div>
    <form action="/src/Utils/signup-admin.php" method="post">
      <h3>Sign Up</h3>

      <span>Username</span>
      <input type="email" name="email" class="box" placeholder="Enter your email" id="email">
      <input type="text" name="fullName" class="box" placeholder="Enter your Full name" id="fullName">

      <span>Admin code</span>
      <input type="text" name="code" class="box" placeholder="Secret code" id="code">

      <span>Password</span>
      <input type="password" required name="password" class="box" placeholder="Enter your password" id="adminpassword">
      <input type="password" required name="cpassword" class="box" placeholder="Confirm your password" id="admincpassword">

      <input type="submit" value="sign Up" class="btn">
    </form>
  </div>
  <!-- Sign-up form for admin ends -->


  <header class="header">
    <div class="header-2">
      <nav class="navbar1">
        <span>books</span>
      </nav>
    </div>
  </header>

  <!-- BODY STARTS -->

  <?php
  if (!count($allCategories)) {
  ?>
    <div style="display:flex; justify-content:center;">
      <img src=" https://jalarambookstore.com/img/nodata.png">'
    </div>
  <?php
  }
  ?>

  <div class="bigcontainer flexbox">


    <!-- SIDEBAR STARTS -->

    <?php
    if (count($allCategories) > 0) {
    ?>
      <div class="sidebar">

        <div class="sidebar-nav">

          <h2>Categories</h2>
          <hr>
          <a class="sidebar-item" href="/src/Pages/welcome.php?category=all">
            <div class="sidebar-title" title="Other">All book</div>
            <div class="sidebar-count">
              <?php echo count($allCategories) ?>
            </div>
          </a>

          <?php

          $uniqueCategories = array();

          for ($i = 0; $i < count($allCategories); $i++) {
            $catName = $allCategories[$i][0];

            if (!isset($uniqueCategories[$catName])) {
              $uniqueCategories[$catName] = 1;
            } else {
              $uniqueCategories[$catName]++;
            }
          }

          foreach ($uniqueCategories as $catName => $count) {
          ?>
            <a class="sidebar-item" href="/src/Pages/welcome.php?category=<?php echo urlencode($catName); ?>">
              <div class="sidebar-title" title="<?php echo $catName; ?>">
                <?php echo $catName; ?>
              </div>
              <div class="sidebar-count">
                <?php echo $count; ?>
              </div>
            </a>
          <?php
          }
          ?>



        </div>

      </div>

    <?php

    }

    ?>

    <!-- SIDEBAR ENDS -->



    <!-- BOOK DISPLAY START -->

    <div class="container" style="margin:auto">

      <?php

      include '../Utils/dbconnect.php';

      if ($option == true && $category != "all") {

        $sql = "SELECT * FROM `books` WHERE `category` = '$category'";

        if (isset($_GET['search'])) {
          $searchTerm = $_GET['search'];
          $sql = " SELECT * FROM `books` WHERE `category` = '$category' AND `title` LIKE '%$searchTerm%'";
        }

        if (isset($_GET['filter'])) {
          $filterOption = $_GET['filter'];

          if (!empty($filterOption)) {
            $sql = "SELECT * FROM `books` WHERE `category` = '$category' AND `$filterOption` LIKE '%$searchTerm%'";
          }
        }
      ?>

        <p class="text-center my-3" style="font-size:25px;">
          <strong>
            <?php echo $category ?> book
          </strong>
          <?php
          if (!empty($filterOption)) {

            echo '<strong> (Filtered By: ' . $filterOption . ' )</strong>';
          }
          ?>
        </p>


        <div class="row flexbox">

          <?php

          $result = mysqli_query($conn, $sql);

          if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {


              $title = $row['title'];
              $author = $row['author'];
              $publisher = $row['publisher'];
              $date = $row['publishdate'];
              $isbn = $row["isbn"];
              $image = $row["image"];

          ?>

              <div class="card my-2" onclick="redirectToBooks('<?php echo $isbn; ?>')">

                <img class="image" src="<?php echo $image; ?>" class="card-img-top" alt="...">

                <div class="card-body">

                  <h3 class="card-title">
                    <?php echo $title ?>
                  </h3>

                </div>
              </div>

            <?php
            }
          } else {

            ?>
            <div style="display:flex; justify-content:center;">
              <img src=" https://jalarambookstore.com/img/nodata.png">'
            </div>
        <?php

          }

          echo '</div>';
        } else {
          include '../Utils/category.php';
        }

        ?>

        </div>


        <!-- BOOK DISPLAY ENDS -->

    </div>
  </div>

  <!-- BODY ENDS -->


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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script src="../../js/cart.js"></script>
  <script src="../../js/toast.js"></script>
  <script src="../../js/script.js"></script>

</body>

</html>