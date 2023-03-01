<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profile',);
    }
    public function datagrid()
    {
        $profile = Profile::all();
        return response()->json($profile);
    }

    public function getProfile()
    {

        $profileDetail = Profile::find(Auth::user()->Id);
        return response()->json($profileDetail);
    }

    public function store(Request $request)
    {
        $profile = Profile::where('Id', $request->Id)->first();

        if ($profile !== null) {
            if (Hash::check($request-> oldPassword, $profile-> password)){
                if ($request->newPassword == $request ->newPasswordAgain){
                    $profile->where('Id', $request->Id)->update([
                        'password' => Hash::make($request-> newPassword),
                        'update_user_id' =>  Auth::user()->Id
                    ]);

                    return response()->json(['mesaj'=>'Şifreniz Değiştirilmiştir', 'kod'=>0]);
                }
                else{
                    return response()->json(['mesaj'=>'Girdiğiniz şifreler uyuşmamaktadir', 'kod' =>-1]);
                }
            }
            else {
                return response()->json(['success'=>'Hatalı Şifre!']);
            }

        } else {
            Profile::create([
                'password' => $request->name,
                'create_user_id' =>  Auth::user()->Id,
            ]);
            return response()->json(['success'=>'Record saved successfully.']);
        }

    }
    public function update(Request $request)
    {

        Profile::where('Id', $request->Id)->update([
            'password' => $request->password,
            'update_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }

}
