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
.myalert-main{width: 100%;}
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display:inline-block;width: 150px;text-align: right;font-weight: bold;}
.w50{width: 50%;text-align: left;}
.form-content{width: 700px;text-align: left;display: inline-block;}
.form-control{display: initial;}
.tab-content{padding: 10px;}
/*layui*/
.layui-tab{margin: 0;}
.layui-tab-title{background: #fff;}
.layui-tab-title .layui-this{color: #28b779;background: #eee;}
.layui-tab-title .layui-this:after{border-bottom-color:transparent;border-top-color: #28b779;}
/*bootstap*/
.panel-title{display: inline-block;}
.opt-wrap{position: relative;bottom: 4px;}
ul{margin-bottom: 0;}
input[type=checkbox], input[type=radio]{margin: 0;}
</style>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <form class="mform">
        <input type="hidden" name="nid" value="<?php echo ($finaninfo["nid"]); ?>">
        <div class="form-line w50 fl">
            <span class="form-label">客户名称：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="cname" readonly value="<?php echo ($finaninfo["cname"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">财务编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" name="ddid" type="text" readonly value="<?php echo ($finaninfo["id"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">订单类型：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="ordertype">
                    <option value="新业务">新业务</option>
                    <option value="续费业务">续费业务</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">相关销售：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="salers">
                    <option value="">--请选择--</option>
                    <option <?php if($finaninfo["salesman"] == '杨龙'): ?>selected<?php endif; ?>>杨龙</option>
                    <option <?php if($finaninfo["salesman"] == '王酥'): ?>selected<?php endif; ?>>王酥</option>
                    <option <?php if($finaninfo["salesman"] == '杨宁'): ?>selected<?php endif; ?>>杨宁</option>
                    <option <?php if($finaninfo["salesman"] == '孙一'): ?>selected<?php endif; ?>>孙一</option>
                    <option <?php if($finaninfo["salesman"] == '蔡涛'): ?>selected<?php endif; ?>>蔡涛</option>
                    <option <?php if($finaninfo["salesman"] == '何硕'): ?>selected<?php endif; ?>>何硕</option>
                    <option <?php if($finaninfo["salesman"] == '汤瑞东'): ?>selected<?php endif; ?>>汤瑞东</option>
                    <option <?php if($finaninfo["salesman"] == '慧慧'): ?>selected<?php endif; ?>>慧慧</option>
                    <option <?php if($finaninfo["salesman"] == '杨总安排'): ?>selected<?php endif; ?>>杨总安排</option>
                    <option <?php if($finaninfo["salesman"] == '公司自用'): ?>selected<?php endif; ?>>公司自用</option>
                    <option <?php if($finaninfo["salesman"] == '客户授权'): ?>selected<?php endif; ?>>客户授权</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">财务类型：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" readonly value="财务收入">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">款项类别：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="type">
                    <option <?php if($finaninfo["type"] == '应收款'): ?>selected<?php endif; ?>>应收款</option>
                    <option <?php if($finaninfo["type"] == '预付款'): ?>selected<?php endif; ?>>预付款</option>
                    <option <?php if($finaninfo["type"] == '余额'): ?>selected<?php endif; ?>>余额</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">款项状态：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="state">
                    <option <?php if($finaninfo["state"] == '款到确认'): ?>selected<?php endif; ?>>款到确认</option>
                    <option <?php if($finaninfo["state"] == '已付款'): ?>selected<?php endif; ?>>已付款</option>
                    <option <?php if($finaninfo["state"] == '已确认'): ?>selected<?php endif; ?>>已确认</option>
                    <option <?php if($finaninfo["state"] == '未付款'): ?>selected<?php endif; ?>>未付款</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">付款金额：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="money" value="<?php echo ($finaninfo["money"]); ?>">
            </div>
        </div>        
        <div class="form-line w50 fl">
            <span class="form-label">收款方式：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="recvtype">
                    <option <?php if($finaninfo["recvtype"] == '支付宝'): ?>selected<?php endif; ?>>支付宝</option>
                    <option <?php if($finaninfo["recvtype"] == '微信支付'): ?>selected<?php endif; ?>>微信支付</option>
                    <option <?php if($finaninfo["recvtype"] == '对公支付宝'): ?>selected<?php endif; ?>>对公支付宝</option>
                    <option <?php if($finaninfo["recvtype"] == '工商银行'): ?>selected<?php endif; ?>>工商银行</option>
                    <option <?php if($finaninfo["recvtype"] == '农业银行'): ?>selected<?php endif; ?>>农业银行</option>
                    <option <?php if($finaninfo["recvtype"] == '建设银行'): ?>selected<?php endif; ?>>建设银行</option>
                    <option <?php if($finaninfo["recvtype"] == '江苏银行'): ?>selected<?php endif; ?>>江苏银行</option>
                    <option <?php if($finaninfo["recvtype"] == '农行对公账户'): ?>selected<?php endif; ?>>农行对公账户</option>
                    <option <?php if($finaninfo["recvtype"] == '财付通'): ?>selected<?php endif; ?>>财付通</option>
                    <option <?php if($finaninfo["recvtype"] == 'QQ钱包'): ?>selected<?php endif; ?>>QQ钱包</option> 
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">票据开设：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="receipt">
                    <option <?php if($finaninfo["receipt"] == '无需票据'): ?>selected<?php endif; ?>>无需票据</option>
                    <option <?php if($finaninfo["receipt"] == '需要发票'): ?>selected<?php endif; ?>>需要发票</option>
                    <option <?php if($finaninfo["receipt"] == '需要收据'): ?>selected<?php endif; ?>>需要收据</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">付款周期：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="paycycle">
                    <option value="月付" <?php echo ($finaninfo['paycycle']=="月付"?'selected':''); ?>>月付</option>
                    <option value="季付" <?php echo ($finaninfo['paycycle']=="季付"?'selected':''); ?>>季付</option>
                    <option value="半年付" <?php echo ($finaninfo['paycycle']=="半年付"?'selected':''); ?>>半年付</option>
                    <option value="年付" <?php echo ($finaninfo['paycycle']=="年付"?'selected':''); ?>>年付</option>
                </select>
            </div>
        </div>

        <div class="form-line w50 fl">
            <span class="form-label">费用开始日期：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="fee_begin_at" value="<?php echo ($finaninfo["fee_begin_at"]); ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">银行款到日期：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="bank_recv_at" value="<?php echo ($finaninfo["bank_recv_at"]); ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">费用结束日期：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="fee_end_at" value="<?php echo ($finaninfo["fee_end_at"]); ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label" style="position: relative;bottom: 80px;">备注：</span>
            <div class="form-content">
                <textarea class="form-control" rows="5" name="remark"><?php echo ($prepay["remark"]); ?></textarea>
            </div>
        </div>
    </form>  
</div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>