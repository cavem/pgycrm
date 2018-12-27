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
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
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
        $('.sform').submit();
    })
    $('#searchbox').bind('keyup', function(event) {
        if (event.keyCode == "13") {
            $('.sform').submit();
        }
    })
    $('.empty').click(function(){
        $("#searchbox").val('');
        $('.sform').submit();
    })
    $("#pagebox" ).bind('keyup', function(event) {
        if (event.keyCode == "13") {
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
/*bootstrap*/
.btn{padding: 7px 20px;}
.btn-sm{padding: 5px 10px !important;}
.form-control{border-radius:initial;}
.table th{text-align: left;font-size: 14px;}
.table-hover>tbody>tr:hover {background-color: #e6e6e6;}
.table>tbody>tr>td{vertical-align: middle;}
tr:hover {background: transparent;}
.label{padding: .3em .6em;}
.alert {padding: 5px 35px 5px 5px;border: 1px solid transparent;border-radius: 4px;margin-bottom: 0;}
.pagination{margin: 0;}
/* content-header */
#content-header{padding: 5px 0 10px 0;margin:0 20px;margin-top:0px !important;overflow: hidden;border-bottom: 2px solid #ddd;width: initial !important;}
.header-title{font-size: 16px;display: block;float: left;position: relative;top: 5px;}
.mysearchbox{position: relative;background: #ddd;width: 250px;height: 34px;line-height: 34px;padding: 0 24px;}
.mysearchbox input{border: none;background: #ddd;}
.mysearchbox input:focus{border-color: initial;box-shadow: initial;}
.empty{position: absolute;top: 11px;right: 11px;cursor: pointer;display: none;}
.empty:hover{color: red;}
.condition-panel{display: none;width: 100%;overflow: hidden;padding: 10px;}
.condition-panel-item{width: 16.6%;padding: 0 10px;float:left;}
.condition-panel-item .lb{margin-bottom: 10px;font-weight: bold;display: block;}
@media (max-width: 1366px) and (min-width: 481px){
#content {margin-left: 0 !important;}
.panel-group{width: 60% !important;}
}
</style>
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<style>
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.fold-drop{position: absolute;min-width: 100px;background: #fff;border: 1px solid #e7e7e7;display: none;z-index: 99;}
.fold-drop li a {display: block;padding: 0 5px;line-height: 30px;text-align: left;color: #404241;text-decoration-line: none;}
.fold-drop li a:hover{color: #fff;background: #60aff6;}
</style>
<script>
$(function(){
    $('.userid').click(function(){
        alert('111');
    })
    $('.username').click(function(){
        $('.text-username').text($(this).text());
        $('.alert').show();
    })
    $('.close').click(function(){
        $('.alert').hide();
    })
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
        }
        $('.condition-panel').slideToggle();
    })
    $('.moreoption').hover(
        function(){
            $(this).find('.fold-drop').show();
        },
        function(){
            $(this).find('.fold-drop').hide();
        }
    )
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-list-ul"></i> 客户列表</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input type="search" class="form-control" placeholder="请输入查询内容">
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item">
                <span class="lb">相关销售</span>
                <select class="form-control">
                    <option>--请选择--</option>
                    <option>杨龙</option>
                    <option>王酥</option>
                    <option>杨宁</option>
                    <option>张续祥</option>
                    <option>孙一</option>
                    <option>蔡涛</option>
                    <option>何硕</option>
                    <option>汤瑞东</option>
                    <option>慧慧</option>
                    <option>杨总安排</option>
                    <option>公司自用</option>
                    <option>客户授权</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <button class="btn btn-primary fl"><i class="fa fa-pencil-square-o"></i> 客户立案</button>
            <div class="page fr"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID</th><th>客户名称</th><th>QQ号码</th><th>手机号码</th><th>电话号码</th><th>身份证号码</th><th>邮箱</th><th>客户等级</th>
                    <th>销售代表</th><th>客户状态</th><th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>9527</td>
                    <td><a href="javascript:;" class="username">山顶洞人</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <a href="javascript:;" class="lookinfo">查看</a> 
                        <span class="moreoption" style="display: inline-block;">更多 <i class="fa fa-sort-desc" style="position: relative;top: -1px;"></i>
                            <ul class="fold-drop">
                                <li class="">
                                    <a href="javascript:;" class="resetos">重置系统</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="resetpsw">重置密码</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="restandard">调整配置</a>
                                </li> 
                                <li class="">
                                    <a href="javascript:;" class="renew">续费</a>
                                </li> 
                            </ul>
                        </span>
                    </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>