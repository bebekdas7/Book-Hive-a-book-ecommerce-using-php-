<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/categories.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../index.css">
    <title>Document</title>
</head>

<body>
    <!-- -------------include navbar--------------- -->
    <?php
    include "../partials/nav.php";
    ?>
    <main class="category px-4 py-3">
        <section class="category-heading d-flex align-items-center">
            <a href="/src/index.php" class="text-decoration-none text-black">
                <p class="mb-0">Categories ></p>
            </a>
            <h3 class="mb-0 ms-2">Satire</h3>
        </section>

        <section class="category-main mt-3 py-3 d-flex flex-wrap justify-content-start gap-5">
            <!-- ----------------book card--------------- -->
            <?php
            require_once "../classes/db.php";
            $conn = new db("localhost", "root", "", "bookstore");
            $connDB = $conn->getConnection();
            $fetchBooks = "SELECT * FROM `book` WHERE `book_category`= 'satire'";
            $fetchingResult = mysqli_query($connDB, $fetchBooks);

            if (mysqli_num_rows($fetchingResult) > 0) {
                while ($row = mysqli_fetch_assoc($fetchingResult)) {
                    $book_id = $row['book_id'];
            ?>
                    <div class="product-card p-2 d-flex flex-column">
                        <span>
                            <img src="../public/images/<?php echo $row['book_image']; ?>" alt="">
                        </span>
                        <span class="d-flex flex-column justify-content-start align-items-start py-2 px-1">
                            <h6 class="roboto"><?php echo $row['book_author']; ?></h6>
                            <h5 class="poppins"><?php echo $row['book_name']; ?></h5>
                            <p class="poppins text-black">₹<?php echo $row['book_price']; ?></p>
                            <form action="../partials/manage_cart.php" method="post" class="w-100">
                                <button type="submit" name="addToCart" class="btn btn-primary w-100 mb-2">ADD TO CART</button>
                                <input type="hidden" name="bookid" value="<?php echo $row['book_id'] ?>">
                                <input type="hidden" name="bookname" value="<?php echo $row['book_name'] ?>">
                                <input type="hidden" name="bookprice" value="<?php echo $row['book_price'] ?>">
                                <input type="hidden" name="bookimage" value="<?php echo $row['book_image'] ?>">
                            </form>
                            <a href="/src/pages/buyNow.php?pid=<?php echo $book_id ?>" class="btn btn-primary w-100">BUY NOW</a>
                        </span>
                    </div>
            <?php
                }
            } else {
                echo "No Books found";
            }
            ?>
        </section>
    </main>



    <!-- --------------js bootstrap------------------ -->
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>