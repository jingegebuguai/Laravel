@extends('layout.admin')
@section('title','订单列表页')
@section('content')
<div class="mws-panel grid_8 mws-collapsible">
    <div class="mws-panel-header">
        <span> <i class="icon-table"></i>
            订单列表页
        </span>
        <div class="mws-collapse-button mws-inset">
            <span></span>
        </div>
    </div>
    <div class="mws-panel-inner-wrap">
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
            <form action="/admin/order" method="get">
                <div id="DataTables_Table_0_length" class="dataTables_length">
                    <label>
                        显示
                        <select size="1" name="num" aria-controls="DataTables_Table_0">
                            <option value="10" @if($request->input('num') == 10) selected="selected" @endif>10</option>
                            <option value="25" @if($request->input('num') == 25) selected="selected" @endif>25</option>
                            <option value="50" @if($request->input('num') == 50) selected="selected" @endif>50</option>
                            <option value="100" @if($request->input('num') == 100) selected="selected" @endif>100</option>
                        </select>
                        条数据
                    </label>
                </div>
                <div class="dataTables_filter" id="DataTables_Table_0_filter">
                    <label>
                        搜索:
                        <input type="text" name="keywords" aria-controls="DataTables_Table_0" value="{{$request->input('keywords')}}"></label>
                        <button class="btn btn-primary">搜索</button>
                </div>
            </form>
                <style>
                    .color0{color:#b94a48;}
                    .color1{color:#38b0de;}
                    .color2{color:#3a87ad;}
                    .color3{color:#666666;}
                    .color4{color:#468847;}
                    .color5{color:#9f5f9f;}
                    .color6{color:#5959ab;}
                    .color7{color:#a67d3d;}
                    .color8{color:#ff2400;}
                </style>
                <table class="mws-table mws-datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 120px;">订单id</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 120px;">用户名</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 120px;">订单编号</th>
                            <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 120px;">订单状态</th>
                            <th class="sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label="" style="width: 101px;">操作</th>
                        </tr>
                    </thead>
                    
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($order as $k=>$v)
                        <tr class="" path="">
                            <td class="sorting_1">{{$v->id}}</td>
                            <td>{{$v->user->username}}</td>
                            <td>{{$v->order_num}}</td>
                            <td> 
                                <span class="color{{$v->order_status}}">{{$status[$v->order_status]}}</span>
                            </td>
                            <td>
                                <span class="btn-group">
                                    <a href="/admin/order/edit?id={{$v->id}}" class="btn btn-small" title="编辑订单状态">
                                        <i class="icon-pencil"></i>
                                    </a>
                                    <a href="/admin/order/detail?id={{$v->id}}" class="btn btn-small" title="查看订单详情">
                                        <i class="icon-zoom-in"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                 <style type="text/css">
                    #pages{
                        height:auto;
                        overflow:hidden;
                        margin-left:0px;
                        padding-left:0px;
                    }

                    #pages li{
                        float: left;
                        height: 20px;
                        padding: 0 10px;
                        display: block;
                        font-size: 12px;
                        line-height: 20px;
                        text-align: center;
                        cursor: pointer;
                        outline: none;
                        background-color: #444444;
                        color: #fff;
                        text-decoration: none;
                        border-right: 1px solid rgba(0, 0, 0, 0.5);
                        border-left: 1px solid rgba(255, 255, 255, 0.15);
                        -webkit-box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                        -moz-box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                        box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                    }
                    #pages a{
                        color:white;
                    }
                    #pages ul{
                        height:auto;
                        padding-left:0px;
                        margin-left:3px;
                    }
                    #pages .active {
                        float: left;
                        height: 20px;
                        padding: 0 10px;
                        display: block;
                        font-size: 12px;
                        line-height: 20px;
                        text-align: center;
                        cursor: pointer;
                        outline: none;
                        background-color: #88a9eb;
                        color:black;
                    }
                    #pages .disabled{
                        color: #666666;
                        cursor: default;
                    }
                </style>
                <div class="dataTables_info" id="DataTables_Table_0_info"></div>
                <div class="dataTables_paginate paging_two_button" id="pages">
                    {{$order->appends($request->all())->render()}}
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection
@section('css')
<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/back/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/custom-plugins/picklist/picklist.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/plugins/select2/select2.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/plugins/ibutton/jquery.ibutton.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/plugins/cleditor/jquery.cleditor.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/back/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/back/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/back/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/back/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/back/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/back/css/themer.css" media="screen">

@endsection
@section('js')
    <!-- JavaScript Plugins -->
    <script src="/back/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/back/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/back/js/libs/jquery.placeholder.min.js"></script>
    <script src="/back/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/back/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/back/jui/jquery-ui.custom.min.js"></script>
    <script src="/back/jui/js/jquery.ui.touch-punch.js"></script>

    <script src="/back/jui/js/globalize/globalize.js"></script>
    <script src="/back/jui/js/globalize/cultures/globalize.culture.en-US.js"></script>

    <!-- Plugin Scripts -->
    <script src="/back/custom-plugins/picklist/picklist.min.js"></script>
    <script src="/back/plugins/autosize/jquery.autosize.min.js"></script>
    <script src="/back/plugins/select2/select2.min.js"></script>
    <script src="/back/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/back/plugins/validate/jquery.validate-min.js"></script>
    <script src="/back/plugins/ibutton/jquery.ibutton.min.js"></script>
    <script src="/back/plugins/cleditor/jquery.cleditor.min.js"></script>
    <script src="/back/plugins/cleditor/jquery.cleditor.table.min.js"></script>
    <script src="/back/plugins/cleditor/jquery.cleditor.xhtml.min.js"></script>
    <script src="/back/plugins/cleditor/jquery.cleditor.icon.min.js"></script>
    <!-- Core Script -->
    <script src="/back/bootstrap/js/bootstrap.min.js"></script>
    <script src="/back/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/back/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/back/js/demo/demo.formelements.js"></script>
    <script>
    $(function(){
        $('.ibutton-container').on('click',function(){
            if($(this).data('ck'))return;
            $(this).data('ck',1);
            var $id = $(this).find('.ibutton').attr('cid');
            var status = $(this).find('.ibutton').prop('checked');
            status = status?1:0;
            var $self = $(this);
            $.ajax({
                url:'/admin/indexPage/ajaxnavupdate',
                type:'GET',
                data:{'id':$id,status:status},
                success: function(data){
                    if( data==='0' )
                    {
                         $self.data('ck',false);
                    }else{
                        $self.find('.ibutton').prop('checked',false);
                        $self.data('ck',false);
                        alert('状态更改失败');

                    }
                }
            });
        });
        $('#j-createJs').on('click',function(){
            $.ajax({
                url:'/admin/indexPage/ajaxcreate',
                type:'GET',
                success: function(data){
                    if(data){
                        alert('已经生成了');
                    }else{
                        alert('未知错误');
                    }
                    
                }
            });
        })
    });
    </script>
@endsection