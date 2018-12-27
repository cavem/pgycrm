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
    .form-control{display: inline-block;height: 30px;}
    .btn{padding: 4px 8px;font-size: 14px;}
    .form-group{margin-bottom: 0;}
    .ml20{margin-left:20px;}
    .ml10{margin-left: 10px;}
    .edit-line{margin: 4px 0;}
    .firstlabel{width: 100px;text-align: right;display: inline-block;}
</style>
<script>
    $(function(){
        //获取vid sid
        var url=window.location.href;
        var param=url.split("?")[1];
        param=param.split("&");
        var vid=param[0].split("=")[1];
        var sid=param[1].split("=")[1];
        //初始化加载ip
        var vip=$('.vip').val();
        $.post('subedit',{'serverid':sid},function(data,status){
            if(status=="success"){
                var obj=eval(data[0]);
                var shtml="<option value="+vip+">"+vip+"</option>";
                for (let key in obj){
                    shtml+="<option value="+obj[key]["ip"]+">"+obj[key]["ip"]+"</option>";
                    $('.mainip').html(shtml);
                    $('.extraip').html(shtml);
                }
            }
        })
        
        //savesub保存
        $('.savesub').click(function(){
            var formdata=$('form').serialize();
            var additionalips="";
            $('.extraip').children("option:selected").each(function(){
                additionalips+=$(this).val()+',';
            })
            formdata+='&additionalips='+additionalips;
            //console.log(formdata);
            $.post('subeditsave',formdata,function(data,status){
                if(status=="success"){
                    if(eval(data)[0]=="0"){
                        layer.msg("保存成功！",{icon:1});
                    }else{
                        layer.msg("保存失败！",{icon:0});
                    }
                }else{
                    layer.msg("发送失败！",{icon:0});
                }
            })
        })

        //close
        $('.upclose').click(function(){
            window.parent.layer.closeAll();
        })
    })
