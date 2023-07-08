<?php
class GonggaoController extends Controller
{

    function notice(){
		
		$mysql = new Model();
		
		/*获取全部测评项*/
		$sql = "select * from Notice  order by nId desc";
		$noticeArr = $mysql->executeSQL($sql,'select');
		//print_r($noticeArr);
		 
		//print_r($noticeArr);

		 
		$this->assign('noticeArr', $noticeArr);
	}
	function notice_detail(){
		
		$nid = $_GET['nid'];
		if($nid=="") return;

		$mysql = new Model();
		
		/*获取全部测评项*/
		$sql = "select * from Notice  where nId=$nid limit 1";
		$noticeArr = $mysql->executeSQL($sql,'select');
		$noticeArr = $noticeArr[0];
		if($noticeArr['type']==2)$noticeArr['type_txt']="公告";
		else $noticeArr['type_txt']="通知";
		//print_r($noticeArr);
		 	 
		$this->assign('noticeArr', $noticeArr);
	}



}