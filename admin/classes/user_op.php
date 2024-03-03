<?php
include_once "../../src/classes/db.php";
class user
{
    function add_user($name, $email, $username, $password, $role)
    {
        //hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "INSERT INTO users (name, email, username, password, role) VALUES ('$name', '$email', '$username', '$hashedPassword', '$role')";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function delete_user($id)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "DELETE FROM users WHERE id = $id";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function update_user($id, $name, $email, $username, $role)
    {

        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "UPDATE users SET name = '$name', email = '$email', username = '$username', role = '$role' WHERE id = $id";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function change_role($id, $role)
    {
        $conn = new db("localhost", "root", "", "bookstore");
        $connDB = $conn->getConnection();

        $sql = "UPDATE users SET role = '$role' WHERE id = $id";
        $result = mysqli_query($connDB, $sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
