<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <title>蒲公英网络CRM</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/pgycrm/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/pgycrm/Public/layui/css/layui.css" />
    <link rel="stylesheet" href="/pgycrm/Public/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/pgycrm/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/pgycrm/Public/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="/pgycrm/Public/assets/css/matrix-style2.css" />
    <script src="/pgycrm/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/pgycrm/Public/layui/layui.all.js"></script>
    <script src="/pgycrm/Public/assets/js/wow.min.js"></script>
    <script src="/pgycrm/Public/bootstrap/js/bootstrap.min.js"></script>
</head>
<script>
if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
    new WOW().init();
};
var myalert=function(title,width,height,content,yfunc){
    layer.open({
        type: 0
        ,title:title
        ,area: [width, height]
        ,offset: 'auto'
        ,id: 'layerDemoauto'
        ,content: content
        ,btn: '确定'
        ,btnAlign: 'c' //按钮居中
        ,shade: .3 //不显示遮罩
        ,yes: yfunc
    });
}
var myalert=function(title,width,height,url){
    layer.open({
        type: 2 
        ,title: title
        ,area: [width, height]
        ,shade: 0.8
        ,maxmin: true
        ,content: url
    });
}

$(function(){
    
})
</script>
<body>
<style>
body{background: transparent!important;margin-top: 0 !important;font-size:14px;}
.ml15{margin-left: 15px;}
.ml10{margin-left:10px;}
.mt15{margin-top:15px;}
.fl{float: left;}
.fr{float: right;}
.dib{display: inline-block;}
.db{display:block;}
.dn{display: none;}
/*bootstrap*/
.btn{padding: 7px 20px;}
.btn-sm{padding: 5px 10px !important;}
.form-control{border-radius:initial;}
.table th{text-align: left;font-size: 14px;}
.table-hover>tbody>tr:hover {background-color: #e6e6e6;}
tr:hover {background: transparent;}
.label{padding: .3em .6em;}
.alert {padding: 5px 35px 5px 5px;border: 1px solid transparent;border-radius: 4px;margin-bottom: 0;}
/* content-header */
#content-header{padding: 5px 0 10px 0;margin:0 20px;margin-top:0px !important;overflow: hidden;border-bottom: 2px solid #ddd;width: initial !important;}
.header-title{font-size: 16px;display: block;float: left;position: relative;top: 5px;}
.mysearchbox{position: relative;background: #ddd;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
.mysearchbox input{border: none;background: #ddd;}
.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
.condition-panel{display: none;width: 100%;overflow: hidden;padding: 10px;}
.condition-panel-item{width: 16.6%;padding: 0 10px;float:left;}
.condition-panel-item .lb{margin-bottom: 10px;font-weight: bold;display: block;}
@media (max-width: 1366px) and (min-width: 481px){
#content {margin-left: 0 !important;}
.panel-group{width: 60% !important;}
}
</style>

<style>
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;background: #eee;}
.myalert-main{width: 100%;overflow: hidden;}

.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display: block;width: 150px;text-align: right;font-weight: bold;}
.form-content{width: 700px;text-align: left;}
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
/*多选框*/
.checkbox-wrap li{float: left;position: relative;margin-left:-1px;z-index: 1;min-width: 46px;height: 40px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 40px;font-size: 13px;padding: 0 20px;}
.checkbox-wrap li:first-child{border-radius: 5px 0 0 5px;}
.bdr5{border-radius: 5px !important;}
.checkbox-wrap li:last-child{border-radius: 0 5px 5px 0;}
.checkbox-wrap li:hover{border:1px solid #60aff6;z-index: 4;}
.checkbox-wrap li input{position: absolute;width:0;height: 0;left: 0;opacity: 0;cursor: pointer;}
.mychecked{border: 1px solid #60aff6 !important;background: url(/pgycrm/Public/assets/images/icon-selected.png) #fff no-repeat !important;background-position:bottom right !important;z-index: 5 !important;}
.sm-checkbox-wrap{background: #ddd;clear: both;overflow: hidden;padding: 5px 10px;}
.sm-checkbox-wrap .checkbox-wrap li{height: 30px !important;line-height: 30px !important;padding: 0 10px;}
.haschild{padding-right: 10px !important;}
.haschild i{position: relative;top: 16px;right: 25px;color: #ddd;font-size: 18px;}
.panel-item{margin-top: 15px;}
</style>
<script>
$(function(){
    $('.add-power').click(function(){
        var content=$('.myalert-content').html();
        var confirm=function(){
            alert($('.mform').serialize())
        }
        myalert('新增权限','900px','660px',content,confirm);
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content" style="display: none;">
<div class="myalert-wrap">
    <div class="myalert-main">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">基本信息</li>
                <li>权限设置</li>
            </ul>
            <div class="layui-tab-content">
                <!-- 基本信息 -->
                <div class="layui-tab-item layui-show">
                    <form class="mform">
                        <div class="form-line">
                            <span class="form-label fl">名称：</span>
                            <div class="form-content fr">
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="form-line">
                            <span class="form-label fl">超级管理员：</span>
                            <div class="form-content fr">
                                是 <input type="radio" name="isspadmin"> 
                                否 <input type="radio" name="isspadmin" checked>
                            </div>
                        </div>
                        <div class="form-line">
                            <span class="form-label fl">描述：</span>
                            <div class="form-content fr">
                                <textarea class="form-control" rows="5" name="description"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- 权限设置 -->
                <div class="layui-tab-item">
                    <form class="mform">
                    <div class="layui-tab layui-tab-card" style="width: 100%;">
                        <ul class="layui-tab-title" style="overflow: hidden;">
                            <li class="layui-this">我的工作区</li>
                            <li>工单系统</li>
                            <li>业务管理</li>
                            <li>客户管理</li>
                            <li>订单管理</li>
                            <li>财务管理</li>
                            <li>人事管理</li>
                            <li>资源管理</li>
                            <li>系统管理</li>
                            <li>域名相关</li>
                            <li>防火墙相关</li>
                            <li>防御相关</li>
                            <li>牵引相关</li>
                            <li>自动化</li>
                            <span class="tabtoggle layui-unselect layui-tab-bar" lay-stope="tabmore" title=""><i lay-stope="tabmore" class="layui-icon"></i></span>
                        </ul>
                        <div class="layui-tab-content">
                            <!-- 我的工作区 -->
                            <div class="layui-tab-item layui-show">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            公司公告
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="gg" value="0">新增</li>
                                            <li><input type="checkbox" name="gg" value="1">修改</li>
                                            <li><input type="checkbox" name="gg" value="2">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            技术公告
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jg" value="0">新增</li>
                                            <li><input type="checkbox" name="jg" value="1">修改</li>
                                            <li><input type="checkbox" name="jg" value="2">删除</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 工单系统 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            我的工单
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li><input type="checkbox" name="gd" value="0">新工单</li>
                                                <li><input type="checkbox" name="gd" value="1">领工单</li>
                                            </ul>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild"><input type="checkbox" name="gd" value="2">工单池<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-2" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-2" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-2" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="3">待确认<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-3" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-3" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-3" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-3" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="4">待验证<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-4" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-4" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-4" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-4" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="5">带宽确认<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-5" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-5" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-5" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-5" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="6">财务确认<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-6" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-6" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-6" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-6" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="7">待审核<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-7" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-7" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-7" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-7" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="8">上架位置确认<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-8" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-8" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-8" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-8" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="9">库管确认<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-9" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-9" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-9" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-9" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-item">
                                            <ul class="checkbox-wrap">
                                                <li class="haschild bdr5"><input type="checkbox" name="gd" value="10">未解决<i class="fa fa-caret-up"></i></li>
                                            </ul>
                                            <div class="sm-checkbox-wrap">
                                                <ul class="checkbox-wrap smcheck-wrap">
                                                    <li><input type="checkbox" name="gd-10" value="0">确认</li>
                                                    <li><input type="checkbox" name="gd-10" value="1">指派</li>
                                                    <li><input type="checkbox" name="gd-10" value="2">修改</li>
                                                    <li><input type="checkbox" name="gd-10" value="3">删除</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            我的记录
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="jl" value="0">查看</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            工单报表
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="bb" value="0">查看</li>
                                            <li><input type="checkbox" name="bb" value="1">删除</li>
                                            <li><input type="checkbox" name="bb" value="0">导出</li>
                                            <li><input type="checkbox" name="bb" value="0">工单重置</li>
                                            <li><input type="checkbox" name="bb" value="0">奖金清零</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            回收站
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="hsz" value="0">查看</li>
                                            <li><input type="checkbox" name="hsz" value="1">恢复</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 业务管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            服务器管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="fwq" value="0">导出</li>
                                            <li><input type="checkbox" name="fwq" value="1">查看</li>
                                            <li><input type="checkbox" name="fwq" value="2">客户信息</li>
                                            <li><input type="checkbox" name="fwq" value="3">修改</li>
                                            <li><input type="checkbox" name="fwq" value="4">删除</li>
                                            <li><input type="checkbox" name="fwq" value="5">下架</li>
                                            <li><input type="checkbox" name="fwq" value="6">问题处理</li>
                                            <li><input type="checkbox" name="fwq" value="7">服务器转让</li>
                                            <li><input type="checkbox" name="fwq" value="8">系统安装</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 客户管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            客户列表
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="fwq" value="0">客户立案</li>
                                            <li><input type="checkbox" name="fwq" value="1">查看</li>
                                            <li><input type="checkbox" name="fwq" value="2">修改</li>
                                            <li><input type="checkbox" name="fwq" value="3">删除</li>
                                            <li><input type="checkbox" name="fwq" value="4">订单</li>
                                            <li><input type="checkbox" name="fwq" value="5">预付款</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 订单管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            订单管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="ddgl" value="0">新增财务收入</li>
                                            <li><input type="checkbox" name="ddgl" value="1">新上架</li>
                                            <li><input type="checkbox" name="ddgl" value="2">查看</li>
                                            <li><input type="checkbox" name="ddgl" value="3">修改</li>
                                            <li><input type="checkbox" name="ddgl" value="4">删除</li>
                                            <li><input type="checkbox" name="ddgl" value="5">恢复生效</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            订单统计
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ddtj" value="0">导出</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 财务管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            财务收入
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="cwsr" value="0">新增</li>
                                            <li><input type="checkbox" name="cwsr" value="1">查看</li>
                                            <li><input type="checkbox" name="cwsr" value="2">修改</li>
                                            <li><input type="checkbox" name="cwsr" value="3">删除</li>
                                            <li><input type="checkbox" name="cwsr" value="4">款到确认</li>
                                            <li><input type="checkbox" name="cwsr" value="5">主管确认</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            收款统计
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="sktj" value="0">导出</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 人事管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            工作池管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="gzc" value="0">新增</li>
                                            <li><input type="checkbox" name="gzc" value="1">查看</li>
                                            <li><input type="checkbox" name="gzc" value="2">修改</li>
                                            <li><input type="checkbox" name="gzc" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            员工考核
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="ygkh" value="0">查看</li>
                                            <li><input type="checkbox" name="ygkh" value="1">考核</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            主管考核
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="zgkh" value="0">查看</li>
                                            <li><input type="checkbox" name="zgkh" value="1">考核</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 资源管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            产品分类
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="cpfl" value="0">新增</li>
                                            <li><input type="checkbox" name="cpfl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            产品管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="cpgl" value="0">新增</li>
                                            <li><input type="checkbox" name="cpgl" value="1">查看</li>
                                            <li><input type="checkbox" name="cpgl" value="2">修改</li>
                                            <li><input type="checkbox" name="cpgl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            IP段管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="ipgl" value="0">新增</li>
                                            <li><input type="checkbox" name="ipgl" value="1">查看</li>
                                            <li><input type="checkbox" name="ipgl" value="2">修改</li>
                                            <li><input type="checkbox" name="ipgl" value="3">删除</li>
                                            <li><input type="checkbox" name="ipgl" value="3">IP管理</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            机房管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jfgl" value="0">新增</li>
                                            <li><input type="checkbox" name="jfgl" value="1">查看</li>
                                            <li><input type="checkbox" name="jfgl" value="2">修改</li>
                                            <li><input type="checkbox" name="jfgl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            机柜管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jggl" value="0">新增</li>
                                            <li><input type="checkbox" name="jggl" value="1">查看</li>
                                            <li><input type="checkbox" name="jggl" value="2">修改</li>
                                            <li><input type="checkbox" name="jggl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            交换机管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jhjgl" value="0">新增</li>
                                            <li><input type="checkbox" name="jhjgl" value="1">查看</li>
                                            <li><input type="checkbox" name="jhjgl" value="2">修改</li>
                                            <li><input type="checkbox" name="jhjgl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            机器型号
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jqxh" value="0">新增</li>
                                            <li><input type="checkbox" name="jqxh" value="1">查看</li>
                                            <li><input type="checkbox" name="jqxh" value="2">修改</li>
                                            <li><input type="checkbox" name="jqxh" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            操作系统
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="czxt" value="0">新增</li>
                                            <li><input type="checkbox" name="czxt" value="1">查看</li>
                                            <li><input type="checkbox" name="czxt" value="2">修改</li>
                                            <li><input type="checkbox" name="czxt" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 系统管理 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            部门管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="bmgl" value="0">新增</li>
                                            <li><input type="checkbox" name="bmgl" value="1">查看</li>
                                            <li><input type="checkbox" name="bmgl" value="2">修改</li>
                                            <li><input type="checkbox" name="bmgl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            角色权限
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="jsqx" value="0">新增</li>
                                            <li><input type="checkbox" name="jsqx" value="1">查看</li>
                                            <li><input type="checkbox" name="jsqx" value="2">修改</li>
                                            <li><input type="checkbox" name="jsqx" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            账户管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="zhgl" value="0">新增</li>
                                            <li><input type="checkbox" name="zhgl" value="1">查看</li>
                                            <li><input type="checkbox" name="zhgl" value="2">修改</li>
                                            <li><input type="checkbox" name="zhgl" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            账户等级
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="zhdj" value="0">新增</li>
                                            <li><input type="checkbox" name="zhdj" value="2">修改</li>
                                            <li><input type="checkbox" name="zhdj" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            处理方式
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="clfs" value="0">新增</li>
                                            <li><input type="checkbox" name="clfs" value="1">查看</li>
                                            <li><input type="checkbox" name="clfs" value="2">修改</li>
                                            <li><input type="checkbox" name="clfs" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            日志查询
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li><input type="checkbox" name="rzch" value="1">查看</li>
                                            <li><input type="checkbox" name="rzch" value="3">删除</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 域名相关 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            宿迁域名过白
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="sqymgb" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            扬州域名过白
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="yzymgb" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            域名黑名单
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ymhmd" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            非法域名
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ffym" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 防火墙相关 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            金盾防护CC
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="jdfhcc" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            金盾CC参数
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="jdcccs" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            金盾IP释放
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="jdipsf" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            金盾黑名单
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="jdhmd" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            IP直通设置
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ipztsz" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            IP直通记录
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ipztjl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            安全盾防护CC
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="aqdfhcc" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            IP白名单
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ipbmd" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            连接数查看
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ljsck" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 防御相关 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            防御设置
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="fysz" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            防御区记录
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="fyqjl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            防护查看
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="fhck" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 牵引相关 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            牵引状态
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="qyzt" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            攻击记录
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="gjjl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            牵引策略
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="qycl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            牵引策略（电信）
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="qycldx" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            单IP牵引策略设置
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="dipqy" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            十分钟内攻击记录
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="sfzjl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- 自动化 -->
                            <div class="layui-tab-item">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            IPMI管理
                                        </h3>
                                        <div class="opt-wrap fr">
                                            <a class="btn btn-success btn-sm openall">全开</a>
                                            <a class="btn btn-danger btn-sm closeall">全关</a>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="checkbox-wrap">
                                            <li class="bdr5"><input type="checkbox" name="ipmigl" value="1">使用</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $("input[type='checkbox']").click(function(){
                                return false;
                            })
                            $('.tabtoggle').click(function(){
                                $('.layui-tab-title').toggleClass('layui-tab-more');
                            })
                            $('.checkbox-wrap li').click(function(){
                                $(this).toggleClass('mychecked');
                                //console.log($(this).find('input').css('z-index'));
                                if($(this).find('input').attr('checked')==undefined){
                                    $(this).find('input').attr('checked','true');
                                }else{
                                    $(this).find('input').removeAttr('checked');
                                }
                            })
                            $('.openall').click(function(){
                                $(this).closest('.panel').find('.checkbox-wrap').children('li').addClass('mychecked');
                                $(this).closest('.panel').find('.checkbox-wrap').children('li').find('input').attr('checked','true');
                            })
                            $('.closeall').click(function(){
                                $(this).closest('.panel').find('.checkbox-wrap').children('li').removeClass('mychecked');
                                $(this).closest('.panel').find('.checkbox-wrap').children('li').find('input').removeAttr('checked');
                            })
                            
                            $('.checkbox-wrap .haschild').click(function(){
                                if(!$(this).hasClass('mychecked')){
                                    $(this).closest('.panel-item').find('.smcheck-wrap').children('li').removeClass('mychecked');
                                    $(this).closest('.panel-item').find('.smcheck-wrap').children('li').find('input').removeAttr('checked');
                                    console.log($(this).closest('.panel-item').find('.smcheck-wrap').children('li').find('input').attr('checked'));
                                }
                            })
                            $('.smcheck-wrap li').click(function(){
                                var status=0;
                                $(this).parent().children('li').each(function(){
                                    if($(this).hasClass('mychecked')){
                                        status+=1;
                                    }else{
                                        status+=0;
                                    }
                                })
                                if(status>0){
                                    $(this).closest('.panel-item').find('.haschild').addClass('mychecked');
                                    $(this).closest('.panel-item').find('.haschild').find('input').attr('checked','true');
                                }else{
                                    $(this).closest('.panel-item').find('.haschild').removeClass('mychecked');
                                    $(this).closest('.panel-item').find('.haschild').find('input').removeAttr('checked');
                                }
                            })
                        </script>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 弹窗 end-->
<!-- 弹窗(查看角色) -->
<div class="myalert-content2" style="display: none;">
<div class="myalert-wrap">
    <div class="myalert-main">

    </div>
</div>
</div>
<!-- 弹窗 end-->

<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-exclamation-circle"></i> 角色权限</span>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input type="search" class="form-control" placeholder="请输入查询内容">
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <button class="btn btn-primary fl add-power"><i class="fa fa-plus"></i> 新增</button>
            <div class="page fr"><?php echo ($page); ?></div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                <th>编号</th><th>角色名称</th><th>权限数量</th><th>操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td><a href="javascript:;" class="">查看</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>