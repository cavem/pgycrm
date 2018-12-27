<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo ($title); ?></title>
<link href="/Application/Home/View/Public/css/animate.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/bootstrap.min.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/bootstrap.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/jquery.range.css" rel="stylesheet">
<link href="/Application/Home/View/Public/css/style.css" rel="stylesheet">
<link href="http://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
<link rel="icon" href="/Application/Home/View/Public/images/pgyicon.png" />
<script src="/Application/Home/View/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/wow.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/prototype.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/slide.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/ImageSlide.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/jquery.range.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/layer/layer.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/md5.js" type="text/javascript"></script>
<script src="/Application/Home/View/Public/js/base64.js" type="text/javascript"></script>
<!-- 立即咨询 -->
<script>
$(function(){
    //立即咨询
    $('.askbtn').click(function(){
        $('.float-panel-middle').fadeIn();
    })
    $('.closetan').click(function(){
        $('.float-panel-middle').fadeOut();
    });
})
</script>
<!-- wow.js -->
<script>
    if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
        new WOW().init();
    };
</script>
<!-- 公告 -->
<?php if($current == 'index'): ?><script>
layer.open({
    type: 1
    ,title: false //不显示标题栏
    ,closeBtn: false
    ,area: '300px;'
    ,shade: 0.5
    ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
    ,btn: ['火速围观', '残忍拒绝']
    ,btnAlign: 'c'
    ,moveType: 1 //拖拽模式，0或者1
    ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">这是一个公告^_^</div>'
    ,success: function(layero){
        var btn = layero.find('.layui-layer-btn');
        btn.find('.layui-layer-btn0').attr({
        href: 'http://pgy.com/'
        ,target: ''
        });
    }
});
$(function(){
    $('.float-panel-middle').fadeIn();
    setInterval(function(){
        $('.float-panel-middle').fadeIn();
    },180000);
})

</script><?php endif; ?>
<!-- 左右悬浮 -->
<script>
    $(function(){
        $('.right-float').mouseenter(function(){
            $('.float-panel-right').fadeIn();
            $('#rfloat').css('width','400px');
        });
        $('#rfloat').mouseleave(function(){
            $('.float-panel-right').fadeOut();
            $('#rfloat').css('width','64px');
        });
        $('.left-float').mouseenter(function(){
            $('.float-panel-left').fadeIn();
            $('#rfloat').css('width','470px');
        });
        $('#lfloat').mouseleave(function(){
            $('.float-panel-left').fadeOut();
            $('#rfloat').css('width','64px');
        });
    })
</script>
<!-- home totop-->
<script>
  $(function(){
    $(window).scroll(function(){
      var scrtop=$(window).scrollTop();
      if(scrtop>50){
        $('.home').fadeIn();
      }else{
        $('.home').fadeOut();
      }
    });
    $('.home').click(function(){
      $('body,html').animate({scrollTop:0},300);
    })
  });
</script>
<!--banner-->
<script>
  $(function(){  
      var qcloud={};
      $('[_t_nav]').hover(function(){
          var _nav = $(this).attr('_t_nav');
          clearTimeout( qcloud[ _nav + '_timer' ] );
          qcloud[ _nav + '_timer' ] = setTimeout(function(){
          $('[_t_nav]').each(function(){
          $(this)[ _nav == $(this).attr('_t_nav') ? 'addClass':'removeClass' ]('nav-up-selected');
          });
          $('#'+_nav).stop(true,true).slideDown(200);
          }, 150);
      },function(){
          var _nav = $(this).attr('_t_nav');
          clearTimeout( qcloud[ _nav + '_timer' ] );
          qcloud[ _nav + '_timer' ] = setTimeout(function(){
          $('[_t_nav]').removeClass('nav-up-selected');
          $('#'+_nav).stop(true,true).slideUp(200);
          }, 150);
      });
  });    
</script>
<!-- news -->
<?php if($current == 'index'): ?><script>
    $(function(){
        $('#myCarousel').carousel({
            interval:5000
        });
        new ImageSlide({
            project:"#focusImage",
            content:".contents li",
            tigger:".triggers a",
            dot:".icon-dot a",
            watch:".link-watch",
            auto:!0,
            hide:!0
        })
        $('#wrap li').mouseenter(function(){
            $(this).find('.divA').stop().animate({bottom:'-66px'});
            $(this).find('.a2').css({left:'0'})
            $(this).children('.a2').find('.p4').css({left:'0'})
            $(this).children('.a2').find('.p5').css({left:'0'})
            $(this).children('.a2').find('.p6').css({transform:'scale(1)'})
            $(this).children('.a2').find('.p7').css({bottom:'25px'})
        })
        $('#wrap li').mouseleave(function(){
            $(this).find('.divA').stop().animate({bottom:'0px'});
            $(this).find('.a2').css({left:-$(this).width()})
            $(this).children('.a2').find('.p4').css({left:-$(this).width()})
            $(this).children('.a2').find('.p5').css({left:-$(this).width()})
            $(this).children('.a2').find('.p6').css({transform:'scale(1.3)'})
            $(this).children('.a2').find('.p7').css({bottom:'-50px'})
        })
        
    });
