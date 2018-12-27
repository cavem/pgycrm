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
    $('.table-hover tbody tr').hover(function(){
        $(this).find('.operate-btns').show();
    },function(){
        $(this).find('.operate-btns').hide();
    })
    //放回处理
    $('.reset').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        layer.confirm('确定将【'+nid+'】恢复?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Worktrash/reset",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('放回成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('放回失败',{icon:2});
                }
            })
        });
    })
    //view
    $('.view').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        myalert('查看工单','760px','680px',"<?php echo U('Workorder/viewitem');?>?nid="+nid);
    })
    $('.gopage').click(function(){
        var cpage=$('.cpage').val();
        window.location.href="<?php echo U('Worktrash/list');?>"+"?p="+cpage;
    })
})
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-trash"></i> 回收站</span>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <form class="sform" action="<?php echo U('Worktrash/list');?>" method="POST">
                <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
            </form>
            <i class="fa fa-times empty"></i>
        </div>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
        <table class="table table-hover" style="min-width: 2000px;">
            <thead>
                <tr>
                    <th>操作</th>
                    <th>ID</th><th>客户名称</th><th>IP地址</th>
                    <th>工单类型</th><th>处理方法</th>
                    <th>受理部门</th><th>受理工程师</th><th>用时</th><th>奖金</th><th>完成结果</th>
                    <th>提交时间</th><th>受理时间</th><th>完成时间</th><th>处理时限(分钟)</th><th>所在机房</th>
                    <th>提交人</th>
                </tr>
            </thead>
            <tbody>
              <?php if(is_array($tasklist)): $i = 0; $__LIST__ = $tasklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td class="text-navy td-action">
                        <div class="act-more">
                            <div style="position: relative;text-align: left;">
                                <button class="btn btn-sm btn-info view" title="查看"><i class="fa fa-eye"></i></button>
                                <div class="operate-btns" style="position: absolute;width: 200px;top:0px;left: 38px;text-align:left;display: none;">
                                    <button class="btn btn-sm btn-warning reset" title="恢复"><i class="fa fa-external-link"></i></button>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="nid"><?php echo ($vo["nid"]); ?></td>
                    <td><?php echo ($vo["cname"]); ?></td>
                    <td>
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 220px;"><?php echo (substr($vo["ipaddr"],0,30)); ?></td>
                                <td>
                                    <?php if(!empty($vo['ipaddr'])&&strlen($vo['ipaddr'])>30) :?>
                                    ...<span class="fa fa-eye" style="padding-left: 1em" title="<?php echo ($vo["ipaddr"]); ?>"></span>
                                    <?php endif;?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td><?php echo ($vo["type2"]); ?></td>
                    <td><?php echo ($vo["action"]); ?></td>
                    <td><?php echo ($vo["recvdept"]); ?></td>
                    <td><?php echo ($vo["receiver"]); ?></td>
                    <td><?php echo ($vo["total_use"]); ?></td>
                    <td><?php echo ($vo["bonus"]); ?></td>
                    <td>
                        <?php switch($vo["comp_state"]): case "优": ?><span class="label label-success">优</span><?php break;?>
                            <?php case "中": ?><span class="label label-warning">中</span><?php break;?>
                            <?php case "差": ?><span class="label label-danger">差</span><?php break; endswitch;?>
                    </td>
                    <td><?php echo ($vo["commit_at"]); ?></td>
                    <td><?php echo ($vo["receive_at"]); ?></td>
                    <td><?php echo ($vo["complete_at"]); ?></td>
                    <td><?php echo ($vo["timelimit"]); ?></td>
                    <td><?php echo ($vo["room"]); ?></td>
                    <td><?php echo ($vo["committer"]); ?></td>
                    
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="17"><span class="label label-danger">总奖金：</span><?php echo ($totalbonus); ?></td>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
</div>
</body>
</html>