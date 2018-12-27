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
@media (max-width: 970px) and (min-width: 481px){
body {
    background: transparent;
}
}
</style>
<script>
$(function(){
    $('.ippart').click(function(){
        var ippart=$(this).text();
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var str="";
            $("input[name='ip_addr']").each(function(){
                str+=$(this).val()+"/";
            })
            var ippartstr="";
            var teststr="";
            var formdata = body.find(".mactive").each(function(){
                var ippartcheck=$(this).children('.freeip').text();
                if(str.indexOf(ippartcheck)<1){
                    teststr+=ippartcheck+'/';
                    ippartstr+='<div class="alert alert-warning alert-dismissable mt5"><input type="hidden" name="ip_addr" value="'+ippartcheck+'"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'+ippartcheck+'</div>';
                }
            });
            console.log(teststr);
            $('.sider',window.parent.document).append(ippartstr);
            layer.closeAll();
        }
        myalert('空闲IP列表','500px','420px',"<?php echo U('Service/edit_ip2');?>"+"?ippart="+ippart,confirm);
    })
})
</script>
<div class="mysearchbox fr">
    <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
    <form class="sform" action="<?php echo U('Service/edit_ipfree');?>" method="POST">
        <input type="hidden" name="serv_ip" value="<?php echo ($serv_ip); ?>">
        <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容">
    </form>
    <i class="fa fa-times empty"></i>
</div>
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th>网络段</th>
            <th>空闲IP数</th>
            <th>所在机房</th>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($ipseg)): $k = 0; $__LIST__ = $ipseg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
            <td><?php echo ($vo["no"]); ?></td>
            <td><a href="javacript:;" class="ippart"><?php echo ($vo["ipseg"]); ?></a></td>
            <td><?php echo ($vo["count"]); ?></td>
            <td><?php echo ($vo["room"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<?php echo ($page); ?>
</body>
</html>