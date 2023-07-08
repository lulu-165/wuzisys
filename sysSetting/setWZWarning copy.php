<?php
include $_SERVER["DOCUMENT_ROOT"] . "/core/functions.php";
$fpath = $_SERVER["DOCUMENT_ROOT"] . "/conf/sysSet_wzlimitVal.txt";
$cangkuwarningValArr = getFileCon($fpath);
//var_dump($cangkuwarningValArr);
?>
<style>
    #alertTable tr td {
        border: 1px solid #ddd;
        padding: 0 15px;
    }

    table th {
        border: 1px solid #ddd;
        line-height: 32px;
    }

    table input {
        text-align: center;
    }

    #ckbox {
        margin-bottom: 0;
    }

    .layui-table-main td {
        padding: 2px 0 !important;
    }

    .layui-table-main input {
        margin-top: 2px;
        height: 24px;
        line-height: 24px !important;
    }

    .layui-table-cell {
        padding-right: 0;
    }

    #addAlertVal_min,
    #addAlertVal_max {
        width: 77px;
        margin-left: 6px;
    }

    #addWuziName {
        width: 143px;
        margin-left: 6px;
    }

    #addWuziCode {
        width: 103px;
        margin-left: 6px;
    }
    .limitVal {
        display: block;
        text-align: center;
        margin: auto;
    }
</style>
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">系统设置</a>
        <a><cite>设置物资的预警值</cite><i style="color:#f00;margin:0 0 0 2px;" class="layui-icon layui-icon-notice"></i></a>
    </span>
</div>

