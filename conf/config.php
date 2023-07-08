<?php 
/** 
 *常量与配置信息
*/
//数据库连接配置
define('DB_NAME', 'wuzisys');//数据库名
define('DB_USER', 'wuzisys');//账号
define('DB_PASSWORD', 'wz654321');//密码 wzkshsys  wz654321
define('DB_HOST', '121.41.26.77');//填本地：localhost 或服务器IP地址121.41.26.77

define('Domain_Remote', 'http://117.40.249.224:7008');//域名http://117.40.249.224:7008
//设置项目公共变量
define("CURRENT_DIR", "/mvc/views".substr($_SERVER["REQUEST_URI"],0,strripos($_SERVER["REQUEST_URI"],"/")));//执行文件的当前目录
 
 //define("domain", "");