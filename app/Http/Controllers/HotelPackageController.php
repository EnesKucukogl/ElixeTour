<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelPackageController extends Controller
{
    public function datagrid(Request $request)
    {
        $query = DB::Table("elx_hotel_package")
            ->where("hotel_id", "=", $request['hotelId'])->get();
        return response()->json($query);
    }

    public function HotelInsertPackage(Request $request)
    {
        try{
             $request = $request->json()->all();
            DB::Table("elx_hotel_package")
                ->where("hotel_id", "=", $request['hotelId'])
                ->delete();

            foreach ($request['SelectedRows'] as $item) {
                $values = array('hotel_id' => $request['hotelId'], 'package_id' => $item, 'created_user_id' => Auth::user()->Id);
                DB::Table("elx_hotel_package")->insert($values);
            }

            return response()->json(['message' => 'Paketler başarıyla eklendi.', 'type' => 'success']);
        }
        catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }


    }
}
