<?php
/** PHPExcel */
header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
require_once "PHPExcel-1.8/Classes/PHPExcel.php";
$fileName ="易物媒合貼文資料.xlsx";
require "ConnectDB.php";
$sql="select * from post ";

$result=mysqli_query($conn,$sql);
$objPHPExcel = new PHPExcel();

// 設定檔案屬性
/*$objPHPExcel
->getProperties()  //獲得檔案屬性物件，給下文提供設定資源
->setCreator( "Maarten Balliauw")                 //設定檔案的建立者
->setLastModifiedBy( "Maarten Balliauw")          //設定最後修改者
->setTitle( "Office 2007 XLSX Test Document" )    //設定標題
->setSubject( "Office 2007 XLSX Test Document" )  //設定主題
->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //設定備註
->setKeywords( "office 2007 openxml php")        //設定標記
->setCategory( "Test result file");                //設定類別*/


// 給表格新增資料
$objPHPExcel->setActiveSheetIndex(0);             //設定第一個內建表
$objPHPExcel->getActiveSheet()->SetCellValue('A1','貼文編號');
$objPHPExcel->getActiveSheet()->SetCellValue('B1','上傳者編號');
$objPHPExcel->getActiveSheet()->SetCellValue('C1','上傳者名稱');
$objPHPExcel->getActiveSheet()->SetCellValue('D1','物品名稱');
$objPHPExcel->getActiveSheet()->SetCellValue('E1','物品數量');
$objPHPExcel->getActiveSheet()->SetCellValue('F1','物品位置');
$objPHPExcel->getActiveSheet()->SetCellValue('G1','物品來源');
$objPHPExcel->getActiveSheet()->SetCellValue('H1','物品狀況');
$objPHPExcel->getActiveSheet()->SetCellValue('I1','想交換的物品名稱');
$objPHPExcel->getActiveSheet()->SetCellValue('J1','想交換的物品狀況');
$objPHPExcel->getActiveSheet()->SetCellValue('K1','是否捐贈給系統');

$i=2;
while($row = $result->fetch_array()){
    $sql2="select * from user where id=".$row['Poster_id'];
    $result2=mysqli_query($conn,$sql2);
    $row2 = $result2->fetch_array();
    
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$row['id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$row['Poster_id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$row2['Name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$row['Itemname']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$row['ItemNum']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$row['ItemAddress']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,$row['ItemFrom']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i,$row['ItemSituation']);
    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,$row['WantItemName']);
    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i,$row['WantItemSituation']);
    if($row['Donate']==1){
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i,'是');
    }
    else if($row['Donate']==0){
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i,'否');
    }
    $i++;
}

$objActSheet = $objPHPExcel->getActiveSheet();
$objActSheet->setTitle($fileName); //表的名稱
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save($fileName); //存本機

//使用瀏覽器下載
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
?>