<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <nav class="container-fluid nav d-flex justify-content-between align-items-center">
        <section class="nav-links-left d-flex justify-content-center gap-2 align-items-center">
            <h2 class="poppins mb-0">Book Hive</h2>
            <a href="/src/index.php" class="text-decoration-none text-black poppins ">Home</a>
            <a href="#" class="text-decoration-none text-black poppins ">Shop</a>
            <a href="#" class="text-decoration-none text-black poppins ">About Us</a>
            <a href="#" class="text-decoration-none text-black poppins ">Contact</a>
        </section>
        <section class="nav-links-center d-flex align-items-center justify-content-start gap-4">
            <?php
            // render profile link if user is logged in
            if (isset($_COOKIE['usertoken'])) {
                echo '<a href="/admin/index.php" class="text-decoration-none text-black poppins ">Admin</a>';
            }
            ?>
        </section>
        <section class="nav-links-right d-flex justify-content-center align-items-center gap-4">
            <div>
                <form action="" class="d-flex">
                    <input type="text" placeholder="Search here" class="form-control">
                    <input type="submit" class="btn btn-primary ms-2" value="Search">
                </form>
            </div>

            <?php
            if (isset($_COOKIE['username'])) {
                echo '
                    <div>
                        <button id="logout" class="px-3 py-1 poppins">Logout</button>
                        <a href="/src/pages/cart.php" class="btn btn-sm-primary">Cart</a>
                        <a href="/src/pages/orders.php" class="btn btn-sm-primary">Orders</a>
                    </div>
                ';
            } else {
                echo '<a href="/src/pages/login.php" class="text-decoration-none px-3 py-1 poppins ">Login</a>';
            }
            ?>

        </section>
    </nav>


    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script>
        const logout = document.getElementById('logout');
        logout.addEventListener('click', function(event) {
            document.cookie = 'username=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
            document.cookie = 'userid=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
            document.cookie = 'usertoken=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
            window.location.href = '/src/index.php';
        })
    </script>
</body>

</html>