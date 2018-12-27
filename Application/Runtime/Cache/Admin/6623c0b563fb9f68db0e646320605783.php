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
.tr-active{background: #8bd6b6 !important};
.updown{display: inline-block;width: 20px;position: relative;top: 7px;text-align: center;background: #eee;}
.updown span{display: block;cursor: pointer;color: #999;}
.updown span:hover{color: #111;}
.lsit-wrap th,td{white-space:nowrap;font-size: 14px;vertical-align: middle;}
.sort{cursor: pointer;}
.sort:hover{color: #337ab7;text-decoration: underline;}
</style>
<script>
$(function(){
    $("[data-toggle='tooltip']").tooltip();
    $('.table-hover tbody tr').hover(function(){
        $(this).find('.operate-btns').show();
    },function(){
        $(this).find('.operate-btns').hide();
    })
    $('.username').click(function(){
        window.location.href="<?php echo U('Service/list');?>"+"?custname="+$(this).text();
    })
    $('.close').click(function(){
        $('.sform').submit();
    })
    $('.condition-ctrl').click(function(){
        if($(this).find('i').hasClass('fa-caret-down')){
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
            $('.lsit-wrap').css({"height":"580px","overflow":"auto"});
        }else{
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
            $('.lsit-wrap').css({"height":"","overflow":"auto"});
        }
        $('.condition-panel').slideToggle();
    })
    $("select[name='idcname']").change(function(){
        var idcname=$(this).children("option:selected").val();
        var meshelfcode=$('.meshelfcode').val();
        $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
            data=JSON.parse(data);
            var shelfcon='<option value="">--请选择--</option>';
            for(var i in data){
                shelfcon+='<option>'+data[i]['code']+'</option>';
            }
            $("select[name='shelfcode']").html(shelfcon);
        })
    })
    $('.edit').click(function(){
        var servid=$(this).closest('tr').find('.userid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Service/edit',"ID="+servid+"&"+formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('修改服务器','900px','660px',"<?php echo U('Service/edit');?>"+"?servid="+servid,confirm);
    })
    $('.view').click(function(){
        var servid=$(this).closest('tr').find('.userid').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('查看服务器','900px','660px',"<?php echo U('Service/view');?>"+"?servid="+servid,confirm);
    })
    $('.remove').click(function(){
        var servid=$(this).closest('tr').find('.userid').text();
        layer.confirm('确定删除【'+servid+'】?', {
            btn: ['确定','取消']
        }, function(){
            $.post("/Service/remove",{"servid":servid},function(data,status){
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
    $('.install').click(function(){
        var servid=$(this).closest('tr').find('.userid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.get('/Service/install',"ID="+servid+"&"+formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('系统安装','900px','660px',"<?php echo U('Service/install');?>"+"?servid="+servid,confirm);
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
        $('.sform').attr("action","<?php echo U('Service/exportcsv');?>");
        $('.sform').submit();
    })
})

/*问题处理/下架/服务器转让*/
function handleitem(t){
    var sid=$(t).closest('tr').find('.userid').text();
    var confirm=function(index,layero){
        //获取iframe的body元素
        var body = layer.getChildFrame('body',index);
        var action = body.find("[name='action']").val();
        if (action=='0') 
        {
            layer.msg('请选择处理方法', {icon: 0});return false;
        }
        var timelimit = body.find("[name='timelimit']").val();
        if (timelimit==''||timelimit==undefined) 
        {
            layer.msg('请输入处理时限', {icon: 0});return false;
        }
        
        var formdata = body.find('.mform').serialize();
        var sid = body.find("input[name='svid']").val();
        $.post('/Service/isexist',{"sid":sid},function(data,status){
            if(data==0){
                layer.load();
                $.post('/Workorder/serveradd',decodeURIComponent(formdata,true),function(data,status){
                    if(status="success"){
                        window.location.reload();
                    }
                })
            }else{
                layer.msg("当前ip有工单正在处理",{icon:0});
            }
        })
    }
    myalert('问题处理','760px','680px',"/Workorder/confirmserver?sid="+sid,confirm);
}

function loweritem(t){
    var sid=$(t).closest('tr').find('.userid').text();
    var confirm=function(index,layero){
        //获取iframe的body元素
        var body = layer.getChildFrame('body',index);
        var formdata = body.find('.mform').serialize();
        var sid = body.find("input[name='svid']").val();
        $.post('/Service/isexist',{"sid":sid},function(data,status){
            if(data==0){
                layer.load();
                $.post('/Workorder/serveradd',decodeURIComponent(formdata,true),function(data,status){
                    if(status="success"){
                        window.location.reload();
                    }
                })
            }else{
                layer.msg("当前ip有工单正在处理",{icon:0});
            }
        })
    }
    myalert('下架','760px','680px',"/Workorder/confirmserver?sid="+sid+"&type=1",confirm);
}

function attornitem(t){
    var sid=$(t).closest('tr').find('.userid').text();
    var confirm=function(index,layero){
        //获取iframe的body元素
        var body = layer.getChildFrame('body',index);
        var formdata = body.find('.mform').serialize();
        var sid = body.find("input[name='svid']").val();
        var action = body.find("[name='action']").val();
        if (action=='0') 
        {
            layer.msg('请选择处理方法', {icon: 0});return false;
        }
        var timelimit = body.find("[name='timelimit']").val();
        if (timelimit==''||timelimit==undefined) 
        {
            layer.msg('请输入处理时限', {icon: 0});return false;
        }
        $.post('/Service/isexist',{"sid":sid},function(data,status){
            if(data==0){
                layer.load();
                $.post('/Workorder/serveradd',decodeURIComponent(formdata,true),function(data,status){
                    if(status="success"){
                        window.location.reload();
                    }
                })
            }else{
                layer.msg("当前ip有工单正在处理",{icon:0});
            }
        })
    }
    myalert('服务器转让','760px','680px',"/Workorder/confirmserver?sid="+sid+"&type=2",confirm);
}
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-server"></i> 服务器管理</span>
        <?php if($custname != ''): ?><div class="alert alert-warning alert-dismissable fl ml15">
                <button type="button" class="close" aria-hidden="true">
                    &times;
                </button>
                客户名称：<b class="text-username"><?php echo ($custname); ?></b>
            </div><?php endif; ?>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Service/list');?>" method="GET">
        <input type="hidden" name="p">
        <input type="hidden" name="sc" value="<?php echo ($sc); ?>">
        <div class="mysearchbox fr">
            <i class="fa fa-search search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容" value="<?php echo ($key); ?>">
            <i class="fa fa-times empty"></i>
        </div>
        <div class="square fr condition-ctrl">
            <i class="fa fa-caret-down"></i>
        </div>
        <div class="condition-panel">
            <div class="condition-panel-item">
                <span class="lb">到期日期【开始】</span>
                <input type="text" name="" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">到期日期【结束】</span>
                <input type="text" name="" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});">
            </div>
            <div class="condition-panel-item">
                <span class="lb">服务器状态</span>
                <select class="form-control" name="servstate">
                    <option value="">--请选择--</option>
                    <option <?php if($servstate == '在线运行'): ?>selected<?php endif; ?>>在线运行</option>
                    <option <?php if($servstate == '闲置空机'): ?>selected<?php endif; ?>>闲置空机</option>
                    <option <?php if($servstate == '终止合同'): ?>selected<?php endif; ?>>终止合同</option>
                    <option <?php if($servstate == '期满移出'): ?>selected<?php endif; ?>>期满移出</option>
                    <option <?php if($servstate == '暂出维护'): ?>selected<?php endif; ?>>暂出维护</option>
                    <option <?php if($servstate == '下架'): ?>selected<?php endif; ?>>下架</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机房</span>
                <select class="form-control" name="idcname">
                    <option value="">--请选择--</option>
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option <?php if($vo == $idcname): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机柜</span>
                <select class="form-control" name="shelfcode">
                    <option value="">--请选择--</option>
                    <?php if($idcname != ''): if(is_array($shelflst)): $i = 0; $__LIST__ = $shelflst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo["code"] == $shelfcode): ?>selected<?php endif; ?>><?php echo ($vo["code"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">设备类型</span>
                <select class="form-control" name="devicetype">
                    <option value="">--请选择--</option>
                    <option <?php if($devicetype == '服务器'): ?>selected<?php endif; ?>>服务器</option>
                    <option <?php if($devicetype == '交换机'): ?>selected<?php endif; ?>>交换机</option>
                    <option <?php if($devicetype == '防火墙'): ?>selected<?php endif; ?>>防火墙</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">产品类型</span>
                <select class="form-control" name="productkind">
                    <option value="">--请选择--</option>
                    <?php if(is_array($pdtkindlist)): $i = 0; $__LIST__ = $pdtkindlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($productkind==$vo['name']){echo 'selected';} ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">相关销售</span>
                <select class="form-control" name="salers">
                    <option value="">--请选择--</option>
                    <option <?php if($salers == '杨龙'): ?>selected<?php endif; ?>>杨龙</option>
                    <option <?php if($salers == '王酥'): ?>selected<?php endif; ?>>王酥</option>
                    <option <?php if($salers == '杨宁'): ?>selected<?php endif; ?>>杨宁</option>
                    <option <?php if($salers == '孙一'): ?>selected<?php endif; ?>>孙一</option>
                    <option <?php if($salers == '蔡涛'): ?>selected<?php endif; ?>>蔡涛</option>
                    <option <?php if($salers == '何硕'): ?>selected<?php endif; ?>>何硕</option>
                    <option <?php if($salers == '汤瑞东'): ?>selected<?php endif; ?>>汤瑞东</option>
                    <option <?php if($salers == '慧慧'): ?>selected<?php endif; ?>>慧慧</option>
                    <option <?php if($salers == '杨总安排'): ?>selected<?php endif; ?>>杨总安排</option>
                    <option <?php if($salers == '公司自用'): ?>selected<?php endif; ?>>公司自用</option>
                    <option <?php if($salers == '客户授权'): ?>selected<?php endif; ?>>客户授权</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">机器转让</span>
                <select class="form-control">
                    <option value="">--请选择--</option>
                    <option>转让机器</option>
                    <option>未转让机器</option>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15" style="overflow: hidden;">
            <?php if($perm['业务管理']['服务器管理']['导出']): ?><a href="javascript:;" class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</a><?php endif; ?>
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover" style="min-width: 1800px;">
                <thead>
                    <tr>
                    <th>操作</th>
                    <th class="idsc sort" data-val="ID">ID</th>
                    <th class="sort" data-val="ServNum">编号</th>
                    <th class="sort" data-val="CustName">客户名称</th><th>服务器类型</th>
                    <th>IP地址</th>
                    <th class="sort" data-val="IPNum">IP数量</th>
                    <th class="sort" data-val="Bandwidth">带宽限制</th>
                    <th>所在机房</th>
                    <th class="sort" data-val="ShelfCode">所在机柜</th>
                    <th>交换机端口</th>
                    <th>服务器外形</th>
                    <th>配置</th>
                    <th>备注</th>
                    <th style="width: 100px;">代理商备注</th>
                    <th class="sort" data-val="ServState">服务器状态</th>
                    <th>自动化</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($servlist)): $i = 0; $__LIST__ = $servlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td class="text-navy td-action">
                            <div class="act-more">
                                <div style="position: relative;text-align: left;">
                                    <?php if($perm['业务管理']['服务器管理']['查看']): ?><button class="btn btn-sm btn-info view" title="查看" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-eye"></i></button><?php endif; ?>
                                    <div class="operate-btns" style="position: absolute;top:0px;left: 38px;text-align:left;display: none;">
                                        <?php if($perm['业务管理']['服务器管理']['问题处理']): ?><button class="btn btn-sm btn-primary" type="button" onclick="handleitem(this)"><i class="fa fa-question" style="font-size: 14px;"></i> 问题处理</button><?php endif; ?>
                                        <?php if($perm['业务管理']['服务器管理']['下架']): ?><button class="btn btn-sm btn-primary" type="button" onclick="loweritem(this)"><i class="fa fa-arrow-down"></i> 下架</button><?php endif; ?>
                                        <?php if($perm['业务管理']['服务器管理']['服务器转让']): ?><button class="btn btn-sm btn-primary" type="button" onclick="attornitem(this)"><i class="fa fa-arrow-right"></i> 服务器转让</button><?php endif; ?>
                                        <?php if($perm['业务管理']['服务器管理']['系统安装']): ?><button class="btn btn-sm btn-primary install" title="系统安装" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-download"></i></button><?php endif; ?>
                                        <?php if($perm['业务管理']['服务器管理']['修改']): ?><button class="btn btn-sm btn-warning edit" title="编辑" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-edit"></i></button><?php endif; ?>
                                        <?php if($perm['业务管理']['服务器管理']['删除']): ?><button class="btn btn-sm btn-danger remove" title="删除" style="box-shadow: 5px 5px 6px #9E9E9E;"><i class="fa fa-trash"></i></button><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><a href="javascript:;" class="userid view"><?php echo ($vo["id"]); ?></a></td>
                        <td><?php echo ($vo["servnum"]); ?></td>
                        <td><a href="javascript:;" class="username"><?php echo ($vo["custname"]); ?></a></td>
                        <td><?php echo ($vo["productkind"]); ?></td>
                        
                        <td style="width: 280px;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 220px;"><?php echo (substr($vo["serv_ip"],0,30)); ?></td>
                                    <td>
                                        <?php if(!empty($vo['serv_ip'])&&strlen($vo['serv_ip'])>30) :?>
                                        ...<span class="glyphicon glyphicon-eye-open" style="padding-left: 1em" title="<?php echo ($vo["serv_ip"]); ?>"></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td><?php echo ($vo["ipnum"]); ?></td>
                        <td><?php echo ($vo["bandwidth"]); ?></td>
                        <td><?php echo ($vo["idcname"]); ?></td>
                        <td><?php echo ($vo["shelfcode"]); ?></td>
                        <td>
                            <?php if($vo["switchport"] != 'null'): echo ($vo["switchport"]); endif; ?>
                        </td>
                        <td><?php echo ($vo["deviceshape"]); ?></td>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 100px;"><?php echo (substr($vo["hwconfig"],0,25)); ?></td>
                                    <td>
                                        <?php if(!empty($vo['hwconfig'])&&strlen($vo['hwconfig'])>25) :?>
                                        ...<span class="fa fa-eye" style="padding-left: 1em" title="<?php echo ($vo["hwconfig"]); ?>"></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        
                        <td><span style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["remarks"]); ?></span></td>
                        <td>
                            <?php if($vo["custremarks"] != 'null'): ?><span data-toggle="tooltip" title="<?php echo ($vo["custremarks"]); ?>" style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["custremarks"]); ?></span><?php endif; ?>
                        </td>
                        <td>
                            <?php switch($vo["servstate"]): case "在线运行": ?><span class="label label-success">在线运行</span><?php break;?>
                                <?php case "闲置空机": ?><span class="label label-primary">闲置空机</span><?php break;?>
                                <?php case "终止合同": ?><span class="label label-danger">终止合同</span><?php break;?>
                                <?php case "期满移出": ?><span class="label label-warning">期满移出</span><?php break;?>
                                <?php case "暂出维护": ?><span class="label label-info">暂出维护</span><?php break;?>
                                <?php case "下架": ?><span class="label label-danger">下架</span><?php break; endswitch;?>
                        </td>
                        <td><?php echo ($vo["automation"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="17" style="line-height: 2em;">
                            <span class="total-item"><span class="label label-primary">总台数:</span> <?php echo ($count); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-primary">本公司自用:</span> <?php echo ($servcounts["self"]); ?></span>&nbsp;
                            <span class="total-item"><span class="label label-primary">空闲机器:</span> <?php echo ($servcounts["free"]); ?></span>&nbsp;
                            <?php if(is_array($servcounts2)): foreach($servcounts2 as $k=>$vo): if($vo != '0'): ?><span class="total-item"><span class="label label-info"><?php echo ($k); ?>:</span> <?php echo ($vo); ?></span>&nbsp;<?php endif; endforeach; endif; ?>                          
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>