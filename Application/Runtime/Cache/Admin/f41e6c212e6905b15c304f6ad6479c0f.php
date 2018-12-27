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
.updown{display: inline-block;width: 20px;position: relative;top: 5px;text-align: center;}
.updown span{display: block;cursor: pointer;color: #999;}
.updown span:hover{color: #111;}
.lsit-wrap th,td{white-space:nowrap;font-size: 14px;vertical-align: middle;}
.sort{cursor: pointer;}
.sort:hover{color: #337ab7;text-decoration: underline;}
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

    //查看 
    $('.view').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            layer.closeAll();
        }
        myalert('订单查看【'+nid+'】','900px','660px',"<?php echo U('Order/view');?>"+"?nid="+nid,confirm);
    })

    //编辑
    $('.edit').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var str='';
            body.find("input[type='checkbox']:checked").each(function(){
                var name=$(this).closest('tr').find('.name').text();
                var num=$(this).closest('tr').find('.num').val();
                var price=$(this).closest('tr').find('.price').text();
                var money=num*price;
                str+='{"name":'+name+',"num":'+num+',"price":'+price+',"money":'+money+'},';
            })
            str=str.substring(0,str.length-1);
            str='['+str+']';
            layer.msg('请稍等...',{icon:16});
            var pl=str!='[]'?"&prodlist="+str:"";
            $.post('/Order/edit',formdata+pl+"&nid="+nid,function(data,status){
                if(data==0){
                    layer.msg('修改成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('修改失败',{icon:2});
                    window.location.reload();
                }
            })
        }
        myalert('订单编辑','900px','660px',"<?php echo U('Order/edit');?>?nid="+nid,confirm);
    })
    //新上架
    $('.js-sj-item').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var timelimit = body.find("input[name='timelimit']").val();
            if(timelimit!=''){
                layer.load();
                $.post('/Workorder/grounding',formdata,function(data,status){
                    if(data==0){
                        layer.msg('添加成功',{icon:1});
                        window.location.reload();
                    }else{
                        layer.msg('添加失败',{icon:2});
                        window.location.reload();
                    }
                })
            }else{
                layer.msg("请选择处理方法",{icon:0});
            }
            
        }
        myalert('新上架','900px','660px',"<?php echo U('Workorder/newgrounding');?>"+"?id="+nid,confirm);
    })
    //新增财务收入
    $('.js-cwsr-item').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        var confirm=function(index,layero){
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.msg('请稍等...',{icon:16});
            $.post('/Order/add_pay',formdata,function(data,status){
                //alert(data);return;
                if(data==0){
                    layer.msg('添加成功',{icon:1});
                    window.location.reload();
                }else if(data==2){
                    layer.msg('预付款余额不足',{icon:2});
                }else{
                    layer.msg('添加失败',{icon:2});
                }
            })
        }
        myalert('新增财务收入','900px','660px',"<?php echo U('Order/add_pay');?>"+"?id="+nid,confirm);
    })

    //删除
    $('.remove').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定删除【'+nid+'】?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            //判断是否正在上架
            $.post("/Order/remove",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('删除成功',{icon:1});
                    window.location.reload();
                }else if(data==1){
                    layer.msg('删除失败',{icon:2});
                    window.location.reload();
                }else{
                    layer.msg(data,{icon:2});
                    window.location.reload();
                }
            })
        });
    })
    //回复生效
    $('.js-hfsx-item').click(function(){
        var nid=$(this).closest('tr').children('td:first').text();
        layer.confirm('确定恢复【'+nid+'】?', {
            btn: ['确定','取消']
        }, function(){
            layer.load();
            $.post("/Order/recover",{"nid":nid},function(data,status){
                if(data==0){
                    layer.msg('操作成功',{icon:1});
                    window.location.reload();
                }else{
                    layer.msg('操作失败',{icon:2});
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
    //exprot
    $('.export').click(function(){
        layer.msg('请稍等...',{icon:16});
        $('.sform').attr("action","<?php echo U('Order/exportcsv');?>");
        $('.sform').submit();
    })
})
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-list-ul"></i> 订单列表</span>
        <?php if($cname != ''): ?><div class="alert alert-warning alert-dismissable fl ml15">
                <button type="button" class="close" aria-hidden="true">
                    &times;
                </button>
                客户名称：<b class="text-username"><?php echo ($cname); ?></b>
            </div><?php endif; ?>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Order/list');?>" method="GET">
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
            <div class="condition-panel-item">
                <span class="lb">订单开始日期</span>
                <input type="text" name="order_begin_at" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($order_begin_at); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">下次付款日期</span>
                <input type="text" name="order_end_at" class="form-control" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'});" value="<?php echo ($order_end_at); ?>">
            </div>
            <div class="condition-panel-item">
                <span class="lb">订单状态</span>
                <select class="form-control" name="status">
                    <option value="">--请选择--</option>
                    <option <?php if($status == '已生效'): ?>selected<?php endif; ?>>已生效</option>
                    <option <?php if($status == '待审核'): ?>selected<?php endif; ?>>待审核</option>
                    <option <?php if($status == '未生效'): ?>selected<?php endif; ?>>未生效</option>
                    <option <?php if($status == '已注销'): ?>selected<?php endif; ?>>已注销</option>
                    <option <?php if($status == '未通过'): ?>selected<?php endif; ?>>未通过</option>
                </select>
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
                <span class="lb">产品类型</span>
                <select class="form-control" name="prodcat">
                    <option value="">--请选择--</option>
                    <?php if(is_array($pdtkindlist)): $i = 0; $__LIST__ = $pdtkindlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option <?php if($vo["name"] == $prodcat): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="condition-panel-item">
                <span class="lb">所在机房</span>
                <select class="form-control" name="preroom">
                    <option value="">--请选择--</option>
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option <?php if($vo == $preroom): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
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
            <a href="javascript:;" class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</a>
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px"></div>
            <!-- <button class="btn btn-primary fl new"><i class="fa fa-pencil-square-o"></i> 客户立案</button> -->
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th class="sort" data-val="nid">ID</th>
                    <th class="sort" data-val="id">订单编号</th>
                    <th class="sort" data-val="cname">客户名称</th>
                    <th>IP地址</th><th>订单备注</th>
                    <th class="sort" data-val="status">订单状态</th>
                    <th>产品类型</th>
                    <th class="sort" data-val="money">订单金额</th>
                    <th>付款周期</th><th>财务状态</th><th>销售人员</th>
                    <th class="sort" data-val="order_end_at">下次付款日期</th>
                    <th>到期状态</th><th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($orderlst)): $i = 0; $__LIST__ = $orderlst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["nid"]); ?></td>
                        <td><a href="javascript:;" class="view"><?php echo ($vo["id"]); ?></a><?php if($vo["isnew"] == '1'): ?><img src="/Public/assets/images/new.gif"><?php endif; ?></td>
                        <td><a href="javascript:;" class="username js-pop js-drill" data-cid="<?php echo ($vo["cid"]); ?>"><?php echo ($vo["cname"]); ?></a></td>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td><?php echo (substr($vo["ipaddr"],0,30)); ?></td>
                                    <td>
                                        <?php if(!empty($vo['ipaddr'])&&strlen($vo['ipaddr'])>30) :?>
                                        ...<span class="glyphicon glyphicon-eye-open" style="padding-left: 1em;float: right;" title="<?php echo ($vo["ipaddr"]); ?>"></span>
                                        <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td><?=mb_substr($vo['remark'],0,28,'utf-8')?></td>
                                    <td>
                                    <?php if($vo['remark']&&$vo['remark']!=''&&mb_strlen($vo['remark'],'utf-8')>28) :?>
                                        <span class="glyphicon glyphicon-eye-open" style="padding-left: 1em;float: right;" title="<?php echo ($vo["remark"]); ?>"></span>
                                    <?php endif;?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <?php switch($vo["status"]): case "已注销": ?><label class="label label-danger ost"><?php echo ($vo["status"]); ?></label><?php break;?>
                                <?php case "待审核": ?><label class="label label-warning ost"><?php echo ($vo["status"]); ?></label><?php break;?>
                                <?php case "未生效": ?><label class="label label-default ost"><?php echo ($vo["status"]); ?></label><?php break;?>
                                <?php case "未通过": ?><label class="label label-info ost"><?php echo ($vo["status"]); ?></label><?php break;?>
                                <?php case "已生效": ?><label class="label label-primary ost"><?php echo ($vo["status"]); ?></label><?php break;?>
                                <?php default: ?><label class="label label-success ost"><?php echo ($vo["status"]); ?></label><?php endswitch;?>
                        </td>
                        <td><?php echo ($vo["prodcat"]); ?></td>
                        <td><?php echo (intval($vo["money"])); ?></td>
                        <td><?php echo ($vo["paycycle"]); ?></td>
                        <td>
                            <?php switch($vo["fstate"]): case "款到确认": ?><label class="label label-info ost"><?php echo ($vo["fstate"]); ?></label><?php break;?>
                                <?php case "已付款": ?><label class="label label-warning ost"><?php echo ($vo["fstate"]); ?></label><?php break;?>
                                <?php case "已确认": break;?>
                                <?php default: ?><label class="label label-default ost"><?php echo ($vo["fstate"]); ?></label><?php endswitch;?>
                        </td>
                        <!-- <td>{{val.mstate}}</td> -->
                        <td><?php echo ($vo["salesman"]); ?></td>
                        <td><?php echo ($vo["order_end_at"]); ?></td>
                        <td>
                            <?=strtotime($vo['order_end_at'])<time()?"<font style='color:#FF0000;font-size:20px;'>●</font>&nbsp;已到期":(strtotime($vo['order_end_at'])>strtotime('+7 day')?"<font style='color:#008000;font-size:20px;'>●</font>&nbsp;未到期":"<font style='color:#808000;font-size:20px;'>●</font>&nbsp;即将到期")?>
                        </td>
                        <td class="text-navy td-action">
                            <div class="act-more">
                                <div style="position: relative;text-align: right;">
                                <div class="operate-btns" style="position: absolute;top:0px;right: 38px;text-align:right;display: none;">
                                <?php if($vo["status"] == '已生效'): if($perm['订单管理']['订单管理']['新增财务收入']): ?><button class="btn btn-sm btn-success js-cwsr-item" type="button"><i class="fa fa-plus"></i> 新增财务收入</button><?php endif; ?>
                                    <?php if($perm['订单管理']['订单管理']['新上架']): ?><button class="btn btn-sm btn-success js-sj-item" type="button"><i class="fa fa-plus"></i> 新上架</button><?php endif; ?>
                                    <?php if($perm['订单管理']['订单管理']['修改']): ?><button class="btn btn-sm btn-warning edit" type="button"><i class="fa fa-edit"></i></button><?php endif; ?>
                                    <?php if($perm['订单管理']['订单管理']['删除']): if($vo["ipaddr"] == ''): ?><button class="btn btn-sm btn-danger remove" type="button"><i class="fa fa-trash"></i></button><?php endif; endif; ?>
                                <?php elseif($vo["status"] != '已生效'): ?>
                                    <?php if($perm['订单管理']['订单管理']['恢复生效']): ?><button class="btn btn-sm btn-warning js-hfsx-item" type="button"><i class="fa fa-reply"></i> 恢复生效</button><?php endif; endif; ?>
                                </div>
                                    <?php if($perm['订单管理']['订单管理']['查看']): ?><button class="btn btn-sm btn-info view" type="button"><i class="fa fa-eye"></i></button><?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="14">
                            <span class="label label-danger">订单总额:</span><?php echo ($countarr["zj"]); ?>&nbsp;
                            <span class="label label-success">已生效:</span><?php echo ($countarr["ysx"]); ?>&nbsp;
                            <span class="label label-warning">待审核:</span><?php echo ($countarr["dsh"]); ?>&nbsp;
                            <span class="label label-default">未生效:</span><?php echo ($countarr["wsx"]); ?>&nbsp;
                            <span class="label label-default">已注销:</span><?php echo ($countarr["yzx"]); ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</body>
</html>