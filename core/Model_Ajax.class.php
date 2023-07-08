<?php
/**
 *模型基类
 *
 * @author zhouhuixiang
 * @version 1.0
*/
require_once $_SERVER['DOCUMENT_ROOT']."/conf/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/core/Sql.class.php";  

class Model extends Sql
{
    protected $_model;
    protected $_table;
    function __construct()
    {
        //连接数据库
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);  
    }
    function __destruct()
    {
    }
}