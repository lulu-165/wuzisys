<?php
class CangkuVisionController extends Controller
{
 
	public function cangkuMap(){
		
		 
	    //站点经纬度信息
	    $stationsInfo1a = array(
			"nanlu"=>array(
				"name"=>"南路",
				"position"=>"115.795633,28.559044"
			),
			"bayi"=>array(
				"name"=>"八一",
				"position"=>"115.795633,28.559044"
			)
		);	
	
		$this->assign('stationsInfo1a', $stationsInfo);
	}
	public function wuziliuxiangtu(){
		
		 
	    //站点经纬度信息
	    $stationsInfo = "55555555";
	
		$this->assign('stationsInfo', $stationsInfo);
	}
	
}