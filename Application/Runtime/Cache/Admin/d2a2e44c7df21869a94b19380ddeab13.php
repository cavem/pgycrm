<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>后台管理</title>
<link href="/Application/Admin/View/Public/css/common.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="login_box">
      <div class="login_l_img"><img src="/Application/Admin/View/Public/img/login-img.png" /></div>
      <div class="login">
          <div class="login_logo"><a href="#"><img src="/Application/Admin/View/Public/img/login_logo.png" /></a></div>
          <div class="login_name">
               <p>后台管理系统</p>
          </div>
    <form class="form-horizontal" role="form" method="post" name="mform" onsubmit="return check();">
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>用户类型：</span>
        <div class="tab-switch-component">
                            <span id="Firm"
                                  class="tab-switch  active ">企业用户</span>
            <span id="self"
                  class="tab-switch ">个人用户</span>
        </div>
    </div>
    <input type="hidden" name="cusType" id="cusTypeSbmData"
           value="Firm"/>
            <input type="hidden" name="cusSource" value="webRegister"/>
        <div class="form-group" id="contactName" style="">
        <span class="label"><font class="color-primary mr5">*</font>企业名称：</span>
        <input placeholder="请输入企业名称" id="cusName" name="cusName" type="text" value=""
               class="input-text"/>
                    </div>
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>您的称呼：</span>
        <input placeholder="请输入您的称呼" name="nickname" type="text" value=""
               class="input-text"/>
                    </div>
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>电子邮箱：</span>
        <input placeholder="请输入电子邮箱" id="email" name="email" type="email" value=""
               class="input-text"/>
                <p class="lineh24 color-tips">注册成功后，电子邮箱将作为平台的登录账号</p>
    </div>
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>密码：</span>
        <input placeholder="密码至少8位，并包括大小写字母及数字" id="password" name="password" type="password" class="input-text"/>
            </div>
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>确认密码：</span>
        <input placeholder="请再次输入登录密码" type="password" id="password_confirmation" name="password_confirmation" class="input-text"/>
            </div>
    <!-- <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>验证类型：</span>
        <div class="tab-yz">
            <span id="emailyz" class="tab-s  active ">邮箱验证</span>
            <span id="phoneyz" class="tab-s ">短信验证</span>
        </div>
    </div> -->
    <div class="form-group">
        <span class="label"><font class="color-primary mr5">*</font>联系手机：</span>
        <input placeholder="请输入手机号码" type="text" id="mobile" name="mobile" class="input-text" />
            </div>
    <div class="form-group">
        <span class="label" ><font class="color-primary mr5">*</font>验证码：</span>
        <input placeholder="请输入短信验证码" type="text" name="phoneCaptcha" id="verifyCode" value="" class=" input-yz" />
        <div class="fr btn action-btn active btn-yz" id="J_getCode" onclick="yzcode();" style="height:30px;padding-top:2px;">获取验证码</div>   
    </div>
    <div class="mt15">
        <p id="formtips" style="text-align: center;color:#FF0000"></p>
        <input type="submit" value="注册" id="register" class="button button-primary" style="line-height:18px" />
        <input type="hidden" name="crmid" id="crmid" />
    </div>
    <div class="mt15">
        <a href="<?php echo U('User/login');?>">已有账号登录</a>
    </div>
</form>
      </div>
      <div class="copyright">蒲公英网络科技有限公司 版权所有©2018-2020 技术支持电话：0527-84224055</div>
      <script type="text/javascript" src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js"></script>
      <script type="text/javascript" src="/Public/layer/layer.js"></script>
      <script src="/Application/Admin/View/Public/script/register.js"></script>
</div>
</body>
</html>