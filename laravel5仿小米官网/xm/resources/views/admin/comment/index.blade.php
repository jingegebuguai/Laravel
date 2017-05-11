@extends('admin.index')
@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>回复列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-datatable-fn mws-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>商品分类</th>
                    <th>发表人</th>
                    <th>父级</th>
                    <th>星级</th>
                    <th>图片</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment['id']}}</td>
                        <td>{{$comment->good->title}}</td>
                        <td>{{$comment->user->username}}</td>
                        <td>{{$comment['pid']}}</td>
                        <td>{{$comment['star']}}</td>
                        <td>{{$comment['img']}}</td>
                        <td>{{$comment['status']}}</td>
                        <td>
                            <span class="btn-group">
                                <a href="/admin/comment/edit?id={{$comment['id']}}" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <a href="/admin/comment/delete?id={{$comment['id']}}" class="btn btn-small"><i class="icon-trash"></i></a>
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