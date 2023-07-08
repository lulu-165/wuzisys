<style>
  #layui-nav-tree a.currentSNav {
    color: #d70b3d !important;
  }

  .layui-nav-item a svg {
    font-weight: 600;
  }

  .layui-nav-itemed svg,
  .layui-nav-itemed i.layui-icon {
    fill: #d70b3d !important;
    color: #d70b3d !important;
  }

  .layui-nav-tree .layui-nav-item a {
    font-size: 1.1em;
    padding-left: 15px;
  }

  #layui-nav-tree,
  #layui-nav-tree li a:hover {
    background-color: #fff !important;
  }

  #layui-nav-tree,
  #layui-nav-tree li a:hover svg {
    fill: #d70b3d !important;
  }
  .layui-nav-child{padding:0 0 0 0;}
  dl.layui-nav-child dd a {
    font-size: 1.0em !important;
    padding-left: 50px !important;
  }

  i.layui-icon-right {
    color: #aaa;
  }

  .layui-nav-tree .layui-nav-bar {
    background-color: #d70b3d;
  }

  .layui-nav-item svg {
    width: 20px;
    color: #f30;
    fill: #515151;
    vertical-align: text-bottom;
  }
</style>
<div id="bodyLeft" class="layui-side layui-bg-black">
  <div class="layui-side-scroll">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul id="layui-nav-tree" class="layui-nav layui-nav-tree" lay-filter="test">
      <!-- <li id="nav_notice" class="layui-nav-item">
        <a class="" href="javascript:;"><svg t="1632637956301" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="11714">
            <path d="M560.633 162.477c-13.901-6.832-28.731-5.465-40.683 3.757-43.652 33.684-158.527 135.172-177.84 152.27H195.421c-35.74 0-64.817 29.077-64.817 64.817v233.126c0 35.74 29.077 64.82 64.817 64.82h125.75C347.076 704.61 471.183 816.17 519.74 854.64c6.955 5.506 14.927 8.299 23.145 8.299 5.772 0 11.665-1.378 17.415-4.159 20.77-10.048 37.668-38.89 37.668-64.293V226.552c0-25.213-16.748-53.957-37.334-64.075z m-5.879 632.01c0 8.774-6.611 19.758-11.158 23.91-54.496-43.754-196.609-172.036-198.065-173.35-0.01-0.01-0.02-0.016-0.03-0.024-3.946-4.275-9.58-6.968-15.858-6.968H195.421c-11.913 0-21.606-9.693-21.606-21.606V383.322c0-11.913 9.693-21.606 21.606-21.606h150.567c4.353 0 8.399-1.3 11.79-3.514a21.473 21.473 0 0 0 10.394-5.056c1.295-1.148 127.486-112.995 175.377-150.524 4.524 4.04 11.204 15.081 11.204 23.93v567.936zM799.893 512.648c-5.564-85.615-69.287-140.72-71.996-143.024-9.09-7.728-22.726-6.626-30.456 2.467-7.729 9.09-6.626 22.726 2.466 30.455 0.524 0.446 52.474 45.351 56.865 112.905 2.918 44.875-16.032 90.163-56.32 134.607-8.013 8.842-7.344 22.505 1.498 30.52a21.53 21.53 0 0 0 14.504 5.598c5.886 0 11.75-2.392 16.015-7.096 48.444-53.442 71.129-109.438 67.424-166.432z" p-id="11715"></path>
            <path d="M916.537 408.311c-33.194-93.424-95.514-149.89-98.15-152.248-8.895-7.953-22.553-7.193-30.508 1.703-7.954 8.894-7.192 22.553 1.702 30.508 0.563 0.504 56.696 51.358 86.238 134.505 17.195 48.393 21.879 97.97 13.923 147.354-10.062 62.459-40.517 125.212-90.518 186.518-7.542 9.247-6.16 22.858 3.088 30.4a21.52 21.52 0 0 0 13.643 4.862c6.268 0 12.486-2.715 16.757-7.951 54.864-67.269 88.406-136.9 99.692-206.956 9.123-56.63 3.785-113.386-15.867-168.695z" p-id="11716"></path>
          </svg>通知/公告管理</a>
        <dl class="layui-nav-child">
          <dd><a class="pushNotice" href="/administrator/pushNotice">发布通知与公告</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="noticeList" href="/administrator/noticeList">管理通知与公告</a></dd>
        </dl>
      </li> -->
      <li id="nav_adminCepingItem" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-home"></i> 仓库可视化</a>
        <dl class="layui-nav-child">
          <dd><a class="cangkuMap" href="/cangkuVision/cangkuMap">仓库地图</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="wuziliuxiangtu" href="/cangkuVision/wuziliuxiangtu">物资流向图</a></dd>
        </dl>
        
      </li>

      <li id="nav_adminUserInfo" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-app"></i> 物资库存</a>
        <dl class="layui-nav-child">
        <dd><a class="wuzikucuninfo" href="/cangkuVision/wuzikucuninfo">库存信息与功能</a></dd>
        </dl>
      </li>

      <li id="nav_adminCepingConList" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-console"></i> 数据统计可视化</a>
        <dl class="layui-nav-child">
          <dd><a class="wuzikuweikucun" href="/dataStatistics/wuzikuweikucun">物资库位报表</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="wuzixiaohao" href="/dataStatistics/wuzixiaohao">物资消耗报表</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="wzWarming" href="/dataStatistics/wzWarming">物资预警报表</a></dd>
        </dl>
      </li>

      <li id="nav_adminCepingConList" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-video"></i> VR三维展示</a>
        <dl class="layui-nav-child">
          <dd><a class="index" href="/cangkuVR/index">杂品库VR展示</a></dd>
          <!-- <dd><a class="vrDangerous" href="#">杂品库VR展示</a></dd> -->
        </dl>
      </li>
      
      <li id="nav_adminScore" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-chart-screen"></i> 物资溯源</a>
        <dl class="layui-nav-child">
          <dd><a class="QR" href="/wuzisuyuan/QR">二维码生成</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="chuku" href="/wuzisuyuan/chuku">物资扫码出库</a></dd>
        </dl>
      </li>
      
      
      <li id="nav_accountAdmin" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-set"></i> 预警设置</a>
        <?php if($_SESSION['userInfo']['ckIds']== "0"){//管理员功能,只有物资部可以设置全部仓库的预警值，其他人员不能给自己设置自己预警?>
        <dl class="layui-nav-child">
          <dd><a class="setCKWarning" href="/sysSetting/setCKWarning">设置仓库库存预警值</a></dd>
        </dl>
        <?php }?>
        <dl class="layui-nav-child">
          <dd><a class="setWZWarning" href="/sysSetting/setWZWarning">设置物资的预警值</a></dd>
        </dl>
      </li>

      <?php if($_SESSION['userInfo']['isAdmin']==1){//管理员功能?>
      <li id="nav_adminUserInfo" class="layui-nav-item">
        <a class="" href="javascript:;"><i style="color:#000;" class="layui-icon layui-icon-user"></i> 用户管理</a>
        <dl class="layui-nav-child">
          <dd><a class="adminUnit" href="/administrator/adminUnit">部门管理</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="adminUserInfo" href="/administrator/adminUserInfo">账号管理</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="useLog" href="/administrator/useLog">用户使用日志</a></dd>
        </dl>
        <dl class="layui-nav-child">
          <dd><a class="useHot" href="/administrator/useHot">使用热度分析<i class="layui-icon layui-icon-fire"></i></a></dd>
        </dl>
      </li>
      <?php }?>
      
      <li id="nav_accountAdmin" class="layui-nav-item">
        <a class="" href="javascript:;"><i class="layui-icon layui-icon-username"></i> 个人中心</a>
        <dl class="layui-nav-child">
          <dd><a class="updatePWD" href="/accountAdmin/updatePWD">修改密码</a></dd>
        </dl>
      </li>

      
      
    </ul>
  </div>
</div>
<!--end left -->
<div id="bodyRight">

  <script>
    //高亮左侧当前点击
    var currentNav = "<?= lcfirst($controller) ?>"; //当前控制器
    var currentSNav = "<?= $action ?>"; //当前动作
    if (currentNav != "") {
      //设置父菜单高亮
      $("#layui-nav-tree li").removeClass("layui-nav-itemed"); //先取消高亮
      $("." + currentSNav).parents("li").addClass("layui-nav-itemed"); //设置消高亮
      //设置子菜单高亮
      //$("#nav_"+currentNav+" a:first").css("font-weight","600");
      $("." + currentSNav).addClass("currentSNav");
    }
  </script>