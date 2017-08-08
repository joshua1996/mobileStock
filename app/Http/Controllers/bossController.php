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
        $shopR = $shop->where('bossID', '=', Auth::guard('boss')->user()->bossID)
            ->where('remove', '=', false)
            ->get();
        return view('boss.shop.shop', ['shop' => $shopR]);
    }

    public function shopadd(Request $r)
    {
        $shop = new shopModel();
        $shop->create([
            'shopID'=> 'shop'.uniqid(),
            'shopName' => $r->input('shopName'),
            'bossID' => Auth::guard('boss')->user()->bossID
        ]);
    }

    public function  shopEdit(Request $r)
    {
        $shop = new shopModel();
        $shop->where('shopID', '=', $r->input('shopID'))
            ->update([
                'shopName' => $r->input('shopName')
            ]);
    }

    public function shopDelete(Request $r)
    {
        $shop = new shopModel();
        $shop->where('shopID', '=', $r->input('shopID'))
            ->update([
                'remove' => true
            ]);
    }
}
