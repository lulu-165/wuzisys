<?php 
/** 
 *控制器基类
 *
 *功能：包括控制器、模型和视图的基类，控制器的主要功能就是总调度。Controller 类实现所有控制器、模型和视图（View类）的通信。在执行析构函数时，可以调用 render() 来显示视图（view）文件
 * @author zhouhuixiang
 * @version 1.0
*/
class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;
    //构造函数，初始化属性，并实例化对应模型
    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }
    //分配变量
    function assign($name, $value)
    {
        $this->_view->assign($name, $value);
    }
    //渲染视图
    function __destruct()
    {
        $this->_view->render();
    }
}