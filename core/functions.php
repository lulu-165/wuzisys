<?php

/** 
 *公共函数集合
 *
 * @author zhouhuixiang
 * @version 1.0
 */


//请求接口数据函数
function send($header, $post_data){
    
    $curl = curl_init(); //curl初始化
    if (isset($_SESSION['runtimeType']) && $_SESSION['runtimeType'] == 2) //测试环境
        curl_setopt($curl, CURLOPT_URL, 'http://10.1.128.59:7002/ncpmsmm/receiveMessage'); //设置curl的地址(测试环境)
    else //正式环境
        curl_setopt($curl, CURLOPT_URL, 'http://10.1.1.211:7002/ncpmsmm/receiveMessage'); //设置curl的地址(正式环境)

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //设置返回响应内容,而不是直接输出
    curl_setopt($curl, CURLOPT_TIMEOUT, 10); //设置超时时间
    if ($header)
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //设置自定义请求头信息
    if ($post_data !== null) {
        curl_setopt($curl, CURLOPT_POST, 1); //将提交方式改为POST
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data); //设置POST要提交的信息
    }
    $result = curl_exec($curl); //执行curl,获取信息
    curl_close($curl); //关闭curl进程，释放资源
    return $result;
}
//初始化数据
function initData($data_type, $data = null)
{
    if (session_status() !== PHP_SESSION_ACTIVE)  session_start();
    $time = date('YmdHis') . '000';
    $header = array('msgSendTime: ' . $time);
    switch ($data_type) {
            //获得物资分类
        case 'classAll':
            $header[] = 'serviceId: GET_ALL_SORT';
            $post_data = array();
            $sname = 'classAll';
            break;
            //获得物资总览
        case 'zonglan':
            $header[] = 'serviceId: GET_DATA_CANGKU';
            $post_data = json_encode($data);
            $sname = 'zonglan_' . json_encode($data);
            break;
            //获得出库订单详情
        case 'dingdan_detail':
            $header[] = 'serviceId: GET_DELIVERY_DETAIL';
            $post_data = json_encode($data);
            //   $sname='dingdan_detail'.json_encode($data);
            break;
            //获得仓库库存信息
        case 'cangku':
            $header[] = 'serviceId: GET_GOODS';
            $post_data = json_encode($data);
            $sname = 'cangku_' . json_encode($data);
            break;
            //获取待出库订单号
        case 'dingdan':
            $header[] = 'serviceId: GET_DELIVERY_NO';
            $post_data = array();
            //      $sname='dingdan';
            break;
            //物资出库
        case 'chuku':
            $header[] = 'serviceId: DELIVERY';
            $post_data = json_encode($data);
            break;
            //出库确认
        case 'chukuqueren':
            $header[] = 'serviceId: MM_WO_10';
            $post_data = json_encode($data);
            break;
            //物资轨迹
        case 'guiji':
            $header[] = 'serviceId: GET_GOODS_ALL_LIFE';
            $post_data = json_encode($data);
            break;
            //获得物资流向
        case 'liuxiang':
            $header[] = 'serviceId: GET_DATA_CANGKU_OVERVIEW';
            $post_data = array();
            $sname = 'liuxiang';
            break;
            //获得仓库消耗信息
        case 'xiaohao':
            $header[] = 'serviceId: GET_EXPEND_GOODS';
            $post_data = json_encode($data);
            $sname = 'xiaohao_' . json_encode($data);
            break;
        default:
            break;
    }
    //需在上面定义三个变量 sname,header,post_data
    if (isset($sname))  //已定义sname，则使用session
    {
        if (isset($_SESSION[$sname]))
            $result = $_SESSION[$sname];
        else {
            $result = json_decode(send($header, $post_data), true);
            if ($result) $_SESSION[$sname] = $result;
        }
    } else    ////未定义sname，则直接请求
    {
        $result = json_decode(send($header, $post_data), true);
    }
    //$result=json_decode(send($header,$post_data),true);
    return $result;
}

/**
 * 浏览器友好的变量输出
 * @param mixed $var 变量
 * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
 * @param string $label 标签 默认为空
 * @param boolean $strict 是否严谨 默认为true
 * @return void|string
 */
function dump($var, $echo = true, $label = null, $strict = true)
{
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo ($output);
        return null;
    } else
        return $output;
}

function getNameFromCode($stationsInfoArr, $cangkuCode)
{

    //echo "aaaa";

    //global $stationsInfoArr;

    //var_dump($stationsInfoArr);


    $returnVal = "";
    foreach ($stationsInfoArr as $key => $val) {

        if ($stationsInfoArr[$key]["logicalNo"] == $cangkuCode) {
            $returnVal = $key;
        }
    }

    return $returnVal;
}
//获取并返回文件内容的json格式
function getFileCon($fpath)
{
    $txtCon = file_get_contents($fpath);
    $txtConJson = json_decode($txtCon, true);
    return $txtConJson;
}
//根据数组内容自动计算百分比
function transToPercent($data)
{
    $total = 0;
    foreach ($data as $value) {
        $total = $total + $value;
    }
    foreach ($data as &$value) {
        $value = round(($value / $total) * 100, 2);
    }
    return $data;
}
//根据仓库号判断改仓库是否属于我们的仓库

function isourcangku($warehouseNo)
{
    global $stationsInfoArr;
    foreach ($stationsInfoArr as $key => $value) {
        if (substr($warehouseNo, 0, strlen($value['logicalNo'])) == $value['logicalNo'])
            return $key;
    }
    return false;
}
