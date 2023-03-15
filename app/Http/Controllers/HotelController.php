<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index()
    {
        return view('admin.hotel');
    }

    public function datagrid()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }

    public function datagridActive()
    {
        $hotels = Hotel::where("active","=","1")->get();
        return response()->json($hotels);
    }

    public function edit($id)
    {
        $hotelDetail = Hotel::find($id);
        return response()->json($hotelDetail);
    }

    public function store(Request $request)
    {
        $hotel = DB::table('elx_hotel')->where('Id',  $request->Id)->first();

        if ($hotel !== null) {
            DB::table('elx_hotel')->where('Id', $request->Id)->update([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'updated_user_id' =>  Auth::user()->Id
            ]);
        } else {
            DB::table('elx_hotel')->insert([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'created_user_id' =>  Auth::user()->Id,
            ]);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {
        $hotelDetail = DB::table('elx_hotel')->find($request -> Id);
        DB::table('elx_hotel')->where('Id', $request->Id)->update([
            'active' => !($hotelDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
