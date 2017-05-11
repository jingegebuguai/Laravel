@extends('layout.index')

@section('title','小米商城')
@section('css')


    <script type="text/javascript" async="" src="http://a.stat.xiaomi.com/js/mstr.js?mstpid=a5543b161410aa8b-3306e9b581810c0b&amp;mid=&amp;phpsessid=&amp;mstuid=1469708547901_2895&amp;sessionId=1073614414&amp;muuid=&amp;mucid=&amp;mstprevpid=a5543b161410aa8b-3306e9b581810c0b&amp;lastsource=dami.com&amp;timestamp=1469723055285&amp;domain=.mi.com&amp;screen=1366*768&amp;language=zh-CN&amp;vendor=Google%20Inc.&amp;platform=Win32&amp;target=javascript%3Avoid(0)%3B&amp;prevtarget=javascript%3Avoid(0)%3B&amp;pid_loc=pcpid&amp;mstprev_pid_loc=pcpid&amp;domain_id=100&amp;pageid=a5543b161410aa8b&amp;curl=http%3A%2F%2Fsearch.mi.com%2Fsearch_%25E6%2589%258B%25E6%259C%25BA&amp;xmv=1469708547901_2895_1469721279109&amp;v=1.4.10&amp;vuuid=FBLQD4TR22D9FM9B"></script>

    <script type="text/javascript" async="" src="/homes/common/js/unjcV2.js"></script>
    <script type="text/javascript" async="" src="/homes/common/js/jquery-1.9.1.min.js"></script>

    <script src="/homes/common/js/base.min.js"></script>

    <script type="text/javascript" async="" src="/homes/common/js/jquery.statData.min.js"></script>
    <script type="text/javascript" async="" src="/homes/common/js/xmst.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">

    <title>小米商城</title>

    <link rel="shortcut icon" href="http://s01.mifile.cn/favicon.ico" type="image/x-icon">
    <link rel="icon" href="http://s01.mifile.cn/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/homes/common/css/base.min.css">
    <link rel="stylesheet" href="/homes/common/css/list.min.css">

    <script type="text/javascript">var _head_over_time = (new Date()).getTime();</script>

@endsection
@section('content')
<!-- 面包屑 -->
<div class="breadcrumbs">
    <div class="container">
        <a href="/" data-stat-id="b0bcd814768c68cc" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-b0bcd814768c68cc&#39;, &#39;//www.mi.com/index.html&#39;, &#39;pcpid&#39;]);">首页</a><span class="sep">&gt;</span><a href="http://search.mi.com/search_%E6%89%8B%E6%9C%BA" data-stat-id="c80dafcf0a25c533" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-c80dafcf0a25c533&#39;, &#39;//search.mi.com/search_手机&#39;, &#39;pcpid&#39;]);">全部结果</a><span class="sep">&gt;</span><span>手机</span>
    </div>
</div>

