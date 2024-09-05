<?php

include 'dbconnect.php';

$sql = "SELECT * FROM `books`";

if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $sql = "SELECT * FROM `books` WHERE `title` LIKE '%$searchTerm%'";
}

if (isset($_GET['filter'])) {
  $filterOption = $_GET['filter'];

  if (!empty($filterOption)) {
    $sql = "SELECT * FROM `books` WHERE `$filterOption` LIKE '%$searchTerm%'";
  }
}
?>

<p class="text-center my-3" style="font-size:25px;">
  <?php
  if (!empty($filterOption)) {

    echo '<strong> (Filtered By: ' .$filterOption. ' )</strong>';
  }
  ?>
</p>

<div class="row flexbox">

  <?php

  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {

    $title = $row['title'];
    $author = $row['author'];
    $publisher = $row['publisher'];
    $date = $row['publishdate'];
    $isbn = $row["isbn"];
    $image = $row["image"];

  ?>

    <div class="card my-2" onclick="redirectToBooks('<?php echo $isbn; ?>')">

    <img class="image" src="<?php echo $row['image']; ?>" class="card-img-top" alt="..." >

      <div class="card-body">

        <h3 class="card-title">
          <?php echo $title ?>
        </h3>

      </div>
    </div>

  <?php
  }
  ?>

</div>
