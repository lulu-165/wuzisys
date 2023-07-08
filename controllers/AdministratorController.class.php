<?php
class AdministratorController extends Controller
{
 
	function adminCepingItem(){
		
		$Model = new Model();
	   
		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Cepingxiang_Item_Info limit 1";
		$itemSetInfo = $Model->executeSQL($sql,'select');
		$itemSetInfo = $itemSetInfo['0'];
		if(!$itemSetInfo){
			$itemSetInfo['cpiCurrYear']=date("Y");
			$itemSetInfo['cpiCanEdit']=0;
		}
         
	   //获取最大的ID
		$sql = "select MAX(cpxId) from Cepingxiang_Item";
		$maxId = $Model->executeSQL($sql,'select');
		$maxId = $maxId[0]['MAX(cpxId)'];
        //echo "maxId: ".$maxId;
		/*获取全部测评项*/
		$selectYear = $_GET['year']?$_GET['year']:date('Y');
		//echo "selectYear:".$selectYear;
		$sql = "select * from Cepingxiang_Item  where cpxYear=$selectYear order by cpxId asc";
		$cpItemArr = $Model->executeSQL($sql,'select');

		/*获取可以复制测评项的年度*/
		//echo "selectYear:".$selectYear;
		$sql = "select distinct cpxYear from Cepingxiang_Item order by cpxId asc";
		$cpItemCopyYears = $Model->executeSQL($sql,'select');
		//print_r($cpItemCopyYears);

        if(!$cpItemArr){
			$cpItemArr[0]['cpxId']=$maxId+1;//测评项名称
			$cpItemArr[0]['cpxName']="华东交通大学文明校园动态管理测评指标（".$selectYear."）";//测评项名称
			$cpItemArr[0]['cpxScore']=100;//测评项名称
			$cpItemArr[0]['cpxPid']=0;//测评项名称
			$cpItemArr[0]['isLast']=0;//是否为最终节点(具体测评项)
		}
		//print_r($cpItemArr);
	   //$treeData = $this->array_remove_by_key($cpItemArr,sdf);
	  
	   
	   //print_r($cpItemArr);

	   //递归生成树形数组
	   $treeData = array();
       foreach($cpItemArr as $key=>$val){
			$treeData[$key]['title'] = $cpItemArr[$key]['cpxName']."#".$cpItemArr[$key]['cpxScore'];
			$treeData[$key]['id'] = $cpItemArr[$key]['cpxId'];
			$treeData[$key]['pid'] = $cpItemArr[$key]['cpxPid'];
			$treeData[$key]['isLast'] = $cpItemArr[$key]['isLast'];
	   }
       $treeData = $this->tree($treeData,$treeData[0]['pid']);
	   //print_r($treeData);
	   $treeData = json_encode($treeData); //数组树转换成json字符串
       



		//echo "sql:".$sql;
		$rootId = $cpItemArr[0]['cpxId'];
        //是否为具体测评项
		$last = end($cpItemArr); 
		$cpxId_last=$last['cpxId'];
 
		$this->assign('selectYear', $selectYear);
		$this->assign('rootId', $rootId);
		$this->assign('maxId', $maxId);
		$this->assign('cpxId_last', $cpxId_last);
		$this->assign('cpItemArr', $cpItemArr);
		$this->assign('itemSetInfo', $itemSetInfo);
		$this->assign('treeData', $treeData);
		$this->assign('cpItemCopyYears', $cpItemCopyYears);
	}
	
