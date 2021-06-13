<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin:*');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers:*');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $Account=$input->Account;
    $Password=$input->Password;

    $sql = "SELECT * FROM user WHERE Account='$Account' AND Password='$Password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $tmp = array(
        'id' => $row["id"],
        'admin' => $row["Admin"],
        'message' => "歡迎! "
      );
      echo json_encode($tmp);
      http_response_code(201);
    }
    else{
      $tmp = array(
        'message' => "帳號或密碼錯誤"
      );
      echo json_encode($tmp);
      http_response_code(403);
    }
  }
?>