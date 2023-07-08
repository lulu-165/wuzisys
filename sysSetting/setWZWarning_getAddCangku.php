<?php 
session_start();

//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

//接收前端ajax发送的数据
  
 
$ckIds = $_SESSION['userInfo']['ckIds'];//该用户管理的仓库编号集合

$Model = new Model();
//获取信息
if($ckIds=="0")
    $sql = "select * from cangku";
else
    $sql = "select * from cangku where ckId in($ckIds)";

$res = $Model->executeSQL($sql,'select');


$msg="success";
 
 
echo json_encode($res);