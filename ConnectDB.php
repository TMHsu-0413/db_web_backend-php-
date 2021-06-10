<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($server,$username,$password,$dbname);

mysqli_query($conn,"SET NAMES 'UTF8'");

if($conn->connect_error){
  die("連線失敗:". $conn->connect_error);
}
else{
  echo "連線成功<br>";
}
?>