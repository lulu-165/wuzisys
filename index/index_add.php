<?php 


//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";
//实例化模型
$mysqlModel = new Model();
//执行数据库语句
$mysqlModel->executeSQL('insert into test2 (id,name,age)VALUES(5,"cc",19)');

$msg="success";
 

echo json_encode($msg);
