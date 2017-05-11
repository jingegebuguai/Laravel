@extends('admin.index')
@section('title',$title)
@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>修改商品</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form class="mws-form" action="{{url('/admin/good/update')}}" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">商品名称</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" title="" name="title" value="{{$good['title']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">商品价格</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" title="" name="price" value="{{$good['price']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <div class="mws-form-item">
                            <img src="{{$good['showImg']}}" alt="">
                        </div>
                    </div><div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">列表图片</label>
                        <div class="mws-form-item">
                            <input type="file" class="small" title="" name="showImg">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">商品主图</label>
                        <div class="mws-form-item">
                            <input type="file" class="small" title="" name="img[]" multiple>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">商品分类</label>
                        <div class="mws-form-item">
                            <select class="small" title="" name="cate_id">
                                @foreach($cates as $cate)
                                    @if($good->cate_id == $cate->id)
                                        <option value="{{$cate->id}}" selected>{{$cate->name}}</option>
                                    @else
                                        <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                            <input type="radio" title="" name="status" value="1" checked>上架
                            <input type="radio" title="" name="status" va1ue="0">下架
                        </div>
                    </div>


                    <!-- 配置文件 -->
                    <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
                    <!-- 编辑器源码文件 -->
                    <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>

                    <div class="mws-form-row">
                        <label class="mws-form-label">详情</label>
                        <div class="mws-form-item">
                            <!-- 加载编辑器的容器 -->
                            <script id="editor" name="content" type="text/plain" style="width:650px;height:300px;">商品信息不能为空</script>
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
                    <input type="hidden" name="id" value="{{$good['id']}}">
                    <input type="submit" value="保存并添加sku" class="btn btn-warning">
                </div>
            </form>
        </div>
    </div>
@endsection