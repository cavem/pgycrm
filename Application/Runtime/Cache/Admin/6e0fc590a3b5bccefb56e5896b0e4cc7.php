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
        var vpsid=localurl.split("?")[1]; //获取主机编号
        vpsid = vpsid.split("=")[1];
        //close
        $('.upclose').click(function(){
            window.parent.location.reload();
        })

        //禁用
        $('.forbidden').click(function(){
            layer.msg('请稍等...',{
                time:20000,
            })
            var vfid=$('.vfid').val();//网卡id
            $.post('nccontrol',{"vpsid":vpsid,"subaction":1,"vfid":vfid},function(data,status){
                if(status=="success"){
                    layer.closeAll();
                    layer.msg("已禁用", {
                        icon: 1,
                    });
                    window.location.reload();
                    console.log(data);
                }else{
                    layer.closeAll();
                    layer.msg("操作失败", {
                        icon: 0,
                    });
                    window.location.reload();
                }
            })
        })
        //启用
        $('.startuse').click(function(){
            layer.msg('请稍等...',{
                time:20000,
            })
            var vfid=$('.vfid').val();//网卡id
            $.post('nccontrol',{"vpsid":vpsid,"subaction":0,"vfid":vfid},function(data,status){
                if(status=="success"){
                    if(eval(data)[0]=="0"){
                        layer.closeAll();
                        layer.msg("已启用", {
                            icon: 1,
                        });
                        window.location.reload();
                    }else{
                        layer.closeAll();
                        layer.msg("操作失败", {
                            icon: 2,
                        });
                    }
                }else{
                    layer.closeAll();
                    layer.msg("操作失败", {
                        icon: 2,
                    });
                    window.location.reload();
                }
            })
        })
        //绑定IP地址
        $('.bdip').click(function(){
            $('.section2').css('display','none');
            $('.section3').css('display','block');
        })
        //确定
        $('.confirm').click(function(){
            layer.msg('请稍等...',{
                time:20000,
            })
            var mac=$('.mac').val();
            var ip=$("input[type='checkbox']:checked");
            var ips="";
            ip.each(function(){
                ips+=$(this).val()+"|";
            })
            ips=ips.substring(0,ips.length-1);
            $.post('setips',{"vpsid":vpsid,"nicCount":1,"mac_0":mac,"ip_0":ips},function(data,status){
                console.log(data);
                if(status=="success"){
                    if(eval(data)[0]=="0"){
                        layer.closeAll();
                        layer.msg("操作成功", {
                            icon: 1,
                        });
                        setTimeout(window.location.reload(),1000);
                    }else{
                        layer.closeAll();
                        layer.msg("操作失败", {
                            icon: 2,
                        });
                    }
                    
                }else{
                    layer.closeAll();
                    layer.msg("操作失败", {
                        icon: 2,
                    });
                    window.location.reload();
                }
            })
        })
    })
</script>
<body>
    <div class="section2">
        <table class="table table-condensed table-hover">
            <thead>
                <tr style="background: #09c;color: #fff;">
                    <th>编号</th>
                    <th>MAC</th>
                    <th>网络</th>
                    <th>状态</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($netcardlist != ''): ?><tr>
                    <input type="hidden" class="vfid" value="<?php echo ($netcardlist["id_1"]); ?>">
                    <input type="hidden" class="mac" value="<?php echo ($netcardlist["mac_1"]); ?>">
                    <td>1</td>
                    <td><?php echo ($netcardlist["mac_1"]); ?></td>
                    <td><?php echo ($netcardlist["network_1"]); ?></td>
                    <td>
                        <?php switch($netcardlist["status_1"]): case "1": ?><span class="text-success">启用</span><?php break;?>
                            <?php case "0": ?><span class="text-danger">禁用</span><?php break;?>
                            <?php default: endswitch;?>
                    </td>
                    <td>
                        <?php switch($netcardlist["status_1"]): case "1": ?><button class="btn btn-primary forbidden">禁用</button><?php break;?>
                            <?php case "0": ?><button class="btn btn-primary startuse">启用</button><?php break;?>
                            <?php default: endswitch;?>
                    </td>
                </tr>
                <?php else: ?>
                <tr><td colspan="5">当前主机有正在执行的任务，请等待这些任务完成后再执行此操作。</td></tr><?php endif; ?>
                
                <!-- <tr>
                    <td colspan="9" style="text-align: center;height: 150px;line-height: 150px;">
                        <span style="width: 100px;height: 100px;border-radius:100px;background: #ddd;display: block;margin:30px auto 0;padding: 20px 0;"><img src="/Application/Admin/View/Public/img/box.png"></span>
                        <p style="color: #4b556a;">暂无数据</p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <div style="border-top: 1px dotted #60aff6;text-align:right;padding: 10px 0;width:100%;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary bdip" style="background-color: #2f8ad8;">绑定IP地址</button> <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
    </div>
    <div class="section3" style="display: none;">
        <table class="table table-condensed table-hover">
            <thead>
                <tr style="background: #09c;color: #fff;">
                    <th>网卡<?php echo ($netcardlist["mac_1"]); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($output)): foreach($output as $key=>$v): ?><tr>
                    <td class="id"><div class="checkbox"><label><input type="checkbox" name="ipordhcp" value="<?php echo ($v["ip"]); ?>"> <?php echo ($v["ip"]); ?></label></div></td>
                </tr><?php endforeach; endif; ?>
                <tr>
                    <td class="id"><div class="radio"><label><input type="radio" name="ipordhcp" value=""> DHCP自动获取</label></div></td>
                </tr>
                <tr>
                    <td><b>温馨提示：</b>同个网卡仅能绑定相同IP段的IP，双击可取消IP选择</td>
                </tr>
                <!-- <tr>
                    <td colspan="9" style="text-align: center;height: 150px;line-height: 150px;">
                        <span style="width: 100px;height: 100px;border-radius:100px;background: #ddd;display: block;margin:30px auto 0;padding: 20px 0;"><img src="/Application/Admin/View/Public/img/box.png"></span>
                        <p style="color: #4b556a;">暂无数据</p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <div style="border-top: 1px dotted #60aff6;text-align:right;padding: 10px 0;width:100%;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary confirm" style="background-color: #2f8ad8;">确定</button> <button class="btn btn-default upclose">取消</button>&nbsp;
        </div>
    </div>
</body>
</html>