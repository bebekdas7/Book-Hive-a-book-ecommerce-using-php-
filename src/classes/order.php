<?php
include_once "db.php";
class order
{
    function placeOrder($bookId, $userId, $fname, $lname, $contact, $room, $building, $area, $city, $state, $pincode)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "
            INSERT INTO `orders` (`order_id`, `book_id`, `user_id`, `order_fname`, `order_lname`, `order_contact`, `order_room`, `order_building`, `order_area`, `order_city`, `order_state`, `order_pincode`) VALUES (NULL, '$bookId', '$userId', '$fname', '$lname', '$contact', '$room', '$building', '$area', '$city', '$state', '$pincode');
        ";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
            echo "done";
        } else {
            return false;
        }
    }
}
