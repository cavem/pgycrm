<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <title>蒲公英网络CRM</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/Public/assets/images/crm.png"/>
    <link rel="stylesheet" href="/Public/assets/css/animate.css" />
    <link rel="stylesheet" href="/Public/layui/css/layui.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-style.css" />
    <link rel="stylesheet" href="/Public/assets/css/matrix-media.css" />
    <link href="/Public/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <script src="http://222.187.221.236:3000/socket.io/socket.io.js"></script>
  </head>
  <style>
    #breadcrumb{line-height: 38px;}
    #breadcrumb a{padding: 8px 12px;}
  .nav{margin-bottom: 0px;}
  .nav-tabs{border-bottom: 0px solid #fff;}
  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{font-size: 14px;color: #28b779 !important;border-top: 2px solid #28b779;font-size: 14px;background: #fff;}
  .tab-content{overflow: initial;}
  .closetab{color: #aaa;font-size: 14px;cursor: pointer;}
  .closetab:hover{color: #666;}
  #header{z-index:initial;}
  #header h1 a{display: initial;}
  .sideinout{cursor: pointer;color: #fff !important;margin-left:90px;}
  #sidebar{width: 200px;}
  #content{margin-left: 200px;}
  #myTabContent{background: #fff};
  .bdred{border-color: red !important;}
  </style>
  <body>
    <div id="header">
      <h1>
        <a href="dashboard.html">CRM</a>
        <a href="javascript:;" class="sideinout out"><i class="fa fa-outdent"></i></a>
      </h1>
    </div>
    <div id="user-nav" class="navbar navbar-inverse">
      <ul class="nav">
        <li class="dropdown" id="profile-messages">
          <a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle">
            <i class="fa fa-user"></i>&nbsp;
            <span class="text">欢迎你，<?php echo ($_SESSION['loginuser']['realname']); ?></span>&nbsp;
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a href="#">
                <i class="icon-user"></i>个人资料</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#">
                <i class="icon-check"></i>我的任务</a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="<?php echo U('Index/loginout');?>">
                <i class="icon-key"></i>退出系统</a>
            </li>
          </ul>
        </li>
        <li class="dropdown" id="menu-messages">
          <a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle">
            <i class="fa fa-envelope-o"></i>&nbsp;
            <span class="text">我的消息</span>&nbsp;
            <!-- <span class="label label-important">4</span>&nbsp; -->
            <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li>
              <a class="sAdd" title="" href="#">
                <i class="icon-plus"></i>新消息</a>
            </li>
            <li class="divider"></li>
            <li>
              <a class="sInbox" title="" href="#">
                <i class="icon-envelope"></i>收件箱</a>
            </li>
            <li class="divider"></li>
            <li>
              <a class="sOutbox" title="" href="#">
                <i class="icon-arrow-up"></i>发件箱</a>
            </li>
            <li class="divider"></li>
            <li>
              <a class="sTrash" title="" href="#">
                <i class="icon-trash"></i>回收站</a>
            </li>
          </ul>
        </li>
        <li class="">
          <a title="" href="#">
            <i class="fa fa-cog"></i>
            <span class="text js-edit-psw">&nbsp;修改密码</span></a>
        </li>
        <li class="">
          <a title="" href="<?php echo U('Index/loginout');?>">
            <i class="fa fa-sign-out"></i>
            <span class="text">&nbsp;退出系统</span></a>
        </li>
      </ul>
    </div>
    <div id="search">
      <input type="text" placeholder="搜索..." />
      <button type="submit" class="tip-bottom" title="Search">
        <i class="fa fa-search"></i>
      </button>
    </div>
    <!-- 侧边栏 -->
    <div id="sidebar" style="overflow-y: auto; overflow-x: hidden; height: 899px;">
      <ul style="width: 200px;">
        <li class="submenu active">
          <a class="menu_a" link="<?php echo U('Index/index2');?>" childid="index2"><i class="fa fa-home"></i><span>我的工作区</span></a>
        </li>
        <!-- 工单系统 -->
        <?php if($perm['工单系统']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-stack-overflow"></i><span>工单系统</span></a>
          <ul>
            <?php if($perm['工单系统']['我的工单']['this']): ?><li><a class="menu_a" link="<?php echo U('Workorder/myorder');?>" childid="myorder"><i class="fa fa-file-text-o"></i>我的工单</a></li><?php endif; ?>
            <?php if($perm['工单系统']['工单报表']['this']): ?><li><a class="menu_a" link="<?php echo U('Worktable/list');?>" childid="worktable"><i class="fa fa-table"></i>工单报表</a></li><?php endif; ?>
            <?php if($perm['工单系统']['回收站']['this']): ?><li><a class="menu_a" link="<?php echo U('Worktrash/list');?>" childid="worktrash"><i class="fa fa-trash"></i>回收站</a></li><?php endif; ?>
            <li><a class="menu_a" link="<?php echo U('Workorder/getfreeip');?>" childid="getfreeip"><i class="fa fa-product-hunt"></i>获取空闲IP</a></li>
          </ul>
        </li><?php endif; ?>
        <!-- 业务管理 -->
        <?php if($perm['业务管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-suitcase"></i><span>业务管理</span></a>
          <ul>
            <?php if($perm['业务管理']['服务器管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Service/list');?>" childid="server"><i class="fa fa-server"></i>服务器管理</a></li>
            <li><a class="menu_a" link="<?php echo U('Svcount/list');?>" childid="svcount"><i class="fa fa-bar-chart"></i>服务器数量统计</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 客户管理 -->
        <?php if($perm['客户管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-users"></i><span>客户管理</span></a>
          <ul>
            <?php if($perm['客户管理']['客户列表']['this']): ?><li><a class="menu_a" link="<?php echo U('Custom/list');?>" childid="custom"><i class="fa fa-list-ul"></i>客户列表</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 订单管理 -->
        <?php if($perm['订单管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-th-list"></i><span>订单管理</span></a>
          <ul>
            <?php if($perm['订单管理']['订单管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Order/list');?>" childid="order"><i class="fa fa-list-alt"></i>订单管理</a></li><?php endif; ?>
            <?php if($perm['订单管理']['订单统计']['this']): ?><li><a class="menu_a" link="<?php echo U('Order/census');?>" childid="order_census"><i class="fa fa-bar-chart"></i>订单统计</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 财务管理 -->
        <?php if($perm['财务管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-jpy"></i><span>财务管理</span></a>
          <ul>
            <?php if($perm['财务管理']['财务收入']['this']): ?><li><a class="menu_a" link="<?php echo U('Finan/list');?>" childid="finan"><i class="fa fa-linkedin-square"></i>财务收入</a></li><?php endif; ?>
            <?php if($perm['财务管理']['收款统计']['this']): ?><li><a class="menu_a" link="<?php echo U('Finan/census');?>" childid="finan_census"><i class="fa fa-bar-chart"></i>收款统计</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 人事管理 -->
        <?php if($perm['人事管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-sitemap"></i><span>人事管理</span></a>
          <ul>
            <?php if($perm['人事管理']['工作池管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Hapool/list');?>" childid="hapool"><i class="fa fa-th-large"></i>工作池管理</a></li><?php endif; ?>
            <?php if($perm['人事管理']['员工考核']['this']): ?><li><a class="menu_a" link="<?php echo U('Hastaffchk/list');?>" childid="hastaffchk"><i class="fa fa-pencil-square-o"></i>员工考核</a></li><?php endif; ?>
            <?php if($perm['人事管理']['主管考核']['this']): ?><li><a class="menu_a" link="<?php echo U('Haleadchk/list');?>" childid="haleadchk"><i class="fa fa-pencil-square-o"></i>主管考核</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 资源管理 -->
        <?php if($perm['资源管理']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-cubes"></i><span>资源管理</span></a>
          <ul>
            <?php if($perm['资源管理']['产品分类']['this']): ?><li><a class="menu_a" link="<?php echo U('Prokind/list');?>" childid="prokind"><i class="fa fa-pie-chart"></i>产品分类</a></li><?php endif; ?>
            <?php if($perm['资源管理']['产品管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Product/list');?>" childid="product"><i class="fa fa-archive"></i>产品管理</a></li><?php endif; ?>
            <?php if($perm['资源管理']['IP段管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Ipsegs/list');?>" childid="ipsegs"><i class="fa fa-product-hunt"></i>IP段管理</a></li><?php endif; ?>
            <?php if($perm['资源管理']['机房管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Room/list');?>" childid="room"><i class="fa fa-building-o"></i>机房管理</a></li><?php endif; ?>
            <?php if($perm['资源管理']['机柜管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Shelf/list');?>" childid="shelf"><i class="fa fa-tasks"></i>机柜管理</a></li><?php endif; ?>
            <?php if($perm['资源管理']['交换机管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Switches/list');?>" childid="switches"><i class="fa fa-hdd-o"></i>交换机管理</a></li><?php endif; ?>
            <?php if($perm['资源管理']['机器型号']['this']): ?><li><a class="menu_a" link="<?php echo U('Models/list');?>" childid="models"><i class="fa fa-question-circle-o"></i>机器型号</a></li><?php endif; ?>
            <?php if($perm['资源管理']['操作系统']['this']): ?><li><a class="menu_a" link="<?php echo U('Os/list');?>" childid="os"><i class="fa fa-windows"></i>操作系统</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 系统管理 -->
        <?php if($perm['系统管理']['this']): ?><li class="submenu">
          <a href="#">
            <i class="fa fa-cogs"></i><span>系统管理</span></a>
          <ul>
            <?php if($perm['系统管理']['部门管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Depart/list');?>" childid="depart"><i class="fa fa-window-restore"></i>部门管理</a></li><?php endif; ?>
            <?php if($perm['系统管理']['角色权限']['this']): ?><li><a class="menu_a" link="<?php echo U('Role/list');?>" childid="role"><i class="fa fa-exclamation-circle"></i>角色权限</a></li><?php endif; ?>
            <?php if($perm['系统管理']['账户管理']['this']): ?><li><a class="menu_a" link="<?php echo U('Account/list');?>" childid="account"><i class="fa fa-user-circle-o"></i>账户管理</a></li><?php endif; ?>
            <?php if($perm['系统管理']['账户等级']['this']): ?><li><a class="menu_a" link="<?php echo U('Level/list');?>" childid="level"><i class="fa fa-level-up"></i>账户等级</a></li><?php endif; ?>
            <?php if($perm['系统管理']['处理方式']['this']): ?><li><a class="menu_a" link="<?php echo U('Process/list');?>" childid="process"><i class="fa fa-hand-paper-o"></i>处理方式</a></li><?php endif; ?>
            <?php if($perm['系统管理']['日志查询']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-o"></i>日志查询</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 域名相关 -->
        <?php if($perm['域名相关']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-globe"></i><span>域名相关</span></a>
          <ul>
            <?php if($perm['域名相关']['宿迁域名过白']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-powerpoint-o"></i>宿迁域名过白</a></li><?php endif; ?>
            <?php if($perm['域名相关']['扬州域名过白']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-powerpoint-o"></i>扬州域名过白</a></li><?php endif; ?>
            <?php if($perm['域名相关']['域名黑名单']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-excel-o"></i>域名黑名单</a></li><?php endif; ?>
            <?php if($perm['域名相关']['非法域名']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-window-close"></i>非法域名</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 防火墙相关 -->
        <?php if($perm['防火墙相关']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-fire-extinguisher"></i><span>防火墙相关</span></a>
          <ul>
            <?php if($perm['防火墙相关']['金盾防护CC']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-cc"></i>金盾防护CC</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['金盾CC参数']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-cc"></i>金盾CC参数</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['金盾IP释放']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-outdent"></i>金盾IP释放</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['金盾黑名单']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-excel-o"></i>金盾黑名单</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['IP直通设置']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-product-hunt"></i>IP直通设置</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['IP直通记录']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-pencil"></i>IP直通记录</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['IP白名单']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file"></i>IP白名单</a></li><?php endif; ?>
            <?php if($perm['防火墙相关']['连接数查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-eye"></i>连接数查看</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 防御相关 -->
        <?php if($perm['防御相关']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-shield"></i><span>防御相关</span></a>
          <ul>
            <?php if($perm['防御相关']['防御设置']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-sliders"></i>防御设置</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防御区记录']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-pencil-square"></i>防御区记录</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-eye"></i>防护查看</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
        <!-- 牵引相关 -->
        <?php if($perm['牵引相关']['this']): ?><li class="submenu">
          <a href="#"><i class="fa fa-handshake-o"></i><span>牵引相关</span></a>
          <ul>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-bolt"></i>牵引状态</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-text-o"></i>攻击记录</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-anchor"></i>牵引策略</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-anchor"></i>牵引策略(电信)</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-sliders"></i>单IP牵引策略设置</a></li><?php endif; ?>
            <?php if($perm['防御相关']['防护查看']['this']): ?><li><a class="menu_a" link="error403.html"><i class="fa fa-file-text-o"></i>十分钟内攻击记录</a></li><?php endif; ?>
          </ul>
        </li><?php endif; ?>
      </ul>
    </div>
    <!-- 侧边栏 end -->
    <div id="content">
      <div id="content-header">
        <div id="breadcrumb">
            <ul id="myTab" class="nav nav-tabs" style="float: left;">
                <li class="active"><a href="#index2" data-toggle="tab"><i class="fa fa-home"></i>我的工作区</a></li>
            </ul>
            <a href="javascript:;" title="刷新" class="tip-bottom refresh" style="float: right;color: #28b779;padding: 0;"><i class="fa fa-refresh fa-2x"></i></a>
        </div>
      </div>
      <div id="myTabContent" class="tab-content">
        <div id="index2" class="tab-pane fade in active"><iframe src="<?php echo U('Index/index2');?>" class="iframe-main" frameborder='0' style="width:100%;"></iframe></div>
      </div>
    </div>
    <input type="hidden" class="fnids" value="">
    <script src="/Public/assets/js/jquery-3.3.1.js"></script>
    <script src="/Public/layui/layui.all.js"></script>
    <script src="/Public/assets/js/wow.min.js"></script>
    <script src="/Public/assets/js/jquery.ui.custom.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/assets/js/jquery.nicescroll.min.js"></script>
    <script src="/Public/assets/js/matrix.js"></script>
    <script>
        if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
            new WOW().init();
        };
    </script>
    <script type="text/javascript">//初始化相关元素高度
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
      function init() {
        $("body").height($(window).height() - 80);
        $(".iframe-main").height($(window).height() - 90);
        $("#sidebar").height($(window).height() - 50);
      }

      $(function() {
        init();
        $(window).resize(function() {
          init();
        });
        $('.refresh').click(function(){
            var src=$('#myTabContent').find('.active').find('iframe').attr('src');
            $('#myTabContent').find('.active').find('iframe').attr('src',src);
        })
        $('.sideinout').click(function(){
          if($(this).hasClass('out')){
            $('#sidebar').css("width","0px");
            $('#content').css("margin-left","0px");
            $(this).find('.fa').removeClass("fa-outdent");
            $(this).find('.fa').addClass("fa-indent");
            $(this).removeClass("out");
            $(this).addClass("in");
          }else{
            $('#sidebar').css("width","200px");
            $('#content').css("margin-left","200px");
            $(this).find('.fa').removeClass("fa-indent");
            $(this).find('.fa').addClass("fa-outdent");
            $(this).removeClass("in");
            $(this).addClass("out");
          }
        })
        //修改密码
        $('.js-edit-psw').click(function(){
          var confirm=function(index,layero){
              var body = layer.getChildFrame('body',index);
              var formdata = body.find('.mform').serialize();
              var isneed=0;
              var psw=body.find("input[name='psw']").val();
              var repsw=body.find("input[name='repsw']").val();
              body.find('.need').each(function(){
                  if($(this).closest('.form-line').find("input").val()==''){
                      $(this).closest('.form-line').find("input").addClass('bdred');
                      layer.msg("必填项不能为空");
                      isneed+=1;
                      return false;
                  }
              })
              if(psw!=repsw){
                layer.msg("两次输入密码不一致",{icon:2});
                body.find("input[name='repsw']").addClass('bdred');
              }else if(isneed==0){
                  layer.load();
                  $.post('/Index/editpsw',formdata,function(data,status){
                      if(data==0){
                          layer.msg('修改成功',{icon:1});
                          window.location.reload();
                      }else{
                          layer.msg('修改失败',{icon:2});
                          window.location.reload();
                      }
                  })
              }
          }
          myalert('修改密码','500px','300px',"<?php echo U('Index/editpsw');?>",confirm);
        })
        
      });

      // This function is called from the pop-up menus to transfer to
      // a different page. Ignore if the value returned is a null string:
      function goPage(newURL) {
        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-") {
            resetMenu();
          }
          // else, send page to designated URL            
          else {
            document.location.href = newURL;
          }
        }
      }

      // resets the menu selection upon entry to this page:
      function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
      }

      // uniform使用示例：
      // $.uniform.update($(this).attr("checked", true));
      </script>
<script type="text/javascript">
  (function () {
      window.CHAT = {
          init:function(){
              //连接websocket后端服务器
              this.socket = io.connect('ws://222.187.221.236:3000');

              //客户确认过工单后进入工单池->有新工单提醒
              this.socket.on('confirm', function(obj){
                  var room='<?=$room?>';
                  var s= room.indexOf(obj); 
                  if (s!='-1') 
                  {
                    //广播提醒
                    var borswer = window.navigator.userAgent.toLowerCase();
                    if ( borswer.indexOf( "ie" ) >= 0 )
                    {
                        //IE内核浏览器
                        var strEmbed = '<embed name="embedPlay" src="/Public/complete.mp3" autostart="true" hidden="true" loop="false"></embed>';
                        if ( $( "body" ).find( "#embedPlay" ).length <= 0 )
                          $( "body" ).append( strEmbed );
                        var embed = document.embedPlay;
                        //浏览器不支持 audion，则使用 embed 播放
                        embed.volume = 100;
                        //embed.play();这个不需要
                    } else
                    {
                        //非IE内核浏览器
                        var strAudio = "<audio id='audioPlay' src='/Public/complete.mp3' hidden='true'>";
                        if ( $( "body" ).find( "#audioPlay" ).length <= 0 )
                          $( "body" ).append( strAudio );
                        var audio = document.getElementById( "audioPlay" );

                        //浏览器支持 audion
                        audio.play();
                    } 
                  }
                  return false;
              });

              //技术接单
              this.socket.on('getorder', function(obj){
                  var username="<?=$username?>";
                  if (obj==username) 
                  {
                      //广播提醒
                      var borswer = window.navigator.userAgent.toLowerCase();
                      if ( borswer.indexOf( "ie" ) >= 0 )
                      {
                          //IE内核浏览器
                          var strEmbed = '<embed name="embedPlay1" src="/Public/getorder.mp3" autostart="true" hidden="true" loop="false"></embed>';
                          if ( $( "body" ).find( "#embedPlay1" ).length <= 0 )
                            $( "body" ).append( strEmbed );
                          var embed = document.embedPlay;

                          //浏览器不支持 audion，则使用 embed 播放
                          embed.volume = 100;
                          //embed.play();这个不需要
                      } else
                      {
                          //非IE内核浏览器
                          var strAudio = "<audio id='audioPlay1' src='/Public/getorder.mp3' hidden='true'>";
                          if ( $( "body" ).find( "#audioPlay1" ).length <= 0 )
                            $( "body" ).append( strAudio );
                          var audio = document.getElementById( "audioPlay1" );

                          //浏览器支持 audion
                          audio.play();
                      } 
                  }
                  return false;
              });

              //技术完成单子提醒客服确认
              this.socket.on('complete', function(obj){
                  var dept="<?=$dept?>";
                  if (obj==dept) 
                  {
                      //广播提醒
                      var borswer = window.navigator.userAgent.toLowerCase();
                      if ( borswer.indexOf( "ie" ) >= 0 )
                      {
                          //IE内核浏览器
                          var strEmbed = '<embed name="embedPlay2" src="/Public/ding.wav" autostart="true" hidden="true" loop="false"></embed>';
                          if ( $( "body" ).find( "#embedPlay2" ).length <= 0 )
                            $( "body" ).append( strEmbed );
                          var embed = document.embedPlay;

                          //浏览器不支持 audion，则使用 embed 播放
                          embed.volume = 100;
                          //embed.play();这个不需要
                      } else
                      {
                          //非IE内核浏览器
                          var strAudio = "<audio id='audioPlay2' src='/Public/ding.wav' hidden='true'>";
                          if ( $( "body" ).find( "#audioPlay2" ).length <= 0 )
                            $( "body" ).append( strAudio );
                          var audio = document.getElementById( "audioPlay2" );

                          //浏览器支持 audion
                          audio.play();
                      } 
                  }
                  return false;
              });
          }
      };
      CHAT.init();
  })();
</script>
  </body>

</html>