<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyModel;
use App\supplyPersonModel;
use Illuminate\Http\Response;

class mainController extends Controller
{
    public function home()
    {
        $stock = new stockModel();
        $stockR = $stock->all();
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
                'dateTime' => $datetime
            ]);
        }
        return redirect()->route('home');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
        $salesR = $sales->all();
        return view('user.sales.salesHistory', ['sales' => $salesR]);
    }

    public function salesSearchDate(Request $r)
    {
        $sales = new salesModel();
        //$salesR = $sales->whereDate('dateTime', '=', $r->dateTime)->get();
        $salesR = $sales->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])->get();
        return Response()->json(['data' =>$salesR]);
       // return view('user.sales.salesHistory', ['sales'=> $salesR]);
    }

    public function supply()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->all();
        $stock = new stockModel();
        $stockR = $stock->all();
        return view('user.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR]);
    }

    public function supplyP(Request $r)
    {
        $datetime = date('Y-m-d H:i:s');
        $supply = new supplyModel();
        foreach ($r->input('stockName') as $i=>$item) {
            $supply->insert([
               'stockName' => $r->input('stockName')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'person' => $r->input('person')
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
}
