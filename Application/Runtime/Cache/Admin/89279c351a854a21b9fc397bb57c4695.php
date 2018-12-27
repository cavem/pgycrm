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
<style>
a{color: #337ab7;}
a:hover{color: #23527c;}
</style>
<script>
$(function(){
    $('.add').click(function(){
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var ipseg=body.find("input[name='seg1']").val()+'.'+body.find("input[name='seg2']").val()+'.'+body.find("input[name='seg3']").val()+'.'+body.find("input[name='seg4']").val();
            layer.load();
            $.post('/Ipsegs/new',formdata+'&ipseg='+ipseg,function(data,status){
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('添加失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('新增IP段','900px','660px',"<?php echo U('Ipsegs/new');?>",confirm);
    })
    $('.view').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(){
            layer.closeAll();
        }
        myalert('查看IP段【'+name+'】IP','900px','660px',"<?php echo U('Ipsegs/view');?>"+"?name="+name,confirm);
    })
    $('.edit').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var ipseg=body.find("input[name='seg1']").val()+'.'+body.find("input[name='seg2']").val()+'.'+body.find("input[name='seg3']").val()+'.'+body.find("input[name='seg4']").val();
            layer.load();
            $.post('/Ipsegs/edit',formdata+"&id="+id+'&ipseg='+ipseg,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('修改IP段【'+name+'】','900px','660px',"<?php echo U('Ipsegs/edit');?>"+"?id="+id,confirm);
    })
    $('.remove').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+name+'】?', {
                btn: ['确定','取消']
            }, function(){
            layer.load();
            $.post('/Ipsegs/remove',{"id":id},function(data,status){
                if(data==0){
                    layer.msg('删除成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('删除失败',{icon:2});
                    window.location.reload();
                }
            })
        })
    })
    $('.add-ip').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var sip=body.find("input[name='sipaddr']").val();
            var eip=body.find("input[name='eipaddr']").val();
            if (sip==''||sip==undefined) 
            {
                layer.msg('请输入IP地址', {icon: 0});return false;
            }
            if (eip!='')
            {
                var start=sip.replace(/.\d{1,3}$/,''); 
                var end=eip.replace(/.\d{1,3}$/,'');
                if(start!=end)
                {
                    layer.msg('确保为同一段ip', {icon: 0});
                    return false;
                }
                if(parseInt(sip.replace('.',''))>parseInt(eip.replace('.','')))
                {
                    layer.msg('结束ip要大于开始ip', {icon: 0});
                    return false;
                }
            }
            var startstr = sip.match(/(\d+)\.(\d+)\.(\d+)\.(\d+)/g);
            var endstr = eip.match(/(\d+)\.(\d+)\.(\d+)\.(\d+)/g);  
            if (startstr == null){
                layer.msg('你输入的IP地址无效', {icon: 0});
                return false;
            }else if (RegExp.$1>255 || RegExp.$2>255 || RegExp.$3>255 || RegExp.$4>255){
                layer.msg("你输入的IP地址无效"); 
                return false;
            }
            layer.load();
            $.post('/Ipsegs/add_ip',formdata,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else if(data==0){
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }else{
                    layer.msg(data,{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('IP段【'+name+'】添加IP','900px','660px',"<?php echo U('Ipsegs/add_ip');?>"+"?name="+name,confirm);
    })
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Ipsegs/list');?>"+"?p="+cpage;
    })
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-product-hunt"></i> IP段管理</span>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <form class="sform" action="<?php echo U('Ipsegs/list');?>" method="POST">
                <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
            </form>
            <i class="fa fa-times empty"></i>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <?php if($perm['资源管理']['IP段管理']['新增']): ?><button class="btn btn-primary fl add mr10"><i class="fa fa-plus"></i> 新增</button><?php endif; ?>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                <th>编号</th><th>网络段</th><th>子网掩码</th><th>空闲IP数</th><th>所在路由器</th><th>所属VLAN</th><th>所在机房</th><th>所属运营商</th><th>使用公司</th><th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($ipsegslist)): $k = 0; $__LIST__ = $ipsegslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td class="name"><?php echo ($vo["ipseg"]); ?></td>
                        <td><?php echo ($vo["netmask"]); ?></td>
                        <td><?php echo ($vo["count"]); ?></td>
                        <td><?php echo ($vo["router"]); ?></td>
                        <td><?php echo ($vo["vlan"]); ?></td>
                        <td><?php echo ($vo["room"]); ?></td>
                        <td><?php echo ($vo["isp"]); ?></td>
                        <td><?php echo ($vo["company"]); ?></td>
                        <td style="width: 200px;">
                            <button class="btn btn-sm btn-primary add-ip" title="添加ip"><i class="fa fa-plus"></i></button>
                            <?php if($perm['资源管理']['IP段管理']['查看']): ?><button class="btn btn-sm btn-info view" title="查看ip"><i class="fa fa-eye"></i></button><?php endif; ?>
                            <?php if($perm['资源管理']['IP段管理']['修改']): ?><button class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></button><?php endif; ?>
                            <?php if($perm['资源管理']['IP段管理']['删除']): ?><button class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>