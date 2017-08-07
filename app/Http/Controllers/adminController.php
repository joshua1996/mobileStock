<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\stockModel;
use App\salesModel;
use App\supplyPersonModel;
use App\supplyModel;
use App\stockTypeModel;
use App\staffModel;
use App\userModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    public function sales()
    {
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)
            ->where('quantity', '>', 0)
            ->get();
        $staff = new staffModel();
        $staffR = $staff->join('user', 'staff.userID', '=', 'user.userID')
            ->where('user.shopID', '=', Session::get('shopID'))->get();
        return view('admin.sales.sales',  ['stock' => $stockR, 'staff'=> $staffR]);
    }

    public function adminSalesP(Request $r)
    {
        $sales = new salesModel();
        $stock = new stockModel();
        $datetime = date('Y-m-d H:i:s');
        foreach ($r->input('stock') as $i=>$value)
        {
            $sales->insert([
                'salesID' => 'sales'.uniqid(),
                'name' => $r->input('stock')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'staffID' => $r->input('staffID'),
                'shopID' => Session::get('shopID'),
                'remark' => $r->input('remark')[$i],
            ]);
            $stockR = $stock->where('stockID', '=', $r->input('stock')[$i])->first();
            $stock->where('stockID', '=', $r->input('stock')[$i])
                ->update([
                    'quantity' => $stockR->quantity - $r->input('quantity')[$i]
                ]);
        }
        return redirect()->route('adminSales');
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
            ->orderBy('dateTime', 'desc')
            ->paginate(10);
        return view('admin.sales.salesHistory', ['sales' => $salesR]);
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
        return view('admin.sales.salesHistory', ['sales' => $salesR]);
    }

    public function supply()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        $stock = new stockModel();
        $stockR = $stock->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)
            ->where('quantity', '>', 0)
            ->get();
        $staff = new staffModel();
        $staffR = $staff->join('user', 'staff.userID', '=', 'user.userID')
            ->where('user.shopID', '=', Session::get('shopID'))->get();
        return view('admin.supply.supply', ['supplyPerson' => $supplyPersonR, 'stock' => $stockR, 'staff' => $staffR]);
    }

    public function adminSupplyP(Request $r)
    {
        $datetime = date('Y-m-d H:i:s');
        $supply = new supplyModel();
        $stock = new stockModel();
        $supplyPerson = new supplyPersonModel();
        foreach ($r->input('stock') as $i=>$item) {

            $supply->insert([
                'toSupplyID' => 'toSupply'.uniqid(),
                'stockName' => $r->input('stock')[$i],
                'quantity' => $r->input('quantity')[$i],
                'price' => $r->input('price')[$i],
                'dateTime' => $datetime,
                'person' => $r->input('supply'),
                'staffID' => $r->input('staff'),
                'shopID' => Session::get('shopID'),
                'remark' => $r->input('remark')[$i]
            ]);
            $stockR = $stock->where('stockID', '=', $r->input('stock')[$i])->first();
            $stock->where('stockID', '=', $r->input('stock')[$i])
                ->update([
                    'quantity' => $stockR->quantity - $r->input('quantity')[$i]
                ]);
        }
        return redirect()->route('adminSupply');
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
            ->orderBy('dateTime', 'desc')
            ->paginate(10);
        return view('admin.supply.supplyHistory', ['supply' => $supplyR]);
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
        return view('admin.supply.supplyHistory', ['supply' => $supplyR]);
    }

    public function stock()
    {
        $stock = new stockModel();
        $stockR = $stock->where('stock.shopID', '=', Session::get('shopID'))
            ->where('stock.remove', '=', false)
            ->join('stockType', 'stock.stockType', '=', 'stockType.stockTypeID')
            ->paginate(20);
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
        $stock->where('stockID', '=', $r->input('stockID'))
        ->update([
            'remove'=> true
        ]);

    }

    public function stockAdd(Request $r)
    {
        $stock = new stockModel();
        $stock->insert([
           'stockID'=> 'stock'.uniqid(),
            'stockName' => $r->input('stockname'),
            'price' => $r->input('price'),
            'quantity' => $r->input('quantity'),
            'stockType' => $r->input('stocktype'),
            'shopID' => Session::get('shopID'),
            'remove' => false
        ]);
    }

    public function stockSearch(Request $r)
    {
        $stock = new stockModel();
        $stockR =  $stock
            ->where('stock.shopID', '=', Session::get('shopID'))
            ->where('stock.stockName', 'like', '%'.$r->stockname.'%')
            ->where('stock.remove', '=', false)
            ->join('stockType', 'stock.stockType', '=', 'stockType.stockTypeID')
            ->paginate(20);
        $stockType = new stockTypeModel();
        $stockTypeR = $stockType->where('shopID', '=', Session::get('shopID'))->get();
        return view('admin.stock.stock', ['stock'=> $stockR, 'stockType'=> $stockTypeR]);
    }

    public function supplyPerson()
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPersonR = $supplyPerson->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        return view('admin.supply.supplyEdit', ['supplyPerson' => $supplyPersonR]);
    }

    public function supplyPersonEdit(Request $r)
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPerson->where('shopID', '=', Session::get('shopID'))
            ->where('supplyID', '=', $r->input('supplyID'))
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
            'shopID' => Session::get('shopID'),
            'remove' => false
        ]);

    }

    public function supplyPersonDelete(Request $r)
    {
        $supplyPerson = new supplyPersonModel();
        $supplyPerson->where('supplyID', '=', $r->input('supplyID'))
            ->update([
                'remove' => true
            ]);
    }

    public function userEdit()
    {
        $user = new userModel();
        $userR = $user->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        return view('admin.user.user', ['user' => $userR]);
    }


    public function userAdd(Request $r)
    {
//        $vali =  Validator::make($r->all(), [
//            'username' => 'required|string|max:255|unique:user',
//            'password' => 'required|string|min:6',
//        ]);
//        if ($vali->fails())
//        {
//            return redirect()->route('userEditAdmin')->withErrors($vali)->withInput();
//        }else{
//            $user = new userModel();
//            $user->insert([
//                'userID' => 'user'.uniqid(),
//                'username' => $r->username,
//                'password' => bcrypt($r->password),
//                'shopID' => Session::get('shopID'),
//                'remove' => false
//            ]);
//            return redirect()->route('userEditAdmin');
//        }
        $user = new userModel();
        $user->insert([
            'userID' => 'user'.uniqid(),
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'shopID' => Session::get('shopID'),
            'remove' => false
        ]);
     //   return redirect()->route('userEditAdmin');
    }

    public function userEditP(Request $r)
    {
        $user = new userModel();
        $user->where('userID', '=', $r->input('userID'))
            ->update([
                'username' => $r->input('username'),
                'password' => bcrypt($r->input('password'))
            ]);
    }

    public function userDelete(Request $r)
    {
        $user = new userModel();
        $user->where('userID', '=', $r->input('userID'))
            ->update([
                'remove' => true
            ]);
    }

    public function staff()
    {
        $user = new userModel();
        $userR = $user->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        return view('admin.staff.staff', ['user' =>$userR]);
    }

    public function staffSelect(Request $r)
    {
        $staff = new staffModel();
        $staffR = $staff->where('userID', '=', $r->input('userid'))
            ->where('remove', '=', false)
            ->get();
        return Response()->json(['staff' => $staffR]);
    }

    public function staffEdit(Request $r)
    {
        $staff = new staffModel();
        $staff->where('staffID', '=', $r->input('staffID'))
            ->update(['name' => $r->input('name')]);
    }

    public function staffDelete(Request $r)
    {
        $staff = new staffModel();
        $staff->where('staffID', '=', $r->input('staffid'))
            ->update(['remove' => true]);
    }

    public function staffAdd(Request $r)
    {
        $staff = new staffModel();
        $staff->insert([
            'staffID' => 'staff'.uniqid(),
            'name' => $r->input('staffid'),
            'userID' => $r->input('userid'),
            'remove' => false
        ]);
    }

    public function stockType()
    {
        $stockType = new stockTypeModel();
        $stockTypeR = $stockType->where('shopID', '=', Session::get('shopID'))
            ->where('remove', '=', false)->get();
        return view('admin.stock.stockType', ['stockType' => $stockTypeR]);
    }

    public function stockTypeAdd(Request $r)
    {
        $stockType = new stockTypeModel();
        $stockType->insert([
            'stockTypeID' => 'stockType'.uniqid(),
            'name' => $r->input('name'),
            'shopID' => Session::get('shopID'),
            'remove' => false
        ]);
    }

    public function stockTypeEdit(Request $r)
    {
        $stockType = new stockTypeModel();
        $stockType->where('stockTypeID', '=', $r->input('stockTypeID'))
            ->update([
                'name' => $r->input('name')
            ]);
    }

    public function  stockTypeDelete(Request $r)
    {
        $stockType = new stockTypeModel();
        $stockType->where('stockTypeID', '=', $r->input('stockTypeID'))
            ->update([
                'remove' => true
            ]);
    }
}
