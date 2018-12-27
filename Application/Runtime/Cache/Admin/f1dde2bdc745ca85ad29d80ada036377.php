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
    $("select[name='IDCName']").change(function(){
        var idcname=$(this).children("option:selected").val();
        var meshelfcode=$('.meshelfcode').val();
        $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
            data=JSON.parse(data);
            var shelfcon="";
            for(var i in data){
                if(data[i]['code']==meshelfcode){
                    shelfcon+='<option value="'+data[i]['code']+'" selected>'+data[i]['code']+'</option>';
                }else{
                    shelfcon+='<option value="'+data[i]['code']+'">'+data[i]['code']+'</option>';
                }
            }
            $("select[name='ShelfCode']").html(shelfcon);
        })
    })
    $('.edit-ip').click(function(){
        var serv_ip=$("input[name='Serv_IP']").val();
        var serviparr=serv_ip.split("/");
        var tempstr="";
        serviparr.forEach(function(val,index){
            tempstr+=val+'|';
        })
        serv_ip=tempstr;
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var ip_addrstr="";
            var formdata = body.find("input[name='ip_addr']").each(function(){
                ip_addrstr+=$(this).val()+"/";
            });
            $("input[name='Serv_IP']").val(ip_addrstr);
            layer.closeAll(); 
        }
        myalert('修改IP','800px','540px',"<?php echo U('Service/edit_ip');?>"+"?serv_ip="+serv_ip,confirm);
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <form class="mform">
        <input type="hidden" name="ID" value="<?php echo ($servinfo["id"]); ?>">
        <input type="hidden" name="Order_ID" value="<?php echo ($servinfo["order_id"]); ?>">
        <div class="form-line w50 fl">
            <span class="form-label">产品类型：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Productkind" readonly value="<?php echo ($servinfo["productkind"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">服务器编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="ServNum" readonly value="<?php echo ($servinfo["servnum"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">产品所属：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="CustName" readonly value="<?php echo ($servinfo["custname"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">相关销售：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Salers" readonly value="<?php echo ($servinfo["salers"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">联系人：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="CustTech" value="<?php echo ($servinfo["custtech"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">联系电话：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="CustTel" value="<?php echo ($servinfo["custtel"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">服务器外形：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="DeviceShape">
                    <option <?php if($servinfo["deviceshape"] == '刀片机'): ?>selected<?php endif; ?>>刀片机</option>
                    <option <?php if($servinfo["deviceshape"] == '1U'): ?>selected<?php endif; ?>>1U</option>
                    <option <?php if($servinfo["deviceshape"] == '2U'): ?>selected<?php endif; ?>>2U</option>
                    <option <?php if($servinfo["deviceshape"] == '3U'): ?>selected<?php endif; ?>>3U</option>
                    <option <?php if($servinfo["deviceshape"] == '4U'): ?>selected<?php endif; ?>>4U</option>
                    <option <?php if($servinfo["deviceshape"] == '一托2'): ?>selected<?php endif; ?>>一托2</option>
                    <option <?php if($servinfo["deviceshape"] == '一托4'): ?>selected<?php endif; ?>>一托4</option>
                    <option <?php if($servinfo["deviceshape"] == '一托6'): ?>selected<?php endif; ?>>一托6</option>
                    <option <?php if($servinfo["deviceshape"] == '一托7'): ?>selected<?php endif; ?>>一托7</option>
                    <option <?php if($servinfo["deviceshape"] == '一托8'): ?>selected<?php endif; ?>>一托8</option>
                    <option <?php if($servinfo["deviceshape"] == '一托16'): ?>selected<?php endif; ?>>一托16</option>
                    <option <?php if($servinfo["deviceshape"] == '交换机'): ?>selected<?php endif; ?>>交换机</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">服务器状态：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="ServState">
                    <option value="在线运行" <?php if($servinfo["servstate"] == '在线运行'): ?>selected<?php endif; ?>>在线运行</option>
                    <option value="闲置空机" <?php if($servinfo["servstate"] == '闲置空机'): ?>selected<?php endif; ?>>闲置空机</option>
                    <option value="终止合同" <?php if($servinfo["servstate"] == '终止合同'): ?>selected<?php endif; ?>>终止合同</option>
                    <option value="期满移出" <?php if($servinfo["servstate"] == '期满移出'): ?>selected<?php endif; ?>>期满移出</option>
                    <option value="暂出维护" <?php if($servinfo["servstate"] == '暂出维护'): ?>selected<?php endif; ?>>暂出维护</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">所在机房：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="IDCName">
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option value="<?php echo ($vo); ?>" <?php if($servinfo["idcname"] == $vo): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">机柜编号：</span>
            <div class="form-content" style="width: 250px;">
                <input type="hidden" class="meshelfcode" value="<?php echo ($servinfo["shelfcode"]); ?>">
                <select class="form-control" name="ShelfCode">
                    <?php if(is_array($shelflist)): $i = 0; $__LIST__ = $shelflist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["code"]); ?>" <?php if($servinfo['shelfcode']==$vo['code']){echo 'selected';} ?>><?php echo ($vo["code"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">设备类型：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="DeviceType">
                    <option value="服务器" <?php if($servinfo["devicetype"] == '服务器'): ?>selected<?php endif; ?>>服务器</option>
                    <option value="交换机" <?php if($servinfo["devicetype"] == '交换机'): ?>selected<?php endif; ?>>交换机</option>
                    <option value="防火墙" <?php if($servinfo["devicetype"] == '防火墙'): ?>selected<?php endif; ?>>防火墙</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">MAC地址：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="MacAddress" value="<?php echo ($servinfo["macaddress"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">交换机端口：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="SwitchPort" value="<?php echo ($servinfo["switchport"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">自动化：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="Automation">
                    <option value="已开启" <?php if($servinfo["automation"] == '已开启'): ?>selected<?php endif; ?>>已开启</option>
                    <option value="未开启" <?php if($servinfo["automation"] == '未开启'): ?>selected<?php endif; ?>>未开启</option>
                </select>
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label">IP地址：</span>
            <div class="form-content" style="width: 663px;">
                <input class="form-control" type="hidden" name="pre_serv_ip" value="<?php echo ($servinfo["serv_ip"]); ?>">
                <input class="form-control" type="text" name="Serv_IP" value="<?php echo ($servinfo["serv_ip"]); ?>" readonly>
            </div>
            <a class="btn btn-info edit-ip" style="padding: 7px 13px;margin-left: -4px;margin-top: -2px;">
                ...
            </a>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;">服务器配置：</span>
            <div class="form-content">
                <input type="hidden" name="pre_hwconfig" value="<?php echo ($servinfo["hwconfig"]); ?>">
                <textarea class="form-control" name="Hwconfig" rows="2"><?php echo ($servinfo["hwconfig"]); ?></textarea>
            </div>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;">带宽限制：</span>
            <div class="form-content">
                <input type="hidden" name="pre_bandwidth" value="<?php echo ($servinfo["bandwidth"]); ?>">
                <textarea class="form-control" name="Bandwidth" rows="2"><?php echo ($servinfo["bandwidth"]); ?></textarea>
            </div>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;">代理商备注：</span>
            <div class="form-content">
                <textarea class="form-control" name="CustRemarks" rows="2"><?php echo ($servinfo["custremarks"]); ?></textarea>
            </div>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;">服务器备注：</span>
            <div class="form-content">
                <textarea class="form-control" name="Remarks" rows="2"><?php echo ($servinfo["remarks"]); ?></textarea>
            </div>
        </div>
    </form>  
</div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>