<!-- 分类条 -->
<div class="container">
    <div class="filter-box">
        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-3">
                <dt>分类：</dt>
                <dd class="active">全部</dd>
                @foreach($cates as $cate)
                    <dd><a href="?id={{$cate->id}}" data-stat-id="b120dec55d40e599" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-b120dec55d40e599&#39;, &#39;//search.mi.com/search_手机-10&#39;, &#39;pcpid&#39;]);">{{$cate->name}}</a></dd>
                @endforeach
            </dl>
            <a class="more J_filterToggle" href="javascript: void(0);" data-stat-id="3306e9b581810c0b" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-3306e9b581810c0b&#39;, &#39;javascript:void(0);&#39;, &#39;pcpid&#39;]);">更多<i class="iconfont"></i></a>
        </div>




        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-4">
                <dt>机型：</dt>
                <dd class="active">全部</dd>

                @foreach($search_goods as $search_good)
                    <dd><a href="/detail?id={{$search_good->id}}" data-stat-id="4e1a960f60c0ad53" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-4e1a960f60c0ad53&#39;, &#39;//search.mi.com/search_手机-0-54321&#39;, &#39;pcpid&#39;]);">{{$search_good->title}}</a></dd>
                @endforeach

            </dl>
            <a class="more J_filterToggle" href="javascript: void(0);" data-stat-id="3306e9b581810c0b" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-3306e9b581810c0b&#39;, &#39;javascript:void(0);&#39;, &#39;pcpid&#39;]);">更多<i class="iconfont"></i></a>
        </div>



        <div class="filter-list-wrap">
            <dl class="filter-list clearfix filter-list-row-2">
                <dt>最新：</dt>
                <dd class="active">部分</dd>
                @foreach($goods as $good)
                    <dd>
                        <a href="/detail?id={{$good->id}}" data-stat-id="c6199f21493cb057" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-c6199f21493cb057&#39;, &#39;//search.mi.com/search_手机-0-0-1&#39;, &#39;pcpid&#39;]);">{{$good->title}}</a>
                    </dd>
                @endforeach
            </dl>
            <a class="more J_filterToggle" href="javascript: void(0);" data-stat-id="3306e9b581810c0b" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-3306e9b581810c0b&#39;, &#39;javascript:void(0);&#39;, &#39;pcpid&#39;]);">更多<i class="iconfont"></i></a>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="order-list-box clearfix">
            <ul class="order-list">
                <li><a href="http://search.mi.com/search_%E6%89%8B%E6%9C%BA-0-0-0-0-1-0-0-0-1" rel="nofollow" data-stat-id="2d1a3ac1827fbdfb" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-2d1a3ac1827fbdfb&#39;, &#39;//search.mi.com/search_手机-0-0-0-0-1-0-0-0-1&#39;, &#39;pcpid&#39;]);">新品</a></li>
                <li class="up"><a href="http://search.mi.com/search_%E6%89%8B%E6%9C%BA-0-0-0-0-10-0-0-0-1" rel="nofollow" data-stat-id="793a6c578cc932be" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-793a6c578cc932be&#39;, &#39;//search.mi.com/search_手机-0-0-0-0-10-0-0-0-1&#39;, &#39;pcpid&#39;]);">价格 <i class="iconfont"></i></a></li>
                <li><a href="http://search.mi.com/search_%E6%89%8B%E6%9C%BA-0-0-0-0-3-0-0-0-1" rel="nofollow" data-stat-id="344a8be3a85a2a04" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-344a8be3a85a2a04&#39;, &#39;//search.mi.com/search_手机-0-0-0-0-3-0-0-0-1&#39;, &#39;pcpid&#39;]);">评论最多</a></li>
            </ul>

        </div>

        <!-- 商品展示 -->
        <div class="goods-list-box">
            <div class="goods-list clearfix">

                @foreach($search_goods as $search_good)
                    <div class="goods-item">
                        <div class="figure figure-img">
                            <a href="/detail?id={{$search_good->id}}" data-stat-id="f9c0265126b0aab7" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-f9c0265126b0aab7&#39;, &#39;//www.mi.com/mi5/&#39;, &#39;pcpid&#39;]);">
                                <img src="{{$search_good->showImg}}" width="200" height="200" alt="">
                            </a>
                        </div>
                        <p class="desc"></p>
                        <h2 class="title">
                            <a href="/detail?id={{$search_good->id}}" data-stat-id="cdded373f9d107a4" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-cdded373f9d107a4&#39;, &#39;//www.mi.com/mi5/&#39;, &#39;pcpid&#39;]);">
                                {{$search_good->title}}
                            </a>
                        </h2>
                        <p class="price">{{$search_good->price}} 起</p>
                        <div class="thumbs">
                            <ul class="thumb-list">
                                <li data-config="{&quot;cid&quot;:&quot;1160800057&quot;,&quot;gid&quot;:&quot;0&quot;,&quot;discount&quot;:&quot;0&quot;,&quot;price&quot;:&quot;1999\u5143 \u8d77&quot;,&quot;new&quot;:0,&quot;is-cos&quot;:0,&quot;package&quot;:1,&quot;hasgift&quot;:0,&quot;postfree&quot;:0,&quot;postfreenum&quot;:1,&quot;cfrom&quot;:&quot;search&quot;}"><a data-stat-id="efb530fe034a2407" onclick="_msq.push([&#39;trackEvent&#39;, &#39;a5543b161410aa8b-efb530fe034a2407&#39;, &#39;&#39;, &#39;pcpid&#39;]);">
                                        <img src="{{$search_good->cate->img}}" width="34" height="34" alt="小米手机5 白色">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="actions clearfix">
                            <a class="btn-like J_likeGoods" data-cid="1160800057" onclick="return false;" data-stat-id="ff751b1fdf797192" >
                                <i class="iconfont"></i>
                                <span>喜欢</span>
                            </a>
                            <a class="btn-buy btn-buy-detail J_buyGoods" href="" data-stat-id="8865b1987126dcb9" onclick="return false;">
                                <span>立即购买</span>
                                <i class="iconfont"></i>
                            </a>
                        </div>
                        <div class="flags"></div>
                        <div class="notice"></div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</div>
@endsection


@section('LDjs')
<script>
    (function() {
        MI.namespace('GLOBAL_CONFIG');
        MI.GLOBAL_CONFIG = {
            orderSite: '//order.mi.com',
            wwwSite: '//www.mi.com',
            cartSite: '//cart.mi.com',
            itemSite: '//item.mi.com',
            assetsSite: '//s01.mifile.cn',
            listSite: '//list.mi.com',
            searchSite: '//search.mi.com',
            mySite: '//my.mi.com',
            damiaoSite: '//tp.hd.mi.com/',
            damiaoGoodsId: [],
            logoutUrl: '//order.mi.com/site/logout',
            staticSite: '//static.mi.com',
            quickLoginUrl: 'https://account.xiaomi.com/pass/static/login.html'
        };
        MI.setLoginInfo.orderUrl = MI.GLOBAL_CONFIG.orderSite + '/user/order';
        MI.setLoginInfo.logoutUrl = MI.GLOBAL_CONFIG.logoutUrl;
        MI.setLoginInfo.init(MI.GLOBAL_CONFIG);
        MI.miniCart.init();
        MI.updateMiniCart();
    })();
</script>
<script src="/homes/common/js/xmsg_ti.js"></script>

<script>
    var SITE_ID = "Search";
    var SEARCH_WORDS = "手机";
</script>
<script src="/homes/common/js/goodsList.min.js"></script>
    <script>
    var _msq = _msq || [];
    _msq.push(['setDomainId', 100]);
    _msq.push(['trackPageView']);
    (function() {
        var ms = document.createElement('script');
        ms.type = 'text/javascript';
        ms.async = true;
        ms.src = '//c1.mifile.cn/f/i/15/stat/js/xmst.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ms, s);
    })();
    $()

    </script>
@endsection