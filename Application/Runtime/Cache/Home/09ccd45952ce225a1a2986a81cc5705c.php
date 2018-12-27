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
    .show-more{border:1px solid #fff;color:#fff;display: inline-block;}

    .about{padding:20px 0;background: #f2f2f2;};
    .small-banner{background:#dedfe4;}
    .small-fixbanner{background-color:#dedfe4;display: none;position: fixed;top: 0;left: 0;width: 100%;z-index:999;}
    .ul-smbancon{height: 60px;line-height: 60px;}
    .ul-smbancon li{display: inline-block;font-size: 16px;margin:0 50px 0 50px;cursor: pointer;}
    .currenton{color: #60aff6}
    .joinuscontain p,.knowuscontain p{text-align: left;line-height: 2em;font-size: 14px;color:#4b556a}
    .connectcontain{height: 250px;margin-top: 20px;}
    .connectcontain-item{width:24%;height: 250px;padding: 25px;margin-left:9px;float: left;}
    /* .connectcontain-item:hover{border:1px solid #60aff6;box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(96,175,246,.5);} */
    .connectcontain-item img{margin-top: 30px;}
    .connectcontain-item .title{color: #60aff6;font-size: 16px;margin-top:30px;}
    .connectcontain-item .contain{color: #999;font-size: 12px;line-height: 2em;}

</style>

<div class="banner">
    <div class="banner-contain w1200 pr">
        <div class="bc-left"><span class="circle1"></span><span class="circle2"></span><img src="/Application/Home/View/Public/images/about.png"></div>
        <div class="bc-right tl pa" style="left:200px;top:20px;">
            <h2 class="m0 wow fadeInUp">关于我们</h2>
            <p class="mt20 wow fadeInUp">宿迁蒲公英网络有限公司（http://www.pgyidc.com)是座落于中国经济最前沿—江苏宿迁的一家公司，由一批有多年网络行业丰富工作经验的人员于2005年10月参与创办，注册资本1000万元。公司于2006年获得江苏省通信管理局ICP经营许可，以国际化、高标准的工作流程为超过10万家企、事业单位及个人用户提供服务器托管及网站接入服务。宿迁蒲公英网络直营数据中心的服务器保有量超过5000台，网站接入数量超过10万个，是国内最大的互联网接入商之一。 核心资源覆盖在上海、江苏宿迁、扬州、镇江并在扬州镇江等地拥有直营子公司，在超过5个核心城市拥有直营数据中心及服务团队。 宿迁蒲公英网络是江苏互联网协会和中国互联网协会会员</p>
        </div>
    </div>
</div>
<div class="small-banner" style="background: #dedfe4">
    <div class="smban-contain w1200" style="height:60px;">
        <ul class="ul-smbancon">
            <li class="currenton know">了解我们</li>
            <li class="join">加入我们</li>
            <li class="connect">联系我们</li>
        </ul>
    </div>
</div>
<div class="small-fixbanner">
    <div class="smban-contain w1200" style="height:60px;">
        <ul class="ul-smbancon">
            <li class="currenton know">了解我们</li>
            <li class="join">加入我们</li>
            <li class="connect">联系我们</li>
        </ul>
    </div>
</div>
<div class="about">
    <div class="w1200" id="knowus">
        <h3>了解我们</h3>
        <div class="knowuscontain">
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">核心价值</b>&nbsp;&nbsp;宿迁蒲公英网络致力于为用户提供更好的解决方案，并始终领跑互联网服务的革新。对于宿迁蒲公英网络来说，优质的网络服务是不计回报的投入、极尽严格的品质规范和对“用户第一“的充分理解与贯彻，对销售和售后服务模式的大胆创新与挑战。宿迁蒲公英网络尊重和把握每一个客户的想法与建议，并视之为机遇，也正是这种始终与用户保持高度统一的价值观使宿迁蒲公英网络不断欣荣并高速、健康发展至今。这也是宿迁蒲公英网络品牌的核心所在：一个力求至臻完善的服务标准。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">公司理念</b>&nbsp;&nbsp;宿迁蒲公英网络在公司规模不断壮大的情况下大力加强企业文化建设，努力探索企业文化的内涵，公司和员工都认可“付出”与“回报”的正相关是实现企业发展和个人价值的的共赢选择。我们珍惜员工的每一份付出，珍惜用户的每一次选择，珍惜公司的每一步成长，这将激励我们努力提供一个更广阔的平台以实现“与员工双赢”、“与客户双赢”、“与社会双赢”、“与合作伙伴双赢”、“与竞争对手双赢”，进而成为一家优秀的互联网企业。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">业务覆盖</b>&nbsp;&nbsp;宿迁蒲公英网络专业从事服务器托管、服务器租用、数据中心维护、专线接入等服务 ，拥有最丰富的互联网资源，经营和管理着超过3个电信 、联通及双线数据中心。目前我们拥有电信总出口带宽超过120G，联通总出口带宽超过20G，截止2010年2月份投入使用的机柜数量超过400个。宿迁蒲公英网络积极拓展全球市场，不仅在华东、华北、华南地区实现了资源及服务的全覆盖，更是在香港、美国等海外市场拥有了直营或自建的数据中心。宿迁蒲公英网络同时拥有最顶尖的网络技术力量，在网络保障、信息安全等领域都领先业界;凭借大规模的投入和领先的技术支撑，宿迁蒲公英网络以更快的速度实现网络资源覆盖，满足我们的用户对差别网络资源的需求。</p>
            <p><i class="fa fa-circle-o"></i>&nbsp;<b style="font-size:18px;color:#000;">服务团队</b>&nbsp;&nbsp;宿迁蒲公英网络目前服务团队超过60人，技术精湛、吃苦耐劳、敬业爱岗以及高度负责的工作态度体现在为用户服务的每一个环节;凭借一流的服务团队，我们为用户提供最优质的网络服务。宿迁蒲公英网络为每个机房配备三到八名工程师，提供24小时驻机房现场维护，为租用和托管用户提供实时上架、免费备机和备件 、带宽及硬件扩充服务。宿迁蒲公英网络每个直营机房均提供24小时技术支持电话，同时配备指定的客户经理24小时服务，保证畅通的服务渠道。在上海地区配备客户服务专车，免费接送客户的网络设备进出机房。公司同时采取“错时上班”机制，实时在线的业务受理一直延伸到晚上23:30，而驻机房的维护人员和信息安全人员则是24小时轮流值班，公司同时开放40部直线电话及50多部客户经理及服务投诉的手机，确保优质服务不留任何死角。</p>
        </div>
    </div>
    <div style="background: #fff;padding: 20px 0;">
        <div class="w1200" id="joinus">
            <h3>加入我们</h3>
            <div class="joinuscontain">
                <p>蒲公英自成立到现在，我们的事业取得了迅猛发展，如果你有志于IDC机房事业，希望亲手创造中国互联网下一个奇迹，那么非常欢迎加入我们，共创未来！我们希望我们的团队成员拥有充沛的创业激情，说到做到的执行力，以及永不放弃的精神！亲手创造中国互联网下一个奇迹，共创未来，您将和我们一起深度参与公司及团队的成长过程！</p>
                <p><i class="fa fa-circle"></i> <b style="color:#000;font-size: 16px;">客服</b></br>职位描述:</br>主要负责公司客户服务，互联网备案。工作时间8小时，每周单休。要求计算机专业毕业，对计算机知识有一定的认知，普通话标准。有1年以上的工作经验。薪资待遇：底薪 + 奖金，具体面议！</p>
                <p><i class="fa fa-circle"></i> <b style="color:#000;font-size: 16px;">技术工程师</b></br>岗位职责:</br>1、负责维护公司内部服务器，为相关部门提供技术支持。</br>2、回复和处理客户提交的问题。</br>3、为客户提供我公司服务范围内的客户指导。</br>4、根据相关部门的要求协同各部门进行售后服务。
                <p>任职要求:</br>1、大专或本科学历，计算机相关专业，2年以上相关工作经验，能熟练组装电脑硬件，会排查判断电脑硬件故障。</br>2、精通web,email,sql服务架构,具有独立维护能力，能熟练安装windows 2003操作系统及liunx操作系统，有责任心，负责日常电信机房维护工作！</br>3、精通windows 操作系统（服务器版）和 linux (RH or centos or freebsd and so on.)系统，熟悉服务器等硬件设备的设置以及管理。</br>4、精通mysql、mssql的基本操作和基本维护，电脑公司技术员或者网吧技术员优先考虑。</br>5、具有团队合作精神、且又能独立的学习能力。</p>
                <p>工作时间:周一到周五，八小时工作时间。</p>
                <p>薪资待遇:底薪 + 奖金，具体面议！</p>
                <p>联系人:何颖</p>
                <p>联系方式:15751554577</p>
                <p>工作地点：江苏省宿迁市宿豫区金融财富广场C座4楼</p>
            </div>
        </div>
    </div>
    <div id="connectus" style="padding: 20px 0;">
        <h3>联系我们</h3>
        <div class="w1200 connectcontain">
            <div class="connectcontain-item">
                <i class="fa fa-envelope-o" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">公司邮箱</p>
                <p class="contain">pgyidc@hotmail.com</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-qq" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">售后客服</p>
                <p class="contain">QQ:800002004</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-phone" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">技术支持</p>
                <p class="contain">0527-84224055转800/801</p>
            </div>
            <div class="connectcontain-item">
                <i class="fa fa-map-marker" style="font-size:50px;color:#60aff6;"></i>
                <p class="title">公司地址</p>
                <p class="contain">江苏省宿迁市宿豫区金融财富广场C座4楼</p>
            </div>
        </div>
        <section class="section map">
            <div style="width: auto; height: 400px; font-size: 12px; margin-top: 30px; overflow: hidden; position: relative; z-index: 0; background-color: rgb(243, 241, 236); color: rgb(0, 0, 0); text-align: left;" id="map"><div style="overflow: visible; position: absolute; z-index: 0; left: 0px; top: 0px; cursor: url(&quot;https://api.map.baidu.com/images/openhand.cur&quot;) 8 8, default;"><div class="BMap_mask" style="position: absolute; left: 0px; top: 0px; z-index: 9; overflow: hidden; user-select: none; width: 1525px; height: 400px;"></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 200;"><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 800;"></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 700;"><span class="BMap_Marker BMap_noprint" unselectable="on" "="" style="position: absolute; padding: 0px; margin: 0px; border: 0px; cursor: pointer; background: url(&quot;https://api.map.baidu.com/images/blank.gif&quot;); width: 20px; height: 25px; left: 820px; top: 188px; z-index: -6789996;" title=""></span><span class="BMap_Marker BMap_noprint" unselectable="on" "="" style="position: absolute; padding: 0px; margin: 0px; border: 0px; cursor: pointer; background: url(&quot;https://api.map.baidu.com/images/blank.gif&quot;); width: 18px; height: 18px; left: 1454px; top: 166px; z-index: 19000000; user-select: none; display: none;" title=""></span></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 600;"></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 500;"><label class="BMapLabel" unselectable="on" style="position: absolute; display: none; cursor: inherit; background-color: rgb(190, 190, 190); border: 1px solid rgb(190, 190, 190); padding: 1px; white-space: nowrap; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: arial, sans-serif; z-index: -20000; color: rgb(190, 190, 190);">shadow</label><label class="BMapLabel" unselectable="on" style="position: absolute; cursor: inherit; background-color: rgb(255, 255, 225); border: 1px solid rgb(140, 140, 140); padding: 1px; white-space: nowrap; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: arial, sans-serif; z-index: -6789788; user-select: none; color: rgb(77, 77, 77); left: 1438px; top: 269px; display: none;">点击可查看详情</label></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 400;"><span class="BMap_Marker" unselectable="on" style="position: absolute; padding: 0px; margin: 0px; border: 0px; width: 0px; height: 0px; left: 820px; top: 188px; z-index: -6789996;"><div style="position: absolute; margin: 0px; padding: 0px; width: 20px; height: 25px; overflow: hidden; left: 0px; top: -14px;"><img src="http://api.map.baidu.com/lbsapi/createmap/images/icon.png" style="display: block; border:none;margin-left:-23px; margin-top:-21px; "></div><label class="BMapLabel" unselectable="on" style="position: absolute; display: inline; cursor: inherit; background-color: rgb(255, 255, 255); border: none; padding: 1px; white-space: nowrap; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: arial, sans-serif; z-index: 80; user-select: none; left: 25px; top: 5px;">蒲公英网络</label></span><span class="BMap_Marker" unselectable="on" style="position: absolute; padding: 0px; margin: 0px; border: 0px; width: 0px; height: 0px; left: 1454px; top: 166px; z-index: 19000000; display: none;"><div style="position: absolute; margin: 0px; padding: 0px; width: 18px; height: 18px; overflow: hidden;"><img src="https://api.map.baidu.com/images/spotmkrs.png" style="display: block; border:none;margin-left:-178px; margin-top:-352px; "></div></span></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 300;"></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 201;"></div><div style="position: absolute; height: 0px; width: 0px; left: 0px; top: 0px; z-index: 200;"><svg version="1.1" type="system" x="2903px" y="1400px" viewBox="-500 -500 2903 1400" style="position: absolute; top: -500px; left: -500px; width: 2903px; height: 1400px;"><path stroke-linejoin="round" stroke-linecap="round" fill-rule="evenodd" fill="none" stroke="#00f" stroke-width="2" stroke-dasharray="none" stroke-opacity="0.6" style="cursor: pointer; user-select: none;" d="M -9999,-9999"></path></svg></div></div><div style="position: absolute; overflow: visible; top: 0px; left: 0px; z-index: 1;"><div style="position: absolute; overflow: visible; z-index: -100; left: 762px; top: 200px; display: block; transform: translate3d(0px, 0px, 0px);"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25727&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -270px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25726&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -526px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25727&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -270px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25727&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -270px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25725&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -782px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25726&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -526px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25726&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -526px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25725&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -782px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25728&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -14px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25728&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -14px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25728&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -14px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25729&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 242px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25729&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 242px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25729&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 242px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25730&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 498px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25730&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 498px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25730&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 498px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25731&amp;y=7808&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 754px; top: -101px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25731&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 754px; top: 155px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25731&amp;y=7809&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: 754px; top: -357px; max-width: none; opacity: 1;"><img src="https://api.map.baidu.com/customimage/tile?&amp;x=25725&amp;y=7807&amp;z=17&amp;udt=20180403&amp;scale=1&amp;ak=C13c98650aa84efc4279c4fd5ac4bac6&amp;styles=t%3Aall%7Ce%3Aall%7Cl%3A10%7Cs%3A-100" style="position: absolute; border: none; width: 256px; height: 256px; left: -782px; top: 155px; max-width: none; opacity: 1;"></div></div><div style="position: absolute; overflow: visible; top: 0px; left: 0px; z-index: 2; display: none;"><div style="position: absolute; overflow: visible; top: 0px; left: 0px; z-index: 0; display: none;"></div></div><div style="position: absolute; overflow: visible; top: 0px; left: 0px; z-index: 3;"></div></div><div class="pano_close" title="退出全景" style="z-index: 1201; display: none;"></div><a class="pano_pc_indoor_exit" title="退出室内景" style="z-index: 1201; display: none;"><span style="float:right;margin-right:12px;">出口</span></a><div class=" anchorBL" style="height: 32px; position: absolute; z-index: 30; text-size-adjust: none; bottom: 20px; right: auto; top: auto; left: 1px;"><a title="到百度地图查看此区域" target="_blank" href="http://map.baidu.com/?sr=1" style="outline: none;"><img style="border:none;width:77px;height:32px" src="https://api.map.baidu.com/images/copyright_logo.png"></a></div><div id="zoomer" style="position:absolute;z-index:0;top:0px;left:0px;overflow:hidden;visibility:hidden;cursor:url(https://api.map.baidu.com/images/openhand.cur) 8 8,default"><div class="BMap_zoomer" style="top:0;left:0;"></div><div class="BMap_zoomer" style="top:0;right:0;"></div><div class="BMap_zoomer" style="bottom:0;left:0;"></div><div class="BMap_zoomer" style="bottom:0;right:0;"></div></div><div unselectable="on" class=" BMap_stdMpCtrl BMap_stdMpType0 BMap_noprint anchorTR" style="width: 62px; height: 192px; bottom: auto; right: 10px; top: 10px; left: auto; position: absolute; z-index: 1100; text-size-adjust: none;"><div class="BMap_stdMpPan"><div class="BMap_button BMap_panN" title="向上平移"></div><div class="BMap_button BMap_panW" title="向左平移"></div><div class="BMap_button BMap_panE" title="向右平移"></div><div class="BMap_button BMap_panS" title="向下平移"></div><div class="BMap_stdMpPanBg BMap_smcbg"></div></div><div class="BMap_stdMpZoom" style="height: 147px; width: 62px;"><div class="BMap_button BMap_stdMpZoomIn" title="放大一级"><div class="BMap_smcbg"></div></div><div class="BMap_button BMap_stdMpZoomOut" title="缩小一级" style="top: 126px; background-position: 0px -265px;"><div class="BMap_smcbg"></div></div><div class="BMap_stdMpSlider" style="height: 108px;"><div class="BMap_stdMpSliderBgTop" style="height: 108px;"><div class="BMap_smcbg"></div></div><div class="BMap_stdMpSliderBgBot" style="top: 13px; height: 99px;"></div><div class="BMap_stdMpSliderMask" title="放置到此级别"></div><div class="BMap_stdMpSliderBar" title="拖动缩放" style="cursor: url(&quot;https://api.map.baidu.com/images/openhand.cur&quot;) 8 8, default; top: 13px;"><div class="BMap_smcbg"></div></div></div><div class="BMap_zlHolder"><div class="BMap_zlSt"><div class="BMap_smcbg"></div></div><div class="BMap_zlCity"><div class="BMap_smcbg"></div></div><div class="BMap_zlProv"><div class="BMap_smcbg"></div></div><div class="BMap_zlCountry"><div class="BMap_smcbg"></div></div></div></div><div class="BMap_stdMpGeolocation" style="position: initial; display: none; margin-top: 43px; margin-left: 10px;"><div class="BMap_geolocationContainer" style="position: initial; width: 24px; height: 24px; overflow: hidden; margin: 0px; box-sizing: border-box;"><div class="BMap_geolocationIconBackground" style="width: 24px; height: 24px; background-image: url(https://api.map.baidu.com/images/navigation-control/geolocation-control/pc/bg-20x20.png); background-size: 20px 20px; background-position: 3px 3px; background-repeat: no-repeat;"><div class="BMap_geolocationIcon" style="position: initial; width: 24px; height: 24px; cursor: pointer; background-image: url('https://api.map.baidu.com/images/navigation-control/geolocation-control/pc/success-10x10.png'); background-size: 10px 10px; background-repeat: no-repeat; background-position: center;"></div></div></div></div></div><div unselectable="on" class=" BMap_cpyCtrl BMap_noprint anchorBL" style="cursor: default; white-space: nowrap; color: black; background: none; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 11px; line-height: 15px; font-family: arial, sans-serif; bottom: 2px; right: auto; top: auto; left: 2px; position: absolute; z-index: 10; text-size-adjust: none;"><span _cid="1" style="display: inline;"><span style="background: rgba(255, 255, 255, 0.701961);padding: 0px 1px;line-height: 16px;display: inline;height: 16px;"></span></span></div></div>
        </section>
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