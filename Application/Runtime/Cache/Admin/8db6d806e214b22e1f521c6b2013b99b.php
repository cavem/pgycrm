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
/*基本信息*/
.form-line{height: 40px;line-height: 40px;margin: 10px 0;}
.form-label{display:inline-block;width: 150px;text-align: right;font-weight: bold;}
.w50{width: 50%;text-align: left;}
.form-content{width: 700px;text-align: left;display: inline-block;}
.form-control{display: initial;}
.tab-content{padding: 10px;}
.bdred{border-color: red !important;}
</style>
<script>
$(function(){
    $('.moreoption').click(function(){
        $(this).closest('.form-content').find('.mulselect').toggle();
    })
    document.addEventListener('click',function (e) {
        var parent=$(e.target).parents('.form-content,.mulselect');
        if(parent.length===0){
            $('.mulselect').hide();
        }
    })
    $('.mulselect').change(function(){
        var selecteds="";
        $(this).children('option:selected').each(function(){
            selecteds+=$(this).text()+',';
        })
        selecteds=selecteds.substring(0,selecteds.length-1);
        $(this).closest('.form-content').find('input').val(selecteds);
        $(this).closest('.form-content').find('.moreoption').html(selecteds+'<i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i>');
    })
    $('.moreoption').hover(function(){
        $(this).attr('title',$(this).text());
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
    <form class="mform">
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 工作名称：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Name" value="<?php echo ($wklist["name"]); ?>">
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label">所属部门：</span>
            <div class="form-content" style="width: 250px;">
                <select class="form-control" name="Department_ID">
                    <option value="">--请选择--</option>
                    <?php if(is_array($dptlist)): $i = 0; $__LIST__ = $dptlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($wklist['department_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="form-line w50 fl">
            <span class="form-label"><span class="need" style="color: red;">*</span> 工作频率：</span>
            <div class="form-content" style="width: 250px;">
                <input class="form-control" type="text" name="Frequency" value="<?php echo ($wklist["frequency"]); ?>">
            </div>
        </div>
        <div class="form-line fl" style="height: auto;width: 100%;">
            <span class="form-label" style="position: relative;bottom: 430px;">工作描述：</span>
            <div class="form-content" style="width: 700px;">
                <script id="container" name="Remarks" type="text/plain" style="height:250px;"><?php echo ($wklist["remarks"]); ?></script>
                <!-- 配置文件 -->
                <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
                <!-- 编辑器源码文件 -->
                <script type="text/javascript" src="/Public/ueditor/ueditor.all.js"></script>
                <!-- 实例化编辑器 -->
                <script type="text/javascript">
                    var ue = UE.getEditor('container',{autoHeightEnabled:false});
                </script>
            </div>
        </div>
        <div class="form-line fl">
            <span class="form-label" style="position: relative;bottom: 10px;">责任人：</span>
            <div class="form-content" style="width: 500px;">
                <span class="moreoption form-control" style="display: block;overflow: hidden;position: relative;line-height: 1.6;top:2px;cursor: initial;"><?php echo ($wklist["userprofiles"]); ?><i class="fa fa-sort-desc fr" style="position: absolute;top: 10px;right: 5px;"></i></span>
                <select multiple class="form-control mulselect" style="width: 500px;height: 250px;position: absolute;display: none;">
                    <?php if(is_array($userlist)): $i = 0; $__LIST__ = $userlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$uservo): $mod = ($i % 2 );++$i;?><option><?php echo ($uservo["realname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <input name="UserProfiles" type="hidden" value="<?php echo ($wklist["userprofiles"]); ?>">
            </div>
            <span style="position:relative;bottom: 10px;">注：按住ctrl可多选</span>
        </div>
    </form>
</div>
</div>
</div>
</body>
</html>