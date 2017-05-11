<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
@section('css')
    <!-- Plugin Stylesheets first to ease overrides -->
        <link rel="stylesheet" type="text/css" href="/back/plugins/colorpicker/colorpicker.css" media="screen">

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
    @show
    <title>@yield('title')</title>

</head>

<body>

<!-- header -->
<div id="mws-header" class="clearfix">

    <!-- Logo Container -->
    <div id="mws-logo-container">
        <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        <div id="mws-logo-wrap">
            {{--<img src="/back/images/mws-logo.png" alt="mws admin">--}}
            <h3 style="color: yellowgreen">小米管理系统</h3>
        </div>
    </div>

    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">
        <div id="mws-user-message" class="mws-dropdown-menu">
            <a href=""></a>
        </div>

        <!-- User Information and functions section -->
        <div id="mws-user-info" class="mws-inset">

            <!-- User Photo -->
            <div id="mws-user-photo">
                <img src="/back/example/profile.jpg" alt="User Photo">
            </div>

            <!-- Username and Functions -->
            <div id="mws-user-functions">
                <div id="mws-username">
                    你好! admin
                </div>
                <ul>
                    <li><a href="/admin/user/edit?id={{session('uid')}}">更改头像</a></li>
                    <li><a href="/admin/user/edit?id={{session('uid')}}">更改密码</a></li>
                    <li><a href="/admin/login/out-login">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Start Main Wrapper -->
<div id="mws-wrapper">

    <!-- Necessary markup, do not remove -->
    <div id="mws-sidebar-stitch"></div>
    <div id="mws-sidebar-bg"></div>

    <!-- Sidebar Wrapper -->
    <div id="mws-sidebar">

        <!-- Hidden Nav Collapse Button -->
        <div id="mws-nav-collapse">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <!-- Main Navigation -->
        <div id="mws-navigation">
            <ul>
                <li>
                    <a href="#"><i class="icon-list"></i> 用户管理</a>
                    <ul>
                        <li><a href="{{url('/admin/user/add')}}">增加用户</a></li>
                        <li><a href="{{url('/admin/user')}}">用户列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> 分类管理</a>
                    <ul>
                        <li><a href="{{url('/admin/cate/add')}}">增加分类</a></li>
                        <li><a href="{{url('/admin/cate')}}">分类列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> 商品管理</a>
                    <ul>
                        <li><a href="{{url('/admin/good/add')}}">增加商品</a></li>
                        <li><a href="{{url('/admin/good')}}">商品列表</a></li>
                        <li><a href="{{url('/admin/sku')}}">sku列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-list"></i> 评价管理</a>
                    <ul>
                        <li><a href="{{url('/admin/comment/add')}}">增加评价</a></li>
                        <li><a href="{{url('/admin/comment')}}">评价列表</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-list"></i>网站导航管理</a>
                    <ul>
                        <li><a href="/admin/indexPage/navlist">网站导航栏目</a></li>
                        <li><a href="/admin/indexPage/navadd">添加网站导航</a></li>
                        <li><a href="/admin/indexPage/navrecycle">网站导航回收站</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-list"></i>首页管理</a>
                    <ul>
                        <li><a href="/admin/indexPage/sort">分类导航脚本文件更新</a></li>
                        <li><a href="/admin/indexPage/staradd">明星单品管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-list"></i>帮助栏目管理</a>
                    <ul>
                        <li><a href="/admin/help/cate">帮助栏目分类</a></li>
                        <li><a href="/admin/help/article">帮助栏目内容管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;"><i class="icon-list"></i>订单管理</a>
                    <ul>
                        <li><a href="/admin/order">订单列表</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- 右面内容容器 -->
    <div id="mws-container" class="clearfix">
        <!-- Inner Container Start -->
        <div class="container">
            {{--右面内容部分--}}
            @if (count($errors) > 0)
                <div class="mws-form-message error">
                    错误信息
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('info'))
                <div class="mws-form-message success">
                    提示信息
                    <ul>
                        <li>{{ session('info') }}</li>
                    </ul>
                </div>
            @elseif(session('error'))
                <div class="mws-form-message error">
                    提示信息
                    <ul>
                        <li>{{ session('error') }}</li>
                    </ul>
                </div>
            @endif
            @section('content')
            @show

        </div>
        <!-- Inner Container End -->
    </div>
    <!-- Main Container End -->
</div>
{{--js部分--}}
<div>

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

        <!-- Plugin Scripts -->
        <script src="/back/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/back/plugins/colorpicker/colorpicker-min.js"></script>

        <!-- Core Script -->
        <script src="/back/bootstrap/js/bootstrap.min.js"></script>
        <script src="/back/js/core/mws.js"></script>

        <!-- Themer Script (Remove if not needed) -->
        <script src="/back/js/core/themer.js"></script>

        <!-- Demo Scripts (remove if not needed) -->
        <script src="/back/js/demo/demo.table.js"></script>
    @show
    @section('myJs')

    @show
    <script type="text/javascript">
            setInterval(function () {
                var date = new Date();
                var time = date.toTimeString();
                $('#mws-user-message a').html(time);
            },1000);
    </script>

</div>

</body>
</html>
