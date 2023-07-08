<?php session_start();
include '../../../conf/commonInfo.php';
include '../../../conf/comInfo_setWZWarning.php';
include '../../../core/functions.php';

$fpath = $_SERVER["DOCUMENT_ROOT"]."/conf/sysSet_wzlimitVal.txt";
$cangkuLimitArr = getFileCon( $fpath);
//
//var_dump($wzWarningArr);
//获得请求参数
//$page=$_GET['page'];//当前页
//$limit=$_GET['limit'];//每页的数量
$currCangKey =  $_GET['currCangKey']==""?"all":$_GET['currCangKey']; 

$result=array();

$i=0;
//var_dump($stationsInfoArr);

//require $_SERVER['DOCUMENT_ROOT']."/core/Model_Ajax.class.php";

 $ckIds = $_SESSION['userInfo']['ckIds'];//该用户管理的仓库编号集合

 $Model = new Model();
//获取信息
$sql = "select * from cangku where ckId in($ckIds)";
$user_cangku = $Model->executeSQL($sql,'select');
$user_cangkArr = [];
foreach($user_cangku as $key=>$val){
    array_push($user_cangkArr,$val['nicName']);
}
//var_dump($user_cangkArr);
 
                foreach($cangkuLimitArr as $key=>$val){
                    //if($val["cangku"]==$cangku && $val["wzCode"]==$warningData["wzCode"]){
                        $warningVal_min = $val["warningVal_min"];
                        $warningVal_max = $val["warningVal_max"]; 
                    //}

                    $cangku = $val["cangku"];
                    $ckName = $stationsInfoArr[$cangku]['name'];

                    if($ckIds!="0" && !in_array($cangku,$user_cangkArr)) continue;


                    if($currCangKey=="all" || $cangku==$currCangKey){
                        $result[$i]['cangku'] = '<span val="'.$cangku.'">'.$ckName.'</span>';
                    }else{
                       // if($cangku==$currCangKey)
                        $result[$i]['cangku'] = '<span class="hidden" val="'.$cangku.'">'.$ckName.'</span>';
                        //else 
                    }
                    $result[$i]['class1']=$val["class1"];
                    $result[$i]['wzName']=$val["wzName"];
                    $result[$i]['wzCode']=$val["wzCode"];

                    $result[$i]['warningVal_max']='<input value="'.$warningVal_max.'" type="number" min="0" style="width:50px;" class="limitVal layui-input" placeholder="输入数值" autocomplete="off" />';
                    $result[$i]['warningVal_min']='<input value="'.$warningVal_min.'" type="number" min="0" style="width:50px;" class="limitVal layui-input" placeholder="输入数值" autocomplete="off" />';
                    $result[$i]['operation']='<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>';
                    $i++;

                }
            

                array_multisort(array_column($result,'cangku'),SORT_ASC,$result);//按仓库排序

    //var_dump($result);

//整理输出
$count=count($result);
$data=array('code'=>0,'count'=>$count,'msg'=>'','data'=>$result);
echo json_encode($data,JSON_UNESCAPED_UNICODE);
