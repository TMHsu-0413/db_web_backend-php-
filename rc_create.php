<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $Request_id=$input->Request_id;
    $Request_Item=$input->Request_Item;
    $Request_Num=$input->Request_Num;
    $Poster_id=$input->Poster_id;
    $Poster_Item=$input->Poster_Item;
    $Poster_Num=$input->Poster_Num;
    $changed=$input->changed;

    $sql = "INSERT INTO request_change(Request_id,Request_Item,Request_Num,Poster_id,Poster_Item,Poster_Num,changed)
            VALUES ('$Request_id','$Request_Item','$Request_Num','$Poster_id','$Poster_Item','$Poster_Num','$changed')";
    mysqli_query($conn,$sql);
    echo json_encode(array('message'=>"已發出交換請求!"));
    http_response_code(201);
  }
?>