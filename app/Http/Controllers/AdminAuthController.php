<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function handleLogin(Request $request)
    {

        $validator =  $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('webadmin')
            ->attempt($request->only(['user_name', 'password'])))
        {

            return redirect()->route('admin.home');
        }

        $validator['userNamePassword'] = 'Kullanıcı adı veya şifre hatalı';
        return  redirect()->route('admin.login')->withErrors($validator);

    }

    public function logout()
    {
        Session::flush();

        Auth::guard('webadmin')->logout();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function table()
    {
        return view('admin.table');
    }
    public function withoutMenu()
    {
        return view('admin.withoutMenu');
    }
}
