<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\HotelFacility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HotelAccomodationController extends Controller
{
    public function datagrid(Request $request)
    {

        $query = DB::Table("elx_hotel_accomodation")
        ->where("accomodation_id", "=", $request['accomodationId'])->get();
        return response()->json($query);
    }

    public function HotelInsertAccomodation(Request $request)
    {

        try{
            $request = $request->json()->all();

            DB::Table("elx_hotel_accomodation")
                ->where("accomodation_id", "=", $request['accomodationId'])
                ->delete();

            foreach ($request['SelectedRows'] as $item) {
                $values = array('accomodation_id' => $request['accomodationId'], 'hotel_id' => $item, 'created_user_id' => Auth::user()->Id);
                DB::Table("elx_hotel_accomodation")->insert($values);
            }

            return response()->json(['message' => 'Oteller başarıyla eklendi.', 'type' => 'success']);
        }
        catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }


    }
}
