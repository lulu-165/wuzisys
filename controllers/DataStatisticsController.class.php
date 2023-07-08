<?php
class DataStatisticsController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        
          
         
         //$Model = new Model(); //建立数据库连接
         //$userArr = $Model ->executeSQL("select * ,test.name as name1,test2.name as name2 from test,test2 where test.age=test2.age and test.age=test2.age");//数据表中的数据总数
          
          
    
        $this->assign("userArr", $userArr);
        //$this->assign("pageTitle", "我是首要");//设置页面标题，默认为空（则显示header.php的默认标题）
         
    }
	public function datastatistics()
    {
        
          
         
         //$Model = new Model(); //建立数据库连接
         //$userArr = $Model ->executeSQL("select * ,test.name as name1,test2.name as name2 from test,test2 where test.age=test2.age and test.age=test2.age");//数据表中的数据总数
          
          
		$a=1;
		$b=2;
		$c=$a+$b;
    
        $this->assign("test", "ffffffffffff");
        //$this->assign("pageTitle", "我是首要");//设置页面标题，默认为空（则显示header.php的默认标题）
         
    }
    
     
}