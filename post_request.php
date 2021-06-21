<?php
  header('Content-Type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);
    $idx = $input->id;
    $a=array();

    $sql = "SELECT * FROM request_change WHERE Poster_id='$idx' AND changed='0'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id1 = $row["Request_id"];
        $sql2 = "SELECT Name FROM user WHERE id='$id1'";
        $result1 = $conn->query($sql2);
        $row2 = $result1->fetch_assoc();
        $b = array("Request_Item"=>$row["Request_Item"],
                   "Request_Name"=>$row2["Name"],
                   "Request_Num"=>$row["Request_Num"],
                   "id"=>$row["id"],
                   "Poster_id"=>$row["Poster_id"],
                   "Poster_Item"=>$row["Poster_Item"],
                   "Poster_Num"=>$row["Poster_Num"],
                   "Poster_primary"=>$row["Poster_primary"]);
        array_push($a,$b);
      }
    }
    echo json_encode($a);
    $conn->close();
  }
?>