<?php
session_start(); //开启session
//ini_set('display_errors','On');
//ini_set('display_errors', 'Off'); //告警信息类型
date_default_timezone_set('PRC');
//echo time().'<br>'. date("Y-m-d H:i:s"); exit;

//获取账号和密码
$username = $_POST['username'];
$password = $_POST['password'];

require $_SERVER['DOCUMENT_ROOT'] . "/core/Model_Ajax.class.php";
$Model = new Model(); //新建数据库连接

$username = $Model->escape($username); //$_POST['username'];//mysqli_real_escape_string($_POST['username']);
$pwd = $password; //$_POST['password'];
$pwd = MD5($pwd);

if ($username != "" && $pwd != "") {
  //引入数据库模型

  $sql = "select * from user where uName='$username' && pwd='$pwd'";
  
  $res = $Model->executeSQL($sql, 'select');

  //var_dump($res);

  if ($res) { //登录成功，保存session信息，并跳转页面
    $_SESSION['userInfo'] = $res[0]; //保存用户信息
    //if ($_SESSION['userInfo']['isAdmin'] != 1) header('Location: ' . '/index/index');
    //else 
    //header('Location: index.php');
    //exit;

    //保存登录记录
    //保存登录记录,排查用户是否在PHP中的localhost上
    $whitelist = array(
      '127.0.0.1',
      '::1'
    );
    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) { //非localhost 保存退出记录
      $uId = $res[0]['uId'];
      $time = date("Y-m-d H:i:s");
      $loginIp = getUserIp();

      $sql = "insert into useLog  (uId,time_login,loginIp) values($uId,'$time','$loginIp')";
      $res = $Model->executeSQL($sql, 'insert');

      $_SESSION['userInfo']['uLogId'] = $res; //保存登录时间，作为退出时对应的登录标记
    }

     
    echo json_encode($_SESSION['userInfo']);//"/m_scanCode/barcode.html?approver="+approver;
    //if($_GET['dev']=="mobile")header('Location:/m_scanCode/barcode.html?approver='.$_GET['dev']);
    //else header('Location:/cangkuVision/cangkuMap');
    
  } else {
    echo json_encode("error"); //"<script>layer.msg('登陆失败，账号或密码错误！', {icon: 2})</script>";
  }
}


//echo json_encode($sql);
//响应用户退出，重置session
// else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//   if ($_GET['type'] == "logout") unset($_SESSION['userInfo']);
// }

function getUserIp()
{
  if ($_SERVER['REMOTE_ADDR']) {

    $cip = $_SERVER['REMOTE_ADDR'];
  } elseif (getenv("REMOTE_ADDR")) {

    $cip = getenv("REMOTE_ADDR");
  } elseif (getenv("HTTP_CLIENT_IP")) {

    $cip = getenv("HTTP_CLIENT_IP");
  } else {

    $cip = "unknown";
  }

  return $cip;
}
