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
<link href="/Application/Admin/View/Public/css/product.css" rel="stylesheet" title="" type="text/css" />
</script>

  <div class="right-product right-full">
        <div class="center-back right-back">
        <div class="container-fluid">
          <div class="info-center">
                    <div class="page-header">
                      <div class="pull-left">
						<h4>云服务器</h4>      
					</div>
            <div class="pull-right">
                <button type="button" class="btn btn-mystyle btn-sm">搜索</button>
                <button type="button" onclick="window.history.go(-1);" class="btn btn-mystyle btn-sm">返回</button>
            </div>
            </div>
            
            <div class="table-tab" id="userBizTables">
              <ul>
                <li class="table-tab--current" data-tab_id="t1">基本设置</li>
                <li data-tab_id="t2">产品价格</li>
              </ul>
            </div>
            <form action="<?php echo U('Officweb/cloudadd');?>" method="post">
              <input name="id" type="hidden" value="<?php echo ($cid); ?>"/>
              <input name="fid" type="hidden" value="<?php echo ($fid); ?>"/>
              <div class="" id="t1">
                <div class="content-block">
                  <div class="content-block-title">
                    基础资料
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>所属分组：</th>
                      <td>
                        <select name="navdata" class="input" style="width: 180px;" <?=!empty($fid)?"disabled='disabled'":''?>>
                          <?php if(is_array($clst)): foreach($clst as $key=>$c): ?><option value="<?php echo ($c["id"]); ?>" <?=$c['id']==$fid?"selected":''?>><?php echo ($c["title"]); ?></option><?php endforeach; endif; ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th>线路名称：</th>
                      <td><input type="text" name="name" class="input" value="<?php echo ($info["title"]); ?>"/>
                      </td>
                    </tr>
                    <!-- <tr>
                      <th>显示状态：</th>
                      <td>
                        <label class="first-label" for="visible_1">
                          <input type="radio" name="status" id="visible_1" value="1" checked />
                          显示
                        </label>
                        <label for="visible_0">
                          <input type="radio" name="status" id="visible_0" value="0" />
                          隐藏
                        </label>
                      </td>
                    </tr> -->
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    带宽
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>

                    <tr>
                      <th>带宽最小：</th>
                      <td><input type="text" name="bandwidthmin" onkeypress="return event.keyCode>=48&&event.keyCode<=57" class="input input-short" value="<?php echo ($info["bwmin"]); ?>"/> M
                      </td>
                    </tr>

                    <tr>
                      <th>带宽最大：</th>
                      <td><input type="text" name="bandwidthmax" onkeypress="return event.keyCode>=48&&event.keyCode<=57" class="input input-short" value="<?php echo ($info["bwmax"]); ?>"/> M
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>

                <div class="content-block">
                  <div class="content-block-title">
                    存储
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>存储类型：</th>
                      <td>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="storage1" value="30G" <?=empty($info['mu1'])?'':'checked'?> style="margin-top: .9em"> 30G
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox"  name="storage2" value="50G" <?=empty($info['mu2'])?'':'checked'?> style="margin-top: .9em"> 50G
                        </label>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>

                <div class="content-block">
                  <div class="content-block-title">
                    IP
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>地址个数：</th>
                      <td>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox1" name="ip1" value="1个" <?=empty($info['ip1'])?'':'checked'?> style="margin-top: .9em"> 1个
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="inlineCheckbox2" name="ip2" value="2个" <?=empty($info['ip2'])?'':'checked'?> style="margin-top: .9em"> 2个
                        </label>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-relate" id="t2">
                <div class="content-block">
                  <div class="content-block-title">
                    核心价格
                    <span class="row-title">(直接填入数字，单位 元/月)</span>
                  </div>
                  <table id="server_list_table" width="100%" border="0" cellspacing="0" cellpadding="0"
                         class="main-table main-table-stripe">
                    <thead>
                    <tr>
                      <th></th>
                      <th>1G</th>
                      <th>2G</th>
                      <th>4G</th>
                      <th>8G</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>2核</td>
                      <td><input type="text" name="corePrice_2_1" class="input input-short"
                                 value="<?php echo ($info["core21"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_2" class="input input-short"
                                 value="<?php echo ($info["core22"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_4" class="input input-short"
                                 value="<?php echo ($info["core24"]); ?>"/></td>
                      <td><input type="text" name="corePrice_2_8" class="input input-short"
                                 value="<?php echo ($info["core28"]); ?>"/></td>
                    </tr>
                    <tr>
                      <td>4核</td>
                      <td><input type="text" name="corePrice_4_1" class="input input-short"
                                 value="<?php echo ($info["core41"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_2" class="input input-short"
                                 value="<?php echo ($info["core42"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_4" class="input input-short"
                                 value="<?php echo ($info["core44"]); ?>"/></td>
                      <td><input type="text" name="corePrice_4_8" class="input input-short"
                                 value="<?php echo ($info["core48"]); ?>"/></td>
                    </tr>
                    <tr>
                      <td>8核</td>
                      <td><input type="text" name="corePrice_8_1" class="input input-short"
                                 value="<?php echo ($info["core81"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_2" class="input input-short"
                                 value="<?php echo ($info["core82"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_4" class="input input-short"
                                 value="<?php echo ($info["core84"]); ?>"/></td>
                      <td><input type="text" name="corePrice_8_8" class="input input-short"
                                 value="<?php echo ($info["core88"]); ?>"/></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    线路价格
                  </div>
                  <table class="inner-table edit-table">
                    <tr>
                      <th width="100px">价格：</th>
                      <td><input type="text" name="lineprice" class="input input-short" value="<?php echo ($info["line"]); ?>"/> 元/月
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    端口价格
                  </div>
                  <table class="inner-table edit-table">
                    <tr>
                      <th width="100px">价格：</th>
                      <td><input type="text" name="portprice" class="input input-short" value="<?php echo ($info["port"]); ?>"/> 元/月/M
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    硬盘价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>价格：</th>
                      <td>
                        <input type="text" name="ssdprice" class="input input-short" value="<?php echo ($info["ssd"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    IP价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>价格：</th>
                      <td>
                        <input type="text" name="ipprice" class="input input-short" value="<?php echo ($info["ip"]); ?>"/> 元/月/个
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    备份集价格
                  </div>
                  <table class="inner-table edit-table">
                    <tbody>
                    <tr>
                      <th>快照备份价格：</th>
                      <td>
                        <input type="text" name="snapshotprice" class="input input-short" value="<?php echo ($info["snapshot"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    <tr>
                      <th>完整备份价格：</th>
                      <td>
                        <input type="text" name="fullprice" class="input input-short" value="<?php echo ($info["full"]); ?>"/> 元/月/G
                      </td>
                      <td>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <div class="content-block">
                  <div class="content-block-title">
                    销售折扣
                    <table class="inner-table edit-table">
                      <tbody>
                      <tr>
                        <th>销售折扣：</th>
                        <td><input type="text" name="discount" class="input input-short"
                                   value="<?php echo ($info["discount"]); ?>"/>
                          <span class="row-title">注：销售折扣，如0.2则是原价乘于0.2销售。1表示不打折，0则0元销售</span>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div id="bt" style="border-top:1px solid #e6e6e6;margin-bottom:2em;">
                <!-- <div class="content-block-title">后台操作保护</div> -->
                <table class="inner-table edit-table">
                  <tbody>
                  <!-- <tr>
                    <th>管理员密码：</th>
                    <td><input type="password" name="password" class="password input"
                               tabindex="2"/>
                    </td>
                  </tr> -->
                  <tr>
                    <th></th>
                    <td>
                      <input type="submit" value="确定修改" class="btn btn-primary submit ajax-submit"/>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>

            </form>
            </div>
          </div>
        </div> 
 </div>
