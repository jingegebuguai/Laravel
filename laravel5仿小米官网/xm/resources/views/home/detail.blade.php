@extends('layout.index')
@section('title','小米商城')

@section('css')
    <title>小米商城</title>
    <style type="text/css">
        img{
            width: auto;
        }
        .attr{
            line-height: 45px;
            width:150px;
            float: left;
            display: block;
            border: 1px solid #e0e0e0;
            text-align: center;
            height: 45px;
            margin: 10px;
            overflow: hidden;
        }
        .attr:hover{
            border-color: #ff6700;
        }
        .smallAttr{
            line-height: 40px;
            width:60px;
            float: left;
            display: block;
            text-align: center;
            height: 45px;
            margin: 10px;
        }
        .float{
            float: left;
        }
        .hidden{
            display:none;
        }
        .select{
            border-color: #ff6700;
        }
    </style>
    <script src="/homes/common/js/jquery-1.9.1.min.js"></script>
    <link rel="shortcut icon" href="http://s01.mifile.cn/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="http://s01.mifile.cn/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/homes/common/css/base.min.css" />
    <link rel="stylesheet" type="text/css" href="/homes/common/css/goods-detail.min.css" />
@endsection



@section('content')
<!-- E 面包屑 -->
<div class="goods-detail">
    <div class="goods-detail-info  clearfix J_goodsDetail">
        <div class="container">
            <div class="row">
                <div class="span13  J_mi_goodsPic_block goods-detail-left-info">
                    <div class="goods-pic-box  " id="J_mi_goodsPicBox">
                        <div class="goods-big-pic J_bigPicBlock">
                            <img src="{{$good->showImg}}" class="J_goodsBigPic" id="J_BigPic" />
                        </div>
                        <div class="goods-pic-loading">
                            <div class="loader loader-gray"></div>
                        </div>
                        <div class="goods-small-pic clearfix">
                            <ul id="goodsPicList">
                                @foreach($good->img as $img)
                                <li class="current"><img src="{{$img}}" /> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="span11 goods-batch-img-list-block J_goodsBatchImg">
                    </div>
                </div>
                <div class="span7 goods-info-rightbox">
                    <div class="goods-info-leftborder"></div>
                    <form action="##" method="get" id="yourformid">
                        <dl class="goods-info-box ">
                        <dt class="goods-info-head">
                        <dl id="J_goodsInfoBlock">
                            <dt id="goodsName" class="goods-name">
                                {{$good->title}}
                            </dt>

                            <dd class="goods-phone-type">
                                <p> </p>
                            </dd>
                            <dd class="goods-info-head-price clearfix">
                                <b class="J_mi_goodsPrice"> {{$good->price}}</b>
                                <i>&nbsp;元</i>
                                <del>
                                    <span class="J_mi_marketPrice"></span>
                                </del>
                            </dd>

                            {{--遍历版本    --}}
                            <dd style="margin-top: 15px;">
                                <span >选择 版本</span>
                                <div class="clearfix">
                                    @foreach($good->attr as $attr =>$colors)

                                    <div class="attr" name="attr" title="{{$attr}}" id="attr" price="{{$good->skus()->where('attr',$attr)->first()->price}}">
                                        {{$attr}}
                                    </div>

                                    @endforeach
                                </div>
                            </dd>

                            <!--颜色-->
                            @foreach($good->attr as $attr =>$colors)
                                <dd class="goods-info-head-colors clearfix" >
                                    <div class="hidden" num="{{$attr}}" name="hidden">
                                        <span class="goods-info-head-colors clearfix">选择 颜色</span >
                                        @foreach($colors as $k =>$color)
                                        <div  class="float">
                                            <div>
                                                <a href="" class="smallAttr" name="color" title="{{$color}}" data-stat-id="bd7cb1fe26f82654" id="color">{{$color}}</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </dd>
                            @endforeach
                            <!--颜色-->



                                <input type="hidden" name="sku_attr" value="">
                                <input type="hidden" name="good_id" value="{{$good->id}}">
                                <input type="hidden" name="sku_color" value="">
                                <input type="hidden" name="sku_price" value="">
                                <input type="hidden" name="num" value="1">
                                <dd class="goods-info-head-cart" id="goodsDetailBtnBox">
                                    <button disabled="disabled" href="http://cart.mi.com/cart/add/2161600004" id="goodsDetailAddCartBtn" class="btn  btn-primary goods-add-cart-btn" data-disabled="false" data-gid="2161600004" data-package="0" data-stat-id="e7ed8543f67c5bd7" > <i class="iconfont"></i>加入购物车 </button>
                                    <a id="goodsDetailCollectBtn" data-isfavorite="false" class=" btn btn-gray  goods-collect-btn " data-stat-id="9d1c11913f946c7f" > <i class="iconfont default"></i> <i class="iconfont red"></i><i class="iconfont red J_redCopy"></i>喜欢 </a>
                                </dd>
                                <dd class="goods-info-head-userfaq">
                                    <ul>
                                        <li class="J_scrollHref" data-href="#goodsComment" data-index="2"> <i class="iconfont"></i> 评价<b>3090</b> </li>
                                        <li class="J_scrollHref " data-href="#goodsComment" data-index="2"> <i class="iconfont"></i> 满意度<b>99.1%</b> </li>
                                    </ul>
                                </dd>
                        </dl>
                        </dt>

                    </dl>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="full-screen-border"></div>
    <div class="goods-detail-nav" id="goodsDetail">
        <div class="container">
            <ul class="detail-list J_detailNav J_originNav">
                <li class="current detail-nav"> <a data-href="#goodsDesc" data-index="0" class="J_scrollHref" data-stat-id="2f27371406a047cd" >详情描述</a> </li>
                <li class="detail-nav"> <a data-href="#goodsParam" data-index="1" class="J_scrollHref" data-stat-id="bbde2caff4f4853c" href="#info">规格参数</a> </li>
                <li class="detail-nav"> <a data-href="#goodsComment" data-index="2" class="J_scrollHref" data-stat-id="158b28b83a4cca1a" href="#comment">评价晒单 </a> </li>
            </ul>
        </div>
    </div>
    <div class="full-screen-border"></div>
    <div class="goods-detail-desc J_itemBox" id="goodsDesc">
        <div class="container" >
            <div class="shape-container" >

                    {!! $good->content !!}

            </div>
        </div>
    </div>
    <div class="goods-detail-nav-name-block J_itemBox" id="goodsParam">
        <div class="container main-block">
            <div class="border-line"></div>
            <h2 class="nav-name" name="info" id="info">规格参数</h2>
        </div>
    </div>



    <!--规格-->
    <style>
        .table tr,td{
            border: 1px solid #e0e0e0;
            height: 80px;
            text-align: center;
            width: 400px;
        }
    </style>
    @foreach($good->info as $attr => $info)
    <div class="goods-detail-param  J_itemBox hidden" num="{{$attr}}">

        <div class="container table" >


            {!! $info !!}
        </div>
    </div>
    @endforeach

    <!--规格结束-->

    <div class="goods-detail-nav-name-block J_itemBox" id="goodsComment">
        <div class="container main-block">
            <div class="border-line"></div>
            <h2 class="nav-name">评价晒单</h2>
        </div>
    </div>
    <!--评价-->
    <div class="goods-detail-comment J_itemBox hasContent" id="goodsCommentContent">
        <div class="goods-detail-comment-groom" id="J_recommendComment">
            <div class="container">
                <ul class="main-block">
                    <li class="percent">
                        <div class="per-num">
                            <i>99.1</i>%
                        </div>
                        <div class="per-title">
                            购买后满意
                        </div>
                        <div class="per-amount">
                            <i>3097</i>名用户投票
                        </div>
                    </li>

                    <li class="item-rainbow-3 groom-content">
                        <dl>
                            <dt>
                            <div class="groom-content-userImage">
                                <img src="/homes/common/image/u6bPscBa4MZjpi_90.jpg" alt="" />
                            </div>
                            <div class="groom-content-userName">
                                王欢
                            </div>
                            <div class="groom-content-commentNum">
                                53人有相似评价
                            </div>
                            </dt>
                            <dd>
                                <i class="iconfont"></i> 手感很好 大小合适 开窗很大
                            </dd>
                        </dl>
                    </li>

                    <li class="item-rainbow-2 groom-content">
                        <dl>
                            <dt>
                            <div class="groom-content-userImage">
                                <img src="/homes/common/image/head_3.png" alt="" />
                            </div>
                            <div class="groom-content-userName">
                                海涛
                            </div>
                            <div class="groom-content-commentNum">
                                7人有相似评价
                            </div>
                            </dt>
                            <dd>
                                <i class="iconfont"></i> 非常不错！很贴合，手感也好！
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>

        <div class="goods-detail-comment-content" id="J_commentDetailBlock">
            <div class="container">
                <div class="row">
                    <div class="span14 goods-detail-comment-list">
                        <div class="comment-order-title">
                            <div class="left-title">
                                <h3 class="comment-name">最有帮助的评价</h3>
                            </div>
                        </div>
                        <ul class="comment-box-list" id="J_supComment">

                            @foreach($good->comments as $k=>$comment)
                            <!--******评价********-->
                            <li class="item-rainbow-1" data-id="134117576">
                                <div class="user-image">
                                    <img src="{{$comment->user->pic}}" alt="" />
                                </div>
                                <div class="user-emoj">
                                    喜欢
                                    <i class="iconfont"></i>
                                </div>
                                <div class="user-name-info">
                                    <span class="user-time">{{$comment->created_at}}</span>
                                </div>

                                <dl class="user-comment">
                                    <dt class="user-comment-content J_commentContent">
                                    <p class="content-detail"> <a href="http://order.mi.com/comment/commentDetail/comment_id/134117576" target="_blank"> {{$comment->content}} </a> </p>
                                    </dt>
                                    {{--<dd class="user-comment-self-input">--}}
                                        {{--<div class="input-block">--}}
                                            {{--<input type="text" placeholder="回复楼主" class="J_commentAnswerInput" />--}}
                                            {{--<a href="javascript:void(0);" class="btn  answer-btn J_commentAnswerBtn" data-commentid="134117576">回复</a>--}}
                                        {{--</div>--}}
                                    {{--</dd>--}}
                                    {{--<dd class="user-comment-answer">--}}
                                        {{--<img class="self-image" src="/homes/common/image/head_4.png" alt="" />--}}
                                        {{--<p>和我换- <span class="answer-user-name">268707921</span> </p>--}}
                                    {{--</dd>--}}
                                </dl>
                            </li>
                            <!--******评价结束********-->
                            @endforeach






                        </ul>
                    </div>
                    <div class="span6 goods-detail-comment-timeline">
                        <h3 class="comment-name" id="comment" name="comment">最新评价</h3>
                        <ul class="comment-timeline-list" id="J_timelineComment">

                        @foreach($good->comments()->orderBy('created_at','desc')->take('2')->get() as $k=>$comment)
                            <!--******最新回复********-->
                            <li class="purple timelineunit J_commentContent" data-id="135575831"> <p class="line-content"> <a href="http://order.mi.com/comment/commentDetail/comment_id/135575831" target="_blank">{{$comment->content}}</a> </p>
                                <div class="line-foot">
                                    <div class="line-left">
                                        来自于 {{$comment->user->username}}
                                    </div>

                                </div>
                                <div class="line-dot item-rainbow-4"></div>
                            </li>
                            <!--******最新回复结束********-->
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
@section('js')

