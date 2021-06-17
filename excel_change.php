<?php
/** PHPExcel */
header('Content-Type:application/json;charset=UTF-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods:GET,POST');
  header('Access-Control-Allow-Headers: *');
require_once "PHPExcel-1.8/Classes/PHPExcel.php";
$fileName ="易物媒合交易紀錄.xlsx";
require "ConnectDB.php";
$sql="select * from request_change";

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
$color_success = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => '93FF93')
    ),
);
$color_fail = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => 'FF5151')
    ),
);
$color_wait = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => 'D0D0D0')
    ),
);
$color_title = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'color'=> array('rgb' => 'FF95CA')
    ),
);
// 給表格新增資料
$objPHPExcel->setActiveSheetIndex(0);             //設定第一個內建表
$objPHPExcel->getActiveSheet()->SetCellValue('A1','交易者A編號');
$objPHPExcel->getActiveSheet()->SetCellValue('B1','交易者A姓名');
$objPHPExcel->getActiveSheet()->SetCellValue('C1','物品');
$objPHPExcel->getActiveSheet()->SetCellValue('D1','數量');
$objPHPExcel->getActiveSheet()->SetCellValue('E1','交易者B編號');
$objPHPExcel->getActiveSheet()->SetCellValue('F1','交易者B姓名');
$objPHPExcel->getActiveSheet()->SetCellValue('G1','物品');
$objPHPExcel->getActiveSheet()->SetCellValue('H1','數量');
$objPHPExcel->getActiveSheet()->SetCellValue('I1','交易狀態');

$objPHPExcel->getActiveSheet()->freezePane('A2');//凍結

$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray($color_title); //標題顏色
$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getFont()->setBold(true);    //標題設粗體
$i=2;
while($row = $result->fetch_array()){
    $sql2="select Name from user where id=".$row['Poster_id'] ;
    $result2=mysqli_query($conn,$sql2);
    $row2 = $result2->fetch_array();
    $sql3="select Name from user where id=".$row['Request_id'] ;
    $result3=mysqli_query($conn,$sql3);
    $row3 = $result3->fetch_array();
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i,$row['Poster_id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i,$row2['Name'] );
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i,$row['Poster_Item']);
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i,$row['Poster_Num']);
    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i,$row['Request_id']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i,$row3['Name']);
    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i,$row['Request_Item']);
    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i,$row['Request_Num']);
    if($row['success']=='1'){
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,'成功');
        $objPHPExcel->getActiveSheet()->getStyle("I".$i)->applyFromArray($color_success);
    }
    else if($row['success']=='0'){
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,'失敗');
        $objPHPExcel->getActiveSheet()->getStyle("I".$i)->applyFromArray($color_fail);
    }
    else{
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i,'待交易');
        $objPHPExcel->getActiveSheet()->getStyle("I".$i)->applyFromArray($color_wait);
    }
        
        $objPHPExcel->getActiveSheet()->getStyle("A".$i.":D".$i)->applyFromArray($color_blue);
        $objPHPExcel->getActiveSheet()->getStyle("E".$i.":H".$i)->applyFromArray($color_purple);
        
    $i++;
}
foreach(range('A','I') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(15); //寬
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