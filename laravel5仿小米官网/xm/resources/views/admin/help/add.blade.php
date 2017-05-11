@extends('layout.admin')
@section('title','栏目文章添加')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 栏目文章添加<a href="/admin/help/cate" class="btn btn-danger pull-right">栏目文章列表</a></span>

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
        <form id="cate" class="mws-form" action="/admin/help/add" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">文章名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="name">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">文章分类</label>
                    <div class="mws-form-item">
                         <select name="pid"  class="large" id="select">
                            <option value="0">选择分类</option>
                            @foreach($cates as $k=>$v)
                            <option value="{{$v->id}}" @if(!substr_count($v->path,',')) disabled @endif type="{{substr_count($v->path,',')}}" @if($request->input('pid')==$v->id) selected @endif>
                            {{$v->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">文章内容</label>
                    <div class="mws-form-item clearfix">
                        <script id="editor" name="content" type="text/plain" style="height:320px;"></script>
                    </div>
                </div>
                <!-- <div class="mws-form-row">
                    <label class="mws-form-label">设置文章地址(可选)</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="url">
                    </div>
                </div> -->
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
                <input type="submit" value="提交" class="btn btn-danger">
                <input type="reset" value="重置" class="btn ">
            </div>
        </form>
    </div>      
</div>    
@endsection

@section('myJs')
<script src="/back/ueditor/ueditor.config.js"></script>
<script src="/back/ueditor/ueditor.all.min.js"></script>
<script src="/back/ueditor/ueditor.parse.min.js"></script>
<script>
    //自定义编辑器
    var ue = UE.getEditor('editor', {toolbars: [
            ['fullscreen', 'source', 'undo', 'redo', 'bold','simpleupload']
        ]});
    $(function(){
        $('#select').on('change',function(){
            var type,val;
            val = $(this).val();
            type = parseInt($(this).find('option[value='+val+']').attr('type'));

            if(!!!type){
                alert('该分类不允许添加关联文章');
                $('#select').val(0);
            }
        })
    });
</script>
@endsection