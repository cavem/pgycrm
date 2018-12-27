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
.layui-tab-content table td{border:1px solid #D5D5D5;padding-left: 5px}
</style>
<script>
  $(function(){
      $('.look').click(function(){
          $('.file').click();
          $(".file").bind('change', function () {
            $("input[name='pic']").val("已选择，请点击上传");
          })
      })
      $(".upload").click(function () {
          var filedata=new FormData(document.getElementById("fileform"));
          console.log(filedata);
          $.ajax({
  　　　　　　　　url : '/Custom/uploadimg', 
  　　　　　　　　type : "post",
  　　　　　　　　data : filedata, //第二个Form表单的内容
  　　　　　　　　processData : false,
  　　　　　　　　contentType : false,
  　　　　　　　　error : function(request) {
  　　　　　　　　},
  　　　　　　　　success : function(data) {
  　　　　　　　　　　$("input[name='pic']").val(data);
                    $('.view-pic').show();
                    $('.view-pic').click(function(){
                      layer.alert('<img src="'+data+'" width="100%;">');
                    })
  　　　　　　　  }
  　　　　　});
      });
      $('.edit-ip').click(function(){
          var serv_ip=$("input[name='newip']").val();
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
              $("input[name='newip']").val(ip_addrstr);
              layer.closeAll(); 
          }
          myalert('修改IP','800px','540px',"<?php echo U('Service/edit_ip');?>"+"?serv_ip="+serv_ip,confirm);
      })
        
      
  })
</script>
<?php if($tasks["action"] == '更换位置'): ?><script>
  $(function(){
    $.post("/Service/getroom",{'key':'1'},function(data,status){
      data=JSON.parse(data);
      console.log(data);
      var room='<option value="">--请选择--</option>';
      for(var i in data){
        room+='<option>'+data[i]+'</option>';
      }
      console.log(room);
      $("select[name='idcname']").append(room);
      renderForm();
    })
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
      ,form = layui.form;
      form.on('select(idcname)',function(data){
          var idcname=data.value;
          $.post("/Service/getshelf",{"idcname":idcname},function(data,status){
              data=JSON.parse(data);
              var shelfcon='<option value="">--请选择--</option>';
              for(var i in data){
                  shelfcon+='<option value="'+data[i]['code']+'">'+data[i]['code']+'</option>';
              }
              $("select[name='shelfcode']").append(shelfcon);
              renderForm();
          })
      })
    })
  })
  //重新渲染表单
  function renderForm(){
      layui.use('form', function(){
       var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
       form.render();
      });
  }
