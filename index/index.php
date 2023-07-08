<?php
//设置首页为指定页面并跳转
if($controller=="index"){
	header("Location:/gonggao/notice");  
	exit; 
}
?>

<!-- 首页 -->

<!-- 引入公共CSS -->

<!-- 引入该页面特殊CSS -->
<style>
.welcome-text{
    text-indent: 2em;
    font-size: 17px;
    line-height: 2;
}
</style>
<!-- 面包屑导航 -->
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">首页</a>
        <a><cite>欢迎页</cite></a>
    </span>
</div>

<div class="welcome-text">
<p style="text-align:center; margin:50px 0 0;font-size:1.5em;color:#888;">
<?=$_SESSION['userInfo']['unitName']?>，欢迎使用文明创建信息管理系统！
</p>


 
 