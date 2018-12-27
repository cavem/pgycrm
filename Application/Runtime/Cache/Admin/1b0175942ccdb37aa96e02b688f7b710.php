<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<!-- <link title="" href="/Application/Admin/View/Public/css/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet"> -->
<script src="/Application/Admin/View/Public/script/jquery.min.1.js" type="text/javascript"></script>
<script src="/Public/DatePicker/WdatePicker.js" type="text/javascript"></script>
<!-- <script src="/Application/Admin/View/Public/script/jquery-ui.min.js" type="text/javascript"></script> -->
<!-- <script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script> -->
<script src="/Public/layer/layer.js" type="text/javascript"></script>
</head>
<style>
    .form-control{display: inline-block;height: 30px;}
    .btn{padding: 4px 8px;font-size: 14px;}
    .form-group{margin-bottom: 0;}
    .ml20{margin-left:20px;}
    .ml10{margin-left: 10px;}
    .edit-line{margin: 4px 0;}
</style>
<body style="text-align: center;">
    <div class="proedit" style="text-align: left;padding: 10px;">
        <form name="mform" action="" method="post">
        <div class="contain">
            <input type="hidden" class="sid" value="<?php echo ($info["sid"]); ?>">
            <div class="edit-line">
                <b>配置信息：</b><font><?php echo ($info["vcpu"]); ?> CPUs, <?php echo ($info["vram"]); ?>M Ram, <?php echo ($info["vdisk"]); ?>G Disk, <?php echo ($info["vip"]); ?>, <?php echo ($info["vos"]); ?></font>
            </div>
            <div class="edit-line">
                <b>服务编号：</b><b>#<?php echo ($cloud["id"]); ?></b><b class="ml20">服务类型：</b><span>vps主机</span><b class="ml20">子服务项目ID编号：</b><font>VPS<?php echo ($cloud["cloudno"]); ?></font>
            </div>
            <div class="edit-line">
                <b>所属产品：</b>
                <font><?php echo ($cloud["cid"]); ?></font>
            </div>
            <div class="edit-line">
                <b>用户编号：</b><input type="text" name="customid" class="form-control" style="width: 70px;" value="<?php echo ($cloud["userid"]); ?>"><b class="ml20">当前状态：</b>
                <div class="form-group" style="display: inline-block;">
                    <select class="form-control" name="state" style="width: 105px;font-size: 12px;">
                        <option value="正常服务" <?=$cloud['state']=="正常服务"?'selected':''?>>正常服务</option>
                        <option value="暂停服务" <?=$cloud['state']=="暂停服务"?'selected':''?>>暂停服务</option>
                        <option value="中止服务" <?=$cloud['state']=="中止服务"?'selected':''?>>中止服务</option>
                    </select>
                </div>
                <div class="checkbox" style="display: inline-block;">
                    <label>
                        <input type="checkbox" checked="checked">同步更新子服务资料及状态
                    </label>
                </div>
            </div>
            <div class="edit-line">
                <b>首次价格：</b><input type="text" name="price" class="form-control" style="width: 70px;" value="<?php echo ($cloud["price"]); ?>"><b class="ml20">后续价格：</b><input type="text" class="form-control" style="width: 70px;" name="disprice" value="<?php echo ($cloud["disprice"]); ?>">
            </div>
            <!--  <div class="edit-line">
                <b>消 费 额 ：</b><span>0.00</span><b class="ml10">收益总计：</b><span>0.00</span><b class="ml10">服务中：</b><span>0.00</span><b class="ml10">未开始：</b><span>0.00</span><b class="ml10">已完结：</b><span>0.00</span>
            </div>
            <div class="edit-line">
                <b>支付方式：</b>
                <div class="radio" style="display: inline-block;">
                    <label>
                        <input type="radio" name="paytype" value="0" checked>周期付款
                    </label>
                </div>
                <div class="radio ml10" style="display: inline-block;">
                    <label>
                        <input type="radio" name="paytype" value="1">一次性付款
                    </label>
                </div>
                <b class="ml20">免费试用：</b><input type="text" class="form-control" style="width: 50px;">小时
            </div>
            <div class="edit-line">
                <b>付款周期：</b>
                <input type="text" class="form-control" style="width: 70px;">
                <select class="form-control" style="width: 70px;font-size:12px;position: relative;top: 1px;">
                    <option>个月</option>
                    <option>天</option>
                    <option>小时</option>
                </select>
                <div class="checkbox" style="display: inline-block;">
                    <label>
                        <input type="checkbox">自动续费
                    </label>
                </div>
            </div> -->
            <div class="edit-line">
                <b>创建时间：</b><input type="text" name="settime" class="form-control" style="width: 160px;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo (date("Y-m-d H:i:s",$cloud["buytime"])); ?>">
                <b>服务起始：</b><input type="text" name="starttime" class="form-control" style="width: 160px;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo (date("Y-m-d H:i:s",$cloud["buytime"])); ?>">
            </div>
            <div class="edit-line">
                <b>服务结束：</b><input type="text" name="endtime" class="form-control" style="width: 160px;" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});" value="<?php echo (date("Y-m-d H:i:s",$cloud["duetime"])); ?>">
                <b>管理标注：</b><input type="text" name="remarks" class="form-control" style="width: 160px;" value="<?php echo ($cloud["remarks"]); ?>">
            </div>
            <!-- <div class="edit-line">
                <b>管理标注：</b><input type="text" class="form-control" style="width: 150px;">
                <b class="ml20">用户标注：</b><input type="text" class="form-control" style="width: 150px;">
            </div> -->
        </div>
        
        <input type="hidden" name="cloudid" value="<?php echo ($cloud["id"]); ?>">
        <input type="hidden" name="oldstate" value="<?php echo ($cloud["state"]); ?>">
        <input type="hidden" name="cloudno" value="<?php echo ($cloud["cloudno"]); ?>">
        </form>
        <div style="border-top: 1px dotted #60aff6;text-align: right;width:100%;padding:10px 0;position: absolute;bottom: 0;right: 0;">
            <button class="btn btn-primary save" style="background-color: #2f8ad8;">保存</button>
            <button class="btn btn-primary subeditopen" style="background-color: #2f8ad8;">管理子服务配置</button>
            <button class="btn btn-primary delete" style="background-color: #2f8ad8;">删除</button>
            <button class="btn btn-default upclose">关闭</button>&nbsp;
        </div>
        <script type="text/javascript">
            $(function(){
                //close
                $('.upclose').click(function(){
                    window.parent.layer.closeAll();
                })
                $('.save').click(function(){
                     document.mform.action="/Admin/Cloud/cloudsave";
                     document.mform.target="";
                     document.mform.submit();
                })
                var url=window.location.href;
                var param=url.split("?")[1];
                var vid=param.split("=")[1];
                var sid=$('.sid').val();
                $('.subeditopen').click(function(){
                    //window.parent.layer.closeAll();
                    window.parent.layer.open({
                        type: 2,
                        title: "管理子服务配置",
                        shade: 0.6,
                        shadeClose: true,
                        maxmin: true, 
                        area: ["650px", "500px"],
                        content: "/Admin/Cloud/subedit?vpsid="+vid+"&serverid="+sid,
                    });
                })
                $('.delete').click(function(){
                    layer.confirm("你确定要删除该云主机吗？", {
                        btn: ['确定','取消']
                    }, function(){
                        layer.msg('请稍等',{icon: 16,shade: 0.01,time:20000});
                        $.post('delete',{"vpsid":vid},function(data,status){
                            if(status=="success"){
                                layer.closeAll();
                                if(data=="success"){
                                    layer.msg('删除成功，退款金额已退还账户',{icon:1});
                                    setTimeout(window.parent.location.reload(),1500);
                                }else{
                                    layer.msg('删除失败',{icon:0});
                                }
                            }else{
                                layer.closeAll();
                                layer.msg('删除失败',{icon:0});
                            }
                        });
                    }, function(){
                        layer.closeAll(); 
                    });
                })
            })
        </script>
    </div>
</body>
</html>