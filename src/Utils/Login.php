<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'dbconnect.php';
  $email = $_POST['email'];
  $password = $_POST['password'];

  $showAlert = false;
  $showError = false;

  $sql = "Select * from `user` where email='$email'";

  try {
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num >= 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
          $showAlert = "You've successfully logged in.";

          if ($row['type'] == "user") {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['fullName'] = $row['fullname'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['type'] = $row['type'];

            header("location: ../Pages/welcome.php");
            
          } elseif ($row['type'] == "admin") {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['fullName'] = $row['fullname'];
            $_SESSION['type'] = $row['type'];

            header("location: ../Pages/welcomeadmin.php");
          }
        } else {
          $showError = "Invalid Credentials";
        }
      }
    } else {
      $showError = "Invalid Credentials";
    }
  } catch (Exception $e) {
    echo "<br>Error: " . $e->getMessage();
  }
}

?>

<html>
<script>
  console.log('Script is running');
  var userEmail = '<?php echo $email; ?>';
  console.log('User Email:', userEmail);
  localStorage.setItem('userEmail', userEmail);
</script>

</html>