</div>
<style>
	label{width: 100px;text-align: right;display: inline-block;}
</style>
<script>
$(function(){
	/**
	 * 修改密码
	 */
    //old-input光标离开事件
    $("#old-password").blur(function(){
        var oldpwd=$(this).val();
        $.post('pwchange',{'oldpwd':oldpwd},function(data,status){
            if(data=='incorrect'){
                $(".oldtip").text('请输入正确密码');
            }else{
                $(".oldtip").text('');
            }
        });
    });
    //new-input光标离开事件
    $("#new-password").blur(function(){
        var newpwd=$(this).val();
        if(newpwd.length<8||newpwd.length>16){
            $(".newtip").text('请输入8至16位字符的密码');
        }else{
            $(".newtip").text('');
        }
    });
    //conf-input输入事件
    $("#conf-password").bind('input propertychange',function(){
        var confpwd=$(this).val();
        var newpwd=$("#new-password").val();
        if(confpwd!=newpwd){
            $(".conftip").text('两次输入的密码不一致');
        }else{
            $(".conftip").text('');
        }
    });
    //保存
    $(".btn-savepass").click(function(){
		layer.msg('请稍等', {icon: 16,shade: 0.01});
        var oldpwd=$("#old-password").val();
        var newpwd=$("#new-password").val();
        var confpwd=$("#conf-password").val();
        if(oldpwd==''||newpwd==''||confpwd==''){
            layer.msg('<p style="color:#fff">填写有误，请按提示重新填写</p>', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else if($(".oldtip").text()!=''){
            layer.msg('<p style="color:#fff">旧密码填写错误</p>', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else if($(".newtip").text()!=''){
            layer.msg('<p style="color:#fff">密码格式不正确</p>', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else if($(".conftip").text()!=''){
            layer.msg('<p style="color:#fff">两次输入的密码不一致</p>', {
                time: 1000, //1s后自动关闭
                //btn: ['']
            });
        }else{
            $.post("pwchange",{'newpwd':newpwd},function(data,status){
                if(data=="success"){
                    layer.closeAll(); 
                    layer.msg('修改成功', {icon: 1});
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                }
            });
        }
	});
	/**
	 * 修改手机号
	 */
	//获取验证码
	$('.getcode').click(function(){
		var dnum=60;
		var inter=setInterval(function(){
			dnum=dnum-1;
			if(dnum>=0){
				$('.getcode').html(dnum+'s后重新获取');
			}else{
				clearInterval(inter);
				$('.getcode').html('获取验证码');
			}
		},1000);
	})
})
</script>
<!-- 模态框 修改密码 -->
<div class="modal fade" id="pwModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">
					修改密码
				</h4>
			</div>
			<div class="modal-body">
				<div style="width: 460px;margin: 0 auto;">
					<p><label for="old-password">旧密码：</label><input id="old-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请输入旧密码"><span class="oldtip" style="padding-left: 20px;color:red"></span></p>
					<p><label for="new-password">新密码：</label><input id="new-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请输入新密码"><span class="newtip" style="padding-left: 20px;color:red"></span></p>
					<p><label for="conf-password">确认密码：</label><input id="conf-password" class="form-control" style="width: 170px;display: inline-block;" type="password" placeholder="请再次输入新密码"><span class="conftip" style="padding-left: 20px;color:red"></span></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭
				</button>
				<button type="button" class="btn btn-primary btn-savepass">
					提交更改
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<!-- 模态框 更改手机号 -->
<div class="modal fade" id="phModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						更改手机号
					</h4>
				</div>
				<div class="modal-body">
					<div style="width: 460px;margin: 0 auto;">
						<p><label for="old-password">手机号：</label><input id="phonenum" class="form-control" style="width: 172px;display: inline-block;" type="text" placeholder="请输入手机号"><span class="phonetip" style="padding-left: 20px;color:red"></span></p>
						<p><label for="new-password">验证码：</label><input id="checkcode" class="form-control" style="width: 80px;display: inline-block;" type="text" placeholder="验证码">
							<span class="getcode" style="font-size: 14px;padding: 8px 8px;border: 1px solid #ccc;border-radius: 4px;color: #337ab7;cursor: pointer;">获取验证码</span><span class="codetip" style="padding-left: 20px;color:red"></span>
						</p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭
					</button>
					<button type="button" class="btn btn-primary btn-savepass">
						提交更改
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
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
<script>
  $(function () {
    $('#userBizTables ul li').click(function(e) {
        var tabid=$(this).attr('data-tab_id');
        $("#"+tabid).removeClass("tab-relate");
        $("#"+tabid).siblings().addClass("tab-relate");
        $(this).addClass("table-tab--current");
        $(this).siblings().removeClass("table-tab--current");
        $("#bt").removeClass("tab-relate");
    })
    // NY.component.initTableTab("#userBizTables");
    // $('.tabs .tab').tabs();

    // $(".radioItem").change(function () {
    //   var $_selectedValue = $("input[name='type']:checked").val();
    //   $(".tab-item").hide();
    //   $("#" + $_selectedValue).show();
    // });

  });
  // 三个密码框“同步”密码
  $(function () {
    $('.password').change(function () {
      $('.password').val($(this).val());
    })
  })
</script>