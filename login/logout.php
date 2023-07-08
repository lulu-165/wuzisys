<?php
session_start(); //开启session
date_default_timezone_set('PRC');

require $_SERVER['DOCUMENT_ROOT'] . "/core/Model_Ajax.class.php";
$Model = new Model(); //新建数据库连接

//保存退出记录,排查用户是否在PHP中的localhost上
$whitelist = array('127.0.0.1','::1');
if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {//非localhost 保存退出记录
    $uId = $_SESSION['userInfo']['uId'];
    $uLogId = $_SESSION['userInfo']['uLogId'];
    $time = date("Y-m-d H:i:s");
    $action = $_GET['action'];//empty($_GET['action'])?"":$_GET['action'];
    $sql = "update useLog  set time_logout='$time', timeUsed=TIMESTAMPDIFF(SECOND, time_login, '$time' ),action='$action' where uLogId=$uLogId";
    $res = $Model->executeSQL($sql, 'update');
}

 
//正常点击退出/非监听关闭页面或浏览器
if ($_GET['action'] != "monitorBrowser") {
    //清空用户缓存信息
    //header('Location: /login/index&dev=mobile');
    unset($_SESSION['userInfo']);
    header('Location: /login/index&dev='.$_GET['dev']);
}