</script><?php endif; ?>
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
                <?php if(!empty($tasks["svid"])): ?><p style="margin-top: 10px;">服务器信息</p>
                  <table border="0" style="width: 100%;line-height: 30px">
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td style="width: 100px">编号</td>
                          <td style="font: 16px solid #FF0000"><?php echo ($serverinfo["servnum"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>设备名称</td>
                          <td><?php echo ($serverinfo["servname"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>设备类型</td>
                          <td><?php echo ($serverinfo["devicetype"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                        <td>服务器类型</td>
                        <td><?php echo ($serverinfo["productkind"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>设备外形</td>
                          <td><?php echo ($serverinfo["deviceshape"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>操作系统</td>
                          <td><?php echo ($serverinfo["os"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>MAC地址</td>
                          <td><?php echo ($serverinfo["macaddress"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>IP地址</td>
                          <td><?php echo ($serverinfo["serv_ip"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>密码</td>
                          <td><?php echo ($serverinfo["password"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>配置</td>
                          <td style="font-weight: bold;"><?php echo ($serverinfo["hwconfig"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>带宽限制</td>
                          <td><?php echo ($serverinfo["bandwidth"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>备注</td>
                          <td><?php echo ($serverinfo["remarks"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>所在机房</td>
                          <td><?php echo ($serverinfo["idcname"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>所在机柜</td>
                          <td><?php echo ($serverinfo["shelfcode"]); ?></td>
                      </tr>
                      <tr style="border-bottom: 1px solid #D5D5D5">
                          <td>状态</td>
                          <td><?php echo ($serverinfo["servstate"]); ?></td>
                      </tr>
                  </table><?php endif; ?>
                <p style="margin-top: 10px;">
                  <?php switch($type): case "0": case "3": case "4": case "5": case "6": case "7": case "8": case "9": ?>处理结果<?php break;?>
                      <?php case "1": ?>指派工单<?php break;?>
                      <?php case "2": ?>回复工单<?php break;?>
                      <?php case "10": ?>废弃原因<?php break; endswitch;?>
                </p>
                <div class="layui-tab-item layui-show">
                    <form class="mform layui-form" action="">
                      <input type="hidden" name="nid" value="<?php echo ($nid); ?>" />
                      <input type="hidden" name="type" value="<?php echo ($type); ?>" />
                      <input type="hidden" name="gid" value="<?php echo ($tasks["id"]); ?>">
                      <input type="hidden" name="state" value="<?php echo ($tasks["state"]); ?>">
                      <input type="hidden" name="action" value="<?php echo ($tasks["action"]); ?>">
                      <input type="hidden" name="ips" value="<?php echo ($tasks["addip"]); ?>">
                      <input type="hidden" name="servnum" value="<?php echo ($serverinfo["servnum"]); ?>">
                      <input type="hidden" name="serv_ip" value="<?php echo ($serverinfo["serv_ip"]); ?>">
                      <?php if($type == 1): ?><div class="layui-form-item" style="">
                        <label class="layui-form-label" style="width: 90px;">指派员工</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="receiver" lay-verify="required">
                            <?php if(is_array($userlst)): foreach($userlst as $key=>$user): ?><option value="<?php echo ($user["realname"]); ?>"><?php echo ($user["realname"]); ?></option><?php endforeach; endif; ?>
                          </select>
                        </div>
                      </div><?php endif; ?>
                      <?php if($type == 2): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">处理结果</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="已解决">已解决</option>
                            <option value="未解决">未解决</option>
                          </select>
                        </div>
                      </div>
                      <?php if($tasks["action"] == '更换位置'): ?><div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">机房</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input type="hidden" name="preidcname" value="<?php echo ($serverinfo["idcname"]); ?>">
                            <select name="idcname" lay-verify="required" lay-filter="idcname">
                              
                            </select>
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">机柜</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input type="hidden" name="preshelfcode" value="<?php echo ($serverinfo["shelfcode"]); ?>">
                            <select name="shelfcode" lay-verify="required">
                              
                            </select>
                          </div>
                        </div><?php endif; ?>
                      <?php if(($tasks["action"] == '带宽纠错') OR ($tasks["action"] == '带宽变更')): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">原带宽</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <input class="layui-input" type="text" name="prebandwidth" value="<?php echo ($serverinfo["bandwidth"]); ?>">
                        </div>
                      </div>
                      <div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">现带宽</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <input class="layui-input" type="text" name="bandwidth">
                        </div>
                      </div><?php endif; ?>
                      <?php if($tasks["action"] == '添加IP' OR $tasks["action"] == '更换IP' OR $tasks["action"] == '更换IP重装Win系统' OR $tasks["action"] == '更换IP重装Linux系统' OR $tasks["action"] == '新上架'): ?><div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">原IP</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input class="layui-input" type="text" name="oldip" value="<?php echo ($serverinfo["serv_ip"]); ?>">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">现IP</label>
                          <div class="layui-input-block" style="margin-left: 90px;position: relative;">
                            <input class="layui-input" type="text" name="newip">
                            <a href="javascript:;" class="btn btn-info btn-sm fr edit-ip" style="position: absolute;top: 0;right: 0;width: 38px;height: 38px;">...</a>
                          </div>
                        </div><?php endif; ?>
                      <?php if($tasks["action"] == '更换硬件' OR $tasks["action"] == '更换硬件重装系统' OR $tasks["action"] == '租用机器增减硬件' OR $tasks["action"] == '托管机器增减硬件' OR $tasks["action"] == '新上架'): ?><div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">原配置</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input class="layui-input" type="text" name="oldhwconfig" value="<?php echo ($serverinfo["hwconfig"]); ?>">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">现配置</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input class="layui-input" type="text" name="newhwconfig">
                          </div>
                        </div><?php endif; endif; ?>
                      <?php if($type == 3): ?><div class="layui-form-item" style="">
                        <label class="layui-form-label" style="width: 90px;">工单审核</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="已解决">已解决</option>
                            <option value="未解决">未解决</option>
                            <option value="废弃">废弃</option>
                          </select>
                        </div>
                      </div><?php endif; ?>
                      <!-- <?php if($type == 4): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">工单审核</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <input type="checkbox" name="orderreset" title="工单重置">
                          <input type="checkbox" name="zero" title="奖金清零">
                        </div>
                      </div><?php endif; ?> -->
                      <?php if($type == 5): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">处理结果</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="待财务确认">带宽确认</option>
                          </select>
                        </div>
                      </div>
                      <?php if(($tasks["action"] == '上架') OR ($tasks["action"] == '上架转让')): ?><div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">现带宽</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input class="layui-input" type="text" name="bandwidth">
                          </div>
                        </div>
                        <div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">调整截图</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <input class="layui-input" type="text" name="pic" style="display: inline-block;width: 550px;">
                            <a class="btn btn-default ml15 look">浏览</a><a class="btn btn-primary ml15 upload">上传</a>
                            <a href="javascript:;" style="display: none;" class="ml15 view-pic">查看图片</a>
                          </div>
                        </div><?php endif; endif; ?>
                      <?php if($type == 6): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">处理结果</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="待审核">财务确认</option>
                          </select>
                        </div>
                      </div><?php endif; ?>
                      <?php if($type == 7): ?><div class="layui-form-item">
                          <label class="layui-form-label" style="width: 90px;">处理结果</label>
                          <div class="layui-input-block" style="margin-left: 90px">
                            <select name="state" lay-verify="required">
                              <option value="关闭">确认位置</option>
                            </select>
                          </div>
                        </div><?php endif; ?>
                      <?php if(($type == 8) AND $tasks["action"] == '下架'): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">处理结果</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="关闭">确认下架</option>
                          </select>
                        </div>
                      </div><?php endif; ?>
                      <?php if($type == 9): ?><div class="layui-form-item">
                        <label class="layui-form-label" style="width: 90px;">处理结果</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <select name="state" lay-verify="required">
                            <option value="继续处理">继续处理</option>
                            <option value="放入工单池">放入工单池</option>
                          </select>
                        </div>
                      </div><?php endif; ?>
                      <?php if(($type == 0 OR ($type == 1 AND $tasks["state"] == '待确认')) AND ($tasks["action"] == '上架' OR $tasks["action"] == '添加IP' OR $tasks["action"] == '更换IP' OR $tasks["action"] == '更换IP重装Win系统' OR $tasks["action"] == '更换IP重装Linux系统' OR $tasks["action"] == '新上架')): ?><div class="layui-form-item layui-form-text">
                        <div class="row chang js-short" style="margin: -5px 0px 5px 90px;">
                        <a onclick="selip(0)" class="btn btn-sm btn-warning">普通电信IP</a>
                        <a onclick="selip(1)" class="btn btn-sm btn-warning">普通电信阻断国外IP</a>
                        <a onclick="selip(2)" class="btn btn-sm btn-warning">普通移动IP</a>
                        <a onclick="selip(3)" class="btn btn-sm btn-warning">普通联通IP</a>
                        <a onclick="selip(4)" class="btn btn-sm btn-success">高防电信(阻断国外)IP</a>
                        <a onclick="selip(5)" class="btn btn-sm btn-success">高防联通(阻断国外)IP</a>
                        <a onclick="selip(6)" class="btn btn-sm btn-info">普通BGP(无防御)IP</a>
                        <a onclick="selip(7)" class="btn btn-sm btn-info">100G BGP空闲(不封国外，京东专用)IP</a>
                        <a onclick="selip(8)" class="btn btn-sm btn-info">高防BGP(阻断国外)IP</a>
                        
                        </div>
                        <label class="layui-form-label" style="width: 90px;">IP地址</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <textarea name="ips" placeholder="请点击上方按钮选择IP" class="layui-textarea"></textarea>
                        </div>
                      </div><?php endif; ?>
                      <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label" style="width: 90px;">备注</label>
                        <div class="layui-input-block" style="margin-left: 90px">
                          <textarea name="problemdesc" placeholder="请输入内容" class="layui-textarea"></textarea>
                        </div>
                      </div>
                    </form>
                    <form class="fileform" id="fileform">
                      <input type="file" name="file" class="file" id="fileField" size="28" style="display: none;">
                    </form>
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
    });
    //重新渲染表单
    function renderForm(){
      layui.use('form', function(){
       var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
       form.render();
      });
    }

    function selip(dt)
    {
        $.ajax({
            type: "POST",
              url: "/Workorder/selip",
              data:"datatype="+dt,
              success: function(msg){
                var a=eval('('+msg+')');
                var ips=$("[name='ips']").text();
                $("[name='ips']").text(ips+a+"/");
            }
        });
    } 
</script>
</body>
</html>