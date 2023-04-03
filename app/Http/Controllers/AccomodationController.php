<?php

namespace App\Http\Controllers;

use App\Models\Accomodation;
use App\Models\AccomodationType;
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

    public function getHotelAccomodation(Request $request)
    {
        $hotelAccomodation = Accomodation::hotelAccomodationList($request->hotel_id);
        return $hotelAccomodation;
    }

    public function edit($id)
    {
        $accomodationDetail = Accomodation::find($id);
        return response()->json($accomodationDetail);
    }

    public function store(Request $request)
    {
        $accomodation = Accomodation::find($request->Id);

        if ($accomodation !== null) {
            DB::Table('elx_accomodation')->where('Id', $request->Id)->update([
                'room_type' => $request->roomType,
                'updated_user_id' => Auth::user()->Id
            ]);
            return response()->json(['success' => 'Record saved successfully.']);
        } else {

            $values = array
            (
                'room_type' => $request->roomType,
                'created_user_id' => Auth::user()->Id
            );
            DB::table('elx_accomodation')->insert($values);

            return response()->json(['success' => 'Record saved successfully.']);
        }

    }

    public function update(Request $request)
    {
        $accomodationDetail = Accomodation::find($request->Id);
        DB::Table('elx_accomodation')->where('Id', $request->Id)->update([
            'active' => !($accomodationDetail->active),
            'updated_user_id' => Auth::user()->Id,
        ]);
        return response()->json(['success' => 'Record saved successfully.']);
    }
}
