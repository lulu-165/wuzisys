<!-- 查看成绩明细 -->

<!-- 引入公共CSS -->


<!-- 面包屑导航 -->
<div class="sub-page-header">
    <span class="layui-breadcrumb" lay-separator=">">
        <a href="javascript:void(0);">年度考核</a>
        <a><cite>查看成绩明细<span class="red">（华东交通大学）</span></cite></a>
    </span>
</div>

<div id="tree"></div>

<script>
$(document).ready(function(){
    // 初始化树
    layui.use('tree', function(){
    var tree = layui.tree;
    //渲染
    var inst1 = tree.render({
      elem: '#tree', //绑定元素
      data: [{
        title: '江西省高校文明校园动态管理评测指标（2021年）标准分：100 得分：<span class="red">0</span>', //一级菜单
        children: [{
          title: '年度工作（95分）标准分：100 得分：<span class="red">0</span>', //二级菜单
          children: [{
            title: '一、思想道德建设（36分)标准分：100 得分：<span class="red">0</span>', //三级菜单
            children:[{
              title:'1、统筹规划与组织实施（6分）标准分：100 得分：<span class="red">0</span>',
              children:[{
                title:'1）制定学校文明校园创建规划或工作计划或实施方案。上传文件，需有学校的红头、文号及公章(未上报)标准分：100 得分：<span class="red">0</span>'
              },{
                title:'2）把创建文明校园作为重要任务，有专门的机构和专项经费保障。上传学校创建文明校园组织领导及机构、人员情况（扫描件或照片），落款处有学校公章；上传学校文明校园创建的年度经费预算或使用情况（扫描件或照片）。(未上报)标准分：100 得分：<span class="red">0</span>'
              },{
                title:'3）高校党委书记、校长和分管校领导每学期对每门思政课必修课至少听1次课。上传听课计划、照片（3张）。(未上报)标准分：100 得分：<span class="red">0</span>'
              }]
            },{
              title:'2、开展思想政治教育（8分）',
              children:[{
                title:'1）广泛开展党史、新中国史、改革开放史、社会主义发展史教育。上传文字材料或照片（2张）。(未上报)标准分：100 得分：<span class="red">0</span>'
              },{
                title:'2）学校党委常委会每学期至少召开1次会议专题研究思政课建设。上传2次会议的会议纪要。(未上报)标准分：100 得分：<span class="red">0</span>'
              },{
                title:'3）开展国家安全教育、生态文明教育、诚信教育、廉洁教育、劳动教育、职业生涯发展教育。上传文字材料或照片（各种教育各1张，共6张）。(未上报)标准分：100 得分：<span class="red">0</span>'
              }]
            },{
              title:'3、培育和弘扬社会主义核心价值观（3分）标准分：100 得分：<span class="red">0</span>'
            },{
              title:'4、思想政治工作队伍建设（2分）标准分：100 得分：<span class="red">0</span>'
            },{
              title:'5、实践育人（4分）标准分：100 得分：<span class="red">0</span>'
            },{
              title:'6、文明集体建设（4分）标准分：100 得分：<span class="red">0</span>'
            },{
              title:'7、心里健康教育（6分）标准分：100 得分：<span class="red">0</span>'
            },{
              title:'8、加强宣传引导（3分）标准分：100 得分：<span class="red">0</span>'
            }]
          },{
            title: '二、领导班子建设（8分）标准分：100 得分：<span class="red">0</span>',
          },{
            title: '三、师德师风建设（15分）标准分：100 得分：<span class="red">0</span>',
          },{
            title: '四、校园文化建设（17分）标准分：100 得分：<span class="red">0</span>',
          },{
            title: '五、校园环境建设（8分）标准分：100 得分：<span class="red">0</span>',
          },{
            title: '六、阵地建设管理（11分）标准分：100 得分：<span class="red">0</span>',
          }]
        }]
      },
      {
        title: '半年度工作（5分）标准分：100 得分：<span class="red">0</span>', //一级菜单
        children: [{
          title: '上半年工作标准分：100 得分：<span class="red">0</span>' //二级菜单
        },
        {
          title: '下半年工作标准分：100 得分：<span class="red">0</span>'
        }]
      }]
    });
  });

});
</script>
