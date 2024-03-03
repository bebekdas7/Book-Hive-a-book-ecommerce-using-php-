<?php
class db
{
    private $server;
    private $username;
    private $password;
    private $database;
    private $connDB;

    function __construct($server, $username, $password, $database)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
    function connect()
    {
        $this->connDB = mysqli_connect($this->server, $this->username, $this->password, $this->database);
        if (!$this->connDB) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function getConnection()
    {
        $this->connect();
        return $this->connDB;
    }
}
