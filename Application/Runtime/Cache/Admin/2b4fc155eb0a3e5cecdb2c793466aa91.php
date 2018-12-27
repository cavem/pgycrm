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
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;cursor:pointer;}
.nav-tabs>li>a{font-size:14px;cursor:pointer;}
.bgp{padding: 1px 11px}
.cbgp{padding: 1px 18px}
.bg-primary{background-color: #5CB85C;color: #FFF}
.bg-warning{background-color: #EC971F;color: #FFF}
.bg-danger{background-color: #FF0000;color: #FFF}
#orderpool th,td{white-space:nowrap;font-size: 14px;vertical-align: middle;}
.widget-title, .modal-header, .table th, div.dataTables_wrapper .ui-widget-header{background: #eee !important;}
</style>

<div id="content" class="wow fadeIn"  style="overflow: auto;height: 100%;">
    <div id="content-header" class="site-doc-icon site-doc-anim">
        <input type="hidden" id="username" value="<?php echo ($username); ?>">
        <input type="hidden" id="dept" value="<?php echo ($dept); ?>">
        <span class="header-title"><i class="fa fa-file-text-o"></i> 我的工单&nbsp;&nbsp;<a href="javascript:location.reload()" style="font-size: 12px" class="btn btn-sm btn-success btn-primary">刷新页面</a></span>
        <?php if($perm['工单系统']['我的工单']['新工单']): ?><button class="btn btn-info ml15 fr add_order"><i class="fa fa-plus"></i> 新工单</button><?php endif; ?>
        <?php if($perm['工单系统']['我的工单']['领工单']): ?><button class="btn btn-primary ml15 fr js_getting"><i class="fa fa-hand-paper-o"></i> 领工单&nbsp;&nbsp;<span class="order_desc layui-badge">0</span></button><?php endif; ?>
        <div class="mysearchbox fr">
            <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
            <input type="search" id="searchbox" name="key" class="form-control" placeholder="请输入ip地址进行查询">
        </div>
    </div>
    <div class="container-fluid">
        <ul id="myTab" class="nav nav-tabs" style="margin-top: 10px;">
            <?php if($perm['工单系统']['我的工单']['工单池']): ?><li><a onclick="ordertab('待处理')" data-toggle="tab" data_name="待处理_0">工单池<button class="btn btn-sm btn-link pnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <li><a onclick="ordertab('处理中')" data-toggle="tab" data_name="处理中_1">处理中<button class="btn btn-sm btn-link snum" type="button" style="margin-left: .5em">0</button></a></li>
            <?php if($perm['工单系统']['我的工单']['待确认']): ?><li><a onclick="ordertab('待确认')" data-toggle="tab" data_name="待确认_2">待确认<button class="btn btn-sm btn-link cnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待验证']): ?><li><a onclick="ordertab('已解决')" data-toggle="tab" data_name="已解决_3">待验证<button class="btn btn-sm btn-link rnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['带宽确认']): ?><li><a onclick="ordertab('已验证')" data-toggle="tab" data_name="已验证_4">带宽确认<button class="btn btn-sm btn-link vnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['财务确认']): ?><li><a onclick="ordertab('待财务确认')" data-toggle="tab" data_name="待财务确认_5">财务确认<button class="btn btn-sm btn-link fnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <!-- <?php if($perm['工单系统']['我的工单']['待审核']): ?><li><a onclick="ordertab('待审核')" data-toggle="tab" data_name="待审核_6">待审核<button class="btn btn-sm btn-link anum" type="button" style="margin-left: .5em"></button></a></li><?php endif; ?> -->
            <?php if($perm['工单系统']['我的工单']['上架位置确认']): ?><li><a onclick="ordertab('上架位置确认')" data-toggle="tab" data_name="上架位置确认_7">上架位置确认<button class="btn btn-sm btn-link nnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['库管确认']): ?><li><a onclick="ordertab('库管确认')" data-toggle="tab" data_name="库管确认_8">库管确认<button class="btn btn-sm btn-link hnum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['未解决']): ?><li><a onclick="ordertab('未解决')" data-toggle="tab" data_name="未解决_9">未解决<button class="btn btn-sm btn-link unum" type="button" style="margin-left: .5em">0</button></a></li><?php endif; ?>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div id="orderpool" class="tab-pane fade in active">
                <table class="table table-hover">
                    <!-- <thead id="ts">
                      <tr>
                        <th>ID</th><th>客户名称</th><th>服务器类型</th><th>服务器状态</th><th>IP地址</th><th>IP数量</th><th>所在机房</th><th>所在机柜</th><th>交换机端口</th><th>服务器外形</th><th>自动化</th><th>配置</th><th>带宽限制</th><th>操作</th>
                      </tr>
                    </thead>
                    <tbody id="tb">
                      <?php if(is_array($servlist)): $i = 0; $__LIST__ = $servlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><a href="javascript:;" class="sid view"><?php echo ($vo["id"]); ?></a></td>
                            <td><a href="javascript:;" class="username"><?php echo ($vo["custname"]); ?></a></td>
                            <td><?php echo ($vo["productkind"]); ?></td>
                            <td>
                                <?php switch($vo["servstate"]): case "在线运行": ?><span class="label label-success">在线运行</span><?php break;?>
                                    <?php case "闲置空机": ?><span class="label label-primary">闲置空机</span><?php break;?>
                                    <?php case "终止合同": ?><span class="label label-danger">终止合同</span><?php break;?>
                                    <?php case "期满移出": ?><span class="label label-warning">期满移出</span><?php break;?>
                                    <?php case "暂出维护": ?><span class="label label-info">暂出维护</span><?php break;?>
                                    <?php case "下架": ?><span class="label label-danger">下架</span><?php break; endswitch;?>
                            </td>
                            <td>
                                <table style="width: 100%;">
                                    <tr>
                                        <td><?php echo (substr($vo["serv_ip"],0,45)); ?></td>
                                        <td>
                                            <?php if(!empty($vo['serv_ip'])&&strlen($vo['serv_ip'])>45) :?>
                                            <span class="glyphicon glyphicon-eye-open" style="padding-left: 1em" title="<?php echo ($vo["serv_ip"]); ?>"></span>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td><?php echo ($vo["_ipnum"]); ?></td>
                            <td><?php echo ($vo["idcname"]); ?></td>
                            <td><?php echo ($vo["shelfcode"]); ?></td>
                            <td>
                                <?php if($vo["switchport"] != 'null'): echo ($vo["switchport"]); endif; ?>
                            </td>
                            <td><?php echo ($vo["deviceshape"]); ?></td>
                            <td>
                                <?php if($vo["hwconfig"] != 'null'): ?><span data-toggle="tooltip" title="<?php echo ($vo["hwconfig"]); ?>" style="width: 150px;height: 20px;overflow: hidden;display: block;"><?php echo ($vo["hwconfig"]); ?></span><?php endif; ?>
                            </td>
                            <td><?php echo ($vo["bandwidth"]); ?></td>
                            <td style="position: relative;text-align: right;left:20px;">
                                <?php if($vo["servstate"] == '在线运行'): ?><div class="operate-btns" style="position: absolute;top:3px;right: 1px;width:210px;text-align:right;display: none;">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="handleitem(this)"><i class="fa fa-question" style="font-size: 14px;"></i> 问题处理</button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="loweritem(this)"><i class="fa fa-arrow-down"></i> 下架</button>
                                    <button class="btn btn-sm btn-primary" type="button" onclick="attornitem(this)"><i class="fa fa-arrow-right"></i> 服务器转让</button>
                                </div><?php endif; ?>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody> -->
                </table>
            </div>
            <!--工单池tab-->
            <div id="pool" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
                <?php if($perm['工单系统']['我的工单']['工单池_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
                <?php if($perm['工单系统']['我的工单']['工单池_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
                <?php if($perm['工单系统']['我的工单']['工单池_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>
            </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--处理中tab-->
            <div id="processing" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
                <button class="btn btn-sm btn-success btn-hf" onclick="reply(this)" type="button" title="回复"><i class="fa fa-send"></i> 回复</button>
                <button class="btn btn-sm btn-success btn-sj" onclick="upshelf(this)" type="button" title="上架完成"><i class="fa fa-check"></i> 上架完成</button>
            </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--待确认版块-->
            <div id="confirmed" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
                <?php if($perm['工单系统']['我的工单']['待确认_确认']): ?><button class="btn btn-sm btn-warning" onclick="respond(this)" type="button" title="确认" step="待确认"><i class="fa fa-check"></i></button><?php endif; ?>
                <?php if($perm['工单系统']['我的工单']['待确认_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
                <?php if($perm['工单系统']['我的工单']['待确认_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
                <?php if($perm['工单系统']['我的工单']['待确认_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>
            </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--待验证版块-->
            <div id="verified" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['待验证_验证']): ?><button class="btn btn-sm btn-warning" onclick="validate(this)" type="button" title="确认" step="待确认"><i class="fa fa-check"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待验证_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待验证_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待验证_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--带宽确认版块-->
            <div id="bwconfirm" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['带宽确认_确认']): ?><button class="btn btn-sm btn-warning" onclick="bwres(this)" type="button" title="确认" step="确认带宽"><i class="fa fa-send"></i>确认带宽</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['带宽确认_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['带宽确认_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['带宽确认_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--财务确认版块-->
            <div id="fnconfirm" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['财务确认_确认']): ?><button class="btn btn-sm btn-warning" onclick="fnres(this)" type="button" title="确认" step="确认财务"><i class="fa fa-check"></i>确认财务</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['财务确认_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['财务确认_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['财务确认_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--待审核版块-->
            <!-- <div id="audited" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['待审核_确认']): ?><button class="btn btn-sm btn-warning" onclick="examine(this)" type="button" title="确认" step="确认审核"><i class="fa fa-check"></i>确认审核</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待审核_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['待审核_修改']): endif; ?>
            <button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button>
            </if>
            <?php if($perm['工单系统']['我的工单']['待审核_删除']): endif; ?>
            <button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button>
            </if>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div> -->
            <!--上架位置确认版块-->
            <div id="shelfposition" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['上架位置确认_确认']): ?><button class="btn btn-sm btn-warning" onclick="grounding(this)" type="button" title="确认" step="确认位置"><i class="fa fa-check"></i>确认位置</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['上架位置确认_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['上架位置确认_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['上架位置确认_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--库管确认版块-->
            <div id="whconfirm" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['库管确认_确认']): ?><button class="btn btn-sm btn-warning" onclick="storehouse(this)" type="button" title="确认" step="确认"><i class="fa fa-check"></i>确认</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['库管确认_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['库管确认_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['库管确认_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
            <!--未解决版块-->
            <div id="unsolved" style="display:none;">
            <div id="confirm" style="display:none;position: absolute;left:72px;">
            <?php if($perm['工单系统']['我的工单']['未解决_放回处理']): ?><button class="btn btn-sm btn-warning" onclick="putback(this)" type="button" title="放回处理" step="放回处理"><i class="fa fa-check"></i>放回处理</button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['未解决_指派']): ?><button class="btn btn-sm btn-success" onclick="assignitem(this)" type="button" title="指派"><i class="fa fa-fighter-jet"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['未解决_修改']): ?><button class="btn btn-sm btn-primary" onclick="edititem(this)" type="button" title="修改"><i class="fa fa-edit"></i></button><?php endif; ?>
            <?php if($perm['工单系统']['我的工单']['未解决_删除']): ?><button class="btn btn-sm btn-danger" onclick="delitem(this)" type="button" title="删除"><i class="fa fa-trash"></i></button><?php endif; ?>    
        </div>
            <button class="btn btn-sm btn-info" onclick="viewitem(this)" type="button"><i class="fa fa-eye"></i></button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    var sk;
    $(function(){
        window.CHAT = {
            socket:null,
            init:function(){
                sk=this;
                //连接websocket后端服务器
                sk.socket = io.connect('ws://222.187.221.236:3000');
            }
        };
        CHAT.init();

        $('.table-hover tbody tr').hover(function(){
            $(this).find('.operate-btns').show();
        },function(){
            $(this).find('.operate-btns').hide();
        })

        //技术接工单
        $('.js_getting').click(function(){
            var username=$('#username').val();
            layer.load();
            $.ajax({
                 type: "POST",
                 url: "<?php echo U('getting');?>",
                 data:"",
                 success: function(msg){
                    //alert(msg);return;
                     if(msg==0)
                     {
                        layer.closeAll();
                        layer.msg("接单成功", {icon: 1});
                        //music走起
                        sk.socket.emit('getorder', username);
                        $.ajax({
                            type: 'GET',
                            url : "<?php echo U('processing');?>",
                            data: "",
                            success: function (res) {
                               $('#tb').remove();
                               $('#ts').remove();
                               $("#myTab li").eq(0).addClass("active");
                               $("#myTab li").eq(0).siblings().removeClass("active");
                               $('.table').append(res);
                            }   
                        });
                     }
                     else if(msg==1)
                     {
                        layer.closeAll(); 
                        layer.msg('无可领取工单', {icon: 4});
                     }
                     $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                    return;
                 }
            })
        })

        $('.add_order').click(function(){
            var confirm=function(index,layero){
                //var a=this;
                //获取iframe的body元素
                var body = layer.getChildFrame('body',index);
                var title = body.find("[name='title']").val();
                if (title==''||title==undefined) 
                {
                    layer.msg('请输入标题', {icon: 0});return false;
                }
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
                layer.load();
                $.post('orderadd',formdata,function(data,status){
                    if(status="success"){
                        window.location.reload();
                    }
                })
            }
            myalert('新工单','960px','630px',"<?php echo U('addorder');?>",confirm);
        })
    })
    function ordertab(str)
    {
        $.ajax({
            type: "POST",
              url: "/Workorder/orderinfo",
              data:"state="+str,
              success: function(msg){
                var a=eval('('+msg+')');
                $('#tb').remove();
                $('#ts').remove();
                var option="<thead id='ts'><tr><th style='width:60px;'>操作</th><th>ID</th><th>标题</th><th>客户名称</th><th>IP地址</th><th>优先级</th><th>工单类型</th><th>处理方法</th><th>工单状态</th><th>所在机房</th><th>受理部门</th><th>受理工程师</th><th>受理时间</th><th>是否超时</th><th>提交人</th><th>提交时间</th></tr></thead><tbody id='tb'>";
                $.each(a,function(index,array){
                    var ipaddr=array['ipaddr']==""||array['ipaddr']==null?'':GetLength(array['ipaddr'])>45?cutstr(array['ipaddr'], 45):array['ipaddr'];
                    var other=array['ipaddr']==""||array['ipaddr']==null?"display:none":array['ipaddr']!=""&&GetLength(array['ipaddr'])>45?"":"display:none";
                    var overtime=array['overtime']=="超时"?"<label class='bg-danger cbgp'>"+array['overtime']+"</label>":"<label class='bg-primary bgp'>"+array['overtime']+"</label>";
                    var cname=array['cname']==""||array['cname']==null?'':array['cname'];
                    var receiver=array['receiver']==""||array['receiver']==null?'':array['receiver'];
                    var priority="";
                    switch(array['priority'])
                    {
                        case "正常":
                            priority="<label class='bg-primary bgp'>"+array['priority']+"</label>";break;
                        case "优先":
                            priority="<label class='bg-warning bgp'>"+array['priority']+"</label>";break;
                        case "紧急":
                            priority="<label class='bg-danger bgp'>"+array['priority']+"</label>";break;
                        default:
                            priority="<label class='bg-muted bgp'>"+array['priority']+"</label>";break;
                    }
                    var btn="";
                    switch(str)
                    {
                        case '待处理':
                            btn=$('#pool').html();break;
                        case '处理中':
                            if(array['type']==1){
                                $('#processing').find('.btn-hf').css("display","none");
                                $('#processing').find('.btn-sj').css("display","block");
                            }else{
                                $('#processing').find('.btn-sj').css("display","none");
                                $('#processing').find('.btn-hf').css("display","block");
                            }
                            btn=$('#processing').html();break;
                        case '待确认':
                            btn=$('#confirmed').html();break;
                        case '已解决':
                            btn=$('#verified').html();break;
                        case '已验证':
                            btn=$('#bwconfirm').html();break;
                        case '待财务确认':
                            btn=$('#fnconfirm').html();break;
                        // case '待审核':
                        //     btn=$('#audited').html();break;
                        case '上架位置确认':
                            btn=$('#shelfposition').html();break;
                        case '库管确认':
                            btn=$('#whconfirm').html();break;
                        case '未解决':
                            btn=$('#unsolved').html();break;
                    }
                    var type="";
                    switch(array['type'])
                    {
                        case '0':
                            type="问题处理[无服]";break;
                        case '1':
                            type="上架单";break;
                        case '2':
                            type="下架单";break;
                        case '3':
                            type="问题处理";break;
                        case '4':
                            type="服务器转让";break;
                        default:
                            type="未知类型";break;
                    }
                    option+="<tr onmouseover='mr(this)' onmouseout='mt(this)'><td>"+btn+"</td><td class='nid'>"+array['nid']+"</td>"+
                    "<td>"+array['title']+"</td><td>"+cname+"</td><td><table style='width: 100%;'><tr>"+
                    "<td>"+ipaddr+"</td><td><span class='glyphicon glyphicon-eye-open' style='padding-left: 1em;"+other+"' title='"+array['ipaddr']+"'></span></td></tr></table></td>"+
                    "<td>"+priority+"</td><td>"+type+"</td>"+
                    "<td>"+array['action']+"</td><td>"+array['state']+"</td><td>"+array['room']+"</td><td>"+array['recvdept']+"</td><td>"+receiver+"</td><td>"+array['receive_at']+"</td><td>"+overtime+"</td><td>"+array['committer']+"</td><td>"+array['commit_at']+"</td>";
                });
                option+="</tr></tbody>";
                $('.table').append(option);
            }
        });
    } 

    function edititem(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            // var title = body.find("[name='title']").val();
            // if (title==''||title==undefined) 
            // {
            //     layer.msg('请输入标题', {icon: 0});return false;
            // }
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
            layer.load();
            $.post('orderadd',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                }
            })
        }
        myalert('修改工单','960px','630px',"addorder?nid="+nid,confirm);
    }

    function respond(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    var room=eval(data);
                    //需要提示该部门该机房所有人了
                    sk.socket.emit('confirm', room);
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('确认工单','960px','630px',"confirmorder?nid="+nid,confirm);
    }

    function grounding(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('位置确认','960px','630px',"confirmorder?nid="+nid+"&type=7",confirm);
    }

    function reply(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //var dept=$("#dept").val();
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            if(body.find("input[name='pic']").length>0){
                var pic=body.find("input[name='pic']").val();
                if(pic==''||pic=='已选择，请点击上传'){
                    layer.msg('请上传截图！',{icon:0});
                    return;
                }
            }
            if(body.find("input[name='newip']").length>0){
                var newip=body.find("input[name='newip']").val();
                if(newip==''){
                    layer.msg('请输入现ip！',{icon:0});
                    return;
                }else if(newip.charAt(newip.length-1)!='/'){
                    layer.msg('ip最后请以"/"结尾！',{icon:0});
                    return;
                }
            }
            if(body.find("select[name='idcname']").length>0){
                var idcname=body.find("select[name='idcname']").val();
                var shelfcode=body.find("select[name='shelfcode']").val();
                if(idcname==''){
                    layer.msg('机房不能为空！',{icon:0});
                    return;
                }else if(shelfcode==''){
                    layer.msg('机柜不能为空！',{icon:0});
                    return;
                }
            }
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    if(data!=0){
                        layer.msg(data,{icon:0});
                        $('.layui-layer-loading').hide();
                        $('.layui-layer-loading').prev(".layui-layer-shade").hide();
                        return;
                    }
                    sk.socket.emit('complete', "客服部");
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('回复工单','960px','630px',"confirmorder?nid="+nid+"&type=2",confirm);
    }

    function validate(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            var problemdesc = body.find("[name='problemdesc']").val();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('验证工单','960px','630px',"confirmorder?nid="+nid+"&type=3",confirm);
    }

    // function examine(t){
    //     var nid=$(t).closest('tr').find('.nid').text();
    //     var confirm=function(index,layero){
    //         //获取iframe的body元素
    //         var body = layer.getChildFrame('body',index);
    //         var formdata = body.find('.mform').serialize();
    //         layer.load();
    //         $.post('orderres',formdata,function(data,status){
    //             if(status="success"){
    //                 layer.closeAll();
    //                 var att=$('.container-fluid').find('.active a').attr("data_name");
    //                 var att=att.split("_");
    //                 $.ajax({
    //                     type: 'GET',
    //                     url : "/Workorder/original?state="+att[0],
    //                     data: "",
    //                     success: function (res) {
    //                        $('#tb').remove();
    //                        $('#ts').remove();
    //                        $("#myTab li").eq(att[1]).addClass("active");
    //                        $("#myTab li").eq(att[1]).siblings().removeClass("active");
    //                        $('.table').append(res);
    //                     }   
    //                 });
    //                 $.ajax({
    //                      type: "POST",
    //                      url: "<?php echo U('num');?>",
    //                      data:"",
    //                      success: function(msg){
    //                         var a=eval('('+msg+')');
    //                         $(".order_desc").text(a['w']);
    //                         $(".pnum").text(a['p']);
    //                         $(".snum").text(a['s']);
    //                         $(".cnum").text(a['c']);
    //                         $(".rnum").text(a['r']);
    //                         $(".vnum").text(a['v']);
    //                         $(".fnum").text(a['f']);
    //                         $(".anum").text(a['a']);
    //                         $(".nnum").text(a['n']);
    //                         $(".hnum").text(a['h']);
    //                         $(".unum").text(a['u']);
    //                      }
    //                 })
    //             }
    //         })
    //     }
    //     myalert('审核工单','960px','630px',"confirmorder?nid="+nid+"&type=4",confirm);
    // }

    function bwres(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                            $('#tb').remove();
                            $('#ts').remove();
                            $("#myTab li").eq(att[1]).addClass("active");
                            $("#myTab li").eq(att[1]).siblings().removeClass("active");
                            $('.table').append(res);
                        }   
                    });
                    $.ajax({
                            type: "POST",
                            url: "<?php echo U('num');?>",
                            data:"",
                            success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                            }
                    })
                }
            })
        }
        myalert('带宽确认','960px','630px',"confirmorder?nid="+nid+"&type=5",confirm);
    }

    function fnres(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('财务确认','960px','630px',"confirmorder?nid="+nid+"&type=6",confirm);
    }

    function storehouse(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('库管确认','960px','630px',"confirmorder?nid="+nid+"&type=8",confirm);
    }

    function putback(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            var a=this;
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    //需要提示继续处理（指派）或放入工单池（所在机房全体人员提示）
                    //sk.socket.emit('message', '111');
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('放回处理','960px','630px',"confirmorder?nid="+nid+"&type=9",confirm);
    }

    function assignitem(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    //需要提示被指派得人了
                    var receiver=eval(data);
                    sk.socket.emit('getorder', receiver);
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });

                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('指派工单','960px','630px',"confirmorder?nid="+nid+"&type=1",confirm);
    }

    function viewitem(t){
        var nid=$(t).closest('tr').find('.nid').text();
        myalert('查看工单','760px','630px',"viewitem?nid="+nid);
    }

    function delitem(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            layer.load();
            $.post('orderres',formdata,function(data,status){
                if(status="success"){
                    layer.closeAll();
                    var att=$('.container-fluid').find('.active a').attr("data_name");
                    var att=att.split("_");
                    $.ajax({
                        type: 'GET',
                        url : "/Workorder/original?state="+att[0],
                        data: "",
                        success: function (res) {
                           $('#tb').remove();
                           $('#ts').remove();
                           $("#myTab li").eq(att[1]).addClass("active");
                           $("#myTab li").eq(att[1]).siblings().removeClass("active");
                           $('.table').append(res);
                        }   
                    });
                    $.ajax({
                         type: "POST",
                         url: "<?php echo U('num');?>",
                         data:"",
                         success: function(msg){
                            var a=eval('('+msg+')');
                            $(".order_desc").text(a['w']);
                            $(".pnum").text(a['p']);
                            $(".snum").text(a['s']);
                            $(".cnum").text(a['c']);
                            $(".rnum").text(a['r']);
                            $(".vnum").text(a['v']);
                            $(".fnum").text(a['f']);
                            $(".nnum").text(a['n']);
                            $(".hnum").text(a['h']);
                            $(".unum").text(a['u']);
                         }
                    })
                }
            })
        }
        myalert('废弃工单','960px','630px',"confirmorder?nid="+nid+"&type=10",confirm);
    }
    //上架
    function upshelf(t){
        var nid=$(t).closest('tr').find('.nid').text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            //var problemdesc = body.find('.remark').val();
            //alert(problemdesc);return;
            //必填项不能为空
            var isneed=0;
            body.find('.need').each(function(){
                if($(this).closest('.form-line').find("select").val()==''){
                    $(this).closest('.form-line').find("select").addClass('bdred');
                    layer.msg("必填项不能为空");
                    isneed+=1;
                    return false;
                }else if($(this).closest('.form-line').find("input").val()==''){
                    $(this).closest('.form-line').find("input").addClass('bdred');
                    layer.msg("必填项不能为空");
                    isneed+=1;
                    return false;
                }else if($(this).closest('.form-line').find("textarea").val()==''){
                    $(this).closest('.form-line').find("textarea").addClass('bdred');
                    layer.msg("必填项不能为空");
                    isneed+=1;
                    return false;
                }
            })
            if(isneed==0){
                layer.load();
                $.post('upconfirm',formdata+"&nid="+nid,function(data,status){
                    if(data==0){
                        layer.msg("操作成功",{icon:1});
                        layer.closeAll();
                        var att=$('.container-fluid').find('.active a').attr("data_name");
                        var att=att.split("_");
                        $.ajax({
                            type: 'GET',
                            url : "/Workorder/original?state="+att[0],
                            data: "",
                            success: function (res) {
                            $('#tb').remove();
                            $('#ts').remove();
                            $("#myTab li").eq(att[1]).addClass("active");
                            $("#myTab li").eq(att[1]).siblings().removeClass("active");
                            $('.table').append(res);
                            }   
                        });
                        $.ajax({
                            type: "POST",
                            url: "<?php echo U('num');?>",
                            data:"",
                            success: function(msg){
                                var a=eval('('+msg+')');
                                $(".order_desc").text(a['w']);
                                $(".pnum").text(a['p']);
                                $(".snum").text(a['s']);
                                $(".cnum").text(a['c']);
                                $(".rnum").text(a['r']);
                                $(".vnum").text(a['v']);
                                $(".fnum").text(a['f']);
                                $(".nnum").text(a['n']);
                                $(".hnum").text(a['h']);
                                $(".unum").text(a['u']);
                            }
                        })
                    }else{
                        layer.msg("操作失败",{icon:2});
                    }
                })
            }
        }
        myalert('服务器上架','960px','630px',"upshelf?nid="+nid+"&type=10",confirm);
    }
    
    function GetLength (str) {
        var realLength = 0, len = str.length, charCode = -1;
        for (var i = 0; i < len; i++) {
            charCode = str.charCodeAt(i);
            if (charCode >= 0 && charCode <= 128) realLength += 1;
            else realLength += 2;
        }
        return realLength;
    }
    function cutstr(str, len) {
        var str_length = 0;
        var str_len = 0;
        str_cut = new String();
        str_len = str.length;
        for (var i = 0; i < str_len; i++) {
            a = str.charAt(i);
            str_length++;
            if (escape(a).length > 4) {
                str_length++;
            }
            str_cut = str_cut.concat(a);
            if (str_length >= len) {
                str_cut = str_cut.concat("...");
                return str_cut;
            }
        } 
        if (str_length < len) {
            return str;
        }
    }
    function mr(obj)
    {
        var obj=$(obj);
        obj.find("td #confirm").css('display','block');
    }
    function mt(obj)
    {
        var obj=$(obj);
        obj.find("td #confirm").css('display','none');
    }

    window.onload = function(){
        $.ajax({
             type: "POST",
             url: "<?php echo U('num');?>",
             data:"",
             success: function(msg){
                var a=eval('('+msg+')');
                $(".order_desc").text(a['w']);
                $(".pnum").text(a['p']);
                $(".snum").text(a['s']);
                $(".cnum").text(a['c']);
                $(".rnum").text(a['r']);
                $(".vnum").text(a['v']);
                $(".fnum").text(a['f']);
                $(".nnum").text(a['n']);
                $(".hnum").text(a['h']);
                $(".unum").text(a['u']);
             }
        })

        setInterval(od,5000);
        function od(){
            $.ajax({
                 type: "POST",
                 url: "<?php echo U('setiv');?>",
                 data:"",
                 success: function(msg){
                    var a=eval('('+msg+')');
                    $(".order_desc").text(a);
                 }
            })
        }
    }
