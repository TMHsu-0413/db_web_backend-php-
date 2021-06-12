<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $id=$input->id;

    $sql = "SELECT * FROM user WHERE id='$id'";
    $result = $conn->query($sql);
    $a=array();
    $b=null;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $b=array("Email"=>$row["Email"],
          "Address"=>$row["Address"],
          "Phone"=>$row["Phone"]);
        }
    }
    echo json_encode($b);
    $conn->close();
  }
?>