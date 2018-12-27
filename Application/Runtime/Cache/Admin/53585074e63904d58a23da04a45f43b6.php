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
.sort{cursor: pointer;}
.sort:hover{color: #337ab7;text-decoration: underline;}
</style>
<script>
$(function(){
    $('.table-hover tbody tr').hover(function(){
        $(this).find('.operate-btns').show();
    },function(){
        $(this).find('.operate-btns').hide();
    })
    //view
    $('.view').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        myalert('查看工单','760px','680px',"<?php echo U('Workorder/viewitem');?>?nid="+nid);
    })
    //奖金清零
    $('.empty-b').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        layer.confirm('确定将【'+nid+'】奖金清零?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Worktable/emptybns",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //工单重置
    $('.reset').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        layer.confirm('确定将工单【'+nid+'】重置?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Worktable/reset",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('重置成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('重置失败',{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //删除
    $('.remove').click(function(){
        var nid=$(this).closest('tr').find('.nid').text();
        layer.confirm('确定删除【'+nid+'】?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Worktable/remove",{"nid":nid},function(data,status){
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
        $('.condition-panel').toggle();
    })
    //select:type2 change

    $("select[name='type2']").change(function(){
        var str="<option value=''>--请选择--</option>";
        var val=$(this).val();
        switch(val){
            case "问题处理":str+="<option>服务器重启</option><option>接线</option><option>破密</option><option>刷机</option><option>断网</option>"+
            "<option>添加IP</option><option>更换IP</option><option>网络检测</option><option>硬件检查</option><option>更换位置</option>"+
            "<option>更换硬件</option><option>重装Win系统</option><option>重装Linux系统</option><option>更换IP重装Win系统</option>"+
            "<option>更换IP重装Linux系统</option><option>更换硬件重装系统</option><option>租用机器增减硬件</option><option>托管机器增减硬件</option>"+
            "<option>搬机器1U</option><option>搬机器2U</option><option>修改启动项</option><option>借用配件</option><option>借用配件重装系统</option>"+
            "<option>新上架</option><option>自动化装WIN03系统</option>";break;
            case "上架单":str+="<option>上架</option><option>新上架</option>";break;
            case "下架单":str+="<option>下架</option>";break;
            case "服务器转让":str+="<option>订单转让</option><option>上架转让</option><option>下架转让</option>";break;
        }
        $("select[name='action']").html(str);
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
        $('.sform').attr("action","<?php echo U('Worktable/exportcsv');?>");
        $('.sform').submit();
    })
})
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-table"></i> 工单报表</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Worktable/list');?>" method="GET">
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
                <span class="lb">工单类型</span>
                <select class="form-control" name="type2">
                    <option value="">--请选择--</option>
                    <option <?php if($type2 == '问题处理'): ?>selected<?php endif; ?>>问题处理</option>
                    <option <?php if($type2 == '上架单'): ?>selected<?php endif; ?>>上架单</option>
                    <option <?php if($type2 == '下架单'): ?>selected<?php endif; ?>>下架单</option>
                    <option <?php if($type2 == '服务器转让'): ?>selected<?php endif; ?>>服务器转让</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">处理方法</span>
                <select class="form-control" name="action"></select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">受理部门</span>
                <select class="form-control" name="recvdept">
                    <option value="">--请选择--</option>
                    <option <?php if($recvdept == '技术部'): ?>selected<?php endif; ?>>技术部</option>
                    <option <?php if($recvdept == '客服部'): ?>selected<?php endif; ?>>客服部</option>
                    <option <?php if($recvdept == '网络部'): ?>selected<?php endif; ?>>网络部</option>
                    <option <?php if($recvdept == '财务部'): ?>selected<?php endif; ?>>财务部</option>
                </select>
            </div>
            <div class="condition-panel-item" style="width: 260px;">
                <span class="lb">提交时间</span>
                <input type="text" name="commit_at_from" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($commit_at_from); ?>">~
                <input type="text" name="commit_at_to" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($commit_at_to); ?>">
            </div>
            <div class="condition-panel-item" style="width: 260px;">
                <span class="lb">受理时间</span>
                <input type="text" name="receive_at_from" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($receive_at_from); ?>">~
                <input type="text" name="receive_at_to" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($receive_at_to); ?>">
            </div>
            <div class="condition-panel-item" style="width: 260px;">
                <span class="lb">完成时间</span>
                <input type="text" name="complete_at_from" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($complete_at_from); ?>">~
                <input type="text" name="complete_at_to" class="form-control" style="width: 110px;display: inline-block;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($complete_at_to); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">完成结果</span>
                <select class="form-control" name="comp_state">
                    <option value="">--请选择--</option>
                    <option <?php if($comp_state == '优'): ?>selected<?php endif; ?>>优</option>
                    <option <?php if($comp_state == '中'): ?>selected<?php endif; ?>>中</option>
                    <option <?php if($comp_state == '差'): ?>selected<?php endif; ?>>差</option>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机房</span>
                <select class="form-control" name="room">
                    <option value="">--请选择--</option>
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option <?php if($vo == $room): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">受理人</span>
                <select class="form-control" name="receiver">
                    <option value="">--请选择--</option>
                    <?php if(is_array($receiverlst)): $i = 0; $__LIST__ = $receiverlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo["realname"] == $receiver): ?>selected<?php endif; ?>><?php echo ($vo["realname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">提交人</span>
                <select class="form-control" name="committer">
                    <option value="">--请选择--</option>
                    <?php if(is_array($committerlst)): foreach($committerlst as $key=>$vo): ?><option <?php if($vo["realname"] == $committer): ?>selected<?php endif; ?>><?php echo ($vo["realname"]); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15" style="overflow: hidden;">
            <?php if($perm['工单系统']['工单报表']['导出']): ?><a href="javascript:;" class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</a><?php endif; ?>
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
        <table class="table table-hover" style="min-width: 2100px;">
            <thead>
                <tr>
                    <th>操作</th>
                    <th class="sort" data-val="nid">ID</th><th>标题</th>
                    <th>客户名称</th><th>IP地址</th>
                    <th>工单类型</th><th>处理方法</th>
                    <th>受理部门</th><th>受理工程师</th><th>用时</th>
                    <th class="sort" data-val="bonus">奖金</th><th>完成结果</th>
                    <th>提交时间</th><th>受理时间</th>
                    <th class="sort" data-val="complete_at">完成时间</th><th>处理时限(分钟)</th><th>所在机房</th>
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
                                    <?php if($perm['工单系统']['工单报表']['奖金清零']): ?><button class="btn btn-sm btn-success empty-b" title="奖金清零"><i class="fa fa-eraser"></i></button><?php endif; ?> 
                                    <?php if($perm['工单系统']['工单报表']['工单重置']): ?><button class="btn btn-sm btn-info reset" title="工单重置"><i class="fa fa-refresh"></i></button><?php endif; ?>
                                    <?php if($perm['工单系统']['工单报表']['删除']): ?><button class="btn btn-sm btn-danger remove" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="nid"><?php echo ($vo["nid"]); ?></td>
                    <td><?php echo ($vo["title"]); ?></td>
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