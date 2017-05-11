@extends('layout.admin')
@section('title','订单状态编辑页')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 订单状态编辑</span>
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
        <form id="cate" class="mws-form" action="/admin/order/edit" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">订单编号</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" disabled name="order_num"  value="{{$order->order_num}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">订单状态</label>
                    <div class="mws-form-item">
                         <select id="select" class="large" name="status">
                            @foreach($status as $k=>$v)
                            <option value="{{$k}}" @if($k==$order->order_status) selected @endif>{{$v}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$order->id}}">
                <input type="submit" value="提交" class="btn btn-danger">
                <input type="reset" value="重置" class="btn ">
            </div>
        </form>
    </div>      
</div>        
@endsection
@section('myJs')
    <script>
    
    </script>
@endsection