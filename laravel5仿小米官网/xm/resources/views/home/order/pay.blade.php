@extends('layout.index')
@section('title','去付款')
@section('css')
    <link rel="shortcut icon" href="//s01.mifile.cn/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="//s01.mifile.cn/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="//s01.mifile.cn/css/base.min.css?v2016d22" />
    <link rel="stylesheet" type="text/css" href="//s01.mifile.cn/css/pay-confirm.min.css?v=2016063001" />
@endsection
@section('header')
    <div class="site-header site-mini-header">
        <div class="container">
            <div class="header-logo">
                <a class="logo " href="/" title="小米官网"></a>
            </div>
            <div class="header-title" id="J_miniHeaderTitle"><h2>订单支付</h2></div>
        </div>
    </div>
@endsection
@section('content')
    <div class="page-main">
        <div class="container confirm-box">
            <form target="_blank" action="#" id="J_payForm" method="post">
                <div class="section section-order">
                    <div class="order-info clearfix">
                        <div class="fl">
                            <h2 class="title">订单提交成功！去付款咯～</h2>
                            <p class="order-time" id="J_deliverDesc">
                                现在支付，预计2-3天送达
                                <span class="beta">Beta</span>
                            </p>
                            <p class="order-time">
                                请在
                                <span class="pay-time-tip">{{$countTime}}</span>
                                内完成支付, 超时后将取消订单
                            </p>
                            <p class="post-info" id="J_postInfo">
                                收货信息：{{$order->consignee}} {{$order->phone}} &nbsp;&nbsp;
                            {{$order->province}}&nbsp;&nbsp;{{$order->city}}&nbsp;&nbsp;{{$order->district}}&nbsp;&nbsp;{{$order->address}}
                            </p>
                        </div>
                        <div class="fr">
                            <p class="total">
                                应付总额：
                                <span class="money"> <em>{{$order->total_price}}</em>
                                    元
                                </span>
                            </p>
                            <a href="javascript:void(0);" class="show-detail" id="J_showDetail">
                                订单详情 <i class="iconfont">&#xe61c;</i>
                            </a>
                        </div>
                    </div> <i class="iconfont icon-right">&#x221a;</i>
                    <div class="order-detail">
                        <ul>
                            <li class="clearfix">
                                <div class="label">订单号：</div>
                                <div class="content">
                                    <span class="order-num">{{$order->order_num}}</span>
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="label">收货信息：</div>
                                <div class="content">
                                    收货信息：{{$order->consignee}} {{$order->phone}} &nbsp;&nbsp;
                            {{$order->province}}&nbsp;&nbsp;{{$order->city}}&nbsp;&nbsp;{{$order->district}}&nbsp;&nbsp;{{$order->address}}
                                </div>
                            </li>
                            <li class="clearfix">
                                <div class="label">商品名称：</div>
                                <div class="content">
                                    @foreach($order->orderGoods as $k=>$v)
                                        {{$v->goods_name}} <br/>
                                    @endforeach
                                    
                                </div>
                            </li>
                            <!-- <li class="clearfix">
                                <div class="label">配送时间：</div>
                                <div class="content">不限送货时间</div>
                            </li>
                            <li class="clearfix">
                                <div class="label">发票信息：</div>
                                <div class="content">个人电子发票</div>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <div class="section section-payment">
                    <div class="cash-title" id="J_cashTitle">选择以下支付方式付款</div>

                    <!-- <div class="payment-box">
                    <div class="payment-header clearfix">
                        <h3 class="title">最近使用过:</h3>
                    </div>
                    <div class="payment-body">
                        <ul class="clearfix payment-list J_paymentList J_linksign-customize">
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                -->
                <div class="payment-box ">
                    <div class="payment-header clearfix">
                        <h3 class="title">支付平台</h3>
                        <span class="desc"></span>
                    </div>
                    <div class="payment-body">
                        <ul class="clearfix payment-list J_paymentList J_linksign-customize">
                            <li id="J_weixin" >
                                <img src="//c1.mifile.cn/f/i/15/pay/wechat0715.jpg" alt="" style="margin-left: 0;"/>
                            </li>
                            <li class="J_bank">
                                <a href="/order/payfor?method=qg" id="PayByqg">网络支付</a>
                            </li>
                            <li class="J_bank">
                                <input type="radio" name="payOnlineBank" id="alipay" value="alipay" />
                                <a href="/order/pay"><img src="//c1.mifile.cn/f/i/15/pay/alipay-0718-1.png" alt="" style="margin-left: 0;"/>
                            </li>
                            <li class="J_bank">
                                <input type="radio" name="payOnlineBank" id="unionpay" value="unionpay" />
                                <img src="//s01.mifile.cn/i/banklogo/unionpay.png?ver2015" alt="" style="margin-left: 0;"/>
                            </li>
                            <li class="J_bank">
                                <input type="radio" name="payOnlineBank" id="cft" value="cft" />
                                <img src="//s01.mifile.cn/i/banklogo/cft.png" alt="" style="margin-left: 0;"/>
                            </li>
                            <li class="J_bank">
                                <input type="radio" name="payOnlineBank" id="micash" value="micash" />
                                <img src="//s01.mifile.cn/i/banklogo/micash.png?ver2015" alt="" style="margin-left: 0;"/>
                            </li>
                        </ul>
                        <div class="event-desc">
                            <p>微信支付：关注小米手机微信公众号，支付成功后可领取3-10元电影票红包。</p>
                            <p>支 付 宝：支付宝扫码支付满38元，参与赢取1999元红包</p>
                            <p>蚂蚁花呗分期：花呗分期支付成功抽红包，笔笔中奖，最高999元</p>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')

<script src="/homes/common/myjs/jquery.min.js"></script>
<script>
$(function(){
    $('#J_showDetail').on('click',function(){
        $('.order-detail').slideToggle();
    })
})
</script>      
@endsection