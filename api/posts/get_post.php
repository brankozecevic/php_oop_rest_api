<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Post object
$post = new Post($db);
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$row = $post->get_item($post->query_get_post);

$post_arr = array(
    'id' => $row['id'],
    'title' => $row['title'],
    'body' => $row['body'],
    'author' => $row['author'],
    'category_id' => $row['category_id'],
    'category_name' => $row['category_name']
);

//Create JSON
print_r(json_encode($post_arr));
