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
<style type="text/css">
  /* table */
.main-table {
  /* margin-bottom: 10px; */
  /* width: 100%; */
  /* font-size: 12px; */
  /* color: #333; */
  /* border: 1px solid #e6e6e6; */
}
.main-table tr:hover {
  background-color: #e3f2fc;
}
.main-table th,
.main-table td {
  padding-left: 15px;
  text-align: left;
}
.main-table th {
  background-color: #f0f4f7;
  line-height: 32px;
  color: #666;
  border-left: 1px solid #e6e6e6;
}
.main-table td {
  padding-left: 15px;
  line-height: 35px;
  border-top: 1px solid #e6e6e6;
}
.main-table .style-stripe {
  background-color: #fafafa;
}
.multiple-table thead td {
  background-color: #F0F4F7;
  border-left: 1px solid #e6e6e6;
  line-height: 25px;
}
.border-left-none {
  border-left: 0;
}
</style>
</head>

<body>
<nav class="nav navbar-default navbar-mystyle navbar-fixed-top">
  <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
     <span class="icon-bar"></span> 
    </button>
    <a href="<?php echo U('Home/Index/index');?>"class="navbar-brand mystyle-brand"><span class="glyphicon glyphicon-home"></span></a> </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="li-border"><a class="mystyle-color" href="<?php echo U('Index/index');?>">管理控制台</a></li>
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
          <li><a href="<?php echo U('User/lout');?>">退出</a></li>
        </ul>
      </li>
      <!-- <li class="dropdown"><a href="#" class="dropdown-toggle mystyle-color" data-toggle="dropdown">换肤<span class="caret"></span></a>
        <ul class="dropdown-menu changecolor">
          <li id="blue"><a href="#">蓝色</a></li>
          <li class="divider"></li>
          <li id="green"><a href="#">绿色</a></li>
          <li class="divider"></li>
          <li id="orange"><a href="#">橙色</a></li>
        </ul>
      </li> -->
    </ul>
  </div>
</nav>
<div class="down-main">
  <div class="left-main left-full">
    <div class="sidebar-fold"><span class="glyphicon glyphicon-menu-hamburger"></span></div>
    <div class="subNavBox">
      <div class="sBox">
       <div class="subNav sublist-up"><span <?=empty($ddd)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">用户中心</span>
        </div>
        <ul class="navContent" style="display:none">
          <li>
            <div class="showtitle" style="width:100px;"><img src="" />账号管理</div>
            <a href="userinfo.html"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">账号管理</span></a> </li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="" />消息中心</div>
            <a href="message.html"><span class="sublist-icon glyphicon glyphicon-envelope"></span><span class="sub-title">消息中心</span></a> </li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="" />短信</div>
            <a href="smsInfo.html"><span class="sublist-icon glyphicon glyphicon-bullhorn"></span><span class="sub-title">短信</span></a></li>
          <li>
            <div class="showtitle" style="width:100px;"><img src="" />实名认证</div>
            <a href="identify.html"><span class="sublist-icon glyphicon glyphicon-credit-card"></span><span class="sub-title">实名认证</span></a></li>
        </ul>
      </div>
      <div class="sBox">
        <div <?=empty($cloud)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($cloud)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">云计算</span>
        </div>
        <ul class="navContent" style="<?=empty($cloud)?"display:none":"display:block"?>">
          <li <?=empty($cloudmanage)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />云主机管理</div>
            <a href="<?php echo U('Cloud/cloudmanage');?>"><span class="sublist-icon glyphicon glyphicon-cloud"></span><span class="sub-title">云主机管理</span></a></li>
        </ul>
      </div>   
      <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="sBox">
        <div <?=empty($guanwang)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($guanwang)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">官网管理</span></div>
        <ul class="navContent" style="<?=empty($guanwang)?"display:none":"display:block"?>">
          <li <?=empty($daohang)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">导航列表</div>
            <a href="<?php echo U('officweb/navlist');?>"><span class="sublist-icon glyphicon glyphicon-th-list"></span><span class="sub-title">导航列表</span></a></li>
          <li <?=empty($mokuai)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">模块列表</div>
            <a href="<?php echo U('officweb/newslist');?>"><span class="sublist-icon glyphicon glyphicon-list-alt"></span><span class="sub-title">模块列表</span></a></li>
          <li <?=empty($member)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">会员信息</div>
            <a href="<?php echo U('officweb/memberlist');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">会员信息</span></a></li>
        </ul>
      </div><?php endif; ?>
      <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="sBox">
        <div <?=empty($product)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($product)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">产品管理</span></div>
        <ul class="navContent" style="<?=empty($product)?"display:none":"display:block"?>">
          <li <?=empty($quote)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">云架构</div>
            <a href="<?php echo U('officweb/cloudlist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">云架构</span></a></li>
          <li <?=empty($server)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">物理架构</div>
            <a href="<?php echo U('officweb/serverlist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">物理架构</span></a></li>
          <li <?=empty($physics)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;">物理价格</div>
            <a href="<?php echo U('officweb/physicslist');?>"><span class="sublist-icon glyphicon glyphicon-tags"></span><span class="sub-title">物理价格</span></a></li>
        </ul>
      </div><?php endif; ?>
    </div>
  </div>
