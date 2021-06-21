<?php

$server = "localhost";
$username = "root";
$password = "lab3O4";
$dbname = "group3";

$conn = new mysqli($server,$username,$password,$dbname);

mysqli_query($conn,"SET NAMES 'UTF8'");

if($conn->connect_error){
  die("連線失敗:". $conn->connect_error);
}
?>