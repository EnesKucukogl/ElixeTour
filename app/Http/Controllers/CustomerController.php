<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer',);
    }
    public function datagrid()
    {
        $customer = Customer::all();
        return response()->json($customer);
    }
//    public function datagrid()
//    {
//        $query=Customer::where('active', 1)->get();
//        return response()->json($query);
//    }
    public function edit($id)
    {
        $customerDet = Customer::find($id);
        return response()->json($customerDet);
    }

    public function store(Request $request)
    {
        $customer = Customer::where('Id', $request->Id)->first();

        if ($customer !== null) {
            $customer->where('Id', $request->Id)->update([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        } else {
            Customer::create([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'created_user_id' =>  Auth::user()->Id,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }
//Silme
    public function update(Request $request)
    {
        Customer::where('Id', $request->Id)->update([
            'active' => $request->active,

            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
