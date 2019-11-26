<?php 
 require_once '../config.php';
 $localhost = Config::get('mysql/host'); 
 $username = Config::get('mysql/username'); 
 $password = Config::get('mysql/password'); 
 $dbname = Config::get('mysql/db'); 
 // create connection 
 $connect = new mysqli($localhost, $username, $password, $dbname); 
  
 // check connection 
 if($connect->connect_error) {
     die("connection failed : " . $connect->connect_error);
 } else {
     // echo "Successfully Connected";
 }
 
?>