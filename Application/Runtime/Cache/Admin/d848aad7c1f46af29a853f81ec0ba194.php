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
            //获取iframe的body元素
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
                $.post('/Shelf/new',formdata,function(data,status){
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
        myalert('新增机柜','900px','660px',"<?php echo U('Shelf/new');?>",confirm);
    })
    $('.view').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var confirm=function(){
            layer.closeAll();
        }
        myalert('查看','900px','660px',"<?php echo U('Shelf/view');?>"+"?name="+name,confirm);
    })
    $('.edit').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
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
                $.post('/Shelf/edit',formdata,function(data,status){
                    if(data==0){
                        layer.msg('修改成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('修改失败',{icon:2});
                        window.location.reload();
                    }
                })
            }
        }
        myalert('修改机柜【'+name+'】','900px','660px',"<?php echo U('Shelf/edit');?>"+"?id="+id,confirm);
    })
    $('.remove').click(function(){
        var name=$(this).closest('tr').find('.name').text();
        var id=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+name+'】?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Shelf/remove",{"id":id},function(data,status){
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
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Shelf/list');?>"+"?p="+cpage;
    })
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-tasks"></i> 机柜管理</span>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <form class="sform" action="<?php echo U('Shelf/list');?>" method="POST">
                <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
            </form>
            <i class="fa fa-times empty"></i>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <?php if($perm['资源管理']['机柜管理']['新增']): ?><button class="btn btn-primary fl add mr10"><i class="fa fa-plus"></i> 新增</button><?php endif; ?>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                <th>编号</th><th>机柜编号</th><th>可用U数</th><th>服务器数量</th><th>使用公司</th><th>所在机房</th><th>apcip</th><th>apcurl</th><th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($shelflist)): $k = 0; $__LIST__ = $shelflist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td class="name"><?php echo ($vo["code"]); ?></td>
                        <td><?php echo ($vo["u_num"]); ?></td>
                        <td><?php echo ($vo["s_num"]); ?></td>
                        <td><?php echo ($vo["company"]); ?></td>
                        <td><?php echo ($vo["room"]); ?></td>
                        <td><?php echo ($vo["apc_ip"]); ?></td>
                        <td><?php echo ($vo["apc_url"]); ?></td>
                        <td style="width: 200px;">
                            <?php if($perm['资源管理']['机柜管理']['查看']): ?><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button><?php endif; ?>
                            <?php if($perm['资源管理']['机柜管理']['修改']): ?><button class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></button><?php endif; ?>
                            <?php if($perm['资源管理']['机柜管理']['删除']): ?><button class="btn btn-sm btn-danger remove"><i class="fa fa-trash"></i></button><?php endif; ?>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>