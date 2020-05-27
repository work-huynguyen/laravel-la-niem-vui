<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'login_info';
    }

    protected function attemptLogin(Request $request)
    {
        $loginInfo = $request->get('login_info');
        if (filter_var($loginInfo, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $loginInfo;
        } else {
            $data['username'] = $loginInfo;
        }

        $data['password'] = $request->get('password');

        return Auth::attempt($data, $request->filled('remember'));
    }
}
