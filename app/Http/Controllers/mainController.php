<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyModel;
use App\supplyPersonModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class mainController extends Controller
{


    public function home()
    {
        $stock = new stockModel();
       // $stockR = $stock->all();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
       // echo $stockR;
        return view('user.sales.sales', ['stock' => $stockR]);
    }

    public function sales(Request $r)
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
                'userID' => Auth::guard('user')->user()->userID
            ]);
        }
        return redirect()->route('home');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
       // $salesR = $sales->all();
        $salesR = $sales->where('shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))->get();
        return view('user.sales.salesHistory', ['sales' => $salesR]);
    }

    public function salesSearchDate(Request $r)
    {
        $sales = new salesModel();
        //$salesR = $sales->whereDate('dateTime', '=', $r->dateTime)->get();
        $salesR = $sales
            ->where('shopID', '=', Session::get('shopID'))
            ->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])->get();
        return Response()->json(['data' =>$salesR]);
       // return view('user.sales.salesHistory', ['sales'=> $salesR]);
    }

    public function supply()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))->get();
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
        return view('user.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR]);
    }

    public function supplyP(Request $r)
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
                'userID' => Auth::guard('user')->user()->userID
            ]);
        }
        return redirect()->route('supply');
    }

    public function supplyHistory()
    {
        $supply = new supplyModel();
        $supplyR = $supply->all();
        return view('user.supply.supplyHistory', ['supply' => $supplyR]);
    }

    public function supplySearchDate(Request $r)
    {
        $supply = new supplyModel();
        $supplyR = $supply->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])->get();
        return Response()->json(['data' =>$supplyR]);
        // return view('user.sales.salesHistory', ['sales'=> $salesR]);
    }

    public function admin(){

    }
}
