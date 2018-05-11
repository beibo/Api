<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $Id;
    public $name;
    public $age;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }


    // read products
function read(){
 
    //select all query
    $query = "select * from `users` ";
               
          
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
// create product
function create(){
 
   
    $query = "insert into `users` set name=:name, age=:age";
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    
    $this->age=htmlspecialchars(strip_tags($this->age));
   
    // bind values
    $stmt->bindParam(":name", $this->name);

    $stmt->bindParam(":age", $this->age);
    
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// used when filling up the update product form
function readOne(){
 
    // query to read single record
    $query = "SELECT *FROM `users` WHERE Id = ? LIMIT 0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of product to be updated
    $stmt->bindParam(1, $this->Id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->name = $row['name'];
    $this->age= $row['age'];
    $this->Id= $row['Id'];
    
}
// update the product
function update(){
 
    // update query
    $query = "UPDATE `users` SET name=:name ,age=:age WHERE Id = :Id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->age=htmlspecialchars(strip_tags($this->age));
   
    $this->Id=htmlspecialchars(strip_tags($this->Id));
 
    // bind new values
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':age', $this->age);
    
    $stmt->bindParam(':Id', $this->Id);
 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE Id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->Id=htmlspecialchars(strip_tags($this->Id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->Id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}

function lastUser(){
    
}
}
 



