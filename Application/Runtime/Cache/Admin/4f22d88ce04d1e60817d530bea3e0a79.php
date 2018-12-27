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
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}
input[type="number"]{
    -moz-appearance: textfield;
}
.form-control{width: 100px;height:30px;display: inline-block;line-height: 30px;font-weight: bold;}
.upgrade{width:100%;padding: 10px;}
.lanwrap{width: 600px;padding: 5px 0;margin: 0 auto;}
.pricett{float: right;color: #999;}
.updown{display: inline-block;width: 20px;position: relative;top: 7px;text-align: center;background: #eee;}
.updown span{display: block;}
.updown span:hover{background: #bbb;}
</style>
<script>
//端口滑动
$(function(){
    //余额
    var balance=$('.balance').text();
    balance=parseInt(balance);
    //升级价格
    var upprice;
    /** 
     *obj:对象
     *type:1：增0：减
     *num:增加或减少数
     *max:最大值
    */
    var incandred=function(obj,type,num,max){
        var thisval=obj.closest('.contain').find('input').val();
        var min=obj.closest('.contain').find('input').data('min');
        thisval=parseInt(thisval);
        if(type==1){
            if(thisval<max){
                thisval=thisval+num;
                obj.closest('.contain').find('input').val(thisval);
                obj.closest('.lanwrap').find('.bval').text(thisval);
            }
        }
        else{
            if(thisval>min){
                thisval=thisval-num;
                obj.closest('.contain').find('input').val(thisval);
                obj.closest('.lanwrap').find('.bval').text(thisval);
            }
        }
    }
    var sentjson=function(isbuy){
        var cpu=$('.cpunum').val();//cpu数
        var mmr=$('.mmrnum').val();//内存
        var ssd=$('.ssdnum').val();//硬盘
        var port=$('.port').val();//端口
        var shotbank=$('.shotbank').children('option:selected').val();//快照备份
        var fullbank=$('.fullbank').children('option:selected').val();//完整备份
        var promocode=$('.promocode').val();//优惠码
        $.post('upgrade',{"isbuy":isbuy,"cpu":cpu,"ram_max":mmr,"ram_min":1024,"disk":ssd,"bandwidth":0,"port":port,"backup_snapshot":shotbank,"backup_full":fullbank},function(data,status){
            if(status=="success"){
                layer.closeAll();
                if(typeof(data)=="number"){
                    $('.upprice').text(data);
                    upprice=data;
                }else{
                    if(eval(data)[0]=="0"){
                        layer.msg("升级成功！", {
                            time: 20000, //20s后自动关闭
                            btn: ['确定','关闭'],
                        });
                    }
                }
            }
        })
    }
    //流量滑动
    $('.single-slider').jRange({
        from: 0,
        to: 100,
        step: 1,
        scale: [0,25,50,75,100],
        format: '%s',
        width: 600,
        showLabels: true,
        showScale: true
    });
    $('.demo').mouseup(function(){
        setTimeout(function(){
            var port=$('.port').val();//端口
            var minport=$('.port').data('minval');
            if(port<minport){
                window.location.reload();
            }
            $('.portb').text(port);
            sentjson(0);
        },500)
    });
    //增加减少
    $('.cpuupdown .increase').click(function(){
        incandred($(this),1,2,16);
        sentjson(0);
    })
    $('.cpuupdown .reduce').click(function(){
        incandred($(this),0,2,16);
        sentjson(0);
    })
    $('.mmrupdown .increase').click(function(){
        incandred($(this),1,1024,16384);
        sentjson(0);
    })
    $('.mmrupdown .reduce').click(function(){
        incandred($(this),0,1024,16384);
        sentjson(0);
    })
    $('.ssdupdown .increase').click(function(){
        incandred($(this),1,10,80);
        sentjson(0);
    })
    $('.ssdupdown .reduce').click(function(){
        incandred($(this),0,10,80);
        sentjson(0);
    })
    $('.upclose').click(function(){
        window.parent.location.reload();
    })
    //备份
    $('.shotbank').change(function(){
        sentjson(0);
    })
    $('.fullbank').change(function(){
        sentjson(0);
    })

    //立即升级
    $('.sent').click(function(){
        if(balance>upprice){
            layer.msg("升级中...", {
                time: 20000, //20s后自动关闭
            });
            sentjson(1);
        }else{
            layer.msg("余额不足 :(", {
                time: 1000, //20s后自动关闭
            });
        }
        
    })
})
</script>
<body>
    <div class="upgrade">
        <div class="lanwrap w1200">
            <p class="title">CPU数量(核)：<b class="cpub bval"><?php echo ($vpsinfo["vcpu"]); ?></b></p>
            <div class="contain"><input type="number" class="form-control cpunum" data-min="<?php echo ($vpsinfo["vcpu"]); ?>" value="<?php echo ($vpsinfo["vcpu"]); ?>" readonly="readonly"> 
                <div class="updown cpuupdown"><span class="fa fa-caret-up increase"></span><span class="fa fa-caret-down reduce"></span></div> 核
                <span class="pricett">30.00元/核，最多16核</span>
            </div>
        </div>
        <div class="lanwrap w1200">
            <p class="lantt">内存大小(MB)：<b class="mmrb bval"><?php echo ($vpsinfo["vram"]); ?></b></p>
            <div class="contain"><input type="number" class="form-control mmrnum" data-min="<?php echo ($vpsinfo["vram"]); ?>" value="<?php echo ($vpsinfo["vram"]); ?>" readonly="readonly"> 
                <div class="updown mmrupdown"><span class="fa fa-caret-up increase"></span><span class="fa fa-caret-down reduce"></span></div> MB
                <span class="pricett">0.03元/MB,最多16384MB</span>
            </div>
        </div>
        <div class="lanwrap w1200">
            <p class="lantt">硬盘容量(GB)：<b class="ssdb bval"><?php echo ($vpsinfo["vdisk"]); ?></b></p>
            <div class="contain"><input type="number" class="form-control ssdnum" data-min="<?php echo ($vpsinfo["vdisk"]); ?>" value="<?php echo ($vpsinfo["vdisk"]); ?>" readonly="readonly"> 
                <div class="updown ssdupdown"><span class="fa fa-caret-up increase"></span><span class="fa fa-caret-down reduce"></span></div> GB
                <span class="pricett">10.00元/GB,最多80GB</span>
            </div>
        </div>
        <div class="lanwrap w1200">
            <p class="lantt">带宽流量(GB)：<b class="bdb"></b></p>
            <div class="demo" style="margin: 10px auto">
                <input type="hidden" id="port" value="100" style="display: none;"><div class="slider-container theme-green" style="width: 600px;">			<div class="back-bar">                <div class="selected-bar" style="width: 600px; left: 0px;"></div>                <div class="pointer low" style="display: none;"></div><div class="pointer-label" style="display: none;">123456</div>                <div class="pointer high last-active" style="left: 593px;"></div><div class="pointer-label" style="left: 560px;">不限流量</div>                <div class="clickable-dummy"></div></div></div>
            </div>
        </div>
        <div class="lanwrap w1200">
            <p class="lantt">网络端口(Mb)：<b class="portb"><?php echo ($vpsinfo["vport"]); ?></b><span class="pricett">50.00元/Mb,最多100Mbps</p>
            <div class="demo" style="margin: 10px auto">
                <input type="hidden" id="port" class="single-slider port" data-minval="<?php echo ($vpsinfo["vport"]); ?>" value="<?php echo ($vpsinfo["vport"]); ?>" style="display: none;">
            </div>
        </div>
        <!-- <div class="lanwrap w1200">
            <div class="lantt">
                可用备份集：快照：
                <div class="selecon" style="width:70px;height:10px;display: inline-block;">
                    <select class="form-control shotbank" style="height: 30px;width:70px;font-size: 12px;">
                        <option value="0" <?=$vpsinfo.vconfig.backup_snapshot==0?'selected':''?>>0个</option>
                        <option value="1" <?=$vpsinfo.vconfig.backup_snapshot==1?'selected':''?>>1个</option>
                    </select>
                </div>
                <span>单价：10元/个</span>  <b style="margin-left:20px;"></b>完整备份:
                <div class="selecon" style="width:70px;display: inline-block;">
                    <select class="form-control fullbank" style="height: 30px;width:70px;font-size: 12px;">
                        <option value="0" <?=$vpsinfo.vconfig.backup_full==0?'selected':''?>>0个</option>
                        <option value="1" <?=$vpsinfo.vconfig.backup_full==1?'selected':''?>>1个</option>
                    </select>
                </div>
                单价：20元/个
            </div>
        </div> -->
        <div class="lanwrap w1200">
            <p class="lantt">下次续费日期：<b><?php echo ($vpsinfo["bwdate"]); ?></b> <b style="margin-left:20px;"></b>本次升级周期：<b><?php echo ($updatecycle); ?></b>个月   余额：<b class="balance"><?php echo ($balance); ?></b> <b>RMB</b>
        </div>
        <div class="lanwrap w1200">
            <!-- <p class="lantt">标准升级费用：<b>0.00 RMB /月</b> <b style="margin-left:20px;"></b>本次升级费用：<b>0.00</b> <b>RMB</b> -->
            <p class="lantt">本次升级费用：<b class="upprice">0.00</b> <b>RMB</b>
        </div>
        <div class="lanwrap w1200">
            优惠码：<input type="text" class="form-control promocode" style="width:150px;height:30px;display:inline-block;">
            <button class="btn btn-primary">使用</button> <button class="btn btn-primary">不使用</button>
        </div>
        <div class="lanwrap w1200" style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0px;">
            <button class="btn btn-primary sent" style="background-color: #2f8ad8;">立即升级</button> <button class="btn btn-default upclose" style="font-size:12px;">取消</button>&nbsp;
        </div>
    </div>
</body>
</html>