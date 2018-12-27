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
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;border-top: 2px solid #28b779;font-size: 14px;background: #eee;}
.nav-tabs>li>a{font-size:14px;}
body{background: #eee !important;}
.myalert-wrap{width: 100%;min-height:100%;position: relative;}
.myalert-main{width: 100%;}
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display:inline-block;width: 150px;text-align: right;font-weight: bold;}
.w50{width: 50%;text-align: left;}
.form-content{width: 700px;text-align: left;display: inline-block;}
.form-control{display: initial;}
.tab-content{padding: 10px;}
/*layui*/
.layui-tab{margin: 0;}
.layui-tab-title{background: #fff;}
.layui-tab-title .layui-this{color: #28b779;background: #eee;}
.layui-tab-title .layui-this:after{border-bottom-color:transparent;border-top-color: #28b779;}
/*bootstap*/
.panel-title{display: inline-block;}
.opt-wrap{position: relative;bottom: 4px;}
ul{margin-bottom: 0;}
input[type=checkbox], input[type=radio]{margin: 0;}
.layui-tab-content p{width: 100%;background-color: #D5D5D5;height: 30px;padding: 5px 0 0 5px;color:#000;}
.layui-tab-content table td{border:1px solid #D5D5D5;padding-left: 5px}
.bdred{border-color: red !important;}
</style>
<script>
$(function(){
    $("select[name='IDCName']").change(function(){
        var idcname=$(this).children("option:selected").val();
        var meshelfcode=$('.meshelfcode').val();
        $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
            data=JSON.parse(data);
            var shelfcon="";
            for(var i in data){
                if(data[i]['code']==meshelfcode){
                    shelfcon+='<option value="'+data[i]['code']+'" selected>'+data[i]['code']+'</option>';
                }else{
                    shelfcon+='<option value="'+data[i]['code']+'">'+data[i]['code']+'</option>';
                }
            }
            $("select[name='ShelfCode']").html(shelfcon);
        })
    })
    $('.edit-ip').click(function(){
        var serv_ip=$("input[name='Serv_IP']").val();
        var serviparr=serv_ip.split("/");
        var tempstr="";
        serviparr.forEach(function(val,index){
            tempstr+=val+'|';
        })
        serv_ip=tempstr;
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var ip_addrstr="";
            var formdata = body.find("input[name='ip_addr']").each(function(){
                ip_addrstr+=$(this).val()+"/";
            });
            $("input[name='Serv_IP']").val(ip_addrstr);
            layer.closeAll(); 
        }
        myalert('修改IP','800px','540px',"<?php echo U('Service/edit_ip');?>"+"?serv_ip="+serv_ip,confirm);
    })
    $("input").blur(function(){
        if($(this).val()!=''){
            $(this).removeClass("bdred");
        }
    })
    $("select").change(function(){
        if($(this).val()!=''){
            $(this).removeClass("bdred");
        }
    })
})
</script>
<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
<div class="myalert-main">
    <div class="layui-tab">
    <div class="layui-tab-content" style="min-height: 580px;">
    <p>工单信息</p>
    <table style="width: 100%;line-height: 30px;">
        <tr>
            <td style="width:15%">标题</td>
            <td style="width:85%" colspan="3"><?php echo ($tasks["title"]); ?></td>
        </tr>
        <tr>
            <td>问题描述</td>
            <td colspan="3"><?php echo ($tasks["problemdesc"]); ?></td>
        </tr>
        <tr>
            <td style="width:15%">工单状态</td>
            <td style="width:35%"><?php echo ($tasks["state"]); ?></td>
            <td style="width:15%">工单编号</td>
            <td style="width:35%"><?php echo ($tasks["id"]); ?></td>
        </tr>
        <tr>
            <td style="width:15%">提交人</td>
            <td style="width:35%"><?php echo ($tasks["committer"]); ?></td>
            <td style="width:15%">工单类型</td>
            <td style="width:35%"><?php echo ($tasks["type2"]); ?></td>
        </tr>
        <tr>
            <td style="width:15%">受理部门</td>
            <td style="width:35%"><?php echo ($tasks["recvdept"]); ?></td>
            <td style="width:15%">所在机房</td>
            <td style="width:35%"><?php echo ($tasks["room"]); ?></td>
        </tr>
        <tr>
            <td style="width:15%">处理方法</td>
            <td style="width:35%"><?php echo ($tasks["action"]); ?></td>
            <td style="width:15%">处理时限</td>
            <td style="width:35%"><?php echo ($tasks["timelimit"]); ?></td>
        </tr>
        <tr>
            <td style="width:15%">提交时间</td>
            <td style="width:35%"><?php echo ($tasks["commit_at"]); ?></td>
            <td style="width:15%">截止时间</td>
            <td style="width:35%"><?php echo ($tasks["expire_at"]); ?></td>
        </tr>
        <?php if(($tasks["action"] == '上架') OR ($tasks["action"] == '添加IP') OR ($tasks["action"] == '更换IP') OR ($tasks["action"] == '更换IP重装Win系统') OR ($tasks["action"] == '更换IP重装Linux系统') OR ($tasks["action"] == '新上架')): ?><tr>
            <td style="width:15%">新增IP地址</td>
            <td style="width:85%" colspan="3"><?php echo ($tasks["addip"]); ?></td>
        </tr><?php endif; ?>
    </table>
    <p style="margin-top: 10px;">备注</p>
    <table border="0" style="width: 100%;line-height: 30px">
        <tr style="border-bottom: 1px solid #D5D5D5">
            <td>备注</td><td>操作</td><td>时间</td>
        </tr>
        <?php if(is_array($talog)): foreach($talog as $key=>$info): ?><tr style="border-bottom: 1px solid #D5D5D5">
                <td style="width:50%;padding-right: 2em"><?php echo ($info["msg"]); ?></td>
                <td style="width:20%"><?php echo ($info["act"]); ?></td>
                <td style="width:30%">【<?php echo ($info["name"]); ?>】<?php echo (date("Y-m-d H:i:s",$info["tm"])); ?></td>
            </tr><?php endforeach; endif; ?>
    </table>
    <form class="mform" style="overflow: hidden;">
    <p style="margin-top: 10px;">填写服务器信息</p>
    
        <input type="hidden" name="Customer_ID" value="<?php echo ($orderlist["cid"]); ?>">
        <input type="hidden" name="Order_ID" value="<?php echo ($orderlist["nid"]); ?>">
        <input type="hidden" name="TaskNum" value="<?php echo ($tasklist["id"]); ?>">
        <input type="hidden" name="OrderNum" value="<?php echo ($tasklist["ddbh"]); ?>">
        <input type="hidden" name="CustTech" value="<?php echo ($clientlist["contact"]); ?>">
        <input type="hidden" name="CustTel" value="<?php echo ($clientlist["tel"]); ?>">
        <div class="form-line w50 fl">
            <span class="form-label">产品类型：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Productkind" readonly value="<?php echo ($orderlist["prodcat"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">产权所属：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="CustName" readonly value="<?php echo ($orderlist["cname"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">服务器编号：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="ServNum" readonly value="<?php echo 'SV'.date('YmdHis').rand(100,999); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">服务器外形：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="DeviceShape">
                    <option value="刀片机" <?php if($servinfo["deviceshape"] == '刀片机'): ?>selected<?php endif; ?>>刀片机</option>
                    <option value="1U" <?php if($servinfo["deviceshape"] == '1U'): ?>selected<?php endif; ?>>1U</option>
                    <option value="2U" <?php if($servinfo["deviceshape"] == '2U'): ?>selected<?php endif; ?>>2U</option>
                    <option value="3U" <?php if($servinfo["deviceshape"] == '3U'): ?>selected<?php endif; ?>>3U</option>
                    <option value="4U" <?php if($servinfo["deviceshape"] == '4U'): ?>selected<?php endif; ?>>4U</option>
                    <option value="一托2" <?php if($servinfo["deviceshape"] == '一托2'): ?>selected<?php endif; ?>>一托2</option>
                    <option value="一托4" <?php if($servinfo["deviceshape"] == '一托4'): ?>selected<?php endif; ?>>一托4</option>
                    <option value="一托6" <?php if($servinfo["deviceshape"] == '一托6'): ?>selected<?php endif; ?>>一托6</option>
                    <option value="一托7" <?php if($servinfo["deviceshape"] == '一托7'): ?>selected<?php endif; ?>>一托7</option>
                    <option value="一托8" <?php if($servinfo["deviceshape"] == '一托8'): ?>selected<?php endif; ?>>一托8</option>
                    <option value="一托16" <?php if($servinfo["deviceshape"] == '一托16'): ?>selected<?php endif; ?>>一托16</option>
                    <option value="交换机" <?php if($servinfo["deviceshape"] == '交换机'): ?>selected<?php endif; ?>>交换机</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 所在机房：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="IDCName">
                    <option value="">--请选择--</option>
                    <?php if(is_array($roomlist)): foreach($roomlist as $key=>$vo): ?><option><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">机柜编号：</span>
            <div class="form-content" style="width: 250px;">
                <input type="hidden" class="meshelfcode" value="">
                <select class="form-control" name="ShelfCode">
                    
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">设备类型：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="DeviceType">
                    <option>服务器</option>
                    <option>交换机</option>
                    <option>防火墙</option>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">相关销售：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Salers" readonly value="<?php echo ($orderlist["salesman"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 交换机端口：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="SwitchPort">
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> IP地址：</span>
            <div class="form-content" style="width: 663px;">
                <input class="form-control" type="text" name="Serv_IP" value="" readonly>
            </div>
            <a class="btn btn-info edit-ip" style="padding: 7px 13px;margin-left: -4px;margin-top: -2px;">
                ...
            </a>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;"><span class="need" style="color: red;">*</span> 服务器配置：</span>
            <div class="form-content">
                <textarea class="form-control" name="Hwconfig" rows="2"></textarea>
            </div>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;"><span class="need" style="color: red;">*</span> 带宽限制：</span>
            <div class="form-content">
                <textarea class="form-control" name="Bandwidth" rows="2"></textarea>
            </div>
        </div>
        <div class="form-line fl" style="height: 54px;line-height: 54px;">
            <span class="form-label" style="position: relative;bottom: 35px;">服务器备注：</span>
            <div class="form-content">
                <textarea class="form-control" name="Remarks" rows="2"></textarea>
            </div>
        </div>
    <div style="clear: both"></div>
    <p style="margin-top: 10px;">回复工单</p>
    <div class="layui-tab-item layui-show layui-form">
        <!-- <form class="mform2 layui-form"> -->
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 90px;">处理结果</label>
                <div class="layui-input-block" style="margin-left: 90px">
                    <select name="state" lay-verify="required">
                    <option value="已解决">已解决</option>
                    <option value="未解决">未解决</option>
                    </select>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label" style="width: 90px;">备注</label>
                <div class="layui-input-block" style="margin-left: 90px">
                    <textarea name="problemdesc" placeholder="请输入内容" class="layui-textarea remark"></textarea>
                </div>
            </div>
        <!-- </form> -->
    </div>
     </form>
</div>
</div>  
</div>
</div>
</div>
<!-- 弹窗 end-->
<script src="/Public/layui/layui.js"></script>
<script>
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
    });
    //重新渲染表单
    function renderForm(){
      layui.use('form', function(){
       var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
       form.render();
      });
    }
</script>
</body>
</html>