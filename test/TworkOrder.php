<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>高铁检修综合管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="Mosaddek" name="author" />
    <link href="/public/css/bootstrap.min.css?v=0.101" rel="stylesheet" />
    <link href="/public/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="/public/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="/public/css/style.css" rel="stylesheet" />
    <link href="/public/css/style-responsive.css" rel="stylesheet" />
    <link href="/public/css/style-default.css" rel="stylesheet" id="style_color" />
    <link href="/public/css/bootstrap-fullcalendar.css" rel="stylesheet" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
   <!-- BEGIN header-left -->
   <?php include APP_PATH."/application/views/header-left.php"; //包含公共的头部和左侧 ?>
   <!-- END header-left -->
   
  <!-- BEGIN CONTAINER -->
  <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN THEME CUSTOMIZER-->
                    <div id="theme-change" class="hidden-phone">
                        <img src="/public/images/setting.png" width="20px" height="20px">
                        <span class="settings">
                            <span class="text">主题颜色:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-gray" data-style="gray"></span>
                            </span>
                        </span>
                    </div>
                    <!-- END THEME CUSTOMIZER-->
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title" style="color:#000">
                       今日工单
                    </h3>
                    <ul class="breadcrumb">
                        <li>
                            <a href="index.php">主页</a>
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">作业管理</a>
                            <span class="divider">/</span>
                        </li>
                        <li class="active">
                            今日工单
                            <span class="divider">/</span>
                        </li>
                        <li>
                            <a href="#">添加</a>

                        </li>
                        <li class="pull-right search-wrap">
                            <form action="search_result.html" class="hidden-phone">
                                <div class="input-append search-input-area">
                                    <input class="" id="appendedInputButton" type="text">
                                    <button class="btn" type="button"><img src="/public/images/search.png" width="40px" height="40px"></button>
                                </div>
                            </form>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div id="page-wraper">

                <div class="row-fluid">
                    <div class="span6">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> 工单表</h4>
                                <span class="tools">
                                <a href="javascript:;" class="icon-remove">
                                    <img src="/public/images/remove.png" width="30px" height="30px"/>
                                </a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th colspan="3">工单编号：XXXXX</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="3">任务地点：XXXXXXXXX</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">任务负责人：XXX</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">下发时间：XXXXXXX</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">执行时间：XXXXXXXXXX</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                <div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN BASIC PORTLET-->
                        <div class="widget orange">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> 工具表</h4>
                                <span class="tools">
                                <a href="javascript:;" class="icon-remove">
                                    <img src="/public/images/remove.png" width="30px" height="30px"/>
                                </a>
                            </span>
                            </div>
                            <div class="widget-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>工具编号</th>
                                        <th>工具名称</th>
                                        <th>工具负责人</th>
                                        <th>备注</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>001</a></td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >002</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >003</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >004</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >005</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >006</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >007</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >008</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td >009</td>
                                        <td>XXX</td>
                                        <td>XXXX</td>
                                        <td>XXX</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">XXXXXXX</td>
                                        <td colspan="2">XXXXXXX</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END BASIC PORTLET-->
                    </div>
                </div>

            </div>

            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</div>
<!-- END CONTAINER -->



<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script src="/public/js/jquery-1.8.3.min.js"></script>
<script src="/public/js/jquery.nicescroll.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/jquery.scrollTo.min.js"></script>

<!-- ie8 fixes -->
<!--[if lt IE 9]>
<!--<script src="/public/js/excanvas.js"></script>-->
<!--<script src="/public/js/respond.js"></script>-->
<![endif]-->


<!--common script for all pages-->
<script src="/public/js/common-scripts.js"></script>

 