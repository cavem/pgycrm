<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<link href="/Public/font-awesome/css/font-awesome.min.css" rel="stylesheet" title="" type="text/css" />
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
               <p class="topbar-nav-item-title">用户中心</p>
               <ul>
                 <li><a href="<?php echo U('Userinfo/account');?>">
                     <span class="glyphicon glyphicon-usd"></span> 
                     <span class="">账户管理</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Userinfo/userinfo');?>">
                     <span class="glyphicon glyphicon-user"></span> 
                     <span class="">用户资料</span> 
                 </a>
                 </li>
                  <li><a href="<?php echo U('Userinfo/security');?>">
                     <span class="glyphicon glyphicon-fire"></span> 
                     <span class="">安全设置</span> 
                 </a>
                 </li>
                </ul>
               </div>
               
               
               
               <div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">物理机管理</p>
                  <ul>
                    <li><a href="<?php echo U('Officweb/cloudlist');?>">
                        <span class="fa fa-list"></span> 
                        <span class="">我的订单</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/serverlist');?>">
                        <span class="fa fa-server"></span> 
                        <span class="">我的服务器</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/physicslist');?>">
                        <span class="fa fa-list-alt"></span> 
                        <span class="">正在处理工单</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Officweb/serverlist');?>">
                        <span class="fa fa-eraser"></span> 
                        <span class="">攻击解封</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/physicslist');?>">
                        <span class="fa fa-file-text-o"></span> 
                        <span class="">攻击记录</span> 
                    </a>
                    </li>
                  </ul>
               </div>

               <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">官网管理</p>
                  <ul>
                    <li><a href="<?php echo U('Officweb/navlist');?>">
                        <span class="glyphicon glyphicon-th-list"></span> 
                        <span class="">导航列表</span> 
                    </a>
                    </li>
                     <li><a href="<?php echo U('Officweb/newslist');?>">
                        <span class="glyphicon glyphicon-list-alt"></span> 
                        <span class="">模块列表</span> 
                    </a>
                    </li>
                     <li><a href="<?php echo U('Officweb/memberlist');?>">
                        <span class="glyphicon glyphicon-user"></span> 
                        <span class="">会员信息</span> 
                    </a>
                    </li>
                   </ul>
                </div><?php endif; ?>

             </div>
             
             
             <div class="topbar-nav-col">

              <div class="topbar-nav-item">
                <p class="topbar-nav-item-title">云计算</p>
                <ul>
                  <li><a href="<?php echo U('Cloud/cloudmanage');?>">
                      <span class="glyphicon glyphicon-cloud"></span> 
                      <span class="">云主机管理</span> 
                  </a>
                  </li>
                </ul>
              </div>
               
              <div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">防火墙相关设置</p>
                  <ul>
                    <li><a href="<?php echo U('Officweb/cloudlist');?>">
                        <span class="fa fa-shield"></span> 
                        <span class="">金盾网页CC</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/serverlist');?>">
                        <span class="fa fa-fire-extinguisher"></span> 
                        <span class="">防火墙IP释放</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/physicslist');?>">
                        <span class="fa fa-file-o"></span> 
                        <span class="">域名白名单（宿迁）</span> 
                    </a>
                    </li>
                    <li><a href="<?php echo U('Officweb/serverlist');?>">
                        <span class="fa fa-file-o"></span> 
                        <span class="">域名白名单（扬州）</span> 
                    </a>
                    </li>
                  </ul>
               </div>

               <div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">防御相关设置</p>
                  <ul>
                    <li><a href="<?php echo U('Officweb/cloudlist');?>">
                        <span class="fa fa-minus-square"></span> 
                        <span class="">防御阻断</span> 
                    </a>
                    </li>
                  </ul>
               </div>

               <?php if($_SESSION['loginuser']['usertype']== 1): ?><div class="topbar-nav-item">
                  <p class="topbar-nav-item-title">产品管理</p>
                  <ul>
                    <li><a href="<?php echo U('Officweb/cloudlist');?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                        <span class="">云架构</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/serverlist');?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                        <span class="">物理架构</span> 
                    </a>
                    </li>
                      <li><a href="<?php echo U('Officweb/physicslist');?>">
                        <span class="glyphicon glyphicon-tags"></span> 
                        <span class="">物理价格</span> 
                    </a>
                    </li>
                  </ul>
               </div><?php endif; ?>

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
          <li><a href="<?php echo U('Index/exited');?>">退出</a></li>
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
       <div <?=empty($usercenter)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($usercenter)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">用户中心</span>
        </div>
        <ul class="navContent" style="<?=empty($usercenter)?"display:none":"display:block"?>">
          <li <?=empty($account)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />资金账户</div>
            <a href="<?php echo U('Userinfo/account');?>"><span class="sublist-icon glyphicon glyphicon-usd"></span><span class="sub-title">账户管理</span></a> </li>
          <li <?=empty($data)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />用户资料</div>
            <a href="<?php echo U('Userinfo/userinfo');?>"><span class="sublist-icon glyphicon glyphicon-user"></span><span class="sub-title">用户资料</span></a> </li>
            <li <?=empty($security)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />安全设置</div>
            <a href="<?php echo U('Userinfo/security');?>"><span class="sublist-icon glyphicon glyphicon-fire"></span><span class="sub-title">安全设置</span></a> </li>
          <!-- <li <?=empty($news)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />消息中心</div>
            <a href="message.html"><span class="sublist-icon glyphicon glyphicon-envelope"></span><span class="sub-title">消息中心</span></a> </li>
          <li <?=empty($cert)?'':"class='active'"?>>
            <div class="showtitle" style="width:100px;"><img src="" />实名认证</div>
            <a href="identify.html"><span class="sublist-icon glyphicon glyphicon-credit-card"></span><span class="sub-title">实名认证</span></a></li> -->
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
      <div class="sBox">
          <div <?=empty($physical)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($physical)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">物理机管理</span>
          </div>
          <ul class="navContent" style="<?=empty($physical)?"display:none":"display:block"?>">
            <li <?=empty($ordercontrol)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />我的订单</div>
              <a href="<?php echo U('Physical/ordercontrol');?>"><span class="sublist-icon fa fa-list"></span><span class="sub-title">我的订单</span></a></li>
            <li <?=empty($servercontrol)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />我的服务器</div>
              <a href="<?php echo U('Physical/servercontrol');?>"><span class="sublist-icon fa fa-server"></span><span class="sub-title">我的服务器</span></a></li>
            <li <?=empty($workingsheet)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />正在处理工单</div>
              <a href="<?php echo U('Physical/workingsheet');?>"><span class="sublist-icon fa fa-list-alt"></span><span class="sub-title">正在处理工单</span></a></li>
            <li <?=empty($attacktow)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />攻击解封</div>
              <a href="<?php echo U('Physical/attacktow');?>"><span class="sublist-icon fa fa-eraser"></span><span class="sub-title">攻击解封</span></a></li>
            <li <?=empty($attackrecord)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />攻击记录</div>
              <a href="<?php echo U('Physical/attackrecord');?>"><span class="sublist-icon fa fa-file-text-o"></span><span class="sub-title">攻击记录</span></a></li>
          </ul>
      </div>
      <div class="sBox">
          <div <?=empty($firewall)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($firewall)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">防火墙相关设置</span>
          </div>
          <ul class="navContent" style="<?=empty($firewall)?"display:none":"display:block"?>">
            <li <?=empty($goldenshield)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />金盾网页CC</div>
              <a href="<?php echo U('Firewall/goldenshield');?>"><span class="sublist-icon fa fa-shield"></span><span class="sub-title">金盾网页CC</span></a></li>
            <li <?=empty($blacklist)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />防火墙IP释放</div>
              <a href="<?php echo U('Firewall/blacklist');?>"><span class="sublist-icon fa fa-fire-extinguisher"></span><span class="sub-title">防火墙IP释放</span></a></li>
            <li title="域名白名单（宿迁）" <?=empty($whitelistadd)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />域名白名单（宿迁）</div>
              <a href="<?php echo U('Firewall/whitelistadd');?>"><span class="sublist-icon fa fa-file-o"></span><span class="sub-title">域名白名单（宿迁）</span></a></li>
            <li title="域名白名单（扬州）" <?=empty($whitelistaddyz)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />域名白名单（扬州）</div>
              <a href="<?php echo U('Firewall/whitelistaddyz');?>"><span class="sublist-icon fa fa-file-o"></span><span class="sub-title">域名白名单（扬州）</span></a></li>
          </ul>
      </div>
      <div class="sBox">
          <div <?=empty($blockabroadip)?"class='subNav sublist-up'":"class='subNav sublist-down'"?>><span <?=empty($blockabroadip)?"class='title-icon glyphicon glyphicon-chevron-up'":"class='title-icon glyphicon glyphicon-chevron-down'"?>></span><span class="sublist-title">防御相关设置</span>
          </div>
          <ul class="navContent" style="<?=empty($blockabroadip)?"display:none":"display:block"?>">
            <li <?=empty($baip)?'':"class='active'"?>>
              <div class="showtitle" style="width:100px;"><img src="" />防御阻断</div>
              <a href="<?php echo U('Blockabroadip/blockabroadip');?>"><span class="sublist-icon fa fa-minus-square"></span><span class="sub-title">防御阻断</span></a></li>
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
<style>
	.base-info{padding:0 10px;}
	.binfo-title{color: #09c;font-size: 15px;margin: 20px 0 10px 0;}
	.binfo-title .circle{width: 10px;height: 10px;background: #09c;border-radius: 10px;display: inline-block;}
	.binfo-panel p{display: inline-block;width: 180px;}
	.flabel{margin-left: 10px;}
</style>
  <div class="right-product view-product right-full">
    <div class="container-fluid">
		<div class="manage account-manage info-center">
			<div class="page-header">
				<div class="pull-left">
					<h4>用户资料</h4>      
				</div>
			</div>
			<div class="page-body">
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 账号信息</div>
					<div class="binfo-panel">
						<p><span class="flabel">登录账号：</span><span><?php echo ($userinfolist["username"]); ?></span></p>
						<p><span class="flabel">注册时间：</span><span><?php echo (date("y-m-d",$userinfolist["regtime"])); ?></span></p>
					</div>
				</div>
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 基本信息</div>
					<div class="binfo-panel">
						<p><span class="flabel">用户身份：</span>
							<span>
								<?php switch($userinfolist["company"]): case "": ?>个人用户<?php break;?>
									<?php default: ?>企业用户<?php endswitch;?>
							</span>
						</p>
						<p><span class="flabel">企业名称：</span><span><?php echo ($userinfolist["company"]); ?></span></p>
					</div>
				</div>
				<div class="base-info">
					<div class="binfo-title"><span class="circle"></span> 联系信息</div>
					<div class="binfo-panel">
						<p><span class="flabel">邮箱：</span><span><?php echo ($userinfolist["linkmail"]); ?></span></p>
						<p><span class="flabel">手机：</span><span><?php echo ($userinfolist["phone"]); ?></span></p>
					</div>
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
</script>
</body>
</html>