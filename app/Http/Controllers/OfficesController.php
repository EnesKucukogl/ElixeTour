<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Office;


class OfficesController extends Controller
{
    public function index()
    {
        return view('admin.offices');
    }


    public function datagrid()
    {
        $offices = Office::officeList();
        return response()->json($offices);
    }

    public function edit($id)
    {
        $officeDetail = Office::find($id);
        return response()->json($officeDetail);
    }

    public function store(Request $request)
    {
        $office = DB::table('elx_office')->where('Id', $request->Id)->first();

        if ($office !== null) {

            $officeUpdate = DB::table('elx_office')->where('Id', $request->Id)->update([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'google_maps' => $request->google_maps,
                'telephone' => $request->telephone,
                'updated_user_id' => Auth::user()->Id
            ]);
            return $officeUpdate ? response()->json(['message' => 'Ofis başarıyla güncellenmiştir.', 'type' => 'info']) : response()->json(['message' => 'Ofis güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

        } else {

            $officeInsert = DB::table('elx_office')->insert([
                'name' => $request->name,
                'city_id' => $request->cityId,
                'address' => $request->address,
                'google_maps' => $request->google_maps,
                'telephone' => $request->telephone,
                'created_user_id' => Auth::user()->Id,
            ]);

            return $officeInsert ? response()->json(['message' => 'Ofis başarıyla eklenmiştir.', 'type' => 'success']) : response()->json(['message' => 'Ofis eklenirken bir hata oluşmuştur.', 'type' => 'error']);

        }

    }

    public function update(Request $request)
    {
        $officeDetail = DB::table('elx_office')->find($request->Id);
        $officeActive = DB::table('elx_office')->where('Id', $request->Id)->update([
            'active' => !($officeDetail->active),
            'updated_user_id' => Auth::user()->Id,
        ]);
        return $officeActive ? response()->json(['message' => 'Ofis başarıyla güncellenmiştir.', 'type' => 'info']) : response()->json(['message' => 'Ofis güncellenirken bir hata oluşmuştur.', 'type' => 'error']);

    }

}
