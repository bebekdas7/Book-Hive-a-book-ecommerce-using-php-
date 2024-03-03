<?php
include "../../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/products.css">
    <title>Document</title>
</head>

<body>
    <?php
    // include "../../src/partials/loginCheck.php";

    // include the navbar
    include "../partials/nav.php";
    ?>

    <main class="admin-products w-75 p-3">
        <div class="admin-products-heading d-flex align-items-end">
            <h2 class="mb-0">Users</h2>
            <p class="mb-0 ms-2 fs-5 text-secondary"><?php echo $_COOKIE['username'] ?></p>
        </div>

        <div class="admin-products-operations mt-3 d-flex align-items-center">
            <a href="/admin/pages/add_users.php" class="btn btn-success">Add User</a>
        </div>

        <div class="admin-products-table mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Change Role</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //fetch the books from the database and sho in table
                    // include datbase
                    require ROOT_PATH . "/classes/db.php";
                    $conn = new db("localhost", "root", "", "bookstore");
                    $connDB = $conn->getConnection();
                    $sql = "SELECT * FROM `users`";
                    $result = mysqli_query($connDB, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['role']; ?></td>
                                <td><a href="/admin/pages/users.php?id=<?php echo $row['id']; ?>&role=<?php echo $row['role']; ?>">Change</a></td>
                                <td><a href="/admin/pages/users.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
                                <td><a href="/admin/pages/edit_user.php?pid=<?php echo $row['id'];?>">Edit</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "nothing here";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>


    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>

<?php
if (isset($_GET['role']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];

    if ($role == "admin") {
        $role = "user";
    } else {
        $role = "admin";
    }


    include "../classes/user_op.php";
    $user = new user();
    $user->change_role($id, $role);
    echo "<script>window.location.href='/admin/pages/users.php'</script>";
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    include "../classes/user_op.php";
    $user = new user();
    $user->delete_user($id);
    echo "<script>window.location.href='/admin/pages/users.php'</script>";
}
?>