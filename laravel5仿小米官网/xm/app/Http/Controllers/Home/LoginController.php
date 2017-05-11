<?php

namespace App\Http\Controllers\Home;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;


class LoginController extends Controller
{
    public function getIndex()
    {

        return view('/home/login');
    }
    public function postIndex(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $Vcode = $request->input('Vcode');



        if(session('Vcode')!=$Vcode){
            return back()->with('error','验证码有误!');
        }


        $user = User::where('username',$username)->first();
        

        if(empty($user)){
            return back()->with('error','无效的用户名!');
        }

        $upass = $user->password;
        if(Hash::check($password,$upass)){
            session(['uid'=>$user->id]);
            session(['pic'=>$user->pic]);
            return redirect('/');
        }
        return back()->with('error','密码错误!');


    }

    public function getRegister()
    {
        return view('home.register');
    }
    public function postRegister(Requests\RegisterRequest $request)
    {
        $Vcode = $request->input('Vcode');

        if(session('Vcode')!=$Vcode){
            return back()->with('error','验证码有误!');
        }

        $user = new User();
        $data = $request->only('username','password','email','');
        $user->password = Hash::make($data['password']);
        $user->status = 1;
        $user->username = $data['username'];
        $user->email = $data['email'];

        if($user->save()){
            return redirect('/login');
        }else{
            return back()->with('error','添加失败');
        }

    }
    public function getPassword()
    {
        return view('home.password');
    }
    public function postPassword(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');

        $user = User::where('username',$username)->first();

        if(empty($user)){
            return back()->with('error','无效的用户名!');
        }

        $e = $user->email;

//        var_dump(env('MAIL_USERNAME'));
//        var_dump(config('app.APP_NAME'));

//        return view('emails.forget',['user'=> $user]);
        if($email==$e){
            //发邮件
            $request->session()->put('uid',$user->id);
            return redirect('/login/password')->with('mark','1');
            //模态框弹出 a邮箱 跳转login
        }
        return back()->with('error','邮箱不匹配!');
    }
    public function getRepass()
    {
        return view('home.repass');
    }
    public function postRepass(Request $request)
    {
        $data = $request->all();
        $id = session('uid');

        if($data['confirm_password']==$data['password']){

            $user = User::find($id);
            $user->password = Hash::make($data['password']);
            $user->save();
        }
        return redirect('/login');
    }

    public function getCaptcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        Input::session()->flash('Vcode', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }
}
