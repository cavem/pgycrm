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
.square{width: 34px;height: 34px;background: #28b779;color: #fff;text-align: center;line-height: 34px;cursor: pointer;}
a{color: #337ab7;}
a:hover{color: #23527c;}
.moreoption{color: #337ab7;cursor: pointer;}
.moreoption:hover{color: #23527c;}
.fold-drop{position: absolute;min-width: 100px;background: #fff;border: 1px solid #e7e7e7;display: none;z-index: 99;}
.fold-drop li a {display: block;padding: 0 5px;line-height: 30px;text-align: left;color: #404241;text-decoration-line: none;}
.fold-drop li a:hover{color: #fff;background: #60aff6;}
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
    //新建
    $('.add').click(function(){
        var confirm=function(index,layero){
            //获取iframe的body元素
            var body = layer.getChildFrame('body',index);
            var formdata = body.find('.mform').serialize();
            var name=body.find("select[name='RealName']").val();
            var month=body.find("input[name='AssessMonth']").val();
            layer.load();
            $.post("assessadd","RealName="+name+"&AssessMonth="+month,function(data,status){
                if(data==0){
                    body.find('form').each(function(){
                        $.post("resultadd",$(this).serialize(),function(data,status){
                            
                        })
                    })
                    layer.msg("操作成功");
                    window.location.reload();
                }
            })
        }
        myalert('新建考核','900px','660px',"<?php echo U('Haleadchk/new');?>",confirm);
    })
    //查看
    $('.view').click(function(){
        var id=$(this).closest('tr').children("td:first").text();
        var confirm=function(){
            layer.closeAll();
        }
        myalert('查看考核【'+id+'】','900px','660px',"<?php echo U('Haleadchk/view');?>"+"?id="+id,confirm);
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
})
</script>
<div id="content" class="wow fadeIn">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-pencil-square-o"></i> 主管考核</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Haleadchk/list');?>" method="GET">
        <input type="hidden" name="p">
        <input type="hidden" name="sc" value="<?php echo ($sc); ?>">
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
                <span class="lb">所在部门</span>
                <select class="form-control" name="Department_ID">
                    <option value="">--请选择--</option>
                    <?php if(is_array($dptlist)): $k = 0; $__LIST__ = $dptlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><option value="<?php echo ($k); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <?php if($perm['人事管理']['主管考核']['考核']): ?><a href="javascript:;" class="btn btn-primary fl add"><i class="fa fa-plus"></i> 新建考核</a><?php endif; ?>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <div class="lsit-wrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>姓名</th>
                    <th class="sort" data-val="name">考核月份</th>
                    <th>所属部门</th>
                    <th>状态</th>
                    <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><a href="javascript:;" class="view"><?php echo ($vo["realname"]); ?></a></td>
                    <td><?php echo ($vo["assessmonth"]); ?></td>
                    <td><?php echo ($vo["dept"]); ?></td>
                    <td>
                        <?php switch($vo["isconfirm"]): case "1": ?><span class="label label-success">已确认</span><?php break;?>
                            <?php case "": ?><span class="label label-danger">未确认</span><?php break; endswitch;?>
                    </td>
                    <td style="width: 100px;">
                        <?php if($perm['人事管理']['主管考核']['查看']): ?><button class="btn btn-info btn-sm view"><i class="fa fa-eye"></i></button><?php endif; ?> 
                    </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>