<?php

include 'Common.php';

class Post extends Common{
    //Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public $query_get_posts = 'SELECT c.name as category_name, 
    p.id, 
    p.category_id, 
    p.title, 
    p.body, 
    p.author, 
    p.created_at
    FROM posts p
    LEFT JOIN
    categories c ON p.category_id = c.id
    ORDER BY
    p.created_at DESC';

    public $query_get_post = 'SELECT c.name as category_name, 
    p.id, 
    p.category_id, 
    p.title, 
    p.body, 
    p.author, 
    p.created_at
    FROM posts p
    LEFT JOIN
    categories c ON p.category_id = c.id
    WHERE p.id = ?';

    //Creating a post
    public function create(){
        $query = 'INSERT INTO posts SET title = :title, body = :body, author = :author, category_id = :category_id';

        //Preparing statement
        $stmt = $this->conn->prepare($query);

        //Binding data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);

        if($stmt->execute()){
            return true;
        }else{
            //Print if something goes wrong
            print_f('Error: %s\n', $stmt->error);
            return false;
        }
    }
    //Update post
    public function update(){
        $query = 'UPDATE posts SET title = :title, body = :body, author = :author, category_id = :category_id WHERE id = :id';

        //Preparing statement
        $stmt = $this->conn->prepare($query);

        //Binding data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }else{
            //Print if something goes wrong
            print_f('Error: %s\n', $stmt->error);
            return false;
        }
    }
    //Deleting the post
    public function delete(){
        $query = 'DELETE FROM posts WHERE id = :id';

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