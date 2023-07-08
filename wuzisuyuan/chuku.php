<style>
    .saoma {
        height: 38px;
        line-height: 38px;
        background-color: #d70b3d;
        color: #ffffff;
        text-align: center;
        margin-right: 12px;
        padding: 0 10px;
        border-radius: 19px;
    }

    form {
        width: 100%;
        margin: 50px 0 0;
        text-align: center;
    }

    .scroll-body {
        max-height: 500px !important;
    }

    .xm-option-content {
        color: #1E9FFF !important;
    }

    .layui-table-view {
        margin: 0 auto;
    }

    .jianhuoed {
        color: #aaa;
    }
</style>
<script src="/public/js/xm-select.js"></script><!-- 引入jquery.js -->

<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">物资溯源</a>
        <a><cite>智能扫码出库</cite><img style="height:18px;" src="/public/imgs/saomaqiang2.png" /></a>
    </span>
</div>

<form class="layui-form layui-inline" action="">

    <div class="layui-form-item layui-inline">
        <div class="layui-block saoma">扫码出库拣货</div>
    </div>

    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline">
            <div placeholder="请选择调拨单" id="selectOrder" class="xm-select-demo"></div>
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline" style="margin-right: 0;">
            <input placeholder="光标闪烁则可拣货" type="text" id="wuziCode" name="wuziCode" class="layui-input blurObj" lay-verify="title" autocomplete="off">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <div class="layui-input-inline" style="width: 135px;">
            <div style="color:#d70b3d;">最新被扫实物码：</div>
            <div id="saomaTip" style="color:#555;font-weight:600;"></div>
        </div>
    </div>

</form>
<i id="tableTip" style="display: none;margin: 0 auto;width: 16px;color:#009688;" class="layui-icon layui-icon-triangle-d"></i>
<table class="layui-hide" id="table_wuziList" lay-filter="table_wuziList"></table>

<button id="confirmAction" style="display:none;float:right;margin:6px 28px 0 0;" type="button" class="layui-btn layui-btn-normal">点击通过</button>

<audio id="music_success" src="/public/mp3/jianhuo_success2.mp3" preload></audio>
<audio id="music_error" src="/public/mp3/jianhuo_error.mp3" preload></audio>
<audio id="music_start" src="/public/mp3/start_jianhuo.mp3" preload></audio>
<audio id="music_electOrder" src="/public/mp3/tip_selectOrder.mp3" preload></audio>
<audio id="music_getCodeError" src="/public/mp3/tip_getCodeError.mp3" preload></audio>
<audio id="music_noWuzi" src="/public/mp3/tip_noWuzi.mp3" preload></audio>

<script type="text/html" id="barDemo">
    <!-- <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看详情</a>
    <a class="layui-btn layui-btn-xs" lay-event="edit">保存编辑</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a> -->
<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="resetStatus">重置状态</a>
</script>

