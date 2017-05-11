@extends('layout.admin')
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
        <form id="cate" class="mws-form" action="/admin/indexPage/navadd" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="nav_name">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">sku商品选择</label>
                    <div class="mws-form-item">
                         <select id="select" multiple="multiple" size="10" class="large">
                            @foreach($skus as $k=>$v)
                            <option value="{{$v->id}}" mtitle="{{$v->bt}}" atitle="{{$v->title}}">{{$v->title}}--------------------------￥{{$v->price}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">导航栏目关联skuid</label>
                    <div class="mws-form-item">
                        <p class="tips" style="color:red">这里是点击添加商品选择后自动添加的商品sku,最多6个(双击删除该选项)</p>
                        <p id="info"></p>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" name="status" value="1" checked> <label>启用</label></li>
                            <li><input type="radio" name="status" value="0"> <label>禁用</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="hidden" name="sku_id_group" value="">
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
        var data = [];
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