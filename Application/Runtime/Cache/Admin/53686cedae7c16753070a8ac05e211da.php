<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/style.css" rel="stylesheet" type="text/css"  />
<link title="blue" href="/Application/Admin/View/Public/css/dermadefault.css" rel="stylesheet" type="text/css"/>
<link title="green" href="/Application/Admin/View/Public/css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link title="orange" href="/Application/Admin/View/Public/css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link href="/Application/Admin/View/Public/css/templatecss.css" rel="stylesheet" title="" type="text/css" />
<link title="" href="/Application/Admin/View/Public/css/jquery.range.css" rel="stylesheet" type="text/css"  />
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.cookie.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.range.js" type="text/javascript"></script>
</head>
<style>
    .btn{padding: 4px 8px;font-size: 12px;}
    th{color: #fff;font-weight: normal;}
    td{color: #4b556a;}
    .checkbox, .radio{margin-top: 0;margin-bottom: 0;}
    .table-condensed>thead>tr>th,.table-condensed>tbody>tr>td{vertical-align: middle;padding: 8px 4px;}
    .table>tbody>tr>td{border-bottom: 1px solid #ddd;}
    .table>thead>tr>th{border-bottom: 0px solid #ddd;}
    .form-control{width: 60px;height:30px;display: inline-block;line-height: 30px;}
    .section1,.section2,.section3{padding: 0 10px;width: 600px;margin: 0 auto;}
    .ml15{margin-left: 15px;}
</style>
<script>
    $(function(){
        var localurl = window.location.href;
        var vpsid=localurl.split("?")[1];
        vpsid = vpsid.split("=")[1];
        $('.upclose').click(function(){
            window.parent.location.reload();
        })
        $('.buynow').click(function(){
            var ipnum = $('.ipnum').text();
            if(ipnum==0){
                layer.msg("您最多还可为此主机添加0个IP地址，如需要更多IP地址请与客服联系！", {
                    time: 20000, //20s后自动关闭
                    btn: ['确定','关闭'],
                });
            }else{
                layer.msg("请稍等..", {
                    time: 20000, //20s后自动关闭
                });
                $.post('ipaddr',{"vpsid":vpsid},function(data,status){
                    if(status=="success"){
                        if (data==2) 
                        {
                            layer.closeAll();
                            layer.msg("IP不足，请联系管理员！", {
                                time: 2000, //20s后自动关闭
                            });
                        }
                        else
                        {
                            layer.closeAll();
                            layer.msg("购买成功！", {
                                time: 2000, //20s后自动关闭
                            });
                        }
                    }
                })
            }

        })
        $('.wkaip').click(function(){
            window.location.href="nccontrol?vpsid="+vpsid;
        })
    })
</script>
<body>
    <div class="section1">
        <div>
            <p><b>IP地址列表：</b></p>
            <p><b><?php if(is_array($output)): foreach($output as $key=>$v): echo ($v["ip"]); ?><br/><?php endforeach; endif; ?></b></p>
            <p>您还可以为此主机添加<b class="ipnum"><?php echo ($outputnum==1?1:0); ?></b>个IP，每个<b>200.00</b>元，帐户余额：<b><?php echo ($balance); ?></b> RMB</p>
            <div><span>增加IP地址数：</span><input type="number" class="form-control" min="1" max="1" value="1">个 × <b>200.00</b>元 <button class="btn btn-primary ml15 buynow">立即购买</button></div>
            <p style="margin-top: 25px;">最终费用按您的主机续费时间计算</p>
        </div>
        <div style="border-top: 1px dotted #60aff6;text-align:right;padding: 10px 0;width:100%;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary wkaip" style="background-color: #2f8ad8;">网卡控制 & 绑定IP地址</button> <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
    </div>
</body>
</html>