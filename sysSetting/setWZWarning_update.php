<?php 
session_start();

//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
$Model = new Model();

$wId = $_POST['wId'];
$min = $_POST['min'];
$max = $_POST['max'];
//接收前端ajax发送的数据

//$sql = "insert into wzWarning (ckId,class1Name,wzName,wzCode,min,max)values($ckId,'$class1Name','$wzName','$wzCode',$min,$max)";
$sql = "update wzWarning set min=$min,max=$max where wId=$wId";

$res = $Model->executeSQL($sql,'update');


$msg="success";
 
 
echo json_encode($msg);