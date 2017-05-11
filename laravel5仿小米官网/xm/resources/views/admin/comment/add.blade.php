@extends('admin.index')
@section('title',$title)
@section('content')
    <div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>添加回复</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="{{url('/admin/comment/insert')}}" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">回复人id</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="user_id" value="{{old('user_id')}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">评定星级</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="star" value="{{old('star')}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">父级</label>
                    <div class="mws-form-item">
                        <select class="small" title="" name="pid">
                            <option value="0">0</option>
                            @foreach($comments as $comment)
                                <option value="{{$comment->id}}">{{$comment->id}}</option>
                            @endforeach
                        </select>
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
                            @foreach($goods as $good)
                                <option value="{{$good->id}}">{{$good->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mws-form-row" style="width: 490px;" >
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item">
                        <input type="radio" title="" name="status" value="1" checked>显示
                        <input type="radio" title="" name="status" va1ue="0">不显示
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
                        <script id="editor" name="content" type="text/plain" style="width:650px;height:300px;"></script>
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
                <input type="submit" value="添加" class="btn btn-warning">
            </div>
        </form>
    </div>
    </div>
@endsection