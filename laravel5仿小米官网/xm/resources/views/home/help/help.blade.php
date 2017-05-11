@extends('layout.index')
@section('title',$article->helpCate->name)
@section('myCss')
<link rel="stylesheet" href="/homes/common/css/exchange/index.min.css" />
<link rel="stylesheet" href="/homes/common/css/exchange/serviceList.min.css" />
@show
@section('content')
<div class="xm-service-box">
    <!-- 服务支持面包屑 -->
    <div class="container">
        <div class="breadcrumbs">
            <a href="/">首页</a>
            <span class="sep">/</span>
            <a href="//www.mi.com/service/buy/">{{$article->helpCate->name}}</a>
            <span class="sep">/</span>
            <a href="//www.mi.com/service/buy/buytime/">{{$article->helpCate->helpArticle()->find($request->input('id'))->title}}</a>

        </div>
    </div>
    <div class="container clearfix">
        <div class="row">
            <!-- 左侧菜单列表 -->
            <div class="span4">
                <div class="xm-service-sidebar">
                    <div class="content">
                        <div class="xm-sidebar-content">
                            <div class="nav-list" id="serviceMenuList">
                                <h3>{{$article->helpCate->name}}</h3>
                                <ul class="uc-nav-list">
                                @foreach($article->helpCate->helpArticle()->where('status',1)->get() as $k=>$v)
                                    <li @if($v->id==$article->id) class="cur" @endif>
                                        <a href="/help/article?id={{$v->id}}" >{{$v->title}}</a>
                                    </li>
                                @endforeach
                                </ul>
                                <span class="line"></span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span16">
                <div class="content" id="serviceListCon">
                <style>
                .service-right img{max-width: 856px;}
                </style>
                    <div class="service-right">
                        <h2>{{$article->title}}</h2>
                        <div class="service-right-section">
                            {!!$article->content!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection