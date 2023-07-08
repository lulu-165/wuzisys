<?php 
session_start();

//引入数据库模型
require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

   $Model = new Model();
    //layui传递的分页参数
    $page = $_GET['page']==''?1:$_GET['page']; //第几页
    $limit = $_GET['limit']==''?10:$_GET['limit']; //每页显示几条
    $limit1 = ($page-1)*$limit; //获取数据时的limit开始位置

   $unitId = $_SESSION['userInfo']['unitId'];
	/*获取全部测评项*/
	$sql = "select * from Units_CepingSubmitInfo where ucsUid=$unitId limit $limit1,$limit";
    $itemSubmitInfo = $Model->executeSQL($sql,'select');
    
    //获取总行数
    $sql = "select * from Units_CepingSubmitInfo where ucsUid=$unitId";
    $rows = $Model->executeSQL($sql,'getRow');

    $dataCount=count($itemSubmitInfo);//行数
    $data_con = "";
    $i=1;

    $submitList = array();
    foreach($itemSubmitInfo as $key=>$val){
        $submitList[$key]['year']=$val['ucsYear'];
        $year = $submitList[$key]['year'];
        $submitList[$key]['cepingRootName']=$val['ucsCepingRootName'];
        $submitList[$key]['score']=$val['ucsScore'];
        if($submitList[$key]['score']=="")$submitList[$key]['score']="无";
        $submitList[$key]['submitTime']=$val['submitTime'];
        $submitList[$key]['operate']="<a style='color:#1E9FFF' href='/cailiaoAdmin/documentList_see&year=$year' target='_blank'>查看</a>";
       
    }

$submitList = json_encode($submitList); //数组树转换成json字符串


$data='{ "code": "0", "count": "'.$rows.'","msg": "", "data": '.$submitList.' }';

//print_r($data);
//$data='{ "code": "0", "msg": "", "data": '.$noticeArr.' }';

 echo $data;