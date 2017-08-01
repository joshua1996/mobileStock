<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class adminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/sales';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function adminLogin()
    {
        return view('admin.login');
    }

    public function username()
    {
        return 'adminName';
    }

    public function saveSession()
    {
        Session::put('shopID', Auth::guard('admin')->user()->shopID);
        //session(['shopID' =>  Auth::guard('admin')->user()->shopID]);
        // return true;
    }
}
