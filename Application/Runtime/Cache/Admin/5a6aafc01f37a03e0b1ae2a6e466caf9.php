<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
<title>蒲公英自动化</title>
<link href="/Application/Admin/View/Public/bootstrap-3.3.5-dist/css/bootstrap.min.css" title="" rel="stylesheet" />
<link title="" href="/Application/Admin/View/Public/css/style.css" rel="stylesheet" type="text/css"  />
<link title="blue" href="/Application/Admin/View/Public/css/dermadefault.css" rel="stylesheet" type="text/css"/>
<link title="green" href="/Application/Admin/View/Public/css/dermagreen.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link title="orange" href="/Application/Admin/View/Public/css/dermaorange.css" rel="stylesheet" type="text/css" disabled="disabled"/>
<link href="/Application/Admin/View/Public/css/templatecss.css" rel="stylesheet" title="" type="text/css" />
<script src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/script/jquery.cookie.js" type="text/javascript"></script>
<script src="/Application/Admin/View/Public/bootstrap-3.3.5-dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Public/layer/layer.js" type="text/javascript"></script>
</head>

<body>
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
  <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
    </button>
    <a class="navbar-brand mystyle-brand"><span class="glyphicon glyphicon-home"></span></a> </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="li-border"><a class="mystyle-color" href="#">管理控制台</a></li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">产品与服务<span class="caret"></span></a>
        <!----下拉框选项---->
         <div class="dropdown-menu topbar-nav-list">
             <div class="topbar-nav-col">
               <div class="topbar-nav-item">
               <p class="topbar-nav-item-title">弹性计算</p>
               <ul>
                 <li><a href="http://baidu.com">
                     <span class="glyphicon glyphicon-road"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-picture"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-gift"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                </ul>
               </div>
               
               <div class="">
               <p class="topbar-nav-item-title">弹性计算</p>
               <ul>
                 <li><a href="#">
                     <span class="glyphicon glyphicon-road"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-picture"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-gift"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
               </ul>
               </div> 
             </div>
             
             
             <div class="topbar-nav-col">
               <div class="topbar-nav-item">
               <p class="topbar-nav-item-title">弹性计算</p>
               <ul>
                 <li><a href="#">
                     <span class="glyphicon glyphicon-road"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-picture"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-gift"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                </ul>
               </div>
               
               <div class="">
               <p class="topbar-nav-item-title">弹性计算</p>
               <ul>
                 <li><a href="#">
                     <span class="glyphicon glyphicon-road"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-picture"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
                  <li><a href="#">
                     <span class="glyphicon glyphicon-gift"></span> 
                     <span class="">云服务器 ECS</span> 
                 </a>
                 </li>
               </ul>
               </div>
               
             </div>
             
         </div>
      </li>
    </ul>
    
    <ul class="nav navbar-nav pull-right">
       <li class="li-border">
          <a href="#" class="mystyle-color">
            <span class="glyphicon glyphicon-bell"></span>
            <span class="topbar-num">0</span>
          </a>
      </li>
       <li class="li-border dropdown"><a href="#" class="mystyle-color" data-toggle="dropdown">
      <span class="glyphicon glyphicon-search"></span> 搜索</a>
         <div class="dropdown-menu search-dropdown">
            <div class="input-group">
                <input type="text" class="form-control">
                 <span class="input-group-btn">
                   <button type="button" class="btn btn-default">搜索</button>
                </span>
            </div>
         </div>
      </li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">帮助与文档<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">帮助与文档</a></li>
          <li class="divider"></li>
          <li><a href="#">论坛</a></li>
          <li class="divider"></li>
          <li><a href="#">博客</a></li>
        </ul>
      </li>
      <li class="dropdown li-border"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown"><?php echo ($_SESSION['loginuser']['username']); ?><span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">退出</a></li>
        </ul>
      </li>
      <li class="dropdown"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">换肤<span class="caret"></span></a>
        <ul class="dropdown-menu changecolor">
          <li id="blue"><a href="#">蓝色</a></li>
          <li class="divider"></li>
          <li id="green"><a href="#">绿色</a></li>
          <li class="divider"></li>
          <li id="orange"><a href="#">橙色</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="down-main">
  <div class="left-main left-full">
    <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
    <div class="subNavBox">
      <div class="sBox">
       <div class="subNav sublist-up"><span class="title-icon glyphicon glyphicon-chevron-down"></span><span class="sublist-title">用户中心</span>
        </div>
        <ul class="navContent" style="display:none">
          <li>
            <div class="showtitle" style="width:100px;"><img src="img/leftimg.png" />账号管理</div>
            <a href="<?php echo U('index/userinfo');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">账号管理</span></a> </li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="img/leftimg.png" />消息中心</div>
            <a href="message.html"><span class="sublist-icon glyphicon glyphicon-envelope"></span><span class="sub-title">消息中心</span></a> </li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="img/leftimg.png" />短信</div>
            <a href="smsInfo.html"><span class="sublist-icon glyphicon glyphicon-bullhorn"></span><span class="sub-title">短信</span></a></li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="img/leftimg.png" />实名认证</div>
            <a href="identify.html"><span class="sublist-icon glyphicon glyphicon-credit-card"></span><span class="sub-title">实名认证</span></a></li>
        </ul>
      </div>
      <div class="sBox">
        <div <?=empty($guanwang)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span class="title-icon glyphicon glyphicon-chevron-up"></span><span class="sublist-title">官网管理</span></div>
        <ul class="navContent" style="<?=empty($guanwang)?"display:none":"display:block"?>">
          <li <?=empty($daohang)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">导航列表</div>
            <a href="<?php echo U('officweb/navlist');?>"><span class="sublist-icon glyphicon glyphicon-th-list"></span><span class="sub-title">导航列表</span></a></li>
          <li <?=empty($mokuai)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">模块列表</div>
            <a href="<?php echo U('officweb/newslist');?>"><span class="sublist-icon glyphicon glyphicon-list-alt"></span><span class="sub-title">模块列表</span></a></li>
          <li <?=empty($quote)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">产品信息</div>
            <a href="<?php echo U('officweb/quotelist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">产品信息</span></a></li> 
          <li <?=empty($member)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">会员信息</div>
            <a href="<?php echo U('officweb/memberlist');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">会员信息</span></a></li>
        </ul>
      </div>
      <div class="sBox">
        <div <?=empty($product)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span class="title-icon glyphicon glyphicon-chevron-up"></span><span class="sublist-title">产品管理</span></div>
        <ul class="navContent" style="<?=empty($product)?"display:none":"display:block"?>">
          <li <?=empty($quote)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">产品信息</div>
            <a href="<?php echo U('officweb/quotelist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">产品信息</span></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="right-product right-full">
        <div class="center-back right-back">
        <div class="container-fluid">
          <div class="info-center">
                    <div class="page-header">
                      <div class="pull-left">
						<h4>模块列表</h4>      
					</div>
            <div class="pull-right">
                <button type="button" class="btn btn-mystyle btn-sm">搜索</button>
                 <button type="button" class="btn btn-mystyle btn-sm">返回</button>
            </div>
            </div>
            <form action="<?php echo U('Officweb/quotelist');?>" method="post">
            <div class="search-box row">
               <div class="col-md-8">
                <div class="form-group">
                  <input type="text" name="keyword" value="<?php echo ($keyword); ?>" class="form-control" placeholder="请输入标题">               
               </div>
               <div class="form-group btn-search">
                    <input type="submit" name="" class="btn btn-default" style="width:70px" value="搜索">
                </div>
                </div>
                <div class="col-md-4">
                 <div class="btn-group pull-right" role="group" aria-label="...">
                  <a type="button" onclick="quoteadd();" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> 新增</a>
                </div>
                </div>
            </div>
            </form>
            <div class="clearfix"></div>
              <ul class="nav nav-tabs" role="tablist">  
                <li role="presentation" <?=!empty($datatype)?'':"class='active'"?>><a href="<?php echo U('Officweb/quotelist',array('datatype'=>0));?>" role="tab" >云架构</a></li>  
                <li role="presentation" <?=empty($datatype)?'':"class='active'"?>><a href="<?php echo U('Officweb/quotelist',array('datatype'=>1));?>" role="tab" >物理架构</a></li> 
              </ul>  
              <div class="table-margin">
              <table class="table table-bordered table-header">
                 <thead>
                 <tr>
                   <td class="w90">标题</td>
                   <td>操作</td>
                 </tr>
                 </thead>
                 <tbody>
                 <?php if(is_array($model)): foreach($model as $key=>$v): ?><tr>
                    <td><?php echo ($v["title"]); ?></td>
                    <td style="white-space:nowrap;">
                      <a type="button" href="<?php echo U('Officweb/quotelist',array('fid'=>$v['quotid'],'datatype'=>$datatype));?>" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> 下级</a>
                      <a type="button" onclick="quoteadd(<?php echo ($v['quotid']); ?>);" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 编辑</a>
                      <a type="button" onclick="return confirm('确定删除?');" href="<?php echo U('Officweb/quotedel',array('id'=>$v['quotid']));?>" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span> 删除</a>
                    </td>
                 </tr><?php endforeach; endif; ?>
                 </tbody>
                 <tfoot>
                    <tr>
                      <td colspan="4">
                        <div class="pull-right">
                            <?php echo ($page); ?>
                        </div>
                      </td>
                    </tr>
                 </tfoot>
              </table>
            </div>

            </div>
          </div>
        </div> 
 </div>
