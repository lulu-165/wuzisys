<?php
$data=array();
//一级菜单
$data[]=array('id'=>'01','value'=>'劳保用品');
$data[]=array('id'=>'02','value'=>'消防用品');
//二级菜单
$data[0]['data'][]=array('id'=>'0101','value'=>'手、足、坠落等防护类');
$data[0]['data'][]=array('id'=>'0102','value'=>'头、面、眼、呼吸道、耳等防护类');
$data[1]['data'][]=array('id'=>'0201','value'=>'灭火器材');
//三级菜单
$data[0]['data'][0]['data'][]=array('id'=>'010101','value'=>'安全带');
$data[0]['data'][0]['data'][]=array('id'=>'010102','value'=>'手套');
$data[0]['data'][0]['data'][]=array('id'=>'010103','value'=>'手环');
$data[0]['data'][1]['data'][]=array('id'=>'010201','value'=>'护目镜');
$data[0]['data'][1]['data'][]=array('id'=>'010202','value'=>'焊接防护眼罩');
$data[1]['data'][0]['data'][]=array('id'=>'020101','value'=>'推车式干粉灭火器');
$data[1]['data'][0]['data'][]=array('id'=>'020102','value'=>'手提式干粉灭火器');
$data = json_encode($data); //数组树转换成json字符串
echo $data;

?>