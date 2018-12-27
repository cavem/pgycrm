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
    th{color: #fff;font-weight: normal;}
    td{color: #4b556a;}
    .table-condensed>thead>tr>th,.table-condensed>tbody>tr>td{vertical-align: middle;padding: 8px 4px;}
    .table>tbody>tr>td{border-bottom: 1px solid #ddd;}
    .table>thead>tr>th{border-bottom: 0px solid #ddd;}
    .btn{padding: 4px 8px;font-size: 12px;}
    .radio{display: inline-block;}
    .form-control{width: 150px;height:30px;display: inline-block;line-height: 30px;font-size: 12px;}
    .section2{padding: 10px;}
</style>
<script>
    $(function(){
        var mulayer=function(title,url,width,height){
            layer.closeAll(); 
            layer.open({
                type: 2,
                title: title,
                shade: 0.6,
                shadeClose: true,
                maxmin: true, //开启最大化最小化按钮
                area: [width, height],
                content: url
            });
        }
        //close
        $('.upclose').click(function(){
            window.parent.location.reload();
        })
        var localurl = window.location.href;
        var vpsid=localurl.split("?")[1]; //获取主机编号
        vpsid = vpsid.split("=")[1];
        //还原
        $('.restore').click(function(){
            var bankid=$(this).closest('tr').find('.bankid').text();
            layer.msg("还原备份将会覆盖您现有数据(注:还原完整备份将会覆盖清除现有快照)，您确定已经备份好现有数据并继续还原备份集吗?", {
                time: 20000, //20s后自动关闭
                btn: ['确定','关闭'],
                yes:function(){
                    layer.msg("正在还原...", {
                        time: 20000, //20s后自动关闭
                    });
                    $.post('bank',{"subaction":"revert","bkid":bankid,"vpsid":vpsid},function(data,status){
                        if(status=="success"){
                            layer.closeAll();
                            layer.msg("操作成功！", {
                                time: 2000, //2s后自动关闭
                            });
                            setTimeout("window.location.reload();",2000);
                        }
                    })
                }
            });
            
            
        })
        //删除
        $('.delete').click(function(){
            var bankid=$(this).closest('tr').find('.bankid').text();
            layer.msg("确定要删除此备份集吗？", {
                time: 20000, //20s后自动关闭
                btn: ['确定','关闭'],
                yes:function(){
                    $.post('bank',{"subaction":"del","bkid":bankid,"vpsid":vpsid},function(data,status){
                        if(status=="success"){
                            layer.closeAll();
                            layer.msg("删除成功！", {
                                time: 2000, //2s后自动关闭
                            });
                            setTimeout("window.location.reload();",2000);
                        }
                    })
                }
            });
            
        })
        //创建备份
        $('.makebank').click(function(){
            $('.section1').css('display','none');
            $('.section2').css('display','block');
        })
        //购买更多备份空间
        $('.buybank').click(function(){
            mulayer('升级主机配置','/Admin/Cloud/upgrade','650px','650px');
        })
        //确认备份 confirm
        var snapshot=$('.snapshot').text();//快照备份
        var full=$('.full').text();//完整备份

        $('.confirm').click(function(){
            var bkname=$('.bankname').val();//备份集名
            var bktype=$("input[name='bank']:checked").val();//备份类型
            if(bkname!=""){
                if($('.shotback').prop('checked')){
                    if(snapshot!='0'){
                        $.post('bank',{"subaction":'backup',"bkname":bkname,"bktype":bktype,"vpsid":vpsid},function(data,status){
                            if(status=="success"){
                                console.log(data);
                            }
                        })
                    }else{
                        layer.msg("请先购买快照备份集！", {
                            time: 20000, //20s后自动关闭
                            btn: ['确定','关闭'],
                        });
                    }
                }else if($('.fullback').prop('checked')){
                    if(full!='0'){
                        $.post('bank',{"subaction":'backup',"bkname":bkname,"bktype":bktype},function(data,status){
                            if(status=="success"){
                                console.log(data);
                            }
                        })
                    }else{
                        layer.msg("请先购买完整备份集！", {
                            time: 20000, //20s后自动关闭
                            btn: ['确定','关闭'],
                        });
                    }
                }
            }else{
                layer.msg("请输入备份集名称！", {
                    time: 20000, //20s后自动关闭
                    btn: ['确定','关闭'],
                });
            }
        })
    })
</script>
<body>
    <div class="section1">
        <table class="table table-condensed table-hover">
            <thead>
                <tr style="background: #09c;color: #fff;">
                    <th>编号</th>
                    <th>名称</th>
                    <th>类型</th>
                    <th>备份时间</th>
                    <th>操作系统</th>
                    <th>大小</th>
                    <th>状态</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if($banklist == ''): ?><tr>
                        <td colspan="9" style="text-align: center;height: 150px;line-height: 150px;border-bottom: 0px solid #ddd;">
                            <span style="width: 100px;height: 100px;border-radius:100px;background: #ddd;display: block;margin:30px auto 0;padding: 20px 0;"><img src="/Application/Admin/View/Public/img/box.png"></span>
                            <p style="color: #4b556a;">暂无数据</p>
                        </td>
                    </tr><?php endif; ?>
                <?php if(is_array($banklist)): foreach($banklist as $key=>$banklistvo): ?><tr>
                        <td class="bankid"><?php echo ($banklistvo["fid"]); ?></td>
                        <td><?php echo ($banklistvo["fconfig"]["backup_name"]); ?></td>
                        <td>
                            <?php switch($banklistvo["fname"]): case "Full_Backup": ?>完整备份<?php break;?>
                                <?php case "Snapshot": ?>快照备份<?php break;?>
                                <?php default: endswitch;?>
                        </td>
                        <td><?php echo (date('Y-m-d H:i:s',$banklistvo["fconfig"]["time"])); ?></td>
                        <td><?php echo ($banklistvo["fconfig"]["os"]); ?></td>
                        <td><?php echo ($banklistvo["fconfig"]["vdisk"]); ?></td>
                        <td>
                            <?php switch($banklistvo["fstatus"]): case "1": ?><span class="text-success">完成</span><?php break;?>
                                <?php case "0": ?><span class="text-danger">失败</span><?php break;?>
                                <?php default: endswitch;?>
                        </td>
                        <td><button class="btn btn-primary restore">还原</button> <button class="btn btn-primary delete">删除</button></td>
                    </tr><?php endforeach; endif; ?>                
                
                <!-- <tr>
                    <td colspan="9" style="text-align: center;height: 150px;line-height: 150px;">
                        <span style="width: 100px;height: 100px;border-radius:100px;background: #ddd;display: block;margin:30px auto 0;padding: 20px 0;"><img src="/Application/Admin/View/Public/img/box.png"></span>
                        <p style="color: #4b556a;">暂无数据</p>
                    </td>
                </tr> -->
            </tbody>
        </table>
        <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;">
            <button class="btn btn-primary makebank" style="background-color: #2f8ad8;">创建备份</button> <button class="btn btn-primary buybank">购买更多备份空间</button> <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
    </div>
    <div class="section2" style="display: none;">
        <div><b>备份集名称：</b><input type="text" class="form-control bankname">50个字符以内</div>
        <div><b>备份集类型：</b><div class="radio"><label><input type="radio" name="bank" class="shotback" value="0" checked>快照备份（本地）</label></div><div class="radio"><label><input type="radio" name="bank" class="fullback" value="1">完整备份（异地）</label></div></div>
        <p><b>你还可创建：</b><b class="snapshot"><?php echo ($vpsinfo["vconfig"]["backup_snapshot"]); ?></b>个快照备份，<b class="full"><?php echo ($vpsinfo["vconfig"]["backup_full"]); ?></b>个完整备份</p>
        <p><b>每天允许执行完整备份和还原的时间集(小时)：</b>-1</p> 
        <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary confirm" style="background-color: #2f8ad8;">确定</button> <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
    </div>
</body>
</html>