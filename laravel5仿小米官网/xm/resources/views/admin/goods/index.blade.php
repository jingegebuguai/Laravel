@extends('admin.index')
@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>用户表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-datatable-fn mws-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>商品名</th>
                    <th>类别</th>
                    <th>起价</th>
                    <th>图片</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($goods as $good)
                    <tr>
                        <td>{{$good['id']}}</td>
                        <td>{{$good['title']}}</td>
                        <td>{{$good->cate->name}}</td>
                        <td>{{$good['price']}}</td>
                        <td><img src="{{$good['showImg']}}" alt="" width="60"></td>
                        <td>{{$good['status']}}</td>
                        <td>
                            <span class="btn-group">
                                <a href="/admin/sku/add?id={{$good['id']}}" class="btn btn-small" title="查看详细信息"><i class="icon-search"></i></a>
                                <a href="/admin/good/edit?id={{$good['id']}}" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
                                <a href="/admin/good/delete?id={{$good['id']}}" class="btn btn-small"  title="删除"><i class="icon-trash"></i></a>
                            </span>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Panels End -->
@endsection