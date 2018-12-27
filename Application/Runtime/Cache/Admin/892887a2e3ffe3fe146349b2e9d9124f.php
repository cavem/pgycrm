<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>[title]</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/jquery-ui.css" rel="stylesheet" type="text/css"  />
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
<script src="/Application/Admin/View/Public/script/jquery.min.1.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery-ui.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jqchart.js" type="text/javascript"></script>
</head>
<style>
    .table>tbody>tr>td{vertical-align: middle;}
    .form-control{display: inline-block;height: 30px;}
    .btn{padding: 4px 8px;font-size: 14px;}
    .ml20{margin-left:20px;}
</style>
<body>
<div style="padding: 10px;">
    <table class="table table-condensed">
        <thead>
            <tr style="background: #09c;color: #fff;">
                <th>消费总额</th>
                <th>代理佣金</th>
                <th>推介佣金</th>
                <th>收 益</th>
                <th>创建时间</th>
                <th>服务起始时间</th>
                <th>服务结束时间</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="form-control" style="width: 80px;"></td>
                <td><input type="text" class="form-control" style="width: 80px;"></td>
                <td><input type="text" class="form-control" style="width: 80px;"></td>
                <td>0.00</td>
                <td><input type="text" class="form-control" style="width: 150px;"></td>
                <td><input type="text" class="form-control" style="width: 150px;"></td>
                <td><input type="text" class="form-control" style="width: 150px;"></td>
            </tr>
        </tbody>
    </table>
    <b>客户消费金额：490.00，收益总额：490.00</b><button class="btn btn-primary ml20">保存更新</button>
</div>
</body>
</html>