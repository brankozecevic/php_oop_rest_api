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
$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$row = $category->get_item($category->query_get_category);

$category_arr = array(
    'name' => $row['name'],
    'created_at' => $row['created_at'],
);

//Create JSON
print_r(json_encode($category_arr));
