<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\shopModel;
use Illuminate\Support\Facades\Auth;

class bossController extends Controller
{
    public function index ()
    {
        return view('boss.empty');
    }

    public function shop()
    {
        $shop =  new shopModel();
        $shopR = $shop->where('bossID', '=', Auth::guard('boss')->user()->bossID)->get();
        return view('boss.shop.shop', ['shop' => $shopR]);
    }
}
