<!DOCTYPE html>
<html lang="en">
<?
include_once "../classes/db.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <title>Checkout</title>
</head>

<body>
    <?php
    include "../partials/nav.php";
    if (isset($_COOKIE['userid'])) {
    ?>
        <main class="checkout-main py-3 px-4 d-flex justify-content-center align-items-center">
            <section class="checkout d-flex justify-content-between">
                <div class="checkout-address d-flex flex-column justify-content-start px-1 py-2">
                    <h2 class="poppins mb-2">Address</h2>
                    <h5 class="poppins text-secondary">Personal Details</h5>

                    <form action="" method="post">
                        <div class="d-flex mt-2 gap-3">
                            <div class="d-flex flex-column w-50">
                                <label for="fname">First Name</label>
                                <input type="hidden" name="bookid" value="<?php echo ($_GET['bookid']); ?>">
                                <input type="text" name="order_fname" class="form-control" required>
                            </div>
                            <div class="d-flex flex-column w-50">
                                <label for="lname">Last Name</label>
                                <input type="text" name="order_lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            <label for="contact">Contact</label>
                            <input type="number" name="order_contact" class="form-control" required>
                        </div>

                        <h5 class="poppins text-secondary mt-5">Home Details</h5>

                        <div class="d-flex mt-2 gap-3">
                            <div class="d-flex flex-column w-50">
                                <label for="room">Room No</label>
                                <input type="text" name="order_room" class="form-control" required>
                            </div>
                            <div class="d-flex flex-column w-50">
                                <label for="building">Building</label>
                                <input type="text" name="order_building" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex flex-column mt-2">
                            <label for="area">Area</label>
                            <input type="text" name="order_area" class="form-control" required>
                        </div>
                        <div class="d-flex mt-2 gap-3">
                            <div class="d-flex flex-column">
                                <label for="city">City</label>
                                <input type="text" name="order_city" class="form-control" required>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="state">State</label>
                                <input type="text" name="order_state" class="form-control" required>
                            </div>
                            <div class="d-flex flex-column">
                                <label for="pincode">Pin Code</label>
                                <input type="text" name="order_pincode" class="form-control" required>
                            </div>
                        </div>
                        <button class="btn btn-primary" name="submit">Place Order</button>
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {
                        $bookid = $_POST['bookid'];
                        $order_fname = $_POST['order_fname'];
                        $order_lname = $_POST['order_lname'];
                        $order_contact = $_POST['order_contact'];
                        $order_room = $_POST['order_room'];
                        $order_building = $_POST['order_building'];
                        $order_area = $_POST['order_area'];
                        $order_city = $_POST['order_city'];
                        $order_state = $_POST['order_state'];
                        $order_pincode = $_POST['order_pincode'];

                        include "../classes/order.php";
                        $order = new order();
                        $order->placeOrder(
                            $bookid,
                            $_COOKIE['userid'],
                            $order_fname,
                            $order_lname,
                            $order_contact,
                            $order_room,
                            $order_building,
                            $order_area,
                            $order_city,
                            $order_state,
                            $order_pincode,
                        );
                        echo "<script>alert('Order Placed Successfully')</script>";
                        echo "<script>window.location.href='/src/pages/orders.php '</script>";
                    }
                    ?>


                </div>
                <div class="checkout-details d-flex flex-column justify-content-start px-1">
                    <h2 class="poppins">Details</h2>
                    <?php
                    if (isset($_GET['bookid'])) {
                        $bookid = $_GET['bookid'];
                        include "../../src/classes/db.php";

                        $conn = new db("localhost", "root", "", "bookstore");
                        $connDB = $conn->getConnection();

                        $fetchBook = "SELECT * FROM book WHERE book_id = '$bookid'";
                        $result = mysqli_query($connDB, $fetchBook);
                        $row = mysqli_fetch_assoc($result);
                        $book_name = $row['book_name'];
                        $book_price = $row['book_price'];
                        $book_image = $row['book_image'];
                        $book_author = $row['book_author'];
                    }
                    ?>
                    <div class="product-box mt-2 d-flex justify-content-between">
                        <div class="d-flex">
                            <span class="img-box">
                                <img src="../public/images/<?php echo $book_image ?>" alt="">
                            </span>
                        </div>
                        <span class="d-flex flex-column justify-content-between text-secondary">
                            <p class="mb-0"><?php echo $book_author ?></p>
                            <p class="mb-0">₹<?php echo $book_price ?></p>
                        </span>
                    </div>
                </div>
            </section>
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