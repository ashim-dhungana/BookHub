<?php
session_start();

$userId = $_SESSION['id'];

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: ../../index.php");
  exit;
}
include '../Utils/dbconnect.php';


?>

<html>

<head>

</head>

<body>
  <div id="toast-container"></div>

  <?php include("./header.php") ?>


  <div class="userProfileContainer">
    <div class="profileSidebar">
      <div class="sidebars">
        <ul>
          <li>
            <a href="#" class="sidebars-item active" data-target="dashboard">Dashboard</a>
          </li>
          <li>
            <a href="#" class="sidebars-item" data-target="history">My Books</a>
          </li>
          <li>
            <a href="#" class="sidebars-item" data-target="logout">
              <span>Log Out</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="dataContainer">

      <?php

      $booksql = "SELECT COUNT(*) FROM `sales` WHERE `userId`=$userId";
      $paidbooks = "SELECT COUNT(*) FROM `sales` WHERE `userId`=$userId AND `paid`=1";
      $unpaidbooks = "SELECT COUNT(*) FROM `sales` WHERE `userId`=$userId AND `paid`=0";
      $costsql = "SELECT SUM(price) FROM `sales`WHERE `userId`=$userId AND `paid`=0";

      $result1 = mysqli_query($conn, $booksql);
      $result2 = mysqli_query($conn, $paidbooks);
      $result3 = mysqli_query($conn, $unpaidbooks);
      $result4 = mysqli_query($conn, $costsql);

      $books = mysqli_fetch_row($result1)[0];
      $paidBooks = mysqli_fetch_row($result2)[0];
      $unpaidBooks = mysqli_fetch_row($result3)[0];
      $cost = mysqli_fetch_row($result4)[0];

      ?>
      <div id="dashboard" class="content">
        <div class="dashboardmain">
          <div class="totalbooks hover">
            <p class="title">Total books</p>
            <p class="subtitle">
              <?php echo $books ?>
            </p>
          </div>
          <div class="totalpaidbooks hover">
            <p class="title">Total paid books</p>
            <p class="subtitle">
              <?php echo $paidBooks ?>
            </p>
          </div>
          <div class="totalunpaidbooks hover">
            <p class="title">Total unpaid books</p>
            <p class="subtitle">
              <?php echo $unpaidBooks ?>
            </p>
          </div>
          <div class="totalcost hover">
            <p class="title">To Be Paid</p>
            <p class="subtitle">
              <?php
              if ($cost) {
                echo "Rs. " . $cost;
              } else {
                echo "Rs. 0";
              }
              ?>

            </p>
          </div>
        </div>


      </div>

      <div id="history" class="content" style="display: none;">


        <?php
        $sql = "SELECT books.*,sales.* FROM sales INNER JOIN books ON sales.isbn = books.isbn WHERE sales.userId = '$userId'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
        ?>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ISBN</th>
                <th scope="col">Image</th>
                <th scope="Author">Author</th>
                <th scope="col">Book Title</th>
                <th scope="col">Price</th>
                <th scope="col">Payment Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($item = mysqli_fetch_assoc($result)) {
              ?>

                <tr>
                  <th scope="row">
                    <?php echo $item['isbn']; ?>
                  </th>
                  <td><img height="100" src="<?php echo $item['image']; ?>" alt=""></td>
                  <td>
                    <?php echo $item['author']; ?>
                  </td>
                  <td>
                    <?php echo $item['title']; ?>
                  </td>
                  <td>
                    <?php echo $item['price']; ?>
                  </td>
                  <td>
                    <?php if ($item['paid']) {
                      echo 'PAID';
                    } else {
                      echo 'UNPAID';
                    } ?>
                  </td>
                  <td width="300">
                    <?php if ($item['paid']) {
                      ?>
                      <button class="actionbardash" style="background-color:green" type="button" class="add-to-sales"
                        onclick="readBook('<?php echo $item['path'] ?>')">
                        Read Book </button>

                      <?php
                    } else {
                      ?>
                      <button class="actionbardash khalti" style="background-color:white" type="button" class="add-to-sales"
                        onclick="initiateTransaction('<?php echo $item['title'] ?>','<?php echo $item['price'] ?>','<?php echo $item['isbn'] ?>','<?php echo $item['image'] ?>')">
                        Pay With
                        <img height="20" src="https://seeklogo.com/images/K/khalti-logo-F0B049E67E-seeklogo.com.png">
                      </button>


                      <?php
                    } ?>



                    <button class="actionbardash" style="background-color:red"
                      onclick="onDelete('<?php echo $item['isbn']; ?>')">
                      Delete
                    </button>
                  </td>
                </tr>

                <?php
              }
              ?>
            </tbody>
          </table>
        <?php

        } else {
        ?>
          <div style="display:flex; justify-content:center;">
            <img src=" https://jalarambookstore.com/img/nodata.png">'
          </div>
        <?php

        }
        ?>
      </div>
      <div id="logout" class="content" style="display: none;">



        <div class=" card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">Are You sure Want to Logout?</h5>
            <a href="../../index.php" class="btn btn-primary">Log Out</a>
          </div>
        </div>
      </div>


    </div>
  </div>

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

  <div id="logout" class="content" style="display: none;">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Are You sure Want to Logout?</h5>
        <a href="../../index.php" class="btn btn-primary">Log Out</a>
      </div>
    </div>
  </div>


  </div>
  </div>
  <script src="../../js/userprofile.js"></script>
  <script src="../../js/cart.js"></script>
  <script src="../../js/script.js"></script>
  <script src="../../js/toast.js"></script>
  <script>
    function onDelete(isbn) {
      showToast("Deleted Success", 'success', 5000);
      deleteBooks(isbn);
    }
  </script>

  <script src="../../js/toast.js"></script>

  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>

</html>
