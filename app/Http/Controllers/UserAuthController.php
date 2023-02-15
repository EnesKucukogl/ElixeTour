<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserAuthController extends Controller
{
    public function index()
    {
        return view('home');
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
