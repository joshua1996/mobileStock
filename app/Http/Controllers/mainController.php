<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyModel;
use App\supplyPersonModel;
use App\staffModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class mainController extends Controller
{


    public function home()
    {
        $stock = new stockModel();
        $staff = new staffModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        $staffR = $staff->where('userID', '=', Auth::guard('user')->user()->userID)->get();
        return view('user.sales.sales', ['stock' => $stockR, 'staff'=> $staffR]);
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
                'staffID' => $r->input('staff'),
                'shopID' => Session::get('shopID')
            ]);
        }
        return redirect()->route('home');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
       // $salesR = $sales->all();
        $salesR = $sales
            ->select(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice'])
            ->where('sales.shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))
            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
            ->join('stock', 'sales.name', '=', 'stock.stockID')
            ->paginate(1);
        return view('user.sales.salesHistory', ['sales' => $salesR]);
    }



    public function salesSearchDate(Request $r)
    {
        $sales = new salesModel();
        //$salesR = $sales->whereDate('dateTime', '=', $r->dateTime)->get();
        $salesR = $sales
            ->where('sales.shopID', '=', Session::get('shopID'))
            ->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])
            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
            ->join('stock', 'sales.name', '=', 'stock.stockID')
            ->get(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice']);
        return Response()->json(['data' =>$salesR]);
    }

    public function supply()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))->get();
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        $staff = new staffModel();
        $staffR = $staff->where('userID', '=', Auth::guard('user')->user()->userID)->get();
        return view('user.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR, 'staff' => $staffR]);
    }

    public function supplyP(Request $r)
    {
        $datetime = date('Y-m-d H:i:s');
        $supply = new supplyModel();
        $supplyPerson = new supplyPersonModel();
        foreach ($r->input('stock') as $i=>$item) {
            $supply->insert([
               'stockName' => $r->input('stock')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'person' => $r->input('supply'),
                'staffID' => $r->input('staff'),
                'shopID' => Session::get('shopID')
            ]);
        }
        return redirect()->route('supply');
    }

    public function supplyHistory()
    {
        $supply = new supplyModel();
        $supplyR = $supply->where('supply.shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))
            ->join('staff', 'supply.staffID', '=', 'staff.staffID')
            ->join('supplyperson', 'supply.person', '=', 'supplyperson.supplyID')
            ->join('stock', 'supply.stockName', '=', 'stock.stockID')
            ->get(['staff.*', 'supply.*', 'supplyperson.*', 'stock.*', 'staff.name as staffName', 'supplyperson.name as supplyName', 'stock.stockName as stockstockname', 'supply.quantity as supplyquantity', 'supply.price as supplyprice']);

        return view('user.supply.supplyHistory', ['supply' => $supplyR]);
    }

    public function supplySearchDate(Request $r)
    {
        $supply = new supplyModel();
        $supplyR = $supply->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])
            ->where('supply.shopID', '=', Session::get('shopID'))
            ->join('staff', 'supply.staffID', '=', 'staff.staffID')
            ->join('supplyperson', 'supply.person', '=', 'supplyperson.supplyID')
            ->join('stock', 'supply.stockName', '=', 'stock.stockID')
            ->get(['staff.*', 'supply.*', 'supplyperson.*', 'stock.*', 'staff.name as staffName', 'supplyperson.name as supplyName', 'stock.stockName as stockstockname', 'supply.quantity as supplyquantity', 'supply.price as supplyprice']);

        return Response()->json(['data' =>$supplyR]);
        // return view('user.sales.salesHistory', ['sales'=> $salesR]);
    }

}
