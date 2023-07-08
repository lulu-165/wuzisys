<?php
include APP_PATH . "/conf/commonInfo.php"; //引入项目共信息
//设置首页为指定页面并跳转
if ($controller == "index") {
	header("Location:/cangkuVision/cangkuMap");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>物资全生命周期管理系统</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<script src="/public/js/jquery-1.8.3.min.js?a1"></script><!-- 引入jquery.js -->
	<script src="/public/layui/layui.js?a2"></script><!-- 引入 layui.js -->
	<link rel="stylesheet" href="/public/layui/css/layui.css?a2" media="all"> <!-- 引入 layui.css -->
	<!-- <script src="/public/js/xlsx.full.min.js"></script> -->
	<style>
		.disable {
			pointer-events: none;
		}

		#header {
			background: #d70b3d;
			/* #1E9FFF #d70b3d; */
			overflow: hidden;
		}

		#layui-logo {
			width: 550px;
			text-align: left;
			font-size: 22px;
			color: #fff;
			margin-left: 15px;
		}

		.layui-nav-tree .layui-nav-item a {
			color: #333 !important;
			border-top: 1px solid #fcfcfc;
			border-bottom: 1px solid #e5e5e5;
			background-color: #f9f9f9;
		}

		.layui-nav .layui-this::after,
		.layui-nav-bar,
		.layui-nav-tree .layui-nav-itemed::after {
			position: absolute;
			left: 0;
			top: 0;
			width: 0;
			height: 5px;
			background-color: #f9f9f9;
			transition: all .2s;
			-webkit-transition: all .2s;
		}

		dd a {
			font-size: 0.9em !important;
			padding-left: 40px !important;
			background-image: url(/public/imgs/right1.png);
			background-position-x: right;
			background-position-y: center;
			background-repeat: no-repeat;
			background-size: 18px;
		}

		dd a:hover {
			background-color: #fff !important;
			background-image: url(/public/imgs/right1.png) !important;
			background-position-x: right !important;
			background-position-y: center !important;
			background-repeat: no-repeat !important;
			background-size: 18px !important;
		}

		.layui-side-scroll {
			background-color: #f9f9f9;
		}

		.layui-nav .layui-nav-more {
			border-color: #fff transparent transparent;
			border-top-color: #aaa;
		}

		.layui-nav .layui-nav-mored,
		.layui-nav-itemed>a .layui-nav-more {
			border-color: transparent transparent #555;
		}

		li a span.layui-nav-more {
			border-color: transparent transparent #aaa;
		}

		#bodyRight {
			margin-top: 60px;
			margin-left: 200px;
			min-width: 1200px;
			padding: 10px;
		}

		.sub-page-header {
			margin: 10px 0;
			font-size: 1.2em;
			padding: 0 0 6px 0;
			border-bottom: 1px solid #ddd;
		}

		.sub-page-header a {
			font-size: 14px;
		}

		.layui-table-header th {
			border: 1px solid #ddd;
			line-height: 32px;
			background-color: #1E9FFF;
			color: #fff;
		}

		.layui-table-main .layui-table,
		.layui-table-header .layui-table {
			width: 100%
		}

		em.layui-laypage-em {
			background-color: #d70b3d !important;
		}

		.layui-table-header th {
			text-align: center;
		}

		td[data-edit="text"] .layui-table-cell:hover,
		td[data-edit="true"] .layui-table-cell:hover {
			border: 1px solid #5FB878 !important;
			background-color: #fff;
		}
	</style>
</head>

<body>
	<div class="mainlayui-layout layui-layout-admin">
		<div id="header" class="layui-header">
			<div id="layui-logo" class="layui-logo">
				<img style="height:32px;width:32px;vertical-align: middle;margin-top:-2px;" src="/public/imgs/logo_nctrain4.png" />
				城市轨道交通线网·物资全生命周期管理
			</div>
			<ul class="layui-nav layui-layout-right">
				<li class="layui-nav-item">
					<button class="layui-btn layui-btn-primary demo1" style="color:#fff;border:none;">
						<?php if($_SESSION['runtimeType']==2)echo '测试环境';else echo '正式环境';?>
						<i class="layui-icon layui-icon-down layui-font-12"></i>
					</button>
				</li>
				<li id="appdown" class="layui-nav-item" style="margin:0 22px 0 0; cursor:pointer;color:#eee;">扫码拣货APP下载</li>
				<li class="layui-nav-item"><?= $_SESSION['userInfo']['uName'] ?></li>
				<li class="layui-nav-item"><a style="color: #fff;" href="/login/logout">退出</a></li>
			</ul>
		</div>
		<script>
			//alert(location.href);
			layui.use(['dropdown', 'util', 'layer', 'table'], function() {
				var dropdown = layui.dropdown;
				//初演示
				dropdown.render({
					elem: '.demo1',
					data: [{
						title: '正式环境',
						type: 1
					}, {
						title: '测试环境',
						type: 2
					}],
					click: function(obj) {
						var type = obj.type;
						$.ajax({
							async: false,
							type: "post",
							data: {
								"type": type
							},
							dataType: 'json',
							url: "../../mvc/views/header_setRuntime.php",
							success: function(res) {
								
								location.reload();
							}
						}); //end ajax
					}
				});
			});
			//弹出扫码拣货APP下载
			$("#appdown").click(function() {
				layer.open({
					type: 1,
					offset: "auto",
					title: false,
					id: 'layerDemo', //防止重复弹出
					content: '<div style="padding: 50px 100px 50px;text-align: center;"><img style="width:220px;height:220px;" src="/app/appdown1000.png.png" /><br>扫二维码.下载扫码拣货APP</div>',
					btnAlign: 'c',
					shade: 0.6, //是否显示遮罩	
					yes: function() {
						layer.closeAll();
					}
				});
			})
		</script>