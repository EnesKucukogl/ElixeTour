<?php

namespace App\Http\Controllers;

use App\Models\AccomodationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccomodationTypeController extends Controller
{
    public function index()
    {
        return view('admin.accomodationType');
    }

    public function datagrid()
    {
        $accomodationTypes = AccomodationType::all();
        return response()->json($accomodationTypes);
    }

    public function edit($id)
    {
        $accomodationTypeDetail = AccomodationType::find($id);
        return response()->json($accomodationTypeDetail);
    }
    public function getHotelAccodomotationType(Request $request)
    {
        $hotelAccomodationType = AccomodationType::hotelAccomodationTypeSingleList($request->hotel_id,$request->accomodation_id);
        return $hotelAccomodationType;
    }

    public function getSingle(Request $request)
    {
        $accomodationTypeSingle = DB::Table('vew_accomodation_type')
            ->where('accomodation_id',  $request->accomodation_id)
            ->where('hotel_id',  $request->hotel_id)
            ->where('room_type_detail',  $request->room_type_detail)
            ->where('room_board',  $request->room_board)
            ->first();
        return $accomodationTypeSingle;
    }



    public function store(Request $request)
    {
        $accomodationType = DB::Table('elx_accomodation_type')->where('Id',  $request->Id)->first();

        if ($accomodationType !== null) {
            DB::Table('elx_accomodation_type')->where('Id', $request->Id)->update([
                'accomodation_id' => $request->accomodationId,
                'room_type_detail' => $request->roomTypeDetail,
                'room_board' => $request->roomBoard,
                'sales_price' => $request->salesPrice,
                'sales_currency_id' => $request->salesCurrencyId,
                'hotel_id' => $request->hotel_id,
                'updated_user_id' =>  Auth::user()->Id
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        } else {
            DB::Table('elx_accomodation_type')->insert([
                'accomodation_id' => $request->accomodationId,
                'room_type_detail' => $request->roomTypeDetail,
                'room_board' => $request->roomBoard,
                'sales_price' => $request->salesPrice,
                'sales_currency_id' => $request->salesCurrencyId,
                'hotel_id' => $request->hotel_id,
                'created_user_id' =>  Auth::user()->Id,
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        }
        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {
        $accomodationTypeDetail = AccomodationType::find($request -> Id);
        DB::Table('elx_accomodation_type')->where('Id', $request->Id)->update([
            'active' => !($accomodationTypeDetail->active),
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
