<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Post object
$post = new Post($db);

//Get the data 
$data = json_decode(file_get_contents('php://input'));

$post->id = htmlspecialchars(strip_tags($data->id));
$post->title = htmlspecialchars(strip_tags($data->title));
$post->body = htmlspecialchars(strip_tags($data->body));
$post->author = htmlspecialchars(strip_tags($data->author));
$post->category_id = htmlspecialchars(strip_tags($data->category_id));

//Update post
if($post->update()){
    echo json_encode(array('message' => 'Post updated.'));
}else{
    echo json_encode(array('message' => 'Post not updated.'));
}
/*
    * When updating post with Postman app
    * set PUT request and in 'Headers' field specify 
    * Content-Type to application/json and 
    * in 'Body' field format data as JSON
*/
