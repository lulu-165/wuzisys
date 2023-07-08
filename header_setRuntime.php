<?php 
session_start();



$type = $_POST['type'];
 
$_SESSION['runtimeType']=$type;
 

$msg="success";
 
 
echo json_encode($msg);