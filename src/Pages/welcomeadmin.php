<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">

</head>


<body>

    <?php

    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: ../Pages/admin.php");
        exit;
    }

    include 'sidebar.php';
    include '../Utils/dbconnect.php';

    $usersql = "SELECT COUNT(*) FROM `user` WHERE `type` = 'user'";
    $booksql = "SELECT COUNT(*) FROM `books`";
    $salessql = "SELECT COUNT(*) FROM `sales` WHERE `paid` = 1";
    $pricesql = "SELECT SUM(price) FROM `sales`WHERE `paid` = 1";

    $result1 = mysqli_query($conn, $usersql);
    $result2 = mysqli_query($conn, $booksql);
    $result3 = mysqli_query($conn, $salessql);
    $result4 = mysqli_query($conn, $pricesql);

    $usersCount = mysqli_fetch_row($result1)[0];
    $booksCount = mysqli_fetch_row($result2)[0];
    $salesCount = mysqli_fetch_row($result3)[0];
    $totalPrice = mysqli_fetch_row($result4)[0];



    // FOR CHART

    $user = "SELECT * From user";
    $userResult = mysqli_query($conn, $user);
    $userFinal = mysqli_fetch_all($userResult);

    $monthlyCounts = array_fill(1, 12, 0);

    foreach ($userFinal as $row) {
        if ($row[4] === "user") {
            $date = $row[5];
            $month = date('n', strtotime($date));
            $monthlyCounts[$month]++;
        }
    }

    $monthlyCounts = array_values($monthlyCounts);

    $salesData = "SELECT * From sales";
    $salesResult = mysqli_query($conn, $salesData);
    $salesFinal = mysqli_fetch_all($salesResult);

    $salesmonthlyCounts = array_fill(1, 12, 0);

    foreach ($salesFinal as $row) {
        $dates = $row[7];
        $months = date('n', strtotime($dates));
        $salesmonthlyCounts[$months]++;
    }

    ?>

    <main id="main" class="main">
        <div class="main-content">
            <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row">

                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Users</h5>
                                                <span class="h2 font-weight-bold mb-0">
                                                    <?php echo $usersCount ?>
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Books</h5>
                                                <span class="h2 font-weight-bold mb-0">
                                                    <?php echo $booksCount ?>
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="fas fa-chart-bar"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Sales Number
                                                </h5>
                                                <span class="h2 font-weight-bold mb-0">
                                                    <?php echo $salesCount ?>
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                    <i class="fas fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total Sales Amount
                                                </h5>
                                                <span class="h2 font-weight-bold mb-0">
                                                    <?php
                                                    if ($totalPrice) {
                                                        echo "Rs. " . $totalPrice;
                                                    } else {
                                                        echo "Rs. 0";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-chart-pie"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        </div>

        <div class="charts">
            <div class="salesChart">
                <p>Monthly Sales Target</p>
                <canvas id="mySales"></canvas>
            </div>
            <div class="UserChart">
                <p>Monthly User Data</p>
                <canvas id="myUsers"></canvas>
            </div>
            <div class="salesMonthChart">
                <p>Sales By Month</p>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Sales Target - Doughnut Chart
        var ctxSales = document.getElementById("mySales").getContext('2d');
        var mySalesChart = new Chart(ctxSales, {
            type: 'doughnut',
            data: {
                labels: ['Target', 'Obtained'],
                datasets: [{
                    label: 'My Sales Target',
                    data: [100, <?php echo $salesCount ?>], // Ensure $sales is defined and has a valid value
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        "#27985A",
                    ],
                    hoverOffset: 10
                }]
            }
        });

        // Monthly User Data - Line Chart
        var ctxUsers = document.getElementById("myUsers").getContext('2d');
        var myUsersChart = new Chart(ctxUsers, {
            type: "line",
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', "August", "September", "October", "November", "December"], // Example labels for 7 months
                datasets: [{
                    label: 'Monthly User Data',
                    data: <?php echo json_encode($monthlyCounts) ?>, // Example data for the line chart
                    fill: false,
                    borderColor: '#27985A',
                    tension: 0.1
                }]
            }
        });

        // Sales By Month - Bar Chart
        var ctxSalesByMonth = document.getElementById('myChart').getContext('2d');
        var mySalesByMonthChart = new Chart(ctxSalesByMonth, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', "August", "September", "October", "November", "December"],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: 'blue',
                    borderColor: 'black',
                    borderWidth: 1,
                    data: <?php echo json_encode(array_values($salesmonthlyCounts)) ?>
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="../../js/toast.js"></script>
</body>

</html>