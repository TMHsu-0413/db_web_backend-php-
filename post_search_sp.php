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
    $sql = "SELECT * FROM post WHERE id='$idx'";
    $result = $conn->query($sql);
    $a=array();
    $b=null;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $id = $row["Poster_id"];
          $sql2 ="SELECT Name FROM user WHERE id='$id'";
          $Name = $conn->query($sql2);
          $row2 = $Name->fetch_assoc();
          $b=array("Poster_id"=>$row2["Name"],
                   "Poster_id1"=>$row["Poster_id"],
                   "Itemname"=>$row["Itemname"],
                   "ItemNum"=>$row["ItemNum"],
                   "ImageName"=>$row["ImageName"],
                   "ItemAddress"=>$row["ItemAddress"],
                   "ItemSituation"=>$row["ItemSituation"],
                   "ItemFrom"=>$row["ItemFrom"],
                   "Donate"=>$row["Donate"],
                   "WantItemName"=>$row["WantItemName"],
                   "WantItemSituation"=>$row["WantItemSituation"],
                   "id"=>$row["id"]);
          array_push($a,$b);
        }
    }
    echo json_encode($b);
    $conn->close();
  }
?>