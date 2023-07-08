<?php session_start();
class CailiaoAdminController extends Controller
{

	function addDocument(){
		
		$Model = new Model();
		
		$unitId = $_SESSION['userInfo']['unitId'];
		
		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Cepingxiang_Item_Info limit 1";
		$itemSetInfo = $Model->executeSQL($sql,'select');
		$itemSetInfo = $itemSetInfo['0'];
		if(!$itemSetInfo){
			$itemSetInfo['cpiCurrYear']=date("Y");
			$itemSetInfo['cpiCanEdit']=0;
		}
		
		/*获取全部测评项*/
		$selectYear = $itemSetInfo['cpiCurrYear'];//$_GET['year']?$_GET['year']:date('Y');
		/*获取全部测评项*/
		$sql = "select * from Cepingxiang_Item  where cpxYear=$selectYear order by cpxId asc";
		$cpItemArr = $Model->executeSQL($sql,'select');
		//print_r($cpItemArr);
	 
		/*获取本单位的上报信息*/
		$reportStatus = -1;//默认未上报
		$sql = "select * from Units_CepingSubmitInfo where ucsUid=$unitId and ucsYear=$selectYear";
		$itemSubmitInfo = $Model->executeSQL($sql,'select');
		
		if(!empty($itemSubmitInfo))$reportStatus =  $itemSubmitInfo[0]['ucsStatus'];


		/*获取该部门该年度填写材料的状态*/
		$sql = "select * from Unit_Cepingcontent where cpcYear=$selectYear and unitId=$unitId";
		$cpContentArr_temp = $Model->executeSQL($sql);
		
		$cpContentArr = array();
		//状态（0-未上报、1-待上报，2-待审、3通过、4-修改）默认为0-未上报状态
		$cpcStatusArr=array(
			0=>"未填写",1=>"待上报",2=>"待审",3=>"通过",4=>"修改"
		);
		//把已填写内容数组的下标转换为自己的id
		foreach($cpContentArr_temp as $key=>$val){
			$cpContentArr[$val['cpxId']]=$val;
			$cpContentArr[$val['cpxId']]['cpcStatusTxt']=$cpcStatusArr[$val['cpcStatus']];//添加文字形式的填报状态
			
		}
		 
		
		//递归生成树形数组
		$treeData = array();
		foreach($cpItemArr as $key=>$val){

			$cpxUnits = $val['cpxUnits'];//测评项id
			$cpxUnitArr = explode(",", $cpxUnits); 
			if ($val['isLast']==1 && !$cpxUnits)continue;//|| !in_array($val['unitId'], $cpxUnitArr)
			else if ($val['isLast']==1 && !in_array($unitId, $cpxUnitArr))continue;
			 $treeData[$key]['title'] = $val['cpxName']."(".$cpItemArr[$key]['cpxScore']."分)";//构造分数
			 //.$cpcStatusArr[$val['cpcStatus']];//添加文字形式的填报状态;
			 //if($cpItemArr[$key]['isLast']==1)$treeData[$key]['title'].=$cpContentArr[$val['cpxId']]['cpcStatusTxt'];
			 //设置填报状态
			 $cpcStatusTxt="";
			 if($val['isLast']==1){//只有具体测评项才显示填报状态
				 $cpcStatusNum = $cpContentArr[$val['cpxId']]['cpcStatus'];//状态，数字形式
				  if($cpcStatusNum=="")$cpcStatusNum=0;
				  $cpcStatusTxt=$cpcStatusArr[$cpcStatusNum];//状态，文字形式      		 	
				  $cpcStatusTxt="<span id=cpcStatus_".$val['cpxId']." class='cpcStatus cpcStatusNum_".$cpcStatusNum."'>（".$cpcStatusTxt."）</span>";
			 }
			 $treeData[$key]['title'] .= $cpcStatusTxt;
			 
			 $treeData[$key]['id'] = $val['cpxId'];
			 $treeData[$key]['pid'] = $val['cpxPid'];
			 $treeData[$key]['isLast'] = $val['isLast'];
		}
		

		$treeData = $this->tree_addDocument($treeData,$treeData[0]['pid']);
		
		//print_r($treeData);

		$treeData = json_encode($treeData); //数组树转换成json字符串
		
		 

		$this->assign('cpcStatusArr', $cpcStatusArr);
		$this->assign('cpContentArr', $cpContentArr);
		$this->assign('cpItemArr', $cpItemArr);
		$this->assign('itemSetInfo', $itemSetInfo);
		$this->assign('treeData', $treeData);
		$this->assign('reportStatus', $reportStatus);
	}


