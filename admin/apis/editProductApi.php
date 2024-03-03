<?php
$username = $_COOKIE['username'];
$sql = "SELECT * FROM users WHERE username= '$username'";

include "../../src/classes/db.php";

$conn = new db("localhost", "root", "", "bookstore");
$connDB = $conn->getConnection();

$result = mysqli_query($connDB, $sql);
$row = mysqli_fetch_assoc($result);

//get user rile and user id
$userRole = $row['role'];
$userId = $row['id'];

//check admin and token
if ($userRole == "admin" && isset($_COOKIE['usertoken'])) {
    $currentToken = $_COOKIE['usertoken'];
    $checkToken = "SELECT * FROM api_token WHERE user_token = '$currentToken' AND user_id= '$userId'";
    $tokenResult = mysqli_query($connDB, $checkToken);

    if (mysqli_num_rows($tokenResult) > 0) {
        $userIsValidated = true;
    } else {
        $userIsValidated = false;
    }
} else {
    $userIsValidated = false;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $userIsValidated) {
    include "../classes/product_op.php";
    header('Content-Type: application/json');

    $edit_product = new product();
    $edit_product->edit_product(
        $_POST['book_id'],
        $_POST['book_name'],
        $_POST['book_pages'],
        $_POST['book_category'],
        $_POST['book_author'],
        $_POST['book_publish_date'],
        $_POST['book_language'],
        $_POST['book_price'],
        $_FILES['post_image']['name']
    );

    $response = array(
        'success' => true,
        'message' => 'Product edited successfully'
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Error: Invalid request or unauthorized access.'
    );
    echo json_encode($response);
}
