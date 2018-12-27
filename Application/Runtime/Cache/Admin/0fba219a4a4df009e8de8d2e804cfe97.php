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

})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">基本信息</li>
        <li>预付款记录</li>
        <li>订单列表</li>
        <li>服务器列表</li>
    </ul>
    <div class="layui-tab-content">
        <!-- 基本信息 -->
        <div class="layui-tab-item layui-show">
            <table class="table table-bordered">
                <colgroup><col width="15%"> <col width="35%"> <col width="15%"> <col width="35%"></colgroup>
                <tbody>
                    <tr>
                        <td class="claaa">客户名称</td>
                        <td><?php echo ($userinfo["name"]); ?></td>
                        <td class="claaa">联系人</td>
                        <td><?php echo ($userinfo["contact"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">客户地址</td>
                        <td colspan="3"><?php echo ($userinfo["addr"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">QQ</td>
                        <td><?php echo ($userinfo["qq"]); ?></td>
                        <td class="claaa">邮箱</td>
                        <td><?php echo ($userinfo["mail"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">电话号码</td>
                        <td><?php echo ($userinfo["tel"]); ?></td>
                        <td class="claaa">手机号码</td>
                        <td><?php echo ($userinfo["cellphone"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">预存款</td>
                        <td><span style="color: red;font-weight: bold;"><?php echo ($userinfo["prepay"]); ?></span>元</td>
                        <td class="claaa">身份证号码</td>
                        <td><?php echo ($userinfo["idnumber"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">客户来源</td>
                        <td><?php echo ($userinfo["source"]); ?></td>
                        <td class="claaa">客户类型</td>
                        <td><?php echo ($userinfo[""]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">客户等级</td>
                        <td><?php echo ($userinfo["class"]); ?></td>
                        <td class="claaa">客户状态</td>
                        <td><?php echo ($userinfo["state"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">客户备注</td>
                        <td colspan="3"><?php echo ($userinfo["remark"]); ?></td>
                    </tr>
                    <tr>
                        <td class="claaa">提交人</td>
                        <td><?php echo ($userinfo["committer"]); ?></td>
                        <td class="claaa">提交时间</td>
                        <td><?php echo ($userinfo["create_at"]); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- 预付款记录 -->
        <div class="layui-tab-item">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">收款记录</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>金额</th>
                                <th>收款银行</th>
                                <th>入款日期</th>
                                <th>提交时间</th>
                                <th>备注</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($prepaylist)): $k = 0; $__LIST__ = $prepaylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                                <td><?php echo ($k); ?></td>
                                <td><?php echo ($vo["money"]); ?></td>
                                <td><?php echo ($vo["paybank"]); ?></td>
                                <td><?php echo ($vo["pay_at"]); ?></td>
                                <td><?php echo ($vo["create_at"]); ?></td>
                                <td><?php echo ($vo["remark"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">使用记录</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>使用金额</th>
                                <th>财务ID</th>
                                <th>使用时间</th>
                                <th>提交人</th>
                                <th>备注</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($prepayloglist)): $k = 0; $__LIST__ = $prepayloglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                                <td><?php echo ($k); ?></td>
                                <td><?php echo ($vo["money"]); ?></td>
                                <td><?php echo ($vo["fid"]); ?></td>
                                <td><?php echo ($vo["create_at"]); ?></td>
                                <td><?php echo ($vo["committer"]); ?></td>
                                <td><?php echo ($vo["remark"]); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- 订单列表 -->
        <div class="layui-tab-item">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>开始日期</th>
                        <th>下次付款日期</th>
                        <th>订单状态</th>
                        <th>订单类型</th>
                        <th>订单金额</th>
                        <th>相关销售</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($orderlist)): $k = 0; $__LIST__ = $orderlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($k); ?></td>
                        <td><?php echo ($vo["order_begin_at"]); ?></td>
                        <td><?php echo ($vo["last_pay_at"]); ?></td>
                        <td><?php echo ($vo["status"]); ?></td>
                        <td><?php echo ($vo["ordertype"]); ?></td>
                        <td><?php echo ($vo["money"]); ?></td>
                        <td><?php echo ($vo["salesman"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
        <!-- 服务器列表 -->
        <div class="layui-tab-item">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>服务器编号</th>
                        <th>机柜编号</th>
                        <th>服务器状态</th>
                        <th>操作系统</th>
                        <th>IP地址</th>
                        <th>创建日期</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($servlist)): $k = 0; $__LIST__ = $servlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($k); ?></td>
                        <td><?php echo ($vo["servnum"]); ?></td>
                        <td><?php echo ($vo["shelfcode"]); ?></td>
                        <td><?php echo ($vo["servstate"]); ?></td>
                        <td><?php echo ($vo["os"]); ?></td>
                        <td><span style="display:block;width: 150px;overflow: hidden;" title="<?php echo ($vo["serv_ip"]); ?>"><?php echo ($vo["serv_ip"]); ?></span></td>
                        <td><?php echo ($vo["inserttime"]); ?></td>
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