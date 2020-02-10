<?php
session_start();

class Connection{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'movietickets_db';
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db_name);

        if($this->conn->connect_error){
            die('error connecting to database '.$this->connect_error);
        }else{
            return $this->conn;
        }
    }
}

?>