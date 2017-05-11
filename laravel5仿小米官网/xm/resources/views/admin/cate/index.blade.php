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
                    <th>类名</th>
                    <th>父类</th>
                    <th>类别</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cates as $cate)
                    <tr>
                        <td>{{$cate['id']}}</td>
                        <td>{{$cate['name']}}</td>
                        <td>{{$cate['pid']}}</td>
                        <td><img src="{{$cate['img']}}"></td>
                        <td>{{$cate['status']}}</td>
                        <td>
                            <span class="btn-group">
                                <a href="/admin/cate/edit?id={{$cate['id']}}" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <a href="/admin/cate/delete?id={{$cate['id']}}" class="btn btn-small"><i class="icon-trash"></i></a>
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