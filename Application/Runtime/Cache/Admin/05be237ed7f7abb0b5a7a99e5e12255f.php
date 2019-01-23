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
.panel-wrap{width: 100%;padding: 0 50px;float: left;}
/* table{border: 1px solid #ddd;}
table > tbody > tr > td {
    border: 1px solid #ddd;
    border-top-color: rgb(221, 221, 221);
    border-top-style: solid;
    border-top-width: 1px;
    border-bottom-width: 1px;
} */
</style>
<script>
$(function(){
    $('.list-group-item').click(function(){
        $('.list-group').find('li').removeClass('list_active');
        $(this).addClass('list_active');
    })
    $('.check').click(function(){
        layer.load();
        var id=$(this).closest("tr").children("td:first").text();
        $.post("check",{"id":id},function(data){
            if(data==0){
                layer.msg('已确认',{icon:1});
                window.location.reload();
            }else{
                layer.msg('操作失败',{icon:2});
                window.location.reload();
            }
        })
    })
    $('.view').click(function(){
        var id=$(this).closest('tr').children("td:first").text();
        var confirm=function(){
            layer.closeAll();
        }
        myalert('查看考核【'+id+'】','900px','660px',"<?php echo U('Hastaffchk/view');?>"+"?id="+id,confirm);
    })
})
</script>
<div id="content" class="wow fadeIn" style="padding-top:20px;">
    <div class="container-fluid">
        <div class="panel-group" id="accordion">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            我的工作
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th class="sort" data-val="id">ID</th>
                                <th class="sort" data-val="name">工作名称</th>
                                <th>工作详情</th><th style="width: 100px;">工作频率</th><th style="width: 100px;">部门</th><th>负责人</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php echo ($vo["remarks"]); ?></td>
                                <td><?php echo ($vo["frequency"]); ?></td>
                                <td><?php echo $dptlist[$vo['department_id']]; ?></td>
                                <td><?php echo ($vo["userprofiles"]); ?></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <?php echo ($page); ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            我的考核
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>日期</th>
                                <th>是否确认</th>
                                <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($list2)): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["realname"]); ?></td>
                                <td><?php echo ($vo["assessmonth"]); ?></td>
                                <td>
                                    <?php switch($vo["isconfirm"]): case "1": ?><span class="label label-success">已确认</span><?php break;?>
                                        <?php case "": ?><span class="label label-danger">未确认</span><?php break; endswitch;?>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm view"><i class="fa fa-eye"></i></button>
                                    <?php if($vo["isconfirm"] == ''): ?><button class="btn btn-success btn-sm check" title="确认"><i class="fa fa-check"></i></button>
                                    <?php else: ?>
                                    <span class="text text-success">已确认</span><?php endif; ?>
                                </td><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                        <?php echo ($page2); ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseTHree">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTHree">
                            公司公告
                        </a>
                    </h4>
                </div>
                <div id="collapseTHree" class="panel-collapse collapse">
                    <div class="panel-body">

                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4 class="panel-title" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            技术公告
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse">
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>