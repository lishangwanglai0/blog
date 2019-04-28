<?php


namespace App\Http\Controllers\administrator;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    use AuthenticatesUsers;


    public function login(Request $request)
    {
//        return 12;

//        dd($request);
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
           $this->sendLoginResponse($request);
           return ['code'=>'success','error'=>'登录成功'];
        }

        return ['code'=>'FALT','error'=>'登录失败'];


    }

    public function username()
    {
        return 'name';
    }
//    protected function attemptLogin(Request $request)
//    {
//        return $this->guard()->attempt(
//            $this->credentials($request), true
//        );
//    }
}