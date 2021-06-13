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
    $sql = "DELETE FROM post WHERE id='$idx'";
    $result = $conn->query($sql);
    echo json_encode(array('message'=>"貼文未通過審核!"));
    $conn->close();
  }
?>