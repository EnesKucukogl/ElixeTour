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
    public function datagrid(Request $request)
    {
        $query = DB::Table("elx_hotel_facility")
            ->where("facility_id", "=", $request['facilityId'])->get();
        return response()->json($query);

    }

    public function HotelInsertFacility(Request $request)
    {

        try{
            $request = $request->json()->all();

            DB::Table("elx_hotel_facility")
                ->where("facility_id", "=", $request['facilityId'])
                ->delete();

            foreach ($request['SelectedRows'] as $item) {
                $values = array('facility_id' => $request['facilityId'], 'hotel_id' => $item, 'created_user_id' => Auth::user()->Id);
                DB::Table("elx_hotel_facility")->insert($values);
            }

            return response()->json(['message' => 'Oteller başarıyla eklendi.', 'type' => 'success']);
        }
        catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }


    }
}
