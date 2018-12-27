<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>蒲公英网络CRM</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css" />
    <link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-style2.css" />
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
</head>
<script>
if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
    new WOW().init();
};

var myalert=function(title,width,height,url,yfunction){
    layer.open({
        type: 2 
        ,title: title
        ,area: [width, height]
        ,shade: 0.5
        ,maxmin: true
        ,offset:"auto"
        ,content: url
        ,btn:'确定'
        ,yes : yfunction
    });
}
$(function(){
    $("#searchbox").bind('input propertychange',function(){
        $('.empty').show();
    })
    $('.empty').click(function(){
        $("#searchbox").val('');
        $('.sform').submit();
    })
})
</script>
<body>
<style>
body{margin-top: 0 !important;font-size:14px;}
.ml15{margin-left: 15px;}
.ml10{margin-left:10px;}
.mr10{margin-right: 10px;}
.mt15{margin-top:15px;}
.fl{float: left;}
.fr{float: right;}
.dib{display: inline-block;}
.db{display:block;}
.dn{display: none;}
/*bootstrap*/
.btn{padding: 7px 20px;}
.btn-sm{padding: 5px 10px !important;}
.form-control{border-radius:initial;}
.table th{text-align: left;font-size: 14px;}
.table-hover>tbody>tr:hover {background-color: #e6e6e6;}
.table>tbody>tr>td{vertical-align: middle;}
tr:hover {background: transparent;}
.label{padding: .3em .6em;}
.alert {padding: 5px 35px 5px 5px;border: 1px solid transparent;border-radius: 4px;margin-bottom: 0;}
.pagination{margin: 0;}
/* content-header */
#content-header{padding: 5px 0 10px 0;margin:0 20px;margin-top:0px !important;overflow: hidden;border-bottom: 2px solid #ddd;width: initial !important;}
.header-title{font-size: 16px;display: block;float: left;position: relative;top: 5px;}
.mysearchbox{position: relative;background: #ddd;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
.mysearchbox input{border: none;background: #ddd;}
.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
.empty{position: absolute;top: 11px;right: 11px;cursor: pointer;display: none;}
.empty:hover{color: red;}
.condition-panel{display: none;width: 100%;overflow: hidden;padding: 10px;}
.condition-panel-item{width: 16.6%;padding: 0 10px;float:left;}
.condition-panel-item .lb{margin-bottom: 10px;font-weight: bold;display: block;}
@media (max-width: 1366px) and (min-width: 481px){
#content {margin-left: 0 !important;}
.panel-group{width: 60% !important;}
}
</style>
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<style>
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.tr-active{background: #8bd6b6 !important};
</style>
<script>
$(function(){
    $('.table-hover tbody tr').click(function(){
        $(this).toggleClass('tr-active');
        $('.oprt-wrap').toggleClass('dn');
    })
    $('.userid').click(function(){
        alert('111');
    })
    $('.username').click(function(){
        $('.text-username').text($(this).text());
        $('.alert').show();
    })
    $('.close').click(function(){
        $('.alert').hide();
    })
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
        }
        $('.condition-panel').slideToggle();
    })
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-server"></i> 服务器管理</span>
        <div class="alert alert-warning alert-dismissable fl ml15 dn">
            <button type="button" class="close" aria-hidden="true">
                &times;
            </button>
            客户名称：<b class="text-username"></b>
        </div>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input type="search" class="form-control" placeholder="请输入查询内容">
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item">
                <span class="lb">到期日期【开始】</span>
                <input type="text" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">到期日期【结束】</span>
                <input type="text" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">服务器状态</span>
                <select class="form-control">
                    <option value="">--请选择--</option>
                    <option value="在线运行">在线运行</option>
                    <option value="闲置空机">闲置空机</option>
                    <option value="终止合同">终止合同</option>
                    <option value="期满移出">期满移出</option>
                    <option value="暂出维护">暂出维护</option>
                    <option value="下架">下架</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机房</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>河东3楼小机房</option>
                    <option>嘉兴机房</option>
                    <option>福州机房</option>
                    <option>河东3楼大机房</option>
                    <option>河东4楼机房</option>
                    <option>移动机房</option>
                    <option>宿城机房</option>
                    <option>宿迁联通</option>
                    <option>扬州</option>
                    <option>湖滨新机房</option>
                    <option>丽水机房</option>
                    <option>徐州机房</option>
                    <option>镇江机房</option>
                    <option>京东云</option>
                    <option>徐州机房（枫信）</option>
                    <option>杭州机房</option>
                    <option>大连小鸟云机房</option>
                    <option>厦门机房</option>
                    <option>盐城机房</option>
                    <option>佛山机房</option>
                    <option>常州机房</option>
                    <option>财富广场机房</option>
                    <option>虚拟机房</option>
                    <option>广州机房</option>
                    <option>常州武进机房</option>
                    <option>凤凰美地</option>
                    <option>山东-枣庄机房</option>
                    <option>颐景华庭机房</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机柜</span>
                <select class="form-control">
                    <option>--请选择--</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">设备类型</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>服务器</option>
                    <option>交换机</option>
                    <option>防火墙</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">产品类型</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>服务器托管</option>
                    <option>服务器租用</option>
                    <option>机柜-流量计费</option>
                    <option>监控管理</option>
                    <option>交换机管理地址</option>
                    <option>租用机柜</option>
                    <option>带宽费用</option>
                    <option>托管机柜</option>
                    <option>机柜-端口20M</option>
                    <option>本公司自用</option>
                    <option>空闲机器</option>
                    <option>Peter Winter</option>
                    <option>IP记录</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">相关销售</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>杨龙</option>
                    <option>王酥</option>
                    <option>杨宁</option>
                    <option>张续祥</option>
                    <option>孙一</option>
                    <option>蔡涛</option>
                    <option>何硕</option>
                    <option>汤瑞东</option>
                    <option>慧慧</option>
                    <option>杨总安排</option>
                    <option>公司自用</option>
                    <option>客户授权</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">机器转让</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>转让机器</option>
                    <option>未转让机器</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <button class="btn btn-primary fl"><i class="fa fa-external-link"></i> 导 出</button>
            <div class="oprt-wrap dn">
            <button class="btn btn-info ml10 fl"><i class="fa fa-question-circle"></i> 问题处理</button>
            <button class="btn btn-info ml10 fl"><i class="fa fa-arrow-circle-o-down"></i> 下架</button>
            <button class="btn btn-info ml10 fl"><i class="fa fa-arrow-circle-right"></i> 服务器转让</button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-download"></i> 系统安装</button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-pencil-square-o"></i></button>
            <button class="btn btn-danger ml10 fl"><i class="fa fa-trash"></i></button>
            <button class="btn btn-success ml10 fl"><i class="fa fa-eye"></i></button>
            </div>
            <div class="page fr"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID</th><th>客户名称</th><th>服务器类型</th><th>服务器状态</th><th>IP地址</th><th>IP数量</th><th>所在机房</th><th>所在机柜</th>
                    <th>交换机端口</th><th>服务器外形</th><th>自动化</th><th>配置</th><th>带宽限制</th><th>备注</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><a href="javascript:;" class="userid">9527</a></td>
                    <td><a href="javascript:;" class="username">山顶洞人</a></td>
                    <td>服务器租用</td>
                    <td><span class="label label-success">在线运行</span></td>
                    <td>0.0.0.0</td>
                    <td>1</td>
                    <td>所在机房</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="14" style="line-height: 2em;">
                            <span class="total-item"><span class="label label-primary">总台数:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-primary">本公司自用:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-primary">空闲机器:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">河东4楼机房:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">河东3楼大机房:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">京东云:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">凤凰美地:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">虚拟机房:</span> 0</span>&nbsp;
                            <span class="total-item"><span class="label label-info">扬州:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">湖滨新机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">广州机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">嘉兴机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">财富广场机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">徐州机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">福州机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">颐景华庭机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">镇江机房:</span> 000</span>&nbsp;
                            <span class="total-item"><span class="label label-info">河东3楼小机房   :</span> 000</span>&nbsp;                            
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>