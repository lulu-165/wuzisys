<?php  
	require_once '../../../conf/config.php';
	require_once '../../../conf/commonInfo.php';
	require_once '../../../core/functions.php';
	date_default_timezone_set('PRC');
	header("content-type:text/html;charset=utf-8");
	//获得请求参数
	$shiwucode=$_POST['wuziCode'];    //nanlu
	//根据实物码去获取所有数据

	$result=array();
    $result=initData('cangku',array('batchNo'=>$shiwucode))['objectData'];
	if(empty($result))  $code=0;
	else    $code=1;
    
    //判断对应的物资是否存在，不存在则直接返回。
	// if($code==0){
    //     echo json_encode("notExist");//返回二维码
    //     exit;
    // }

	
   //生成物资二维码
	require_once $_SERVER['DOCUMENT_ROOT'].'/public/plugins/phpqrcode/phpqrcode.php';//二维码接口
	
    $wuziCode = $_POST['wuziCode'];
    
    $filename0 = '/upload/erweima/'.$wuziCode.'.png';
    $filename = $_SERVER['DOCUMENT_ROOT'].$filename0;
    
    //判断二维码是否存在
    // if(file_exists($filename0)){//二维码已经存在

    //     echo json_encode($filename0);//返回二维码
    //     exit;

    // }


	//$value = 'http://gis.vipsofts.cn/mvc/views/test/index_erweima_show1.php'; //二维码内容
	$value = Domain_Remote.'/mvc/views/erweima/lifecycle.php?shiwucode='.$wuziCode ;
	$errorCorrectionLevel = 'L';	//容错级别 
	$matrixPointSize = 5;			//生成图片大小  
	
	//生成二维码图片
	QRcode::png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2);  
  
    
    echo json_encode($filename0);//返回二维码
 
 
 

?>