	function assignCepingItem(){
		
		$Model = new Model();

		/*获取全部单位信息（不含管理员）*/
		$sql = "select * from Unit_Info  where isAdmin!=1";
		$unitInfo = $Model->executeSQL($sql,'select');
	   
		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Cepingxiang_Item_Info limit 1";
		$itemSetInfo = $Model->executeSQL($sql,'select');
		$itemSetInfo = $itemSetInfo['0'];
		if(!$itemSetInfo){
			$itemSetInfo['cpiCurrYear']=date("Y");
			$itemSetInfo['cpiCanEdit']=0;
		}
         
	   //获取最大的ID
		$sql = "select MAX(cpxId) from Cepingxiang_Item";
		$maxId = $Model->executeSQL($sql,'select');
		$maxId = $maxId[0]['MAX(cpxId)'];
        //echo "maxId: ".$maxId;
		/*获取全部测评项*/
		$selectYear = $_GET['year']?$_GET['year']:date('Y');
		//echo "selectYear:".$selectYear;
		$sql = "select * from Cepingxiang_Item  where cpxYear=$selectYear order by cpxId asc";
		$cpItemArr = $Model->executeSQL($sql,'select');

		/*获取可以复制测评项的年度*/
		//echo "selectYear:".$selectYear;
		$sql = "select distinct cpxYear from Cepingxiang_Item order by cpxId asc";
		$cpItemCopyYears = $Model->executeSQL($sql,'select');
		//print_r($cpItemCopyYears);

        if(!$cpItemArr){
			$cpItemArr[0]['cpxId']=$maxId+1;//测评项名称
			$cpItemArr[0]['cpxName']="华东交通大学文明校园动态管理测评指标（".$selectYear."）";//测评项名称
			$cpItemArr[0]['cpxScore']=100;//测评项名称
			$cpItemArr[0]['cpxPid']=0;//测评项名称
			$cpItemArr[0]['isLast']=0;//是否为最终节点(具体测评项)
		}
		//print_r($cpItemArr);
	   //$treeData = $this->array_remove_by_key($cpItemArr,sdf);
	  
	   
	   //print_r($cpItemArr);

	   //递归生成树形数组
	   $treeData = array();
	   $alertArr = array();
       foreach($cpItemArr as $key=>$val){
		    $cpxId = $cpItemArr[$key]['cpxId'];//测评项id
			$treeData[$key]['title'] = $cpItemArr[$key]['cpxName']."(".$cpItemArr[$key]['cpxScore']."分)";
			
			$treeData[$key]['id'] = $cpxId;
			
			$treeData[$key]['pid'] = $cpItemArr[$key]['cpxPid'];
			$treeData[$key]['isLast'] = $cpItemArr[$key]['isLast'];

			//弹出单位对于的测评项
			if($val['isLast']==1){//仅叶子节点
				$treeData[$key]['title'] .= ' <botton cpxId='.$cpxId.' class="assignUnit layui-btn layui-btn-xs layui-btn-normal">分配单位</botton>';
				$cpxUnits = $cpItemArr[$key]['cpxUnits'];//测评项id
				$cpxUnitArr = explode(",", $cpxUnits);  
				$alertArr[$cpxId] = "";
				foreach($unitInfo as $key=>$val){
					
						$checked = '';

						//$thisid = $val['unitId'];
						if (in_array($val['unitId'], $cpxUnitArr)){
							$checked = 'checked=""';
						}

						$alertArr[$cpxId] .= '<label class="assignItemList">'.$val['unitName'].' <input name="selectUnit" class="selectUnits" value='.$val['unitId'].' type="checkbox" '.$checked.' >'.'</label>';
						
					}
			}
			 
	   }
	   //print_r($alertArr);

       $treeData = $this->tree_assignCepingItem($treeData,$treeData[0]['pid']);
	   //print_r($treeData);
	   $treeData = json_encode($treeData); //数组树转换成json字符串
       



		//echo "sql:".$sql;
		$rootId = $cpItemArr[0]['cpxId'];
        //是否为具体测评项
		$last = end($cpItemArr); 
		$cpxId_last=$last['cpxId'];
 
		$this->assign('selectYear', $selectYear);
		$this->assign('rootId', $rootId);
		$this->assign('maxId', $maxId);
		$this->assign('cpxId_last', $cpxId_last);
		$this->assign('cpItemArr', $cpItemArr);
		$this->assign('itemSetInfo', $itemSetInfo);
		$this->assign('treeData', $treeData);
		$this->assign('cpItemCopyYears', $cpItemCopyYears);
		$this->assign('alertArr', $alertArr);
	}

