<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.config',);
    }

    public function edit($Id)
    {
        $configDetail = Config::find($Id);
        return response()->json($configDetail);
    }

    public function store(Request $request)
    {
       $config = Config::where('Id', $request->Id)->update([
            'telephone' => $request->telephone,
            'mail' => $request->mail,
            'instagram_link' => $request->instagram_link,
            'facebook_link' => $request->facebook_link,
            'whatsapp' => $request->whatsapp,
            'updated_user_id' =>  Auth::user()->Id
        ]);

        return $config ? response()->json(['message' => 'Ayarlar başarıyla güncellenmiştir.','type' => 'success']) : response()->json(['message' => 'Ayarlar güncellenirken bir hata oluşmuştur.','type' => 'error']);
    }


}
