<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>城市轨道交通线网物资全生命周期管理系统</title>
  <link rel="stylesheet" href="/public/layui/css/layui.css" media="all"> <!-- 引入 layui.css -->
  <script src="/public/js/jquery-1.8.3.min.js?a1"></script><!-- 引入jquery.js -->
  <script src="/public/layui/layui.js"></script><!-- 引入 layui.js -->
  <style type="text/css">
    html,
    body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      border: 0;
    }

    html {
      overflow: hidden;
      background-size: 100% 100%;
      background-position: top center;
    }

    <?php if ($_GET['dev'] == "mobile") { //移动版的样式
    ?>#loginPanel {

      padding: 20px 0;
      border: solid 1px #ddd;
      border-radius: 20px;
      background: #FFF;
      position: absolute;
      left: 2%;
      top: 20%;
      width: 96%;
      box-shadow: 0 0 15px #0076a7;
    }

    #logotxt {
      margin: 8px 0 0;
      font-size: 18px;
    }

    <?php } else { //电脑版样式 
    ?>#loginPanel {
      width: 350px;
      padding: 20px 50px;
      border: solid 1px #ddd;
      border-radius: 20px;
      background: #FFF;
      position: absolute;
      left: 48%;
      top: 40%;
      width: 480px;

      margin-left: -240px;
      margin-top: -120px;
      box-shadow: 0 0 15px #0076a7;
    }

    #logotxt {
      margin: 5px 0 0;
    }

    <?php } ?>.loginTitle {
      font-size: 32px;
      text-align: center;
      margin: 0 0 15px;
    }

    .layui-input {
      width: 80%;
      margin: 0 auto;
      border-radius: 3px;
    }
  </style>
</head>

<body>
  <div class="login-bg">
    <!-- 登录框 -->
    <div id="loginPanel" style="">
      <div method="post" class="loginForm layui-form" style="text-align:center;">

        <div class="loginTitle"><img style="height:64px;" src="/public/imgs/logo_nctrain1.png" />
          <div id="logotxt"><?= $_GET['dev'] == "mobile" ? "物资扫码拣货系统" : "物资全生命周期管理系统" ?></div>
        </div>
        <div id="error_box"></div>
        <div class="layui-form-item">
          <input type="text" id="username" name="username" required lay-verify="required" placeholder="请输入账户名" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-item">
          <input type="password" name="password" id="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
        </div>
        <div class="input_box1 ">
          <button id="submit" class="layui-btn   layui-btn-normal" style="background-color: #e60039;height: 34px;line-height: 34px;width:80px;">登 录</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    //获取H5缓存中的登陆信息
    var uname = localStorage.getItem("uname");
    var pwd = localStorage.getItem("pwd");
    if (uname != null && uname != "") $("#username").val(uname);
    if (pwd != null && pwd != "") $("#password").val(pwd);

    var dev = "<?= $_GET['dev'] ?>"
    $("#submit").click(function() {
      var usernameVal = $.trim($("#username").val());
      var passwordVal = $.trim($("#password").val());
      console.log(usernameVal + "  " + passwordVal);
      if (usernameVal == "" || passwordVal == "") {
        layer.msg("账号和密码不能为空！");
        return false;
      }
      $.ajax({
        async: true,
        url: "/mvc/views/login/login_check.php?dev=<?= $_GET['dev'] ?>",
        type: 'post',
        data: {
          "username": usernameVal,
          "password": passwordVal,
        },
        dataType: 'json',
        success: function(msg) {
          console.log(msg);
          console.log(msg['approver']);

          approver = msg['approver'];
          if (msg == "error") {
            layer.msg("账号或密码错误！");
          } else {
            //HTML5本地缓存
            localStorage.setItem("uname", usernameVal);
            localStorage.setItem("pwd", passwordVal);
            //跳转
            if (dev == "mobile") window.location.href = "/m_scanCode/barcode.html?approver=" + approver;
            else {
              //密码至少包含大小写字母、数字，且不少于8位
              var re =/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{8,16}$/;
              var result=  re.test(passwordVal);
              if(!result)window.location.href = "/accountAdmin/updatePWD&tip=pwdnotmeetReg ";//前往修改密码
              else window.location.href = "/cangkuVision/cangkuMap";
            }
          }
          //cangkuAlertInfoObj = msg;
        },
        error: function(msg) {
          layer.msg('网络繁忙，请刷新或稍后再试!');
        }
      });

    });
  </script>

</body>

</html>