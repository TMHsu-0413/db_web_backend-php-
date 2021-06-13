<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $idx = $input->id;
    $Password = $input->Password;
    $Phone = $input->Phone;
    $Address = $input->Address;
    $Email = $input->Email;

    $sql = "UPDATE user SET Password='$Password',Phone='$Phone',Address='$Address',Email='$Email'  WHERE id='$idx'";
    $result = $conn->query($sql);
    echo json_encode(array('message'=>"成功修改資料"));
    http_response_code(201);
    $conn->close();
  }
?>