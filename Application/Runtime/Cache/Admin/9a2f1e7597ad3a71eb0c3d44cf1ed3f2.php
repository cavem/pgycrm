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
        $('.sform').submit();
    })
    $('#searchbox').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            layer.load();
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
#content {background: #CCE8CC !important;overflow-x: scroll;}
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
})
</script>
<!-- 弹窗-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <form class="mform">
        <input type="hidden" name="id" value="<?php echo ($cabtinfo["id"]); ?>">
        <div class="form-line w50 fl">
            <span class="form-label">使用公司：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="company" value="<?php echo ($cabtinfo["company"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">所在机房</span>
            <select class="form-control" name="room" style="width: 250px;">
                <option value="">--请选择--</option>
                <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option value="<?php echo ($vo); ?>" <?php if($cabtinfo['room'] == $vo): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 机柜编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="code" value="<?php echo ($cabtinfo["code"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">可用U数：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="u_num" value="<?php echo ($cabtinfo["u_num"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">APC设备IP：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="apc_ip" value="<?php echo ($cabtinfo["apc_ip"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">APC设备管理URL：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="apc_url" value="<?php echo ($cabtinfo["apc_url"]); ?>">
            </div>
        </div>
    </form>  
</div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>