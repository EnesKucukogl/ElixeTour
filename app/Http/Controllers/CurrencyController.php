<?php

namespace App\Http\Controllers;
use app\Http\Controllers\ToastrMessageController;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.currency',);
    }
//    public function datagrid()
//    {
//        $language = Language::all();
//        return response()->json($language);
//    }

    public function datagrid()
    {
        $query=Currency::all();
        return response()->json($query);
    }

    public function datagridActive()
    {
        $query=Currency::where('active', 1)->get();
        return response()->json($query);
    }
    public function edit($id)
    {
        $currencyDet = Currency::find($id);
        return response()->json($currencyDet);
    }

    public function store(Request $request)
    {
        $currency = Currency::where('Id', $request->Id)->first();

        if ($currency !== null) {
            $currency->where('Id', $request->Id)->update([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        } else {
            Currency::create([
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
        Currency::where('Id', $request->Id)->update([
            'active' => $request->active,
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
