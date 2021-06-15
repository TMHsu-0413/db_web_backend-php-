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

    $sql = "SELECT * FROM post WHERE Verify='1' AND Poster_id!='$idx'";
    $result = $conn->query($sql);
    $a=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $id = $row["Poster_id"];
          $sql2 ="SELECT Name FROM user";
          $Name = $conn->query($sql2);
          $row2 = $Name->fetch_assoc();
          $b=array("ImageName"=>$row["ImageName"],
                   "Itemname"=>$row["Itemname"],
                   "poster"=>$row2["Name"],
                   "id"=>$row["id"]);
          array_push($a,$b);
        }
    }
    echo json_encode($a);
    $conn->close();
  }
?>