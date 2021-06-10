<?php
  require "ConnectDB.php";
  $input = file_get_contents('php://input');
  $input=json_decode($input);

  $Account=$input->Account;
  $Password=$input->Password;

  $sql = "SELECT * FROM user WHERE Account='$Account' AND Password='$Password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row["Admin"]=='true'){
      echo "管理者";
    }
    else{
      echo "使用者";
    }
  }
  else{
    echo "登入失敗";
  }