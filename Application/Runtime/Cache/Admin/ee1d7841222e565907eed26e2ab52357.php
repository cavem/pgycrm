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
a{color: #337ab7;}
a:hover{color: #23527c;}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;overflow: hidden;}
/*基本信息*/
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
.checkbox-wrap li:hover{border:1px solid #60aff6;z-index: 4;}
.checkbox-wrap li input{position: absolute;width:0;height: 0;left: 0;opacity: 0;cursor: pointer;}
.mychecked{border: 1px solid #60aff6 !important;background: url(/Public/assets/images/icon-selected.png) #fff no-repeat !important;background-position:bottom right !important;z-index: 5 !important;}
.sm-checkbox-wrap{background: #ddd;clear: both;overflow: hidden;padding: 5px 10px;}
.sm-checkbox-wrap .checkbox-wrap li{height: 30px !important;line-height: 30px !important;padding: 0 10px;}
.haschild{padding-right: 10px !important;}
.haschild i{position: relative;top: 16px;right: 25px;color: #ddd;font-size: 18px;}
.panel-item{margin-top: 15px;}
.layui-tab-content p{width: 100%;background-color: #D5D5D5;height: 30px;padding: 5px 0 0 5px;color:#000;}
.layui-tab-content table td{border:1px solid #D5D5D5;padding-left: 5px}
</style>
<script>
$(function(){
    $('.viewpic').click(function(){
        layer.alert('<img src="'+$(this).data("val")+'" width="100%;">');
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
    <div class="myalert-main">
        <div class="layui-tab">
            <!-- <ul class="layui-tab-title">
                <li class="layui-this">基本信息</li>
                <li>权限设置</li>
            </ul> -->
            <div class="layui-tab-content" style="min-height: 580px;">
                <p>工单信息</p>
                <table style="width: 100%;line-height: 30px;">
                    <tr>
                        <td style="width:15%">标题</td>
                        <td style="width:85%" colspan="3"><?php echo ($tasks["title"]); ?></td>
                    </tr>
                    <tr>
                        <td>问题描述</td>
                        <td colspan="3"><?php echo ($tasks["problemdesc"]); ?></td>
                    </tr>
                    <tr>
                        <td style="width:15%">工单状态</td>
                        <td style="width:35%"><?php echo ($tasks["state"]); ?></td>
                        <td style="width:15%">工单编号</td>
                        <td style="width:35%"><?php echo ($tasks["id"]); ?></td>
                    </tr>
                    <tr>
                        <td style="width:15%">提交人</td>
                        <td style="width:35%"><?php echo ($tasks["committer"]); ?></td>
                        <td style="width:15%">工单类型</td>
                        <td style="width:35%"><?php echo ($tasks["type2"]); ?></td>
                    </tr>
                    <tr>
                        <td style="width:15%">受理部门</td>
                        <td style="width:35%"><?php echo ($tasks["recvdept"]); ?></td>
                        <td style="width:15%">所在机房</td>
                        <td style="width:35%"><?php echo ($tasks["room"]); ?></td>
                    </tr>
                    <tr>
                        <td style="width:15%">处理方法</td>
                        <td style="width:35%"><?php echo ($tasks["action"]); ?></td>
                        <td style="width:15%">处理时限</td>
                        <td style="width:35%"><?php echo ($tasks["timelimit"]); ?></td>
                    </tr>
                    <tr>
                        <td style="width:15%">提交时间</td>
                        <td style="width:35%"><?php echo ($tasks["commit_at"]); ?></td>
                        <td style="width:15%">截止时间</td>
                        <td style="width:35%"><?php echo ($tasks["expire_at"]); ?></td>
                    </tr>
                    <?php if(($tasks["action"] == '上架') OR ($tasks["action"] == '添加IP') OR ($tasks["action"] == '更换IP') OR ($tasks["action"] == '重装win系统') OR ($tasks["action"] == '重装linux系统') OR ($tasks["action"] == '更换IP重装win系统') OR ($tasks["action"] == '更换IP重装linux系统') OR ($tasks["action"] == '新上架')): ?><tr>
                        <td style="width:15%">新增IP地址</td>
                        <td style="width:85%" colspan="3"><?php echo ($tasks["addip"]); ?></td>
                    </tr><?php endif; ?>
                    <?php if(($tasks["action"] == '上架') OR ($tasks["action"] == '上架转让')): ?><tr>
                        <td style="width:15%">截图</td>
                        <td style="width:85%" colspan="3"><a href="javascript:;" class="viewpic" data-val="<?php echo ($tasks["pic"]); ?>">查看截图</a></td>
                    </tr><?php endif; ?>
                </table>
                <p style="margin-top: 10px;">操作记录</p>
                <table border="0" style="width: 100%;line-height: 30px">
                    <tr style="border-bottom: 1px solid #D5D5D5">
                        <td>备注</td><td>操作</td><td>时间</td>
                    </tr>
                    <?php if(is_array($talog)): foreach($talog as $key=>$info): ?><tr style="border-bottom: 1px solid #D5D5D5">
                            <td style="width:50%;padding-right: 2em"><?php echo ($info["msg"]); ?></td>
                            <td style="width:20%"><?php echo ($info["act"]); ?></td>
                            <td style="width:30%">【<?php echo ($info["name"]); ?>】<?php echo (date("Y-m-d H:i:s",$info["tm"])); ?></td>
                        </tr><?php endforeach; endif; ?>
                </table>
                <?php if(!empty($tasks["svid"])): ?><p style="margin-top: 10px;">服务器信息</p>
                  <table border="0" style="width: 100%;line-height: 30px">
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width: 100px">编号</td>
                          <td style="font: 16px solid #FF0000"><?php echo ($serverinfo["servnum"]); ?></td>
                      </tr>
                      <tr>
                          <td style="width:15%">客户名称</td>
                          <td style="width:35%"><?php echo ($serverinfo["custname"]); ?></td>
                          <td style="width:15%">服务器类型</td>
                          <td style="width:35%"><?php echo ($serverinfo["productkind"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width:15%">设备名称</td>
                          <td style="width:35%"><?php echo ($serverinfo["servname"]); ?></td>
                          <td style="width:15%">设备类型</td>
                          <td style="width:35%"><?php echo ($serverinfo["devicetype"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width:15%">状态</td>
                          <td style="width:35%"><?php echo ($serverinfo["servstate"]); ?></td>
                          <td style="width:15%">设备外形</td>
                          <td style="width:35%"><?php echo ($serverinfo["deviceshape"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width:15%">操作系统</td>
                          <td style="width:35%"><?php echo ($serverinfo["os"]); ?></td>
                          <td style="width:15%">MAC地址</td>
                          <td style="width:35%"><?php echo ($serverinfo["macaddress"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width:15%">所在机房</td>
                          <td style="width:35%"><?php echo ($serverinfo["idcname"]); ?></td>
                          <td style="width:15%">所在机柜</td>
                          <td style="width:35%"><?php echo ($serverinfo["shelfcode"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>IP地址</td>
                          <td><?php echo ($serverinfo["serv_ip"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>带宽限制</td>
                          <td><?php echo ($serverinfo["bandwidth"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>配置</td>
                          <td style="font-weight: bold;"><?php echo ($serverinfo["hwconfig"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>备注</td>
                          <td><?php echo ($serverinfo["remarks"]); ?></td>
                      </tr>
                  </table><?php endif; ?>
                <?php if(!empty($servtflist["0"])): ?><p style="margin-top: 10px;">服务器转让信息</p>
                <table class="table table-bordered">
                    <thead>
                        <th></th>
                        <th>旧订单ID</th>
                        <th>旧客户名称</th>
                        <th>新订单ID</th>
                        <th>新客户名称</th>
                        <th>提交人</th>
                        <th>提交时间</th>
                    </thead>
                    <tbody>
                        <?php if(is_array($servtflist)): $k = 0; $__LIST__ = $servtflist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                            <td><?php echo ($k); ?></td>
                            <td><?php echo ($vo["pre_o_nid"]); ?></td>
                            <td><?php echo ($vo["pre_cname"]); ?></td>
                            <td><?php echo ($vo["new_o_nid"]); ?></td>
                            <td><?php echo ($vo["new_cname"]); ?></td>
                            <td><?php echo ($vo["committer"]); ?></td>
                            <td><?php echo ($vo["commit_at"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table><?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 弹窗 end-->
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
</script>
</body>
</html>