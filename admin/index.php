<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="index.css">
    <title>Book-Hive | Admin Panel</title>
</head>

<body>
    <!-- ------------check the usertoken-------------- -->
    <?php
    include "../src/partials/loginCheck.php";
    include_once "../src/classes/db.php";
    ?>

    <!-- -----------including navbar------------ -->
    <?php
    include "partials/nav.php";
    ?>

    <main class="admin-dashboard p-3">
        <div class="admin-dashboard-heading d-flex align-items-end">
            <h2 class="text-black mb-0">Dashboard</h2>
            <p class="mb-0 ms-2 fs-5 text-secondary"><?php echo $_COOKIE['username'] ?></p>
        </div>
        <div class="admin-dashboard-content mt-3 d-flex">
            <!-- //users graph -->
            <div class="admin-dashboard-users w-50 h-100" id="users_div">
            </div>

            <!-- categories graph -->
            <div class="admin-dashboard-category w-50 h-100" id="categories_div">
            </div>
        </div>
    </main>



    <?php
    // fetch no of user nd admin in site
    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();
    $sqlAdmin = "SELECT * FROM users WHERE role= 'admin'";
    $check1 = mysqli_query($connDB, $sqlAdmin);
    $noOfAdmin = mysqli_num_rows($check1);

    $sqlUser = "SELECT * FROM users WHERE role= 'user'";
    $check2 = mysqli_query($connDB, $sqlUser);
    $noOfUser = mysqli_num_rows($check2);



    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();

    $sqlCategories = "SELECT book_category, COUNT(*) as count FROM book GROUP BY book_category";
    $resultCategories = mysqli_query($connDB, $sqlCategories);

    $categoryData = array();

    while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
        $categoryData[] = array($rowCategory['book_category'], (int)$rowCategory['count']);
    }
    ?>
    <!-- ---------------bootstrap js here---------------------- -->
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- google chart for pie chart of categories -->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Category');
            data.addColumn('number', 'Count');

            // Populate the data rows dynamically using PHP
            data.addRows(<?php echo json_encode($categoryData); ?>);

            var options = {
                'title': 'Products per Category',
                'width': '100%',
                'height': '100%'
            };

            var chart = new google.visualization.PieChart(document.getElementById('categories_div'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });

        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Role');
            data.addColumn('number', 'Count');
            data.addRows([
                ['Admin', <?php echo $noOfAdmin; ?>],
                ['User', <?php echo $noOfUser; ?>]
            ]);

            var options = {
                'title': 'Users',
                'width': '100%',
                'height': '100%'
            };

            var chart = new google.visualization.PieChart(document.getElementById('users_div'));
            chart.draw(data, options);
        }
    </script>
</body>

</html>