</div>
<script type="text/javascript">
$(function(){
/*换肤*/
$(".dropdown .changecolor li").click(function(){
	var style = $(this).attr("id");
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+style+"']").removeAttr("disabled"); 

	$.cookie('mystyle', style, { expires: 7 }); // 存储一个带7天期限的 cookie 
})
var cookie_style = $.cookie("mystyle"); 
if(cookie_style!=null){ 
    $("link[title!='']").attr("disabled","disabled"); 
	$("link[title='"+cookie_style+"']").removeAttr("disabled"); 
} 
/*左侧导航栏显示隐藏功能*/
$(".subNav").click(function(){				
			/*显示*/
			if($(this).find("span:first-child").attr('class')=="title-icon glyphicon glyphicon-chevron-down")
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-down");
			    $(this).find("span:first-child").addClass("glyphicon-chevron-up");
			    $(this).removeClass("sublist-down");
				$(this).addClass("sublist-up");
			}
			/*隐藏*/
			else
			{
				$(this).find("span:first-child").removeClass("glyphicon-chevron-up");
				$(this).find("span:first-child").addClass("glyphicon-chevron-down");
				$(this).removeClass("sublist-up");
				$(this).addClass("sublist-down");
			}	
		// 修改数字控制速度， slideUp(500)控制卷起速度
	    $(this).next(".navContent").slideToggle(300).siblings(".navContent").slideUp(300);
	})
