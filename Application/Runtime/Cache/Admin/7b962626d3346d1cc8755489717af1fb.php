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
p{margin: 0;}
.btn{padding: 4px 8px;font-size: 12px;}
img {width: 30px;height: 30px;}
.table>tbody>tr>td{vertical-align: middle;cursor: pointer;}
.osselect1,.osselect2{padding: 10px;}
.form-control{width: 150px;height:30px;display: inline-block;line-height: 30px;}
</style>
<script>
$(function(){
    //close
    $('.upclose').click(function(){
        window.parent.location.reload();
    })
    //td
    $('td').click(function(){
        var osid=$(this).data("osid");//系统id
        var ostype=$(this).data("ostype");//系统名称
        $('.osselect1').css('display','none');
        $('.osselect2').css('display','block');
        $('.chooseos').text(ostype);
        $('.osid').val(osid);
    })
    //backhome
    $('.backhome').click(function(){
        $('.osselect1').css('display','block');
        $('.osselect2').css('display','none');
    })
    //confirm
    $('.confirm').click(function(){
        var localurl = window.location.href;
        var vpsid=localurl.split("?")[1]; //获取主机编号
        vpsid = vpsid.split("=")[1];
        var check = $('.checkfirst').prop('checked');
        if(check==false){
            layer.msg('请勾选复选框以确认操作！', {
                time: 20000, //20s后自动关闭
                btn: ['确定','关闭'],
            });
        }else{
            var osid=$('.osid').val();//系统id
            var roottype=$("input[name='root']:checked").val();//格式化类型
            $.post('osselect',{"vpsid":vpsid,"osid":osid,"roottype":roottype},function(data,status){
                if(status=="success"){
                    if(eval(data)=="0"){
                        layer.msg('正在重装系统...</br>重装完成后请第一时间重置密码', {
                            time: 4000, //20s后自动关闭
                            //btn: ['确定','关闭'],
                        });
                        setTimeout("window.parent.location.reload();",4000);
                    }
                }
            })
        }
    })
});
</script>
<body>
    <div class="osselect1">
        <table class="table table-border table-hover">
            <tbody>
                <?php if(is_array($winos)): $i = 0; $__LIST__ = $winos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$winosvo): $mod = ($i % 2 );++$i;?><tr>
                        <td data-ostype="<?php echo ($winosvo["osname"]); ?>" data-osid="<?php echo ($winosvo["osid"]); ?>">
                            <img src="/Application/Admin/View/Public/img/Windows_VISTA_48px_520478_easyicon.net.png" width="40px" height="40px">
                            <div style="display: inline-block;">
                                <span style="display: block"><b><?php echo ($winosvo["osname"]); ?></b></span>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($linuxos)): $i = 0; $__LIST__ = $linuxos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$linuxosvo): $mod = ($i % 2 );++$i;?><tr>
                        <td data-ostype="<?php echo ($linuxosvo["osname"]); ?>" data-osid="<?php echo ($linuxosvo["osid"]); ?>">
                            <img src="/Application/Admin/View/Public/img/centos_24px_584190_easyicon.net.png" width="40px" height="40px">
                            <div style="display: inline-block;">
                                <span style="display: block"><b><?php echo ($linuxosvo["osname"]); ?></b></span>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
    <div class="osselect2" style="display: none;">
        <div>您选择的系统是：<b class="chooseos"></b><input type="hidden" class="osid" value=""> <button class="btn btn-primary backhome" style="margin-left:20px;">选择其它系统</button></div>
        <div for="name">安装模式：</div>
        <div class="radio">
            <label>
                <input type="radio" name="root" value="1" checked> <b>只格式化系统盘：（推荐）</b>
                <p style="font-size: 10px;">本选项将重新格式化系统盘分区(一般为C盘或/dev/xvda)，其它分区数据不受影响！</p>
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="root" value="0"> <b>全盘格式化模式：</b>
                <p style="font-size: 10px;">本选项将彻底删除所有硬盘分区数据，重新建立硬盘系统分区，重装前请确认已备份数据！</p>
            </label>
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox" class="checkfirst"> <b>勾选此处以确认重装系统操作！</b>
              <p style="font-size: 10px;">操作前请确认已备份好相关数据，如需要其它操作帮助，请联系客服！</p>
            </label>
        </div>
        <div style="border-top: 1px dotted #60aff6;text-align:right;padding: 10px 0;width:100%;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary confirm" style="background-color: #2f8ad8;">确定重装</button> <button class="btn btn-default upclose">取消</button>&nbsp;
        </div>
    </div>
</body>
</html>