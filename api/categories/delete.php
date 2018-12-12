<?php
//Setting up headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Connecting to database
$database = new Database();
$db = $database->connect();

//Creating Category object
$category = new Category($db);

//Get the data 
$data = json_decode(file_get_contents('php://input'));

$category->id = htmlspecialchars(strip_tags($data->id));

//Delete category
if($category->delete()){
    echo json_encode(array('message' => 'Category deleted.'));
}else{
    echo json_encode(array('message' => 'Category not deleted.'));
}
/*
    * When deleting the category with Postman app
    * set DELETE request and in 'Headers' field specify 
    * Content-Type to application/json and 
    * in 'Body' field format data as JSON
*/
