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
    ul{margin-bottom: 0;}
    input[type=checkbox], input[type=radio]{width: 125px;height: 32px;position: absolute;left: -2px;opacity: 0;cursor: pointer;}
    .onthis{background-color: #60aff6;color: #fff;}
    .haveborder{border-right: 1px solid #ddd;}
    .main{margin: 50px auto;}
    .main tr td{position: relative;}
    .title{position: absolute;width: 30px;height:100%;left: 0;top: 0;background-color:#ddd;}
    .title span{position: absolute;left:50%;top:50%;margin-top:-12px;margin-left:-5px;width:1em;line-height: 1;color: #888;}
    .panelcon .list{position: relative;margin:10px auto;}
    .panelcon .list ul{margin-left:130px;height:30px;line-height:30px;cursor: pointer;}
    .panelcon .list ul li{display: inline-block;position:relative;width:125px;text-align:center;font-size: 12px;border: 1px solid #ddd;padding: 0 15px;}
    .panelcon .list .list-sp{position: absolute;margin-left: 30px;font-size: 12px;left: 0;top: 50%;margin-top:-10px;width: 90px;text-align: right;color:#999;}
    .dl-add{position:absolute;border:1px solid #ddd;font-size:12px;width:100px;background-color:#fff;text-align:center;display:none;top:60px;z-index:2;}
    .dl-add dd{border-bottom:1px solid #ddd;padding:5px 0;}
    .dl-add dd:hover{background-color: #60aff6;color: #fff;}
</style>
<script>
$(function(){
    $('.haveborder').mouseenter(function(){
        $(this).find('.title').css('background-color','#60aff6');
        $(this).find('.title span').css('color','#fff');
    });
    $('.haveborder').mouseleave(function(){
        $(this).find('.title').css('background-color','#ddd');
        $(this).find('.title span').css('color','#888');
    });
    //滚动
    $(window).scroll(function(){
        var docheight=$(window).height();//window高度
        var trpircetop=$("#tr-pirce").offset().top-$(window).scrollTop();//元素距离window顶部距离
        
        if(trpircetop+90<docheight){
            $('.price-fix').css('display','none');
        }else{
            $('.price-fix').css('display','block');
        }
    });
    //ip 控制方法
    var ipblonone=function(state){
        $('.cnipnum').val(0);$('.cmipnum').val(0);$('.cuipnum').val(0);$('.bgpipnum').val(0);
        if(state=='1'){
            $('.cnlist,.cmlist,.culist').css('display','block');
            $('.bgplist').css('display','none');
        }else{
            $('.cnlist,.cmlist,.culist').css('display','none');
            $('.bgplist').css('display','block');
        }
    }
    //机房点击事件
    $('.sqdx,.gzdx,.zjdx').click(function(){
        ipblonone('1');
    });

    $('.sqsx').click(function(){
        ipblonone('0');
    });
    var sentkv=function(){
        var type=$('.type').find('.onthis').data('val');var typearr=new Array("服务器托管","服务器租用");//购买类型1租用，0托管
        var area=$('.area').find('.onthis').data('val');var areaarr=new Array("宿迁多线","宿迁三线BGP");//地区
        var unum=$('.select-unum').children('option:selected').text();//机器U数
        var cnip=$('.cnipnum').val();//电信ip
        var cmip=$('.cmipnum').val();//移动ip
        var cuip=$('.cuipnum').val();//联通ip
        var bgpip=$('.bgpipnum').val();//bgpip
        var exchange=$('.exchange').find('.onthis').data('val');//交换机口
        var bandwidth=$('.select-bw').children('option:selected').val();//带宽
        var defense=$('.select-defense').children('option:selected').val();//硬防
        var abroad=$('.abroad').find('.onthis').data('val');var abroadarr=new Array("不开","开");//国外
        var udp=$('.udp').find('.onthis').data('val');var udparr=new Array("不阻断","阻断");//udp
        var noseecc=$('.noseecc').find('.onthis').data('val');var ccparr=new Array("不启用","启用");//无视cc
        $(".select-os").children('option:selected').val()=='win'?os=$(".winselect").children('option:selected').val():os=$(".linuxselect").children('option:selected').val();//系统
        var year=$('.year').val();//年
        var month=$('.month').val();//月

        $('.p-config').text(typearr[type]+" "+areaarr[area]+"(机房) "+unum+"(机器U数) "+cnip+"个(电信ip) "
        +cmip+"个(移动ip) "+cuip+"个(联通ip) "+bgpip+"个(BGPip) "+exchange+"(交换机口) "+bandwidth+"M(带宽) "+defense+"G(硬防) "+abroadarr[abroad]+"(国外) "+udparr[udp]+"(UDP) "+ccparr[noseecc]+"(无视CC) "+os+"(系统) "+year+"年"+month+"月(时长) ");
    }
    var init=function(){
        sentkv();
    }
    init();//初始化
    
    //点击按钮
    $('.list li').click(function(){
        $(this).closest('ul').find('.onthis').removeClass('onthis');
        $(this).addClass('onthis');
        sentkv();
    });
    //机器U数
    $('.select-unum').change(function(){
        sentkv();
    });

    //电信ip
    $('.cnipnum').change(function(){
        sentkv();
    });
    //移动ip
    $('.cmipnum').change(function(){
        sentkv();
    });
    //联通ip
    $('.cuipnum').change(function(){
        sentkv();
    });
    //bgpip
    $('.bgpipnum').change(function(){
        sentkv();
    });
    //系统选择
    $(".select-os").change(function(){  
        var val = $(this).children('option:selected').val();  
        switch(val){
            case 'win':$('.selewin').css('display','block');$('.selelinux').css('display','none');break;
            case 'linux':$('.selelinux').css('display','block');$('.selewin').css('display','none');break;
        }
    });
    $(".winselect").change(function(){
        sentkv();
    });
    $(".linuxselect").change(function(){
        sentkv();
    });
    //带宽选择
    $(".select-bw").change(function(){
        sentkv();
    });
    //防御
    $('.select-defense').change(function(){
        var val = $(this).children('option:selected').val();
        val=parseInt(val);
        if(val>200||val==200){
            $('.abroad').find('li:eq(1)').css('display','none');
            $('.abroad').find('.onthis').removeClass('onthis');
            $('.abroad').find('li:eq(0)').addClass('onthis');
        }else{
            $('.abroad').find('li:eq(1)').css('display','inline-block');
            $('.abroad').find('.onthis').removeClass('onthis');
            $('.abroad').find('li:eq(0)').addClass('onthis');
        }
        sentkv();
    });
    //时长
    $('.year,.month').change(function(){
        sentkv();
    }); 
});
</script>
<div class="banner">
    <div class="banner-contain w1200 pr">
        <div class="bc-left"><span class="circle1"></span><span class="circle2"></span><img src="/Application/Home/View/Public/images/server_ban.png"></div>
        <div class="bc-right tl pa" style="left:200px;top:20px;">
            <h2 class="m0 wow fadeInUp">服务器托管与租用</h2>
            <p class="mt20 wow fadeInUp">华东地区第一家带防BGP，国家甲级机房，超级数据港。专门技术人员7X24小时维护;标准机房环境，提供365天全天候运营服务。</p>
            <div class="show-more m0 mt30 wow fadeInUp askbtn">立即咨询</div>
        </div>
    </div>
</div>

<div class="main w1200 tl">
        <table class="table">
            <tbody>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>类型</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">产品类型：</span>
                                <ul class="type">
                                    <a href="<?php echo U('Index/serverbuy');?>"><li data-val="1">服务器租用</li></a>
                                    <a href="<?php echo U('Index/servertrust');?>"><li class="onthis" data-val="0">服务器托管</li></a>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>区域</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">机房：</span>
                                <ul class="area">
                                    <li class="onthis sqdx" data-val="0">宿迁多线</li>
                                    <li class="sqsx" data-val="1">宿迁三线BGP</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span style="margin-top: -20px;">机器U数</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">机器U数：</span>
                                <ul class="unum">
                                    <div class="selecon" style="width:125px;float:left;">
                                        <select class="form-control select-unum">
                                            <option value="20">独立1U</option>
                                            <option value="30">独立2U</option>
                                            <option value="40">独立4U</option>
                                            <option value="50">1U一拖二</option>
                                            <option value="60">2U一拖四</option>
                                            <option value="70">4U一拖八</option>
                                            <option value="80">双子星</option>
                                            <option value="90">四子星</option>
                                            <option value="100">八子星</option>
                                        </select>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span style="margin-top: -5px;">IP</span></div>
                        <div class="panelcon">
                            <div class="list cnlist">
                                <span class="list-sp">电信IP：</span>
                                <ul>
                                    <input type="number" class="form-control cnipnum" value="0" min="0" max="256" style="width: 100px;display: inline-block;"> 个
                                </ul>
                            </div>
                            <div class="list cmlist">
                                <span class="list-sp">移动IP：</span>
                                <ul>
                                    <input type="number" class="form-control cmipnum" value="0" min="0" max="256" style="width: 100px;display: inline-block;"> 个
                                </ul>
                            </div>
                            <div class="list culist">
                                <span class="list-sp">联通IP：</span>
                                <ul>
                                    <input type="number" class="form-control cuipnum" value="0" min="0" max="256" style="width: 100px;display: inline-block;"> 个
                                </ul>
                            </div>
                            <div class="list bgplist" style="display: none;">
                                <span class="list-sp">BGP IP：</span>
                                <ul>
                                    <input type="number" class="form-control bgpipnum" value="0" min="0" max="256" style="width: 100px;display: inline-block;"> 个
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span style="margin-top: -20px;">交换机口</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">大小：</span>
                                <ul class="exchange">
                                    <li class="onthis" data-type="exchange" data-val="百兆">百兆口</li>
                                    <li data-type="exchange" data-val="G">G口</li>
                                    <li data-type="exchange" data-val="万兆">万兆口</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>带宽</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">带宽：</span>
                                <ul class="bandwidth">
                                    <div class="selecon" style="width:125px;float:left;">
                                        <select class="form-control select-bw">
                                            <option value="20">20M</option>
                                            <option value="30">30M</option>
                                            <option value="40">40M</option>
                                            <option value="50">50M</option>
                                            <option value="60">60M</option>
                                            <option value="70">70M</option>
                                            <option value="80">80M</option>
                                            <option value="90">90M</option>
                                            <option value="100">100M</option>
                                            <option value="200">200M</option>
                                            <option value="300">300M</option>
                                            <option value="400">400M</option>
                                            <option value="500">500M</option>
                                            <option value="600">600M</option>
                                            <option value="700">700M</option>
                                            <option value="800">800M</option>
                                            <option value="900">900M</option>
                                            <option value="1000">1G</option>
                                        </select>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>防御</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">硬防：</span>
                                <ul class="defense">
                                    <div class="selecon" style="width:125px;float:left;">
                                        <select class="form-control select-defense">
                                            <option value="0">0G</option>
                                            <option value="100">100G</option>
                                            <option value="150">150G</option>
                                            <option value="200">200G</option>
                                            <option value="250">250G</option>
                                            <option value="300">300G</option>
                                        </select>
                                    </div>
                                </ul>
                            </div>
                            <div class="list">
                                <span class="list-sp">国外：</span>
                                <ul class="abroad">
                                    <li class="onthis" data-type="abroad" data-val="0">不开</li>
                                    <li data-type="abroad" data-val="1">开</li>
                                </ul>
                            </div>
                            <div class="list">
                                <span class="list-sp">UDP：</span>
                                <ul class="udp">
                                    <li class="onthis" data-type="udp" data-val="0">不阻断</li>
                                    <li data-type="udp" data-val="1">阻断</li>
                                </ul>
                            </div>
                            <div class="list">
                                <span class="list-sp">无视CC：</span>
                                <ul class="noseecc">
                                    <li class="onthis" data-type="noseecc" data-val="0">不启用</li>
                                    <li data-type="noseecc" data-val="1">启用</li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>系统</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">系统镜像:</span>
                                <div style="margin-left:130px;height:30px;line-height:30px;display:inline-block;cursor: pointer;">
                                    <div class="selecon" style="width:150px;float:left;">
                                        <select class="form-control select-os">
                                            <option value="win">windows</option>
                                            <option value="linux">Linux</option>
                                        </select>
                                    </div>
                                    
                                    <div class="selewin" style="width:190px;float:left;margin-left:10px;display:block;">
                                        <select class="form-control winselect" name="">
                                            <option value="--">--请选择镜像--</option>
                                            <option value="Windows 2003 x32">Windows 2003 x32</option>
                                            <option value="Windows 2003 x64">Windows 2003 x64</option>
                                            <option value="Windows 2003 R2 x32">Windows 2003 R2 x32</option>
                                            <option value="Windows 2003 R2 x64">Windows 2003 R2 x64</option>
                                            <option value="Windows 2008 x32">Windows 2008 x32</option>
                                            <option value="Windows 2008 x64">Windows 2008 x64</option>
                                            <option value="Windows 2008 R2 x32">Windows 2008 R2 x32</option>
                                            <option value="Windows 2008 R2 x64">Windows 2008 R2 x64</option>
                                            <option value="Windows 2012">Windows 2012</option>
                                            <option value="Windows 2012 R2">Windows 2012 R2</option>
                                            <option value="Windows 2016">Windows 2016</option>
                                            <option value="Windows7 x32">Windows7 x32</option>
                                            <option value="Windows7 x64">Windows7 x64</option>
                                        </select>
                                    </div>
                                    
                                    <div class="selelinux" style="width:190px;float:left;margin-left:10px;display:none;">
                                        <select class="form-control linuxselect" name="">
                                            <option value="--">--请选择镜像--</option>
                                            <option value="CentOS 5.8 x32">CentOS 5.8 x32</option>
                                            <option value="CentOS 5.8 x64">CentOS 5.8 x64</option>
                                            <option value="CentOS 5.9 x32">CentOS 5.9 x32</option>
                                            <option value="CentOS 5.9 x64">CentOS 5.9 x64</option>
                                            <option value="CentOS 6.5 x32">CentOS 6.5 x32</option>
                                            <option value="CentOS 6.5 x64">CentOS 6.5 x64</option>
                                            <option value="CentOS 6.8 x32">CentOS 6.8 x32</option>
                                            <option value="CentOS 6.8 x64">CentOS 6.8 x64</option>
                                            <option value="CentOS 6.9 x32">CentOS 6.9 x32</option>
                                            <option value="CentOS 6.9 x64">CentOS 6.9 x64</option>
                                            <option value="CentOS 7.0 x32">CentOS 7.0 x32</option>
                                            <option value="CentOS 7.0 x64">CentOS 7.0 x64</option>
                                            <option value="CentOS 7.1 x32">CentOS 7.1 x32</option>
                                            <option value="CentOS 7.1 x64">CentOS 7.1 x64</option>
                                            <option value="CentOS 7.2 x32">CentOS 7.2 x32</option>
                                            <option value="CentOS 7.2 x64">CentOS 7.2 x64</option>
                                            <option value="CentOS 7.3 x32">CentOS 7.3 x32</option>
                                            <option value="CentOS 7.3 x64">CentOS 7.3 x64</option>
                                            <option value="CentOS 7.4 x32">CentOS 7.4 x32</option>
                                            <option value="CentOS 7.4 x64">CentOS 7.4 x64</option>
                                            <option value="Debian 8.6">Debian 8.6</option>
                                            <option value="FreeBSD 9.2">FreeBSD 9.2</option>
                                            <option value="Ubuntu 16.04.4">Ubuntu 16.04.4</option>
                                            <option value="Xenserver 6.5">Xenserver 6.5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td class="haveborder">
                        <div class="title"><span>时长</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">时长：</span>
                                <ul>
                                    <input type="number" class="form-control year" value="0" min="0" max="10" style="width: 100px;display: inline-block;"> 年
                                    <input type="number" class="form-control month" value="1" min="1" max="12" style="width: 100px;display: inline-block;"> 个月
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                </tr>
                <tr id="tr-pirce">
                    <td class="haveborder">
                        <div class="title"><span>价格</span></div>
                        <div class="panelcon">
                            <div class="list">
                                <span class="list-sp">配置价格：</span>
                                <div style="height:80px;margin-left:130px;position:relative;">
                                    <span style="position:absolute;width:10px;font-size:24px;font-weight:700;color:red;margin-left:0;left:0;">￥</span>
                                    <span class="totalprice" style="position:absolute;font-size:24px;font-weight:700;color:red;margin-left:0;left:20px;">价格计算中...</span>
                                    <p class="p-config" style="position:absolute;top:50px;font-size:12px;color:#999;"></p>
                                </div>
                                <button class="btn btn-default askbtn" style="position:absolute;right:10px;top:5%;right:120px;background-color:#60affd;color:#fff;font-size:20px;font-weight:bold;">售前咨询</button>
                                <button class="btn btn-default buybtn" style="position:absolute;right:10px;top:5%;background-color:red;color:#fff;font-size:20px;font-weight:bold;">立即购买</button>
                            </div>
                            
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="price-fix w1200" style="position:fixed;display:block;padding:8px;bottom:0;background-color:#fff;box-shadow: 0px -2px 16px rgba(0, 0, 0, .12);z-index:3;">
            <div class="title"><span>价格</span></div>
            <div class="panelcon">
                <div class="list">
                    <span class="list-sp">配置价格：</span>
                    <div style="height:80px;margin-left:130px;position:relative;">
                        <span style="position:absolute;width:10px;font-size:24px;font-weight:700;color:red;margin-left:0;left:0;">￥</span>
                        <span class="totalprice" style="position:absolute;font-size:24px;font-weight:700;color:red;margin-left:0;left:20px;">价格计算中...</span>
                        <p class="p-config" style="position:absolute;top:50px;font-size:12px;color:#999;"></p>
                    </div>
                    <button class="btn btn-default askbtn" style="position:absolute;right:10px;top:5%;right:120px;background-color:#60affd;color:#fff;font-size:20px;font-weight:bold;">售前咨询</button>
                    <button class="btn btn-default buybtn" style="position:absolute;right:10px;top:5%;background-color:red;color:#fff;font-size:20px;font-weight:bold;">立即购买</button>
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