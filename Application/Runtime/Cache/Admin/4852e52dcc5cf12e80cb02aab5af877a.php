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
.myalert-main{width: 100%;overflow: hidden;}
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
.label{padding: .2em .6em;}
.claaa{color: #888;}
.table{background-color: transparent !important;}
</style>

<!-- 弹窗(编辑)-->
<div class="myalert-content">
<div class="myalert-wrap">
    <div class="myalert-main">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">服务器信息</li>
                <li>更新日志</li>
            </ul>
            <div class="layui-tab-content">
                <!-- 服务器信息-->
                <div class="layui-tab-item layui-show">
                    <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="claaa">编号</td>
                            <td><?php echo ($servinfo["servnum"]); ?></td>
                            <td class="claaa">产品类型</td>
                            <td><?php echo ($servinfo["productkind"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">产权所属</td>
                            <td><?php echo ($servinfo["custname"]); ?></td>
                            <td class="claaa">相关销售</td>
                            <td><?php echo ($servinfo["salers"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">联系人</td>
                            <td><?php echo ($servinfo["custtech"]); ?></td>
                            <td class="claaa">联系电话</td>
                            <td><?php echo ($servinfo["custtel"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">设备名称</td>
                            <td><?php echo ($servinfo["servname"]); ?></td>
                            <td class="claaa">设备类型</td>
                            <td><?php echo ($servinfo["devicetype"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">设备外形</td>
                            <td><?php echo ($servinfo["deviceshape"]); ?></td>
                            <td class="claaa">操作系统</td>
                            <td><?php echo ($servinfo["os"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">所在机房</td>
                            <td><?php echo ($servinfo["idcname"]); ?></td>
                            <td class="claaa">所在机柜</td>
                            <td><?php echo ($servinfo["shelfcode"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">机器型号</td>
                            <td><?php echo ($servinfo["servtype"]); ?></td>
                            <td class="claaa">MAC地址</td>
                            <td><?php echo ($servinfo["macaddress"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">自动化</td>
                            <td><?php echo ($servinfo["automation"]); ?></td>
                            <td class="claaa">状态</td>
                            <td><?php echo ($servinfo["servstate"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">带宽限制</td>
                            <td colspan="3"><?php echo ($servinfo["bandwidth"]); ?></td>
                          </tr>
                          <tr>
                            <td class="claaa">IP地址</td>
                            <td colspan="3">
                                <div style="min-width: 100%;width: 700px;overflow: auto;">
                                <?php $iparr=explode('/',$servinfo['serv_ip']); $ipstr=""; foreach($iparr as $val){ if(!empty($val)){ $ipstr.='<span class="label label-info">'.$val.'</span>&nbsp;'; } } echo $ipstr; ?>
                            </td>
                          </tr>
                          <tr>
                            <td class="claaa">备注</td>
                            <td colspan="3">
                                <div style="width: 700px;overflow: auto;">
                                <?php echo ($servinfo["remarks"]); ?>
                                </div>
                            </td>
                          </tr>
                          <tr>
                            <td class="claaa">代理商备注</td>
                            <td colspan="3"><?php echo ($servinfo["custremarks"]); ?></td>
                          </tr>
                        </tbody>
                      </table>
                </div>
                <!-- 更新日志 -->
                <div class="layui-tab-item" style="overflow: auto;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="claaa" style="width: 120px;">服务器更新</td>
                                <td>
                                    <?php if($servudlist[0] != ''): ?><div style="min-width: 100%;width:650px;overflow: auto;">
                                    <table class="table table-bordered" style="min-width: 1233px;">
                                        <thead>
                                            <th></th>
                                            <th>变更类型</th>
                                            <th>IP地址</th>
                                            <th>更新前</th>
                                            <th>更新后</th>
                                            <th>备注</th>
                                            <th>提交人</th>
                                            <th>提交时间</th>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($servudlist)): $k = 0; $__LIST__ = $servudlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                                                <td><?php echo ($k); ?></td>
                                                <td><?php echo ($vo["logtype"]); ?></td>
                                                <td><?php echo ($vo["ipaddr"]); ?></td>
                                                <td><?php echo ($vo["pre_data"]); ?></td>
                                                <td><?php echo ($vo["new_data"]); ?></td>
                                                <td><?php echo ($vo["remarks"]); ?></td>
                                                <td><?php echo ($vo["committer"]); ?></td>
                                                <td><?php echo ($vo["commit_at"]); ?></td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                    </div><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="claaa">IP变更</td>
                                <td>
                                    <?php if($servipuplist[0] != ''): ?><table class="table table-bordered" style="min-width: 1050px;">
                                        <thead>
                                            <th></th>
                                            <th>旧IP</th>
                                            <th>新IP</th>
                                            <th>提交人</th>
                                            <th>提交时间</th>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($servipuplist)): $k = 0; $__LIST__ = $servipuplist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                                                <td><?php echo ($k); ?></td>
                                                <td style="width: 280px;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 330px;"><?php echo (substr($vo["oldip"],0,60)); ?></td>
                                                            <td>
                                                                <?php if(!empty($vo['oldip'])&&strlen($vo['oldip'])>60) :?>
                                                                ...<span class="glyphicon glyphicon-eye-open" style="padding-left: 1em" onclick="alert('<?php echo ($vo["oldip"]); ?>')" title="<?php echo ($vo["oldip"]); ?>"></span>
                                                                <?php endif;?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="width: 280px;">
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td style="width: 330px;"><?php echo (substr($vo["newip"],0,60)); ?></td>
                                                            <td>
                                                                <?php if(!empty($vo['newip'])&&strlen($vo['newip'])>60) :?>
                                                                ...<span class="glyphicon glyphicon-eye-open" style="padding-left: 1em" onclick="alert('<?php echo ($vo["newip"]); ?>')" title="<?php echo ($vo["newip"]); ?>"></span>
                                                                <?php endif;?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td><?php echo ($vo["operator"]); ?></td>
                                                <td><?php echo ($vo["updatetime"]); ?></td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table><?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="claaa">服务器转让</td>
                                <td>
                                    <?php if($servtflist[0] != ''): ?><table class="table table-bordered">
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- 弹窗 end-->
</body>
</html>