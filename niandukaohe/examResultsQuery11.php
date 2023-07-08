<!-- 考核成绩查询 -->

<!-- 引入公共CSS -->


<!-- 面包屑导航 -->
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">年度考核</a>
        <a><cite>考核成绩查询</cite></a>
    </span>
</div>

<div class="documentTable layui-form" >
    <div class="layui-inline">
        <select id="yearSelect" lay-verify="required">
            <option value ="2021">2021年</option>
        </select>
    </div>
    <div class="layui-inline">
        <input type="text" class="layui-input" id="school" placeholder="学校名称">
    </div>
    <button class="layui-btn layui-btn-normal" data-type="reload">搜索</button>
    <!--<button class="layui-btn " data-type="reload">导出</button>-->
</div>
<table class="layui-hide" id="table" lay-filter="menu-filter"></table>

<script>
$(document).ready(function(){
    // 加载默认列表URL
    defaultUrl = "/public/examResultsTest.json";
    // 按条件搜索的URL
    reloadUrl = "";

    // 加载日期选择组件
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '#dateStart'
        });
        laydate.render({
            elem: '#dateEnd'
        });
    });
    // 加载表单组件-select的样式必须要加载
    layui.use('form', function(){
        var form = layui.form;
        //监听提交 执行操作
        form.on('', function(data){
            return false;
        });
    });
    var table = layui.table;
     //方法级渲染
     table.render({
        elem: '#table',
        url: defaultUrl, 
        cols: [[
            {field:'school', title: '单位名称', align: 'center',width:150},
            {field:'city', title: '所在市', align: 'center',width:100},
            {field:'area', title: '所在县区', align: 'center',width:100},
            {field:'title', title: '考核标准名称', align: 'center',width:300},
            {field:'scoreAll', title: '标准分', align: 'center',width:100},
            {field:'score', title: '得分', align: 'center',width:100},
            {field:'operate', title: '操作', align: 'center',width:200},
        ]],
        id: 'tableReload', 
        page: true,
        height: 312,
        request: {
            pageName: 'page', //页码的参数名称，默认：page
            limitName: 'pageSize', //每页数据量的参数名，默认：limit
            statusName:'status',//数据状态的字段名称，默认：code
            statusCode:200 //成功的状态码，默认：0
      }
     });
     $('.layui-btn').click(function () {
      var inputVal = $('.layui-input').val()
      table.reload('tableReload', {
        url: reloadUrl,
        // ,methods:"post"
        request: {
            pageName: 'page', //页码的参数名称，默认：page
            limitName: 'pageSize' //每页数据量的参数名，默认：limit
        },
        where: {
            query : inputVal
        },
        page: {
            curr: 1
        }
      });
    })
})

</script>


