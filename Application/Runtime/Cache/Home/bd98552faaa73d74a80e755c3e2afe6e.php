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

    .cooper{background-color: #f2f2f2;}
    .cooper h3{margin:0;padding: 25px;}
    .jscooper-contain{height: 270px;}   
    .jscooper-contain-item{width: 200px;height: 200px;display: inline-block;margin:25px 10px;box-shadow: 0 0 10px 0 #dedfe4;background-color: #fff;border-radius: 6px 6px 0 0;}
    .jscooper-contain-item img{width: 150px;height: 60px;margin-top: 50px;}
    @media screen and (max-width: 1200px) {
        .jscooper-contain-item{width:170px;}
    }
</style>

<div class="banner">
    <div class="banner-contain w1200 pr">
        <div class="bc-left"><span class="circle1"></span><span class="circle2"></span><img src="/Application/Home/View/Public/images/cooperation.png"></div>
        <div class="bc-right tl pa" style="left:200px;top:20px;">
            <h2 class="m0 wow fadeInUp">合作伙伴</h2>
            <p class="mt20 wow fadeInUp">合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴合作伙伴</p>
            <a href="http://crm2.qq.com/page/portalpage/wpa.php?uin=800002004&aty=0&a=0&curl=&ty=1" target="blank"><div class="show-more m0 mt30 wow fadeInUp">合作洽谈</div></a>
        </div>
    </div>
</div>
<div class="cooper">
    <!-- <div class="w1200">
        <h3>代理商招募</h3>
        <div class="" style="background:#fff;height:270px;border-radius:6px;box-shadow: 0 0 10px 0 #dedfe4;">
            代理商招募
        </div>
    </div> -->
    <!-- <div class="w1200">
        <h3>技术合作伙伴</h3>
        <div class="jscooper-contain">
            <div class="jscooper-contain-item">
                技术合作伙伴1
            </div>
            <div class="jscooper-contain-item">
                技术合作伙伴2
            </div>
            <div class="jscooper-contain-item">
                技术合作伙伴3
            </div>
        </div>
    </div> -->
    <div class="w1200">
        <h3>合作伙伴</h3>
        <div class="jscooper-contain">
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/201407050931126406.gif">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/201407050931252656.gif">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/201407050931548437.gif">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/201408170319339753.png">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/201408170320333035.png">
            </div>
        </div>
    </div>
    <div class="w1200">
        <h3>客户案例</h3>
        <div class="jscooper-contain">
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/360.jpg">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/baidu.jpg">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/wangsu.jpg">
            </div>
            <div class="jscooper-contain-item">
                <img src="/Application/Home/View/Public/images/lanxun.jpg">
            </div>
        </div>
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