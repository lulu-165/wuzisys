<?php 
session_start();

//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

$mysql = new Model();
        
    //layui传递的分页参数
    $page = $_GET['page']==''?1:$_GET['page']; //第几页
    $limit = $_GET['limit']==''?10:$_GET['limit']; //每页显示几条
    $limit1 = ($page-1)*$limit; //获取数据时的limit开始位置
    
    /*获取通知公告*/
    $sql = "select * from Notice  order by nId desc limit $limit1,$limit";
    $noticeArr = $mysql->executeSQL($sql,'select');

   //获取总行数
   $sql = "select * from Notice";
   $rows = $mysql->executeSQL($sql,'getRow');
    //$noticeArr = json_encode($noticeArr);//implode($noticeArr);

    //print_r($noticeArr);
    $dataCount=count($noticeArr);
    $data_con = "";
    $i=1;
    foreach($noticeArr as $key=>$val){
        //echo $val['title'].'   ';
        $nid = $val['nId'];
        $time = date("Y-m-d H:i",strtotime($val['time']));
        $title = $val['title'];
        $title = "<a href='notice_detail&nid=$nid' target='_blank' >$title</a>";
        $operate = "查看";
        $operate = "<a href='notice_detail&nid=$nid' target='_blank' >$operate</a>";
        $type = $val['type']==1?"通知":"公告";
        $tail="";
        if($i<$dataCount)$tail=",";
        $data_con .= ' { "title": "'.$title.'","type": "'.$type.'", "time": "'.$time.'", "operate": "'.$operate.'" }'.$tail;

        $i++;
    }

$data='{ "code": "0", "count": "'.$rows.'","msg": "", "data": ['.$data_con.'] }';

//$data='{ "code": "0", "msg": "", "data": '.$noticeArr.' }';

 echo $data;