<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $Account=$input->Account;
    $Password=$input->Password;
    $Name=$input->Name;
    $Email=$input->Email;
    $Phone=$input->Phone;
    $Address=$input->Address;
    $Admin=$input->Admin;
    $sql = "SELECT * FROM user WHERE Account='$Account'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      echo json_encode(array('message'=>"已有重複帳號"));
      http_response_code(403);
    }
    else{
      $sql = "INSERT INTO user(Account,Password,Name,Email,Phone,Address,Admin)
              VALUES ('$Account','$Password','$Name','$Email','$Phone','$Address','$Admin')";
      mysqli_query($conn,$sql);
      echo json_encode(array('message'=>"已新增使用者"));
      http_response_code(201);
    }
  }
?>