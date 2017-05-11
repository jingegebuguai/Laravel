@extends('layout.index')
@section('title','我的地址')
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
            <span>收货地址</span>
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
                                <h1 class="title">收货地址</h1>
                            </div>
                            <div class="box-bd">

                                <div class="user-address-list J_addressList clearfix">
                                    <div class="address-item address-item-new" data-type="" id="J_newAddress"> <i class="iconfont">&#xe609;</i>
                                        添加新地址
                                    </div>
                                    @if(!empty($address))
                                    @foreach($address as $k=>$v)
                                    <div class="address-item J_addressItem" 
                                     data-address_id='{{$v->id}}'
                                     data-consignee='{{$v->consignee}}'
                                     data-tel='{{$v->tel}}'
                                     data-province_name='{{$v->province}}'
                                     data-city_name='{{$v->city}}'
                                     data-district_name='{{$v->district}}'
                                     data-address='{{$v->address}}'
                                    >
                                        <dl>
                                            <dt>
                                                <span class="tag"></span> <em class="uname">{{$v->consignee}}</em>
                                            </dt>
                                            <dd class="utel">{{$v->tel}}</dd>
                                            <dd class="uaddress">
                                                {{$v->province}}  {{$v->city}}  {{$v->district}}
                                                <br>{{$v->address}}</dd>
                                        </dl>
                                        <div class="actions">
                                            <!-- <a href="javascript:void(0);" data-id="{{$v->id}}" class="modify J_addressModify">修改</a> --><a href="javascript:void(0);" class="modify J_addressDel">删除</a>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="J_modalEditAddress" class="modal fade modal-hide modal-edit-address">
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="/homes/common/myjs/jquery.min.js"></script>
<script src="/homes/common/js/address_all.js"></script>        
<script src="/homes/common/myjs/address.js"></script>
<script src="/data/indexNav.js"></script>
<script src="/data/indexData.js"></script>
<script src="/homes/common/myjs/common.js"></script>
@endsection
