<?php

namespace App\Http\Middleware;

use Closure;
use App\Support\traits\Rolesales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class SafetyRole
{
    use Rolesales;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::id()){
            return response(['return_code'=>'FALT','return_msg'=>'请登录'],401);
        }

        if(!$this->safety(Auth::id())){
            return response(['return_code'=>'FALT','return_msg'=>'没有权限访问'],401);
        }
//        dd(12);
        return $next($request);
    }
}
