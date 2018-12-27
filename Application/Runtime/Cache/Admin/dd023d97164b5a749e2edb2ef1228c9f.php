<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<title>后台管理</title>
<link href="/Application/Admin/View/Public/css/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="login_box">
      <div class="login_l_img"><img src="/Application/Admin/View/Public/img/login-img.png" /></div>
      <div class="login">
          <div class="login_logo"><a href="#"><img src="/Application/Admin/View/Public/img/login_logo.png" /></a></div>
          <div class="login_name">
               <p>后台管理系统</p>
          </div>
          <form method="post" action="">
              <input id="uid" name="username" type="text" placeholder="用户名">
              <input id="pwd" name="password" type="password" id="password"  placeholder="密码"/>
              <input type="button" id="loginin" value="登录" style="width:100%;" />
          </form>
      </div>
      <div class="copyright">蒲公英网络科技有限公司 版权所有©2018-2020 技术支持电话：0527-84224055</div>
</div>
<script type="text/javascript" src="/Application/Admin/View/Public/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/layer/layer.js"></script>
<script type="text/javascript">
        document.onkeydown = function(e) {
            e = e || window.event;
            if(e.keyCode == 13) {
              $('#loginin').click();
            }
        }
        $(function () {
            $('#loginin').click(function () {
                var name = $('#uid').val();
                var pwd = $('#pwd').val();
                if (name == "" || pwd == "") 
                { 
                  layer.msg('用户名或密码不能为空', {icon: 5});
                  return false;
                }
                layer.msg('登录中...', {
                    icon: 16
                    ,shade: 0.01
                });
                $.ajax({
                  type: "POST",
                  url: "User/loginin",
                  data:"name="+name+"&pwd="+pwd,
                  success: function(msg){
                       if(msg==0)
                       {
                            window.location.href="index/index";
                            return false;
                       }
                       else if(msg==1)
                       {
                            layer.msg('登录失败，如有必要可联系管理员', {icon: 2});
                            return false;
                       }
                  }
             });
          })
      })
  </script>
</body>
</html>