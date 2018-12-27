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
        //isoselect
        $('.isoselect').change(function(){
            layer.msg("请稍等...", {
                time: 20000, //20s后自动关闭
            });
            var opselval=$(this).children("option:selected").val();
            $.post('cdrom',{"subaction":"change","cd_image":opselval,"vpsid":vpsid},function(data,status){
                if(status=="success"){
                    layer.msg("操作成功！", {
                        time: 2000, //20s后自动关闭
                    });
                    setTimeout("window.location.reload();",2000);
                }
            })
        })
    })
</script>
<body>
    <div style="width: 400px;margin: 0 auto;padding: 50px 20px;text-align: center;">
        <div class="form-group">
            <label for="name" style="float: left;">CD/DVD:</label>
            <select class="form-control isoselect">
                <option value="">请选择ISO光驱镜像文件</option>
                <option value="">弹出所有ISO光驱镜像</option>
                <?php if(is_array($image)): foreach($image as $key=>$imagevo): ?><option value="<?php echo ($imagevo); ?>" <?php if($key == $current): ?>selected<?php endif; ?>><?php echo ($key); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
    </div>
    <div style="border-top: 1px dotted #60aff6;text-align:right;padding: 10px 0;width:100%;position: absolute;bottom: 0;right: 0;">
        <button class="btn btn-default upclose">关闭</button>&nbsp;
    </div>
</body>
</html>