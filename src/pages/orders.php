<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/orders.css">
    <title>Document</title>
</head>

<body>
    <?php
    include "../partials/nav.php";
    if (isset($_COOKIE['userid'])) {
    ?>

        <main class="order-main container-fluid">
            <h2 class="poppins container mt-2">My Orders</h2>

            <?php
            include "../classes/db.php";
            $conn = new db("localhost", "root", "", "bookstore");
            $connDB = $conn->getConnection();

            $userid = $_COOKIE['userid'];
            $sql = "SELECT * FROM orders WHERE user_id=$userid";
            $result = mysqli_query($connDB, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $orderStatus = $row['order_status'];
                    $bookid = $row['book_id'];

                    $sql2 = "SELECT * FROM book WHERE book_id=$bookid";
                    $result2 = mysqli_query($connDB, $sql2);

                    if (mysqli_num_rows($result2) > 0) {
                        $row2 = mysqli_fetch_assoc($result2);
                        $bookName = $row2['book_name'];
                        $bookAuthor = $row2['book_author'];
                        $bookPages = $row2['book_pages'];
                        $bookPrice = $row2['book_price'];
                        $bookImage = $row2['book_image'];
            ?>

                        <section class="order container mt-4 py-3 px-2 d-flex justify-content-between align-items-center">
                            <div class="order-img">
                                <img src="../public/images/<?php echo $bookImage; ?>" alt="product">
                            </div>
                            <p class="mb-0"><b>Name</b>: <?php echo $bookName; ?></p>
                            <p class="mb-0"><b>Author</b>: <?php echo $bookAuthor; ?></p>
                            <p class="mb-0"><b>Pages</b>: <?php echo $bookPages; ?></p>
                            <p class="mb-0"><b>Status</b>: <?php echo $orderStatus; ?></p>
                        </section>
            <?php
                    }
                }
            }
            ?>

        </main>

    <?php
    } else {
        echo '
        <main class="d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
        <h3>Please Login to Buy the product</h3>
        <a class="btn btn-primary" href="/src/pages/login.php">Login</a>
        </div>
        </main>
        ';
        exit;
    }
    ?>
    <!-- bootstrap js here -->
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>