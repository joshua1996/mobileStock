<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyPersonModel;
use App\supplyModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function sales()
    {
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
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
                'userID' => Auth::guard('admin')->user()->adminID,
                'shopID' => Session::get('shopID')
            ]);
        }
        return redirect()->route('adminSales');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
        $salesR = $sales->where('shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))->get();
        return view('admin.sales.salesHistory', ['sales' => $salesR]);
    }

    public function supply()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))->get();
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
        return view('admin.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR]);
    }

    public function adminSupplyP(Request $r)
    {
        $datetime = date('Y-m-d H:i:s');
        $supply = new supplyModel();
        $supplyPerson = new supplyPersonModel();
        foreach ($r->input('stockName') as $i=>$item) {
            $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))
                ->where('name', '=', $r->input('person'))
                ->first();
            $supply->insert([
                'stockName' => $r->input('stockName')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'person' => $supplyPersonR->supplyID,//$r->input('person'),
                'userID' => Auth::guard('admin')->user()->adminID,
                'shopID' => Session::get('shopID')
            ]);
        }
        return redirect()->route('adminSupply');
    }

    public function supplyHistory()
    {
        $supply = new supplyModel();
        $supplyR = $supply->where('shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))->get();
        return view('admin.supply.supplyHistory', ['supply' => $supplyR]);
    }

    public function supplySearchDate(Request $r)
    {
        $supply = new supplyModel();
        $supplyR = $supply->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])
            ->where('shopID', '=', Session::get('shopID'))
            ->get();
        return Response()->json(['data' =>$supplyR]);
    }
}
