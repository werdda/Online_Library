<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

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
    // protected $redirectTo = '/'; // default redirect

    protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            
            return '/admin/dashboard';
        }

        return '/user/dashboard'; // Default for non-admin users
    }


    /**
     * Create a new controller instance.
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }


    public function credentials(Request $request){

        // dd($request->all());

        $login = $request->input('login');
        $loginField = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [

            $loginField => $login,
            'password' => $request->input('password'),

        ];


    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    
     public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username() {
        return 'login'; // The name of your input field
    }
    
}
