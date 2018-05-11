<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
// include database and object file
include_once '../config/database.php';
include_once '../object/User.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$us = new User($db);
 
// get product id
$data = json_decode(file_get_contents("php://input"));
 
// set product id to be deleted
$us->Id = $data->Id;
 
// delete the product
if($us->delete()){
    // echo '{';
    //     echo '"message": "user was deleted."';
    // echo '}';
    echo  json_encode($us->Id);
}
 
// if unable to delete the product
else{
    echo '{';
        echo '"message": "Unable to delete object."';
    echo '}';
}
?>