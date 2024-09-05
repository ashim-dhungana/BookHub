<?php

session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: ../Pages/admin.php");
  exit;
}

include '../Utils/dbconnect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="../../css/sales.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>


<body>

  <?php
  include 'sidebar.php';
  ?>

  <div class="header-1">
    <form action="#" method="GET" class="search-form" id="search-form">
      <input type="search" name="search" placeholder="Search here..." id="search-box">
      <label for="search-box" class="fa fa-search"></label>
    </form>
  </div>


  <!-- BODY STARTS -->

  <main id="main" class="main" style="margin-top: -10px;">

    <table class="table">
      <thead class="thead-light">
        <tr>
          <th scope="col">ISBN</th>
          <th scope="col">Image</th>
          <th scope="col">Book Title</th>
          <th scope="col">Price</th>
          <th scope="col">Author</th>
          <th scope="col">Publisher</th>
          <th scope="col">Published_date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>

      <?php
      $sql = "SELECT * FROM books";

      if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        $sql = " SELECT * FROM `books` WHERE `title` LIKE '%$searchTerm%'";
      }      

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      ?>

        <?php foreach ($rows as $item) { ?>
          <tr>
            <td>
              <?php echo $item['isbn']; ?>
            </td>
            <td><img height="100" src="<?php echo $item['image']; ?>" alt=""></td>
            <td>
              <?php echo $item['title']; ?>
            </td>
            <td>Rs.
              <?php echo $item['price']; ?>
            </td>

            <td>
              <?php echo $item['author']; ?>
            </td>

            <td>
              <?php echo $item['publisher']; ?>
            </td>
            <td>
              <?php echo $item['publishdate']; ?>
            </td>

            <td class="buttons">

              <button class="backBtn" style="background:green; cursor:pointer;" onclick="editBooks('<?php echo $item['isbn']; ?>')">
                Edit
              </button>

              <button class="backBtn" style="background:red; margin-top:5px; cursor:pointer;" onclick="deleteBooks('<?php echo $item['isbn']; ?>')">
                Delete
              </button>

            </td>

          </tr>
        <?php } ?>
        </tbody>
    </table>
  <?php
      } else {
  ?>
    <div style="display:flex; justify-content:center;">
      <img src="https://jalarambookstore.com/img/nodata.png" alt="No Data">
    </div>
  <?php
      }
  ?>

  </main>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="../../js/allBooks.js"></script>
  <script src="../../js/toast.js"></script>
</body>

</html>