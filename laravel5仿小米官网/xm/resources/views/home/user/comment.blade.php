@extends('layout.index')
@section('title','我的评论')
@section('css')
<link rel="stylesheet" href="/homes/common/css/base.min.css" />
<link rel="stylesheet" href="/homes/common/css/main.min.css" />
<link rel="stylesheet" href="/homes/common/css/address-edit.min.css" />
@endsection

@section('content')
    <div class="breadcrumbs">
        <div class="container">
            <a href='//www.mi.com/index.html'>首页</a>
            <span class="sep">&gt;</span>
            <span>商品评价</span>
        </div>
    </div>

    <div class="page-main user-main">
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="uc-box uc-sub-box">
                        <div class="uc-nav-box">
                            <div class="box-hd">
                                <h3 class="title">订单中心</h3>
                            </div>
                            <div class="box-bd">
                                <ul class="uc-nav-list">
                                    <li>
                                        <a href="/user/order/">我的订单</a>
                                    </li>
                                    
                                    <li>
                                        <a href="/user/comment/">评价晒单</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="uc-nav-box">
                            <div class="box-hd">
                                <h3 class="title">个人中心</h3>
                            </div>
                            <div class="box-bd">
                                <ul class="uc-nav-list">

                                    
                                    <li class="active">
                                        <a href="/user/address">收货地址</a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="span16">
                    <div class="uc-box uc-main-box">
                        <div class="uc-content-box">
                            <div class="box-hd">
                                <h1 class="title">商品评价</h1>
                                <div class="more clearfix">
                                    <ul class="filter-list J_addrType">
                                        <li class="first @if($request->input('filter')==1) active @endif">
                                            <a href="/user/comment?filter=1">待评价商品（{{count($goodsNo)}}）</a>
                                        </li>
                                        <li class=" @if($request->input('filter')==2) active @endif">
                                            <a href="/user/comment?filter=2">已评价商品（{{count($goodsYes)}}）</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="box-bd">
                                <div class="xm-goods-list-wrap">
                                    <ul class="xm-goods-list clearfix">
                                    @if($request->input('filter')==1||empty($request->input('filter')))
                                        @if(empty($goodsNo))
                                            <li>
                                            暂无数据
                                            </li>
                                        @else
                                        @foreach($goodsNo as $k=>$v)
                                        <li class="xm-goods-item">
                                            <div class="figure figure-img">
                                                <a href="/detail?id={{$v->good_id}}" target="_blank">
                                                    <img src="{{$v->img}}" />
                                                </a>
                                            </div>
                                            <h3 class="title">
                                                <a href="/detail?id{{$v->good_id}}">{{$v->title}}</a>
                                            </h3>
                                            <p class="price">{{$v->price}}元</p>
                                            <p class="rank">{{$v->good->comments()->count()}}人评价</p>
                                            <div class="actions">
                                                <a class="btn btn-primary btn-small J_btnComment" data-gid="2161000055" href="/comment?id={{$v->good_id}}&order_id={{$v->order_id}}">去评价</a>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif
                                    @endif
                                    @if($request->input('filter')==2)
                                        @if(empty($goodsYes))
                                            <li>
                                            暂无数据
                                            </li>
                                        @else
                                        @foreach($goodsYes as $k=>$v)
                                        <li class="xm-goods-item">
                                            <div class="figure figure-img">
                                                <a href="/detail?id{{$v->good_id}}" target="_blank">
                                                    <img src="{{$v->img}}" />
                                                </a>
                                            </div>
                                            <h3 class="title">
                                                <a href="/detail?id{{$v->good_id}}">{{$v->title}}</a>
                                            </h3>
                                            <p class="price">{{$v->price}}元</p>
                                            <p class="rank">{{$v->good->comments()->count()}}人评价</p>
                                        </li>
                                        @endforeach
                                        @endif
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')
<script src="/homes/common/myjs/jquery.min.js"></script>
<script src="/data/indexNav.js"></script>
<script src="/data/indexData.js"></script>
<script src="/homes/common/myjs/common.js"></script>
@endsection
