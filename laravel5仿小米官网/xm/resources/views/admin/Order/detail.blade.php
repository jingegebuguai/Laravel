@extends('layout.admin')
@section("title",'订单详情')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 订单详情</span>
    </div>
    
    <div class="mws-panel-body no-padding">
        @if(count(session('errors')))
        <div class="mws-form-message error">
            错误信息提示:
            <ul>
                @foreach($errors->all() as $k=>$v)
                <li>{{$v}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form id="cate" class="mws-form" action="javascript:void 0;" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">订单id</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" disabled name="id"  value="{{$order->id}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">订单状态</label>
                    <div class="mws-form-item">
                         {{$status[$order->order_status]}}
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">商品信息</label>
                    <div class="mws-form-item">
                        <style>
                            .mws-form-item .row li{
                                float: left;
                                width: 30%;
                                overflow: hidden;
                                text-align: center;
                                border:1px dashed #dedede;
                                position: relative;
                            }
                            .mws-form-item .row .close{
                                width: 30px;
                                height: 30px;
                                position: absolute;
                                top:5px;
                                right:5px;
                                background: orange;
                                cursor: pointer;
                            }
                            .mws-form-item .icon-remove::before{
                                text-align: center;
                                line-height: 30px;
                                font-size: 16px;
                                color:#fff;
                            }
                        </style>
                        <ul class="row" style="list-style:none;overflow: hidden;">
                        @if(!empty($order->orderGoods))
                            @foreach($order->orderGoods as $k=>$v)
                            <li class="col-md-2">
                                <!-- <span class="close icon-remove"></span> -->
                                <img src="{{$v->sku->img}}" alt="" with="30%">
                                <p>{{$v->sku->title}}</p>
                                <p>单价:{{$v->sku->price}}</p>
                                <p>数量:{{$v->num}}</p>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                        <br>
                        <p style="color:orange;" class="clearfix">当前关联sku产品信息</p>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">收件人信息</label>
                    <div class="mws-form-item">
                        收件人:{{$order->consignee}} <br>
                        联系方式:{{$order->phone}}
                    </div>
                </div> 
                <div class="mws-form-row">
                    <label class="mws-form-label">收货地址</label>
                    <div class="mws-form-item">
                        {{$order->province}}--{{$order->city}}--{{$order->district }}<br>
                        {{$order->address}}
                    </div>
                </div>

            </div>
            <div class="mws-button-row">
               
            </div>
        </form>
    </div>      
</div>
@endsection