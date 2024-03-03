<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Book Hive | Login</title>
</head>

<body>
    <?php
    //including navbr
    include "../partials/nav.php";

    //including connections
    include_once "../classes/db.php";
    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE `username` = '$username'";
        $result = mysqli_query($connDB, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedpassword = $row['password'];
            $userid = $row['id'];
            $userrole = $row['role'];
            if (password_verify($password, $hashedpassword)) {
                setcookie("username", $username, time() + (60 * 15), "/");
                setcookie("userid", $userid, time() + (60 * 15), "/");
                if ($userrole == "admin") {
                    $newToken = md5(uniqid(rand(), true));

                    include_once "../classes/setToken.php";
                    $token = new token();
                    $token->saveToken($userid, $newToken);
                }
                echo "<script>alert('login successfull')</script>";
                header("Location: /src/index.php");
            } else {
                echo "<script>alert('Invalid username or password')</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password')</script>";
        }
    }
    ?>
    <main class="login-main d-flex flex-column justify-content-center align-items-center">
        <section class="login p-5 d-flex flex-column justify-content-center align-items-center">
            <div class="login-user">
                <img src="../public/images/user.png" alt="">
            </div>
            <div class="login-detail mt-3">
                <form action="login.php" method="post">
                    <h2 class="poppins text-center">Login</h2>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control">

                    <label for="password" class="form-label mt-3">Password</label>
                    <input type="password" name="password" class="form-control">

                    <p>Not Registered? <a href="/src/pages/register.php">Click Here</a></p>
                    <input type="submit" name="submit" class="mt-3 btn btn-success" value="Submit">
                </form>
            </div>
        </section>
    </main>



    <!-- --------------bootstrap js--------------- -->
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>