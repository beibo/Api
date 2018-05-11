<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 header("Content-Type: application/json; charset=UTF-8");
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../object/User.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->name = $data->name;
$user->age = $data->age;

// create the product
if($user->create()){
   echo  json_encode($user);
}
 
// if unable to create the product, tell the user
else{
    echo '{';
        echo '"message": "Unable to create user."';
    echo '}';
}


?>