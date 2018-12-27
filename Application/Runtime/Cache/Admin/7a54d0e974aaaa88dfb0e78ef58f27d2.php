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
.myalert-main{width: 100%;overflow: hidden;}
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display: block;width: 150px;text-align: right;font-weight: bold;}
.form-content{width: 700px;text-align: left;}
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
/*多选框*/
.checkbox-wrap li{float: left;position: relative;margin-left:-1px;z-index: 1;min-width: 46px;height: 40px;background: #fff;border: 1px solid #e7e7e7;cursor: pointer;line-height: 40px;font-size: 13px;padding: 0 20px;}
.checkbox-wrap li:hover{border:1px solid #60aff6;z-index: 4;}
.checkbox-wrap li input{position: absolute;width:0;height: 0;left: 0;opacity: 0;cursor: pointer;}
.mychecked{border: 1px solid #60aff6 !important;background: url(/Public/assets/images/icon-selected.png) #fff no-repeat !important;background-position:bottom right !important;z-index: 5 !important;}
.sm-checkbox-wrap{background: #ddd;clear: both;overflow: hidden;padding: 5px 10px;}
.sm-checkbox-wrap .checkbox-wrap li{height: 30px !important;line-height: 30px !important;padding: 0 10px;}
.haschild{padding-right: 10px !important;}
.haschild i{position: relative;top: 16px;right: 25px;color: #ddd;font-size: 18px;}
.panel-item{margin-top: 15px;}
.layui-tab-content p{width: 100%;background-color: #D5D5D5;height: 30px;padding: 5px 0 0 5px;color:#000;}
</style>

<!-- 弹窗(新增角色)-->
<div class="myalert-content">
<div class="myalert-wrap">
    <div class="myalert-main">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">问题描述</li>
                <li>客户信息</li>
            </ul>
            <div class="layui-tab-content" style="min-height: 520px;">
                <div class="layui-tab-item layui-show">
                    <form class="mform layui-form" action="">
                      <input type="hidden" name="ddbh" value="<?php echo ($orderinfo["id"]); ?>">
                      <input type="hidden" name="cid" value="<?php echo ($orderinfo["cid"]); ?>">
                      <input type="hidden" name="cname" value="<?php echo ($orderinfo["cname"]); ?>">
                      <div class="layui-form-item" style="">
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 90px;">优先级</label>
                            <div class="layui-input-block" style="margin-left: 90px">
                              <select name="priority" lay-verify="required">
                                <option value="正常">正常</option>
                                <option value="优先">优先</option>
                                <option value="紧急">紧急</option>
                              </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 90px;">受理部门</label>
                            <div class="layui-input-block" style="margin-left: 90px">
                              <select name="recvdept" lay-verify="required" lay-filter="dep">
                                 <option value="技术部">技术部</option>
                              </select>
                            </div>
                        </div>
                      </div>
                      <div class="layui-form-item" style="">
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 90px;">处理方法</label>
                            <div class="layui-input-block" style="margin-left: 90px">
                              <select name="action" lay-verify="required"  lay-filter="ac">
                              </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label" style="width: 90px;">处理时限</label>
                            <div class="layui-input-inline">
                               <input type="number" name="timelimit" lay-verify="required|phone" autocomplete="off" class="layui-input" value="">
                            </div>
                            <div class="layui-form-mid layui-word-aux">分钟</div>
                        </div>
                      </div>
                    <div class="layui-form-item" style="">
                      <div class="layui-inline" id="rm">
                          <label class="layui-form-label" style="width: 90px;">所在机房</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <select name="room" lay-verify="required">
                            </select>
                          </div>
                      </div>
                      <div class="layui-inline">
                          <label class="layui-form-label" style="width: 90px;">批量上架</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input type="checkbox" name="batch" title="确认" lay-filter="batch" style="float: left">
                            <input type="number" name="batchnum" lay-verify="required" autocomplete="off" value="1" style="width: 50px;height: 28px;line-height: 28px;vertical-align: middle;display: none">
                          </div>
                      </div>
                    </div>

                      <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label" style="width: 90px;">问题描述</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <textarea name="problemdesc" placeholder="请输入内容" class="layui-textarea"><?php echo ($tasks['problemdesc']); ?></textarea>
                        </div>
                      </div>
                    </form>
                </div>
                <!-- 权限设置 -->
                <div class="layui-tab-item">
                  <div class="layui-form-item" style="">
                      <div class="layui-inline col-xs-5">
                          <label class="layui-form-label" style="width: 100px;">客户名称</label>
                          <div class="layui-input-block" style="margin-left: 100px">
                            <input type="text" class="layui-input" value="<?php echo ($userinfo["name"]); ?>" readonly>
                          </div>
                      </div>
                      <div class="layui-inline col-xs-5">
                          <label class="layui-form-label" style="width: 100px;">联系人</label>
                          <div class="layui-input-block" style="margin-left: 100px">
                            <input type="text" class="layui-input" value="<?php echo ($userinfo["contact"]); ?>" readonly>
                          </div>
                      </div>
                  </div>
                  <div class="layui-form-item" style="">
                      <div class="layui-inline col-xs-5">
                          <label class="layui-form-label" style="width: 100px;">联系方式</label>
                          <div class="layui-input-block" style="margin-left: 100px">
                            <input type="text" class="layui-input" value="<?php echo ($userinfo["cellphone"]); ?>" readonly>
                          </div>
                      </div>
                      <div class="layui-inline col-xs-5">
                          <label class="layui-form-label" style="width: 100px;">相关销售</label>
                          <div class="layui-input-block" style="margin-left: 100px">
                            <input type="text" class="layui-input" value="<?php echo ($userinfo["salesman"]); ?>" readonly>
                          </div>
                      </div>
                  </div>
                </div>
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
      form.on('select(ac)', function(data){
        var act=data.value;
        act=act.split("_");
        if (act[0]=="上架") 
        {
            $("select[name='priority'] option:last").attr("selected",true);
            renderForm();
        }
        $("input[name='timelimit']").val(act[1]);
      });
      form.on('select(dep)',function(data){
        $.ajax({
             type: "POST",
             url: "<?php echo U('actionlst');?>",
             data:"type=3",
             success: function(msg){
                var ac="<?=$tasks['action']?>";
                var a=eval('('+msg+')');
                $("[name='action'] option").remove();
                var option="<option value='0'>-------请选择-------</option>";
                $.each(a,function(index,array){
                    var sel=array['name']==ac?"selected":"";
                    option+="<option value='"+array['name']+"_"+array['timelimit']+"' "+sel+">"+array['name']+"</option>";
                })
                $("[name='action']").append(option);
                renderForm();
             }
        })
      });
      form.on('checkbox(batch)', function(data){
        var act=data.elem.checked;
        if (act==true) {
          $("input[name='batchnum']").css('display',"");
        }else{
          $("input[name='batchnum']").css('display',"none");
        }
        
      });
    });
    window.onload = function(){
        $.ajax({
             type: "POST",
             url: "<?php echo U('roomlst');?>",
             data:"",
             success: function(msg){
                var rm="<?=$tasks['room']?>";
                var a=eval('('+msg+')');
                $("[name='room'] option").remove();
                var option="";
                $.each(a,function(index,array){
                    var sel=array['name']==rm?"selected":"";
                    option+="<option value='"+array['name']+"' "+sel+">"+array['name']+"</option>";
                })
                $("[name='room']").append(option);
                renderForm();
             }
        });
        $.ajax({
             type: "POST",
             url: "<?php echo U('actionlst');?>",
             data:"type=3",
             success: function(msg){
                var a=eval('('+msg+')');
                $("[name='action'] option").remove();
                var option="<option value='0'>-------请选择-------</option>";
                $.each(a,function(index,array){
                    option+="<option value='"+array['name']+"_"+array['timelimit']+"'>"+array['name']+"</option>";
                })
                $("[name='action']").append(option);
                renderForm();
             }
        })
    }
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