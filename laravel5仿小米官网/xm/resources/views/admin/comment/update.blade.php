@extends('admin.index')
@section('title',$title)
@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>添加回复</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="{{url('/admin/comment/update')}}" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">回复人id</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" title="" name="user_id" value="{{$comment['user_id']}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">评定星级</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" title="" name="star" value="{{$comment['star']}}">
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">父级</label>
                        <div class="mws-form-item">
                            <select class="small" title="" name="pid">
                                <option value="{{$comment['pid']}}">{{$comment['pid']}}</option>

                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <div class="mws-form-item">
                            <img src="{{$comment['img']}}" alt="">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">添加图片</label>
                        <div class="mws-form-item">
                            <input type="file" class="small" title="" name="pic">
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品名称</label>
                        <div class="mws-form-item">
                            <select class="small" title="" name="good_id">
                                    <option value="{{$comment['good_id']}}">{{$comment->good->title}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                            <input type="radio" title="" name="status" value="1" @if($comment['status']==1) checked @endif>显示
                            <input type="radio" title="" name="status" value="0" @if($comment['status']==0) checked @endif>不显示
                        </div>
                    </div>


                    <!-- 配置文件 -->
                    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
                    <!-- 编辑器源码文件 -->
                    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>

                    <div class="mws-form-row">
                        <label class="mws-form-label">内容</label>
                        <div class="mws-form-item">
                            <!-- 加载编辑器的容器 -->
                            <script id="editor" name="content" type="text/plain" style="width:650px;height:300px;">{{$comment['content']}}</script>
                        </div>
                    </div>
                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor', {
                            toolbars: [
                                [ 'undo', 'redo', 'bold','italic','formatmatch','fontfamily','fontsize', 'emotion','spechars','searchreplace', 'justifyleft', 'justifyright', 'justifycenter', 'justifyjustify', 'forecolor', 'backcolor','fullscreen','lineheight','simpleupload', 'insertimage','imagenone','imageleft','imageright', 'imagecenter' ,'scrawl']
                            ]
                        });
                    </script>

                </div>
                <div class="mws-button-row">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$comment['id']}}">
                    <input type="submit" value="添加" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
@endsection