<script>
    // //开始就播放声音测试
    var audio_success = document.getElementById('music_success');
    var audio_error = document.getElementById('music_error');
    var audio_start = document.getElementById('music_start');
    var audio_electOrder = document.getElementById('music_electOrder');
    var audio_getCodeError = document.getElementById('music_getCodeError');
    var audio_noWuzi = document.getElementById('music_noWuzi');

    audio_electOrder.play(); //播放声音“请选择调拨单”

    //提示用户开始选择调拨单
    layer.msg("请选择调拨单！", {
        icon: 0,
        offset: "auto",
        time: 2000
    });

    var deliveryno = ""; //出库单号
    var shiwuma = ""; //实物码

    //带搜索框的下拉菜单
    var arrData = "";
    $.ajax({
        url: "../../mvc/views/data_fromThird/getdingdanno.php",
        async: false,
        success: function(result) {
            arrData = JSON.parse(result);
            //console.log(result);     
        }
    });
    //下拉选择菜单时，扫码输入框失去焦点
    $("#selectOrder,#confirmAction").hover(function() {
        $("#wuziCode").attr("onblur", "");
    });
    $("#selectOrder,#confirmAction").mouseleave(function() {
        $("#wuziCode").attr("onblur", "getFocus()");
    });
    //下拉选择菜单或搜索
    var selectOrder = xmSelect.render({
        el: '#selectOrder',
        radio: true,
        tips: '请选择调拨单',
        searchTips: '搜索',
        clickClose: true,
        filterable: true,
        paging: true,
        pageSize: 10,
        data: arrData,
        on: function(data) {
            audio_start.play(); //默认开始播放的声音
            $("#tableTip").css("display", "block");
            layer.msg("请开始扫码拣货！", {
                icon: 1,
                offset: "auto",
                time: 2000
            });
            if (data.arr.length > 0) {
                deliveryno = data.arr[0]['value'];
                initTable(deliveryno);
                $("#confirmAction").css("display", "block");
            } else {
                $("#confirmAction").css("display", "none");
            }
        },
        hide() {
            //延迟获得焦点，防止立即获得焦点被覆盖。
            setTimeout(function() {
                $("#wuziCode").focus();
                $("#wuziCode").attr("onblur", "getFocus()"); //扫码枪输入框获得焦点
            }, 500);
        }
    });

    //扫码枪输入框获得焦点
    function getFocus() {
        $('#wuziCode').focus();
    }

    //扫码枪进行扫码
    //var fristkeyCode13 = true;

    $('#wuziCode').keydown(function(event) {
        console.log(" 5 ");
        if (event.keyCode == 13) { //响应。Enter键为13  空格为32
            //fristkeyCode13 = false;

            deliveryno = $(".xm-label-block span").eq(0).html();
            var shiwuma = $.trim($("#wuziCode").val()); //获取二维码中的一行信息
            $("#wuziCode").val("");

            //先清除包含的相关字符
            //console.log(" 获取的1: " + shiwuma);
            shiwuma = shiwuma.split("？").join("");
            shiwuma = shiwuma.split("?").join("");
            shiwuma = shiwuma.split("：").join("");
            shiwuma = shiwuma.split(":").join("");
            //console.log(" 获取的2: " + shiwuma);
            if (shiwuma.indexOf("-") >= 0) { //质保期的格式：20150326-20160320
                return false;
            }

            //提取数字（实物码和供应商都可能含中文）
            shiwuma = shiwuma.match(/\d+/g);

            //排除为空的情况：供应商一般不含数字/如含有数字则用长度判断，可排除供应商
            if (shiwuma == "" || shiwuma == null || shiwuma.toString().length < 10) return false;

            console.log(" 最终的实物码:" + shiwuma);


            $("#saomaTip").html(shiwuma); //"扫码的实物码："+

            //扫码结果添加空格，为了下次筛选出最新的结果。

            if (deliveryno == "" || deliveryno == undefined) {
                audio_electOrder.play(); //播放声音“请选择调拨单”
                layer.msg("请选择出库单号！", {
                    icon: 0,
                    offset: "auto",
                    time: 2000
                });
                return false;
            } else if (shiwuma == "" || isNaN(shiwuma || shiwuma.length < 10)) { //获取实物码失败;

                audio_getCodeError.play(); //播放获取实物码失败的提示音
                layer.msg("获取实物码失败！", {
                    icon: 0,
                    offset: "auto",
                    time: 2000
                });
                return false;
            }


            var url = '../../mvc/views/data_fromThird/wuzichuku.php?deliveryno=' + deliveryno + '&shiwuma=' + shiwuma;
            $.ajax({
                url: url,
                async: true,
                success: function(result) {
                    //fristkeyCode13 = true;

                    arrData = JSON.parse(result);
                    console.log(arrData);
                    //alert(arrData.code);//code=0出库失败，1-成功。
                    if (arrData.code == 1) {
                        audio_success.play();
                        layer.msg("拣货成功！", {
                            icon: 1,
                            offset: "auto",
                            time: 1000
                        });
                        $(".layui-table-main").eq(0).find("tr").each(function() {
                            var batchNo = $(this).find("td[data-field$='batchNo'] .layui-table-cell").html();
                            if (batchNo == shiwuma) {
                                $(this).addClass("jianhuoed"); //已拣货
                                $(this).find("td[data-field$='jhstatus'] .layui-table-cell").html("已拣货");
                            }
                        });

                    } else {
                        audio_noWuzi.play();
                        layer.msg("出库单中未找到！", {
                            icon: 0,
                            offset: "auto",
                            time: 2000
                        });
                    }

                    // $("#wuziCode").val("");

                    //setTimeout(function(){  window.location.href=""; }, 1000);
                }
            });
        }
    });

    function initTable(deliveryNo) {
        layui.use('table', function() {
            var table = layui.table;
            //方法级渲染
            table.render({
                elem: '#table_wuziList',
                url: '../../mvc/views/data_fromThird/dingdanno_detail.php?deliveryNo=' + deliveryNo,
                cols: [
                    [{
                            field: 'matName',
                            title: '物资名称'
                        },
                        {
                            field: 'batchNo',
                            title: '实物码'
                        },
                        {
                            field: 'brand',
                            title: '品牌'
                        },
                        {
                            field: 'matKindName',
                            title: '物资分类'
                        },
                        {
                            field: 'otherSpecPara',
                            title: '规格参数'
                        },
                        {
                            field: 'deliveryNum',
                            title: '数量'
                        },
                        {
                            field: 'jhstatus',
                            title: '拣货状态'
                        },
                        {
                            fixed: 'right',
                            title: '操作',
                            toolbar: '#barDemo',
                            width: 120

                        }


                    ]
                ],
                //id: 'testReload',
                //page: true,

            });

            //监听行工具事件
            table.on('tool(table_wuziList)', function(obj) {
                var data = obj.data;
                console.log(obj);
                var aa = obj.selectOrder;
                var rowIndex = $(obj.tr).attr("data-index");


                //重置拣货状态
                if (obj.event === 'resetStatus') {
                    var deliveryNo = data.transferNo; //出库单号
                    var batchNo = data.batchNo; //实物码
                    //重置拣货状态  
                    $.ajax({
                        async: false,
                        type: "post",
                        data: {
                            "deliveryNo": deliveryNo,
                            "batchNo": batchNo
                        },
                        dataType: 'json',
                        url: "../../mvc/views/data_fromThird/wuzichukuchongzhi.php?deliveryno=" + deliveryNo + "&shiwuma=" + batchNo,
                        success: function(msg) {
                            //设置为“未拣货”
                            $(obj.tr).find("[data-field='jhstatus'] div").html("未拣货");
                            $(obj.tr).removeClass("jianhuoed"); //已拣货
                        },
                        error: function(msg) {
                            alert(msg.status + "服务繁忙，请刷新或稍后再试。");
                        }
                    }); //end ajax


                }
            }); //end table.on

        }); //end layer.use
    }

    //确认操作
    $("#confirmAction").click(function() {
        var approver = "<?= $_SESSION['userInfo']['approver'] ?>"; //审批人
        if (approver == "" || approver == "null") {
            layer.msg("您无出库审批权限，请联系管理员！", {
                icon: 2
            });
            return false;
        }

        layer.confirm('确定要提交确认（通过）操作吗？<br><br>出库审批人：<span style="padding:3px 5px" id="approverInput" >' + approver + '</span>', {
            icon: 3,
            title: '提示'
        }, function(index) {
            //确认拣货
            $.ajax({
                async: false,
                type: "post",
                data: {
                    "deliveryNo": deliveryno, //出库单号
                },
                dataType: 'json',
                url: "../../mvc/views/data_fromThird/wuzichukuqueren.php?approver=" + approver + "&deliveryno=" + deliveryno,
                success: function(res) {
                    if (res.code == 1) {
                        layer.msg("确认成功！", {
                            icon: 1
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        layer.msg("确认失败，" + res.msg, {
                            icon: 2
                        });
                    }
                },
                error: function(msg) {
                    alert(msg.status + "服务繁忙，请刷新或稍后再试。");
                }
            }); //end ajax
        }, function() {

            $('#wuziCode').focus();

        }); //end confirm
    });
</script>