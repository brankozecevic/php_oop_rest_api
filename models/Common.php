<?php
class Common {
    protected $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    //Getting the posts or categories
    public function get_items($query){
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //Getting one single category or post using GET method and id as a parameter
    public function get_item($query){
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}