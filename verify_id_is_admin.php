<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin:*');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers:*');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $idx=$input->id;

    $sql = "SELECT Admin FROM user WHERE id='$idx'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo json_encode(array('admin'=>$row['Admin']));
      http_response_code(201);
    }
  }
?>