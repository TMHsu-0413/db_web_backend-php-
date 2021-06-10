<?php
  require "ConnectDB.php";

  $sql = "SELECT * FROM user";
  $result = $conn->query($sql);
  $a=array();
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $b=array("Account"=>$row["Account"],"Password"=>$row["Password"]);
        array_push($a,$b);
      }
  }
  echo json_encode($a);
$conn->close();