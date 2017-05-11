@extends('admin.index')
@section('title',$title)
@section('content')

    <style type="text/css">
        a{
            text-decoration: none;
        }
        .ff{
            font-family: Arial;

        }
        .fz{
            font-size: 14px;
        }
        .flz{
            font-size: 18px;
        }
        .color{
            color: rgba(74, 35, 125, 0.83);

        }
        .w{
            font-weight: 900;
        }
        .mb5{
            margin-bottom: 15px;
        }
        .red{
            color: red;
        }
        label{
            text-align: center;
        }
    </style>
    <div class="mws-panel grid_8">
        <div class="mws-panel-header" >
            <span>商品信息</span>
        </div>
        <div class="mws-panel-body" >
            <span class="ff flz">
                <span class="color">商品名称</span>:{{$good->title}} &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="color">价格</span>:{{$good->price}} &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="color">状态</span>:{{$good->status}} &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="color">创建时间</span>:{{$good->created_at}} &nbsp;&nbsp;&nbsp;&nbsp;
                <span class="color">修改时间</span>:{{$good->updated_at}}
            </span>
        </div>
    </div>
    <div class="mws-panel grid_3" style="height:100%;" id="list">
        <div class="mws-panel-header ff">
            <span>{{$good->title}}商品种类 共: <a class="flz red ff" id="count">{{$good->skus->count()}} </a> 种</span>
        </div>
        @foreach($good->skus as $k=>$sku)
            <div class="mws-panel-body no-padding grid_8">
                <div class="mws-stat grid_8">
                    <div style="margin-bottom:16px;" class="mws-panel grid_1">
                        <button type="button" title="{{$sku->title}}" class="btn btn-danger btn-small" style="margin-bottom: 10px;margin-top: 10px; ">del</button>
                        <button type="button" title="{{$sku->title}}" class="btn btn-primary btn-small">edit</button>
                    </div>
                <span class="mws-stat-content">
                    <span class="ff " >{{$sku->title}}</span><br>
                    <span class="ff ">原价:{{$sku->falsePrice}} 现价:{{$sku->price}} 库存:{{$sku->stock}} 状态:{{$sku->status}}</span>
                </span>
                </div>
            </div>
        @endforeach


    </div>
    <div class="mws-panel grid_5">
        <div class="mws-panel-header">
            <button class="btn btn-warning" id="subBut">提交</button>
            <button class="btn btn-danger" id="resBut">清除</button>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="form" class="mws-form" action="/admin/sku/update" method="post" enctype="multipart/form-data">
                <div class="mws-form-inline">
                    <div class="mws-form-row" style="width: 490px;">
                        <label class="mws-form-label">名称</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="title" value="{{$sku['title']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">原价</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="falsePrice" value="{{$sku['falsePrice']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">现价</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="price" value="{{$sku['price']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">颜色</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="color" value="{{$sku['color']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">型号</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="attr" value="{{$sku['attr']}}">
                        </div>
                    </div>

                    <div class="mws-form-row" style="width: 400px;" >

                        <div class="mws-form-item">
                            <img src="{{$sku['img']}}" alt="">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 400px;" >
                        <label class="mws-form-label">列表图片</label>
                        <div class="mws-form-item">
                            <input type="file" class="grid_3" title="" name="img">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 400px;" >
                        <label class="mws-form-label">库存</label>
                        <div class="mws-form-item">
                            <input type="text" class="grid_6" title="" name="stock" value="{{$sku['stock']}}">
                        </div>
                    </div>
                    <div class="mws-form-row" style="width: 490px;" >
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item">
                            <input type="radio" title="" name="status" value="1" @if($sku['status']==1) checked @endif>上架
                            <input type="radio" title="" name="status" value="0" @if($sku['status']==0) checked @endif>下架
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
                            <script id="editor" name="info" type="text/plain" style="width:100%;height:20%;">​
                             <table class="cs_tab">
                               <tbody>
                                <tr>
                                 <td class="td_tit">品牌</td>
                                 <td> MI/小米 </td>
                                 <td class="td_tit">型号</td>
                                 <td>4C 标准版全网通</td>
                                 <td class="td_tit">上市时间</td>
                                 <td>2015年</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">主屏分辨率</td>
                                 <td> 1920&times;1080像素 </td>
                                 <td class="td_tit">外观样式</td>
                                 <td>直板</td>
                                 <td class="td_tit">屏幕颜色</td>
                                 <td>1600万</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">主屏尺寸</td>
                                 <td> 5.0英寸 </td>
                                 <td class="td_tit">操作系统</td>
                                 <td>MIUI 6（基于Android OS 5.1）</td>
                                 <td class="td_tit">是否智能手机</td>
                                 <td>智能手机</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">前摄像头</td>
                                 <td> 500万像素 </td>
                                 <td class="td_tit">摄像头</td>
                                 <td>1300万</td>
                                 <td class="td_tit">触摸屏</td>
                                 <td>电容式触摸屏</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">运行内存RAM</td>
                                 <td> 2G </td>
                                 <td class="td_tit">机身内存ROM</td>
                                 <td>16g</td>
                                 <td class="td_tit">储存功能</td>
                                 <td>不支持存储卡</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">高级功能</td>
                                 <td> 双卡双待 </td>
                                 <td class="td_tit">网络制式</td>
                                 <td>电信4G/联通4G/移动4G</td>
                                 <td class="td_tit">CPU型号</td>
                                 <td>骁龙808</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">厚度</td>
                                 <td> 超薄(小于9mm) </td>
                                 <td class="td_tit">CPU核数</td>
                                 <td>六核</td>
                                 <td class="td_tit">CPU频率</td>
                                 <td>1.8GHz</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">电池类型</td>
                                 <td> 不可拆卸电池 </td>
                                 <td class="td_tit">耳机接口</td>
                                 <td>3.5mm</td>
                                 <td class="td_tit">电池容量</td>
                                 <td>3080mAh</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">SIM卡类型</td>
                                 <td> Micro SIM(中卡） </td>
                                 <td class="td_tit">屏幕像素密度PPI</td>
                                 <td>441</td>
                                </tr>
                                <tr>
                                 <td class="td_tit">商品清单</td>
                                 <td colspan="5">主机x1, 充电器x1,USB数据线x1, 说明书x1, 保修卡x1</td>
                                </tr>
                               </tbody>
                              </table>
                             </body>
                            </html>
                           </script>
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
                    <input type="hidden" name="good_id" value="{{$good->id}}">
                    <input type="hidden" name="id" value="{{$sku['id']}}">
                    <button id="sub" class="btn btn-warning" title="">提交</button>
                    <input type="reset" id="res" class="btn btn-danger" value="清除" title="">
                </div>
            </form>
        </div>
    </div>
    <iframe src="" frameborder="0" name="iFrame"></iframe>

@endsection
@section('myJs')
    <script type="text/javascript">
        $(function () {
            var list = $('#list');
            var res = $('#res');
            var subBut = $('#subBut');
            var sub = $('#sub');
            var resBut = $('#resBut');
            var form = $('#form');
            var good_id = {{$good->id}};


            //上面的button绑定下面的button触发事件
            subBut.click(function () {
                sub.trigger('click');

            });

            resBut.click(function () {
                res.trigger('click');
            });

            //表单提交button 点击事件
            sub.click(function () {
                var title = $('input[name="title"]').val();
                var falsePrice = $('input[name="falsePrice"]').val();
                var price = $('input[name="price"]').val();
                var stock = $('input[name="stock"]').val();
                var status = $('input[name="status"]').val();
                var id = $('input[name="id"]').val();

                //同步操作
                setTimeout(function () {
                    $.ajax({
                        'url': '/admin/sku/insert',
                        'data': {'title': title,'good_id':good_id},
                        'type': 'get',
                        'dataType': 'json',  //设置处理数据格式
                        success: function (data) {     //自定义处理data函数;

                            if (data!=0) {
                                list.append('<div class="mws-panel-body no-padding grid_8"> <form class="mws-stat grid_8"> <div style="margin-bottom:16px;" class="mws-panel grid_1"><button type="button" title="' + title + '" class="btn btn-danger btn-small" style="margin-bottom: 10px;margin-top: 10px; ">del</button><button type="button" title="' + title + '" class="btn btn-primary btn-small">edit</button> </div> <span class="mws-stat-content"> <span class="ff " >' + title + '</span><br> <span class="ff ">原价:' + falsePrice + ' 现价:' + price + '库存:' + stock + ' 状态:' + status + '</span> </span> </form> </div>')

                                $('#count').html(data);
                                $('[title=' + title + ']:odd').click(function () {
                                    $.get('/admin/sku/ajax-edit', {'title': title}, function (data) {
                                        $('input[name="title"]').val(data.title);
                                        $('input[name="falsePrice"]').val(data.falsePrice);
                                        $('input[name="price"]').val(data.price);
                                        $('input[name="stock"]').val(data.stock);
                                        $('input[name="img"]').attr('src',data.img);
                                        $('input[name="status"]').val(data.status);
                                        $('input[name="id"]').val(data.id);
                                        subBut.html('提交').attr('class', 'btn btn-warning');
                                        sub.html('提交').attr('class', 'btn btn-warning');
                                        form.attr('action', '/admin/sku/update');
                                        form.removeAttr('target');
                                    }, 'json');
                                    return false;
                                });
                                $('[title=' + title + ']:even').click(function () {
                                    var even = $(this);
                                    $.get('/admin/sku/ajax-delete', {'title': title,'good_id':good_id}, function (data) {
                                        if(data){
                                            $('#count').html(data);
                                            even.parents('div [class="mws-panel-body no-padding grid_8"]').remove();
                                            window.location.reload();
                                        }else{
                                           alert('删除失败!');
                                        }
                                    });

                                    return false;
                                });

                            }
                        },
                        error: function () {
                            alert('发生错误!');
                        },
                        timeout: 3000,
                        async: true  //主要是为了设置同步
                    });

                    res.trigger('click');
                }, 1000);
            });

            $('[class="mws-panel-body no-padding grid_8"] button:odd').click(function () {
                var title = $(this).attr('title');
                $.get('/admin/sku/ajax-edit',{'title':title},function (data) {
                    $('input[name="title"]').val(data.title);
                    $('input[name="falsePrice"]').val(data.falsePrice);
                    $('input[name="price"]').val(data.price);
                    $('input[name="stock"]').val(data.stock);
                    $('input[name="img"]').attr('src',data.img);
                    $('input[name="status"]').val(data.status);
                    $('input[name="id"]').val(data.id);
                    subBut.html('提交').attr('class','btn btn-warning');
                    sub.html('提交').attr('class','btn btn-warning');
                    form.attr('action','/admin/sku/update');
                    form.removeAttr('target');
                },'json');

                return false;
            });
            $('[class="mws-panel-body no-padding grid_8"] button:even').click(function () {
                var title = $(this).attr('title');
                var even = $(this);
                $.get('/admin/sku/ajax-delete', {'title': title,'good_id':good_id}, function (data) {
                    if(data){
                        even.parents('div [class="mws-panel-body no-padding grid_8"]').remove();
                        $('#count').html(data);
                        window.location.reload();
                    }else{
                        alert('删除失败!');
                    }
                });

                return false;
            });

        })
    </script>
@endsection