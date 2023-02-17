<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        return view('admin.hotel');
    }

    public function datagrid()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }
}