</script><?php endif; ?>
<!-- 云主机 -->
<?php if($current == 'cloudbuy'): ?><script>
  $(function(){
      var domain = window.location.host;
      var totalprice;
      var onthis=function(cthis){
          cthis.closest('.list').find('li').removeClass('onthis');
          cthis.addClass('onthis');
      }
      function getN(s){
        return s.replace(/[^0-9]/ig,"")  
      }  
      var configblock=function(isbuy){
          var cloudtype=$('.cloudtype').find('.onthis').data('val');
          var config=$('.config').find('.onthis').data('val').toString();
          var cpu=$('.cpu').find('.onthis').data('val').toString();
          var mmr=$('.mmr').find('.onthis').data('val');
          var ssd=$('.ssd').find('.onthis').data('val');
          var port=$('.port').val().toString();
          var ostype = $(".select-os").children('option:selected').val();
          switch(ostype){
              case "win":var os=$(".winselect").children('option:selected').text();var osid=$(".winselect").children('option:selected').val().toString();break;//osid ==
              case "linux":var os=$(".linuxselect").children('option:selected').text();var osid=$(".linuxselect").children('option:selected').val().toString();break;//osid ==
          }
        //   var shotbank=$("#shotbank").children('option:selected').val().toString();
        //   var fullbank=$("#fullbank").children('option:selected').val().toString();
          var ip=$('.ip').find('.onthis').data('val');
          var dur=$('.dur').find('.onthis').data('val').toString();

          var cloudtypetxt=$('.cloudtype').find('.onthis').text();
          var configtxt=$('.config').find('.onthis').text();
          var durtxt=$('.dur').find('.onthis').text();
          $('.p-config').text(cloudtypetxt+" "+configtxt+" "+cpu+"核(cpu) "+mmr+"G(内存) "+ssd+"(硬盘) "+port+"M(端口) "+os+"(系统) "+ip+"(ip) "+durtxt+"(时长)");
          if(isbuy==0){
            $('.totalprice').text('价格计算中...');
            $.post("http://"+domain+"/Home/Index/cloudbuyreq/",{'cloudtype':cloudtype,'config':config,'cpu':cpu,'mmr':mmr,'ssd':ssd,'port':port,'os':os,'ip':ip,'dur':dur},function(data,status){
                if(status=="success"){
                    $('.totalprice').text(data);
                    totalprice=data;
                }
            });
          }else{
            totalprice=totalprice.toString();
            var balance=$('.balance').val().toString();
            var userid=$('.userid').val();
            var ssdnum=getN(ssd).toString();
            var mmrm=(mmr*1024).toString();
            var ipnum=getN(ip).toString();
            var base = new Base64();
            if(userid==""){
                window.location.href="http://"+domain+"/Admin/login";
            }else if(osid=="--"){
                layer.msg('请选择系统镜像！', {
                    time: 2000,
                    //btn: ['确定','关闭']
                });
            }else if(parseInt(balance)<parseInt(totalprice)){
                layer.msg('余额不足！是否立即前往充值。', {
                    time: 20000,
                    btn: ['确定','关闭'],
                    yes:function(){
                        window.location.href="http://"+domain+"/Admin/Index/index";
                    }
                });
            }else{
                $.post("http://"+domain+"/Home/Index/isbuyreq/",{'userid':base.encode(userid),'cid':base.encode(config),'cpu':base.encode(cpu),'ram_max':base.encode(mmrm),'ram_min':base.encode('1024'),'disk':base.encode(ssdnum),'bandwidth':base.encode('0'),'port':base.encode(port),'osid':base.encode(osid),'additionalips':base.encode(ipnum),'totalprice':base.encode(totalprice),'dur':base.encode(dur)},function(data,status){
                    if(data=="success"){
                        console.log(data);
                        layer.msg('购买成功！请前往控制台查看', {
                            time: 2000,
                            //btn: ['确定','关闭']
                        });
                    }else{
                        console.log(data);
                        layer.msg('购买失败！', {
                            time: 2000,
                            //btn: ['确定','关闭']
                        });
                    }
                });
            }
            
          }
          
      }
      var init=function(){
          var cloudid=$('.cloudid').val();
          var configcid=$('.configcid').val();
          $('.cloudtype'+cloudid).addClass('onthis');
          $('.config'+configcid).addClass('onthis');
          $('.list').find('.otherul:eq(0)').find('li:eq(0)').addClass('onthis');
          switch(configcid){
              case '4':$('.dur:eq(1)').css('display','block');$('.dur:eq(0),.dur:eq(2)').css('display','none');
                       $('.durlist').find('li').removeClass('onthis');$('.durlist').find('.otherul:eq(1)').find('li:eq(0)').addClass('onthis');break;
              case '6':$('.dur:eq(2)').css('display','block');$('.dur:eq(0),.dur:eq(1)').css('display','none');
                       $('.durlist').find('li').removeClass('onthis');$('.durlist').find('.otherul:eq(2)').find('li:eq(0)').addClass('onthis');break;
            }
          configblock(0);
      }
      init();
      $('.otherul li').click(function(){
          var cthis=$(this);
          onthis(cthis);
          configblock(0);
      });
      $('.cloudtype li').click(function(){
          var keyid=$(this).data('val');
          window.location.href="http://"+domain+"/Home/Index/cloudbuy/id/"+keyid;
      });
      $('.config li').click(function(){
          var keycid=$(this).data('val');
          window.location.href="http://"+domain+"/Home/Index/cloudbuy/cid/"+keycid;
      });
      $('.single-slider').jRange({
          from: 0,
          to: 100,
          step: 1,
          scale: [0,25,50,75,100],
          format: '%s',
          width: 500,
          showLabels: true,
          showScale: true
      });
      $('.demo').mouseup(function(){
          setTimeout(function(){
            var port=$('.port').val();
            var minport=$('.port').data('minval');
            if(port<minport){
                window.location.reload();
            }
            configblock(0);
          },500)
      });
      $(".select-os").change(function(){  
          var val = $(this).children('option:selected').val();  
          switch(val){
              case 'win':$('.selewin').css('display','block');$('.selelinux').css('display','none');break;
              case 'linux':$('.selelinux').css('display','block');$('.selewin').css('display','none');break;
          }
      });
      $(".winselect,.linuxselect").change(function(){
          configblock(0);
      });
    //   $("#shotbank").change(function(){
    //       configblock(0);
    //   });
    //   $("#fullbank").change(function(){
    //       configblock(0);
    //   });
      $('.buybtn').click(function(){
          configblock(1);
      });
      $('.haveborder').mouseenter(function(){
          $(this).find('.title').css('background-color','#60aff6');
          $(this).find('.title span').css('color','#fff');
      });
      $('.haveborder').mouseleave(function(){
          $(this).find('.title').css('background-color','#ddd');
          $(this).find('.title span').css('color','#888');
      });
      $(window).scroll(function(){
          var docheight=$(window).height();
          var trpircetop=$("#tr-pirce").offset().top-$(window).scrollTop();
          
          if(trpircetop+90<docheight){
              $('.price-fix').css('display','none');
          }else{
              $('.price-fix').css('display','block');
          }
      });
  })
