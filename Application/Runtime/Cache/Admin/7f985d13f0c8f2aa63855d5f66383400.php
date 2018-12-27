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
.renewal{width:400px;margin: 0 auto;padding: 10px;}
.form-control{width: 150px;height:30px;display: inline-block;line-height: 30px;}
</style>
<script>
$(function(){
    //close
    $('.upclose').click(function(){
        window.parent.location.reload();
    })
    //radio
    $("input[type='radio']").click(function(){
        var tval=$(this).val();
        $('.renprice').text(tval);
    })
    //confirm
    $(".confirm").click(function(){
        var chval=$("input[type='radio']:checked").val();
        alert(chval);
    })
});
</script>
<body>
    <div class="renewal">
        <label for="name">请选择续费周期：</label>
        <div class="radio">
            <label>
                <input type="radio" name="feecircle" value="100.00" checked> <b>100.00</b> /月
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="feecircle" value="270.00"> <b>270.00</b> /季(9.0折)
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="feecircle" value="480.00"> <b>480.00</b> /半年(8.0折)
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="feecircle" value="840.00"> <b>840.00</b> /年(7.0折)
            </label>
        </div>
        <p style="margin-top: 20px;">账户余额：<b><?php echo ($balance); ?></b> RMB</p>
        <p>续费价格：<b class="renprice">100.00</b> RMB</p>
        <div style="margin-top: 20px;">优惠码：<input type="text" class="form-control"> <button class="btn btn-primary">使用</button> <button class="btn btn-primary">不使用</button></div>
        <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0px;">
            <button class="btn btn-primary confirm" style="background-color: #2f8ad8;">确认续费</button> <button class="btn btn-default upclose">取消</button>&nbsp;
        </div>
    </div>
</body>
</html>