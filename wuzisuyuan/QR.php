<style>
#imgbox{
    width: 165px;
    height: 165px;
    line-height: 165px;
    color: #ddd;
    font-size: 1.2em;
    margin: 0 auto;
    border: 1px solid #ddd;
}
#imgbox img{height:163px;width:163px;}
</style>
<!-- 面包屑导航 -->
<div class="sub-page-header" style=" ">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">物资溯源</a>
        <a><cite>二维码生成</cite> <img style="height:17px;vertical-align: text-bottom;" src="/public/imgs/erweima_1.png" /></a>
    </span>
</div>

<div class="box" style="text-align: center;margin: 55px 0 55px;">
    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline" style="width: auto;">请输入实物码：</div>
    </div>
    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline">
            <input id="wuziCode" type="number" min=1 name="wuziid" lay-verify="title" autocomplete="off" placeholder="输入实物码" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline" style="width: auto;">
            <button class="layui-btn layui-btn-normal" id="qrbtn">生成二维码</button>
        </div>
    </div>
</div>
<div style="text-align: center;">

    <div id="imgbox"><img src="/public/imgs/erweima_temp.png?a1" /></div>
    <div id="erweima_tip">待生成的二维码</div>
</div>



<script>
    $('#qrbtn').on('click', function() {
        var wuziCode=$.trim( $("#wuziCode").val() );
        if(wuziCode==""){
            layer.msg("请填写实物码！", { icon: 0, offset: "auto", time:2000 });
            return false;
        }
        if(wuziCode.length<11){
            layer.msg("实物码格式不正确！", { icon: 0, offset: "auto", time:2000 });
            return false;
        }
        
        $.ajax({
            async:false,
            type: "post",
            data: {
                "wuziCode":wuziCode
            },
            dataType: 'json',
            url: "<?=CURRENT_DIR?>/QR_create.php",
            success: function (msg) {

                if(msg=="notExist"){
                    layer.msg("物资不存在！", { icon: 0, offset: "auto", time:2000 });
                }
                else if(msg != "error")
                {
                    var src=msg;
                    $("#imgbox").html('<img src="'+src+'" />');
                    $("#erweima_tip").html('生成的二维码');
                    layer.msg('二维码生成成功！', { icon: 1, offset: "auto", time:1000 });

                }
            },
            error: function (msg) {
                alert("服务繁忙，请刷新或稍后再试。");
            }
        });
         
    });
</script>