</script><?php endif; ?>
<!-- 关于 -->
<?php if($current == 'about'): ?><script>
    $(function(){
        var scrollToLocation=function(elemnet) {
            var mainContainer = $(elemnet);
            $('body,html').animate({
                scrollTop: mainContainer.offset().top-80
            }, 500);
        }
        
        var addcurrent=function(element){
            $('.ul-smbancon li').removeClass('currenton');
            element.addClass('currenton');
        }
        var scrollcheck=function(){
            var knowustop=$('#knowus').offset().top;
            var joinustop=$('#joinus').offset().top;
            var connectustop=$('#connectus').offset().top;
            var scrotop=$(window).scrollTop();
            if(scrotop>0&&scrotop<joinustop-90){
                addcurrent($('.know'));
            }else if(scrotop>joinustop-90&&scrotop<connectustop-90){
                addcurrent($('.join'));
            }else if(scrotop>connectustop-90){
                addcurrent($('.connect'));
            }
        }
        $('.know').click(function(){
            scrollToLocation('#knowus');
            addcurrent($('.know'));
        })
        $('.join').click(function(){
            scrollToLocation('#joinus');
            addcurrent($('.join'));
        })
        $('.connect').click(function(){
            scrollToLocation('#connectus');
            addcurrent($('.connect'));
        })
        $(window).scroll(function(){
            var scrtop=$(window).scrollTop();
            var sbtop=$('.small-banner').offset().top;
            if(scrtop>sbtop){
                $('.small-fixbanner').css('display','block');
            }else{
                $('.small-fixbanner').css('display','none');
            }
            scrollcheck();
        });
    })
</script><?php endif; ?>
<!-- 文档 -->
<?php if(($current == 'document')): ?><script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;
            var links = this.el.find('.link');
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }
    
        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
                $this = $(this),
                $next = $this.next();
    
            $next.slideToggle();
            $this.parent().toggleClass('open');
    
            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }	
    
        var accordion = new Accordion($('#accordion'), false);
        $('.accordioncontain-item').mouseenter(function(){
            $(this).css('background','#60aff6');
            $(this).find('i').css('color','#fff');
            $(this).find('.title').css('color','#fff');
        });
        $('.accordioncontain-item').mouseleave(function(){
            $(this).css('background','#fff');
            $(this).find('i').css('color','#60aff6');
            $(this).find('.title').css('color','#424242');
        });
    });
</script><?php endif; ?>
<!-- 下载 -->
<?php if(($current == 'download')): ?><script>
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;
            var links = this.el.find('.link');
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
        }
    
        Accordion.prototype.dropdown = function(e) {
            var $el = e.data.el;
                $this = $(this),
                $next = $this.next();
    
            $next.slideToggle();
            $this.parent().toggleClass('open');
    
            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            };
        }	
    
        var accordion = new Accordion($('#accordion'), false);
    });
