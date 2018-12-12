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

//Getting the posts
$result = $post->get_items($post->query_get_posts);
$num = $result->rowCount();

//Check for posts
if($num > 0){
    $post_arr = array();
    $post_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'category_id' => $category_id,
            'category_name' => $category_name
        );
        array_push($post_arr['data'], $post_item);
    }
    //Turning to JSON and output
    echo json_encode($post_arr);
}else{
    //If no posts
    echo json_encode(array('message' => 'No posts available.'));
}