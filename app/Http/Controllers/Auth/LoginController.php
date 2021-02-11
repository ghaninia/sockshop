<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers, Response;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        $this->seo([
            "title" => "ورود به حساب کاربری",
        ]);
        return view('dashboard.auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ["required", "email"],
            'password' => ["required", "min:5"],
            'captcha' => ["required", "captcha"]
        ]);
    }


    protected function loggedOut(Request $request)
    {
        return $this->success("از پنل کاربری خارج شده اید.");
    }

    protected function authenticated(Request $request, $user)
    {
        return $this->success("وارد پنل کاربری شده اید ");
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
