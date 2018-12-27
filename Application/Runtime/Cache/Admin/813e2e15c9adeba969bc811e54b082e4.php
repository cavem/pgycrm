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
.myalert-main{width: 100%;overflow: hidden;padding:15px;}
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

})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
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
</div>
</div>
</body>
</html>