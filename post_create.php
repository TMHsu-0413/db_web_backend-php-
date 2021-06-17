<?php
  header('Content-Type:application/json');
  header('charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require "ConnectDB.php";
    $input = file_get_contents('php://input');
    $input=json_decode($input);

    $Poster_id=$input->Poster_id;
    $Itemname=$input->Itemname;
    $ItemNum=$input->ItemNum;
    $ImageName=$input->ImageName;
    $ItemAddress=$input->ItemAddress;
    $ItemSituation=$input->ItemSituation;
    $Donate=$input->Donate;
    $WantItemName=$input->WantItemName;
    $WantItemSituation=$input->WantItemSituation;
    $Verify=$input->Verify;
    $ItemFrom=$input->ItemFrom;
    $CanEdit=$input->CanEdit;
    $trade=$input->trade;

    $sql = "INSERT INTO post(Poster_id,
    Itemname,
    ItemNum,
    ImageName,
    ItemAddress,
    ItemSituation,
    Donate,
    WantItemName,
    WantItemSituation,
    Verify,ItemFrom,
    CanEdit,trade
    )
        VALUES ('$Poster_id','$Itemname','$ItemNum','$ImageName','$ItemAddress','$ItemSituation','$Donate','$WantItemName','$WantItemSituation','$Verify','$ItemFrom','$CanEdit','$trade')";
    mysqli_query($conn,$sql);
    echo json_encode(array('message'=>"已新增貼文，待審核"));
    http_response_code(201);
  }
?>