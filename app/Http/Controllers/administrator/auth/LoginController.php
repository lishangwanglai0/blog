<?php


namespace App\Http\Controllers\administrator\auth;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\administrator\UserRequest;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * 登录
     * @param Request $request
     * @return array|void
     * @throws \Illuminate\Validation\ValidationException
     */

    public function login(Request $request)
    {

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
           $this->sendLoginResponse($request);
           return result('SUCCESS','登陆成功');
        }

        return result('FALT','登陆失败');


    }

    /**
     * 注册
     * @param UserRequest $request
     * @return array
     */
    public function register(UserRequest $request)
    {
        $register=new RegisterController;

        event(new Registered($user = $this->create($request->all())));

        $register->guard()->login($user);

        return $register->registered($request, $user);
    }

    /**
     * 创建用户
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * 退出登录
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return result('SUCCESS','退出成功');
    }
    public function aa()
    {
        $id=1;
      $a=  session('permissionurl'.$id);
      dd($a);
    }


}