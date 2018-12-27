<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<!-- <link title="" href="/Application/Admin/View/Public/css/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet"> -->
<script src="/Application/Admin/View/Public/script/jquery.min.1.js" type="text/javascript"></script>
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<!-- <script src="/Application/Admin/View/Public/script/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- <script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="/Public/layer/layer.js" type="text/javascript"></script>
</head>
<style>
    .form-control{display: inline-block;height: 30px;}
    .btn{padding: 4px 8px;font-size: 14px;}
    .form-group{margin-bottom: 0;}
    .ml20{margin-left:20px;}
    .ml10{margin-left: 10px;}
    label{width: 100px;text-align: right;display: inline-block;}
    .edit-line{margin: 4px 0;}
</style>
<script>
$(function(){
    var url=window.location.href;
    var param=url.split("?")[1];
    var vid=param.split("=")[1];
    /**
	 * 修改密码
	 */
    //new-input光标离开事件
    $("#new-password").blur(function(){
        var newpwd=$(this).val();
        if(newpwd.length<6||newpwd.length>16){
            $(".newtip").text('请输入6至16位字符的密码');
        }else{
            $(".newtip").text('');
        }
    });
    //conf-input输入事件
    $("#conf-password").bind('input propertychange',function(){
        var confpwd=$(this).val();
        var newpwd=$("#new-password").val();
        if(confpwd!=newpwd){
            $(".conftip").text('两次输入的密码不一致');
        }else{
            $(".conftip").text('');
        }
    });
    //保存
    $(".save").click(function(){
		layer.msg('请稍等', {icon: 16,shade: 0.01});
        var newpwd=$("#new-password").val();
        var confpwd=$("#conf-password").val();
        if(newpwd==''||confpwd==''){
            layer.msg('填写有误，请按提示重新填写', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else if($(".newtip").text()!=''){
            layer.msg('密码格式不正确', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else if($(".conftip").text()!=''){
            layer.msg('两次输入的密码不一致', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else{
            $.post("pswreset",{'newpwd':newpwd,'vpsid':vid},function(data,status){
                if(data=="success"){
                    layer.closeAll(); 
                    layer.msg('修改成功', {icon: 1});
                    setTimeout(function(){
                        window.parent.location.reload();
                    },1000);
                }else{
                    layer.closeAll(); 
                    layer.msg('修改失败', {icon: 0});
                }
            });
        }
	});
    //close
    $('.upclose').click(function(){
        window.parent.layer.closeAll();
    })
})
</script>
<body>
    <div class="change">
        <div style="margin: 0 auto;padding: 20px 10px;">
            <!-- <p><label for="old-password">用户名：</label><em>Administrator</em></p> -->
            <p><label for="new-password">新密码：</label><input id="new-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请输入新密码"><span class="newtip" style="padding-left: 20px;color:red"></span></p>
            <p><label for="conf-password">确认密码：</label><input id="conf-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请再次输入新密码"><span class="conftip" style="padding-left: 20px;color:red"></span></p>
        </div>
    </div>
    <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0;">
        <button class="btn btn-primary save" style="background-color: #2f8ad8;">提交修改</button>
        <button class="btn btn-default upclose">关闭</button>&nbsp;
    </div>
</body>
</html>