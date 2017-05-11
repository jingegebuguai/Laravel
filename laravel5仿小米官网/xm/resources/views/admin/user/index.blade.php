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
                    <th>用户名</th>
                    <th>手机</th>
                    <th>email</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['username']}}</td>
                        <td>{{$user['phone']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['status']}}</td>
                        <td>
                            <span class="btn-group">
                                <a href="/admin/user/edit?id={{$user['id']}}" class="btn btn-small"><i class="icon-pencil"></i></a>
                                <a href="/admin/user/delete?id={{$user['id']}}" class="btn btn-small"><i class="icon-trash"></i></a>
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