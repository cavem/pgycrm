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
.bdred{border-color: red !important;}
</style>
<script>
$(function(){
    $("input").blur(function(){
        if($(this).val()!=''){
            $(this).removeClass("bdred");
        }
    })
    $("select[name='room']").change(function(){
        var idcname=$(this).children("option:selected").val();
        $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
            data=JSON.parse(data);
            var shelfcon='<option value="">--请选择--</option>';
            for(var i in data){
                shelfcon+='<option value="'+data[i]['code']+'">'+data[i]['code']+'</option>';
            }
            $("select[name='cabinet']").html(shelfcon);
        })
    })
    $('.edit-ip').click(function(){
        var serv_ip=$("input[name='ip_addr']").val();
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
            $("input[name='ip_addr']").val(ip_addrstr);
            layer.closeAll(); 
        }
        myalert('修改IP','800px','540px',"<?php echo U('Service/edit_ip');?>"+"?serv_ip="+serv_ip,confirm);
    })
})
</script>
<!-- 弹窗-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <form class="mform">
        <input type="hidden" name="id" value="<?php echo ($swcinfo["id"]); ?>">
        <div class="form-line w50 fl">
            <span class="form-label">使用公司：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="company" value="<?php echo ($swcinfo["company"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">所在机房：</span>
            <select class="form-control" name="room" style="width: 250px;">
                <option value="">--请选择--</option>
                <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option <?php if($swcinfo['room'] == $vo): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">所在机柜：</span>
            <select class="form-control" name="cabinet" style="width: 250px;">
                <option><?php echo ($swcinfo["cabinet"]); ?></option>
            </select>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 交换机编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="switch_id" value="<?php echo ($swcinfo["switch_id"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">资产编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="asset_id" value="<?php echo ($swcinfo["asset_id"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 端口数：</span>
            <div class="form-content" style="width: 250px;">
                共<input class="form-control" type="text" name="port_num" value="<?php echo ($swcinfo["port_num"]); ?>" style="width: 200px;">口
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> IP地址：</span>
            <div class="form-content" style="width: 663px;">
                <input class="form-control" type="text" name="ip_addr" value="<?php echo ($swcinfo["ip_addr"]); ?>">
            </div>
            <a class="btn btn-info edit-ip" style="padding: 7px 13px;margin-left: -4px;margin-top: -2px;">
                ...
            </a>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">上联设备：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="up_switch" value="<?php echo ($swcinfo["up_switch"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">上联端口：</span>
            <div class="form-content" style="width: 250px;">
                第<input class="form-control" type="text" name="up_port" value="<?php echo ($swcinfo["up_port"]); ?>" style="width: 200px;">口
            </div>
        </div>
    </form>  
</div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>