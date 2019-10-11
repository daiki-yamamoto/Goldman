<?php

class Config{
    // set the properties for the connection details
    private $servername = "localhost";
    private $username = "root";
    private $password = "";//MAMP - root
    private $database = "portfolio";

    protected $conn;

    //creare a constructor to automatically connect to the database
    public function __construct()
    {
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->database);

        if($conn->connect_error)
        {
            die("Connect Error: ". $conn->connect_error);
        }


        //set the connection as afglobal variabele
        $this->conn = $conn;
    }

}