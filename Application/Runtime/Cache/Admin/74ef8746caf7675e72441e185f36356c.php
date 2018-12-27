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
    <link rel="stylesheet" href="/Public/assets/css/paging.css" />
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://222.187.221.236:3000/socket.io/socket.io.js"></script>
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
        if($(this).val()!=''){
            $('.empty').show();
        }else{
            $('.empty').hide();
        }
    })
    $('.search').click(function(){
        layer.load();
        $('.sform').attr("action","");
        $('.sform').submit();
    })
    $('#searchbox').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            layer.load();
            $('.sform').attr("action","");
            $('.sform').submit();
        }
    })
    $('.empty').click(function(){
        layer.load();
        $("#searchbox").val('');
        $('.sform').submit();
    })
    $("#pagebox").bind('keyup', function(event) {
        if (event.keyCode == "13") {
            layer.load();
            $('.gopage').click();
        }
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
.mt5{margin-top:5px;}
.fl{float: left;}
.fr{float: right;}
.dib{display: inline-block;}
.db{display:block;}
.dn{display: none;}
.widget-title, .modal-header, .table th, div.dataTables_wrapper .ui-widget-header{background: transparent;}
.updown{background: transparent !important;}
/*bootstrap*/
.btn{padding: 7px 20px;}
.btn-sm{padding: 5px 10px !important;}
.form-control{border-radius:initial;}
.table th{text-align: left;font-size: 14px;}
.table-hover>tbody>tr:hover {background-color: #e6e6e6;}
.lsit-wrap .table>tbody>tr>td{vertical-align: middle;padding:4px;}
tr:hover {background: transparent;}
.label{padding: .3em .6em;}
.alert {padding: 5px 35px 5px 5px;border: 1px solid transparent;border-radius: 4px;margin-bottom: 0;}
.pagination{margin: 0;}
/* content-header */
#content-header{padding: 5px 0 10px 0;margin:0 20px;margin-top:0px !important;overflow: hidden;border-bottom: 2px solid #ddd;width: initial !important;}
.header-title{font-size: 20px;font-weight: bold;display: block;float: left;position: relative;top: 5px;}
.mysearchbox{position: relative;background: #ddd;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
.mysearchbox input{border: none;background: #ddd;}
.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
.empty{position: absolute;top: 11px;right: 11px;cursor: pointer;display: none;}
.empty:hover{color: red;}
.condition-panel{display: none;width: 100%;overflow: hidden;padding: 10px;}
.condition-panel-item{width: 10%;padding: 0 10px;float:left;}
.condition-panel-item .lb{margin-bottom: 10px;font-weight: bold;display: block;}
@media (max-width: 1366px) and (min-width: 481px){
#content {margin-left: 0 !important;}
.panel-group{width: 60% !important;}
}
#content {background: #fff !important;overflow-x: scroll;}
</style>
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<style>
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;overflow: hidden;}
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display:inline-block;width: 150px;text-align: right;font-weight: bold;}
.w50{width: 50%;text-align: left;}
.form-content{width: 700px;text-align: left;display: inline-block;}
.form-control{display: initial;}
.tab-content{padding: 10px;}
.claaa{color: #888;}
/*layui*/
.layui-tab{margin: 0;}
.layui-tab-title{background: #fff;}
.layui-tab-title .layui-this{color: #28b779;background: #eee;}
.layui-tab-title .layui-this:after{border-bottom-color:transparent;border-top-color: #28b779;}
/*boot*/
.panel-body{background: #eee;}
</style>
<script>
$(function(){
    var init=function(){
        var id=-1;
        $(".serv-tbody").children('tr').each(function(){
            if(!$(this).hasClass('dn')){
                id++;
                $(this).children("td:first").text(id);
            }
        })
    }
    init();
    $('.disall').click(function(){
        if($(this).text()=='显示全部状态'){
            $(this).closest('.layui-tab-item').find('table .neqyx').removeClass('dn');
            $(this).text('只显示在线运行');
            init();
        }else{
            $(this).closest('.layui-tab-item').find('table .neqyx').addClass('dn');
            $(this).text('显示全部状态');
            init();
        }
    })
    $('.viewip').click(function(){
        layer.alert($(this).attr('title'));
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">订单信息</li>
            <li>服务器信息</li>
            <li>财务收入</li>
        </ul>
        
        <div class="layui-tab-content">
            <!-- 订单信息 -->
            <div class="layui-tab-item layui-show">
            <table class="table table-bordered">
                <colgroup><col width="15%"> <col width="35%"> <col width="15%"> <col width="35%"></colgroup>
                <tbody>
                    <tr>
                        <td class="claaa">订单编号</td>
                        <td><?php echo ($orderinfo["id"]); ?></td>
                        <td class="claaa">客户名</td>
                        <td><?php echo ($orderinfo["cname"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">QQ</td>
                        <td><?php echo ($orderinfo["qq"]); ?></td>
                        <td class="claaa">电话</td>
                        <td><?php echo ($orderinfo["cellphone"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">订单状态</td>
                        <td><?php echo ($orderinfo["status"]); ?></td>
                        <td class="claaa">订单性质</td>
                        <td><?php echo ($orderinfo["orderprop"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">订单类型</td>
                        <td><?php echo ($orderinfo["ordertype"]); ?></td>
                        <td class="claaa">销售</td>
                        <td><?php echo ($orderinfo["salesman"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">付款类型</td>
                        <td><?php echo ($orderinfo["paytype"]); ?></td>
                        <td class="claaa">付款周期</td>
                        <td><?php echo ($orderinfo["paycycle"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">订单开始日期</td>
                        <td><?php echo ($orderinfo["order_begin_at"]); ?></td>
                        <td class="claaa">下次付款日期</td>
                        <td><?php echo ($orderinfo["order_end_at"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">产品种类</td>
                        <td><?php echo ($orderinfo["prodcat"]); ?></td>
                        <td class="claaa">是否免费</td>
                        <td>
                            <?php switch($orderinfo["free"]): case "true": ?>免费<?php break;?>
                                <?php case "false": ?>收费<?php break;?>
                                <?php default: endswitch;?>
                        </td>
                    </tr>
                    <tr>
                        <td class="claaa">预选机房</td>
                        <td><?php echo ($orderinfo["preroom"]); ?></td>
                        <td class="claaa">订单总额</td>
                        <td><?php echo ($orderinfo["money"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">IP地址</td>
                        <td colspan="3">
                            <table style="width: 100%;">
                                <tr>
                                    <td><?php echo (substr($orderinfo["ipaddr"],0,95)); ?></td>
                                    <td>
                                        <?php if(!empty($orderinfo['ipaddr'])&&strlen($orderinfo['ipaddr'])>95) :?>
                                        ...<span class="glyphicon glyphicon-eye-open" style="padding-left: 1em;float: right;" title="<?php echo ($orderinfo["ipaddr"]); ?>"></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="claaa">备注</td>
                        <td colspan="3"><?php echo ($orderinfo["remark"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">提交人</td>
                        <td><?php echo ($orderinfo["committer"]); ?></td>
                        <td class="claaa">提交时间</td>
                        <td><?php echo ($orderinfo["create_at"]); ?></td>
                    </tr>
                </tbody>
            </table>
            </div>
            <!-- 服务器信息-->
            <div class="layui-tab-item" style="overflow: auto;">
                <a class="btn btn-link disall">显示全部状态</a>
                <table class="table table-bordered servtable" style="min-width: 1300px;">
                    <tbody class="serv-tbody">
                        <tr>
                            <th style="width: 10px;">ID</th>
                            <th style="width: 180px;">编号</th>
                            <th style="width: 80px;">状态</th>
                            <th>IP</th>
                            <th>带宽</th>
                            <th style="width: 100px;">服务器外形</th>
                            <th>所在机房</th>
                            <th>机柜编号</th>
                            <th>配置</th>
                        </tr>
                        <?php if(is_array($servinfo)): foreach($servinfo as $k=>$vo): ?><tr <?php if($vo["servstate"] != '在线运行'): ?>class="neqyx dn"<?php endif; ?>>
                            <td></td>
                            <td><?php echo ($vo["servnum"]); ?></td>
                            <td>
                                <?php switch($vo["servstate"]): case "在线运行": ?><span class="label label-success">在线运行</span><?php break;?>
                                    <?php case "闲置空机": ?><span class="label label-primary">闲置空机</span><?php break;?>
                                    <?php case "终止合同": ?><span class="label label-danger">终止合同</span><?php break;?>
                                    <?php case "期满移出": ?><span class="label label-warning">期满移出</span><?php break;?>
                                    <?php case "暂出维护": ?><span class="label label-info">暂出维护</span><?php break;?>
                                    <?php case "下架": ?><span class="label label-danger">下架</span><?php break; endswitch;?>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td><?php echo (substr($vo["serv_ip"],0,45)); ?></td>
                                        <?php if(!empty($vo['serv_ip'])&&strlen($vo['serv_ip'])>45) :?>
                                        <td>
                                            <div style="width: 50px;">...<span class="glyphicon glyphicon-eye-open viewip" style="padding-left: 1em" title="<?php echo ($vo["serv_ip"]); ?>"></span></div>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo ($vo["bandwidth"]); ?></td>
                            <td><?php echo ($vo["deviceshape"]); ?></td>
                            <td><?php echo ($vo["idcname"]); ?></td>
                            <td><?php echo ($vo["shelfcode"]); ?></td>
                            <td><?php echo ($vo["hwconfig"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- 财务收入-->
            <div class="layui-tab-item" style="overflow: auto;">
                <table class="table table-hover" style="min-width: 1800px;">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>财务编号/订单编号</th><th>相关IP</th><th>客户名称</th><th>到款日期</th><th>付款状态</th><th>收款金额</th><th>收款方式</th>
                        <th>付款周期</th>
                        <th>备注</th><th>相关销售</th><th>费用开始日期</th><th>费用结束日期</th><th>提交人</th><th>款到确认日期</th><th>款到确认人</th>
                        <th>确认日期</th><th>确认人</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($finanlst)): $i = 0; $__LIST__ = $finanlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["nid"]); ?></td>
                            <td><a href="javascript:;" class="view_order id" title="查看订单详情"><?php echo ($vo["id"]); ?></a></td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td><?php echo (substr($vo["ipaddr"],0,30)); ?></td>
                                        <td>
                                            <?php if(!empty($vo['ipaddr'])&&strlen($vo['ipaddr'])>30) :?>
                                            ... <span class="fa fa-eye" style="padding-left: 1em;float: right;" title="<?php echo ($vo["ipaddr"]); ?>"></span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td><a href="javascript:;" class="username js-pop js-drill" data-cid="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cname"]); ?></a></td>
                            <td><?php echo substr($vo['bank_recv_at'],0,10); ?></td>
                            <td>
                                <?php switch($vo["state"]): case "款到确认": ?><span class="label label-info">款到确认</span><?php break;?>
                                    <?php case "已付款": ?><span class="label label-warning">已付款</span><?php break;?>
                                    <?php case "已确认": ?><span class="label label-success">已确认</span><?php break;?>
                                    <?php case "已过期": ?><span class="label label-default">已过期</span><?php break; endswitch;?>
                            </td>
                            <td><?php echo (intval($vo["money"])); ?></td>
                            <td><?php echo ($vo["recvtype"]); ?></td>
                            <td><?php echo ($vo["paycycle"]); ?></td>
                            <td><?php echo ($vo["remark"]); ?></td>
                            <td><?php echo ($vo["salesman"]); ?></td>
                            <td><?php echo (substr($vo["fee_begin_at"],0,10)); ?></td>
                            <td><?php echo (substr($vo["fee_end_at"],0,10)); ?></td>
                            <td><?php echo ($vo["committer"]); ?></td>
                            <td><?php echo (substr($vo["paysure_at"],0,10)); ?></td>
                            <td><?php echo ($vo["paysureby"]); ?></td>
                            <td><?php echo (substr($vo["managersure_at"],0,10)); ?></td>
                            <td><?php echo ($vo["managersureby"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>      
</div>
</div>
</div>
</body>
</html>