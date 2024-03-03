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
            <h2 class="mb-0">Products</h2>
            <p class="mb-0 ms-2 fs-5 text-secondary"><?php echo $_COOKIE['username'] ?></p>
        </div>

        <div class="admin-products-operations mt-3 d-flex align-items-center">
            <a href="/admin/pages/add_products.php" class="btn btn-success">Add Product</a>
        </div>

        <div class="admin-products-table mt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Pages</th>
                        <th scope="col">Category</th>
                        <th scope="col">Author</th>
                        <th scope="col">Publish</th>
                        <th scope="col">Language</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //fetch the books from the database and sho in table
                    // include datbase
                    require ROOT_PATH . "/classes/db.php";
                    $conn = new db("localhost", "root", "", "bookstore");
                    $connDB = $conn->getConnection();
                    $sql = "SELECT * FROM `book`";
                    $result = mysqli_query($connDB, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                            <tr>
                                <th scope="row"><?php echo $row['book_id']; ?></th>
                                <td><?php echo $row['book_name']; ?></td>
                                <td><?php echo $row['book_pages']; ?></td>
                                <td><?php echo $row['book_category']; ?></td>
                                <td><?php echo $row['book_author']; ?></td>
                                <td><?php echo $row['book_publish_date']; ?></td>
                                <td><?php echo $row['book_language']; ?></td>
                                <td><?php echo $row['book_price']; ?></td>
                                <td><a href="/admin/pages/edit_products.php?pid=<?php echo $row['book_id'] ?>" class="btn btn-sm btn-primary">Edit</a></td>
                                <td><a href="/admin/pages/products.php?delete=<?php echo $row['book_id']; ?>" class="btn btn-sm btn-danger">Delete</a></td>
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
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    include "../classes/product_op.php";
    $book = new product();
    $book->delete_product($id);
    echo '<script>window.location.href="/admin/pages/products.php"</script>';
    exit();
}
?>