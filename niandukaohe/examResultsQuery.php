<style>
.layui-table thead tr{
  background-color: #009688;
  color:#fff;
}
.layui-table-sort i.layui-edge{
  border-bottom-color: #fff;
  border-top-color: #fff;
}
</style>
<!-- 面包屑导航 -->
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">材料管理</a>
        <a><cite>本单位（<?=$_SESSION['userInfo']['unitName']?>）考核结果</cite></a>
    </span>
</div>

<table id="demo" lay-filter="test"></table>
 
<script>
layui.use('table', function(){
  var table = layui.table;
  
  //第一个实例
  table.render({
    elem: '#demo'
    ,height: 465
    ,width: 724
    ,url: '<?=CURRENT_DIR?>/data_examResultsQuery.php' //数据接口
    ,page: true //开启分页
    ,cols: [[ //表头
      //{field: 'id', title: '序号', sort: true, fixed: 'left', width:80},
      {field: 'year', title: '年度', sort: true, width:80},
      {field: 'cepingRootName', title: '考核标准名称', width:560},
      {field: 'score', title: '成绩', sort: true, width:80} ,
       
      
    ]]
  });
  
});
</script>
