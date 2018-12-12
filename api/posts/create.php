<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Post object
$post = new Post($db);

//Get the data from POST method
$data = json_decode(file_get_contents('php://input'));
$post->title = htmlspecialchars(strip_tags($data->title));
$post->body = htmlspecialchars(strip_tags($data->body));
$post->author = htmlspecialchars(strip_tags($data->author));
$post->category_id = htmlspecialchars(strip_tags($data->category_id));

//Create post
if($post->create()){
    echo json_encode(array('message' => 'Post created.'));
}else{
    echo json_encode(array('message' => 'Post not created.'));
}
/*
    * When creating post with Postman app
    * set POST request and in 'Headers' field specify 
    * Content-Type to application/json and 
    * in 'Body' field format data as JSON
*/
