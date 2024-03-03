<?php
require_once "db.php";
class token
{
    function saveToken($id, $token)
    {
        //include connections
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();


        // check if the user already have token or not
        $checkUser = "SELECT * FROM `api_token` WHERE `user_id` = '$id'";
        $checkUserResult = mysqli_query($connDB, $checkUser);
        if (mysqli_num_rows($checkUserResult) > 0) {
            $updateToken = "UPDATE `api_token` SET `token_expiry` = NOW() + INTERVAL 15 MINUTE WHERE `user_id` = '$id'";
            $updateTokenResult = mysqli_query($connDB, $updateToken);
            if ($updateTokenResult) {
                $row = mysqli_fetch_assoc($checkUserResult);
                setcookie("usertoken", $row['user_token'], time() + (60 * 15), "/");
                echo '<script>window.location.href= "/src/index.php"</script>';
            } else {
                echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Something went wrong!</strong> Cannot update token expiry.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
            }
        } else {
            $insertToken = "INSERT INTO `api_token` (`id`, `user_id`, `user_token`, `token_expiry`) VALUES (NULL, '$id', '$token', NOW() + INTERVAL 15 MINUTE);";
            $insertTokenResult = mysqli_query($connDB, $insertToken);
            if ($insertTokenResult) {
                setcookie("usertoken", $token, time() + (60 * 15), "/");
                return true;
            } else {
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Something went wrong!</strong> Cannot save token.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        }
    }

    //updating the token
    public function updateToken($token)
    {
        //define the connection
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "SELECT * FROM `api_token` WHERE `user_token` = '$token'";
        $checkToken = mysqli_query($connDB, $sql);

        if (mysqli_num_rows($checkToken)) {
            $updateToken = "UPDATE `api_token` SET `token_expiry` = NOW() + INTERVAL 15 MINUTE WHERE `user_token` = '$token'";
            $updateSql = mysqli_query($connDB, $updateToken);

            if ($updateSql) {
                return true;
            }
        }
    }
}
