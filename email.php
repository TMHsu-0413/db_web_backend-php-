<?php
header('Content-Type:application/json;charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:GET,POST');
header('Access-Control-Allow-Headers: *');
require_once('PHPMailer-5.2-stable/PHPMailerAutoload.php');
require "ConnectDB.php";
$input=file_get_contents('php://input');
$input=json_decode($input);
$userid=$input->userid;

//$name=$_POST['name'];
$itemName=$input->itemName;
$sql="select * from user where id='".$userid."'";

$result=mysqli_query($conn,$sql);
$row = $result->fetch_assoc();
$name=$row['Name'];
$email=$row['Email'];

$mail= new PHPMailer();  
$mail->isSMTP();    
$mail->SMTPAuth=true;  
$mail->SMTPSecure="ssl";
$mail->Host = "smtp.gmail.com";  
$mail->Port = "465";   
$mail->CharSet = "utf-8"; 
$mail->isHTML();



$mail->Username="dbtest109@gmail.com"; //寄信端
$mail->Password = "nfudbtest109";  
$mail->setFrom("dbtest109@gmail.com");

$mail->Subject = "易物媒合系統-審核未通過!";   //標題
$mail->Body = $name."您好，您的".$itemName."貼文未通過審核，請修改後再重新上傳，謝謝。"; //內容

$mail->AddAddress($email);    //收信端
 
if(!$mail->Send()) {   
    echo "Mailer Error: " . $mail->ErrorInfo;   
    } else {   
    echo "Message sent!";   
    }
?>