</script>
<body style="text-align: center;">
    <div class="proedit" style="text-align: left;padding: 10px;">
    <form  method="post" name="mform">
        <div class="contain">
            <div class="edit-line">
                <b class="firstlabel">服务类型：</b><span>VPS主机</span><b class="ml20">子服务项目：</b><span>#VPS<?php echo ($info["vid"]); ?></span>
                <input type="hidden" name="vid" value="<?php echo ($info["vid"]); ?>">
                <div class="checkbox ml20" style="display: inline-block;">
                    <label>
                        <input type="checkbox" name="substate" value="1" checked>同步更新子服务资料及状态
                    </label>
                </div>
            </div>
            <div class="edit-line">
                <b class="firstlabel">云主机编号：</b><span>#<?php echo ($vpsno); ?></span><b class="ml20">操作系统：</b><span><?php echo ($info["vos"]); ?></span>
            </div>
            <div class="edit-line">
                <b class="firstlabel">服务器分组：</b>
                <!-- <select class="form-control" style="width: 200px;">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select> -->
                <!-- <b class="ml20">显示名称：</b> -->
                <input type="text" class="form-control" name="servergroup" value="<?php echo ($servergroup); ?>" style="width: 200px;">
            </div>
            <!-- <div class="edit-line">
                <b class="firstlabel">所在服务器：</b>
                <select class="form-control" style="width: 270px;">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <b class="ml20">显示名称：</b><input type="text" class="form-control" style="width: 200px;">
            </div> -->
            <div class="edit-line">
                <b class="firstlabel">云主机配置：</b>
                <div class="checkbox" style="display: inline-block;">
                    <label>
                        <input type="checkbox" name="update" value="1" checked>立即更新主机配置（可能需要重启）
                    </label>
                </div>
            </div>
            <div class="edit-line">
                <b class="firstlabel">CPU数量：</b><input type="text" name="cpunum" class="form-control" value="<?php echo ($info["vcpu"]); ?>" style="width: 70px;">
                <b class="ml20">内存：</b><input type="text" class="form-control" value="1204" style="width: 70px;">~<input type="text" name="ramnum" class="form-control" value="<?php echo ($info["vram"]); ?>" style="width: 70px;">MB
                <b class="ml20">硬盘：</b><input type="text" name="disknum" class="form-control" value="<?php echo ($info["vdisk"]); ?>" style="width: 70px;">GB
            </div>
            <div class="edit-line" style="border-bottom:1px solid #000;padding-bottom:10px;">
                <b class="firstlabel">每月可用流量：</b><input type="text" name="bandwidth" class="form-control" value="<?php echo ($info["vbandwidth"]); ?>" style="width: 70px;">GB(0为不限)
                <b class="ml20">端口：</b><input type="text" name="port" class="form-control" value="<?php echo ($info["vport"]); ?>" style="width: 70px;">Mpbs(0为不限)
            </div>
            <!-- <div class="edit-line" style="border-bottom: 1px solid #000;">
                <b class="firstlabel">可用备份集数：</b><input type="text" class="form-control" style="width: 70px;">个快照,<input type="text" class="form-control" style="width: 70px;">个完整备份
                <div class="checkbox" style="display: inline-block;">
                    <label>
                        <input type="checkbox"><b>共享IP型主机：</b>
                    </label>
                </div>
                <span>可映射</span><input type="text" class="form-control" style="width: 70px;">个端口,可绑定<input type="text" class="form-control" style="width: 70px;">个域名
            </div> -->
            <div class="edit-line">
                <b class="firstlabel">主机别名：</b><input type="text" name="servername" class="form-control" value="<?php echo ($info["vname"]); ?>" style="width: 200px;">
                <b class="ml20">主机状态：</b>
                <select name="serverstate" class="form-control" style="width: 150px;font-size: 12px;">
                    <option value="2" <?php if($info.vpsinfo.state == 'Running'): ?>selected<?php endif; ?>>正常</option>
                    <option value="1" <?php if($info.vpsinfo.state == 'locked'): ?>selected<?php endif; ?>>锁定</option>
                    <option value="0">安装中</option>
                    <option value="-1"<?php if($info.vpsinfo.state == 'overdue'): ?>selected<?php endif; ?>>欠费停机</option>
                    <option value="-2">超流量运行</option>
                    <option value="-3">超流量停机</option>
                </select>
            </div>
            <div class="edit-line">
                <b class="firstlabel">主IP地址：</b>
                <input type="hidden" class="vip" value="<?php echo ($info["vip"]); ?>">
                <select name="serverip" class="form-control mainip" style="width: 150px;">
                    
                </select>
                <b class="ml20">MAC地址：</b><span><?php echo ($info["vpsinfo"]["mac"]); ?></span>
            </div>
            <div class="edit-line">
                <b class="firstlabel" style="position: relative;bottom: 32px;">额外IP地址：</b>
                <select multiple class="form-control extraip" style="width: 150px;">

                </select>按(Ctrl)多选
            </div>
            <!-- <div class="edit-line">
                <b class="firstlabel">实时资源状况：</b>
                <span>CPU使用：<?php echo ($info["ucpu"]); ?>%</span><span class="ml20">磁盘i/o：<?php echo ($info["uio"]); ?></span>
                <span class="ml20">已用流量：</span><input type="text" class="form-control" style="width: 100px;">G
                <span class="ml20">重置日期：</span><input type="text" class="form-control" style="width: 100px;">
            </div> -->
            <!-- <div class="edit-line">
                <b class="firstlabel">主机操作限制：</b>
                <span>限制日期标记：</span><input type="text" class="form-control" style="width: 100px;">
                <span class="ml20">已经重装次数：</span><input type="text" class="form-control" style="width: 100px;">
            </div> -->
        </div>
    
    </form>
    <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0;">
        <button class="btn btn-primary savesub" style="background-color: #2f8ad8;">保存子服务配置</button>
        <button class="btn btn-default upclose">关闭</button>&nbsp;
    </div>
    </div>
</body>
</html>