<div style="margin:10px 0 0 30px;">
<?php if($_SESSION['userInfo']['ckIds']=="0"){//管理员及物资部人员为0表示管理全部仓库，可选择仓库，其他用户不显示该项?>
    <form class="layui-form layui-inline" action="#">
        <div class="layui-form-item layui-inline" style="width:65px; margin:0 0 0 10px;">
            <div class="layui-input-inline">选择仓库：</div>
        </div>
        <div id="ckbox" class="layui-form-item layui-inline">
            <div class="layui-input-inline">
                <select name="selectStore" lay-filter="selectStore">
                    <option value="all">全部仓库</option>
                    <?php foreach ($stationsInfoArr as $key => $val) {
                        $selected = "";
                        if ($key == $_GET['station']) $selected = "selected";
                    ?>
                        <option <?= $selected ?> value="<?= $key ?>"><?= $val['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </form>
    <?php }?>

    <table id="alertTable" lay-filter="alertTable"></table>
    <div id="submitBox" style="width: 1054px;">
        <div style="width: 150px; " class="layui-inline" style="float:left">
            <button id="addUnit" style="width: 130px;" type="submit" class="addUnit layui-btn">添加预警</button>
        </div>
        <div style="width:150px;float:right" class="layui-inline">
            <button id="submit" style="width: 130px;" type="submit" class="submit layui-btn layui-btn-normal">提交设置</button>
        </div>
    </div>
</div>

<script>
    var cangkuwarningValArr = <?= json_encode($cangkuwarningValArr) ?>;
    //alert(cangkuwarningValArr);
    console.log(cangkuwarningValArr);
    
    //添加行
    var added = false; //每次只能一行
    $(".addUnit").live("click", function(e) {
        if (added) return;
        $(document).scrollTop($(document).height());
        //alert($(".layui-table tbody").html());
        //var cangku = '<select id="addCangku" style="display: block;"  name="selectStore" lay-filter="selectStore"> <option  value="all">选择仓库</option></select>'
       
       var class1 = "";
       var classData = "";
       $.ajax({
            url: "../../mvc/views/data_fromThird/wuzisort_data.php",
            async: false,
            success: function(result) {
                classData = JSON.parse(result);
            }
        });
        console.log(classData);
        //<td><select style="display: block;width: 100%;" id="select_unit"></select></td>
       //$tr = '<tr id="addTR"><td>' + cangku + '</td>';
       $tr = '<tr id="addTR">';
       $tr += '<td><select id="addCangku" style="display: block;"  name="selectStore" lay-filter="selectStore"> <option  value="all">选择仓库</option></select></td>>';
       $tr += '<td><select id="class1" style="display: block;"></select></td>';
       
        //$tr = +'<tr id="addTR"><td><input id="addUnitInput" value="" placeholder="请输入仓库" /></td><td><button type="button" id="saveUnit" class="layui-btn layui-btn-sm">保存</button> <button type="button" id="cancelAdd" class="layui-btn layui-btn-sm">取消</button></td></tr>';
        $tr += '<td><input id="addWuziName" value="" placeholder="输入物资名称" /></td>';
        $tr += '<td><input id="addWuziCode" type="number" value="" placeholder="输入物资编码" /></td>';
        $tr += '<td><input id="addAlertVal_min" type="number" value="" placeholder="预警下限值" /></td>';
        $tr += '<td><input id="addAlertVal_max" type="number" value="" placeholder="预警上限值" /></td>';
        $tr += '<td style="padding-left:9px !important;"><button style="margin:2px 0 2px;" type="button" id="saveUnit" class="layui-btn layui-btn-sm">保存</button><br/><button type="button" id="cancelAdd" class="layui-btn layui-btn-sm">取消</button></td></tr>';


        $(".layui-table tbody").append($tr);

        //选择部门
    var units = "";
    $.ajax({
      url: "../../mvc/views/sysSetting/setWZWarning_getAddCangku.php",
      async: false,
      success: function(result) {
        units = JSON.parse(result);
        //console.log(units);
        $("#select_unit").append("<option value=''>选择部门</option>");
        $.each(units, function(pF, value) {
          console.log(value);
          $("#addCangku").append("<option value='" + value['ckId'] + "'>" + value['name'] + "</option>");

        });
      }
    });


        // 分类一
        $("#class1").append("<option value=''>选择分类</option>");
        $.each(classData, function(pF) {
            //console.log(pF);
            $("#class1").append("<option value='"+pF+"'>" + pF + "</option>");
             
        });

        added = true;
    });


    //取消添加用户
    $("#cancelAdd").live("click", function(e) {
        $("#addTR").remove();
        added = false;
    });

    //提交添加行
    $("#saveUnit").live("click", function(e) {
        var addCangkuVal = $.trim($("#addCangku option:selected").val());
        //var ckId = $.trim($("#addCangku option:selected").attr("ckId"));
        var addClass1Val = $.trim($("#class1 option:selected").val());
        //console.log(" class1val:"+ addClass1Val);
        //alert(addCangkuVal + addClass1Val);
        var addWuziName = $("#addWuziName").val();
        var addWuziCode = $("#addWuziCode").val();
        var addAlertVal_min = $("#addAlertVal_min").val();
        var addAlertVal_max = $("#addAlertVal_max").val();
        // var warningVal_min = ""; //预警值
        // var warningVal_max = ""; //预警值
        //alert(addCangkuVal+" "+addWuziName+" "+addWuziCode+" "+addAlertVal_min+" "+addAlertVal_max)
        if (addCangkuVal == "all" || addClass1Val == "" || addWuziName == "" || addWuziCode == "" || addAlertVal_min == "" || addAlertVal_max == "") {
            layer.msg('全部项不能为空！', {
                icon: 2
            });
            return;
        } else if (addWuziCode.length < 10) {
            layer.msg('物资编码的格式不正确！', {
                icon: 0
            });
            return false;
        }
        //判断负数
        if (addAlertVal_min == "" || addAlertVal_max == "") {
            layer.msg('请输入预警值！', {
                icon: 0
            });
            return false;
        } else if (addAlertVal_min < 0 || addAlertVal_max < 0) {
            layer.msg('预警值不能为负数！', {
                icon: 0
            });
            return false;
        }
        //判断预警下限<预警上限
        else if (parseInt(addAlertVal_min) > parseInt(addAlertVal_max) || parseInt(addAlertVal_min) == parseInt(addAlertVal_max)) {
            console.log(121);
            console.log(addAlertVal_min);
            console.log(addAlertVal_max);
            layer.msg('预警下限要小于预警上限', {
                icon: 0
            });
            return false;
        }
        //检查重复是否重复添加
        var isDuplicated=false;
        $.each(cangkuwarningValArr, function(index, obj) {
            if (addCangkuVal == obj["cangku"] && addWuziCode == obj["wzCode"]) {
                layer.msg('该仓库已设置物资编码' + addWuziCode + '的预警值，请问重复添加！', {
                    icon: 0
                });
                isDuplicated = true;
                return false;
            }
        })
        if(isDuplicated)return false;

        //保存数据
        $.ajax({
        async: false,
        type: "post",
        data: {
            "cangku": addCangkuVal,
            "ckId": addCangkuVal,
            "class1": addClass1Val,
            "wzName": addWuziName,
            "wzCode": addWuziCode,
            "warningVal_min": addAlertVal_min,
            "warningVal_max": addAlertVal_max
        },
        dataType: 'json',
        url: "<?= CURRENT_DIR ?>/setWZWarning_add.php",
        success: function(msg) {
            console.log(msg);
          if (msg != "error") {

            layer.msg('提交成功', {
              icon: 1
            });
            setTimeout(function() {
              window.location.href = "";
            }, 1000);
          }
        },
        error: function(msg) {
          alert(msg.status + "服务繁忙，请刷新或稍后再试。");
        }
      });
        //console.log(cangkuwarningValArr);

    });
    //显示预警数据
    var currCangKey = "all";
    initTable();
    layui.use(['form'], function() {
        form = layui.form;
        form.on('select(selectStore)', function(data) { //现在参考
            currCangKey = data.value;
            //console.log(currCangKey);
            initTable();
        });


    });
    //函数：初始化表格数据
    function initTable() {
        //console.log(currCangKey);
        var url = "/mvc/views/sysSetting/setWZWarning_getTableData.php?currCangKey=" + currCangKey;

        //初始化物资列表数据 
        layui.use('table', function() {
            var table = layui.table;
            table.render({
                elem: '#alertTable',
                width: 1100,
                //第一个参数用?
                url: url,
                //page: true , //开启分页
                cols: [ //表头
                    [{
                            field: 'cangku',
                            title: '所属仓库',
                            width: "225"
                        },
                        {
                            field: 'class1',
                            title: '所属分类',
                            width: "225"
                        },
                        {
                            field: 'wzName',
                            title: '物资名称',
                            width: "150"
                        },

                        {
                            field: 'wzCode',
                            title: '物资编码',
                            width: "110"
                        },
                        {
                            field: 'warningVal_min',
                            title: '设置下限值.Min',
                            width: "120"
                        },
                        {
                            field: 'warningVal_max',
                            title: '设置上限值.Max',
                            width: "120"
                        },
                        {
                            field: 'operation',
                            title: '操作',
                            width: "60"
                        }
                    ]
                ],
                done: function(res, curr, count) { //回调函数
                    $(".hidden").parents("tr").css("display", "none"); //隐藏除当前之外的仓库信息
                }
            });

            //监听工具条-删除
            table.on('tool(alertTable)', function(obj) {
                var data = obj.data;
                if (obj.event === 'detail') {
                    layer.msg('ID：' + data.id + ' 的查看操作');
                } else if (obj.event === 'del') {
                    var trLen = $(".layui-table-main").eq(0).find("tr").length;

                    if (trLen < 2) {
                        layer.msg('最后一行不能删除', {
                            icon: 2
                        });
                        return false;
                    }
                    layer.confirm('真的删除该行么', function(index) {
                        obj.del();
                        submitAction();
                        layer.close(index);
                    });
                }
            });

        });
    }

    //提交设置
    $("#submit").click(function(e) {
        submitAction();

    });

    function submitAction() {
        if (added) {
            layer.msg('请先保存添加的数据！', {
                icon: 0
            });
            return false;
        }
        var cangkuVal = ""; //仓库
        var warningVal_min = ""; //预警值
        var warningVal_max = ""; //预警值
        var wzName = "";
        var wzCode = "";
        var dataArr = new Array();
        var i = 0;
        // console.log(warningVal_min);
        //     console.log(warningVal_max);
        $(".layui-table-main").eq(0).find("tr").each(function(index, element) {

            //console.log($(this).html());
            cangkuVal = $(this).find(".layui-table-cell span").eq(0).attr("val"); //仓库
            class1Val = $(this).find(".layui-table-cell").eq(1).html(); //分类名称
            wzName = $(this).find(".layui-table-cell").eq(2).html(); //物资名称
            wzCode = $(this).find(".layui-table-cell").eq(3).html(); //物资编码
            warningVal_min = $(this).find(".layui-table-cell").eq(4).find("input").eq(0).val(); //预警值
            warningVal_max = $(this).find(".layui-table-cell").eq(5).find("input").eq(0).val(); //预警值
            console.log(index);
            console.log(warningVal_min);
            console.log(warningVal_max);
            if (warningVal_min == "" || warningVal_max == "") {
                return false;
            } else if (warningVal_min < 0 || warningVal_max < 0) {
                return false;

            } else if (parseInt(warningVal_min) > parseInt(warningVal_max) || parseInt(warningVal_min) == parseInt(warningVal_max)) {
                return false;
            }

            //定义保存数据的数组
            var temp = {
                "cangku": cangkuVal,
                "class1": class1Val,
                "wzName": wzName,
                "wzCode": wzCode,
                "warningVal_min": warningVal_min,
                "warningVal_max": warningVal_max
            };
            dataArr.push(temp);

        });
        // console.log(warningVal_min);
        //     console.log(warningVal_max);
        if (warningVal_min == "" || warningVal_max == "") {
            layer.msg('请输入预警值！', {
                icon: 0
            });
            return false;
        } else if (warningVal_min < 0 || warningVal_max < 0) {
            layer.msg('预警值不能为负数！', {
                icon: 0
            });
            return false;
        } else if (parseInt(warningVal_min) > parseInt(warningVal_max) || parseInt(warningVal_min) == parseInt(warningVal_max)) {
            //判断预警下限<预警上限
            console.log(222);
            layer.msg('预警下限要小于预警上限', {
                icon: 0
            });
            return false;
        }
        dataJson = JSON.stringify(dataArr); //js值转换为json格式字符串
        saveWarningData(dataJson);
    }
    //提交设置后保存数据
    function saveWarningData(dataJson) {
        $.ajax({
            async: false,
            type: "post",
            data: {
                "data": dataJson
            },
            dataType: 'json',
            url: "/mvc/views/sysSetting/setWZWarning_ajax.php",
            success: function(msg) {
                //alert(msg);
                if (msg != "error") {
                    layer.msg('设置阈值成功', {
                        icon: 1
                    });
                }
            },
            error: function(msg) {
                alert(msg.status + "服务繁忙，请刷新或稍后再试。");
            }
        });

    }
</script>