</script><?php endif; ?>
</head>
<body>
<div class="nav_big">
    <div class="top w1200">
        <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/Application/Home/View/Public/images/logo.png" height="60px" width="200px"></a></div>
        <div class="head-v3">
            <div class="navigation-up">
              <div class="navigation-inner">
                <div class="navigation-v3">
                  <ul>
                    <li  _t_nav="home"><h2><a href="<?php echo U('Index/index');?>">首页</a></h2></li>
                    <li  _t_nav="product"><h2><a href="#">云产品</a></h2></li>
                    <li  _t_nav="server"><h2><a href="#">服务器托管与租用</a></h2></li>
                    <li  _t_nav="solution"><h2><a href="#">行业解决方案</a></h2></li>
                    <li  _t_nav="cooperate"><h2><a href="<?php echo U('Index/cooperate');?>">合作伙伴</a></h2></li>
                    <li _t_nav="support" class=""><h2><a href="#">公司</a></h2></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="navigation-down">
              <div id="product" class="nav-down-menu menu-1" style="display: none;" _t_nav="product">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>云服务器</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/cloud');?>">云服务器</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="http://yun.pgyidc.com/server/buy.html" target="blank">香港机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/serverbuy');?>">昊锐信息</a></dd>
                  </dl>
                  <dl>
                    <dt>云虚拟主机</dt>
                    <dd>
                      <a hotrep="hp.header.product.storage1" href="<?php echo U('Index/vhost');?>">云虚拟主机</a></dd>
                  </dl>
                </div>
              </div>
              <div id="server" class="nav-down-menu menu-1" style="display: none;" _t_nav="server">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>最新产品</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/newserver');?>">最新产品</a></dd>
                  </dl>
                  <dl>
                    <dt>自营机房</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/sqidc');?>">宿迁机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/jdidc');?>">京东机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/wzidc');?>">温州机房</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/gzidc');?>">广州机房</a></dd>
                  </dl>
                </div>
              </div>
              <div id="solution" class="nav-down-menu menu-1" style="display: none;" _t_nav="solution">
                <div class="navigation-down-inner w1200">
                    <dl style="margin-left: 35%;">
                      <dt>自助防御</dt>
                      <dd><a hotrep="hp.header.product.compute1" href="http://user.pgyidc.com" target="blank">自动防御系统</a></dd>
                    </dl>
                    <dl>
                      <dt>自动化管理</dt>
                      <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/sqidc');?>">自动化管理系统</a></dd>
                    </dl>
                </div>
              </div>
              <div id="support" class="nav-down-menu menu-1" style="display: none;" _t_nav="support">
                <div class="navigation-down-inner w1200">
                  <dl style="margin-left: 35%;">
                    <dt>关于我们</dt>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about');?>">了解我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#joinus');?>">加入我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/about/#connectus');?>">联系我们</a></dd>
                    <dd><a hotrep="hp.header.product.compute1" href="<?php echo U('Index/news');?>">新闻动态</a></dd>
                  </dl>
                  <dl>
                    <dt>文档中心</dt>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/document');?>">帮助文档</a></dd>
                    <dd><a hotrep="hp.header.product.storage1" href="<?php echo U('Index/download');?>">下载中心</a></dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
          <div class="login">
              <?php if($_SESSION['loginuser']== ''): ?><a href="<?php echo U('Admin/login');?>">登录</a><span>|</span><a href="<?php echo U('Admin/register');?>">注册</a>
                <?php else: ?><a href="">Hi! <?php echo ($_SESSION['loginuser']['username']); ?></a><span>|</span><a href="<?php echo U('Admin/Index/index');?>">控制台</a><?php endif; ?>
          </div>
    </div>
