<?php
  header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require "ConnectDB.php";

    $sql = "SELECT * FROM post";
    $result = $conn->query($sql);
    $a=array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $b=array("Poster_id"=>$row["Poster_id"],
                   "Itemname"=>$row["Itemname"],
                   "ItemNum"=>$row["ItemNum"],
                   "ImageName"=>$row["ImageName"],
                   "ItemAddress"=>$row["ItemAddress"],
                   "ItemSituation"=>$row["ItemSituation"],
                   "Donate"=>$row["Donate"],
                   "WantItemName"=>$row["WantItemName"],
                   "WantItemSituation"=>$row["WantItemSituation"],
                   "id"=>$row["id"]);
          array_push($a,$b);
        }
    }
    echo json_encode($a);
    $conn->close();
  }
?>