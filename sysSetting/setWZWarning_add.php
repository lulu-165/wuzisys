<?php 
session_start();

//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$Model = new Model();

$cangku = $_POST['cangku'];
$ckId = $_POST['ckId'];
$class1Name = $_POST['class1'];
$wzName = $_POST['wzName'];
$wzCode = $_POST['wzCode'];
$min = $_POST['warningVal_min'];
$max = $_POST['warningVal_max'];
//接收前端ajax发送的数据

$sql = "insert into wzWarning (ckId,class1Name,wzName,wzCode,min,max)values($ckId,'$class1Name','$wzName','$wzCode',$min,$max)";
 

$res = $Model->executeSQL($sql,'insert');


$msg="success";
 
 
echo json_encode($sql);