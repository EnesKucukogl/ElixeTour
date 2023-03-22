<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.contact',);

    }

    public function frontSideContact()
    {
        $officeList = Office::officeListActive();
        return view('contact', ['officeList' => $officeList]);
    }

    public function datagrid()
    {
        $contact = Contact::all();
        return response()->json($contact);
    }
    public function edit($id)
    {
        $contactDetail = Contact::find($id);
        return response()->json($contactDetail);
    }

    public function store(Request $request)
    {

        $contact = Contact::where('Id',  $request->Id)->first();

        if ($contact !== null) {
            $contact->where('Id', $request->Id)->update([
                'status' => $request->status,
                'updated_user_id' =>  Auth::user()->Id,
            ]);
        } else {
            Contact::create([
                 'status' => $request->status,
                 'created_user_id' =>  Auth::user()->Id,
                 'updated_user_id' =>  Auth::user()->Id,
            ]);
        }


        return response()->json(['success'=>'Record saved successfully.']);
    }

    public function update(Request $request)
    {

        Contact::where('Id', $request->Id)->update([
            'active' => $request->active,
            'updated_user_id' =>  Auth::user()->Id,
        ]);
        return response()->json(['success'=>'Record saved successfully.']);
    }
}
