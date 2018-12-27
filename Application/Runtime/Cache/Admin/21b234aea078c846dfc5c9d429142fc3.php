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
<div class="layui-form-item layui-form-text" style="padding:20px;">
    <div class="chang js-short">
        <a onclick="selip(0)" class="btn btn-sm btn-warning">普通电信IP</a>
        <a onclick="selip(1)" class="btn btn-sm btn-warning">普通电信阻断国外IP</a>
        <a onclick="selip(2)" class="btn btn-sm btn-warning">普通移动IP</a>
        <a onclick="selip(3)" class="btn btn-sm btn-warning">普通联通IP</a>
        <a onclick="selip(4)" class="btn btn-sm btn-success">高防电信(阻断国外)IP</a>
        <a onclick="selip(5)" class="btn btn-sm btn-success">高防联通(阻断国外)IP</a>
        <a onclick="selip(6)" class="btn btn-sm btn-info">普通BGP(无防御)IP</a>
        <a onclick="selip(7)" class="btn btn-sm btn-info">100G BGP空闲(不封国外，京东专用)IP</a>
        <a onclick="selip(8)" class="btn btn-sm btn-info">高防BGP(阻断国外)IP</a>
    </div>
    <div class="layui-input-block" style="margin: 0;">
        <textarea name="ips" placeholder="请点击上方按钮选择IP" class="layui-textarea"></textarea>
    </div>
    <div>
        <a class="btn btn-danger emptytext">清空</a> <a class="btn btn-primary user">使用</a>
    </div>
</div>
<script src="/Public/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
    });
    //重新渲染表单
    function renderForm(){
      layui.use('form', function(){
       var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
       form.render();
      });
    }

    function selip(dt)
    {
        $.ajax({
            type: "POST",
              url: "/Workorder/selip",
              data:"datatype="+dt,
              success: function(msg){
                var a=eval('('+msg+')');
                var ips=$("[name='ips']").text();
                $("[name='ips']").text(ips+a+"/");
            }
        });
    }
    $(function(){
        //清空
        $('.emptytext').click(function(){
            $('textarea').val('');
        })
        //使用
        $('.user').click(function(){
            if($('textarea').html()==''){
                layer.msg("ip不能为空！",{icon:0});
                return;
            }
            layer.load();
            $.post('/Workorder/getfreeip',{"ip":$('textarea').html()},function(data,status){
                if(data==0){
                    layer.msg("已使用！",{icon:1});
                    window.location.reload();
                }else{
                    layer.msg("操作失败！",{icon:0});
                    window.location.reload();
                }
            })
        })
    }) 
</script>
</body>
</html>