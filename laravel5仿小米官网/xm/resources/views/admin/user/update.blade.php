@extends('admin.index')
@section('content')
    <div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>修改资料</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="{{url('/admin/user/update')}}" method="post" enctype="multipart/form-data">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">用户姓名</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="username" value="{{$user['username']}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">email</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="email" value="{{$user['email']}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">phone</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" title="" name="phone" value="{{$user['phone']}}">
                    </div>
                </div>
                <div class="mws-form-row" style="width: 490px;" >
                    <div class="mws-form-item">
                        <img src="{{$user['pic']}}" alt="" width="100">
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
                <input type="hidden" name="id" value="{{$user['id']}}">
                <input type="submit" value="提交" class="btn btn-warning">
            </div>
        </form>
    </div>
    </div>
@endsection