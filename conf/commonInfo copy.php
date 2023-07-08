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




// $stationsInfoArr = array(
// 	"dasha"=>array(
//         "name"=> "2号线-地铁大厦仓库",
//         "logicalNo"=>"01B0303",//逻辑库编号
//         "warehouseNo"=>"01B03",//仓库编号
// 		"bdMapTxtleft"=>"-42",//百度地图标注的文本偏移量
//         "locationLat"=> "115.860099", // 经度
//         "locationLng"=> "28.689512" // 纬度
//     ), 
// 	"bayi"=>array(
//         "name"=> "2号线-八一广场仓库",
//         "logicalNo"=>"02B0305",
//         "warehouseNo"=>"02B03",
// 		"bdMapTxtleft"=>"-42",
//         "locationLat"=> "115.910931",
//         "locationLng"=> "28.680102"
//     ), 
// 	"nanlu"=>array(
//         "name"=> "2号线-南路仓库",
//         "logicalNo"=>"02B0301",
//         "warehouseNo"=>"02B01",
// 		"bdMapTxtleft"=>"-30",//百度地图标注的文本偏移量
//         "locationLat"=> "115.795633",
//         "locationLng"=> "28.559044"
//     ), 
// 	"jianxiu2"=>array(
//         "name"=> "2号线-车辆中心检修二车间仓库",
//         "logicalNo"=>"02B0101",
//         "warehouseNo"=>"02B01",
// 		"bdMapTxtleft"=>"-20",//百度地图标注的文本偏移量
//         "locationLat"=> "115.783241",
//         "locationLng"=> "28.557767"
//     ), 
// 	"weixiu2"=>array(
//         "name"=> "2号线-维修中心机电自动化二车间仓库",
//         "logicalNo"=>"02B0206",
//         "warehouseNo"=>"02B02",
// 		"bdMapTxtleft"=>"-20",//百度地图标注的文本偏移量
//         "locationLat"=> "115.785325",
//         "locationLng"=> "28.558608"
//     ), 
// 	"zongku"=>array(
//         "name"=> "2号线-生米南物资总库",
//         "logicalNo"=>"02A01",
//         "warehouseNo"=>"02A01",
// 		"bdMapTxtleft"=>"-50",//百度地图标注的文本偏移量
//         "locationLat"=> "115.780663",
//         "locationLng"=> "28.556624"
//     ), 
// 	"zapinku"=>array(
//         "name"=> "2号线-生米南杂品库",
//         "logicalNo"=>"02A02",
//         "warehouseNo"=>"02A02",
// 		"bdMapTxtleft"=>"-42",//百度地图标注的文本偏移量
//         "locationLat"=> "115.785029",
//         "locationLng"=> "28.555331"
//     )
// );



//print_r($stationsInfoArr);//stationsInfoArr
//仓库站点经纬度信息
/*
$stationsInfoArr = array(
        "dasha"=>array(
            "name"=> "2号线-地铁大厦仓库",
            "No"=>"01B0303",//逻辑库编号
        ), 
        "bayi"=>array(
            "name"=> "2号线-八一广场仓库",
            "No"=>"02B0305",   
        ), 
        "nanlu"=>array(
            "name"=> "2号线-南路仓库",
            "No"=>"02B0301",
        ), 
        "jianxiu2"=>array(
            "name"=> "2号线-车辆中心检修二车间仓库",
            "No"=>"02B0101",
        ), 
        "weixiu2"=>array(
            "name"=> "2号线-维修中心机电自动化二车间仓库",
            "No"=>"02B0206",
        ), 
        "zongku"=>array(
            "name"=> "2号线-生米南物资总库",
            "No"=>"02A01",
        ), 
        "zapinku"=>array(
            "name"=> "2号线-生米南杂品库",
            "No"=>"02A02",
        )
    );
*/
// //读取设置的仓库库存预警值
// $fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_limitVal.txt";
// $txtCon = file_get_contents($fpath);
// $cangkuLimitVal = json_decode($txtCon,true);

// //读取设置的物资分类的库存预警值
// $fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_wuziClasslimitVal.txt";
// $txtCon2 = file_get_contents($fpath);
// $wuziClassLimitVal = json_decode($txtCon2,true);
