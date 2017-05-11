<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0035)http://mm.com/user.php?act=register -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="Generator" content="ECSHOP v2.7.3" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>小米官网</title>

    <link href="/homes/common/css/login.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/homes/common/js/common.js"></script>
    <script type="text/javascript" src="/homes/common/js/user.js"></script>
</head>
<body>
<script type="text/javascript" src="/homes/common/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/homes/common/js/jquery.json.js"></script>
<script type="text/javascript" src="/homes/common/js/transport_jquery.js"></script>
<script type="text/javascript" src="/homes/common/js/utils.js"></script>
<script type="text/javascript" src="/homes/common/js/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="/homes/common/js/xiaomi_common.js"></script>
<script>
    $(function(){

        //加载清空文本框
        $("input:text,input:password").val("");

        //提示文字隐藏显示效果
        //登录界面
        $(".enter-area .enter-item").focus(function(){
            if($(this).val().length==0){
                $(this).siblings(".placeholder").addClass("hide");
            }
        }).blur(function(){
            if($(this).val().length==0){
                $(this).siblings(".placeholder").removeClass("hide");
            }
        }).keyup(function(){
            if($(this).val().length>0){
                $(this).siblings(".placeholder").addClass("hide");
            }else{
                $(this).siblings(".placeholder").removeClass("hide");
            }
        });
        //注册界面
        $(".inputbg input").focus(function(){
            $('#error').remove();

            if($(this).val().length>0){
                $(this).parent().siblings(".t_text").addClass("hide");
            }
        }).blur(function(){
            if($(this).val().length==0){
                $(this).parent().siblings(".t_text").removeClass("hide");
            }
        }).keyup(function(){
            if($(this).val().length>0){
                $(this).parent().siblings(".t_text").addClass("hide");
            }else{
                $(this).parent().siblings(".t_text").removeClass("hide");
            }
        });

        //其它登录方式
        $("#other_method").click(function(){
            if($(".third-area").hasClass("hide")){
                $(".third-area").removeClass("hide");
            }else{
                $(".third-area").addClass("hide");
            }
        })
    })
</script>
<div class="register_wrap">
    <div class="bugfix_ie6 dis_none">
        <div class="n-logo-area clearfix">
            <a href="/" class="fl-l" style="margin-left: 450px"><img src="/homes/common/image/logo.gif" width="55" /></a>
        </div>
    </div>
    <div id="main">
        <div class="n-frame device-frame reg_frame">
            <div class="title-item dis_bot35 t_c">
                <h4 class="title-big">注册小米官网</h4>
            </div>
            <div class="regbox" id="register_box">
                <form action="/login/register" method="post" name="formUser" onsubmit="return submitPwdInfo();">
                    <input type="hidden" value="C4E1AB9A7DE79D7C750E8916875E7DBE" id="validate" />
                    <div class="phone_step1">
                        <style type="text/css">
                            #error{
                                color: orangered;
                                text-align: center;
                            }
                        </style>
                        <div class="enter-area" id="error">
                            @if (count($errors) > 0)
                                @foreach ($errors->all() as $error)
                                    <h3 id="error"> {{ $error }} </h3>
                                @endforeach
                            @endif
                            @if(session('error'))
                                <h3 id="error">
                                    {{ session('error') }}
                                </h3>
                            @endif
                        </div>
                        <input type="hidden" id="sendtype" />
                        <div class="inputbg">
                            <label class="labelbox"> <input type="text" name="username" id="username" placeholder="用户名" /> </label>
                            <span class="t_text">用户名</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="username_notice">
                            <em></em>
                        </div>
                        <div class="inputbg">
                            <label class="labelbox"> <input name="email" type="text" id="email"placeholder="email" /> </label>
                            <span class="t_text">email</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="email_notice">
                            <em></em>
                        </div>
                        <div class="inputbg">
                            <label class="labelbox"> <input type="password" name="password" id="password1" onblur="check_password(this.value);" onkeyup="check_password(this.value);checkIntensity(this.value);" placeholder="密码" /> </label>
                            <span class="t_text">密码</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="password_notice">
                            <em></em>
                        </div>
                        <div class="inputbg">
                            <label class="labelbox"> <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);" onkeyup="check_conform_password(this.value);" placeholder="确认密码" /> </label>
                            <span class="t_text">确认密码</span>
                            <span class="error_icon"></span>
                        </div>
                        <div class="err_tip" id="conform_password_notice">
                            <em></em>
                        </div>
                        <div class="inputbg inputcode dis_box clearfix">
                            <label class="labelbox label-code"> <input type="text" class="code" name="Vcode" maxlength="6" placeholder="验证码" /> </label>
                            <span class="t_text">验证码</span>
                            <span class="error_icon"></span>
                            <img src="/login/captcha" alt="captcha" class="icode_image code-image chkcode_img" onclick="this.src='/login/captcha?'+Math.random()" />
                        </div>
                        <div class="err_tip">
                            <em></em>
                        </div>
                        <div class="law">

                        </div>
                        <div class="err_tip">
                            <em></em>
                        </div>
                        <div class="fixed_bot mar_phone_dis1">
                            {{csrf_field()}}
                            <input name="Submit" type="submit" value="同意协议并注册" class="btn332 btn_reg_1 submit-step" />
                        </div>
                        <div class="trig">
                            已有账号?
                            <a href="/login" class="trigger-box">点击登录</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="n-footer">
        <div class="nl-f-nav">
        </div>
        <p class="nf-intro"><span>&copy;<a href="http://mm.com/user.php?act=register#">mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href="http://mm.com/user.php?act=register#">京网文[2014]0059-0009号</a></span></p>
    </div>
</div>
<script type="text/javascript">
    var process_request = "正在处理您的请求...";
    var username_empty = "用户名不能为空。";
    var username_shorter = "用户名长度不能少于 3 个字符。";
    var username_invalid = "用户名只能是由字母数字以及下划线组成。";
    var password_empty = "登录密码不能为空。";
    var password_shorter = "登录密码不能少于 6 个字符。";
    var confirm_password_invalid = "两次输入密码不一致";
    var email_empty = "Email 为空";
    var email_invalid = "Email 不是合法的地址";
    var agreement = "您没有接受协议";
    var msn_invalid = "msn地址不是一个有效的邮件地址";
    var qq_invalid = "QQ号码不是一个有效的号码";
    var home_phone_invalid = "家庭电话不是一个有效号码";
    var office_phone_invalid = "办公电话不是一个有效号码";
    var mobile_phone_invalid = "手机号码不是一个有效号码";
    var msg_un_blank = "用户名不能为空";
    var msg_un_length = "用户名最长不得超过7个汉字";
    var msg_un_format = "用户名含有非法字符";
    var msg_un_registered = "用户名已经存在,请重新输入";
    var msg_can_rg = "可以注册";
    var msg_email_blank = "邮件地址不能为空";
    var msg_email_registered = "邮箱已存在,请重新输入";
    var msg_email_format = "邮件地址不合法";
    var msg_blank = "不能为空";
    var no_select_question = "您没有完成密码提示问题的操作";
    var passwd_balnk = "- 密码中不能包含空格";
    var username_exist = "用户名 %s 已经存在";
</script>
</body>
</html>