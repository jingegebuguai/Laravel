@extends('layout.admin')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 帮助栏目添加<a href="/admin/help/cate" class="btn btn-danger pull-right">帮助栏目分类列表</a></span>

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
        <form id="cate" class="mws-form" action="/admin/help/cateedit" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">帮助栏目名称</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="name" value="{{$info->name}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">上级栏目名称</label>
                    <div class="mws-form-item">
                         <select name="pid"  class="large">
                            <option value="0">顶级栏目</option>
                            @foreach($cates as $k=>$v)
                            <option value="{{$v->id}}" @if($v->id==$info->pid) selected @endif>{{$v->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">是否在底部栏目显示</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" name="show" value="1" @if($info->show==1) checked @endif> <label>启用</label></li>
                            <li><input type="radio" name="show" value="0" @if($info->show==0) checked @endif> <label>禁用</label></li>
                        </ul>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" name="status" value="1" @if($info->status==1) checked @endif> <label>启用</label></li>
                            <li><input type="radio" name="status" value="0" @if($info->status==0) checked @endif> <label>禁用</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$info->id}}">
                <input type="submit" value="提交" class="btn btn-danger">
                <input type="reset" value="重置" class="btn ">
            </div>
        </form>
    </div>      
</div>    
@endsection