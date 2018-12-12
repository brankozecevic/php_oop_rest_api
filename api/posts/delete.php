<?php
//Setting upheaders
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
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

//Delete post
if($post->delete()){
    echo json_encode(array('message' => 'Post deleted.'));
}else{
    echo json_encode(array('message' => 'Post not deleted.'));
}
/*
    * When deleting the post with Postman app
    * set Delete request and in 'Headers' field specify 
    * Content-Type to application/json and 
    * in 'Body' field format data as JSON
*/
