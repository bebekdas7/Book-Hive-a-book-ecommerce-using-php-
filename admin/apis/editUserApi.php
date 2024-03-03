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
    include "../classes/user_op.php";
    header('Content-Type: application/json');

    $new_user = new user();
    $new_user->update_user(
        $_POST['id'],
        $_POST['name'],
        $_POST['email'],
        $_POST['username'],
        $_POST['role'],
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
