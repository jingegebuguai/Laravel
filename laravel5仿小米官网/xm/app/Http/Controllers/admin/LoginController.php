<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getIndex()
    {
        return view('/admin/login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
//        $password = Hash::make($password);

        $user = User::where('username',$username)->first();

        if(empty($user)){
            return back()->with('error','无效的用户名!');
        }

        $upass = $user->password;

        if(Hash::check($password,$upass)){

            session(['user_id'=>$user->id]);
            session(['pic'=>$user->pic]);
            return redirect('/admin/user');
        }
        return back()->with('error','密码错误!');
    }

    public function getOutLogin()
    {
        session(['user_id'=>null]);
        return redirect('/admin/login');
    }
}
