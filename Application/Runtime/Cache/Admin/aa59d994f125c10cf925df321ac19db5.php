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
.sort{cursor: pointer;}
.sort:hover{color: #337ab7;text-decoration: underline;}
</style>
<script>
$(function(){
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
        $('.sform').attr("action","<?php echo U('Finan/exportcsv');?>");
        $('.sform').submit();
    })
})
</script>
<div id="content" class="wow fadeIn" style="overflow: auto;height: 100%;">
    <div id="content-header">
        <span class="header-title"><i class="fa fa-bar-chart"></i> 收款统计</span>
        <div class="square fr search">
            <i class="fa fa-search" style="font-size: 14px;"></i>
        </div>
        <form class="sform" action="<?php echo U('Finan/census');?>" method="GET">
            <input type="hidden" name="p">
            <input type="hidden" name="sc" value="<?php echo ($sc); ?>">
            
            <div class="mysearchbox fr">
                <i class="fa fa-search" style="position: absolute;top: 11px;left: 11px;"></i>
                <input id="searchbox" type="search" name="keyword" class="form-control" placeholder="请输入查询内容" value="<?php echo ($key); ?>">
                <i class="fa fa-times empty"></i>
            </div>
            <div class="fr" style="margin-right: 20px;">
                <span style="height: 34px;line-height: 34px;">年份：</span><input type="text" class="fr form-control" style="width: 100px;" name="year" value="<?php echo ($year); ?>" onclick="WdatePicker({dateFmt:'yyyy'});">
            </div>
        </form>
    </div>
    <div class="container-fluid">
        <div class="someopt mt15">
            <a href="<?php echo U('Finan/exportcsv');?>" class="btn btn-primary fl export"><i class="fa fa-external-link"></i> 导 出</a>
            <a href="javascript:;" class="fr gopage" style="height: 28px;line-height: 28px;border:1px solid #58A0D3;background-color: #d5d5d5;font-size: 12px;padding:0 5px">跳转</a>
            <div><input type="text" id="pagebox" class="form-control fr cpage" style="width: 60px;height: 28px;"></div>
            <div class="page fr mr10 pages"><?php echo ($page); ?></div>
        </div>
        <table class="table table-hover" style="min-width: 2334px;">
            <thead>
                <tr>
                    <th>客户ID</th>
                    <th class="sort" data-val="cname">客户名称</th>
                    <th>预付款余额</th><th>服务器数量</th><th>月付总额</th><th>季付总额</th><th>半年付总额</th>
                    <th>年付总额</th><th>到期未注销总额</th><th>上月到期未注销总额</th>
                    <th class="sort" data-val="m1">1月份</th>
                    <th class="sort" data-val="m2">2月份</th>
                    <th class="sort" data-val="m3">3月份</th>
                    <th class="sort" data-val="m4">4月份</th>
                    <th class="sort" data-val="m5">5月份</th>
                    <th class="sort" data-val="m6">6月份</th>
                    <th class="sort" data-val="m7">7月份</th>
                    <th class="sort" data-val="m8">8月份</th>
                    <th class="sort" data-val="m9">9月份</th>
                    <th class="sort" data-val="m10">10月份</th>
                    <th class="sort" data-val="m11">11月份</th>
                    <th class="sort" data-val="m12">12月份</th>
                    <th class="sort" data-val="ndze">年度总额</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["cid"]); ?></td>
                        <td><?php echo ($vo["cname"]); ?></td>
                        <td><?php echo ($vo['prepay']?$vo['prepay']:'0'); ?></td>
                        <td><?php echo ($vo["svrnum"]); ?></td>
                        <td><?php echo ($vo['yfze']?$vo['yfze']:'0'); ?></td>
                        <td><?php echo ($vo['jfze']?$vo['jfze']:'0'); ?></td>
                        <td><?php echo ($vo['bnfze']?$vo['bnfze']:'0'); ?></td>
                        <td><?php echo ($vo['nfze']?$vo['nfze']:'0'); ?></td>
                        <td><?php echo ($vo['dqwzxze']?$vo['dqwzxze']:'0'); ?></td>
                        <td><?php echo ($vo['sydqwzxze']?$vo['sydqwzxze']:'0'); ?></td>
                        <td><?php echo ($vo['m1']?$vo['m1']:'0'); ?></td>
                        <td><?php echo ($vo['m2']?$vo['m2']:'0'); ?></td>
                        <td><?php echo ($vo['m3']?$vo['m3']:'0'); ?></td>
                        <td><?php echo ($vo['m4']?$vo['m4']:'0'); ?></td>
                        <td><?php echo ($vo['m5']?$vo['m5']:'0'); ?></td>
                        <td><?php echo ($vo['m6']?$vo['m6']:'0'); ?></td>
                        <td><?php echo ($vo['m7']?$vo['m7']:'0'); ?></td>
                        <td><?php echo ($vo['m8']?$vo['m8']:'0'); ?></td>
                        <td><?php echo ($vo['m9']?$vo['m9']:'0'); ?></td>
                        <td><?php echo ($vo['m10']?$vo['m10']:'0'); ?></td>
                        <td><?php echo ($vo['m11']?$vo['m11']:'0'); ?></td>
                        <td><?php echo ($vo['m12']?$vo['m12']:'0'); ?></td>
                        <td><?php echo ($vo['ndze']?$vo['ndze']:'0'); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php if(is_array($zjlist)): $i = 0; $__LIST__ = $zjlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td></td>
                        <td>
                            <?php switch($vo["cname"]): case "总计": ?><span class="label label-danger">总计</span><?php break;?>
                                <?php case "去年总计": ?><span class="label label-warning">去年总计</span><?php break; endswitch;?>
                        </td>
                        <td><?php echo ($vo['prepay']?$vo['prepay']:'0'); ?></td>
                        <td><?php echo ($vo["svrnum"]); ?></td>
                        <td><?php echo ($vo['yfze']?$vo['yfze']:'0'); ?></td>
                        <td><?php echo ($vo['jfze']?$vo['jfze']:'0'); ?></td>
                        <td><?php echo ($vo['bnfze']?$vo['bnfze']:'0'); ?></td>
                        <td><?php echo ($vo['nfze']?$vo['nfze']:'0'); ?></td>
                        <td><?php echo ($vo['dqwzxze']?$vo['dqwzxze']:'0'); ?></td>
                        <td><?php echo ($vo['sydqwzxze']?$vo['sydqwzxze']:'0'); ?></td>
                        <td><?php echo ($vo['m1']?$vo['m1']:'0'); ?></td>
                        <td><?php echo ($vo['m2']?$vo['m2']:'0'); ?></td>
                        <td><?php echo ($vo['m3']?$vo['m3']:'0'); ?></td>
                        <td><?php echo ($vo['m4']?$vo['m4']:'0'); ?></td>
                        <td><?php echo ($vo['m5']?$vo['m5']:'0'); ?></td>
                        <td><?php echo ($vo['m6']?$vo['m6']:'0'); ?></td>
                        <td><?php echo ($vo['m7']?$vo['m7']:'0'); ?></td>
                        <td><?php echo ($vo['m8']?$vo['m8']:'0'); ?></td>
                        <td><?php echo ($vo['m9']?$vo['m9']:'0'); ?></td>
                        <td><?php echo ($vo['m10']?$vo['m10']:'0'); ?></td>
                        <td><?php echo ($vo['m11']?$vo['m11']:'0'); ?></td>
                        <td><?php echo ($vo['m12']?$vo['m12']:'0'); ?></td>
                        <td><?php echo ($vo['ndze']?$vo['ndze']:'0'); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>