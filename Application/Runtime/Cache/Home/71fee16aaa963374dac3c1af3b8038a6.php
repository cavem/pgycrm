<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
<link href="/pgyidc/Application/Home/View/Public/css/animate.css" rel="stylesheet">
<link href="/pgyidc/Application/Home/View/Public/css/bootstrap.css" rel="stylesheet"/>
<link href="/pgyidc/Application/Home/View/Public/css/slider.css" rel="stylesheet">
<link href="/pgyidc/Application/Home/View/Public/css/style.css" rel="stylesheet">
<script src="/pgyidc/Application/Home/View/Public/js/jquery.min.js" type="text/javascript"></script>
<script src="/pgyidc/Application/Home/View/Public/js/wow.min.js" type="text/javascript"></script>
<script src="/pgyidc/Application/Home/View/Public/js/bootstrap.min.js"></script>
<script src="/pgyidc/Application/Home/View/Public/js/slider.js"></script>
<script src="/pgyidc/Application/Home/View/Public/js/ImageSlide.js"></script>
<script src="/pgyidc/Application/Home/View/Public/js/prototype.js"></script>
<script>
    $(function(){
        $('#myCarousel').carousel({
            interval:2000
        });
        //index 最热新闻
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
        new ImageSlide({
            project:"#focusImage",
            content:".contents li",
            tigger:".triggers a",
            dot:".icon-dot a",
            watch:".link-watch",
            auto:!0,
            hide:!0
        })
        //newidc 左侧list
        var localurl=window.location.href;
        var urlarr = localurl.split('?');
        if(typeof(urlarr[1])=="undefined"){
            $('.left-list li:eq(0) a').addClass("bluebg");
            $('.left-list li:eq(0) a').css('font-size','16px');
            $('.left-list li:eq(0) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
        }else if(urlarr[1]=="r=1"){
            $('.left-list li:eq(1) a').addClass("bluebg");
            $('.left-list li:eq(1) a').css('font-size','16px');
            $('.left-list li:eq(1) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            $('.price-1').html('1500.00<small>元/月</small>');
            $('.price-2').html('1600.00<small>元/月</small>');
            $('.ul-1 li:eq(0)').text('200G单机防护');
            $('.ul-1 li:eq(4)').text('G口不限速');
            $('.ul-1 li:eq(5)').text('180.101.75.1 2U加收150元/月');
            $('.ul-1 li:eq(6)').text('每增加一个加收250元/个/月');
            $('.ul-2 li:eq(0)').text('200G单机防护');
            $('.ul-2 li:eq(2)').text('L5630*2 16G 120G固态/300G');
            $('.ul-2 li:eq(5)').text('180.101.116.1');
            $('.ul-2 li:eq(6)').text('每增加一个加收250元/个/月');
        }else if(urlarr[1]=="r=2"){
            $('.left-list li:eq(2) a').addClass("bluebg");
            $('.left-list li:eq(2) a').css('font-size','16px');
            $('.left-list li:eq(2) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            $('.price-1').html('1000.00<small>元/月</small>');
            $('.price-2').html('1050.00<small>元/月</small>');
            $('.ul-1 li:eq(0)').text('电信云堤阻断国外后150G/联通移动阻断国外后40G');
            $('.ul-1 li:eq(3)').text('20M');
            $('.ul-1 li:eq(5)').text('180.101.76.0/1/22 2U加收150元/月');
            $('.ul-1 li:eq(6)').text('默认电信,送1个联通BGP（联通/移动）,每增加一个加收250元/个/月');
            $('.ul-1 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
            $('.ul-2 li:eq(0)').text('电信云堤阻断国外后150G/联通移动阻断国外后40G');
            $('.ul-2 li:eq(2)').text('L5630*2 16G 120G固态/300G');
            $('.ul-2 li:eq(3)').text('20M');
            $('.ul-2 li:eq(5)').text('180.101.76.0/1/22');
            $('.ul-2 li:eq(6)').text('默认电信,送1个联通BGP（联通/移动）,每增加一个加收250元/个/月');
            $('.ul-2 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
        }else if(urlarr[1]=="r=3"){
            $('.left-list li:eq(3) a').addClass("bluebg");
            $('.left-list li:eq(3) a').css('font-size','16px');
            $('.left-list li:eq(3) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            $('.price-1').html('1000.00<small>元/月</small>');
            $('.price-2').html('299.00<small>元/月</small>');
            $('.ul-1 li:eq(0)').text('电信云堤阻断国外后150G/联通移动阻断国外后40G');
            $('.ul-1 li:eq(3)').text('20M');
            $('.ul-1 li:eq(5)').text('180.101.76.0/1/22 2U加收150元/月');
            $('.ul-1 li:eq(6)').text('默认电信,送1个联通BGP（联通/移动）,每增加一个加收250元/个/月');
            $('.ul-1 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
            $('.ul-2 li:eq(0)').text('电信40G');
            $('.ul-2 li:eq(2)').text('L5630*2 16G 120G固态');
            $('.ul-2 li:eq(3)').text('10M');
            $('.ul-2 li:eq(5)').text('61.147.112.2');
            $('.ul-2 li:eq(6)').text('');
            $('.ul-2 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
        }else if(urlarr[1]=="r=4"){
            $('.left-list li:eq(4) a').addClass("bluebg");
            $('.left-list li:eq(4) a').css('font-size','16px');
            $('.left-list li:eq(4) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            $('.price-1').html('1000.00<small>元/月</small>');
            $('.price-2').html('880.00<small>元/月</small>');
            $('.ul-1 li:eq(0)').text('电信云堤阻断国外后150G/联通移动阻断国外后40G');
            $('.ul-1 li:eq(3)').text('20M');
            $('.ul-1 li:eq(5)').text('180.101.76.0/1/22 2U加收150元/月');
            $('.ul-1 li:eq(6)').text('默认电信,送1个联通BGP（联通/移动）,每增加一个加收250元/个/月');
            $('.ul-1 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
            $('.ul-2 li:eq(0)').text('电信10G');
            $('.ul-2 li:eq(2)').text('L5630*2 16G 120G固态');
            $('.ul-2 li:eq(3)').text('100M');
            $('.ul-2 li:eq(5)').text('43.248.177.1');
            $('.ul-2 li:eq(6)').text('');
            $('.ul-2 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');

        }else if(urlarr[1]=="r=5"){
            $('.left-list li:eq(5) a').addClass("bluebg");
            $('.left-list li:eq(5) a').css('font-size','16px');
            $('.left-list li:eq(5) a').find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            $('.price-1').html('1000.00<small>元/月</small>');
            $('.price-2').html('4980.00<small>元/月</small>');
            $('.ul-1 li:eq(0)').text('电信云堤阻断国外后150G/联通移动阻断国外后40G');
            $('.ul-1 li:eq(3)').text('20M');
            $('.ul-1 li:eq(5)').text('180.101.76.0/1/22 2U加收150元/月');
            $('.ul-1 li:eq(6)').text('默认电信,送1个联通BGP（联通/移动）,每增加一个加收250元/个/月');
            $('.ul-1 li:eq(7)').text('金盾无视CC免费，安全盾无视CC50元/月,默认送在线安装服务/蒲公英后台服务');
            $('.ul-2 li:eq(0)').text('电信10G');
            $('.ul-2 li:eq(2)').text('L5630*2 16G 120G固态');
            $('.ul-2 li:eq(3)').text('100M');
            $('.ul-2 li:eq(5)').text('常州整C段');
            $('.ul-2 li:eq(6)').text('');
            $('.ul-2 li:eq(7)').text('');
        }
        $('.left-list li a').mouseenter(function(){
            if(!$(this).hasClass('bluebg')){
                $(this).find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjw.png');
            }
        })
        $('.left-list li a').mouseleave(function(){
            if(!$(this).hasClass('bluebg')){
                $(this).find('img').attr('src','/pgyidc/Application/Home/View/Public/images/sjb.png');
            }
        })
        
    });
</script>
<script>
if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
	new WOW().init();
};
</script>
<script>
    $(function(){
        /*二级菜单*/
        $("li").mouseenter(function(){
            $(this).find("dl").css("display","block");
        });
        $("li").mouseleave(function(){
            $(this).find("dl").css("display","none");
        });
        /*右侧悬浮*/
        $(".suspend").mouseover(function() {
            $(this).stop();
            $(this).animate({width: 160}, 400);
        })
        
        $(".suspend").mouseout(function() {
            $(this).stop();
            $(this).animate({width: 40}, 400);
        });
        /*左侧悬浮*/
        $(".suspend-left").mouseover(function() {
            $(this).stop();
            $(this).animate({width: 160}, 400);
        })
        $(".suspend-left").mouseout(function() {
            $(this).stop();
            $(this).animate({width: 40}, 400);
        });
    })
</script>
</head>
<body>
<div class="nav_big">
    <div class="top">
        <div class="header">
            <div class="logo"><a href="<?php echo U('Index/index');?>"><img src="/pgyidc/Application/Home/View/Public/images/logo.png" height="60px" width="200px"></a></div>
            <div class="nav">
                <ul class="menu" style="width:840px">
                    <li><a href="<?php echo U('Index/index');?>">网站首页</a></li>
                    <li>
                        <a href="javascript:;">自营机房</a>
                        <dl>
                            <dd><a href="<?php echo U('Index/newidc');?>">最新产品</a></dd>
                            <dd><a href="http://yun.pgyidc.com/server/buy.html" target="blank">香港机房</a></dd>
                            <dd><a href="<?php echo U('Index/softserve');?>">软件服务</a></dd>
                            <dd><a href="<?php echo U('Index/sqidc');?>">宿迁机房</a></dd>
                            <dd><a href="<?php echo U('Index/jdidc');?>">京东机房</a></dd>
                            <dd><a href="<?php echo U('Index/wzidc');?>">温州机房</a></dd>
                            <dd><a href="<?php echo U('Index/gzidc');?>">广州机房</a></dd>
                            <dd><a href="<?php echo U('Index/bjidc');?>">北京机房</a></dd>
                            <dd><a href="http://www.17b.net/home/cloud/buy.shtml" target="blank">昊锐信息</a></dd>
                        </dl>
                    </li>
                    <li>
                        <a href="javascript:;">支付平台</a>
                        <dl>
                            <dd><a href="http://pay.17b.net/" target="blank">传奇支付</a></dd>
                            <dd><a href="http://pay.pgyidc.com/" target="blank">发卡支付</a></dd>
                        </dl>
                    </li>
                    <li>
                        <a href="javascript:;">虚拟产品</a>
                        <dl>
                            <dd><a href="<?php echo U('Index/vhost');?>">虚拟主机</a></dd>
                            <dd><a href="<?php echo U('Index/cloud');?>">云主机</a></dd>
                            <dd><a href="http://yun.pgyidc.com/server/buy.html" target="blank">香港机房</a></dd>
                        </dl>
                    </li>
                    <li>
                        <a href="javascript:;">自助管理</a>
                        <dl>
                            <dd><a href="http://user.pgyidc.com" target="blank">自助防御</a></dd>
                            <dd><a href="">自动化</a></dd>
                        </dl>
                    </li>
                    <li><a href="<?php echo U('Index/about');?>">付款方式</a></li>
                    <li>
                        <a href="javascript:;">管理中心</a>
                        <dl>
                            <dd><a href="http://www.17b.net/home/user/login.shtml">E2CS系统</a></dd>
                            <dd><a href="http://www.pgyidc.com/idcSystem.aspx?c=myservice">云谷系统</a></dd>
                            <dd><a href="http://yun.pgyidc.com/server/buy.html">香港机房</a></dd>
                        </dl>
                    </li>
                    <div class="clear"></div>
                </ul>
            </div> 
            <div class="login">
                <a href="#">登录</a><span>|</span><a href="#">注册</a>
            </div><div class="clear"></div>
        </div>
    </div>
</div>

<style>
.bluebg{
    background-color: #5FBDF9;
    color: #fff;
}
.left-list li a{
    clear: both;
    display: block;
    margin: 0;
    padding-top: 15px;
    list-style: none;
    text-align: center;
    font-size: 14px;
    height: 35px;
    transition: all 0.1s;
}
.left-list li a:hover{
    background-color: #5FBDF9;
    color: #fff;
    font-size: 16px;
}
.newidc-top{
    height: 200px;
    text-align: center;
    background-color: #fff;
}
.newidc-top h2{
    color: #5FBDF9;
    height: 50px;
    line-height: 50px;
}
.newidc-top ul{
    padding: 0 5px;
}
.newidc-top ul li{
    float: left;
    width: 170px;
}
.newidc-top ul li img{
    width: 110px;
    height: 110px;
    margin-top:20px;
    transition: all 0.3s;
}
.newidc-top ul li img:hover{
    transform: scale(1.1);
}
.product-price {
    clear: both;
    line-height: 50px;
    font-size: 28px;
    font-weight: normal;
}
</style>
<div class="container-wrap product-container-wrap clearfix">
    <!-----------------list1-------------------->
    <div class="inner-wrap clearfix">
        <div class="newidc-top">
            <h2>我们的产品优势及特点</h2>
            <ul>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys1.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.1s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys2.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.2s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys3.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.3s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys4.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.4s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys5.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.5s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys6.png"></li>
                <li class="wow fadeInUp" style="visibility: visible; animation-delay: 0.6s;"><img src="/pgyidc/Application/Home/View/Public/images/cpys7.png"></li>
            </ul>
        </div>
    </div>
    
    <!-----------------list3-------------------->
    <div class="inner-wrap clearfix">
        <h2 style="color:#5FBDF9;height:50px;line-height:50px">产品参数详情</h2>
        <!--product-group-->
        <div class="product-group clearfix">
            <!--product-group-item-->
            <div class="product-group-item product-titlebar" data-wow-delay="0.2s" style="left: 0px;width:170px; visibility: visible; animation-delay: 0.2s; animation-name: fadeInRight;">
                <ul class="product-group-list left-list" style="border:1px solid #ddd">
                    <li><a class="product-group-leftlist-item" href="newidc.html"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  宿迁多线</a></li>
                    <li><a class="product-group-leftlist-item" href="newidc.html?r=1"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  双线高防</a></li>
                    <li><a class="product-group-leftlist-item" href="newidc.html?r=2"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  三线双IP</a></li>
                    <li><a class="product-group-leftlist-item" href="newidc.html?r=3"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  扬州电信</a></li>
                    <li><a class="product-group-leftlist-item" href="newidc.html?r=4"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  常州电信</a></li>
                    <li><a class="product-group-leftlist-item" href="newidc.html?r=5"><img src="/pgyidc/Application/Home/View/Public/images/sjb.png">  常州 C段</a></li>
                </ul>
            </div>
            <!--product-group-item-->
            <div class="product-group-item product-titlebar wow fadeInRight" style="left: 200px; visibility: visible;">
                <div class="product-group-topbar">
                    <h4>功能配置</h4>
                </div>
                <ul class="product-group-list">
                    <li class="product-group-list-item even">防御</li>
                    <li class="product-group-list-item">解封时间</li>
                    <li class="product-group-list-item even">配置</li>
                    <li class="product-group-list-item">上行带宽</li>
                    <li class="product-group-list-item even">下行带宽</li>
                    <li class="product-group-list-item">测试IP</li>
                    <li class="product-group-list-item even">IP个数</li>
                    <li class="product-group-list-item">无视CC</li>
                    <li class="product-group-list-item product_btn even" style="height:100px"></li>
                </ul>
            </div>
            <!--/product-group-item-->
                <div class="product-group-item wow fadeInRight item-content" style="left: 400px; visibility: visible;animation-delay: 0.1s;">
                    <div class="product-group-topbar">
                        <h4>托管</h4>
                    </div>
                    <ul class="product-group-list ul-1">
                        <li class="product-group-list-item even" style="color:red;font-weight:bold;">电信150G</li>
                        <li class="product-group-list-item"><img src="images/true_hidden.png" width="16" height="16" alt="">秒解</li>
                        <li class="product-group-list-item even"></li>
                        <li class="product-group-list-item">30M</li>
                        <li class="product-group-list-item even">G口不限速</li>
                        <li class="product-group-list-item">180.101.116.1 2U加收150元/月</li>
                        <li class="product-group-list-item even">每增加联通250元/个/月，电信250元/个/月，移动200元/个/月</li>
                        <li class="product-group-list-item">金盾无视CC免费，安全盾无视CC50元/月</li>
                        <li class="product-group-list-item product_btn even" style="height:100px"><p class="product-price price-1">1000.00<small>元/月</small></p><a href="/template?productId=1" class="product-group-btn">马上购买</a></li>
                    </ul>
                </div>
                <div class="product-group-item wow fadeInRight item-content" style="left: 800px; visibility: visible; animation-delay: 0.3s;">
                    <div class="product-group-topbar">
                        <h4 class="h4-2">租用(L5630*2 16G 120G)</h4>
                    </div>
                    <ul class="product-group-list ul-2">
                        <li class="product-group-list-item even" style="color:red;font-weight:bold;">电信150G</li>
                        <li class="product-group-list-item">秒解</li>
                        <li class="product-group-list-item even">L5630*2 16G 300G</li>
                        <li class="product-group-list-item">30M</li>
                        <li class="product-group-list-item even">G口不限速</li>
                        <li class="product-group-list-item">180.101.116.1 2U加收150元/月</li>
                        <li class="product-group-list-item even">每增加联通250元/个/月，电信250元/个/月，移动200元/个/月 </li>
                        <li class="product-group-list-item">金盾无视CC免费，安全盾无视CC50元/月</li>
                        <li class="product-group-list-item product_btn even" style="height:100px"><p class="product-price price-2">1200.00<small>元/月</small></p><a href="/template?productId=2" class="product-group-btn">马上购买</a></li>
                    </ul>
                </div>
        </div>
    </div>
    <!--/product-group-->
    <!-----------------list2-------------------->
    <div class="inner-wrap clearfix" style="margin-top:40px;">
        <div class="newidc-top" style="height:350px;">
            <h2>江苏宿迁多线BGP机房</h2>
            <img class="wow fadeInRight" src="/pgyidc/Application/Home/View/Public/images/suqianjifang.jpg" width="1200px" height="300px" style="visibility: visible;animation-delay: 0.4s;">
        </div>
    </div>
    <!-----------------list4-------------------->
    <div class="inner-wrap clearfix" style="margin-top:40px;">
        <div class="newidc-top" style="height:650px;">
                <h2>宿迁蒲公英网络有限公司机房展示</h2>
            <img class="wow fadeInRight" src="/pgyidc/Application/Home/View/Public/images/bangongshi1.jpg" width="1200px" height="600px" style="visibility: visible;animation-delay: 0.5s;">
        </div>
    </div>
</div>
<div class="footer_big">
	<div class="footer_content" style="width:1200px;">
        <div class="footer_left">
            <p>产品导航</p>
            <ul>
                <li><a href="">VPS云主机</a></li>
                <li><a href="">虚拟主机</a></li>
                <li><a href="">服务器租用</a></li>
                <li><a href="">服务器托管</a></li>
            </ul>
        </div>
        <div class="footer_left footer_service">
            <p>服务支持</p>
            <ul>
                <li class="qq">售后ＱＱ：800002004</li>
                <li class="e-mail">邮箱：213@43394</li>
                <li class="phone">售后电话：0527-84224055转800</li>
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
        </div><div class="clear"></div>
        <p class="footer_bottom mt20">
            <span style="color:#bbb;font-size:12px">Copyright ©2014 宿迁蒲公英网络 All Rights Reserved</br> ICP证：苏B2-20070043-1</span></br>
            <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=32130202080002" target="blank" style="color:#fff;font-size:13px"> <img src="/pgyidc/Application/Home/View/Public/images/20160331152326_4663.png">  备案号：苏公网安备 32130202080002号</a>
        </p>
    </div>
</div>
    
<div class="home"><a href="#"><img src="/pgyidc/Application/Home/View/Public/images/home.png"></a></div>  
</body>
</html>