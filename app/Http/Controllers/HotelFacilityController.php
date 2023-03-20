<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\HotelFacility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HotelFacilityController extends Controller
{

    public function HotelInsertFacility(Request $request){

        return $request;

        $hotels = HotelFacility::where("facility_id","=",$request->facility_id)->get();

        foreach($hotels as $item){

            DB::Table("elx_hotel_facility")
                ->where("facility_id","=",$item['facility_id'])
                ->delete();

        }
        foreach($request->frmHotel as $item){
            $values = array('facility_id'=>$request['facility_id'],'hotel_id'=>$item);
            DB::Table("elx_hotel_facility")->insert($values);
        }

        return response()->json($hotels);

    }
}
