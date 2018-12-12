<?php
class Database {
    private $host = 'localhost';
    private $database = 'myblog';
    private $username = 'root';
    private $password = '';
    private $conn;

    //Creating connection to database
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->database, 'root', '');
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }catch(PDOException $e){
            echo 'Connection error: '.$e->getMessage();
        }
    }
}