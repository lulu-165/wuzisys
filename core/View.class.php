<?php
/**
 *视图基类
 *
 * @author zhouhuixiang
 * @version 1.0
*/
class View
{
    protected $variables = array();
    protected $_controller;
    protected $_action;
 
    function __construct($controller, $action)
    {
 		$this->_controller = $controller;
        $this->_action = $action;
    }
    /** 分配变量 **/
    function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }
    /** 渲染显示 **/
    function render()
    {
 		$action = $this->_action;
		$controller = $this->_controller;
		$controllerNameForView=$this->_controller;//视图文件夹大小写敏感。
		extract($this->variables);
        $defaultHeader = APP_PATH . 'mvc/views/header.php';//默认头部
        $defaultLeft = APP_PATH . 'mvc/views/left.php';//默认左侧
		$defaultFooter = APP_PATH . 'mvc/views/footer.php';//默认底部
        $controllerHeader = APP_PATH . 'mvc/views/' . $controllerNameForView . '/header.php';//自定义头部
		$controllerLeft = APP_PATH . 'mvc/views/' . $controllerNameForView . '/left.php';//自定义头部
        $controllerFooter = APP_PATH . 'mvc/views/' . $controllerNameForView . '/footer.php';//自定义底部
        //页头文件
        if (file_exists($controllerHeader)) {
            include ($controllerHeader);
        } else {
            include ($defaultHeader);
        }
		
		//左侧
		//include ($defaultLeft);
		if (file_exists($controllerLeft)) {
            include ($controllerLeft);
        } else {
            include ($defaultLeft);
        }	
				
		//页内容文件
        $fname = $action . '.php';//$this->_action . '.php';
        if(strpos($action,".")!==false) $fname = $action;
		$pagefile_Path = APP_PATH . 'mvc/views/' . $controllerNameForView . '/' . $fname;
		
        //echo  $pagefile_Path;
        if (file_exists($pagefile_Path)) {
			    include ($pagefile_Path);
		}else{
			echo '<br><a href="/" >返回首页</a><br>';
			echo '<br>页面不存在：'.$pagefile_Path.'<br><br>';
		}
		
        //页脚文件
        if (file_exists($controllerFooter)) {
            include ($controllerFooter);
        } else {
            include ($defaultFooter);
        }
    }
}