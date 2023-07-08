<?php 
/** 
 *公共的信息与配置
*/


//仓库站点经纬度信息
$stationsInfoArr = array(
	"dasha"=>array(
        "name"=> "2号线-地铁大厦仓库",
        "fullName"=>"2号线维修中心通号2车间01库(地铁大厦裙楼317)",
        "logicalNo"=>"01B03",//逻辑库编号
        "warehouseNo"=>"01B0303",//仓库编号
		"bdMapTxtleft"=>"-42",//百度地图标注的文本偏移量
        "locationLat"=> "115.860099", // 经度
        "locationLng"=> "28.689512", // 纬度
        "useLogical"=>false
    ), 
	"bayi"=>array(
        "name"=> "2号线-八一广场仓库",
        "fullName"=>"2号线站务中心八一广场区域八一广场站1库",
        "logicalNo"=>"02B03",
        "warehouseNo"=>"02B0305",
		"bdMapTxtleft"=>"-42",
        "locationLat"=> "115.910931",
        "locationLng"=> "28.680102", // 纬度
        "useLogical"=>false
    ), 
	"nanlu"=>array(
        "name"=> "2号线-南路仓库",
        "fullName"=>"2号线车辆中心检修2车间3库(2号线车辆中心检修二车间南路驻站室)",
        "logicalNo"=>"02B01",
        "warehouseNo"=>"02B0301",
		"bdMapTxtleft"=>"-30",//百度地图标注的文本偏移量
        "locationLat"=> "115.795633",
        "locationLng"=> "28.559044",
        "useLogical"=>false
    ), 
	"jianxiu2"=>array(
        "name"=> "2号线-车辆中心检修二车间仓库",
        "fullName"=>"2号线车辆中心检修2车间1库(2号线车辆中心检修二车间1库生米南基地运转楼1楼F112)",
        "logicalNo"=>"02B01",
        "warehouseNo"=>"02B0101",
		"bdMapTxtleft"=>"-20",//百度地图标注的文本偏移量
        "locationLat"=> "115.783241",
        "locationLng"=> "28.557767",
        "useLogical"=>false
    ), 
	"weixiu2"=>array(
        "name"=> "2号线-维修中心机电自动化二车间仓库",
        "fullName"=>"2号线维修中心自动化2车间1库",
        "logicalNo"=>"02B02",
        "warehouseNo"=>"02B0206",
		"bdMapTxtleft"=>"-20",//百度地图标注的文本偏移量
        "locationLat"=> "115.785325",
        "locationLng"=> "28.558608",
        "useLogical"=>false
    ), 
	"zongku"=>array(
        "name"=> "2号线-生米南物资总库",
        "fullName"=>"2号线总库工器具库(2号线物资总库库前区（地面）)",
        "logicalNo"=>"02A01",
        "warehouseNo"=>"02A01",
		"bdMapTxtleft"=>"-50",//百度地图标注的文本偏移量
        "locationLat"=> "115.780663",
        "locationLng"=> "28.556624",
        "useLogical"=>true
    ), 
	"zapinku"=>array(
        "name"=> "2号线-生米南杂品库",
        "fullName"=>"2号线杂品库腐蚀品间一(2号线杂品库F1-102)",
        "logicalNo"=>"02A02",
        "warehouseNo"=>"02A02",
		"bdMapTxtleft"=>"-42",//百度地图标注的文本偏移量
        "locationLat"=> "115.785029",
        "locationLng"=> "28.555331",
        "useLogical"=>true
    )
);

// //读取设置的仓库库存预警值
// $fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_limitVal.txt";
// $txtCon = file_get_contents($fpath);
// $cangkuLimitVal = json_decode($txtCon,true);

// //读取设置的物资分类的库存预警值
// $fpath = $_SERVER['DOCUMENT_ROOT']."/conf/sysSet_wuziClasslimitVal.txt";
// $txtCon2 = file_get_contents($fpath);
// $wuziClassLimitVal = json_decode($txtCon2,true);
