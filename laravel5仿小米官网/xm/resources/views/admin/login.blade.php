<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8">

    <!-- Viewport Metatag -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <!-- Required Stylesheets -->
    <link rel="stylesheet" type="text/css" href="/back/bootstrap/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/back/css/fonts/ptsans/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/back/css/fonts/icomoon/style.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/back/css/login.css" media="screen">
    <link rel="stylesheet" type="text/css" href="/back/css/mws-theme.css" media="screen">

    <title>用户登录</title>

</head>

<body>

<div id="mws-login-wrapper">
    @if(session('error'))
        <div class="mws-form-message error">
            提示信息
            <ul>
                <li>{{ session('error') }}</li>
            </ul>
        </div>
    @endif

    <div id="mws-login">
        <h1>登陆</h1>
        <div class="mws-login-lock"><i class="icon-lock"></i></div>
        <div id="mws-login-form">
            <form class="mws-form" action="/admin/login/login" method="post">
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <input type="text" name="username" class="mws-login-username required" placeholder="用户名">
                    </div>
                </div>
                <div class="mws-form-row">
                    <div class="mws-form-item">
                        <input type="password" name="password" class="mws-login-password required" placeholder="密码">
                    </div>
                </div>

                <div class="mws-form-row">
                    {{csrf_field()}}
                    <input type="submit" value="进入后台" class="btn btn-success mws-login-button">
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- jQuery-UI Dependent Scripts  -->
<script src="/back/jui/js/jquery-ui-effects.min.js"></script>

<!-- Plugin Scripts -->
<script src="/back/plugins/validate/jquery.validate-min.js"></script>

<!-- Login Script -->
<script src="/back/js/core/login.js"></script>

</body>
</html>
