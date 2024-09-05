<?php
if ($_SESSION['id']) {
  $userId = $_SESSION['id'];

  $cartSql = "SELECT count(id) FROM `cart` WHERE `userId` = '$userId'";
  $cartResult = mysqli_query($conn, $cartSql); // Corrected variable name

  $row = mysqli_fetch_row($cartResult);
  $count = $row[0];
}

?>

<html>

<head>


  <link rel="stylesheet" href="../../web-fonts-with-css/css/fontawesome-all.min.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.angularjswiki.com/fontawesome/fa-blog/">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="../../css/cart.css">
  <link rel="stylesheet" href="../../css/utility.css">
  <link rel="stylesheet" href="../../css/userprofile.css">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/toast.css">

</head>

<body>
  <header class="header">

    <div class="header-1" style="text-decoration:none;">
      <a href="welcome.php" class="logo" style="cursor:pointer; text-decoration:none;"><i class="fa fa-book"></i>BookHub</a>

      <form action="#" method="GET" class="search-form" id="search-form">
        <input type="search" name="search" placeholder="Search here..." id="search-box">


        <input type="hidden" name="filter" id="filter-input">
        <div class="filter">
          <select id="filter-dropdown">
            <option value="title">Title</option>
            <option value="author">Author</option>
            <option value="publisher">Publisher</option>
          </select>
        </div>
        <label for="search-box" class="fa fa-search"></label>
      </form>


      <div class="icons">
        <div>

        </div>

        <?php if (!$_SESSION['email']) {
        ?>
          <div id="login-btn" class="fa fa-user "> </div>
        <?php
        } else {
        ?>
          <div id="cart-btn" class="fa fa-shopping-cart">
            <sup id="cart-count"><?php echo $count ?></sup>
          </div>
          <a href="./userprofile.php">
            <div class="userIcon">
              <div class="userIconDetails">

                <div class="fa fa-user " style="color:white"></div>
                <p class="useridentification">
                  <?php echo $_SESSION['fullName'] ?>
                </p>
              </div>
            </div>
          </a>
          <a href="../Utils/logout.php">
            <div id="login-bt" class="fa fa-sign-out" title="Logout">
            </div>

          </a>


        <?php
        } ?>



      </div>
    </div>
  </header>

  <!-- carts start -->


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>