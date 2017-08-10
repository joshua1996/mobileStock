<?php

namespace App\Http\Controllers;

use App\adminModel;
use Illuminate\Http\Request;
use App\shopModel;
use Illuminate\Http\Response;
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
            'bossID' => Auth::guard('boss')->user()->bossID,
            'remove' => false
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



    public function admin()
    {
        $shop = new shopModel();
        $shopR = $shop->where('bossID', '=', Auth::guard('boss')->user()->bossID)
            ->where('remove', '=', false)
            ->get();
        return view('boss.admin.admin', ['shop' => $shopR]);
    }

    public function shopSelect(Request $r)
    {
        $shop = new shopModel();
        $shopR = $shop->where('shop.shopID', '=', $r->input('shopID'))
            ->where('shop.remove', '=', false)
            ->where('admin.remove', '=', false)
            ->join('admin', 'shop.shopID', '=', 'admin.shopID')
            ->get();
        return Response()->json(['shop' => $shopR]);
    }

    public function adminAdd(Request $r)
    {
        $admin = new adminModel();
        $admin->create([
            'adminID' => 'admin'.uniqid(),
            'adminName' => $r->input('adminName'),
            'password' => bcrypt($r->input('password')),
            'shopID' => $r->input('shopID'),
            'remove' => false
        ]);
    }

    public function adminEdit(Request $request)
    {
        $admin = new adminModel();
        $admin->where('adminID', '=', $request->input('adminID'))
            ->update([
                'adminName' => $request->input('adminName'),
                'password' => bcrypt($request->input('password'))
            ]);
    }

    public function adminDelete(Request $request)
    {
        $admin = new adminModel();
        $admin->where('adminID', '=', $request->input('adminID'))
            ->update([
                'remove' => true
            ]);
    }
}
