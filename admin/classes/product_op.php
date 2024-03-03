<?php
include_once "../../src/classes/db.php";

class product
{
    function add_product($book_name, $book_pages, $book_category, $book_author, $book_publish_date, $book_language, $book_price, $book_image)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "INSERT INTO `book` (`book_name`, `book_pages`, `book_category`, `book_author`, `book_publish_date`, `book_language`, `book_price`, `book_image`) VALUES ('$book_name', '$book_pages', '$book_category', '$book_author', '$book_publish_date', '$book_language', '$book_price', '$book_image')";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function edit_product($id, $book_name, $book_pages, $book_category, $book_author, $book_publish_date, $book_language, $book_price, $book_image)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "UPDATE `book` SET `book_name` = '$book_name', `book_pages` = '$book_pages', `book_category` = '$book_category', `book_author` = '$book_author', `book_publish_date` = '$book_publish_date', `book_language` = '$book_language', `book_price` = '$book_price', `book_image` = '$book_image' WHERE `book_id` = '$id'";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete_product($id)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "DELETE FROM `book` WHERE `book_id` = '$id'";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
