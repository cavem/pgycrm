<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<meta id="scale" content="initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
<style type="text/css">
.iconfont{
    font-family:"iconfont" !important;
    font-size:18px;font-style:normal;
    -webkit-font-smoothing: antialiased;
    -webkit-text-stroke-width: 0.2px;
    -moz-osx-font-smoothing: grayscale;
}
.module1{
    width: 100%;
    height: 30px;
    line-height: 30px;
    text-align: center;
    cursor: move;
    border: 1px solid #ddd;
    margin-top:-1px;
}
</style>
</head>
<body id="container">
<?php if(is_array($iparr)): foreach($iparr as $key=>$vo): if($vo != ''): ?><div class="module1"><?php echo ($vo); ?></div><?php endif; endforeach; endif; ?>
<script src="/Public/assets/js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="/Public/assets/js/Sortable.min.js"></script>
<script type="text/javascript" src="/Public/assets/js/moduleSet.min.js"></script>
<script type="text/javascript">
    // 排序
    var container = document.getElementById("container");
    var sort = Sortable.create(container, {
        animation: 150, // ms, animation speed moving items when sorting, `0` — without animation
        handle: ".module1", // Restricts sort start click/touch to the specified element
        draggable: ".module1", // Specifies which items inside the element should be sortable
        onUpdate: function(){}
    });
</script>
</body>
</html>