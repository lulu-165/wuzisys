<?php 
    //require $_SERVER['DOCUMENT_ROOT'].'/conf/commonInfo.php';//引入公共信息
    global $stationsInfoArr;
    require $_SERVER['DOCUMENT_ROOT']."/mvc/views/data_fromThird/wuziliuxiang.php"; 
    //var_dump();
?>

<script src="/public/js/echarts.min-5.2.0.js"></script>
<style>
  
    td{
         
        border: 1px solid #ddd;
        line-height: 32px;
         
    }
    
     th{
         border:1px solid #ddd;
         padding: 5px 0;
         font-size: 1.2em;
     }
     .td-churu{
        width: 65px;
        text-align: center;
     }
     .table2 td{
        border:0;
     }
     .table3 td{
        text-align: center;
        border:1px solid #ddd;
        font-size:0.8em;
     }
     .table3 .td1{
        width: 236px;
        padding-left: 5px;
        text-align: left;
     }
     .table3 .tr1 td{
         border-top: 0;
         font-size:1em;
         background-color:#f0f8ff;
     }
</style>

<div class="tanchu" id="cangkuzonglan" style="padding:14px;margin:10px 0 10px;">
    <table class="table1" style="width: 100%;">
        <tr>
            <th>本仓库名称</th>
            <th>流向详情</th>
        </tr>
        <tr>
            <td style="text-align: center;width:228px;"><?=$stationsInfoArr[$_GET['station']]['name']?></td>
            <td>
                <table class="table2" style="width: 100%;">
                    <tr>
                        <td style="color:#1E9FFF" class="td-churu">流出 >></td>
                        <td>
                            <table class="table3" style="width: 100%;">
                                <tr class="tr1">
                                    <td>仓库名称</td>
                                    <td>数量(件)</td>
                                </tr>
                            <?php $outInfoArr = $liuxiangInfoArr[ $stationsInfoArr[$_GET['station']]["logicalNo"] ]["out"];
                             foreach( $outInfoArr as $key=>$val){
                                 $cangkuKey = getNameFromCode($stationsInfoArr,$key);
                                 ?>
                                <tr>
                                    <td class="td1"><?=$stationsInfoArr[$cangkuKey]["name"]?></td>
                                    <td><?=$val?></td>
                                </tr>
                            <?php }//end for 
                            if(count($outInfoArr)<=0){
                            ?>
                            <tr>
                                <td class="td1" style="text-align:center;">无仓库</td>
                                <td style="text-align:center;">-</td>
                            </tr>
                            <?php }//end if ?>
                            </table style="width: 100%;">
                        </td>
                    </tr>
                    <tr>
                        <td style="color:#094;border-top:1px solid #ddd;" class="td-churu"><< 流入</td>
                        <td>
                            <table class="table3" style="width: 100%;">
                                <tr class="tr1">
                                    <td>仓库名称</td>
                                    <td>数量(件)</td>
                                </tr>
                                <?php $inInfoArr = $liuxiangInfoArr[ $stationsInfoArr[$_GET['station']]["logicalNo"] ]["in"];
                                foreach( $inInfoArr as $key=>$val){
                                    $cangkuKey = getNameFromCode($stationsInfoArr,$key);
                                    ?>
                                    <tr>
                                        <td class="td1"><?=$stationsInfoArr[$cangkuKey]["name"]?></td>
                                        <td><?=$val?></td>
                                    </tr>
                                <?php }//end for 
                                if(count($inInfoArr)<=0){
                                ?>
                                <tr>
                                    <td class="td1" style="text-align:center;">无仓库</td>
                                    <td style="text-align:center;">-</td>
                                </tr>
                                <?php }//end if ?>
                            </table style="width: 100%;">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
         
    </table>
    
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    
    <script type="text/javascript">
        
        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
 
        myChart.setOption({
            series : [
                {
                    name: '资金来源占比',
                    type: 'pie',    // 设置图表类型为饼图
                    radius: '70%',  // 饼图的半径，外半径为可视区尺寸（容器高宽中较小一项）的 80% 长度。
                    data:[          // 数据数组，name 为数据项名称，value 为数据项值
                        <?php echo $funddata; ?>
                    ],
                    label : {
                        normal : {
                            formatter: '{b}:{d}%',
                            textStyle : {
                                fontWeight : 'normal',
                                fontSize : 15
                            }
                        }
                    }
                }
            ]
        })
    
    </script>
</div>