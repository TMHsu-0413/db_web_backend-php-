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
    $a = array();

    $sql="SELECT * FROM request_change WHERE Poster_id='$idx'";
    $sql2="SELECT * FROM request_change WHERE Request_id='$idx'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $id1 = $row["Request_id"];
        $sql3 = "SELECT Name FROM user WHERE id='$id1'";
        $result1 = $conn->query($sql3);
        $row2 = $result1->fetch_assoc();
        $b = array(
          'Itemname' => $row["Request_Item"],
          'Name' => $row2["Name"],
          'ItemNum'=>$row["Request_Num"],
          'success'=>$row["success"]
        );
        array_push($a,$b);
      }
    }
    $result = $conn->query($sql2);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $id1 = $row["Poster_id"];
        $sql3 = "SELECT Name FROM user WHERE id='$id1'";
        $result1 = $conn->query($sql3);
        $row2 = $result1->fetch_assoc();
        $b = array(
          'Itemname' => $row["Poster_Item"],
          'Name' => $row2["Name"],
          'ItemNum'=>$row["Poster_Num"],
          'success'=>$row["success"]
        );
        array_push($a,$b);
      }
    }
    echo json_encode($a);
    $conn->close();
  }
?>