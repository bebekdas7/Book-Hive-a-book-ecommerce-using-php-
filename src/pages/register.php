<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/register.css">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../css/nav.css">
    <title>Book Hive | register</title>
</head>

<body>
    <?php
    //including navbar
    include ".././partials/nav.php";
    // including the connection
    include_once "../classes/db.php";
    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();
    if (isset($_POST['register-form'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $role = 'user';
        if ($password == $cpassword) {
            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $checkemail = mysqli_query($connDB, $sql);
            if (mysqli_num_rows($checkemail) > 0) {
                echo "<script>alert('Email already exists')</script>";
            } else {
                $row = mysqli_fetch_assoc($checkemail);
                $checkusername = $row['username'];
                if ($checkusername == $username) {
                    echo "<script>alert('Username already exists')</script>";
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (name, email, username, password, role) VALUES ('$name', '$email', '$username', '$hashedPassword', '$role')";
                    $inject = mysqli_query($connDB, $sql);
                    if ($inject) {
                        echo "<script>alert('Registration Successful')</script>";
                        header("Location: /src/pages/login.php");
                        exit();
                    } else {
                        echo "<script>alert('Registration Failed')</script>";
                    }
                }
            }
        } else {
            echo "<script>alert('Passwords do not match')</script>";
        }
    }
    ?>


    <main class="register-main d-flex flex-column justify-content-center align-items-center p-4">
        <section class="register p-5 d-flex flex-column justify-content-center align-items-center">
            <div class="register-user">
                <img src="../public/images/user.png" alt="">
            </div>
            <div class="register-detail mt-3">
                <form action="register.php" method="post">
                    <h2 class="poppins text-center">Register</h2>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">

                    <label for="email" class="form-label mt-3">Email</label>
                    <input type="text" name="email" class="form-control">

                    <label for="username" class="form-label mt-3">Username</label>
                    <input type="text" name="username" class="form-control">

                    <label for="password" class="form-label mt-3">Password</label>
                    <input type="password" name="password" class="form-control">

                    <label for="cpassword" class="form-label mt-3">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control">

                    <p>Already Registered? <a href="/src/pages/login.php">Click Here</a></p>

                    <input type="submit" name="register-form" class="mt-3 btn btn-success" value="Submit">
                </form>
            </div>
        </section>
    </main>



    <!-- --------------bootstrap js--------------- -->
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>