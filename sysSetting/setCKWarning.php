<?php
    include $_SERVER["DOCUMENT_ROOT"]."/core/functions.php";
    $fpath = $_SERVER["DOCUMENT_ROOT"]."/conf/sysSet_cklimitVal.txt";
    $cangkuLimitVal = getFileCon( $fpath);
     
?>

<style>
    #alertTable tr td{
        border:1px solid #ddd;
        padding:0 15px;
    }
    .limitVal{border:0;}
    table th{
        border:1px solid #ddd;
        line-height: 32px;
    }
    table input{
        text-align: center;
        
    }
    .layui-input-inline input {
        margin: 5px;
        height: 28px;
        line-height: 28px !important;
        border: 1px solid #ddd;
    }
</style>
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">系统设置</a>
        <a><cite>设置仓库库存的预警值</cite><i style="color:#f00;margin:0 0 0 2px;" class="layui-icon layui-icon-notice"></i></a>
    </span>
</div>
<div style="margin: 30px 0 0 30px;">
    <div class="layui-inline" style="color:;margin:0 0 5px 0;">请设置各仓库库存的预警阈值（单位: 件）</div>
<table id="alertTable">
    <tr class="tr-th">
        <th>仓库名称</th>
        <th>库存预警值</th>
    </tr>
 <?php foreach($stationsInfoArr as $key=>$val){?>
   <tr><td>
    <div class="layui-inline">
        <div class="layui-input-inline">
            <div class="cangku" value="<?=$key?>"><?=$val['name']?></div>
        </div>
    </div>
  </td><td>
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input value="<?=$cangkuLimitVal[$key]?>" type="number" min="1" style="width:200px;" class="limitVal layui-input" id="limitVal" placeholder="输入数值" autocomplete="off" />
        </div>
    </div>
   </td>
  </tr>
 <?php }?>
 </table>

 <div style="width:500px; text-align:right;margin-top:8px;">
 <button id="submit" style="width: 130px;" type="submit" class="submit layui-btn layui-btn-normal">提交设置</button>
</div>
</div> 
 
 
<script>
    
//提交设置
$("#submit").click(function(e) {
    var cangkuVal = "";//仓库
	var limitVal = "";//预警值
    var data="{";
    var len=<?=count($stationsInfoArr)?>;
    $("#alertTable tr").not(".tr-th").each(function (index, element) {
       
        cangkuVal =$(this).find(".cangku").eq(0).attr("value");//仓库
	    limitVal = $(this).find(".limitVal").eq(0).val();//预警值
        if(limitVal==""){
            return false;
        }
        else if(limitVal<0){
            return false;
        }

        if(index<len-1)data += '"'+cangkuVal+'":'+limitVal+','; 
        else data += '"'+cangkuVal+'":'+limitVal; 
    });

    data += "}";

     //alert(data);
   
     if(limitVal==""){
        layer.msg('请输入预警值！', {icon: 0});
        return false;
    }
    else if(limitVal<0){
        layer.msg('预警值须大于0！', {icon: 0});
        return false;
    }

    $.ajax({
        async:false,
        type: "post",
        data: {
            "data":data
        },
        dataType: 'json',
        url: "/mvc/views/sysSetting/setCKWarning_ajax.php",
        success: function (msg) {
          if(msg != "error")
          {
			  layer.msg('设置阈值成功', {icon: 1});
          }
        },
        error: function (msg) {
            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
    });
});
</script>


