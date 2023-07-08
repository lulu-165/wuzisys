<!-- 公告页面 -->

<!-- 引入公共CSS -->


<!-- 面包屑导航 -->
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">通知公告</a>
        <a><cite>公告</cite></a>
    </span>
</div>


<!-- 公告列表 -->
<div>
    <table class="layui-table" lay-size="lg">
    <thead>
        <tr>
            <th>标题</th>
            <th>发布用户</th>
            <th>发布时间</th>
            <th>操作</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>系统操作手册</td>
            <td>文明办</td>
            <td>2016-11-29 10:10:10</td>
            <td><span class="layui-btn layui-btn-normal layui-btn-sm showNotice" noticeId="1">查看</span></td>
        </tr>
        <tr>
            <td>华东交通大学高校文明动态管理测评指标</td>
            <td>文明办</td>
            <td>2016-11-29 10:10:10</td>
            <td><span class="layui-btn layui-btn-normal layui-btn-sm showNotice" noticeId="2">查看</span></td>
        </tr>
    </tbody>
    </table>

</div>
<script>
$(document).ready(function(){
    // 绑定按钮
    $(".showNotice").on("click",function(){
        // 获取noticeId属性
        let noticeId = $(this).attr("noticeId")
        showNotice(noticeId)
    })
    function showNotice(noticeId){
        // 从php中循环出
        if(noticeId==1){
            layer.open({
                title: '系统操作手册',
                content: '<i class="layui-icon layui-icon-file-b"></i><a href="./系统操作手册.docx" target="_blank">系统操作手册.docx</a>'
            });
        }
        if(noticeId==2){ 
            layer.open({
                title: '华东交通大学高校文明动态管理测评指标',
                content: '<i class="layui-icon layui-icon-file-b"></i><a href="./华东交通大学高校文明动态管理测评指标.docx" target="_blank">华东交通大学高校文明动态管理测评指标.docx</a>'
            });
        }
        
    }
});


</script>

