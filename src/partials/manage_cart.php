<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addToCart'])) {

        if (isset($_SESSION['cart'])) {
            //check for duplicate product
            $myItems = array_column($_SESSION['cart'], 'Item-id');

            if (in_array($_POST['bookid'], $myItems)) {
                echo "<script>
                alert('Product Already Added');
                window.location.href='/src/index.php';
                </script>";
                exit;
            } else {

                $_SESSION['cart'][] = array(
                    'Item-id' => $_POST['bookid'],
                    'Item-name' => $_POST['bookname'],
                    'Item-price' => $_POST['bookprice'],
                    'Item-image' => $_POST['bookimage'],
                    'Item-quantity' => 1,
                );
                echo "<script>
                alert('Product Added');
                window.location.href='/src/index.php';
                </script>";
                exit;
            }
        } else {
            $_SESSION['cart'][0] = array(
                'Item-id' => $_POST['bookid'],
                'Item-name' => $_POST['bookname'],
                'Item-price' => $_POST['bookprice'],
                'Item-image' => $_POST['bookimage'],
                'Item-quantity' => 1,
            );
            echo "<script>
                alert('Product Added To Cart');
                window.location.href='/src/index.php';
                </script>";
        }
    }
}