</script>
<script>
$(function(){
    $("#searchbox").bind('keyup', function(event) {
        if (event.keyCode == "13") {
            $.post("searchip",{"ip":$(this).val()},function(msg,status){
                var a=eval('('+msg+')');
                $('#tb').remove();
                $('#ts').remove();
                var option="<thead id='ts'><tr><th style='width:60px;'>操作</th><th>ID</th><th>标题</th><th>客户名称</th><th>IP地址</th><th>优先级</th><th>工单类型</th><th>处理方法</th><th>工单状态</th><th>所在机房</th><th>受理部门</th><th>受理工程师</th><th>受理时间</th><th>是否超时</th><th>提交人</th><th>提交时间</th></tr></thead><tbody id='tb'>";
                $.each(a,function(index,array){
                    var str=array['state'];
                    $('#myTab').find('.active').removeClass('active');
                    $('#myTab li a').each(function(){
                        var s=$(this).attr('data_name');
                        if(s.indexOf(str)!=-1){
                            $(this).parent('li').addClass('active');
                        }
                    })
                    var ipaddr=array['ipaddr']==""||array['ipaddr']==null?'':GetLength(array['ipaddr'])>45?cutstr(array['ipaddr'], 45):array['ipaddr'];
                    var other=array['ipaddr']==""||array['ipaddr']==null?"display:none":array['ipaddr']!=""&&GetLength(array['ipaddr'])>45?"":"display:none";
                    var overtime=array['overtime']=="超时"?"<label class='bg-danger cbgp'>"+array['overtime']+"</label>":"<label class='bg-primary bgp'>"+array['overtime']+"</label>";
                    var cname=array['cname']==""||array['cname']==null?'':array['cname'];
                    var receiver=array['receiver']==""||array['receiver']==null?'':array['receiver'];
                    var priority="";
                    switch(array['priority'])
                    {
                        case "正常":
                            priority="<label class='bg-primary bgp'>"+array['priority']+"</label>";break;
                        case "优先":
                            priority="<label class='bg-warning bgp'>"+array['priority']+"</label>";break;
                        case "紧急":
                            priority="<label class='bg-danger bgp'>"+array['priority']+"</label>";break;
                        default:
                            priority="<label class='bg-muted bgp'>"+array['priority']+"</label>";break;
                    }
                    var btn="";
                    switch(str)
                    {
                        case '待处理':
                            btn=$('#pool').html();break;
                        case '处理中':
                            if(array['type']==1){
                                $('#processing').find('.btn-hf').css("display","none");
                                $('#processing').find('.btn-sj').css("display","block");
                            }else{
                                $('#processing').find('.btn-sj').css("display","none");
                                $('#processing').find('.btn-hf').css("display","block");
                            }
                            btn=$('#processing').html();break;
                        case '待确认':
                            btn=$('#confirmed').html();break;
                        case '已解决':
                            btn=$('#verified').html();break;
                        case '已验证':
                            btn=$('#bwconfirm').html();break;
                        case '待财务确认':
                            btn=$('#fnconfirm').html();break;
                        // case '待审核':
                        //     btn=$('#audited').html();break;
                        case '上架位置确认':
                            btn=$('#shelfposition').html();break;
                        case '库管确认':
                            btn=$('#whconfirm').html();break;
                        case '未解决':
                            btn=$('#unsolved').html();break;
                    }
                    var type="";
                    switch(array['type'])
                    {
                        case '0':
                            type="问题处理[无服]";break;
                        case '1':
                            type="上架单";break;
                        case '2':
                            type="下架单";break;
                        case '3':
                            type="问题处理";break;
                        case '4':
                            type="服务器转让";break;
                        default:
                            type="未知类型";break;
                    }
                    option+="<tr onmouseover='mr(this)' onmouseout='mt(this)'><td>"+btn+"</td><td class='nid'>"+array['nid']+"</td>"+
                    "<td>"+array['title']+"</td><td>"+cname+"</td><td><table style='width: 100%;'><tr>"+
                    "<td>"+ipaddr+"</td><td><span class='glyphicon glyphicon-eye-open' style='padding-left: 1em;"+other+"' title='"+array['ipaddr']+"'></span></td></tr></table></td>"+
                    "<td>"+priority+"</td><td>"+type+"</td>"+
                    "<td>"+array['action']+"</td><td>"+array['state']+"</td><td>"+array['room']+"</td><td>"+array['recvdept']+"</td><td>"+receiver+"</td><td>"+array['receive_at']+"</td><td>"+overtime+"</td><td>"+array['committer']+"</td><td>"+array['commit_at']+"</td>";
                });
                option+="</tr></tbody>";
                $('.table').append(option);
                layer.closeAll();
            })
        }
    })
    
})
</script>