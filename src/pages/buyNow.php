<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/buynow.css">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Book Hive | Buy Now</title>
</head>

<body>
    <!-- including navbar  -->
    <?php include_once "../partials/nav.php"; ?>

    <main class="buynow px-4 py-3">
        <?php
        //include the database connection
        include_once "../classes/db.php";
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $id = $_GET['pid'];
        $sql = "SELECT * FROM `book` WHERE `book_id` = '$id'";
        $result = mysqli_query($connDB, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <section class="buynow-heading d-flex align-items-center">
            <a href="/src/index.php" class="text-decoration-none text-black">
                <p class="mb-0">Categories ></p>
            </a>
            <a href="/src/pages/novel.php" class="text-decoration-none text-black">
                <p class="mb-0 ms-2">Novels ></p>
            </a>
            <h3 class="mb-0 ms-2 poppins"><?php echo $row['book_name']; ?></h3>
        </section>

        <div class="buynow-body mt-3 d-flex">
            <div class="buynow-body-preview py-3">
                <section>
                    <img src="./../public/images/book1.jpg" alt="">
                </section>
            </div>
            <div class="buynow-body-detail py-3 d-flex flex-column justify-content-between">
                <section>
                    <h5 class="fw-bold roboto text-primary"><?php echo strtoupper($row['book_category']) ?> BOOK COLLECTION</h5>
                    <h2 class="poppins"><?php echo $row['book_name']; ?></h2>
                    <p class="poppins text-secondary mb-2"><?php echo $row['book_author']; ?></p>
                    <p class="roboto w-50">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Dignissimos necessitatibus voluptatibus dolorum nesciunt, veritatis illum fuga cumque asperiores vero ratione libero perferendis maiores doloremque saepe dicta </p>
                    <div class="d-flex align-items-center justify-content-between w-25">
                        <p class="fw-semibold mb-0">PUBLISHER: </p>
                        <p class="mb-0">Shivani Pandey</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between w-25">
                        <p class="fw-semibold mb-0">PUBLISH Date: </p>
                        <p class="mb-0"><?php echo $row['book_publish_date']; ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between w-25">
                        <p class="fw-semibold mb-0">ISBN: </p>
                        <p class="mb-0">23456789098765</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between w-25">
                        <p class="fw-semibold mb-0">LANGUAGE: </p>
                        <p class="mb-0"><?php echo $row['book_language']; ?></p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between w-25">
                        <p class="fw-semibold mb-0">Pages: </p>
                        <p class="mb-0"><?php echo $row['book_pages']; ?></p>
                    </div>
                </section>

                <section class="border d-flex">
                    <a href="/src/pages/checkout.php?bookid=<?php echo $row['book_id'] ?>" class="btn btn-primary">Checkout</a>
                    <a href="#" class="btn btn-primary ms-2">Add To Cart</a>
                </section>
            </div>
        </div>
    </main>



    <!-- script for bootstrap js  -->
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>