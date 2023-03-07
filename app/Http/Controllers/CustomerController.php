<?php

namespace App\Http\Controllers;
use app\Http\Controllers\ToastrMessageController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function edit($id)
    {
        $customerDet = Customer::find($id);
        return response()->json($customerDet);
    }

    public function store(Request $request)
    {
        $customer = Customer::where('Id', $request->Id)->first();

            $customer->where('Id', $request->Id)->update([
                'active' => $request->active,
                'membership_status' => $request->membership_status,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
