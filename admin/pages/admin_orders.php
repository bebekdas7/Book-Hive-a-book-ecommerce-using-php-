<?php
include "../../config/config.php";
require_once ROOT_PATH . "/classes/db.php";

if (isset($_POST['export'])) {
    $conn = new db("localhost", "root", "", "bookstore");
    $connDB = $conn->getConnection();

    $sql = "SELECT * FROM `orders`";
    $result = mysqli_query($connDB, $sql);

    $output = fopen("php://output", "w");
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=orders.csv");
    fputcsv($output, array('Id', 'Book id', 'User id', 'Room', 'Building', 'area', 'City', 'Pincode', 'Dispatch', 'Shipped', 'Order status'));

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    mysqli_close($connDB);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin-orders.css">
    <title>Admin | Orders</title>
</head>

<body>
    <?php
    include "../partials/nav.php";
    ?>
    <main class="py-3 px-2 border w-75">
        <div class="d-flex align-items-end justify-content-between">
            <div class="d-flex align-items-end">
                <h2 class="mb-0">Orders</h2>
                <p class="mb-0 ms-2 fs-5 text-secondary"><?php echo $_COOKIE['username'] ?></p>
            </div>
            <form action="" method="post">
                <button class="btn btn-primary" type="submit" name="export">Export to CSV📩</button>
            </form>
        </div>

        <div class="admin-orders mt-3">
            <div class=" mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Book id</th>
                            <th scope="col">User id</th>
                            <th scope="col">Room</th>
                            <th scope="col">Building</th>
                            <th scope="col">area</th>
                            <th scope="col">City</th>
                            <th scope="col">Pincode</th>
                            <th scope="col">Dispatch</th>
                            <th scope="col">Shipped</th>
                            <th scope="col">Order status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // require ROOT_PATH . "/classes/db.php";
                        $conn = new db("localhost",      "root", "", "bookstore");
                        $connDB = $conn->getConnection();
                        $sql = "SELECT * FROM `orders`";
                        $result = mysqli_query($connDB, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['order_id']; ?></th>
                                    <td><?php echo $row['book_id']; ?></td>
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['order_room']; ?></td>
                                    <td><?php echo $row['order_building']; ?></td>
                                    <td><?php echo $row['order_area']; ?></td>
                                    <td><?php echo $row['order_city']; ?></td>
                                    <td><?php echo $row['order_pincode']; ?></td>
                                    <td><a href="/admin/pages/admin_orders.php?dispatch=<?php echo $row['order_id']; ?>">Dispatch🚚</a></td>
                                    <td><a href="/admin/pages/admin_orders.php?shipped=<?php echo $row['order_id']; ?>">Shipped📦</a></td>
                                    <td><?php echo $row['order_status']; ?></td>
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
        </div>
    </main>
</body>

</html>


<?php
if (isset($_GET['dispatch'])) {
    $order_id = $_GET['dispatch'];
    $sql = "UPDATE `orders` SET `order_status`='dispatched' WHERE `order_id`='$order_id'";
    $result = mysqli_query($connDB, $sql);
    if ($result) {
        echo "<script>alert('Order dispatched successfully')</script>";
        echo "<script>window.location.href='/admin/pages/admin_orders.php'</script>";
    }
}

if (isset($_GET['shipped'])) {
    $order_id = $_GET['shipped'];
    $sql = "UPDATE `orders` SET `order_status`='shipped' WHERE `order_id`='$order_id'";
    $result = mysqli_query($connDB, $sql);
    if ($result) {
        echo "<script>alert('Order Shipped successfully')</script>";
        echo "<script>window.location.href='/admin/pages/admin_orders.php'</script>";
    }
}
?>