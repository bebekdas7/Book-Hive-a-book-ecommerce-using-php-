<?php
$username = $_COOKIE['username'];
$sql = "SELECT * FROM users WHERE username='$username'";

include "../../src/classes/db.php";
$conn = new db("localhost", "root", "", "bookstore");
$connDB = $conn->getConnection();
$result = mysqli_query($connDB, $sql);
$row = mysqli_fetch_assoc($result);

//getd the user role
$userRole = $row['role']; //got the user role
$userid = $row['id'];

if ($userRole == "admin" && isset($_COOKIE['usertoken'])) {
    $currentToken = $_COOKIE['usertoken'];
    $token = mysqli_real_escape_string($connDB, $currentToken);
    $checkToken = "SELECT * FROM api_token WHERE user_id='$userid' AND user_token= '$currentToken'";
    $result = mysqli_query($connDB, $checkToken);
    if (mysqli_num_rows($result) > 0) {
        $userTokenValidation = true;
    } else {
        $userTokenValidation = false;
    }
} else {
    $userTokenValidation = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $userRole == "admin" && $userTokenValidation) {
    include "../classes/product_op.php";
    header('Content-Type: application/json');

    $new_post = new product();
    $new_post->add_product(
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
        'message' => 'Post created successfully.'
    );
    echo json_encode($response);
} else {
    $response = array(
        'success' => false,
        'message' => 'Error: Invalid request or unauthorized access.'
    );
    echo json_encode($response);
}