<script src="/data/indexNav.js"></script>
<script src="/data/indexData.js"></script>

<script src="/homes/common/myjs/common.js"></script>

@show
@section('LDjs')
<script type="text/javascript">
    $('[name="attr"]').click(function () {
        var attr = $(this).attr('title');
        var price = $(this).attr('price');
        $('input[name="sku_attr"]').val(attr);
        $('input[name="sku_price"]').val(price);

        $('[class="J_mi_goodsPrice"]').html(price);

        $(this).siblings().attr('class','attr');
        $(this).attr('class','attr select');
        $('[name="hidden"]').attr('class','hidden');
        $('[num="'+attr+'"]').attr('class','').siblings('[num]').attr('class','hidden');

    });
    $('[name="color"]').click(function () {
        var color = $(this).html();


        $('[name="color"]').attr('class','smallAttr');
        $(this).attr('class','smallAttr current');
        $('input[name="sku_color"]').val(color);

        $('button').removeAttr('disabled');
        return false;
    });

    $('#goodsDetailAddCartBtn').click(function () {

        console.log($('#yourformid').serialize());
//        return false;
        $.ajax({

            type: "get",
            dataType:'json',
            url:"/cart/ajaxaddcart",
            data:$('#yourformid').serialize(),// 你的formid
            async: false,
            error: function() {
                alert("系统错误请稍后再试!");
            },
            success: function(data) {

                if(data.status==0){
                    var r=confirm("添加成功,去购物车结算");
                    if (r==true)
                    {
                        window.location.href="/cart";
                    }

                }else{
                    alert('您的商品被江洋大盗劫走了,我们会很快抓住他的,请您稍后再试!');
                }
            }
        });
        return false;
    });
</script>
@endsection