/*左侧导航栏缩进功能*/
$(".left-main .sidebar-fold").click(function(){

	if($(this).parent().attr('class')=="left-main left-full")
	{
		$(this).parent().removeClass("left-full");
		$(this).parent().addClass("left-off");
		
		$(this).parent().parent().find(".right-product").removeClass("right-full");
		$(this).parent().parent().find(".right-product").addClass("right-off");
		
		}
	else
	{
		$(this).parent().removeClass("left-off");
		$(this).parent().addClass("left-full");
		
		$(this).parent().parent().find(".right-product").removeClass("right-off");
		$(this).parent().parent().find(".right-product").addClass("right-full");
		
		}
	})	
 
  /*左侧鼠标移入提示功能*/
		$(".sBox ul li").mouseenter(function(){
			if($(this).find("span:last-child").css("display")=="none")
			{$(this).find("div").show();}
			}).mouseleave(function(){$(this).find("div").hide();})	
})
function quoteadd(id='')
{
	var datatype='<?=$datatype?>';
	var fid='<?=$fid?>';
	var href="";
	if (id=='') 
	{
		href="/Admin/Officweb/quoteinfo?datatype="+datatype+"&fid="+fid;
	}
	else
	{
		href="/Admin/Officweb/quoteinfo?id="+id+"&datatype="+datatype+"&fid="+fid;
	}
	layer.closeAll(); 
    layer.open({
      type: 2,
      title: '新增信息',
  	  shade: 0.6,
      shadeClose: true,
      maxmin: true, //开启最大化最小化按钮
      area: ['600px', '500px'],
      content: href
    });
}
</script>
</body>
</html>