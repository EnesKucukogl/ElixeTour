<?php

namespace App\Http\Controllers;

use App\Models\ContactResponse;
use http\Env\Request;


class ContactResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function datagrid($contact_id)
    {
        $contactResponse = ContactResponse::listAll($contact_id);
        return response()->json($contactResponse);
    }




}
