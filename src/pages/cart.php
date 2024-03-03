<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/cart.css">
    <title>Cart</title>
</head>

<body>
    <?php
    include "../partials/nav.php";
    ?>
    <main class="cart-main container-fluid">
        <section class="cart container px-2 py-3">
            <h2 class="poppins">Cart</h2>

            <!-- -----------cart items------------- -->
            <?php
            session_start();
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
            ?>
                    <div class="cart-box d-flex align-items-center justify-content-between w-75">
                        <div class="cart-img">
                            <img src="../public/images/<?php echo $item['Item-image']; ?>" alt="">
                        </div>
                        <p class="mb-0 poppins"><b>Book Id: </b><?php echo $item['Item-id']; ?></p>
                        <p class="mb-0 poppins"><b>Book Name: </b><?php echo $item['Item-name']; ?></p>
                        <p class="mb-0 poppins"><b>Book Price: </b><?php echo $item['Item-price']; ?></p>
                        <button class="btn btn-danger">Delete</button>
                    </div>
            <?php
                }
            } else {
                echo "<p>No items in cart</p>";
            }
            ?>
        </section>
    </main>

</body>

</html>


<!-- 
// session_start();
// if (isset($_SESSION['cart'])) {
// } else {
// echo "No items on cart";
// }

// session_abort(); -->