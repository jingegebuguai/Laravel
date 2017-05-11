@extends('admin.index')
@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>修改分类</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="{{url('/admin/cate/update')}}" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">分类名称</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" title="" name="name" value="{{$cate['name']}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <div class="mws-form-item">
                            <img src="{{$cate['img']}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">父类名称</label>
                        <div class="mws-form-item">
                            <select class="small" title="" name="pid">
                                @foreach($cates as $v)
                                    @if($v->id == $cate->pid)
                                        <option value="{{$v->id}}" selected>{{$v->name}}</option>
                                    @else
                                        <option value="{{$v->id}}">{{$v->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                            <input type="radio" title="" @if($cate -> status ==1)checked="checked" @endif name="status" value="1" id="on"><label for="on">启用 </label>
                            <input type="radio" title="" @if($cate -> status ==0)checked="checked" @endif name="status" value="0" id="off"><label for="off">禁用</label>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$cate->id}}">
                    <input type="submit" value="修改" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
@endsection