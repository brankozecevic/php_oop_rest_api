<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: category');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Category object
$category = new Category($db);

//Get the data from category method
$data = json_decode(file_get_contents('php://input'));
$category->name = htmlspecialchars(strip_tags($data->name));

//Create category
if($category->create()){
    echo json_encode(array('message' => 'Category created.'));
}else{
    echo json_encode(array('message' => 'Category not created.'));
}
/*
    * When creating category with Postman app
    * set POST request and in 'Headers' field specify 
    * Content-Type to application/json and 
    * in 'Body' field format data as JSON
*/