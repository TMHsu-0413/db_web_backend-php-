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
    $primary = $input->primary;

    $sql="SELECT ItemNum FROM post WHERE id=$primary"; //取貼文的物品數量
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ItemNum=$row['ItemNum'];

    $sql="SELECT Poster_Num FROM request_change WHERE id='$idx'"; //取想交換的物品數量
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $Poster_Num=$row['Poster_Num'];

    if($ItemNum==$Poster_Num){
      $sql = " DELETE FROM post WHERE id='$primary'";
      $result = $conn->query($sql);
    }
    else{
      $ItemNum-=$Poster_Num;
      $sql = "UPDATE post SET ItemNum='$ItemNum' WHERE id='$primary'";
      $result = $conn->query($sql);
    }
    $sql = "UPDATE request_change SET success='1',changed='1' WHERE id='$idx'";
    $result = $conn->query($sql);
    echo json_encode(array('message'=>"已同意交換!"));
    http_response_code(201);
    $conn->close();
  }
?>