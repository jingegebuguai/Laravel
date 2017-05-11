@extends('layout.admin')
@section('title','小米明星产品添加')
@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-plus"></i> 小米明星产品添加</span>
    </div>
    
    <div class="mws-panel-body no-padding">
        @if(count(session('errors')))
        <div class="mws-form-message error">
            错误信息提示:
            <ul>
                @foreach($errors->all() as $k=>$v)
                <li>{{$v}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form id="cate" class="mws-form" action="/admin/indexPage/staradd" method="post">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">小米明星产品id</label>
                    <div class="mws-form-item">
                        <input type="text" class="large required" name="name" value="@if(!empty($str)) {{$str}} @endif">
                        <p>不同的产品id之间用英文逗号(,)隔开</p>
                        
                    </div>
                    <div class="mws-form-item">
                        <style>
                            .mws-form-item .row li{
                                float: left;
                                width: 30%;
                                overflow: hidden;
                                text-align: center;
                                border:1px dashed #dedede;
                                position: relative;
                            }
                            .mws-form-item .row .close{
                                width: 30px;
                                height: 30px;
                                position: absolute;
                                top:5px;
                                right:5px;
                                background: orange;
                                cursor: pointer;
                            }
                            .mws-form-item .icon-remove::before{
                                text-align: center;
                                line-height: 30px;
                                font-size: 16px;
                                color:#fff;
                            }
                        </style>
                        <ul class="row" style="list-style:none;overflow: hidden;">
                        @if(!empty($data))
                            @foreach($data as $key=>$v)
                            <li class="col-md-2">
                                <img src="{{$v->showImg}}" alt="" with="30%">
                                <p>{{$v->title}}</p>
                                <p>{{$v->sub_title}}</p>
                                <p>{{$v->price}}</p>
                            </li>
                            @endforeach
                        @endif
                        </ul>
                        <br>
                        <p style="color:orange;" class="clearfix">提交之后显示当前关联明星产品信息</p>
                    </div>
                </div>

            </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="submit" value="提交" class="btn btn-danger">
            </div>
        </form>
    </div>      
</div>    
@endsection
@section('myJs')
<script src="/back/plugins/validate/jquery.validate-min.js"></script>
    <script>

    // Validation
    if( $.validator ) {
        $("#cate").validate({
            ignore:'.select2-input',
            rules: {
                name:{
                    required:true,
                    ismy:true
                }
                
            },
            messages:{
                name:{
                    required:'该选项不能为空'
                }

            },
            submitHandler:function(form){
                var val = $.trim($("input[name=name]").val());
                var reg = /^[0-9,]+$/;
                if(reg.test(val)){
                    form.submit();
                }  
                
            }    
        });
        
        $.validator.addMethod('ismy',function(value,element){
            var val = $.trim($(element).val());
            var reg = /^[0-9,]+$/;
            return this.optional(element) || (reg.test(val));
        },'只能包含数字和英文逗号(,)');
    }
    </script>
@endsection