<link rel="stylesheet" type="text/css" href="/Application/Admin/View/Public/css/amazeui.min.css" />
<link rel="stylesheet" type="text/css" href="/Application/Admin/View/Public/css/main.css" />

  <div class="right-product right-full">
        <div class="center-back right-back">
        <div class="container-fluid">
          <div class="info-center">
                    <div class="page-header">
                      <div class="pull-left">
						<h4>余额充值</h4>      
					</div>
            </div>
            <form action="<?php echo U('Order/alipay');?>" method="post" id="doc-vld-msg">
              <div class="tr_rechbox">
                <div class="tr_rechhead">
                    <img src="/Application/Admin/View/Public/img/coin.png" alt="" style="width:20px;height: 20px"/>
                    <span>当前余额：<span>￥<?php echo ($balance); ?></span></span>
                </div>
                <div class="tr_rechoth am-form-group am-form-error"  style="clear:both;display: block;">
                  <span>充值金额：</span>
                  <input type="number" min="10" max="10000" value="10" name="money" class="othbox am-field-error am-active" data-validation-message="充值金额范围：10-10000元" pattern="^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$" required="required">
                  <font class="mytips">提示：充值金额范围：10-10000元</font> 
                </div>
                <div class="tr_rechcho am-form-group">
                  <span>充值方式：</span>
                  <label style="margin-right:30px;">
                      <input type="radio" name="radio1" value="0" checked>&nbsp;<img src="/Application/Admin/View/Public/img/zfbpay.png">
                  </label>
                  <!-- <label>
                      <input type="radio" name="radio1" value="1">&nbsp;<img src="/Application/Admin/View/Public/img/wechatpay.png">
                    </label> -->
                  
                </div>
              </div>
              <div class="tr_paybox">
                <input type="submit" value="确认支付" class="tr_pay am-btn" />
                <span>温馨提示：如充值过程中遇到问题请拨打客服联系电话。</span>
              </div>

            </form>
            <div class="clearfix"></div>
             
              
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
// function quoteadd(id='')
// {
// 	var datatype='<?=$datatype?>';
// 	var fid='<?=$fid?>';
// 	var href="";
// 	if (id=='') 
// 	{
// 		href="/Admin/Officweb/quoteinfo?datatype="+datatype+"&fid="+fid;
// 	}
// 	else
// 	{
// 		href="/Admin/Officweb/quoteinfo?id="+id+"&datatype="+datatype+"&fid="+fid;
// 	}
// 	layer.closeAll(); 
//     layer.open({
//       type: 2,
//       title: '新增信息',
//   	  shade: 0.6,
//       shadeClose: true,
//       maxmin: true, //开启最大化最小化按钮
//       area: ['600px', '500px'],
//       content: href
//     });
// }




</script>
</body>
</html>
<script type="text/javascript">

  $(function() {
    $('#doc-vld-msg').validator({
      onValid: function(validity) {
        $(validity.field).closest('.am-form-group').find('.am-alert').hide();
      },
      onInValid: function(validity) {
        var $field = $(validity.field);
        var $group = $field.closest('.am-form-group');
        var $alert = $group.find('.am-alert');
        // 使用自定义的提示信息 或 插件内置的提示信息
        var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

        if(!$alert.length) {
          $alert = $('<div class="am-alert am-alert-danger"></div>').hide().
          appendTo($group);
        }
        $alert.html(msg).show();
      }
    });
  });
</script>