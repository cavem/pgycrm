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
<script>
    $(function(){
        $("input[type='checkbox']").click(function(){
            console.log($(this));
        })
        $("select[name='prodcat']").change(function(){
            var category=$(this).val();
            $.post('/Custom/getproduct',{"category":category},function(data,status){
                var data=eval(data);
                console.log(data);
                var str='';
                for(var i in data){
                    var no=parseInt(i)+1;
                    str+='<tr><td>'+no+'</td><td><input type="checkbox" style="width: 16px;height: 16px;"></td><td class="name">'+data[i]['name']+'</td><td><input class="num" value="1" style="width:50px;">台</td><td><span class="price">'+data[i]['price']+'</span>元/月</td><td>'+data[i]['desc']+'</td><tr>';
                }
                $('.dtable').html(str);
            })
        })
    })
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
<form class="mform">
    <div class="layui-tab">
        <ul class="layui-tab-title">
            <li class="layui-this">订单信息</li>
            <li>服务器信息</li>
        </ul>
        <div class="layui-tab-content">
            <!-- 订单信息 -->
            <div class="layui-tab-item layui-show">
                <div class="form-line w50 fl">
                    <span class="form-label">客户名称：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="cname" readonly value="<?php echo ($orderinfo["cname"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单编号：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="id" readonly value="<?php echo ($orderinfo["id"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">相关销售：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="salesman" value="<?php echo ($orderinfo["salesman"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">相关合同：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="contract" value="<?php echo ($orderinfo["contract"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单类型：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="ordertype">
                            <option <?php echo ($orderinfo['ordertype']=="新业务"?'selected':''); ?>>新业务</option>
                            <option <?php echo ($orderinfo['ordertype']=="续费业务"?'selected':''); ?>>续费业务</option>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单状态：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="status">
                            <option <?php echo ($orderinfo['status']=="已生效"?'selected':''); ?>>已生效</option>
                            <option <?php echo ($orderinfo['status']=="已取消"?'selected':''); ?>>已取消</option>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单性质：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="orderprop">
                            <option <?php echo ($orderinfo['orderprop']=="正式"?'selected':''); ?>>正式</option>
                            <option <?php echo ($orderinfo['orderprop']=="测试"?'selected':''); ?>>测试</option>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">是否免费：</span>
                    <div class="form-content" style="width: 250px;">
                        是 <input type="radio" name="free" value="true" <?php echo ($orderinfo['free']=="true"?'checked':''); ?>> 
                        否 <input type="radio" name="free" value="false" <?=$orderinfo['free']=="false"||empty($orderinfo['free'])?'checked':''?>>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">付款方式：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="paytype">
                            <option <?php echo ($orderinfo['paytype']=="后付费"?'selected':''); ?>>后付费</option>
                            <option <?php echo ($orderinfo['paytype']=="先付费"?'selected':''); ?>>先付费</option>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">付款周期：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="paycycle">
                            <option <?php echo ($orderinfo['paycycle']=="月付"?'selected':''); ?>>月付</option>
                            <option <?php echo ($orderinfo['paycycle']=="季付"?'selected':''); ?>>季付</option>
                            <option <?php echo ($orderinfo['paycycle']=="半年付"?'selected':''); ?>>半年付</option>
                            <option <?php echo ($orderinfo['paycycle']=="年付"?'selected':''); ?>>年付</option>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单开始日期：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="order_begin_at" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo ($orderinfo["order_begin_at"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">下次付款日期：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="last_pay_at" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo ($orderinfo["order_end_at"]); ?>">
                    </div>
                </div>
                <div class="form-line fl">
                    <span class="form-label" style="position: relative;bottom: 80px;">订单备注：</span>
                    <div class="form-content">
                        <textarea class="form-control" rows="6" name="remark"><?php echo ($orderinfo["remark"]); ?></textarea>
                    </div>
                </div>
            </div>
            <!-- 服务器信息 -->
            <div class="layui-tab-item">
                <div class="form-line w50 fl">
                    <span class="form-label">服务器产权：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="propertyof" value="<?php echo ($orderinfo["propertyof"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">预选机房：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="preroom">
                            <option value="">--请选择--</option>
                            <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option value="<?php echo ($vo); ?>" <?php echo ($orderinfo['preroom']==$vo?'selected':''); ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">产品种类：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="prodcat">
                            <option value="">--请选择--</option>
                            <?php if(is_array($pdtkindlist)): $i = 0; $__LIST__ = $pdtkindlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["name"]); ?>"  <?php echo ($orderinfo['prodcat']==$vo['name']?'selected':''); ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">订单总额：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="money" value="<?php echo ($orderinfo["money"]); ?>">
                    </div>
                </div>
                <table class="table table-bordered" style="width:90%;margin: 0 auto;">
                    <thead>
                        <tr>
                            <th style="width: 35px;"></th>
                            <th style="width: 35px;"></th>
                            <th>产品名称</th>
                            <th>数量</th>
                            <th>价格</th>
                            <th>配置</th>
                        </tr>
                    </thead>
                    <tbody class="dtable">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
</div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>