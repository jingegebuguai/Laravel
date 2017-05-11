@extends('admin.index')
@section('content')
    <div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>添加用户</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="{{url('/admin/user/insert')}}" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">用户姓名</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="username" value="{{old('username')}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">用户密码</label>
                    <div class="mws-form-item">
                        <input type="password" class="small" title="" name="password">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">确认密码</label>
                    <div class="mws-form-item">
                        <input type="password" class="small" title="" name="repassword">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">email</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="email" value="{{old('email')}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">phone</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="phone" value="{{old('phone')}}">
                    </div>
                </div>
                <div class="mws-form-row" style="width: 490px;" >
                    <label class="mws-form-label">上传头像</label>
                    <div class="mws-form-item">
                        <input type="file" class="small" title="" name="pic">
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="submit" value="添加" class="btn btn-warning">
            </div>
        </form>
    </div>
    </div>
@endsection