	function documentList_see(){
		
		$Model = new Model();
		
		$unitId = $_GET['uid']==""?$_SESSION['userInfo']['unitId']:$_GET['uid'];//$_SESSION['userInfo']['unitId'];
		$uname = $_GET['uname']==""?$_SESSION['userInfo']['unitName']:$_GET['uname'];
		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Cepingxiang_Item_Info limit 1";
		$itemSetInfo = $Model->executeSQL($sql,'select');
		$itemSetInfo = $itemSetInfo['0'];
		if(!$itemSetInfo){
			$itemSetInfo['cpiCurrYear']=date("Y");
			$itemSetInfo['cpiCanEdit']=0;
		}
		
		$itemSetInfo['cpiCurrYear']=$_GET['year'];

		/*获取全部测评项*/
		$selectYear = $itemSetInfo['cpiCurrYear'];//$_GET['year']?$_GET['year']:date('Y');
		/*获取全部测评项*/
		$sql = "select * from Cepingxiang_Item  where cpxYear=$selectYear order by cpxId asc";
		$cpItemArr = $Model->executeSQL($sql,'select');
		//print_r($cpItemArr);
	 
		
		/*获取该部门该年度填写材料的状态*/
		$sql = "select * from Unit_Cepingcontent where cpcYear=$selectYear and unitId=$unitId";
		$cpContentArr_temp = $Model->executeSQL($sql);
		
		$cpContentArr = array();
		//状态（0-未上报、1-待上报，2-待审、3通过、4-修改）默认为0-未上报状态
		$cpcStatusArr=array(
			0=>"未填写",1=>"待上报",2=>"待审",3=>"通过",4=>"修改"
		);
		//把已填写内容数组的下标转换为自己的id
		foreach($cpContentArr_temp as $key=>$val){
			$cpContentArr[$val['cpxId']]=$val;
			$cpContentArr[$val['cpxId']]['cpcStatusTxt']=$cpcStatusArr[$val['cpcStatus']];//添加文字形式的填报状态
			
		}
		 
		
		//递归生成树形数组
		$treeData = array();
		foreach($cpItemArr as $key=>$val){

			$cpxUnits = $val['cpxUnits'];//测评项id
			$cpxUnitArr = explode(",", $cpxUnits); 
			if ($val['isLast']==1 && !$cpxUnits)continue;//|| !in_array($val['unitId'], $cpxUnitArr)
			else if ($val['isLast']==1 && !in_array($unitId, $cpxUnitArr))continue;
			 $treeData[$key]['title'] = $val['cpxName']."(".$cpItemArr[$key]['cpxScore']."分)";//构造分数
			 //.$cpcStatusArr[$val['cpcStatus']];//添加文字形式的填报状态;
			 //if($cpItemArr[$key]['isLast']==1)$treeData[$key]['title'].=$cpContentArr[$val['cpxId']]['cpcStatusTxt'];
			 //设置填报状态
			 $cpcStatusTxt="";
			 if($val['isLast']==1){//只有具体测评项才显示填报状态
				 $cpcStatusNum = $cpContentArr[$val['cpxId']]['cpcStatus'];//状态，数字形式
				  if($cpcStatusNum=="")$cpcStatusNum=0;
				  $cpcStatusTxt=$cpcStatusArr[$cpcStatusNum];//状态，文字形式      		 	
				  $cpcStatusTxt="<span id=cpcStatus_".$val['cpxId']." class='cpcStatus cpcStatusNum_".$cpcStatusNum."'>（".$cpcStatusTxt."）</span>";
			 }
			 $treeData[$key]['title'] .= $cpcStatusTxt;
			 
			 $treeData[$key]['id'] = $val['cpxId'];
			 $treeData[$key]['pid'] = $val['cpxPid'];
			 $treeData[$key]['isLast'] = $val['isLast'];
		}
		

		$treeData = $this->tree_addDocument($treeData,$treeData[0]['pid']);

		//$treeData = $this->tree_documentListSee($treeData,$treeData[0]['pid']);
		//print_r($treeData);
		$treeData = json_encode($treeData); //数组树转换成json字符串
		
		 

		$this->assign('cpcStatusArr', $cpcStatusArr);
		$this->assign('cpContentArr', $cpContentArr);
		$this->assign('cpItemArr', $cpItemArr);
		$this->assign('itemSetInfo', $itemSetInfo);
		$this->assign('treeData', $treeData);
		$this->assign('uname', $uname);
	}


	
	function documentList(){
		$Model = new Model();
		
		$unitId = $_SESSION['userInfo']['unitId'];
		
		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Units_CepingSubmitInfo where ucsUid=$unitId";
		$itemSubmitInfo = $Model->executeSQL($sql,'select');
		
		//print_r($itemSubmitInfo);
        $treeData = json_encode($itemSubmitInfo); //数组树转换成json字符串

		$this->assign('treeData', $treeData);
	 

	}


	

	//递归生成树形数组
	public $i=1;
	private function tree($data,$p_id=0){
		
        foreach($data as $row){
            if($row['pid']==$p_id){	

				$this->i++;
				if($this->i<=2)$row['spread']="true";//设置展开	

				$tmp = $this->tree($data,$row['id']);//递归调用函数
				
                if($tmp){
                    $row['children']=$tmp;
                }else{
                    //$row['leaf'] = true;
				}

				$tree[]=$row; 
						
            }
		}
		
        return $tree;
	}
	private function tree_addDocument($data,$p_id=0){
		
        foreach($data as $row){
            if($row['pid']==$p_id){	

				$this->i++;
				//if($this->i<=2)
				$row['spread']="true";//设置展开	

				$tmp = $this->tree_addDocument($data,$row['id']);//递归调用函数
				
                if($tmp){
                    $row['children']=$tmp;
                }else{
                    $row['leaf'] = true;
				}
				//如不是真正的叶子节点（即没有子节点但判为了叶子）则不显示。
				if($row['leaf'] && $row['isLast']==0)continue;

				$tree[]=$row; 
						
            }
		}
		
        return $tree;
	}
	private function tree_documentListSee($data,$p_id=0){
		
        foreach($data as $row){
            if($row['pid']==$p_id){	

				$row['spread']="true";//设置展开	

				$tmp = $this->tree_documentListSee($data,$row['id']);//递归调用函数
				 
                if($tmp){
                    $row['children']=$tmp;
                }else{
                    //$row['leaf'] = true;
				}

				$tree[]=$row; 
						
            }
		}
		
        return $tree;
	}
}