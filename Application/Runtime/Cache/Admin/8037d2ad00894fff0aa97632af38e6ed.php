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
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<style>
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.lsit-wrap th,td{white-space:nowrap;font-size: 14px;vertical-align: middle;}
.sort{cursor: pointer;}
.sort:hover{color: #337ab7;text-decoration: underline;}
.trcheck{background: #fff900}
.trcheck:hover{background: #fff900 !important}
</style>
<script>
$(function(){
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
        }
        $('.condition-panel').slideToggle();
    })
    $('.table-hover tbody tr').hover(function(){
        $(this).find('.operate-btns').show();
    },function(){
        $(this).find('.operate-btns').hide();
    })
    
    $('.username').click(function(){
        layer.load();
        $("input[name='cname']").val($(this).text());
        $('.sform').submit();
    })
    $('.close').click(function(){
        layer.load();
        $("input[name='cname']").val('');
        $("input[name='key']").val('');
        $('.sform').submit();
    })
    //新增财务收入
    $('.new').click(function(){
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var isneed=0;
            body.find('.need').each(function(){
                if($(this).closest('.form-line').find("input").val()==''){
                    $(this).closest('.form-line').find("input").addClass('bdred');
                    layer.msg("必填项不能为空");
                    isneed+=1;
                    return false;
                }
            })
            if(isneed==0){
                layer.load();
                $.post('/Finan/new',formdata,function(data,status){
                    if(data==0){
                        layer.msg('添加成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('添加失败',{icon:2});
                        window.location.reload();
                    }
                })
            }
        }
        myalert('新增财务收入','900px','660px',"<?php echo U('Finan/new');?>",confirm);
    })
    //查看订单
    $('.view_order').click(function(){
        var id=$(this).closest('tr').find('.id').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('订单查看【'+id+'】','900px','660px',"<?php echo U('Finan/view_order');?>"+"?id="+id,confirm);
    })
    
    //查看收入
    $('.view_finan').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('收入查看【'+nid+'】','900px','660px',"<?php echo U('Finan/view_finan');?>"+"?nid="+nid,confirm);
    })
    //收入编辑
    $('.edit').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('/Finan/edit',formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('修改收入【'+nid+'】','900px','660px',"<?php echo U('Finan/edit');?>"+"?nid="+nid,confirm);
    })
    //款到确认
    $('.confirm_kd').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var id=$(this).closest('tr').find('.id').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post("/Finan/confirm_kd",formdata+"&nid="+nid+"&id="+id,function(data,status){
                if(data==0){
                    layer.msg('确认成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('确认失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('款到确认【'+nid+'】','900px','660px',"<?php echo U('Finan/confirm_kd');?>"+"?nid="+nid,confirm);
    })
    //主管确认
    $('.confirm_zg').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var id=$(this).closest('tr').find('.id').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post("/Finan/confirm_zg",formdata+"&nid="+nid+"&id="+id,function(data,status){
                if(data==0){
                    layer.msg('确认成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('确认失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('主管确认【'+nid+'】','900px','660px',"<?php echo U('Finan/confirm_zg');?>"+"?nid="+nid,confirm);
    })
    //判断数组是否存在某个值方法
    var IsInArray=function(arr,val){ 
    　　var testStr=','+arr.join(",")+","; 
    　　return testStr.indexOf(","+val+",")!=-1; 
    }
    // 
    var fnids=$('.fnids',window.parent.document).val();
    var fnidsarr=fnids.split(",");
    for(var i=0;i<fnidsarr.length;i++){
        if(fnidsarr[i]!=''){
            var idarr=fnidsarr[i].split("|");
            $('.cktbody').children('tr').each(function(){
                if(IsInArray(idarr,$(this).children("td:first").text())){
                    $(this).addClass('trcheck');
                }
            })
        }
    }
    //遍历所有选中项
    var allcheck=function(){
        var fnids=$('.fnids',window.parent.document).val();
        var fnidsarr=fnids.split(",");
        var p=$('.pages').find('.current').text();
        var ids='';
        $('.cktbody').children('tr').each(function(){
            if($(this).hasClass('trcheck')){
                ids+=$(this).children("td:first").text()+'|';
            }
        })
        if(p!=''){
            fnidsarr[p]=ids;
        }else{
            fnidsarr[0]=ids;
        }
        var s=fnidsarr.toString();
        $('.fnids',window.parent.document).val(s);
    }
    //多选
    $('.cktbody').children('tr').click(function(){
        if($(this).hasClass('trcheck')){
            $(this).removeClass('trcheck');
        }else{
            $(this).addClass('trcheck');
        }
        allcheck();
        console.log($('.fnids',window.parent.document).val());
    })
    //批量款到确认
    $('.pl_confirm_kd').click(function(){
        $('.iptable tbody').children('tr').removeClass('trcheck');
        var checknum=0;
        var statenum=0;
        $('.table-hover tbody tr').each(function(){
            if($(this).hasClass('trcheck')){
                checknum+=1;
            }
        })
        $('.trcheck').each(function(){
            if($(this).find('.state span').text()!="款到确认"){
                statenum+=1;
            }
        })
        if(checknum==0){
            layer.msg("未选中记录！",{icon:0});
        }else if(statenum!=0){
            layer.msg("选项中存在不是‘款到确认’选项！",{icon:0});
        }else{
            layer.load();
            $.post("/Finan/pl_confirm_kd",{'ids':$('.fnids',window.parent.document).val()},function(data,status){
                if(data==0){
                    layer.msg('操作成功',{icon:1});
                    $('.fnids',window.parent.document).val('');
                    window.location.reload();
                }else{
                    layer.msg('操作失败',{icon:2});
                    $('.fnids',window.parent.document).val('');
                    window.location.reload();
                }
            })
        }
    })
    //批量主管确认
    $('.pl_confirm_zg').click(function(){
        $('.iptable tbody').children('tr').removeClass('trcheck');
        var checknum=0;
        var statenum=0;
        $('.table-hover tbody tr').each(function(){
            if($(this).hasClass('trcheck')){
                checknum+=1;
            }
        })
        $('.trcheck').each(function(){
            if($(this).find('.state span').text()!="已付款"){
                statenum+=1;
            }
        })
        if(checknum==0){
            layer.msg("未选中记录！",{icon:0});
        }else if(statenum!=0){
            layer.msg("选项中存在不是‘已付款’选项！",{icon:0});
        }else{
            layer.load();
            $.post("/Finan/pl_confirm_zg",{'ids':$('.fnids',window.parent.document).val()},function(data,status){
                if(data==0){
                    layer.msg('操作成功',{icon:1});
                    $('.fnids',window.parent.document).val('');
                    window.location.reload();
                }else{
                    layer.msg('操作失败',{icon:2});
                    $('.fnids',window.parent.document).val('');
                    window.location.reload();
                }
            })
        }
    })
    //全选
    $('.checkall').click(function(){
        if($(this).html()=='<i class="fa fa-check"></i> 全选'){
            $(this).html('<i class="fa fa-times"></i> 取消全选');
            $('.cktbody').children('tr').addClass('trcheck');
        }else{
            $(this).html('<i class="fa fa-check"></i> 全选');
            $('.cktbody').children('tr').removeClass('trcheck');
        }
        allcheck();
        console.log($('.fnids',window.parent.document).val());
    })
    
    //删除
    $('.remove').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+nid+'】?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Finan/remove",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('删除成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('删除失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //跳转
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        $("input[name='p']").val(cpage);
        $('.sform').submit();
    })
    //排序
    $('.sort').click(function(){
        var val=$(this).data("val");
        var scval=$("input[name='sc']").val();
        var scvalarr=scval.split(' ');
        var zd=scvalarr[0];
        var st=scvalarr[1];
        if(val==zd){
            if(st=='asc'){
                $("input[name='sc']").val(val+' desc');
            }else{
                $("input[name='sc']").val(val+' asc');
            }
        }else{
            $("input[name='sc']").val(val+' asc');
        }
        $('.sform').submit();
    })
    $('.export').click(function(){
        layer.msg('请稍等...',{icon:16});
        $('.sform').attr("action","<?php echo U('Finan/exportcsv');?>");
        $('.sform').submit();
    })
})
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-linkedin-square"></i> 财务收入</span>
        <?php if($cname != ''): ?><div class="alert alert-warning alert-dismissable fl ml15">
                <button type="button" class="close" aria-hidden="true">
                    &times;
                </button>
                客户名称：<b class="text-username"><?php echo ($cname); ?></b>
            </div><?php endif; ?>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Finan/list');?>" method="GET">
        <input type="hidden" name="p">
        <input type="hidden" name="sc" value="<?php echo ($sc); ?>">
        <input type="hidden" name="cname" value="<?php echo ($cname); ?>">
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容" value="<?php echo ($key); ?>">
            <i class="fa fa-times empty"></i>
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item" style="width: 260px;">
                <span class="lb">到款日期</span>
                <input type="text" name="bank_recv_at_from" autocomplete="off" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($bank_recv_at_from); ?>">~
                <input type="text" name="bank_recv_at_to" autocomplete="off" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($bank_recv_at_to); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">费用开始日期</span>
                <input type="text" name="fee_begin_at" autocomplete="off" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($fee_begin_at); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">费用结束日期</span>
                <input type="text" name="fee_end_at" autocomplete="off" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($fee_end_at); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">付款状态</span>
                <div class="form-content">
                    <select class="form-control" name="state">
                        <option value="">--请选择--</option>
                        <option <?php if($state == '款到确认'): ?>selected<?php endif; ?>>款到确认</option>
                        <option <?php if($state == '已付款'): ?>selected<?php endif; ?>>已付款</option>
                        <option <?php if($state == '已确认'): ?>selected<?php endif; ?>>已确认</option>
                        <option <?php if($state == '已过期'): ?>selected<?php endif; ?>>已过期</option>
                    </select>
                </div>
            </div>
            <div class="condition-panel-item">
                <span class="lb">收款方式</span>
                <select class="form-control" name="recvtype">
                    <option value="">--请选择--</option>
                    <option <?php if($recvtype == '建设银行'): ?>selected<?php endif; ?>>建设银行</option>
                    <option <?php if($recvtype == '工商银行'): ?>selected<?php endif; ?>>工商银行</option>
                    <option <?php if($recvtype == '农业银行'): ?>selected<?php endif; ?>>农业银行</option>
                    <option <?php if($recvtype == '支付宝'): ?>selected<?php endif; ?>>支付宝</option>
                    <option <?php if($recvtype == '财付通'): ?>selected<?php endif; ?>>财付通</option>
                    <option <?php if($recvtype == '江苏银行'): ?>selected<?php endif; ?>>江苏银行</option>
                    <option <?php if($recvtype == '农行对公账户'): ?>selected<?php endif; ?>>农行对公账户</option>
                    <option <?php if($recvtype == '对公支付宝'): ?>selected<?php endif; ?>>对公支付宝</option>
                    <option <?php if($recvtype == '微信支付'): ?>selected<?php endif; ?>>微信支付</option>
                    <option <?php if($recvtype == 'QQ钱包'): ?>selected<?php endif; ?>>QQ钱包</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">订单类型</span>
                <div class="form-content">
                    <select class="form-control" name="ordertype">
                        <option value="">--请选择--</option>
                        <option <?php if($ordertype == '新业务'): ?>selected<?php endif; ?>>新业务</option>
                        <option <?php if($ordertype == '续费业务'): ?>selected<?php endif; ?>>续费业务</option>
                    </select>
                </div>
            </div>
            <div class="condition-panel-item">
                <span class="lb">付款周期</span>
                <div class="form-content">
                    <select class="form-control" name="paycycle">
                        <option value="">--请选择--</option>
                        <option <?php if($paycycle == '月付'): ?>selected<?php endif; ?>>月付</option>
                        <option <?php if($paycycle == '季付'): ?>selected<?php endif; ?>>季付</option>
                        <option <?php if($paycycle == '半年付'): ?>selected<?php endif; ?>>半年付</option>
                        <option <?php if($paycycle == '年付'): ?>selected<?php endif; ?>>年付</option>
                    </select>
                </div>
            </div>
            <div class="condition-panel-item">
                <span class="lb">相关销售</span>
                <select class="form-control" name="salesman">
                    <option value="">--请选择--</option>
                    <?php if(is_array($sales)): $i = 0; $__LIST__ = $sales;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($salesman == $vo['realname']): ?>selected<?php endif; ?>><?php echo ($vo["realname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px"></div>
            <a href="javascript:;" class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</a>
            <?php if($perm['财务管理']['财务收入']['新增']): ?><button class="btn btn-primary fl ml15 new"><i class="fa fa-plus"></i> 新增财务收入</button><?php endif; ?>
            <?php if($perm['财务管理']['财务收入']['款到确认']): ?><button class="btn btn-info fl ml15 pl_confirm_kd"><i class="fa fa-check"></i> 批量款到确认</button><?php endif; ?>
            <?php if($perm['财务管理']['财务收入']['主管确认']): ?><button class="btn btn-warning fl ml15 pl_confirm_zg"><i class="fa fa-check"></i> 批量主管确认</button><?php endif; ?>
            <?php if(($perm['财务管理']['财务收入']['款到确认']) OR ($perm['财务管理']['财务收入']['主管确认'])): ?><button class="btn btn-primary fl ml15 checkall"><i class="fa fa-check"></i> 全选</button><?php endif; ?>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover" style="min-width: 1800px;">
                <thead>
                    <tr>
                    <th class="sort" data-val="nid">ID</th>
                    <th class="sort" data-val="id">财务编号/订单编号</th><th>相关IP</th>
                    <th class="sort" data-val="cname">客户名称</th>
                    <th class="sort" data-val="bank_recv_at">到款日期</th>
                    <th class="sort" data-val="state">付款状态</th>
                    <th class="sort" data-val="money">收款金额</th><th>收款方式</th>
                    <th>付款周期</th>
                    <th>备注</th><th>相关销售</th><th>费用开始日期</th><th>费用结束日期</th><th>提交人</th><th>款到确认日期</th><th>款到确认人</th>
                    <th>确认日期</th><th>确认人</th>
                    <th>操作</th>
                    </tr>
                </thead>
                <tbody class="cktbody">
                    <?php if(is_array($finanlst)): $i = 0; $__LIST__ = $finanlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["nid"]); ?></td>
                        <td><a href="javascript:;" class="view_order id" title="查看订单详情"><?php echo ($vo["id"]); ?></a></td>
                        <td>
                            <table class="iptable" style="width: 100%;">
                                <tr>
                                    <td><?php echo (substr($vo["ipaddr"],0,30)); ?></td>
                                    <td>
                                        <?php if(!empty($vo['ipaddr'])&&strlen($vo['ipaddr'])>30) :?>
                                        ... <span class="fa fa-eye" style="padding-left: 1em;float: right;" title="<?php echo ($vo["ipaddr"]); ?>"></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td><a href="javascript:;" class="username js-pop js-drill" data-cid="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cname"]); ?></a></td>
                        <td><?php echo substr($vo['bank_recv_at'],0,10); ?></td>
                        <td class="state">
                            <?php switch($vo["state"]): case "款到确认": ?><span class="label label-info">款到确认</span><?php break;?>
                                <?php case "已付款": ?><span class="label label-warning">已付款</span><?php break;?>
                                <?php case "已确认": ?><span class="label label-success">已确认</span><?php break;?>
                                <?php case "已过期": ?><span class="label label-default">已过期</span><?php break; endswitch;?>
                        </td>
                        <td><?php echo (intval($vo["money"])); ?></td>
                        <td><?php echo ($vo["recvtype"]); ?></td>
                        <td><?php echo ($vo["paycycle"]); ?></td>
                        <td><?php echo ($vo["remark"]); ?></td>
                        <td><?php echo ($vo["salesman"]); ?></td>
                        <td><?php echo (substr($vo["fee_begin_at"],0,10)); ?></td>
                        <td><?php echo (substr($vo["fee_end_at"],0,10)); ?></td>
                        <td><?php echo ($vo["committer"]); ?></td>
                        <td><?php echo (substr($vo["paysure_at"],0,10)); ?></td>
                        <td><?php echo ($vo["paysureby"]); ?></td>
                        <td><?php echo (substr($vo["managersure_at"],0,10)); ?></td>
                        <td><?php echo ($vo["managersureby"]); ?></td>
                        <td class="text-navy td-action">
                            <div class="act-more">
                                <div style="position: relative;text-align: right;">
                                    <div class="operate-btns" style="position: absolute;top:0px;right: 38px;text-align:right;display: none;">
                                        <?php if($vo["state"] == '款到确认'): if($perm['财务管理']['财务收入']['款到确认']): ?><button class="btn btn-sm btn-info confirm_kd"><i class="fa fa-check"></i> 款到确认</button><?php endif; ?>
                                            <?php if($perm['财务管理']['财务收入']['修改']): ?><button class="btn btn-sm btn-primary edit" title="修改收入"><i class="fa fa-edit"></i></button><?php endif; ?>
                                        <?php elseif($vo["state"] == '已付款'): ?>
                                            <?php if($perm['财务管理']['财务收入']['主管确认']): ?><button class="btn btn-sm btn-warning confirm_zg"><i class="fa fa-check"></i> 主管确认</button><?php endif; ?>
                                            <?php if($perm['财务管理']['财务收入']['修改']): ?><button class="btn btn-sm btn-primary edit" title="修改收入"><i class="fa fa-edit"></i></button><?php endif; endif; ?>
                                        <?php if($perm['财务管理']['财务收入']['删除']): ?><button class="btn btn-sm btn-danger remove" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>
                                    </div>
                                    <?php if($perm['财务管理']['财务收入']['查看']): ?><button class="btn btn-sm btn-success view_finan" title="查看收入详情"><i class="fa fa-eye"></i></button><?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="14">
                            <span class="label label-primary">财务总额:</span><?php echo ($countarr["zj"]); ?>&nbsp;
                            <span class="label label-info">款到确认总额:</span><?php echo ($countarr["kdqr"]); ?>&nbsp;
                            <span class="label label-warning">已付款总额:</span><?php echo ($countarr["yfk"]); ?>&nbsp;
                            <span class="label label-success">已确认总额:</span><?php echo ($countarr["yqr"]); ?>&nbsp;
                            <span class="label label-default">已过期总额:</span><?php echo ($countarr["ygq"]); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>