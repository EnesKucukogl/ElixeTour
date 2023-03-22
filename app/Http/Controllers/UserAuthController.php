<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\Treatment;
use App\Models\Hotel;
use App\Models\File;


class UserAuthController extends Controller
{


    public function index()
    {
        $package = Package::packageListActive();
        $package_file = File::where("file_type_id","1")->where("cover_image","1")->get();
        $treatment = Treatment::treatmentListActive();
        $treatment_file = File::where("file_type_id","2")->where("cover_image","1")->get();
        $hotel = Hotel::hotelListActive();
        $hotel_file = File::where("file_type_id","3")->where("cover_image","1")->get();
        return view('home', ['package' => $package,'packageFile'=>$package_file,'treatment'=>$treatment,'treatmentFile'=>$treatment_file,'hotel'=>$hotel,'hotelFile'=>$hotel_file]);
    }



    public function login()
    {
        return view('login');
    }

    public function handleLogin(Request $req)
    {

        if(Auth::attempt(
            $req->only(['email', 'password'])
        ))
        {
            return redirect()->intended('/');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('user.login');
    }

}
