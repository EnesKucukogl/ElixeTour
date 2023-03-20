<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccomodationController extends Controller
{
    public function index()
    {
        return view('admin.accomodation');
    }

    public function datagrid()
    {
        $accomodations = Accomodation::all();
        return response()->json($accomodations);
    }

    public function edit($id)
    {
        $accomodationDetail = Accomodation::find($id);
        return response()->json($accomodationDetail);
    }

    public function store(Request $request)
    {
        $accomodation = DB::Table('elx_accomodation')->where('Id',  $request->Id)->first();

        if ($accomodation !== null) {
            DB::Table('elx_accomodation')->where('Id', $request->Id)->update([
                'room_type' => $request->roomType,
                'hotel_id' => $request->hotelId,
                'active' => $request->active,
                'updated_user_id' =>  Auth::user()->Id
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        } else {
            DB::Table('elx_accomodation')->create([
                'room_type' => $request->roomType,
                'hotel_id' => $request->hotelId,
                'active' => $request->active,
                'created_user_id' =>  Auth::user()->Id,
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {
        $accomodationDetail = Accomodation::find($request -> Id);
        DB::Table('elx_accomodation')->where('Id', $request->Id)->update([
            'active' => !($accomodationDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
