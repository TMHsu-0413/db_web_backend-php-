<?php
header('Content-Type:application/json;charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:GET,POST');
header('Access-Control-Allow-Headers: *');
/** PHPExcel */
require_once "PHPExcel-1.8/Classes/PHPExcel.php";
require "ConnectDB.php";
$fileName ="易物媒合用戶資料.xlsx";
$sql="select * from user where Admin='1'";
$result=mysqli_query($conn,$sql);
$sql2="select * from user where Admin='0'";
$result2=mysqli_query($conn,$sql2);
$objPHPExcel = new PHPExcel();
$color_title = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => 'FF95CA')
    ),
);
$color_blue = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => '97CBFF')
    ),
);
$color_purple = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => 'B9B9FF')
    ),
);
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

$objPHPExcel->getActiveSheet()->freezePane('A2');//凍結

$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->applyFromArray($color_title);//標題顏色
$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);  //標題設粗體
// 給表格新增資料
$objPHPExcel->setActiveSheetIndex(0);             //設定第一個內建表
$objPHPExcel->getActiveSheet()->SetCellValue('A1','編號');
$objPHPExcel->getActiveSheet()->SetCellValue('B1','帳號');
$objPHPExcel->getActiveSheet()->SetCellValue('C1','姓名');
$objPHPExcel->getActiveSheet()->SetCellValue('D1','Email');
$objPHPExcel->getActiveSheet()->SetCellValue('E1','手機');
$objPHPExcel->getActiveSheet()->SetCellValue('F1','地址');
$objPHPExcel->getActiveSheet()->SetCellValue('G1','權限');
$i=2;
while($row = $result->fetch_array()){
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$row['id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$row['Account']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$row['Name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$row['Email']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$row['Phone']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$row['Address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'管理者');
    $objPHPExcel->getActiveSheet()->getStyle("A".$i.":G".$i)->applyFromArray($color_blue);
    $i++;
} 
while($row2 = $result2->fetch_array()){
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$row2['id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$row2['Account']);
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$row2['Name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$row2['Email']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$row2['Phone']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$row2['Address']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,'使用者');
    $objPHPExcel->getActiveSheet()->getStyle("A".$i.":G".$i)->applyFromArray($color_purple);
    $i++;
}

foreach(range('A','G') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(15);//寬
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