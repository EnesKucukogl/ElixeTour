<?php

namespace App\Http\Controllers;
use App\Models\PackageTreatment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PackageTreatmentController extends Controller
{
//    public function datagrid(Request $request)
//    {
//        $query = DB::Table("elx_package_treatment")
//            ->where("package_id", "=", $request['packageId'])->get();
//        return response()->json($query);
//        return $query;
//    }

    public function TreatmentInsertFacility(Request $request)
    {
        try{
            $request = $request->json()->all();

            DB::Table("elx_package_treatment")
                ->where("package_id", "=", $request['packageId'])
                ->delete();


            foreach ($request['SelectedRows'] as $item) {

                $values = array('package_id' => $request['packageId'], 'treatment_id' => $item['Id'], 'created_user_id' => Auth::user()->Id);
                DB::Table("elx_package_treatment")->insert($values);
            }

            return response()->json(['message' => 'Tedavi başarıyla eklenmiştir.', 'type' => 'success']);
        }
        catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }



    }

}
