<?php

include 'Common.php';

class Category extends Common{

    //Category properties
    public $id;
    public $name;
    public $created_at;
    public $query_get_categories = 'SELECT name, created_at FROM categories ORDER BY created_at DESC';
    public $query_get_category = 'SELECT name, created_at FROM categories WHERE id = ?';

    //Creating a cathegory
    public function create(){
        $query = 'INSERT INTO categories SET name = :name';

        //Preparing statement
        $stmt = $this->conn->prepare($query);

        //Binding data
        $stmt->bindParam(':name', $this->name);

        if($stmt->execute()){
            return true;
        }else{
            //Print if something goes wrong
            print_f('Error: %s\n', $stmt->error);
            return false;
        }
    }
    //Update category
    public function update(){
        $query = 'UPDATE categories SET name = :name
        WHERE id = :id';
        //Preparing statement
        $stmt = $this->conn->prepare($query);
        
        //Binding data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);

        if($stmt->execute()){
            return true;
        }else{
            //Print if something goes wrong
            print_f('Error: %s\n', $stmt->error);
            return false;
        }
    }
    //Deleting the category
    public function delete(){
        $query = 'DELETE FROM categories WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }else{
            //Print if something goes wrong
            print_f('Error: %s\n', $stmt->error);
            return false;
        }
    }
}