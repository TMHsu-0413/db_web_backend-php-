<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  require "ConnectDB.php";

  $sql = "SELECT * FROM user";
  $result = $conn->query($sql);
  $a=array();
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $b=array("Account"=>$row["Account"],"Password"=>$row["Password"]);
        array_push($a,$b);
      }
  }
  echo json_encode($a);
  $conn->close();
}