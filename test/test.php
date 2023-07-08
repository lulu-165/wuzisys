<?php
	function send($header,$post_data){
		$curl=curl_init();//curl初始化
		curl_setopt($curl,CURLOPT_URL,'http://10.1.128.59:7002/ncpmsmm/receiveMessage'); //设置curl的地址
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); //设置返回响应内容,而不是直接输出
		curl_setopt($curl,CURLOPT_TIMEOUT,5);//设置超时时间
		if($header)
        	curl_setopt($curl,CURLOPT_HTTPHEADER,$header); //设置自定义请求头信息
		if($post_data!==null)
		{
			curl_setopt($curl,CURLOPT_POST,1); //将提交方式改为POST
			curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data); //设置POST要提交的信息
		}
		$result=curl_exec($curl); //执行curl,获取信息
		curl_close($curl); //关闭curl进程，释放资源
		return $result;
	}
	//发送时间参数构造
	$time=date('YmdHis').'000';
	echo $time;
	//获取仓库库存信息
	// $header=array('serviceId: GET_GOODS','msgSendTime: 20210515142000000');
	// $data=json_encode(array("warehouseNo"=>'01A0103'));
	// $result=send($header,$data);
	//获取物资分类
	// $header=array('serviceId: GET_ALL_SORT','msgSendTime: 20210515142000000');
	// $result=send($header,array());
	// var_dump($result);
	
?>

 