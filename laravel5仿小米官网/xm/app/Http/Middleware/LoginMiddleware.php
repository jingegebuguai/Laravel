<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session('user_id')==1){
            return $next($request);
        }

        //记录上一页面
        if(array_key_exists('HTTP_REFERER',$_SERVER)){
            session(['redirectUrl' => $_SERVER['HTTP_REFERER']]);
        }
        return redirect('admin/login');

    }
}
