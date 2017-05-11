<?php

namespace App\Http\Controllers\admin;

use App\Cate;
use App\User;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getIndex()
    {
        $users = User::all();
        return view('admin.user.index',['users'=>$users,'title'=>'用户列表']);
    }
    public function getAdd()
    {
        return view('admin.user.add',['title'=>'添加用户']);
    }

    public function postInsert(Requests\UserInsertRequest $request)
    {
        $user = new User();
        $data = $request->only('username','password','email','phone');
        $user->password = Hash::make($data['password']);
        $user->status = 1;
        if($request->hasFile('pic'))
        {
            $user->pic = self::uploadFile();

        }else{
            $user->pic = config('app.upload_image_dir').'user.png';
        }
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];

        if($user->save()){
            return redirect('admin/user/add')->with('info','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    //上传头像
    public static function uploadFile()
    {
        $pic = $_FILES['pic']['name'];
        $dir = config('app.upload_image_dir');
        $name = trim($dir.rand(1000000,9000000).time().'.'.pathinfo($pic,4),'.');
        Input::file('pic')->move($dir,$name);
        return $name;
    }

    //编辑信息
    public function getEdit(Request $request)
    {
        $user = User::where('id',$request->only('id'))->first();

        return view('admin.user.update',['user'=>$user,'title'=>'添加用户']);
    }
    
    //执行编辑信息
    public function postUpdate(Requests\UserUpdateRequest $request)
    {
        $user = User::where('id',$request->only('id'))->first();

        //判断用户名
        if($user['username'] != $request->username) {

            if(User::where('username','like', $request->username)->first()){

                return back()->with('error','用户名已存在');

            }
        }
        
        $user -> username = $request -> username;
        $user -> email = $request -> email;
        $user -> phone = $request -> phone;
        if($request->hasFile('pic')){
            self::updateFile();
            $user->pic = self::uploadFile();
        }

        $user -> save();
        return redirect('admin/user')->with('info','更新成功');
    }
    
    public static function updateFile()
    {
        $pic = User::select('pic')->where('id',Input::only('id'))->first();
        $dbpic = '.'.$pic['pic'];

        $defaultpic = config('app.upload_image_dir').'user.png';

        if($dbpic != $defaultpic){
            if(file_exists(realpath($dbpic))) {
                unlink(realpath($dbpic));
            }
        }
    }

    public function getDelete(Request $request)
    {
        $id = $request->input('id');
        if(User::where('id',$id)->first()->delete()){
            return back()->with('info','删除成功!');
        }else{
            return back()->with('error','删除失败!');
        }
    }

    





/*
 * 网站前台部分
 *
 * */

    public function login()
    {
        return view('home.user.login',['title','用户登录页']);
    }

    public function doLogin()
    {
        echo '111';
    }
    /* 注册 */
    public function register()
    {
        echo '111';

    }
    public function doRegister(Request $request)
    {
  
        $info = $request->all();
        $user = new User();
        $user -> username = $info['username'];
        $user -> password = $info['password'];
        $user -> email = $info['email'];
//        $user -> token = str_random(50);
        
        $user -> save();

        Mail::send('email.register', ['user' => $user], function ($m) use ($user) {
            $m->from(env('MAIL_USERNAME'), config('app.APP_NAME'));
            $m->to($user['email'])->subject('Your Reminder!');
        });
    }
    /* 激活 */
    public function active()
    {
        echo '111';

    }
    public function doActive()
    {
        echo '111';

    }
    /* 忘记密码 */
    public function forget()
    {

    }
    public function doForget()
    {
        echo '111';

    }
    /* 重置密码 */
    public function reset()
    {
        echo '111';

    }
    public function doReset()
    {
        echo '111';

    }








}
