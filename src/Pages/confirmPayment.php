<?php

session_start();
$id = $_SESSION['id'];
$fullName = $_SESSION['fullName'];

$status = $_GET['status'];
$transaction_id = $_GET['tidx'];
$isbn = $_GET['purchase_order_id'];

include '../Utils/dbconnect.php';

$sql = "SELECT `title` FROM `books` WHERE isbn='$isbn'";
$result = mysqli_query($conn, $sql);
$title = mysqli_fetch_array($result)[0];

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Confirmation</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/confirmPayment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

    <?php

    if ($status == "Completed") {

        $sql = "UPDATE `sales` SET`transaction_id`='$transaction_id',`title`='$title',`paid`=1 WHERE `userId` = $id AND `isbn`='$isbn'";

        mysqli_query($conn, $sql);


        ?>


        <div class="bill">
            <div class="paymentHeader">
                <a href="../../index.php" class="logo" style="cursor:pointer;"><i class="fa fa-book"></i>BookHub</a>

                <img height="30" src="https://seeklogo.com/images/K/khalti-logo-F0B049E67E-seeklogo.com.png"> </img>
            </div>
            <div class="paymentconfirmed">

                <img height="200" width="200" src="https://netkasystem.com/wp-content/uploads/2023/09/payment-check.png">
                </img>
                <p id="id1">
                    Payment confirmed
                </p>
                <p style="text-align:center">Your payment has been successful. Your booking with BookHub is now confirmed.
                    Happy reading!.</p>
            </div>
            <div class="ordersummary">
                <div class="productDetails">
                    <p class="trnsactionId">
                        <b>Transaction ID:</b>
                        <?php echo $transaction_id ?>
                    </p>
                    <p class="product">
                        <b>Product:</b>
                        <?php echo $title ?>
                    </p>
                    <p class="isbn">
                        <b>ISBN:</b>
                        <?php echo $isbn ?>
                        </span>
                    </p>
                    <p class="quantity"> <b>Payment Mode:</b>
                        Online</span></p>
                    <p class="totalprice trnsactionId">
                        <strong>
                            Totalprice:
                        </strong>
                        <span id="amount"></span>
                    </p>
                </div>

                <img src="" height="200" id="productImage">

            </div>
            <img class="khaltipayment">
            <button class="backBtn" onclick="redirectToDashboard()">Back to Dashboard</button>

        </div>
        </div>



        <?php
    } else {
        echo '
        <div class="container">
        <div class="alert alert-danger error" role="alert">
            Payment Failed!
        </div>
    </div>
        ';
    }

    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>


<script>
    function redirectToDashboard() {
        window.location.href = './userprofile.php';
    }
    // Function to get URL parameter by name
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }

    // Get the URL parameters
    var pidx = getParameterByName('pidx');
    var transaction_id = getParameterByName('transaction_id');
    var tidx = getParameterByName('tidx');
    var amount = getParameterByName('amount');
    var total_amount = getParameterByName('total_amount');
    var mobile = getParameterByName('mobile');
    var status = getParameterByName('status');
    var purchase_order_name = getParameterByName('purchase_order_name');
    var moreData = JSON.parse(purchase_order_name)
    console.log(moreData)


    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("productImage").setAttribute("src", moreData.image)
        document.getElementById("amount").textContent = `NRPs.${amount / 100}`;
        document.getElementById("orderId").textContent = amount;
        document.getElementById("transactionId").textContent = transaction_id;
    });
</script>

<script src="../../js/toast.js"></script>

</html>
