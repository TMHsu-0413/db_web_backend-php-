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
    $Itemname=$input->Itemname;
    $ItemNum=$input->ItemNum;
    $ImageName=$input->ImageName;
    $ItemAddress=$input->ItemAddress;
    $ItemSituation=$input->ItemSituation;
    $Donate=$input->Donate;
    $WantItemName=$input->WantItemName;
    $WantItemSituation=$input->WantItemSituation;
    $ItemFrom=$input->ItemFrom;

    $sql = "UPDATE post SET Itemname='$Itemname',ItemNum='$ItemNum',ImageName='$ImageName'
    ,ItemAddress='$ItemAddress',ItemSituation='$ItemSituation',
    Donate='$Donate',WantItemName='$WantItemName',WantItemSituation='$WantItemSituation'
    ,ItemFrom='$ItemFrom'  WHERE id='$idx'";
    $result = $conn->query($sql);
    echo json_encode(array('message'=>"已成功修改"));
    http_response_code(201);
    $conn->close();
  }
?>