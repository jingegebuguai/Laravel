<?php

namespace App\Http\Middleware;

use Closure;

class HomeMiddleware
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
        if(session('uid')){

            return $next($request);

        }
        if(array_key_exists('HTTP_REFERER',$_SERVER)){
            session(['back'=>$_SERVER['HTTP_REFERER']]);
        }

        if(session('back')){
            return redirect(session('back'));
        }else {
            return redirect('/login');
        }


    }
}
