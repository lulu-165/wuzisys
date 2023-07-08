<?php 
/** 
 *公共的信息与配置
*/


//仓库站点经纬度信息
require_once $_SERVER['DOCUMENT_ROOT'] . "/core/Model_Ajax.class.php";
$Model = new Model();
//获取仓库信息
$sql = "select * from cangku";
$cangku = $Model->executeSQL($sql,'select');
$stationsInfoArr = [];
foreach($cangku as $key=>$val){
    $stationsInfoArr[$val['nicName']]['id']=$val['ckId'];
    $stationsInfoArr[$val['nicName']]['name']=$val['name'];
    $stationsInfoArr[$val['nicName']]['logicalNo']=$val['logicalNo'];
    $stationsInfoArr[$val['nicName']]['warehouseNo']=$val['warehouseNo'];
    $stationsInfoArr[$val['nicName']]['bdMapTxtleft']=$val['bdMapTxtleft'];
    $stationsInfoArr[$val['nicName']]['locationLat']=$val['locationLat'];
    $stationsInfoArr[$val['nicName']]['locationLng']=$val['locationLng'];
}