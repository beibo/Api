<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/User.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$us= new User($db);
 
// query products
$stmt = $us->read();
$num = $stmt->rowCount();
if($num>0){
 
    // products array
    $us_arr=array();
    $us_arr=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $us_item=array(
            "Id" => $Id,
            "name" => $name,
           
            "age" => $age,
           
        );
 
        array_push($us_arr, $us_item);
    }
 
 
echo json_encode($us_arr);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}