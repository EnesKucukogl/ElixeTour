<?php

namespace App\Http\Controllers;

use App\Models\ContactResponse;



class ContactResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function datagrid()
    {
        $contactResponse = ContactResponse::all();
        return response()->json($contactResponse);
    }




}
