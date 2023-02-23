<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function edit($id)
    {
        $hotelDetail = Hotel::find($id);
        return response()->json($hotelDetail);
    }

    public function store(Request $request)
    {
        $hotel = Hotel::where('Id',  $request->Id)->first();

        if ($hotel !== null) {
            $hotel->where('Id', $request->Id)->update([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'updated_user_id' =>  Auth::user()->Id
            ]);
        } else {
            Hotel::create([
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
        $hotelDetail = Hotel::find($request -> Id);
        Hotel::where('Id', $request->Id)->update([
            'active' => !($hotelDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
