<?php
// echo getcwd();
// exit;
include "../config/config.php";
if (isset($_COOKIE['usertoken'])) {
    $token = $_COOKIE['usertoken'];
    $username = $_COOKIE['username'];
    $userid = $_COOKIE['userid'];

    //include the token class
    require ROOT_PATH . "/classes/setToken.php";
    $updateToken = new token();
    $updateToken->updateToken($token);

    setcookie("username", $username, time() + (60 * 15));
    setcookie("usertoken", $token, time() + (60 * 15));
    setcookie("userid", $userid, time() + (60 * 15));
} else {
    echo '
        <main class="d-flex justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
        <h3>Please Login to Read our Contents</h3>
        <a class="btn btn-primary" href="/src/index.php">Login</a>
        </div>
        </main>
        ';
    exit;
}
