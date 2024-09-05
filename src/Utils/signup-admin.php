<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';

    $passkey = "12345";

    $email = $_POST['email'];
    $fullName = $_POST['fullName'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $code = $_POST['code'];

    $exists = false;
    $showAlert = false;
    $showError = false;

    $existSql = "SELECT * FROM `user` WHERE email='$email'";
    $result = mysqli_query($conn, $existSql);

    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        $exists = true;
    }

    if ($exists == false) {
        if ($password == $cpassword) {

            if ($code == $passkey) {

                // Creating hash for password
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `user` (`email`, `fullName`, `password`, `type`) VALUES ('$email', '$fullName', '$hash' , 'admin')";

                try {
                    mysqli_query($conn, $sql);
                    $showAlert = "You have created a new account.";
                    header("location: ../../index.php");
                } catch (Exception $e) {
                    echo "<br>Error: " . $e->getMessage();
                }
            } else {
                $showError = "Wrong Admin Code";
            }
        } else {
            $showError = "Passwords do not match";
        }
    } else {
        $showError = "email already exists.";
    }
}
