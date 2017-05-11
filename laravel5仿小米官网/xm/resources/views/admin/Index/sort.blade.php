@extends('layout.admin')
@section('title','分类导航生成')

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 分类导航生成</span>
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
        <form id="cate" class="mws-form" action="/admin/indexPage/staradd" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <span class="btn btn-primary" id="create">生成分类导航js文件</span>
                    @if(file_exists('./data/indexData.js'))
                        <a href="/data/indexData.js" target="_blank">查看js文件</a>
                    @endif
                </div>

            </div>
        </form>
    </div>      
</div>  
@endsection
@section('myJs')
<script>
$(function(){
    $('#create').on('click',function(){
        $.ajax({
            url:'/admin/indexPage/sortnav',
            type:'GET',
            success:function(data){
                if(!!data){
                    if(!$('.mws-form-row').find('a').length){
                        $('.mws-form-row').append('<a href="/data/indexData.js" target="_blank">查看js文件</a>');
                    }
                    alert('导航js文件更新成功');
                }else{
                    alert('未知错误');
                }
            }
        });
    })
});
</script>
@endsection