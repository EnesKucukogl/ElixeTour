<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;


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

        $contact = Contact::where('Id', $request->Id)->first();

        if ($contact !== null) {
            $contact->where('Id', $request->Id)->update([
                'status' => $request->status,
                'updated_user_id' => Auth::user()->Id,
            ]);
        } else {
            Contact::create([
                'status' => $request->status,
                'created_user_id' => Auth::user()->Id,
                'updated_user_id' => Auth::user()->Id,
            ]);
        }


        return response()->json(['success' => 'Record saved successfully.']);
    }

    public function update(Request $request)
    {

        Contact::where('Id', $request->Id)->update([
            'active' => $request->active,
            'updated_user_id' => Auth::user()->Id,
        ]);
        return response()->json(['success' => 'Record saved successfully.']);
    }

    public function sendContact(Request $request)
    {
        try {

            $name = $request->name;
            $surname = $request->surname;
            $email = $request->email;
            $phone = $request->phone;
            $message = $request->message;
            $nameSurname = $name . " " . $surname;
            $contact = Contact::create([
                'name' => $name,
                'surname' => $surname,
                'e_mail' => $email,
                'phone_number' => $phone,
                'message_content' => $message,
                'send_date' => date("Y-m-d H:i:s"),
            ]);
            if ($contact) {
                try {
                    $data = [
                        'nameSurname' => $nameSurname,
                    ];

                    $content = View::make('mail-content', ['nameSurname' => $nameSurname])->render();
                    $mail = Mail::send([], [], function ($message) use ($content, $nameSurname, $email) {
                        $message->to($email, $nameSurname)
                            ->subject("Thank you for your interest!")
                            ->html($content, 'text/html');
                    });

                    return $mail ? response()->json(['message' => 'Mesaj başarıyla gönderilmiştir.', 'type' => 'success']) : response()->json(['message' => 'Mesaj gönderilirken bir hata oluşmuştur.', 'type' => 'error']);
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
                }
            } else {
                return response()->json(['message' => 'Mesaj gönderilirken bir hata oluşmuştur.', 'type' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function sendMail(Request $request)
    {

        try {

            $Id = $request->Id;
            $name = $request->name;
            $surname = $request->surname;
            $email = $request->e_mail;
            $nameSurname = $name . " " . $surname;
            $subject = $request->subject;
            $body = $request->body;
            $values = array('contact_id' => $Id, 'subject' => $subject, 'body' => $body, 'created_user_id' => Auth::user()->Id);
            $resultResponse = DB::table('elx_contact_response')->insert($values);
            if($resultResponse) {
                try {
                    $data = [
                        'nameSurname' => $nameSurname,
                        'body' => $body,
                    ];
                    $content = View::make('send-mail', $data)->render();
                    $mail = Mail::send([], [], function ($message) use ($content, $nameSurname, $email, $subject) {
                        $message->to($email, $nameSurname)
                            ->subject($subject)
                            ->html($content, 'text/html');
                    });

                    return $mail ? response()->json(['message' => 'Mesaj başarıyla gönderilmiştir.', 'type' => 'success']) : response()->json(['message' => 'Mesaj gönderilirken bir hata oluşmuştur.', 'type' => 'error']);
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
                }
            } else {
                return response()->json(['message' => 'Mesaj gönderilirken bir hata oluşmuştur.', 'type' => 'error']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'type' => 'error']);
        }
    }
}
