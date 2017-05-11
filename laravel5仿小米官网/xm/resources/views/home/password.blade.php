<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039)http://mm.com/user.php?act=get_password -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="Generator" content="ECSHOP v2.7.3" />
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <title>小米官网</title>

    <link rel="stylesheet" href="/homes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/homes/bootstrap/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="/homes/bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="/homes/bootstrap/js/bootstrap.min.js"></script>


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

        @if(session('mark')==1)
            $('#but').trigger('click');
        @endif


        //加载清空文本框
        $("input:text,input:password").val("").focus(function(){
            $('#error').remove();
        });

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
<script type="text/javascript">
    var user_name_empty = "请输入您的用户名！";
    var email_address_empty = "请输入您的电子邮件地址！";
    var email_address_error = "您输入的电子邮件地址格式不正确！";
    var new_password_empty = "请输入您的新密码！";
    var confirm_password_empty = "请输入您的确认密码！";
    var both_password_error = "您两次输入的密码不一致！";
</script>
<style type="text/css">
    img{
        position: absolute;
        left: 640px;
        top:20px;

    }
    #error{
        color: orangered;
        text-align: center;
    }

</style>




<div class="register_wrap">
    <div class="bugfix_ie6 dis_none">
        <div class="n-logo-area clearfix">
            <a href="/" class="fl-l"><img src="/homes/common/image/logo.gif" width="55" /></a>
        </div>
    </div>
    <div id="main" class="">
        <div class="n-frame device-frame reg_frame">
            <div class="title-item dis_bot35 t_c">
                <h4 class="title-big">请输入您注册时填写的用户名和电子邮件地址。 </h4>
            </div>
            <div class="regbox">
                <form action="/login/password" method="post" name="getPassword" onsubmit="return submitPwdInfo();">
                    <style type="text/css">
                        #error{
                            color: orangered;
                            text-align: center;
                        }
                    </style>
                    <div class="enter-area" id="error">
                        @if(session('error'))
                            <h4 id="error">
                                {{ session('error') }}
                            </h4>
                        @endif
                    </div>
                    <div class="inputbg">
                        <label class="labelbox"> <input name="username" type="text" size="30" placeholder="用户名" /> </label>
                        <span class="t_text">用户名</span>
                        <span class="error_icon"></span>
                    </div>
                    <div class="inputbg">
                        <label class="labelbox"> <input name="email" type="text" size="30" class="inputBg" placeholder="电子邮件地址" /> </label>
                        <span class="t_text">电子邮件地址</span>
                        <span class="error_icon"></span>
                    </div>
                    <div class="fixed_bot mar_phone_dis1">
                        {{csrf_field()}}
                        <input type="submit" name="submit" value="提 交" class="btn332 btn_reg_1 submit-step" style="border:none;" />
                        <input name="button" type="button" onclick="history.back()" value="返回上一页" style="border:none;" class="button" />
                    </div>
                </form>
            </div>
        </div>


        <div class="n-footer">
            <p class="nf-intro"><span>&copy;<a href="http://mm.com/user.php?act=get_password#">mi.com</a> 京ICP证110507号 京ICP备10046444号 京公网安备1101080212535号 <a href="http://mm.com/user.php?act=get_password#">京网文[2014]0059-0009号</a></span></p>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">内容已核实 请登录邮箱验证</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <a href="/login/repass">
                            <button class="btn btn-warning col-xs-offset-5" >确定前往验证</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <button type="button" id="but" class="btn btn-primary col-xs-offset-4 hidden" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"></button>

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
</div>




</body>
</html>