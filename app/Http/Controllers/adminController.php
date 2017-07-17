<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    public function sales()
    {
        $stock = new stockModel();
        $stockR = $stock->all();
        return view('admin.sales.sales',  ['stock' => $stockR]);
    }

    public function adminSalesP(Request $r)
    {
        $sales = new salesModel();
        $datetime = date('Y-m-d H:i:s');
        foreach ($r->input('stock') as $i=>$value)
        {
            $sales->insert([
                'name' => $r->input('stock')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'userID' => Auth::guard('admin')->user()->adminID
            ]);
        }
        return redirect()->route('adminSales');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
        $salesR = $sales->all();
        return view('admin.sales.salesHistory', ['sales' => $salesR]);
    }
}
