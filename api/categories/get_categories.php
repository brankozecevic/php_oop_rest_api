<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Category object
$category = new Category($db);

//Getting the categories
$result = $category->get_items($category->query_get_categories);
$num = $result->rowCount();

//Check for categories
if($num > 0){
    $category_arr = array();
    $category_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            'name' => $name,
            'created_at' => $created_at
        );
        array_push($category_arr['data'], $category_item);
    }
    //Turning to JSON and output
    echo json_encode($category_arr);
}else{
    //If no categories
    echo json_encode(array('message' => 'No categories available.'));
}