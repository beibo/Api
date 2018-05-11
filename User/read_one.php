<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../object/User.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$us = new User($db);
 
// set ID property of product to be edited
$us->Id = isset($_GET['Id']) ? $_GET['Id'] : die();
 
// read the details of product to be edited
$us->readOne();
 
// create array
$us_arr = array(
    "Id" =>  $us->Id,
    "name" => $us->name,

    "age" => $us->age
    
 
);
 
// make it json format
print_r(json_encode($us_arr));
?>