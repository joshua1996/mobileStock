<?php

namespace App\Http\Controllers;

use Auth;
use App\userModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class userLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function userLogin()
    {
        $user = new userModel();
        $userR = $user
            ->where('remove', '=', null)
            ->get();
        return view('user.login', ['user' => $userR]);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function username()
    {
        return 'username';
    }

    public function saveSession()
    {
        Session::put('shopID', Auth::guard('user')->user()->shopID);
       // return true;
    }

    protected function attemptLogin(Request $r)
    {
        return Auth::guard('user')->attempt(['username' => $r->input('username'), 'password' => $r->input('password'), 'remove' => false], $r->has('remember'));
    }
}