	function adminCepingCon(){
		
		$Model = new Model();
		
		
		$selectYear = $_GET['year'];

		/*获取测评项设置，执行年度、开启状态等*/
		$sql = "select * from Cepingxiang_Item_Info limit 1";
		$itemSetInfo = $Model->executeSQL($sql,'select');
		$itemSetInfo = $itemSetInfo['0'];
		if(!$itemSetInfo){
			$itemSetInfo['cpiCurrYear']=date("Y");
			$itemSetInfo['cpiCanEdit']=0;
		}
		
		$itemSetInfo['cpiCurrYear']=$_GET['year'];
        

		/*获取全部单位信息（不含管理员）*/
		$sql = "select * from Unit_Info  where isAdmin!=1";
		$unitInfo = $Model->executeSQL($sql,'select');
		//print_r($unitInfo);

		 
		$selectUnitId = $_GET['uid']!=""?$_GET['uid']:$unitInfo[0]['unitId'];
		
		/*获取全部测评项*/
		$sql = "select * from Cepingxiang_Item  where cpxYear=$selectYear order by cpxId asc";
		$cpItemArr = $Model->executeSQL($sql,'select');
		//print_r($cpItemArr);
	 
		
		/*获取该部门该年度填写材料的状态*/
		$sql = "select * from Unit_Cepingcontent where cpcYear=$selectYear and unitId=$selectUnitId";
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
			 $treeData[$key]['title'] = $val['cpxName']."(".$cpItemArr[$key]['cpxScore']."分)";
			 //.$cpcStatusArr[$val['cpcStatus']];//添加文字形式的填报状态;
			 //if($cpItemArr[$key]['isLast']==1)$treeData[$key]['title'].=$cpContentArr[$val['cpxId']]['cpcStatusTxt'];
			 //设置填报状态
			 $cpcStatusTxt="";
			 if($val['isLast']==1){//只有具体测评项才显示填报状态
				 $cpcStatusNum = $cpContentArr[$val['cpxId']]['cpcStatus'];//状态，数字形式
				  if($cpcStatusNum=="")$cpcStatusNum=0;
				  $cpcStatusTxt=$cpcStatusArr[$cpcStatusNum];//状态，文字形式      		 	
				  $cpcStatusTxt="<span id=".$val['cpxId']." class=cpcStatusNum_".$cpcStatusNum.">（".$cpcStatusTxt."）</span>";
			 }
			 $treeData[$key]['title'] .= $cpcStatusTxt;
			 
			 $treeData[$key]['id'] = $val['cpxId'];
			 $treeData[$key]['pid'] = $val['cpxPid'];
			 $treeData[$key]['isLast'] = $val['isLast'];
		}
		//print_r($treeData);

		$treeData = $this->tree_documentListSee($treeData,$treeData[0]['pid']);
		//print_r($treeData);
		$treeData = json_encode($treeData); //数组树转换成json字符串
		
		 
		

        $this->assign('selectYear', $selectYear);
		$this->assign('cpcStatusArr', $cpcStatusArr);
		$this->assign('cpContentArr', $cpContentArr);
		$this->assign('cpItemArr', $cpItemArr);
		$this->assign('itemSetInfo', $itemSetInfo);
		$this->assign('treeData', $treeData);
		$this->assign('unitInfo', $unitInfo);
		$this->assign('selectUnitId', $selectUnitId);
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

	private function tree_assignCepingItem($data,$p_id=0){
		
        foreach($data as $row){
			$row['spread']="true";//设置全部展开	
            if($row['pid']==$p_id){	

				$this->i++;
				
				 	
				$tmp = $this->tree_assignCepingItem($data,$row['id']);//递归调用函数
				 
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