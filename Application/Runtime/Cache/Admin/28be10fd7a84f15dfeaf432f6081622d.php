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
.bdred{border-color: red !important;}
</style>
<script>
$(function(){
    $('.upload').click(function(){
        $('.file').click();
    })
    $(".file").bind('change', function () {
        var filedata=new FormData(document.getElementById("fileform"));
        console.log(filedata);
        $.ajax({
　　　　　　　　url : '/Custom/uploadimg', 
　　　　　　　　type : "post",
　　　　　　　　data : filedata, //第二个Form表单的内容
　　　　　　　　processData : false,
　　　　　　　　contentType : false,
　　　　　　　　error : function(request) {
　　　　　　　　},
　　　　　　　　success : function(data) {
　　　　　　　　　　$("input[name='idcopy']").val(data);
                  $('.idimg').attr("src",data);
　　　　　　　  }
　　　　　});
    });
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
<div class="layui-tab">
    <ul class="layui-tab-title">
        <li class="layui-this">基本信息</li>
        <li>需求信息</li>
    </ul>
    <div class="layui-tab-content">
        <!-- 基本信息 -->
        <div class="layui-tab-item layui-show">
            <form class="mform">
                <input type="hidden" name="id" value="<?php echo ($clientinfo["id"]); ?>">
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> 客户名称：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="name" value="<?php echo ($clientinfo["name"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">客户地址：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="addr" value="<?php echo ($clientinfo["addr"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> 联系人：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="contact" value="<?php echo ($clientinfo["contact"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> 身份证号码：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="idnumber" value="<?php echo ($clientinfo["idnumber"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> QQ号码：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="qq" value="<?php echo ($clientinfo["qq"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">电话号码：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="tel" value="<?php echo ($clientinfo["tel"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> 手机号码：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="cellphone" value="<?php echo ($clientinfo["cellphone"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">邮箱：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="mail" value="<?php echo ($clientinfo["mail"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">部门：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="dept" value="<?php echo ($clientinfo["dept"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">职称：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="position" value="<?php echo ($clientinfo["position"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">邮政编码：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="postcode" value="<?php echo ($clientinfo["postcode"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">公司传真：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="fax" value="<?php echo ($clientinfo["fax"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label">公司网址：</span>
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="www" value="<?php echo ($clientinfo["www"]); ?>">
                    </div>
                </div>
                <div class="form-line w50 fl">
                    <span class="form-label"><span class="need" style="color: red;">*</span> 销售人员：</span>
                    <div class="form-content" style="width: 250px;">
                        <select class="form-control" name="salesman">
                            <option value="">--请选择--</option>
                            <?php if(is_array($sales)): $i = 0; $__LIST__ = $sales;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($clientinfo["salesman"] == $vo['realname']): ?>selected<?php endif; ?>><?php echo ($vo["realname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-line fl">
                    <span class="form-label">身份证复印件：</span>
                    <div class="form-content" style="width:618px;">
                        <input type="text" name="idcopy" class="form-control" readonly value="<?php echo ($clientinfo["idcopy"]); ?>">
                    </div>
                    <a class="btn btn-primary upload" style="position: relative;bottom: 1px;">上传</a>
                </div>
                <img class="idimg" style="margin-left:150px;width: 250px;" src="<?php echo ($clientinfo["idcopy"]); ?>">
            </form>
            <form class="fileform" id="fileform">
                <input type="file" name="file" class="file" id="fileField" size="28" style="display: none;">
            </form>
        </div>
        <!-- 需求信息 -->
        <div class="layui-tab-item">
            <form class="mform2">
            <div class="form-line w50 fl">
                <span class="form-label">先用IP：</span>
                <div class="form-content" style="width: 250px;">
                    <input class="form-control" type="text" name="currip" value="<?php echo ($clientinfo["currip"]); ?>">
                </div>
            </div>
            <div class="form-line w50 fl">
                <span class="form-label">服务器用途：</span>
                <div class="form-content" style="width: 250px;">
                    <input class="form-control" type="text" name="usage" value="<?php echo ($clientinfo["usage"]); ?>">
                </div>
            </div>
            <div class="form-line w50 fl">
                <span class="form-label">客户来源：</span>
                <div class="form-content" style="width: 250px;">
                    <select class="form-control" name="source">
                        <option <?php if($clientinfo["source"] == '客户来电'): ?>selected<?php endif; ?>>客户来电</option>
                        <option <?php if($clientinfo["source"] == '网上咨询'): ?>selected<?php endif; ?>>网上咨询</option>
                        <option <?php if($clientinfo["source"] == '客户介绍'): ?>selected<?php endif; ?>>客户介绍</option>
                        <option <?php if($clientinfo["source"] == '主动联系'): ?>selected<?php endif; ?>>主动联系</option>
                    </select>
                </div>
            </div>
            <div class="form-line w50 fl">
                <span class="form-label"><span class="need" style="color: red;">*</span> 客户等级：</span>
                <div class="form-content" style="width: 250px;">
                    <select class="form-control" name="class">
                        <option>--请选择--</option>
                        <option <?php if(($clientinfo["class"] == '个人用户') OR ($clientinfo["class"] == '普通用户') OR ($clientinfo["class"] == '')): ?>selected<?php endif; ?>>个人用户</option>
                        <option <?php if(($clientinfo["class"] == '企业用户') OR ($clientinfo["class"] == '合作伙伴') OR ($clientinfo["class"] == '运营商')): ?>selected<?php endif; ?>>企业用户</option>
                        <option <?php if($clientinfo["class"] == '公司自用'): ?>selected<?php endif; ?>>公司自用</option>
                    </select>
                </div>
            </div>
            <div class="form-line w50 fl">
                <span class="form-label">客户状态：</span>
                <div class="form-content" style="width: 250px;">
                    <select class="form-control" name="state">
                        <option <?php if($clientinfo["state"] == '初次接触'): ?>selected<?php endif; ?>>初次接触</option>
                        <option <?php if($clientinfo["state"] == '无意向'): ?>selected<?php endif; ?>>无意向</option>
                        <option <?php if($clientinfo["state"] == '近期有意向'): ?>selected<?php endif; ?>>近期有意向</option>
                        <option <?php if($clientinfo["state"] == '远期有意向'): ?>selected<?php endif; ?>>远期有意向</option>
                        <option <?php if($clientinfo["state"] == '准客户'): ?>selected<?php endif; ?>>准客户</option>
                        <option <?php if($clientinfo["state"] == '用户'): ?>selected<?php endif; ?>>用户</option>
                        <option <?php if($clientinfo["state"] == '流失客户'): ?>selected<?php endif; ?>>流失客户</option>
                    </select>
                </div>
            </div>
            <div class="form-line w50 fl">
                <span class="form-label">提醒时间：</span>
                <div class="form-content" style="width: 250px;">
                    <div class="form-content" style="width: 250px;">
                        <input class="form-control" type="text" name="remind_at" value="<?php echo ($clientinfo["name"]); ?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
                    </div>
                </div>
            </div>
            <div class="form-line fl" style="height: 174px;">
                <span class="form-label" style="position: relative;bottom: 80px;">客户备注：</span>
                <div class="form-content">
                    <textarea class="form-control" rows="8" name="remark"><?php echo ($clientinfo["name"]); ?></textarea>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>