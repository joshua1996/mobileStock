<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyPersonModel;
use App\supplyModel;
use App\stockTypeModel;
use App\staffModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function sales()
    {
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
        $staff = new staffModel();
        $staffR = $staff->join('user', 'staff.userID', '=', 'user.userID')
            ->where('user.shopID', '=', Session::get('shopID'))->get();
        return view('admin.sales.sales',  ['stock' => $stockR, 'staff'=> $staffR]);
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
                'staffID' => $r->input('staffID'),
                'shopID' => Session::get('shopID')
            ]);
        }
        return redirect()->route('adminSales');
    }

    public function salesHistory()
    {
        $sales = new salesModel();
        $salesR = $sales->where('sales.shopID', '=', Session::get('shopID'))
            ->whereDate('dateTime', '=', date('Y-m-d'))
            ->join('staff', 'sales.staffID', '=', 'staff.staffID')
            ->join('stock', 'sales.name', '=', 'stock.stockID')
            ->get(['staff.*', 'sales.*', 'stock.*', 'staff.name as staffName', 'sales.quantity as salesquantity', 'sales.price as salesprice']);
        return view('admin.sales.salesHistory', ['sales' => $salesR]);
    }

    public function salesSearchDate(Request $r)
    {
        $sales = new salesModel();
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
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))->get();
        $staff = new staffModel();
        $staffR = $staff->join('user', 'staff.userID', '=', 'user.userID')
            ->where('user.shopID', '=', Session::get('shopID'))->get();
        return view('admin.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR, 'staff' => $staffR]);
    }

    public function adminSupplyP(Request $r)
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
        return redirect()->route('adminSupply');
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
        return view('admin.supply.supplyHistory', ['supply' => $supplyR]);
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
    }

    public function stock()
    {
        $stock = new stockModel();
        $stockR = $stock->where('stock.shopID', '=', Session::get('shopID'))
            ->join('stockType', 'stock.stockType', '=', 'stockType.stockTypeID')
            ->get();
        $stockType = new stockTypeModel();
        $stockTypeR = $stockType->where('shopID', '=', Session::get('shopID'))->get();
        return view('admin.stock.stock', ['stock'=> $stockR, 'stockType'=> $stockTypeR]);
    }

    public function stockEdit(Request $r)
    {
        $stock = new stockModel();
        $stock->where('stockID', '=', $r->input('stockID'))
            ->update([
                'stockName' => $r->input('stockName'),
                'quantity' => $r->input('quantity'),
                'price' => $r->input('price'),
                'stockType' => $r->input('stockType')
            ]);
    }

    public function stockDelete(Request $r)
    {
        $stock = new stockModel();
        $stock->where('stockID', '=', $r->input('stockID'))->delete();

    }

    public function stockAdd(Request $r)
    {
        //todo dd
        $stock = new stockModel();
        $stock->insert([
           'stockID'=> 'stock'.uniqid(),
            'stockName' => $r->input('stockname'),
            'price' => $r->input('price'),
            'quantity' => $r->input('quantity'),
            'stocktype' => $r->input('stocktype'),
            'shopID' => Session::get('shopID')
        ]);
    }

    public function supplyPerson()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))->get();
        return view('admin.supply.supplyEdit', ['supplyPerson' => $supplyPersonR]);
    }

    public function supplyPersonEdit(Request $r)
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPerson->where('shopID', '=', Session::get('shopID'))
            ->update([
                'name' => $r->input('supplyPerson')
            ]);
    }

    public function supplyPersonAdd(Request $r)
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPerson->insert([
            'supplyID' => 'supply'.uniqid(),
            'name' => $r->supplyPerson,
            'shopID' => Session::get('shopID')
        ]);
    }
}
