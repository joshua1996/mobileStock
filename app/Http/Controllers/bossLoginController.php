<?php

namespace App\Http\Controllers;

use Auth;
use App\bossModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class bossLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/boss/shop';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function bossLogin()
    {
        return view('boss.login');
    }

    protected function guard()
    {
        return Auth::guard('boss');
    }

    public function username()
    {
        return 'bossName';
    }
}
