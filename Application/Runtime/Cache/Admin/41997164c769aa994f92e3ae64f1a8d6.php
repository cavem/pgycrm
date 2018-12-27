<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
<script src="/Application/Admin/View/Public/script/jquery.min.1.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery-ui.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jqchart.js" type="text/javascript"></script>
</head>
<style>
    .btn{padding: 4px 8px;font-size: 12px;}
</style>
<script>
    $(function(){
        String.prototype.replaceAll = function (s1, s2) {
            return this.replace(new RegExp(s1, "gm"), s2);
        }
        //close
        $('.upclose').click(function(){
            window.parent.location.reload();
        })
        var localurl = window.location.href;
        var vpsid=localurl.split("?")[1]; //获取主机编号
        vpsid = vpsid.split("=")[1];
        var sentparam=function(interval){
            layer.msg("请稍等...", {
                time: 20000, //20s后自动关闭
            });
            $.post('chart',{"charttype":2,"chartinterval":interval,"vpsid":vpsid},function(data,status){
                if(status=="success"){
                    layer.closeAll();
                    var swin=$('.chartcontain');
                    var chartType='2';
                    var chartInterval=interval;
                    //console.log(data);
                    eval(data);
                }
            })
        }
        sentparam(5);
        //button
        $('.min10').click(function(){
            sentparam(5);
        })
        $('.min120').click(function(){
            sentparam(60);
        })
        $('.hour24').click(function(){
            sentparam(3600);
        })
        $('.month1').click(function(){
            sentparam(86400);
        })
        $('.month3').click(function(){
            sentparam(2592000);
        })
    })
</script>
<body>
    <div style="margin: 0 auto;">
        <div class="chartcontain">
            
        </div>
        <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary min10" style="background-color: #2f8ad8;">10分钟</button>
            <button class="btn btn-primary min120" style="background-color: #2f8ad8;">120分钟</button>
            <button class="btn btn-primary hour24" style="background-color: #2f8ad8;">24小时</button>
            <button class="btn btn-primary month1" style="background-color: #2f8ad8;">一个月</button>
            <button class="btn btn-primary month3" style="background-color: #2f8ad8;">三个月</button> 
            <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
    </div>
</body>
</html>