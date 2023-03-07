<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use App\Models\File;


class UserAuthController extends Controller
{


    public function index()
    {
        $package = Package::packageListActive();
        $file = File::where("file_type_id","1")->where("cover_image","1")->get();
        return view('home', ['package' => $package,'packageFile'=>$file]);
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
