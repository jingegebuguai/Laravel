@extends('layout.admin')
@section('title','导航栏目编辑页面')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 导航栏目添加</span>
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
        <form id="cate" class="mws-form" action="/admin/indexPage/navedit" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="nav_name"  value="{{$nav->nav_name}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">sku商品选择</label>
                    <div class="mws-form-item">
                         <select id="select" multiple="multiple" size="10" class="large">
                        @if(!empty($skus))
                            @foreach($skus as $k=>$v)
                            <option value="{{$v->id}}" mtitle="{{$v->bt}}" atitle="{{$v->title}}">[{{$v->id}}]--{{$v->title}}--------------------------￥{{$v->price}}</option>
                            @endforeach
                        @endif
                        </select>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目关联skuid</label>
                    <div class="mws-form-item">
                        <p class="tips" style="color:red">这里是点击添加商品选择后自动添加的商品sku,最多6个(双击删除该选项)</p>
                        <p id="info">
                        @if(!empty($data[0])&&count($data))
                            @foreach($data as $k=>$v)
                                <span did="{{$v->id}}" class="btn">{{$v->title}}</span>
                            @endforeach
                        @endif
                        </p>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目关联商品信息</label>
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
                        @if(!empty($data[0]))
                            @foreach($data as $k=>$v)
                            <li class="col-md-2" did="{{$v->id}}">
                                <!-- <span class="close icon-remove"></span> -->
                                <img src="{{$v->img}}" alt="" with="30%">
                                <p>{{$v->title}}</p>
                                <p>{{$v->price}}</p>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                        <br>
                        <p style="color:orange;" class="clearfix">当前关联sku产品信息</p>
                    </div>
                </div> 
                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目url地址(看需求设置)</label>
                    <div class="mws-form-item">
                        <input type="text" class="large" name="nav_url"  value="{{$nav->nav_url}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" name="status" value="1" @if($nav->status) checked @endif> <label>启用</label></li>
                            <li><input type="radio" name="status" value="0"@if($nav->status == 0) checked @endif> <label>禁用</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="hidden" name="sku_id_group" value="{{$nav->sku_id_group}}">
                <input type="hidden" name="id" value="{{$nav->id}}">
                <input type="submit" value="提交" class="btn btn-danger">
                <input type="reset" value="重置" class="btn ">
            </div>
        </form>
    </div>      
</div>        
@endsection
@section('myJs')
    <script>
    $(function(){
        var data = '{{$nav->sku_id_group}}'.split(',');
        $('#select').find('option').on('click',function(){
            var len = $('#info').find('span').length;
            var tid = $(this).attr('value');
            //判断当前值是否已经点击过了

            if($.inArray(tid,data)>-1){
                return;
            }
            if(data.length>=6){
                $('#info').find('span').first().remove();
                data.shift();
            }
            data.push(tid);
            $('<span class="btn"></span>').html($(this).attr('atitle')).appendTo('#info');

            $('input[name=sku_id_group]').val(data.join(','));
        })
        $('#info').on('dblclick','span',function(ev){
            ev.preventDefault();
            var index = $(this).index();
            data.splice(index,1);
            $(this).remove();
            $('input[name=sku_id_group]').val(data.join(','));
        })
    });
    </script>
@endsection