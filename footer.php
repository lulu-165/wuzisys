</div>
<!--end right -->
</div>
<!--end main -->
<!-- BEGIN FOOTER -->
<style>
    #footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 7px 0 8px;
        text-align: center;
        color: #666;
        box-shadow: -1px 0 4px rgb(0 0 0 / 12%);
        background-color: #FAFAFA;
    }
</style>
<div style="margin:0 0 50px;">&nbsp;</div>
<div id="footer">©<?= date("Y") ?> 南昌轨道交通集团有限公司 - <span style="font-weight:600">运营分公司</span><span style="margin:0 10px">&</span>技术支持: 华东交大软件学院 - 周会祥 13133912521</div>
<!-- END FOOTER -->
<script>
    //判断刷新或关闭页面，作为登出信息进行记录
    //https://www.jb51.net/article/78977.htm
    var is_fireFox = navigator.userAgent.indexOf("Firefox") > -1; //是否是火狐浏览器
    window.onunload = function() {
        $.ajax({ async: true, url: "/mvc/views/login/logout.php?action=monitorBrowser"});
    }
    window.onbeforeunload = function() {
        if (is_fireFox) //火狐关闭执行
        $.ajax({ async: true, url: "/mvc/views/login/logout.php?action=monitorBrowser"});
    };
</script>
</body>

</html>