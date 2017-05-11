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
                    <th>现价</th>
                    <th>库存</th>
                    <th>型号</th>
                    <th>颜色</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($skus as $key => $sku)
                    <tr>
                        <td>{{$sku['id']}}</td>
                        <td>{{$sku['title']}}</td>
                        <td>{{$sku['price']}}</td>
                        <td>{{$sku['stock']}}</td>
                        <td>{{$sku['attr']}}</td>
                        <td>{{$sku['color']}}</td>
                        <td>{{$sku['status']}}</td>
                        <td>
                            <span class="btn-group">
                                <a href="/admin/sku/edit?id={{$sku['id']}}" class="btn btn-small" title="修改"><i class="icon-pencil"></i></a>
                                <a href="/admin/sku/delete?id={{$sku['id']}}" class="btn btn-small"  title="删除"><i class="icon-trash"></i></a>
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