</div>
<style>
ol,ul,dl{margin-bottom: 0;}
.item{background-repeat:no-repeat;background-size:1920px 550px;background-position: top;}
.item-contain{animation-delay: 0.5s;position:absolute;left:20px;top:100px;text-align: left;}
.item-contain h1{color:#fff;font-size: 50px;}
.item-contain p{color: #fff;font-size: 25px;margin-top: 25px;}
h4{margin:0;}
.show-detail {width: 150px;height: 45px;line-height: 44px;float:left;margin: 35px auto 40px 0px;;text-align: center;font-size: 16px;color: #fff;border: 1px solid #fff;border-radius:5px;cursor: pointer;}
.show-detail:hover{border:1px solid #60aff6;background-color: #60aff6;}
</style>
<!--全屏滚动-->
<div id="myCarousel" class="carousel slide">
    <!-- 轮播（Carousel）指标 -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>   

    <!-- 轮播（Carousel）项目 -->
    <div class="carousel-inner">
        <div class="item active" style="background-image:url(/Application/Home/View/Public/images/banner_bg1.jpg);">
            <div style="position:relative;height:550px;width:70%;margin:0 auto;">
                <div class="item-contain wow fadeInLeft">
                    <h1>常州电信 百兆独享</h1>
                    <p>L5630x2 16G 120G   测试IP：43.248.177.1<br/>新年价：<span style="color:#ffe605;font-weight:bold;">880</span>元/月</p>
                    <a href="<?php echo U('Index/newserver');?>"><div class="show-detail">查看详情</div></a>
                </div>
            </div>
        </div>
        <div class="item" style="background-image:url(/Application/Home/View/Public/images/banner_bg2.jpg);">
            <div class="w1200" style="position:relative;height:550px;width:70%;margin:0 auto;">
                <div class="item-contain wow fadeInLeft">
                    <h1>开年大吉 升级大宽带</h1>
                    <p>【加量不加价】<br/><span style="text-decoration:line-through;opacity:.5;">标配300G高防/40M &nbsp;&nbsp;3000元/月&nbsp;</span><br/>标配300G高防/<span style="color:#ffe605;font-weight:bold;">100</span>M 3000元/月</p>
                    <a href="<?php echo U('Index/newserver');?>"><div class="show-detail">查看详情</div></a>
                </div>
            </div>
        </div>
        <div class="item" style="background-image:url(/Application/Home/View/Public/images/banner_bg3.jpg);">
            <div class="w1200" style="position:relative;height:550px;width:70%;margin:0 auto;">
                <div class="item-contain wow fadeInLeft">
                    <h1>云堤 — 中国电信网络安全</h1>
                    <p>电信云堤阻断国外后150G防御<br/>联通移动阻断国外后40G防御<br/>惊爆价：<span style="color:#ffe605;font-weight:bold;">1050</span>元/月</p>
                    <a href="<?php echo U('Index/newserver');?>"><div class="show-detail">查看详情</div></a>
                </div>
            </div>
        </div>
        <div class="item" style="background-image:url(/Application/Home/View/Public/images/banner_bg4.jpg);">
            <div class="w1200" style="position:relative;height:550px;width:70%;margin:0 auto;">
                <div class="item-contain wow fadeInLeft">
                    <h1>香港云服务器 全面上新</h1>
                    <p>高品质企业级云主机，免备案，畅通无阻</p>
                    <a href="http://yun.pgyidc.com"><div class="show-detail">查看详情</div></a>
                </div>
            </div>
        </div>
    </div>
    <!-- 轮播（Carousel）导航 -->
    <!-- <a class="carousel-control left" href="#myCarousel" data-slide="prev">‹</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">›</a> -->
</div>

<!--end 全屏滚动-->
<!--主打产品-->
<div class="free_composing pt50 pb50">
    <div class="free_composing_content w1200">
        <h3 class="content-group-title wow fadeInUp">我们的产品</h3>
        <!-- <div style="width:100%; margin:0 auto;"><img src="/Application/Home/View/Public/images/product_line.png"></div> -->
        <div class="mt50" style="width:100%;height:300px; margin:0 auto;">
            <div id="wrap">
                <ul>
                    <li>
                        <a href="" class="a1">
                            <img class="wow fadeInUp" src="/Application/Home/View/Public/images/index_cloud.png">
                            <div class="divA wow fadeInUp">
                                <p class="p1">云主机</p>
                                <p class="p2">2核/1G三线BGP单机80G防御 <span style="color:#ffe605;font-weight:bold;">300</span>元/月</br>简单方便实现对资源的部署，包括：IDC数据中心、服务器集群、业务平台...</p>
                            </div>
                        </a>
                        <a href="<?php echo U('Index/cloudbuy');?>" class="a2">
                            <p class="p4">云主机</p>
                            <p class="p5 tc"><b>2核/1G三线BGP单机80G防御 <span style="color:#ffe605;font-weight:bold;">300</span>元/月</b></br>简单方便实现对资源的部署，包括：IDC数据中心、服务器集群、业务平台...</p>
                            <p class="p7">立即购买</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="a1">
                            <img class="wow fadeInUp" src="/Application/Home/View/Public/images/index_rent.png">
                            <div class="divA wow fadeInUp">
                                <p class="p1">服务器租用</p>
                                <p class="p2">L5630*2/16G/120GSSD三线BGP100G防御<span style="color:#ffe605;font-weight:bold;">1200</span>元/月</br>标准机房环境，提供365天全天候运营服</p>
                            </div>
                        </a>
                        <a href="<?php echo U('Index/serverbuy');?>" class="a2">
                                <p class="p4">服务器租用</p>
                                <p class="p5"><b>L5630*2/16G/120GSSD三线BGP100G防御<span style="color:#ffe605;font-weight:bold;">1200</span>元/月</b></br>标准机房环境，提供365天全天候运营服</p>
                                <p class="p7">立即购买</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="a1">
                            <img class="wow fadeInUp" src="/Application/Home/View/Public/images/index_manage.png">
                            <div class="divA wow fadeInUp">
                                <p class="p1">服务器托管</p>
                                <p class="p2">1U单机防御100G/20M<span style="color:#ffe605;font-weight:bold;">550</span>元/月</br>华东地区第一家带防BGP，国家甲级机房，超级数据港。 专门技术人员7X24小时维护</p>
                            </div>
                        </a>
                        <a href="<?php echo U('Index/serverbuy');?>" class="a2">
                                <p class="p4">服务器托管</p>
                                <p class="p5"><b>1U单机防御100G/20M<span style="color:#ffe605;font-weight:bold;">550</span>元/月</b></br>华东地区第一家带防BGP，国家甲级机房，超级数据港。 专门技术人员7X24小时维护</p>
                                <p class="p7">立即购买</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="a1">
                            <img class="wow fadeInUp" src="/Application/Home/View/Public/images/index_idc.png">
                            <div class="divA wow fadeInUp" style="bottom: 0px;">
                                <p class="p1">常州机房</p>
                                <p class="p2">常州单电信百兆独享10G(防御) <span style="color:#ffe605;font-weight:bold;">880</span>元/月</p>
                            </div>
                        </a>
                        <a href="<?php echo U('Index/newserver');?>" class="a2" style="left: -474px;">
                            <p class="p4" style="left: -474px;">常州机房</p>
                            <p class="p5" style="left: -474px;"><b>常州单电信百兆独享10G(防御) <span style="color:#ffe605;font-weight:bold;">880</span>元/月</b></p>
                            <p class="p7" style="bottom: -50px;">立即购买</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <a href="<?php echo U('Index/sqidc');?>"><div class="show-more">查看全部</div></a>
    </div>
</div>
<!--我们的服务-->
<div class="free_composing pt50 pb50" style="background-color:#f9f9f9;">
    <div class="free_composing_content w1200">
        <h3 class="content-group-title wow fadeInUp">我们的服务</h3>
        <!-- <div style="width:100%; margin:0 auto;"><img src="/Application/Home/View/Public/images/product_line.png"></div> -->
        <div class="mt50" style="width:100%; margin:0 auto;">
            <div class="inner_wrap_big mt30 mb70">    
                <div class="inner_wrap">
                    <div class="inner_one">
                        <div class="inner_one_li">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/icon_01.png"></div>
                                <div class="inner_one_top_h2"><h2>自动开通</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>我们产品实现在线付款后实时开通，无需等待人工审核。</p></div>
                            
                        </div>
                        
                        <div class="inner_one_li">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/update.png"></div>
                                <div class="inner_one_top_h2"><h2>弹性升级</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>根据用户使用需求可随时进行云主机升级。</p></div>
                            
                        </div>
                        
                        <div class="inner_one_lii">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/free.png"></div>
                                <div class="inner_one_top_h2"><h2>免费试用</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>0元免费试用，先试用再购买，确保购买都是满意的产品。</p></div>
                            
                        </div><div class="clear"></div>
                    </div>
                    <div class="inner_middle">
                        
                    </div>
                    
                    <div class="inner_one">
                        <div class="inner_one_li">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/24h.png"></div>
                                <div class="inner_one_top_h2"><h2>技术响应</br>与技术支持</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>提供7x24技术支持，电话、工单支持，10分钟快速响应，我们7x24深度监控。</p></div>
                            
                        </div>
                        
                        <div class="inner_one_li">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/setup.png"></div>
                                <div class="inner_one_top_h2"><h2>故障修复</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>Uptime、ICMP、TCP port、CPU、RAM、HD免费短信、邮件告警，运行情况尽在掌握;值班音频告警，故障时间急速反映。任何故障问题，都将能在5小时之内处理完毕，让您没有后顾之忧。</p></div>
                            
                        </div>
                        
                        <div class="inner_one_lii">
                            <div class="inner_one_top wow fadeInUp">
                                <div class="inner_one_top_img"><img src="/Application/Home/View/Public/images/manage.png"></div>
                                <div class="inner_one_top_h2"><h2>自主管理</h2></div>
                            </div>
                            <div class="inner_one_bottom wow fadeInUp"><p>我们提供智云主机提供Web控制面板，用户可通过控制面板随时管理名下服务，实现自主管理。</p></div>
                            
                        </div><div class="clear"></div>
                    </div>
                </div>  
            </div>
        </div>
        <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800002004&aty=0&a=0&curl=&ty=1" target="_blank"><div class="show-more">立即咨询</div></a>
    </div>
</div>        
<!--新闻-->

<div class="free_composing pt50 pb50">
    <div class="free_composing_content w1200">
        <h3 class="content-group-title wow fadeInUp">资讯</h3>
        <!-- <div style="width:100%; margin:0 auto;"><img src="/Application/Home/View/Public/images/product_line.png"></div> -->
        <div class="mt50" style="width:100%; margin:0 auto;height:360px;background:#12273a;padding:10px 20px;">
            <dl class="fl listnews" style="border-right: 1px solid #ddd;">
                <!-- <dt><img style="display:inline-block;width:25px;margin-top:-10px;" src="/Application/Home/View/Public/images/hotnews.png"><h4 style="color:red;display:inline-block">行业资讯</h4></dt>                    -->
                <dd class="wow fadeInUp">
                    <div id="focusImage" class="newslider">
                        <ul class="contents">
                            <li class="current">
                                <div class="image"><a href="#"><img src="/Application/Home/View/Public/images/I180x143_1.jpg" width="400" height="282"></a></div>
                                <div class="text">
                                    <span class="title"><a href="#">蒲公英售后服务正式实行7*24小时制度</a></span>
                                    <p>由于虚拟化技术和云计算的大行其道，刀片服务器似乎也顺应这一大潮成为用户更青睐的硬件选择。但是刀片服务器机柜的市场终究还在起步阶段，刀片服务器的出货量在整个服务器产品中的份额比重并不大。</p>
                                </div>
                            </li>
                            <li class="">
                                <div class="image"><a href="#"><img src="/Application/Home/View/Public/images/I180x143_2.jpg" width="400" height="282"></a></div>
                                <div class="text">
                                    <span class="title"><a href="#">服务器市场刀片当道 那它的优势在哪里？</a></span>
                                    <p>从2017年5月2号之后，蒲公英网络有限公司客服售后时间正式实行7*24小时服务制度，节假日不休，365天全年在线服务，尽力满足各位客户的需求！各位上帝有什么事情尽情骚扰吧，售后QQ：800002004。</p>
                                </div>
                            </li>
                            <li class="">
                                <div class="image"><a href="#"><img src="/Application/Home/View/Public/images/I180x143_3.jpg" width="400" height="282"></a></div>
                                <div class="text">
                                    <span class="title"><a href="#">巨头联手打开市场新空间 边缘计算浮出水面</a></span>
                                    <p>据报道：五年之后的无人驾驶汽车，你并不会希望云端的数据来踩刹车。</p>
                                </div>
                            </li>
                        </ul>
                        
                        <div class="triggers">
                            <a href="javascript:;" class="cur current" style="display: none;"><img src="/Application/Home/View/Public/images/I180x143_1.jpg" width="58" height="38"></a>
                            <a href="javascript:;" class="" style="display: none;"><img src="/Application/Home/View/Public/images/I180x143_2.jpg" width="58" height="38"></a>
                            <a href="javascript:;" class="" style="display: none;"><img src="/Application/Home/View/Public/images/I180x143_3.jpg" width="58" height="38"></a>
                        </div>
                    
                        <div class="icon-dot">
                            <a href="javascript:;" class="cur current"></a>
                            <a href="javascript:;" class=""></a>
                            <a href="javascript:;" class=""></a>
                        </div>
                        
                        <span class="link-watch pre down" style="display: none;"></span>
                        <span class="link-watch next down" style="display: none;"></span>
                        
                    </div>
                </dd>                    
            </dl>
            <dl class="fl listnews">
                <!-- <dt style="position:relative;"><h4>公司动态</h4><a style="position:absolute;right:0;top:15px;color:#60aff6;">查看更多>></a></dt>                    -->
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=302" title="【公司公告】年会通知">【公司公告】年会通知 </a></dd>                    
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=301" title="【公司公告】通知">【公司公告】通知 </a></dd>                   
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=298" title="【公司公告】蒲公英售后服务正式实行7*24小时制度">【公司公告】蒲公英售后服务正式实行7*24小时制度 </a></dd>                  
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=296" title="【公司公告】2017年3月17日升级通知">【公司公告】2017年3月17日升级通知 </a></dd>                  
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=287" title="【公司公告】103.239.244段服务器延时通知">【公司公告】103.239.244段服务器延时通知 </a></dd>                    
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=285" title="【公司公告】2017年春节放假通知">【公司公告】2017年春节放假通知 </a></dd>                    
                <dd class="wow fadeInUp"><a target="_blank" href="news.html?nid=3&amp;id=283" title="【公司公告】2017年年会通知">【公司公告】2017年年会通知 </a></dd>
            </dl>
        </div>
        <a href="<?php echo U('Index/news');?>"><div class="show-more">查看全部</div></a>
    </div>
</div>        
<!--左右悬浮-->
<style>
    .float{
        position: fixed;
        width: 64px;
        height: 158px;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        background-color: #60aff6;
        text-align: center;
        top:0;
        bottom: 0;
        margin: auto;
    }
    .float img{
        width: 48px;
        margin: 8px 0 4px;
    }
    .float span{
        cursor: default;
        display: inline-block;
        width: 18px;
        font-size: 18px;
        color: #fff;
        line-height: 21px;
    }
    .float-panel{
        box-sizing: border-box;
        position: fixed;
        padding: 20px;
        background: #fff;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        z-index: 4;
    }
    /*right*/
    .right-float{
        right: 20px;
    }
    .float-panel-right{
        right: 100px;
        width: 320px;
        height: 224px;
        top: 0;
        bottom: 66px;
        margin: auto;
    }
    .float-panel-right .panel-content{
        min-height: 24px;
        padding-left: 0;
    }
    
    .float-panel-right .panel-content li{
        list-style: none;
        margin-bottom: 20px;
        text-align: left;
    }
    .float-panel-right .panel-content li:hover{
        background: #ece9e9;
    }
    .float-panel-right .panel-content .content-icon{
        width: 24px;
        height: 24px;
        display: inline-block;
        vertical-align: middle;
    }
    .float-panel-right .panel-content .content-icon img{
        width: 100%;
    }
    .float-panel-right .panel-content .content-main{
        display: inline-block;
        vertical-align: middle;
        margin-left: 12px;
        text-align: left;
    }
    .float-panel-right .panel-content .content-main .content-title{
        line-height: 24px;
    }
    .float-panel-right .panel-content .content-main .content-desc{
        color: #9b9ea0;
        font-size: 12px;
        line-height: 24px;
    }
    .float-panel-right .panel-content .content-main a{
        text-decoration: none;
        color: #5f6367;
        font-size: 14px;
    }
    /*left*/
    .left-float{
        left: 20px;
    }
    .float-panel-left{
        left: 100px;
        width: 470px;
        height: 224px;
        top: 0;
        bottom: 66px;
        margin: auto;
    }
    
    .float-panel-left ul li{
        text-align: left;
        padding: 5px 5px;
    }
    .float-panel-left ul li span{
        border: 1px solid #c1c2c3;
        margin-left: 10px;
        font-size: 15px;
        padding: 2px;
        cursor: pointer;
        border: 1px solid #60aff6;
        color: #60aff6;
        border-radius: 5px;
    }
    .float-panel-left ul li span:hover{
        background: #60aff6;
        color: #fff;
    }
    .float-panel-left ul li img{
        width: 15px;
        margin-top: -5px;
    }
    /*middle*/
    .float-panel-middle{
        position: fixed;
        background: #eee;
        padding: 20px;
        box-shadow: 0 6px 12px 0 rgba(0,0,0,.15);
        left: 0; top: 0; right: 0; bottom: 0;
        width: 470px;
        height: 240px;
        margin: auto;
        opacity: 0.9;
        z-index: 16;
    }
    
    .float-panel-middle ul li{
        text-align: left;
        padding: 5px 5px;
    }
    .float-panel-middle ul li span{
        border: 1px solid #c1c2c3;
        margin-left: 10px;
        font-size: 15px;
        padding: 2px;
        cursor: pointer;
        border: 1px solid #60aff6;
        color: #60aff6;
        border-radius: 5px;
    }
    .float-panel-middle ul li span:hover{
        background: #60aff6;
        color: #fff;
    }
    .float-panel-middle ul li img{
        width: 15px;
        margin-top: -5px;
    }
    /*弹窗*/
    .closetan{position: absolute;top: -15px;right: 0;font-size: 25px;}
    .closetan:hover{color: red;}
</style>
<div class="footer_above" style="width:100%;height:160px;background-image:url('/Application/Home/View/Public/images/footer-bg.jpg');">
    <p style="height:90px;line-height:100px;font-size:24px;color:#fff;">加入我们，立即开启您的互联网飞速之旅！</p>
    <a href="<?php echo U('Admin/register');?>" style="color:#60aff6;font-size:17px;" class="btn btn-default default-transition">免费注册</a>
</div>
<div class="footer_big">
	<div class="footer_content w1200">
        <div class="footer_left">
            <p>产品导航</p>
            <ul>
                <li><a href="<?php echo U('Index/cloud');?>">VPS云主机</a></li>
                <li><a href="<?php echo U('Index/vhost');?>">虚拟主机</a></li>
                <li><a href="<?php echo U('Index/newserver');?>">服务器租用</a></li>
                <li><a href="<?php echo U('Index/newserver');?>">服务器托管</a></li>
            </ul>
        </div>
        <div class="footer_left footer_service">
            <p>服务支持</p>
            <ul>
                <li class="qq">售后ＱＱ：800002004</li>
                <li class="phone">售后电话：0527-84224055转800</li>
                <li class="wechat">微信服务号: 扫描下方二维码</li>
                <li style="width:100px;height:100px;"><img src="/Application/Home/View/Public/images/ewm.jpg" width="100%"></li>
            </ul>
        </div>
        <div class="footer_left">
        	<p>服务承诺</p>
            <ul>
            	<li><a href="">用户政策</a></li>
                <li><a href="">服务条款</a></li>
                <li><a href="">隐私保护</a></li>
                <li><a href="">DMCA政策</a></li>
            </ul>
        </div>
        <div class="footer_left">
            <p>公司资质</p>
            <ul>
                <li>增值电信业务经营许可证</li>
                <li>电信与信息服务业务经营许可证</li>
                <li>电信业务审批[2008]字第888号</li>
                <li>ISO9001国际标准质量体系认证</li>
            </ul>
        </div>
        <div class="clear"></div>
        <p class="footer_bottom mt20" style="margin:0;padding:10px;border-top:1px solid #aaa;">
            <span style="color:#bbb;font-size:12px">Copyright ©2014 宿迁蒲公英网络 All Rights Reserved</br> ICP证：苏B2-20070043-1</span></br>
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=32130202080002" target="blank" style="color:#fff;font-size:13px"> <img src="/Application/Home/View/Public/images/20160331152326_4663.png">  备案号：苏公网安备 32130202080002号</a>
        </p>
    </div>

    <div id="rfloat" style="position:fixed;top:0;bottom:0;margin:auto;right:20px;width:84px;height:224px;z-index:999;">
        <div class="float right-float">
            <img class="button-background" src="/Application/Home/View/Public/images/service.png" alt="">
            <span>售后服务</span>
        </div>
        <div class="float-panel float-panel-right" style="display:none;">
            <ul class="panel-content">
                <li>
                    <div class="content-icon">
                        <img src="/Application/Home/View/Public/images/telephone.png" alt="">
                    </div>
                    <div class="content-main">
                        <a href="javascript:void(0);">
                            <div>
                                <div class="content-title">
                                    售后服务电话
                                </div>
                                <div class="content-desc">
                                    <span style="color: #ffe605;">0527-84224055转800</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
                <li data-spm-anchor-id="5176.8142029.762944.i3.e93976f4s5uTHh">
                    <div class="content-icon">
                        <img src="/Application/Home/View/Public/images/qq.png" alt="">
                    </div>
                    <div class="content-main">
                        <a target="_blank" href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800002004&aty=0&a=0&curl=&ty=1">
                            <div>
                                <div class="content-title">
                                    售后QQ
                                </div>
                                <div class="content-desc">
                                    24小时在线解答
                                </div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div id="lfloat" style="position:fixed;top:0;bottom:0;margin:auto;left:20px;width:84px;height:224px;z-index:999;">
        <div class="float left-float">
            <img class="button-background" src="/Application/Home/View/Public/images/service-2.png" alt="">
            <span>售前咨询</span>
        </div>
        <div class="float-panel float-panel-left" style="display:none;">
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6">售前咨询</h2>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391885&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售慧慧</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3004962426&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售小永</span></a>
                </li>
            </ul>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6;margin-top:20px;">投诉建议</h4>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002951580&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  投诉受理</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="float-panel-middle" style="display:none;">
        <div style="position: relative;">
            <div class="closetan"><i class="fa fa-times"></i></div>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6">售前咨询</h2>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391894&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售阿东</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391907&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售硕硕</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391890&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售宁宁</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002738725&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售吉祥</span></a>
                </li>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002725400&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售依一</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=2851391885&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售慧慧</span></a>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3004962426&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  销售小永</span></a>
                </li>
            </ul>
            <h4 style="text-align:left;margin-left:10px;line-height:25px;border-bottom:2px solid #60aff6;margin-top:20px;">投诉建议</h4>
            <ul>
                <li>
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=3002951580&site=qq&menu=yes"><span><img src="/Application/Home/View/Public/images/qq.png" alt="">  投诉受理</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="home" style="display:none;"><a href="javascript:void(0);"><img src="/Application/Home/View/Public/images/home.png"></a></div>
</div>
<?php if($current == 'about'): ?><script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6"></script>
<script type="text/javascript" src="https://api.map.baidu.com/getscript?v=2.0&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;services=&amp;t=20180323171755"></script>
<script type="text/javascript" src="/Application/Home/View/Public/js/pgymap.js"></script><?php endif; ?>
</body>
</html>