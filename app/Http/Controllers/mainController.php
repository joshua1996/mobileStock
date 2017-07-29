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
        $stock = new stockModel();
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
            $stockR = $stock->where('stockID', '=', $r->input('stock')[$i])->first();
            $stock->where('stockID', '=', $r->input('stock')[$i])
                ->update([
                    'quantity' => $stockR->quantity - $r->input('quantity')[$i]
                ]);
        }
        return redirect()->route('home');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
        $salesR = $sales
            ->select(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice'])
            ->where('sales.shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))
            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
            ->join('stock', 'sales.name', '=', 'stock.stockID')
            ->paginate(10);
        return view('user.sales.salesHistory', ['sales' => $salesR]);
    }



    public function salesSearchDate(Request $r)
    {
        $sales = new salesModel();
        $salesR = $sales
            ->select(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice'])
            ->where('sales.shopID', '=', Session::get('shopID'))
            ->whereBetween('dateTime', [$r->startDate, $r->endDate])
            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
            ->join('stock', 'sales.name', '=', 'stock.stockID')
            ->paginate(10);
        return view('user.sales.salesHistory', ['sales' => $salesR]);
        //        $salesR = $sales
//            ->where('sales.shopID', '=', Session::get('shopID'))
//            ->whereBetween('dateTime', [$r->dateTime, $r->dateTimeEnd])
//            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
//            ->join('stock', 'sales.name', '=', 'stock.stockID')
//            ->get(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice']);
//        return Response()->json(['data' =>$salesR]);
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
        $stock = new stockModel();
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
            $stockR = $stock->where('stockID', '=', $r->input('stock')[$i])->first();
            $stock->where('stockID', '=', $r->input('stock')[$i])
                ->update([
                    'quantity' => $stockR->quantity - $r->input('quantity')[$i]
                ]);

        }
        return redirect()->route('supply');
    }

    public function supplyHistory()
    {
        $supply = new supplyModel();
        $supplyR = $supply
            ->select(['staff.*', 'supply.*', 'supplyperson.*', 'stock.*', 'staff.name as staffName', 'supplyperson.name as supplyName', 'stock.stockName as stockstockname', 'supply.quantity as supplyquantity', 'supply.price as supplyprice'])
            ->where('supply.shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))
            ->join('staff', 'supply.staffID', '=', 'staff.staffID')
            ->join('supplyperson', 'supply.person', '=', 'supplyperson.supplyID')
            ->join('stock', 'supply.stockName', '=', 'stock.stockID')
            ->paginate(10);

        return view('user.supply.supplyHistory', ['supply' => $supplyR]);
    }

    public function supplySearchDate(Request $r)
    {
        $supply = new supplyModel();
        $supplyR = $supply
            ->select(['staff.*', 'supply.*', 'supplyperson.*', 'stock.*', 'staff.name as staffName', 'supplyperson.name as supplyName', 'stock.stockName as stockstockname', 'supply.quantity as supplyquantity', 'supply.price as supplyprice'])
            ->whereBetween('dateTime', [$r->startDate, $r->endDate])
            ->where('supply.shopID', '=', Session::get('shopID'))
            ->join('staff', 'supply.staffID', '=', 'staff.staffID')
            ->join('supplyperson', 'supply.person', '=', 'supplyperson.supplyID')
            ->join('stock', 'supply.stockName', '=', 'stock.stockID')
            ->paginate(10);
        return view('user.supply.supplyHistory', ['supply' => $supplyR]);
      //  return Response()->json(['data' =>$supplyR]);
        // return view('user.sales.salesHistory', ['sales'=> $salesR]);
    }

}
