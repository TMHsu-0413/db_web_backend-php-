<?php
  require "ConnectDB.php";
  $input = file_get_contents('php://input');
  $input=json_decode($input);

  $Account=$input->Account;
  $Password=$input->Password;
  $Name=$input->Name;
  $Email=$input->Email;
  $Phone=$input->Phone;
  $Address=$input->Address;
  $Admin=$input->Admin;

  $sql = "SELECT * FROM user WHERE Account='$Account'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "重複";
  }
  else{
    $sql = "INSERT INTO user(Account,Password,Name,Email,Phone,Address,Admin)
            VALUES ('$Account','$Password','$Name','$Email','$Phone','$Address','$Admin')";
    mysqli_query($conn,$sql);
    echo "已新增";
  }